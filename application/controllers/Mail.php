<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends MY_Controller {
  
    public function __construct() {
        parent::__construct();
    }
    public function index($lang = '') {
        $this->_defineLanguage($lang);
        $this->load->library('form_validation');
        $this->load->model('validation_mail_model');
        $data = ['lang'             =>  $lang,
                 'text'              => $this->lang->{'language'},
                 'url'               => $this->_defineURL(__FUNCTION__), 
                 'role'              => $this->_defineRole(),
                 'content'           => 'Mail_index_view',
                 'username'          =>  $this->data['username'],
                 'tag_title'         => 'Отправка почты',
                 'footer'            => 'None'
                ];
        $this->form_validation->set_rules($this->validation_mail_model->ruleList);
        if ($this->form_validation->run() !== false) {
            $user = 'medinnovations@mail.ru';
            $mail = ['name'     => $this->input->post('name'),
                     'topic'    => $this->input->post('topic'),
                     'date'     => $this->input->post('date'),
                     'phone'    => $this->input->post('phone'),
                     'email'    => $this->input->post('email'),
                     'text'     => $this->input->post('text')
            ];
            $message = $this->load->view('Mail_template', $mail, TRUE);
            $subject = 'Юридические услуги www.medinnovations.ru (Запрос)';
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

            mail($user, $subject, $message, $headers);
        }
        else {
            $this->load->view($this->template, $data);
        }

    }
}