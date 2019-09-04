<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends MY_Controller {
	public function index($lang = '') 
	{
		$this->load->library('session');
        $this->_defineLanguage($lang);
        $text = $this->lang->{'language'};
		$this->data['username'] = $this->session->userdata('username');
		if (isset($this->data['username'])) {
			$this->session->sess_destroy();
		}
		else {

		}
        redirect('Main/'.$lang); 
	}
}