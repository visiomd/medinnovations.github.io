<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks_model extends MY_Model {
    public function __construct() {
    	parent::__construct();
    	$this->table = 'tasks';
    }
    public function getUniqueValues() {
        $q = $this->db->select('*')
                      ->group_by('parent')
                      ->where('parent !=', 'Null')
                      ->order_by('parent', 'ASC')
                      ->get($this->table)
                      ->result_array();
        return $q;
    }
    public function getSeries() {
    	$q = $this->db->select('id, parent')
                    ->where('parent !=', 'Null')
                    ->order_by('id', 'ASC')
        			      ->get($this->table)
        			      ->result_array();
      return $q;
    }
    public function getSeriesOfTask($parentId) {
        $q = $this->db->select('id')
                      ->where('parent', $parentId)
                      ->order_by('id', 'ASC')
                      ->get($this->table)
                      ->result_array();
        return $q;
    }
    public function getLinksForList($idList) {
    $q = $this->db->select('link')
                    ->where_in('id', $idList)
                    ->order_by('id', 'ASC')
                    ->get($this->table)
                    ->result_array();
        return $q;
    }
    public function getTasksFilteredByYear() {

      $allStatuses = ["Исполнено", "Проверка заказа", "Ждут заключения", "Обрабатывается"];

      $q = $this->db->select('*')
                      ->order_by("id", "desc")
                      ->where("customer !=", 'basil137678')
                      ->where("customer !=", 'test_acc')
                      ->where("partial !=" , "Yes")
                      ->like("timeCreated", date('Y'))
                      ->get($this->table)
                      ->result_array();

      $statuses = array_unique(array_column($q, 'status'));

      foreach ($statuses as $key => $s) {
        $response[$s] =  array_count_values(array_column($q, 'status'))[$s];
      }
      foreach ($allStatuses as $key => $s) {
         if (!isset($response[$s])) {
            $response[$s] = 0;
         }
       }

       $response["Заявки"] = $q;
       
       return $response;
    }

    public function getTasksFilteredByQuarter() {
      $current_month = date('m');
      $current_quarter_start = ceil($current_month/4)*3+1; 
      $start_date = date("Y-m-d H:i:s", mktime(0, 0, 0, $current_quarter_start, 1, date('Y') ));
      $end_date = date("Y-m-d H:i:s", mktime(0, 0, 0, $current_quarter_start+3, 1, date('Y') ));

      $allStatuses = ["Исполнено", "Проверка заказа", "Ждут заключения", "Обрабатывается"];

      $q = $this->db->select('*')
                      ->order_by("id", "desc")
                      ->where("customer !=", 'basil137678')
                      ->where("customer !=", 'test_acc')
                      ->where("partial !=" , "Yes")
                      ->where("timeCreated >=", $start_date)
                      ->where("timeCreated <=", $end_date)
                      ->get($this->table)
                      ->result_array();

      $statuses = array_unique(array_column($q, 'status'));

      foreach ($statuses as $key => $s) {
        $response[$s] =  array_count_values(array_column($q, 'status'))[$s];
      }
      foreach ($allStatuses as $key => $s) {
         if (!isset($response[$s])) {
            $response[$s] = 0;
         }
       }

       $response["Заявки"] = $q;

       return $response;
    }
    public function getTasksFilteredByMonth() {

      $allStatuses = ["Исполнено", "Проверка заказа", "Ждут заключения", "Обрабатывается"];

      $q = $this->db->select('*')
                      ->order_by("id", "desc")
                      ->where("customer !=", 'basil137678')
                      ->where("customer !=", 'test_acc')
                      ->where("partial !=" , "Yes")
                      ->like("timeCreated", date('Y-m'))
                      ->get($this->table)
                      ->result_array();

      $statuses = array_unique(array_column($q, 'status'));

      foreach ($statuses as $key => $s) {
        $response[$s] =  array_count_values(array_column($q, 'status'))[$s];
      }
      foreach ($allStatuses as $key => $s) {
         if (!isset($response[$s])) {
            $response[$s] = 0;
         }
       }

       $response["Заявки"] = $q;
       
       return $response;
    }
    public function getTasksFiltered() {
        $allStatuses = ["Исполнено", "Проверка заказа", "Ждут заключения", "Обрабатывается"];

        $q = $this->db->select('*')
                      ->order_by("id", "desc")
                      ->where("customer !=", 'basil137678')
                      ->where("customer !=", 'test_acc')
                      ->where("partial !=" , "Yes")
                      ->where("status !=", Null)
                      ->get($this->table)
                      ->result_array();
        return $q;
    }
     public function getTasksFiltered1() {

        $allStatuses = ["Исполнено", "Проверка заказа", "Ждут заключения", "Обрабатывается"];

        $q = $this->db->select('*')
                      ->order_by("id", "desc")
                      ->where("customer !=", 'basil137678')
                      ->where("customer !=", 'test_acc')
                      ->where("partial !=" , "Yes")
                      ->where("status !=", Null)
                      ->get($this->table)
                      ->result_array();
                      
      $statuses = array_unique(array_column($q, 'status'));

      foreach ($statuses as $key => $s) {
        $response[$s] =  array_count_values(array_column($q, 'status'))[$s];
      }
      foreach ($allStatuses as $key => $s) {
         if (!isset($response[$s])) {
            $response[$s] = 0;
         }
       }

       $response["Заявки"] = $q;
       
       return $response;
    }
    public function getTasksFilteredById($id) {
       $allStatuses = ["Исполнено", "Проверка заказа", "Ждут заключения", "Обрабатывается"];

       $q = $this->db->select('*')
                      ->order_by("id", "desc")
                      ->where("customer !=", 'basil137678')
                      ->where("customer !=", 'test_acc')
                      ->where("partial !=" , "Yes")
                      ->where("id" , $id)
                      ->get($this->table)
                      ->result_array();

      $statuses = array_unique(array_column($q, 'status'));

      foreach ($statuses as $key => $s) {
        $response[$s] =  array_count_values(array_column($q, 'status'))[$s];
      }
      foreach ($allStatuses as $key => $s) {
         if (!isset($response[$s])) {
            $response[$s] = 0;
         }
       }

       $response["Заявки"] = $q;
       
       return $response;
     }
      public function getTasksFilteredByUsername($username) {
       $allStatuses = ["Исполнено", "Проверка заказа", "Ждут заключения", "Обрабатывается"];
        
       $q = $this->db->select('*')
                      ->order_by("id", "desc")
                      ->where("customer !=", 'basil137678')
                      ->where("customer !=", 'test_acc')
                      ->where("partial !=" , "Yes")
                      ->where("customer" , $username)
                      ->get($this->table)
                      ->result_array();
                      
      $statuses = array_unique(array_column($q, 'status'));

      foreach ($statuses as $key => $s) {
        $response[$s] =  array_count_values(array_column($q, 'status'))[$s];
      }
      foreach ($allStatuses as $key => $s) {
         if (!isset($response[$s])) {
            $response[$s] = 0;
         }
       }

       $response["Заявки"] = $q;
       
       return $response;
     }
}
