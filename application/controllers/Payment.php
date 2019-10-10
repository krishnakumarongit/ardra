<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Controller {
	
	public $payment_menu, $payment_add_menu, $payment_list_menu;
    public function __construct()
	{
		parent::__construct();
		$this->payment_menu = 'active';
		$this->payment_add_menu = ''; 
		$this->payment_list_menu = '';
		
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
        $subs_drop = '';
        
        if($id == 0) {
			$data = ['subscription' => '','user' => '','balance' => 0,'amount' => '0.00','duration_type' => '','payment_source' => '',
			'note' => '', 'created_at' => '', 'remaining_amount' => '0.00','payment_required' => '','more_payment' => '','next_payment' => '', 'payment_date' => '', 'transaction_id' => ''];
	    } else {
			$result = $this->payment->getPayment($id, $_SESSION['branch'], $_SESSION['gym']);
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
            
            $this->form_validation->set_rules('subscription', $this->lang->line('subscription'), 'trim|required',
					array('required' => $this->lang->line('subscription').' '.$this->lang->line('is_required')),
            );
            $this->form_validation->set_rules('amount', $this->lang->line('payment_amount'), 'trim|required|max_length[15]|callback_currency',
					array('required' => $this->lang->line('payment_amount').' '.$this->lang->line('is_required'),
					'currency' => $this->lang->line('payment_amount_validation'),
					'max_length' => $this->lang->line('payment_amount').' '.$this->lang->line('max_length')),
            );    
                 
            if ($this->input->post('payment_source','') !="") {
				$this->form_validation->set_rules('payment_source', $this->lang->line('source'), 'trim|required',
						array('required' => $this->lang->line('source').' '.$this->lang->line('is_required'),
						'max_length' => $this->lang->line('source').' '.$this->lang->line('max_length')),
				);
			}
			
			if ($this->input->post('transaction_id','') !="") {
				$this->form_validation->set_rules('transaction_id', $this->lang->line('transaction_id'), 'trim|required',
						array('required' => $this->lang->line('transaction_id').' '.$this->lang->line('is_required')),
				);
			}
			
			if ($this->input->post('note','') !="") {
				$this->form_validation->set_rules('note', $this->lang->line('note'), 'trim|required|max_length[15]',
						array('required' => $this->lang->line('note').' '.$this->lang->line('is_required'),
						'max_length' => $this->lang->line('note').' '.$this->lang->line('max_length')),
				);
			}
	           
            $this->form_validation->set_rules('payment_date', $this->lang->line('payment_date'), 'trim|required|max_length[15]|callback_validate_date',
						array('required' => $this->lang->line('payment_date').' '.$this->lang->line('is_required'),
						'validate_date' => $this->lang->line('payment_date').' '.$this->lang->line('invalid_date'),
						'max_length' => $this->lang->line('payment_date').' '.$this->lang->line('max_length')),
		    );
		    
		    if ($this->input->post('payment_required','no') == 'yes') {
				$this->form_validation->set_rules('next_payment', $this->lang->line('next_payment'), 'trim|required|max_length[15]|callback_validate_date',
							array('required' => $this->lang->line('next_payment').' '.$this->lang->line('is_required'),
							'validate_date' => $this->lang->line('next_payment').' '.$this->lang->line('invalid_date'),
							'max_length' => $this->lang->line('next_payment').' '.$this->lang->line('max_length')),
				);
			}
		    
		    
		    if ($this->input->post('member_id',0) > 0) {
				$sub_data = $this->viewsubscription($this->input->post('member_id',0),1);
				$sel_id = $this->input->post('subscription',0);
				if ($sub_data['status'] == 1) {
					$result_option = '';
					if (count($sub_data['data']) > 0) {
						foreach ($sub_data['data'] as $row => $val) {
							if ($sel_id == $val['id']) {
								$chk = 'selected';
							} else {
								$chk = '';
							}
							$result_option .= '<option '.$chk.' value="'.$val['id'].'">'.$val['membership_name'].' '.$this->lang->line('subscribed_on').' ['.date("d/M/Y", strtotime($val['start_date'])).']</option>';
						}
					}
					$subs_drop = $result_option;
				}
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
					$this->subscription->update($data, $id);
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
		
		$meta_title .= ' '.$this->lang->line('payment');
		$view = $this->load->view('payment_add',['data' => $data,'subdrop' => $subs_drop,'memberships' => $memberships,'members' => $members ,'id' => $id],true);
		$this->load->view('layout',['view' => $view, 'meta_title' => $meta_title]);	
		
	}
	
	
	
	function format_date($str)
	{

		$test_date = $str;
		$test_arr  = explode('/', $test_date);
		if (count($test_arr) == 3) {
			return $test_arr[2].'-'.$test_arr[2].'-'.$test_arr[0];
		} else {
		   return '';
		}
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
			if ($str == '0.00') {
				return FALSE;
			} else {
				return TRUE;
			}
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
	
	function viewsubscription($id, $internal ='') {
		$data = array();
		$this->load->model('Subscription_model','subscripion');
		$result = $this->subscripion->getSubscriptionByMember($id, $_SESSION['branch'], $_SESSION['gym']);
		if ($result['status'] == 0) {
			$data = array('status'=> 0);
		} else {
			$result_option = '<option value="">'.$this->lang->line('select').'</option>';
			if (count($result['data']) > 0) {
				foreach ($result['data'] as $row => $val) {
					$result_option .= '<option value="'.$val['id'].'">'.$val['membership_name'].' '.$this->lang->line('subscribed_on').' ['.date("d/M/Y", strtotime($val['start_date'])).']</option>';
				}
		    }
			$data = array('status'=> 1, 'data' => $result_option);
		}
		if ($internal == 1) {
			return $result;
		} else {
			echo json_encode($data);
			exit;
		}
	}
	
	function balanceSubscription($id) {
		$data = array();
		$this->load->model('Subscription_model','subscripion');
		$result = $this->subscripion->getSubscription($id, $_SESSION['branch'], $_SESSION['gym']);
		

		if ($result['status'] == 0) {
			$data = array('status'=> 0);
		} else {
			$data = array('status'=> 1, 'data' => $result['data']['amount_due']);
		}
		echo json_encode($data);
		exit;
	}


	
	
	
	
}
