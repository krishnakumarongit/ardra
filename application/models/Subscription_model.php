<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription_model extends CI_Model {

        public function insert($data)
        {
            $this->db->insert('subscriptions', $data);
        }
        
        public function update($data, $id, $branch_id, $gym_id)
        {
			$this->db->where('id', $id);
			$this->db->where('gym', $gym_id);
			$this->db->where('branch', $branch_id);
            $this->db->update('subscriptions', $data);
        }
        
        public function getSubscription($id, $branch_id, $gym_id)
        {
			$this->db->where('id', $id);
			$this->db->where('gym', $gym_id);
			$this->db->where('branch', $branch_id);
			$q = $this->db->get('subscriptions');
			$data = $q->result_array();
            if (isset($data[0]) && count($data[0]) > 0) {
				return ['status' => 1, 'data' => $data[0]];
			} else {
				return ['status' => 0];
			}
        }
        
        
        public function getSubscriptionByMember($id, $branch_id, $gym_id) 
        {
		    $this->db->where('member_id', $id);
		    $this->db->where('further_payment_required', 'yes');
			$this->db->where('gym', $gym_id);
			$this->db->where('branch', $branch_id);
			$q = $this->db->get('subscriptions');
			$data = $q->result_array();
            if (isset($data[0]) && count($data[0]) > 0) {
				return ['status' => 1, 'data' => $data];
			} else {
				return ['status' => 0];
			}
		
		}
        
        public function getAll($branch_id, $gym_id)
        {
			$this->db->where('gym', $gym_id);
			$this->db->where('branch', $branch_id);
			$this->db->where('status', 'active');
			$q = $this->db->get('subscriptions');
			$data = $q->result_array();
            return $data;
        }
        
        
        public function getSubscriptionById($id, $branch_id, $gym_id)
        {
			$this->db->where('name', $id);
			$this->db->where('gym', $gym_id);
			$this->db->where('branch', $branch_id);
			$q = $this->db->get('subscriptions');
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
			 
             $query = $this->db->query('select * from subscriptions WHERE deleted = 0 and '.$where.' LIMIT '.$start.','.$limit);
             return $query->result();		
		}
		
		public function get_count($get, $branch_id, $gym_id) 
		{
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
			 
			 $query = $this->db->query('select * from subscriptions WHERE deleted = 0 and '.$where);
			 return $query->num_rows();
            
        } 
        
        public function delete($id, $branch, $gym)
        {
			$this->db->where('gym', $gym);
			$this->db->where('branch', $branch);
			$this->db->where('id', $id);
			$this->db->update('subscriptions', array('deleted' => 1));
		}
		
		
		 public function getDueSubscriptions($limit, $start, $get, $branch_id, $gym_id) 
        {
			 $where = ' gym ='.$gym_id.' AND branch ='.$branch_id.' ';
			
			 if (isset($get['member_id']) && $get['member_id'] !="" ) {
				$where .= ' and member_id ='.$get['member_id'].' ';
			 }
			 
			 if (isset($get['membership_id']) && $get['membership_id'] !="" ) {
				$where .= ' and membership_id ='.$get['membership_id'].' ';
			 }
			 		 
			 if ((isset($get['date_from']) && $get['date_from'] !="") &&  (isset($get['date_to']) && $get['date_to'] !="" )) {
			      $where .= ' and next_payment  BETWEEN "'.$this->formatDate($get['date_from']).'" AND "'.$this->formatDate($get['date_to']).'" ';
			 } else{
			 
				 if (isset($get['date_from']) && $get['date_from'] !="" ) {
					$where .= ' and next_payment >="'.$this->formatDate($get['date_from']).'" ';
				 }
				 
				 if (isset($get['date_to']) && $get['date_to'] !="" ) {
					$where .= ' and next_payment <="'.$this->formatDate($get['date_to']).'" ';
				 }
		     }
			 
             $query = $this->db->query('select * from subscriptions WHERE deleted = 0 and due ="yes" and '.$where.' order by next_payment ASC LIMIT '.$start.','.$limit);
             return $query->result();		
		}
		
		public function get_due_count($get, $branch_id, $gym_id) 
		{
			 $where = ' gym ='.$gym_id.' AND branch ='.$branch_id;
			
			 if (isset($get['member_id']) && $get['member_id'] !="" ) {
				$where .= ' and member_id ='.$get['member_id'].' ';
			 }
			 
			 if (isset($get['membership_id']) && $get['membership_id'] !="" ) {
				$where .= ' and membership_id ='.$get['membership_id'].' ';
			 }
			 
			 if ((isset($get['date_from']) && $get['date_from'] !="") &&  (isset($get['date_to']) && $get['date_to'] !="" )) {
			      $where .= ' and next_payment  BETWEEN "'.$this->formatDate($get['date_from']).'" AND "'.$this->formatDate($get['date_to']).'" ';
			 } else{
				 if (isset($get['date_from']) && $get['date_from'] !="" ) {
					$where .= ' and next_payment >="'.$this->formatDate($get['date_from']).'" ';
				 }
				 
				 if (isset($get['date_to']) && $get['date_to'] !="" ) {
					$where .= ' and next_payment <="'.$this->formatDate($get['date_to']).'" ';
				 }
		     }
			 
			 $query = $this->db->query('select * from subscriptions WHERE deleted = 0 and due ="yes" and '.$where);
			 return $query->num_rows();
            
        } 
        
        function formatDate($str)
	    {
			$test_date = $str;
			$test_arr  = explode('/', $test_date);
			return $test_arr[2].'-'.$test_arr[1].'-'.$test_arr[0];
	    }

}
