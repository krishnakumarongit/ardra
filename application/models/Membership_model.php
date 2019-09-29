<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membership_model extends CI_Model {

        public function insert($data)
        {
            $this->db->insert('memberships', $data);
        }
        
        public function update($data, $id)
        {
			$this->db->where('id', $id);
            $this->db->update('memberships', $data);
        }
        
        public function getMembership($id, $branch_id, $gym_id)
        {
			$this->db->where('id', $id);
			$this->db->where('gym', $gym_id);
			$this->db->where('branch', $branch_id);
			$q = $this->db->get('memberships');
			$data = $q->result_array();
            if (isset($data[0]) && count($data[0]) > 0) {
				return ['status' => 1, 'data' => $data[0]];
			} else {
				return ['status' => 0];
			}
        }
        
        public function getAll($branch_id, $gym_id)
        {
			$this->db->where('gym', $gym_id);
			$this->db->where('branch', $branch_id);
			$this->db->where('status', 'active');
			
			$q = $this->db->get('memberships');
			$data = $q->result_array();
            return $data;
        }
        
        
        public function getMembershipById($id, $branch_id, $gym_id)
        {
			$this->db->where('name', $id);
			$this->db->where('gym', $gym_id);
			$this->db->where('branch', $branch_id);
			$q = $this->db->get('memberships');
			$data = $q->result_array();
            if (isset($data[0]) && count($data[0]) > 0) {
				return ['status' => 1, 'data' => $data[0]];
			} else {
				return ['status' => 0];
			}
        }
        
        public function getMemberships($limit, $start, $get, $branch_id, $gym_id) 
        {
			 $where = ' gym ='.$gym_id.' AND branch ='.$branch_id.' ';
			
			 if (isset($get['name']) && $get['name'] !="" ) {
				$where .= ' and name LIKE "%'.$get['name'].'%"';
			 }
             $query = $this->db->query('select * from memberships WHERE '.$where.' LIMIT '.$start.','.$limit);
             return $query->result();		
		}
		
		public function get_count($get, $branch_id, $gym_id) {
			 $where = ' gym ='.$gym_id.' AND branch ='.$branch_id;
			
			 if (isset($get['name']) && $get['name'] !="" ) {
				$where .= ' and name LIKE "%'.$get['name'].'%" ';
			 }
			 $query = $this->db->query('select * from memberships WHERE '.$where);
			 return $query->num_rows();
            
        } 
        
        public function delete($id, $branch, $gym){
			$this->db->where('gym', $gym);
			$this->db->where('branch', $branch);
			$this->db->where('id', $id);
			$this->db->delete('memberships');
		}

}
