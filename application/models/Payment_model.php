<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model {

        public function insert($data)
        {
            $this->db->insert('payments', $data);
        }
        
        public function update($data, $id, $gym, $branch)
        {
			$this->db->where('gym', $gym);
			$this->db->where('branch', $branch);
			$this->db->where('id', $id);
            $this->db->update('payments', $data);
        }
        
        public function getTotalPayment($id, $gym, $branch)
        {
			$this->db->select('SUM(amount) AS amount', FALSE);
			$this->db->where('gym', $gym);
			$this->db->where('branch', $branch);
			$this->db->where('subscription', $id);
            $q = $this->db->get('payments');
            $data = $q->result_array();
            if (isset($data[0]) && count($data[0]) > 0) {
				return ['status' => 1, 'data' => $data[0]];
			} else {
				return ['status' => 0];
			}	
		}
		
		public function getCount($gym, $branch){
			$this->db->select('count(id) AS amount', FALSE);
			$this->db->where('gym', $gym);
			$this->db->where('branch', $branch);
            $q = $this->db->get('payments');
            $data = $q->result_array();
            if (isset($data[0]) && count($data[0]) > 0) {
				return ($data[0]['amount']+1);
			} else {
				return 1;
			}	
		}
        
        public function getPayment($id, $branch_id, $gym_id)
        {
			$this->db->where('id', $id);
			$this->db->where('gym', $gym_id);
			$this->db->where('branch', $branch_id);
			$q = $this->db->get('payments');
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
			$q = $this->db->get('payments');
			$data = $q->result_array();
            return $data;
        }
        
        
        public function getSubscriptionById($id, $branch_id, $gym_id)
        {
			$this->db->where('name', $id);
			$this->db->where('gym', $gym_id);
			$this->db->where('branch', $branch_id);
			$q = $this->db->get('payments');
			$data = $q->result_array();
            if (isset($data[0]) && count($data[0]) > 0) {
				return ['status' => 1, 'data' => $data[0]];
			} else {
				return ['status' => 0];
			}
        }
        
        public function getSubscriptions($limit, $start, $get, $branch_id, $gym_id) 
        {
			 $where = ' gym ='.$gym_id.' AND branch ='.$branch_id.' ';
			
			 if (isset($get['member_id']) && $get['member_id'] !="" ) {
				$where .= ' and member_id ='.$get['member_id'].' ';
			 }
			 
			 if (isset($get['membership_id']) && $get['membership_id'] !="" ) {
				$where .= ' and membership_id ='.$get['membership_id'].' ';
			 }
			 
			 if (isset($get['status']) && $get['status'] !="" ) {
				$where .= ' and next_payment ="'.$get['status'].'" ';
			 }
			 
             $query = $this->db->query('select * from payments WHERE '.$where.' LIMIT '.$start.','.$limit);
             return $query->result();		
		}
		
		public function get_count($get, $branch_id, $gym_id) {
			 $where = ' gym ='.$gym_id.' AND branch ='.$branch_id;
			
			 if (isset($get['member_id']) && $get['member_id'] !="" ) {
				$where .= ' and member_id ='.$get['member_id'].' ';
			 }
			 
			 if (isset($get['membership_id']) && $get['membership_id'] !="" ) {
				$where .= ' and membership_id ='.$get['membership_id'].' ';
			 }
			 
			 if (isset($get['status']) && $get['status'] !="" ) {
				$where .= ' and next_payment ="'.$get['status'].'" ';
			 }
			 
			 $query = $this->db->query('select * from payments WHERE '.$where);
			 return $query->num_rows();
            
        } 
        
        public function delete($id, $branch, $gym){
			$this->db->where('gym', $gym);
			$this->db->where('branch', $branch);
			$this->db->where('id', $id);
			$this->db->delete('payments');
		}

}
