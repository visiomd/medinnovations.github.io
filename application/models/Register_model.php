<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends MY_Model {
    public function __construct() 
    {
    	parent::__construct();
    	$this->table = 'users';
    }

    public function verify_user($email) {
        $this->db->where("email", $email);
        $query = $this->db->get($this->table);
		if($query->num_rows() > 0) {
			return $query->row();
		}
		else {
            return false;
		}
    }
}
