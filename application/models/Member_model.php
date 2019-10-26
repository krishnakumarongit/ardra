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
        
        public function getAll($branch_id, $gym_id)
        {
			$this->db->where('gym_id', $gym_id);
			$this->db->where('branch', $branch_id);
			$this->db->where('status', 'active');
			
			$q = $this->db->get('members');
			$data = $q->result_array();
            return $data;
        }
        
        
        public function getMember($id, $branch_id, $gym_id)
        {
			$this->db->where('id', $id);
			$this->db->where('gym_id', $gym_id);
			$this->db->where('branch', $branch_id);
			$q = $this->db->get('members');
			$data = $q->result_array();
            if (isset($data[0]) && count($data[0]) > 0) {
				return ['status' => 1, 'data' => $data[0]];
			} else {
				return ['status' => 0];
			}
        }
        
        public function getMemberById($id, $branch_id, $gym_id)
        {
			$this->db->where('member_id', $id);
			$this->db->where('gym_id', $gym_id);
			$this->db->where('branch', $branch_id);
			$q = $this->db->get('members');
			$data = $q->result_array();
            if (isset($data[0]) && count($data[0]) > 0) {
				return ['status' => 1, 'data' => $data[0]];
			} else {
				return ['status' => 0];
			}
        }
        
        public function getMembers($limit, $start, $get, $branch_id, $gym_id) 
        {
			 $where = ' gym_id ='.$gym_id.' AND branch ='.$branch_id.' ';
			 if (isset($get['member_id']) && $get['member_id'] !="" ) {
				$where .= ' and member_id ="'.$get['member_id'].'"';
			 }
			 if (isset($get['name']) && $get['name'] !="" ) {
				$where .= ' and ( first_name LIKE "%'.$get['name'].'%" OR last_name LIKE "%'.$get['name'].'%")';
			 }
             $query = $this->db->query('select id, member_id,first_name,last_name,middle_name,dob,sex,created_at  from members WHERE '.$where.' LIMIT '.$start.','.$limit);
             return $query->result();		
		}
		
		public function get_count($get, $branch_id, $gym_id) {
			 $where = ' gym_id ='.$gym_id.' AND branch ='.$branch_id;
			 if (isset($get['member_id']) && $get['member_id'] !="" ) {
				$where .= ' and member_id ="'.$get['member_id'].'"';
			 }
			 if (isset($get['name']) && $get['name'] !="" ) {
				$where .= ' and ( first_name LIKE "%'.$get['name'].'%" OR last_name LIKE "%'.$get['name'].'%")';
			 }
			 $query = $this->db->query('select id, member_id, first_name, last_name, middle_name,dob,sex,created_at  from members WHERE '.$where);
			 return $query->num_rows();
            
        }
        
         public function getMemberId($branch_id, $gym_id) {
			$query = $this->db->query('SELECT id FROM members where gym_id ='.$gym_id.' and branch='.$branch_id);
			return $query->num_rows() + 1;	
		}
  

}
