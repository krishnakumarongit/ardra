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
		$this->payment_add_menu = 'active'; 
		$this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->load->model('Country_model','country');
        $this->load->model('Membership_model','membership');
        $this->load->model('Member_model','member');
        
        $this->load->model('Subscription_model','subscription');
        $this->load->model('Payment_model','payment');
        
        
        
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
				$data['payment_date'] = date('d/m/y',strtotime($data['payment_date']));
				$data['name'] = $data['member_name'];
				$data['payment_source'] = $data['source'];
				$subscription_result = $this->subscription->getSubscription($data['subscription'], $_SESSION['branch'], $_SESSION['gym']);
				if ($subscription_result['status'] == 1) {
				    $data['balance'] = floatval($subscription_result['data']['amount_due']);
				    $data['sub'] = $subscription_result['data']['membership_name']." ".$this->lang->line('subscribed_on')." [".date('d/m/Y',strtotime($subscription_result['data']['start_date']))."]";
				    if ($data['balance'] >= $data['amount']) {
				       $data['remaining_amount'] = $data['balance'];
				    } else {
					   $data['remaining_amount'] = 0;
					}
					
					$data['payment_required'] = $subscription_result['data']['further_payment_required'];
				    if ($data['payment_required'] == 'yes' && $subscription_result['data']['due'] == 'yes') {
						$data['next_payment'] =  date('d/m/y',strtotime($subscription_result['data']['next_payment']));
					} else {
						$data['next_payment'] =  '';
					}
				    
				} else {
					die('you are not authorised to access this link');
				}
				
				
				
				$sub_data = $this->viewsubscription($data['member_id'], 1);
				$sel_id = $data['subscription'];
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
				$this->form_validation->set_rules('note', $this->lang->line('note'), 'trim|required|max_length[255]',
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
				
				$member_id = $this->input->post('member_id');
				$subscription = $this->input->post('subscription');
				$amount = floatval($this->input->post('amount'));
				$payment_source = $this->input->post('payment_source');
				$payment_date = $this->input->post('payment_date');
				$payment_required = $this->input->post('payment_required');
				$payment_next = $this->input->post('next_payment');
				$note = $this->input->post('note');
				
				//get member name
				$membername = '';
				$member_name = $this->member->getMember($this->input->post('member_id'), $_SESSION['branch'], $_SESSION['gym']);
				if ( isset($member_name['status']) && $member_name['status'] == 1) {
					$membername = $member_name['data']['first_name'].' '.$member_name['data']['last_name'];
				} else {
					die('you are not authorised to access this link');
				}
				
				$data = ['subscription' => $subscription,
					'member_id' => $member_id,
					'member_name' => $membername,
					'amount' => $amount,
					'source' => $payment_source,
					'note' => $note,
					'payment_date' => $this->formatDate($payment_date),
					'gym' => $_SESSION['gym'],
					'branch' => $_SESSION['branch']		
				];	
				
				$subscription_result_name = $this->subscription->getSubscription($subscription, $_SESSION['branch'], $_SESSION['gym']);
				if ($subscription_result_name['status'] == 1) {
					$data['subscription_name'] = $subscription_result_name['data']['membership_name'];
				}
							
				if ($id == 0) {
					$data['created_date'] = date('Y-m-d H:i:s');
					$data['transaction_id'] = $this->payment->getCount($_SESSION['gym'], $_SESSION['branch']);
					$_SESSION['success'] = $this->lang->line('payment').' '.$this->lang->line('add_success');	
					$this->payment->insert($data);
				} else {
					$this->payment->update($data, $id, $_SESSION['gym'], $_SESSION['branch']);
					$_SESSION['success'] = $this->lang->line('payment').' '.$this->lang->line('update_success');	
				}
				
				if ($payment_required == 'yes') {
					//update subscription
					$payment_next = $this->formatDate($payment_next);
					$this->subscription->update(array('due' => 'yes', 'further_payment_required' => $payment_required, 'next_payment' => $payment_next), $subscription, $_SESSION['gym'], $_SESSION['branch']);											
				} else {
					//mark subscription as complete
					$this->subscription->update(array('due' => '', 'further_payment_required' => $payment_required, 'next_payment' => 'payment_completed'), $subscription, $_SESSION['gym'], $_SESSION['branch']);
				}
				//update balance
				//get full payments
				$totalPayments = $this->payment->getTotalPayment($subscription, $_SESSION['gym'], $_SESSION['branch']);
				if ($totalPayments['status'] == 1) {
					$total = floatval($totalPayments['data']['amount']);
					$subscription_result = $this->subscription->getSubscription($subscription, $_SESSION['branch'], $_SESSION['gym']);
               		if ($subscription_result['status'] == 1) {
				       $subscription_total = floatval($subscription_result['data']['amount_to_paid']);
				       if ($subscription_total > 0 && $total > 0) {
						   if ($subscription_total >= $total) {
							   $update_amt = $subscription_total - $total;
							   $this->subscription->update(array('amount_due' => $update_amt), $subscription, $_SESSION['gym'], $_SESSION['branch']);
						   }
					   }
				    
				    }	
				}
				redirect(site_url('list-payment'));
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
		$this->payment_list_menu = 'active';
		$this->load->library("pagination");
		$this->load->model('Payment_model','payment');
		$this->load->model('Member_model','member');
		$members = $this->member->getAll($_SESSION['branch'], $_SESSION['gym']);
		$config = array();
        $config["base_url"] = site_url('list-payment');
        $config["total_rows"] = $this->payment->get_count($_GET, $_SESSION['branch'], $_SESSION['gym']);
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
        $data['payments'] = $this->payment->getPayments($config["per_page"], $page, $_GET, $_SESSION['branch'], $_SESSION['gym']);
		$view = $this->load->view('payment_list',['data' => $data,'members' => $members, 'total' => $config["total_rows"]],true);
		$this->load->view('layout',['view' => $view, 'meta_title' => $this->lang->line('payments')]);		
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
