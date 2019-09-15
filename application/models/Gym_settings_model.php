<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gym_settings_model extends CI_Model {

        public function get_settings($id) 
        {
			$query = $this->db->get_where('branch_setting', array('gym_id' => $id, 'master' => 'yes'));
			$result = $query->result();
			return $result;
		}
		
		public function get_branch_settings($id, $gid) 
        {
			$query = $this->db->get_where('branch_setting', array('id' => $id, 'gym_id' => $gid));
			$result = $query->result();
			return $result;
		}

}
