<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gym_settings_model extends CI_Model {

        public function get_last_ten_entries()
        {
                $query = $this->db->get('entries', 10);
                return $query->result();
        }

        public function insert_entry()
        {
                $this->title    = $_POST['title']; // please read the below note
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->insert('entries', $this);
        }

        public function update_entry()
        {
                $this->title    = $_POST['title'];
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->update('entries', $this, array('id' => $_POST['id']));
        }
        
        public function get_settings($id) 
        {
			$query = $this->db->get_where('gym_setting', array('gym_id' => $id));
			$result = $query->result();
			return $result;
		}

}
