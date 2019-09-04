<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
	public $table;
    public function index() 
	{
	    $query = $this->db->get($this->table);
        return $query->result_array();
	}
    public function getAllRecords($type = null) {
        $q = $this->db->get($this->table);
        if (!isset($type)) {
            return $q->result_array();
        }
        elseif ($type === 'std') {
            return $q->result();
        }
    }
    public function getAllRecordsUpd1() {
        $q = $this->db->get($this->table)
                      ->result_array();  
        return $q;
    }
    public function getAllRecordsDesc() {
        $q = $this->db->select('*')
                ->order_by('id','asc')
                ->get($this->table)
                ->result_array();
        return $q;
    }
    public function getAllRecordsAscEvents() {
        $q = $this->db->select('*')
                ->order_by('eventId','desc')
                ->get($this->table)
                ->result_array();
        return $q;
    }
    public function getTasksFiltered() {
        $q = $this->db->select('*')
                        ->order_by("id", "desc")
                        ->where("customer !=", 'basil137678')
                        ->where("customer !=", 'test_acc')
                        ->where("partial !=" , "Yes")
                        ->get($this->table)
                        ->result_array();
        return $q;
    }
    public function countTasksByStatus($status) {
        $q = $this->db->select('*')
                        ->order_by("id", "desc")
                        ->where("customer !=", 'basil137678')
                        ->where("customer !=", 'test_acc')
                        ->where("partial !=" , "Yes")
			            ->like("status", $status)
                        ->get($this->table)
                        ->num_rows();
        return $q;
    }
    public function getSomeRecords($type = null, $condition) {
        $this->db->order_by("id", "desc");
        $q = $this->db->get_where($this->table, $condition);
        if (!isset($type)) {
            return $q->result_array();
        }
        elseif ($type === 'std') {
            return $q->result();
        }
    }
    public function getSingleRecord($type = null, $condition) {
        $q = $this->db->get_where($this->table, $condition);
        if (!isset($type)) {
            return $q->result_array()[0];
        }
        elseif ($type === 'std') {
            return $q->result();
        }
    }
    public function getLastRecord($id, $value) {
       $q = $this->db->select($value)
                ->where("taskId", $id)
                ->order_by($value,'desc')
                ->limit(1)
                ->get($this->table)
                ->row($value);
        return $q;
    }
	public function indexAscOrder()
	{
            $this->db->from($this->table);
            $this->db->order_by("id", "asc");
            $query = $this->db->get(); 
            return $query->result_array();
	}
    public function indexDescOrder()
    {
            $this->db->from($this->table);
            $this->db->order_by("id", "desc");
            $query = $this->db->get(); 
            return $query->result_array();
    }
    public function indexAscOrderTasks()
    {
            $this->db->from($this->table);
            $this->db->order_by("taskId", "asc");
            $query = $this->db->get(); 
            return $query->result();
    }
	public function distinct($dbField) 
	{
	    $this->db->select($dbField);
        $this->db->distinct();
        $this->db->order_by($dbField, 'ASC');
        $query = $this->db->get($this->table);
        return $query->result_array();
	}
    public function indexDisc($dbField) 
    {
        $this->db->select($dbField); 
        $this->db->distinct();
        $query = $this->db->get($this->table);
        return $query->result_array();
    }
	public function indexDistinct($dbField, $conditions) 
	{
	    $this->db->select($dbField);
        $this->db->distinct();
        $this->db->where($conditions);
        //$this->db->order_by('specialization', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result_array();
	}
    public function countWhere($dbField, $conditions) {
        $this->db->select($dbField);
        $this->db->where($conditions);
        return $this->db->count_all_results($this->table);
    }
	public function count($dbField)
	{
        return count($dbField); 
	}
	public function showById($id) 
	{
	    $query =$this->db->get_where($this->table, array('id' => $id));
        if ($query->num_rows() > 0)
        {
            return $query->result_array()[0];
        }
        else
        {
            return null;
        }
	}
	public function indexToday() 
	{
		$date = new DateTime("now");

        $curr_date = $date->format('Y-m-d');
		$this->db->select('*');
        $this->db->from($this->table); 
        $this->db->where("DATE_FORMAT(timeCreated, '%Y-%m-%d') =", $curr_date);
        $query = $this->db->get();
        return $query->result();
	}
    public function showByField($field, $dbField) 
	{
        //$this->db->order_by('id', 'ASC');
        $query = $this->db->get_where($this->table, array($dbField => $field));
	   	return $query->result_array();
	}
	public function where($conditions) 
	{
	    $query = $this->db->get_where($this->table, $conditions);
	   	return $query->result_array();
	}
    public function likeWhereDistinct($params, $conditions) {
        $this->db->like($params['dbField'], $params['match']);
        $this->db->distinct();
        $query = $this->db->get_where($this->table, $conditions);
        return $query->result_array();
    }
	public function showByEmail($email) 
	{
	  $query = $this->db->get_where($this->table, array('email' => $email));
      if (count($query->result_array()) !== 0) 
      {
        return $query->result_array()[0];
      }
	}
	public function create($data) 
	{
		$this->db->insert($this->table, $data);
	}
	public function update($id, $data)
	{
		$this->db->where("id", $id);
        $this->db->update($this->table, $data);
	}
    public function updateCertainField($id, $value, $field)
    {
        $this->db->set($field, $value);
        $this->db->where("id", $id);
        $this->db->update($this->table);  
    }
    public function updateCertainFieldId($id, $value, $field)
    {
        $this->db->set($field, $value);
        $this->db->where("UserID", $id);
        $this->db->update($this->table);  
    }
	public function updateDbField($id, $field)
	{

		$this->db->set('worker', $field);
        $this->db->where("id", $id);
        $this->db->update($this->table);
	}
	public function delete($id)
	{
		$this->db->where("id", $id);
		$this->db->delete($this->table);
    }
	public function exists($id)
	{
		$this->db->where("id", $id);
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0) {
			return true;
		}
		else {
			return false;
		}
	}
	public function filter($ids) 
	{
        if(count($ids) !== 0)
        {
		$this->db->select('*');
	   	$this->db->from($this->table);
	   	$this->db->where_in('id', $ids);
	   	return $this->db->get()->result_array();
        }
	}
	public function join($params)
    {
    	$this->db->select($params['requiredFields']);
    	$this->db->from($params['table1']);
    	$this->db->join($params['table2'], $params['condition'], $params['joinType']);
    	$this->db->where($params['idFilter'], $params['id']);
    	$query = $this->db->get();
        return $query->result_array()[0];
    }
    public function like($params) 
    {
    	$this->db->select('*');
    	$this->db->from($this->table);
        $this->db->like($params['dbField'], $params['match']);
        return $this->db->get()->result_array();
    }
    public function selectLast($value) {
        $query = $this->db->select($value)
                ->order_by($value,'desc')
                ->limit(1)
                ->get($this->table)
                ->row($value);
        return $query;
    }
    public function selectLastMany($value, $num) {
        $query = $this->db->select('*')
                ->order_by($value,'desc')
                ->limit($num)
                ->get($this->table)
                ->result_array();
        return $query;
    }

}
