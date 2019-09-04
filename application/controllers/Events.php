<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends MY_Controller {
	
    public function __construct() 
    {
        parent::__construct();
    }
    public function index($lang = '') 
    {
        header('Access-Control-Allow-Origin: http://medinnovations.ru', false);
        $this->load->model('events_model');
        $events = $this->events_model->index();
        header('Content-Type: application/json');
        echo json_encode($events);
    }
}