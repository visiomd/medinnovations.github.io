<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments_model extends MY_Model {
    public function __construct() 
    {
    	parent::__construct();
    	$this->table = 'payments';
    }
    public function getFinishedPayments()
    {
    	  $q = $this->db->select('id')
                      ->order_by("id", "desc")
                      ->where("cost = paid")
                      ->get($this->table)
                      ->result_array();
           return $q;
    }

   

}
