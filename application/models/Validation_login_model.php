<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validation_Login_Model extends CI_Model {
    public $add_rules = array(
    array(
        'field' => 'email',
        'label' => 'E-mail',
        'rules' => 'required|valid_email' 
    ),
    array(
        'field' => 'password',
        'label' => 'Пароль',
        'rules' => 'required|min_length[6]' 
    )
);
}

