<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership extends MY_Controller {
	
	public $membership_menu, $membership_add_menu, $membership_list_menu;
    public function __construct()
	{
		parent::__construct();
		$this->membership_menu = 'active';
		$this->membership_add_menu = ''; 
		$this->membership_list_menu = '';
		
	}

	public function add($id = 0)
	{
		$this->membership_add_menu = 'active'; 
		$this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->load->model('Country_model','country');
        $this->load->model('Membership_model','membership');
        
        if($id == 0) {
			$data = ['name' => '','fee' => '','duration' => '','duration_type' => '','description' => '',
			'status' => '','created_at' => ''];
	    } else {
			$result = $this->membership->getMembership($id, $_SESSION['branch'], $_SESSION['gym']);
			if ($result['status'] == 0) {
				die('you are not authorised to access this link');
			} else {
				$data = $result['data'];
			}
		}
        
		if ($this->input->post('post_check',0)) {
			
			if ($id == 0) {
				$this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|max_length[25]|callback_brach_unique',
						array('required' => $this->lang->line('name').' '.$this->lang->line('is_required'),
						'brach_unique' => $this->lang->line('name').' '.$this->lang->line('id_unique'),
						'max_length' => ' %s '.$this->lang->line('max_length').' %s'),
				);
		    } else {
			  if ($data['name'] != $this->input->post('name')) {
				  $this->form_validation->set_rules('name', $this->lang->line('name'), 'trim|required|max_length[25]|callback_brach_unique',
						array('required' => $this->lang->line('name').' '.$this->lang->line('is_required'),
						'brach_unique' => $this->lang->line('name').' '.$this->lang->line('id_unique'),
						'max_length' => ' %s '.$this->lang->line('max_length').' %s'),
				);
			  }		
			}
            $this->form_validation->set_rules('duration', $this->lang->line('duration'), 'trim|required|max_length[5]|is_natural_no_zero',
					array('required' => $this->lang->line('duration').' '.$this->lang->line('duration'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s',
			     	'is_natural_no_zero' => $this->lang->line('duration_validation')),
            );
            $this->form_validation->set_rules('fee', $this->lang->line('fee'), 'trim|required|max_length[15]|callback_currency',
					array('required' => $this->lang->line('fee').' '.$this->lang->line('is_required'),
					'currency' => $this->lang->line('fee_validation'),
					'max_length' => $this->lang->line('fee').' '.$this->lang->line('max_length')),
            );
            
            $this->form_validation->set_rules('duration_type', $this->lang->line('duration_type'), 'trim|required|max_length[12]',
					array('required' => $this->lang->line('duration_type').' '.$this->lang->line('is_required'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s '),
            );
            
            if ($id == 0) {
                $this->form_validation->set_rules('description', $this->lang->line('description'), 'trim|required|max_length[1000]',
						array('required' => $this->lang->line('description').' '.$this->lang->line('is_required'),
						'max_length' => $this->lang->line('description').' '.$this->lang->line('max_length').' %s'),
						
				);
			} else {
				if ($this->input->post('status') !=  $data['status']) {
					$this->form_validation->set_rules('status', $this->lang->line('member_id'), 'trim|required|max_length[10]',
						array('required' => $this->lang->line('status').' '.$this->lang->line('is_required'),
						'max_length' => $this->lang->line('status').' '.$this->lang->line('max_length').' %s'),	
				    );	
				}
			}
            
           
			
			if (!($this->form_validation->run() == FALSE))
            {
				$data = ['name' => $this->input->post('name'),
					'fee' => $this->input->post('fee'),
					'duration' => $this->input->post('duration'),
					'duration_type' => $this->input->post('duration_type'),
					'description' => $this->input->post('description'),
					'status' => $this->input->post('status'),
					'gym' => $_SESSION['gym'],
					'branch' => $_SESSION['branch']		
				];	
				if ($id == 0) {
					$data['created_at'] = date('Y-m-d H:i:s');
					$_SESSION['success'] = $this->lang->line('membership').' '.$this->lang->line('add_success');	
					$this->membership->insert($data);
				} else {
					$this->membership->update($data, $id);
					$_SESSION['success'] = $this->lang->line('membership').' '.$this->lang->line('update_success');	
				}
				redirect(site_url('list-memberships'));
			}   
		}
		
		if ($id > 0) {
			$meta_title = $this->lang->line('update');
		} else {
			$meta_title = $this->lang->line('add');
		}
		$meta_title .= ' '.$this->lang->line('membership');
		$view = $this->load->view('membership_add',['data' => $data, 'id' => $id],true);
		$this->load->view('layout',['view' => $view, 'meta_title' => $meta_title]);	
	}
	
	function validate_date($str)
	{

		$test_date = $str;
		$test_arr  = explode('/', $test_date);
		if (count($test_arr) == 3) {
			if (checkdate($test_arr[1], $test_arr[0], $test_arr[2])) {
			   return TRUE;
			} else {
			   return FALSE;
			}
		} else {
		   return FALSE;
		}
	}
	
	function currency($str)
	{
		if(!preg_match('/^\d+(\.\d{1,2})?$/',$str)){
			return FALSE;
		} else {
		    return TRUE;
		}
	}
	
	function brach_unique($str) {
		if($str !=""){
			$this->load->model('Membership_model','member');
			$result = $this->member->getMembershipById($str, $_SESSION['branch'], $_SESSION['gym']);
			if ($result['status'] == 0) {
				return TRUE;
			} else {
				return FALSE;
			}		
		} else {
			return FALSE;
		}
	}
	
	
	function list()
	{
		$this->membership_list_menu = 'active';
		$this->load->library("pagination");
		$this->load->model('Membership_model','membership');
		$config = array();
        $config["base_url"] = site_url('list-memberships');
        $config["total_rows"] = $this->membership->get_count($_GET, $_SESSION['branch'], $_SESSION['gym']);
        $config["per_page"] = PAGE_COUNT;
        $config["uri_segment"] = PAGE_SEGMENT;
        $config['reuse_query_string'] = true;
		$config['full_tag_open'] = "<ul class='pagination pagination-sm no-margin pull-right'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(PAGE_SEGMENT)) ? $this->uri->segment(PAGE_SEGMENT) : 0;
        $data['links'] = $this->pagination->create_links();
        $data['memebrs'] = $this->membership->getMemberships($config["per_page"], $page, $_GET, $_SESSION['branch'], $_SESSION['gym']);
		$view = $this->load->view('membership_list',['data' => $data, 'total' => $config["total_rows"]],true);
		$this->load->view('layout',['view' => $view, 'meta_title' => $this->lang->line('memberships')]);		
	}
	
    
    function formatDate($str)
	{
		$test_date = $str;
		$test_arr  = explode('/', $test_date);
        return $test_arr[2].'-'.$test_arr[1].'-'.$test_arr[0];
		
	}
	
	function delete($id) {
		//check if this belongs to current gym and branch
		$this->load->model('Membership_model','membership');
		$this->membership->delete($id, $_SESSION['branch'], $_SESSION['gym']);
		$_SESSION['success'] = $this->lang->line('membership').' '.$this->lang->line('deleted_success');	
		redirect(site_url('list-memberships'));
	}
	
	function view($id) {
		$this->load->model('Membership_model','membership');
		$result = $this->membership->getMembership($id, $_SESSION['branch'], $_SESSION['gym']);
		if ($result['status'] == 0) {
			die('you are not authorised to access this link');
		} else {
			$data = $result['data'];
		}
		
		$meta_title = $this->lang->line('view').' '.$this->lang->line('membership');
		$view = $this->load->view('membership_view', ['data' => $data, 'id' => $id], true);
		$this->load->view('layout',['view' => $view, 'meta_title' => $meta_title]);	
	}


	
	
	
	
}
