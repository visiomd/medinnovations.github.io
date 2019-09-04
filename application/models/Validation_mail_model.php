<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validation_Mail_Model extends CI_Model {
    public $ruleList = 
    [
    [
        'field' => 'name',
        'label' => 'Имя',
        'rules' => 'required|alpha_numeric|min_length[6]|max_length[20]' 
    ],
    [
        'field' => 'topic',
        'label' => 'Тема',
        'rules' => 'required|min_length[5]|max_length[40]' 
    ],
    [
        'field' => 'date',
        'label' => 'Дата',
        'rules' => 'required' 
    ],
    [
        'field' => 'phone',
        'label' => 'Телефон',
        'rules' => 'required' 
    ],
    [
        'field' => 'email',
        'label' => 'Email',
        'rules' => 'required|valid_email' 
    ],
    [
        'field' => 'text',
        'label' => 'Текст сообщения',
        'rules' => 'required|min_length[6]|max_length[140]' 
    ]
    ];
}

