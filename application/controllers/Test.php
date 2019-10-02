<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test extends MY_Controller {
    private $html = 0;
    private $user = 0;
    private $language = 'russian';
    private $data = 0;

    public function __construct($html, $user, 
                                $language, $data)     
   {
        parent::__construct();
        $this->html = $html;
        $this->user = $user;
        $this->language = $language;
        $this->data = $data;       
    }
    public function _setUser( $key, $val ) {
        $this->user[$key] = $val;
    }
    public function _getUser() {
      return $this->user;
    }
    public function _setData( $key, $val ) {
        $this->data[$key] = $val;
    }
    public function _getData() {
      return $this->data;
    }
    public function index() {

        $this->load->model('tasks_model');
        //$this->load->model('payments_model');
        //$this->load->model('login_model');
        //$this->load->model('t_events_model');

        $payments = $this->payments_model->getFinishedPayments();
        $statuses  = $this->t_events_model->getAllRecordsAscEvents();
       
        $tasksYear = $this->tasks_model->getTasksFilteredByYear();
        $tasksQuarter = $this->tasks_model->getTasksFilteredByQuarter();
        $tasksMonth =  $this->tasks_model->getTasksFilteredByMonth();
        $tasksTotal =  $this->tasks_model->getTasksFiltered1();

        //$test->_setData('all', $payments);
       //print_r($test->_getData());
    }
}
class Test1 extends Test {
    public function index() {
      $test = new Test("111", "111", "111", "111");
    }
}



