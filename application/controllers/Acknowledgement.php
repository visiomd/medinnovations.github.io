<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acknowledgement extends MY_Controller {
	
    public function __construct() 
    {
        parent::__construct();
    }
    public function index($lang = '') 
    {
        $this->_defineLogStatus($lang);
        $this->_defineLanguage($lang);
        $text = $this->lang->{'language'};
        $data = array('lang'              => $lang,
                      'url'               => $this->_defineURL(__FUNCTION__),
                      'text'              => $text,
                      'role'              => $this->_defineRole(),
                      'content'           => $this->_defineRoleView(__FUNCTION__, true),
                      'username'          => $this->data['username'],
                      'tag_title'         => 'Сторонние ресурсы');
       $this->load->view($this->template, $data);
    }
}