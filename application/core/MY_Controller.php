<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
  public $gym_id, $language, $currency, $theme;
  public function __construct()
  {
    parent::__construct(); 
    // Your own constructor code
		if (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0) {
			$this->load->model('Gym_settings_model','settings');
			//get gym settings
			$result = $this->settings->get_settings($_SESSION['gym']);
			if (count($result) > 0) {
				if (isset($result[0]->id) && $result[0]->id > 0 ) {
					$this->language = $result[0]->language;
					$this->currency = $result[0]->currency;
					$this->theme = $result[0]->theme;
					
				} else {
					$_SESSION['error'] = $this->lang->line('login_to_continue');	
		            redirect(site_url('login'));
				}
			} else {
				$_SESSION['error'] = $this->lang->line('login_to_continue');	
		        redirect(site_url('login'));
			}
		} else {
		  $_SESSION['error'] = $this->lang->line('login_to_continue');	
		  redirect(site_url('login'));
		}
		if (isset($this->language) && $this->language !="") {
		   $this->lang->load('main', $this->language);
		}else {	
		   $this->lang->load('main', 'english');
	    }
  }
}
