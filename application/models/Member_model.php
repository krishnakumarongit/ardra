<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model {


        public function insert($data)
        {
            $this->db->insert('members', $data);
        }
        
        public function update($data, $id)
        {
			$this->db->where('id', $id);
            $this->db->update('members', $data);
        }
        
        public function getMember($id)
        {
			$this->db->where('id', $id);
			$q = $this->db->get('members');
			$data = $q->result_array();
            if (isset($data[0]) && count($data[0]) > 0) {
				return ['status' => 1, 'data' => $data[0]];
			} else {
				return ['status' => 0];
			}
        }
        
        public function getMembers($limit, $start, $get) 
        {
			 if (isset($get['member_id']) && $get['member_id'] !="" ) {
				$this->db->where('member_id', $get['member_id']);
			 }
			 if (isset($get['name']) && $get['name'] !="" ) {
				$this->db->where('first_name', $get['name']);
			 }
			 $this->db->limit($limit, $start);
             $query = $this->db->get('members');
             return $query->result();		
		}
		
		public function get_count($get) {
			if (isset($get['member_id']) && $get['member_id'] !="" ) {
				$this->db->where('member_id', $get['member_id']);
			}
			if (isset($get['name']) && $get['name'] !="" ) {
				$this->db->like('first_name', $get['name']);
			}
			return $this->db->get('members');
        }
        
         public function getMemberId() {
			$query = $this->db->query('SELECT id FROM members');
			return $query->num_rows() + 1;	
		}
  

}
