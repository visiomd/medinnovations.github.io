<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validation_Register_Model extends CI_Model {
    public $add_rules = array(
    array(
        'field' => 'name',
        'label' => 'Name',
        'rules' => 'required|min_length[6]|alpha_numeric|max_length[20]' 
    ),    
    array(
        'field' => 'email',
        'label' => 'E-mail',
        'rules' => 'required|valid_email|is_unique[users.email]|max_length[50]' 
    ),
    array(
        'field' => 'password',
        'label' => 'Пароль',
        'rules' => 'required|min_length[6]|max_length[50]' 
    ),
    array(
        'field' => 'verification',
        'label' => 'Поле, которое должно оставаться без изменений',
        'rules' => 'regex_match["/\S/"]'

    ),
    array(
        'field' => 'role',
        'label' => 'Роль',
        'rules' => 'required|in_list[Individual, Organization]'
    )
);
}

