<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller {
	
    public function __construct()
	{
		parent::__construct();
		
	}

	public function add($id = 0)
	{
		$this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->load->model('Country_model','country');
        $this->load->model('Member_model','member');
        
        if($id == 0) {
			$maxId = $this->member->getMemberId();
			$data = ['first_name' => '','last_name' => '','sex' => '','dob' => '','member_id' => $maxId,
			'email' => '','address' => '','city' => '','state' => '','country' => '','zip_code' => '',
			'home_phone' => '','work_phone' => '','idcard' => '','lisence' => '','emmergency_contact_name' => '',
			'emmergency_contact_number' => '',
			'source' => '','source_note' => '','disability' => '','disability_note' => '','middle_name' => ''];
	    } else {
			$result = $this->member->getMember($id);
			if ($result['status'] == 0) {
				die('you are not authorised to access this link');
			} else {
				$data = $result['data'];
				$data['dob'] = date('d/m/Y', strtotime($data['dob']));
			}
		}
        $country = $this->country->getCountries();
        
		if ($this->input->post('post_check',0)) {
			
            $this->form_validation->set_rules('first_name', $this->lang->line('first_name'), 'trim|required|max_length[25]',
					array('required' => $this->lang->line('first_name').' '.$this->lang->line('is_required'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s'),
            );
            $this->form_validation->set_rules('last_name', $this->lang->line('last_name'), 'trim|required|max_length[25]',
					array('required' => $this->lang->line('last_name').' '.$this->lang->line('is_required'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s'),
            );
            $this->form_validation->set_rules('sex', $this->lang->line('sex'), 'trim|required|max_length[5]',
					array('required' => $this->lang->line('sex').' '.$this->lang->line('is_required'),
					'max_length' => $this->lang->line('sex').' '.$this->lang->line('max_length')),
            );
            
            $this->form_validation->set_rules('dob', $this->lang->line('dob'), 'trim|required|max_length[12]|callback_validate_date',
					array('required' => $this->lang->line('dob').' '.$this->lang->line('is_required'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s ',
					'validate_date' => ' %s '.$this->lang->line('invalid_date').''),
            );
            
            if ($id == 0) {
                $this->form_validation->set_rules('member_id', $this->lang->line('member_id'), 'trim|required|max_length[255]|is_unique[members.member_id]',
						array('required' => $this->lang->line('member_id').' '.$this->lang->line('is_required'),
						'is_unique' => $this->lang->line('member_id').' '.$this->lang->line('id_unique'),
						'max_length' => $this->lang->line('member_id').' '.$this->lang->line('max_length').'255'),
						
				);
			} else {
				if ($this->input->post('member_id') !=  $data['member_id']) {
					$this->form_validation->set_rules('member_id', $this->lang->line('member_id'), 'trim|required|max_length[255]|is_unique[members.member_id]',
						array('required' => $this->lang->line('member_id').' '.$this->lang->line('is_required'),
						'is_unique' => $this->lang->line('member_id').' '.$this->lang->line('id_unique'),
						'max_length' => $this->lang->line('member_id').' '.$this->lang->line('max_length').'255'),	
				    );	
				}
			}
            
            if ($this->input->post('email')!= "") {
			   $this->form_validation->set_rules('email', $this->lang->line('email'), 'trim|required|max_length[150]|valid_email',
					array('required' => $this->lang->line('email').' '.$this->lang->line('is_required'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s ',
					'valid_email' => $this->lang->line('invalid_email')),
               );
			}
			
			if ($this->input->post('address') != "") {
			   $this->form_validation->set_rules('address', $this->lang->line('address'), 'trim|required|max_length[255]',
					array('required' => $this->lang->line('address').' '.$this->lang->line('is_required'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s'),
               );
			}
			
			if ($this->input->post('city') != "") {
			   $this->form_validation->set_rules('city', $this->lang->line('city'), 'trim|required|max_length[25]',
					array('required' => $this->lang->line('city').' '.$this->lang->line('is_required'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s '),
               );
			}
			
			if ($this->input->post('state') != "") {
			   $this->form_validation->set_rules('state', $this->lang->line('state'), 'trim|required|max_length[25]',
					array('required' => $this->lang->line('state').' '.$this->lang->line('is_required'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s '),
               );
			}
			
			if ($this->input->post('zip_code') != "") {
			   $this->form_validation->set_rules('zip_code', $this->lang->line('zip_code'), 'trim|required|max_length[15]',
					array('required' => $this->lang->line('zip_code').' '.$this->lang->line('is_required'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s '),
               );
			}
			
			if ($this->input->post('home_phone') != "") {
			   $this->form_validation->set_rules('home_phone', $this->lang->line('home_phone'), 'trim|required|max_length[20]',
					array('required' => $this->lang->line('home_phone').' '.$this->lang->line('is_required'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s'),
               );
			}
			
			if ($this->input->post('work_phone') != "") {
			   $this->form_validation->set_rules('work_phone', $this->lang->line('work_phone'), 'trim|required|max_length[25]',
					array('required' => $this->lang->line('work_phone').' '.$this->lang->line('is_required'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s'),
               );
			}
			
			if ($this->input->post('idcard') != "") {
			   $this->form_validation->set_rules('idcard', $this->lang->line('idcard'), 'trim|required|max_length[25]',
					array('required' => $this->lang->line('idcard').' '.$this->lang->line('is_required'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s'),
               );
			}
			
			if ($this->input->post('lisence') != "") {
			   $this->form_validation->set_rules('lisence', $this->lang->line('lisence'), 'trim|required|max_length[25]',
					array('required' => $this->lang->line('lisence').' '.$this->lang->line('is_required'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s'),
               );
			}
			
			if ($this->input->post('emmergency_contact_name') != "") {
			   $this->form_validation->set_rules('emmergency_contact_name', $this->lang->line('emmergency_contact_name'), 'trim|required|max_length[25]',
					array('required' => $this->lang->line('emmergency_contact_name').' '.$this->lang->line('is_required'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s'),
               );
			}
			
			if ($this->input->post('emergency_contact_number') != "") {
			   $this->form_validation->set_rules('emergency_contact_number', $this->lang->line('emergency_contact_number'), 'trim|required|max_length[25]',
					array('required' => $this->lang->line('emergency_contact_number').' '.$this->lang->line('is_required'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s'),
               );
			}
			
			
			if ($this->input->post('source') != "") {
			   $this->form_validation->set_rules('source', $this->lang->line('source'), 'trim|required|max_length[25]',
					array('required' => $this->lang->line('source').' '.$this->lang->line('is_required'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s'),
               );
			}
			
			
			
			if ($this->input->post('source_note') != "") {
			   $this->form_validation->set_rules('source_note', $this->lang->line('source_note'), 'trim|required|max_length[255]',
					array('required' => $this->lang->line('source_note').' '.$this->lang->line('is_required'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s '),
               );
			}
			
			if ($this->input->post('disability') != "") {
			   $this->form_validation->set_rules('disability', $this->lang->line('disability'), 'trim|required|max_length[25]',
					array('required' => $this->lang->line('disability').' '.$this->lang->line('is_required'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s'),
               );
			}
			
			if ($this->input->post('disability_note') != "") {
			   $this->form_validation->set_rules('disability_note',$this->lang->line('disability_note'), 'trim|required|max_length[255]',
					array('required' => $this->lang->line('disability_note').' '.$this->lang->line('is_required'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s '),
               );
			}
			
			if ($this->input->post('country') != "") {
			   $this->form_validation->set_rules('country', $this->lang->line('country'), 'trim|required|max_length[25]',
					array('required' => $this->lang->line('country').' '.$this->lang->line('is_required'),
					'max_length' => '  %s '.$this->lang->line('max_length').' %s '),
               );
			}
			
			if ($this->input->post('middle_name') != "") {
			   $this->form_validation->set_rules('middle_name', $this->lang->line('middle_name'), 'trim|required|max_length[15]',
					array('required' => $this->lang->line('middle_name').' '.$this->lang->line('is_required'),
					'max_length' => ' %s '.$this->lang->line('max_length').' %s '),
               );
			}
			
			if (!($this->form_validation->run() == FALSE))
            {
				$data = ['first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'sex' => $this->input->post('sex'),
					'dob' => $this->formatDate($this->input->post('dob')),
					'member_id' => $this->input->post('member_id'),
					'email' => $this->input->post('email'),
					'address' => $this->input->post('address'),
					'city' => $this->input->post('city'),
					'state' => $this->input->post('state'),
					'country' => $this->input->post('country'),
					'zip_code' => $this->input->post('zip_code'),
					'home_phone' => $this->input->post('home_phone'),
					'work_phone' => $this->input->post('work_phone'),
					'idcard' => $this->input->post('idcard'),
					'lisence' => $this->input->post('lisence'),
					'emmergency_contact_name' => $this->input->post('emmergency_contact_name'),
					'emmergency_contact_number' => $this->input->post('emmergency_contact_number'),
					'source' => $this->input->post('source'),
					'source_note' => $this->input->post('source_note'),
					'disability' => $this->input->post('disability'),
					'disability_note' => $this->input->post('disability_note'),
					'middle_name' => $this->input->post('middle_name'),
					'gym_id' => 1,
					'branch' => 2,
					'status' => 'Active'					
				];	
				if ($id == 0) {
					$data['created_at'] = date('Y-m-d H:i:s');
					$this->member->insert($data);
				} else {
					$this->member->update($data, $id);
				}
				die('success');
			}   
		}
		$view = $this->load->view('member_add',['data' => $data, 'country' => $country,'id' => $id],true);
		$this->load->view('layout',['view' => $view]);	
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
    
    function formatDate($str)
	{

		$test_date = $str;
		$test_arr  = explode('/', $test_date);
        return $test_arr[2].'-'.$test_arr[1].'-'.$test_arr[0];
		
	}


	
	
	
	
}
