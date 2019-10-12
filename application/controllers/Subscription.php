<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription extends MY_Controller {
	
	public $subscription_menu, $subscription_add_menu, $subscription_list_menu;
    public function __construct()
	{
		parent::__construct();
		$this->subscription_menu = 'active';
		$this->subscription_add_menu = ''; 
		$this->subscription_list_menu = '';
		
	}

	public function add($id = 0)
	{
		$this->subscription_add_menu = 'active'; 
		$this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->load->model('Country_model','country');
        $this->load->model('Membership_model','membership');
        $this->load->model('Member_model','member');
        
        $this->load->model('Subscription_model','subscription');
        
        $memberships = $this->membership->getAll($_SESSION['branch'], $_SESSION['gym']);
        $members = $this->member->getAll($_SESSION['branch'], $_SESSION['gym']);
        
        if($id == 0) {
			$data = ['member_id' => '',
					'membership_id' => '',
					'member_name' => '',
					'membership_name' => '',
					'fee' => '',
					'registration_fee' => '',
					'other_fee' => '',
					'discount' => '',
					'start_date' => '',
					'notes' => ''];
	    } else {
			$result = $this->subscription->getSubscription($id, $_SESSION['branch'], $_SESSION['gym']);
			if ($result['status'] == 0) {
				die('you are not authorised to access this link');
			} else {
				$data = $result['data'];
			}
		}
        
		if ($this->input->post('post_check',0)) {
			
			$this->form_validation->set_rules('member_id', $this->lang->line('member'), 'trim|required',
					array('required' => $this->lang->line('member').' '.$this->lang->line('is_required'))
            );
            
            $this->form_validation->set_rules('membership_id', $this->lang->line('membership'), 'trim|required',
					array('required' => $this->lang->line('membership').' '.$this->lang->line('is_required')),
            );
            $this->form_validation->set_rules('fee', $this->lang->line('membership'). " ".$this->lang->line('fee'), 'trim|required|max_length[15]|callback_currency',
					array('required' => $this->lang->line('fee').' '.$this->lang->line('is_required'),
					'currency' => $this->lang->line('fee_validation'),
					'max_length' => $this->lang->line('membership')." ".$this->lang->line('fee').' '.$this->lang->line('max_length')),
            );         
            if ($this->input->post('registration_fee','') !="") {
				$this->form_validation->set_rules('registration_fee', $this->lang->line('registration_fee'), 'trim|required|max_length[15]|callback_currency',
						array('required' => $this->lang->line('fee').' '.$this->lang->line('is_required'),
						'currency' => $this->lang->line('registration_fee_validation'),
						'max_length' => $this->lang->line('registration_fee').' '.$this->lang->line('max_length')),
				);
			}
            if ($this->input->post('other_fee','') !="") {
				$this->form_validation->set_rules('other_fee', $this->lang->line('other_fee'), 'trim|required|max_length[15]|callback_currency',
						array('required' => $this->lang->line('fee').' '.$this->lang->line('is_required'),
						'currency' => $this->lang->line('other_fee_validation'),
						'max_length' => $this->lang->line('other_fee').' '.$this->lang->line('max_length')),
				);
		    }
            if ($this->input->post('discount','') !="") {
				$this->form_validation->set_rules('discount', $this->lang->line('discount'), 'trim|required|max_length[15]|callback_currency',
						array('required' => $this->lang->line('discount').' '.$this->lang->line('is_required'),
						'currency' => $this->lang->line('discount_validation'),
						'max_length' => $this->lang->line('other_fee').' '.$this->lang->line('max_length')),
				);
			}
            
            
            $this->form_validation->set_rules('start_date', $this->lang->line('start_date'), 'trim|required|max_length[15]|callback_validate_date',
						array('required' => $this->lang->line('start_date').' '.$this->lang->line('is_required'),
						'validate_date' => $this->lang->line('start_date').' '.$this->lang->line('invalid_date'),
						'max_length' => $this->lang->line('start_date').' '.$this->lang->line('max_length')),
		    );
		    
		    if(intval($id) > 0) {
				$this->form_validation->set_rules('end_date', $this->lang->line('end_date'), 'trim|required|max_length[15]|callback_validate_date',
							array('required' => $this->lang->line('end_date').' '.$this->lang->line('is_required'),
							'validate_date' => $this->lang->line('end_date').' '.$this->lang->line('invalid_date'),
							'max_length' => $this->lang->line('end_date').' '.$this->lang->line('max_length')),
				);		    
		    }
            
						
            if (!($this->form_validation->run() == FALSE))
            {
				
				$fee = floatval($this->input->post('fee','0.00'));
				$reg_fee = floatval($this->input->post('registration_fee','0.00'));
				$other_fee = floatval($this->input->post('other_fee','0.00'));
				$discount = floatval($this->input->post('discount','0.00'));
				
				$total = $fee + $reg_fee + $other_fee;
				
				if ($total > $discount) {
					$payamount = $total - $discount;
				} else {
					$payamount = 0;
				}
				
				//get membership name
				$membershipname =  '';
				$membership_name = $this->membership->getMembership($this->input->post('membership_id'), $_SESSION['branch'], $_SESSION['gym']);
				if ( isset($membership_name['status']) && $membership_name['status'] == 1) {
					$membershipname = $membership_name['data']['name'];
				} else {
					die('you are not authorised to access this link');
				}
				//get member name
				$membername = '';
				$member_name = $this->member->getMember($this->input->post('member_id'), $_SESSION['branch'], $_SESSION['gym']);
				if ( isset($member_name['status']) && $member_name['status'] == 1) {
					$membername = $member_name['data']['first_name'].' '.$member_name['data']['last_name'];
				} else {
					die('you are not authorised to access this link');
				}
				
				
				if ($id > 0 ) {
					$edate = $this->formatDate($this->input->post('end_date'));
			    } else {
					$edate = date('Y-m-d', strtotime("+".$membership_name['data']['duration']." ".$membership_name['data']['duration_type'], strtotime($this->formatDate($this->input->post('start_date')))));
				}
				
				$data = ['member_id' => $this->input->post('member_id'),
					'membership_id' => $this->input->post('membership_id'),
					'member_name' => $membername,
					'membership_name' => $membershipname,
					'fee' => $fee,
					'registration_fee' => $reg_fee,
					'other_fee' => $other_fee,
					'total' => $total,
					'discount' => $discount,
					'amount_to_paid' => $payamount,
					'amount_due' => $payamount,
					'start_date' => $this->formatDate($this->input->post('start_date')),
					'end_date' => $edate,
					'notes' => $this->input->post('notes'),
					'gym' => $_SESSION['gym'],
					'branch' => $_SESSION['branch']		
				];	
							
				if ($id == 0) {
					$data['created_at'] = date('Y-m-d H:i:s');
					$data['status'] = 'active';
					$data['next_payment'] = 'no_payment_received';
					$_SESSION['success'] = $this->lang->line('subscription').' '.$this->lang->line('add_success');	
					$this->subscription->insert($data);
				} else {
					$this->subscription->update($data, $id, $_SESSION['gym'], $_SESSION['branch']);
					$_SESSION['success'] = $this->lang->line('subscription').' '.$this->lang->line('update_success');	
				}
				redirect(site_url('list-subscriptions'));
			}   
		}
		
		if ($id > 0) {
			$meta_title = $this->lang->line('update');
		} else {
			$meta_title = $this->lang->line('add');
		}
		$meta_title .= ' '.$this->lang->line('subscription');
		$dynamic_js = "";
		$view = $this->load->view('subscription_add',['data' => $data,'memberships' => $memberships,'members' => $members ,'id' => $id],true);
		$this->load->view('layout',['view' => $view, 'dynamic_js' => $dynamic_js, 'meta_title' => $meta_title]);	
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
		
		$this->load->model('Membership_model','membership');
        $this->load->model('Member_model','member');
		$memberships = $this->membership->getAll($_SESSION['branch'], $_SESSION['gym']);
        $members = $this->member->getAll($_SESSION['branch'], $_SESSION['gym']);
        
		$this->subscription_list_menu = 'active';
		$this->load->library("pagination");
		$this->load->model('Subscription_model','subscription');
		$config = array();
        $config["base_url"] = site_url('list-subscriptions');
        $config["total_rows"] = $this->subscription->get_count($_GET, $_SESSION['branch'], $_SESSION['gym']);
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
        $data['subscriptions'] = $this->subscription->getSubscriptions($config["per_page"], $page, $_GET, $_SESSION['branch'], $_SESSION['gym']);
		$view = $this->load->view('subscription_list',['data' => $data,'members' => $members, 'memberships' => $memberships,'total' => $config["total_rows"]],true);
		$this->load->view('layout',['view' => $view, 'meta_title' => $this->lang->line('subscriptions')]);		
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
		$this->load->model('Subscription_model','subscription');
		$result = $this->subscription->getSubscription($id, $_SESSION['branch'], $_SESSION['gym']);
		if ($result['status'] == 0) {
			die('you are not authorised to access this link');
		} else {
			$data = $result['data'];
		}
		
		$meta_title = $this->lang->line('view').' '.$this->lang->line('subscription');
		$view = $this->load->view('subscription_view', ['data' => $data, 'id' => $id], true);
		$this->load->view('layout',['view' => $view, 'meta_title' => $meta_title]);	
	
	}


	
	
	
	
}
