<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
    public function index($lang = '') {
	$this->load->library('form_validation');
	$this->load->library('session');
    $this->load->model('validation_login_model');
    $this->_defineLanguage($lang);
    $text = $this->lang->{'language'};
	$this->form_validation->set_rules($this->validation_login_model->add_rules);

	if ($this->form_validation->run() !== false) 
        {
            $this->load->model('login_model');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $userExists = $this->login_model->verify_user($email, sha1($password));
            if ($userExists !== false) 
            {
                $this->session->set_userdata('username', $this->input->post('email'));
                $this->data['username'] = $this->session->userdata('username');
                $role = $this->_defineRole();
                switch ($role) {
                    case 'Individual':
                        redirect('Tasks/provided'.$lang);  
                        break;
                    case 'Worker':
                        redirect('Tasks/'.$lang);  
                        break;
                    case 'Supervisor':
                        redirect('Tasks/Supervisor'.$lang);   
                        break;
                    case 'Admin':
                        redirect('Doctors/index/'.$lang);   
                        break;
                    case 'Moderator':
                        redirect('Services/VizualizationAndProcessing/');   
                        break;
                    case 'Doctor':
                        redirect('Doctors/cabinet/');   
                        break;
                    default:
                        redirect('VirtualClinic/instruction/'.$lang);
                }
            }
            else 
            {
                $data = array(
                    'lang'              => $lang,
                    'url'               => $this->_defineURL(__FUNCTION__),
                    'text'              => $text,
                    'role'              => $this->_defineRole(),
                    'content'           => 'login_view',
			        'username'          => $this->session->userdata('username'),
			       'title'             => 'Авторизоваться на сайте',
			       'js'                =>  array('capslock.js'),
                   'footer'            => true, 
			       'tag_title'         => 'Вход');
                $this->load->view($this->template, $data);
                echo  "<div class='aler alert-danger'>Вы ввели неправильно имя или пароль пользователя</div>";
            }
	}
	else 
        {
                $data = array(
                          'lang'              => $lang,
                          'url'               => $this->_defineURL(__FUNCTION__),
                          'text'              => $text,
                          'role'              => $this->_defineRole(),
                          'content'           => 'login_view',
			              'username'          => $this->session->userdata('username'),
			              'title'             => 'Авторизоваться на сайте',
			              'js'                =>  array('capslock.js'),
                          'footer'            => true, 
			              'tag_title'         => 'Вход');
	    $this->load->view($this->template, $data);
      	
        }
    }
   
}