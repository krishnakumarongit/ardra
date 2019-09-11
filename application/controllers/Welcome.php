<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function login()
	{
		$this->load->helper(array('form'));
        $this->load->library('form_validation');
        $this->lang->load('main', 'english');
					
        if ($this->input->post('post_check',0)) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email',
					array('required' => $this->lang->line('email_required')),
					array('valid_email' => $this->lang->line('invalid_email')),
            );
            $this->form_validation->set_rules('password', 'Password', 'required',
                        array('required' => $this->lang->line('password_required'))
                );
			if (!($this->form_validation->run() == FALSE))
            {
				//make login check
				$this->load->model('User_model','user');
				$result = $this->user->check_login($this->input->post('email'), $this->input->post('password'));
	
				if(is_array($result) && count($result) > 0) {
					if (isset($result[0])) {
						if (isset($result[0]->id) && $result[0]->id > 0) {
						  $_SESSION['user_id'] = $result[0]->id;
						  $_SESSION['gym'] = $result[0]->gym;	
						  $_SESSION['success'] = $this->lang->line('login_success');				
						  redirect(site_url('dashboard'));
					    }
				    }
				    $_SESSION['error'] = $this->lang->line('login_failed');			
					redirect(site_url('login'));
				} else {
					$_SESSION['error'] = $this->lang->line('login_failed');			
					redirect(site_url('login'));
				}
				
			}
		}
		$js = '<script src="'.site_url('theme/js/login.js').'"></script>';
		$this->load->view('login',['js' => $js]);
	}
	
	public function logout()
	{
		$this->lang->load('main', 'english');
		unset($_SESSION['user_id']);
		unset($_SESSION['gym']);
		$_SESSION['success'] = $this->lang->line('logout_message');			
		redirect(site_url('login'));
		
	}
	
	
}
