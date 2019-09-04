<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class t_events_model extends MY_Model {
    public function __construct() 
    {
    	parent::__construct();
    	$this->table = 't_events';
    }
}
