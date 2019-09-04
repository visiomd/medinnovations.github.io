<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Execution {
  protected $implementation;
  public function __construct(Implementation $implementation) {
    $this->implementation = $implementation;
  }
  public function create() {
    echo $this->implementation->createImplementation();
  }
  public function readOne() {
    $this->implementation->readOneImplementation();
  }
  public function readAll() {
    $this->implementation->readAllImplementation();
  }
  public function updateOne() {
    $this->implementation->updateOneImplementation();
  }
  public function search() {
    $this->implementation->searchImplementation();
  }
  public function upload() {
    $this->implementation->uploadImplementation();
  }
  public function merge() {
    $this->implementation->mergeImplementation();
  }
}
interface Implementation
{
    public function createImplementation(): string;
    /*public function readOneImplementation(): string;
    public function readAllImplementation(): string;
    public function updateOneImplementation(): string;
    public function searchImplementation(): string;
    public function uploadImplementation(): string;
    public function mergeImplementation(): string;*/
}
 class TestImplementation implements Implementation {
  public function createImplementation():string {
    return "testcreateImplementation";
  }
}
class BaseImplementation implements Implementation {
   public function createImplementation():string {
    return "basecreateImplementation";
  }
}
class Assignment extends MY_Controller {
    public function __construct() {
        parent::__construct();
    }
    public function create($type = "") {
    if (!empty($type)) {
      if ($type === 'test') {
          $implementation = new TestImplementation;
      }
      else if($type === 'base') {
          $implementation = new BaseImplementation;
      }
      $execution = new Execution($implementation);
      $execution->create();
    }
    else {
      echo "Error";
    }
   
  }
}

