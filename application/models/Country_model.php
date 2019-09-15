<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Country_model extends CI_Model {

        public function getCountries()
        {
                $query = $this->db->get('countries');
                return $query->result();
        }
}
