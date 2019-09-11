<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	
    public function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$view = $this->load->view('dashboard',[],true);
		$this->load->view('layout',['view' => $view]);	
	}
	
	public function login()
	{
		$this->load->helper(array('form'));
        $this->load->library('form_validation');
        
					
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
	
	
}
