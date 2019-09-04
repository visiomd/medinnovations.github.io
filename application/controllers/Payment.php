<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Controller {
	
    public function __construct($lang='') 
    {
        parent::__construct();
        $this->_defineLanguage($lang);
        $this->text = $this->lang->{'language'};
        $this->data = array('lang'              => $lang,
                            'text'              => $this->text,
                            'role'              => $this->_defineRole(),
                            'username'          => $this->data['username'],
                            'footer'            => 'None');  
    }
    public function index($id) 
    {
        if (isset($id))
        {
            $this->load->model('payments_model');
            $this->load->model('tasks_model');
            $paymentExists = $this->payments_model->showById($id);
            $task = $this->tasks_model->showById($id);
            $this->data['url'] = $this->_defineURL(__FUNCTION__);
            $this->data['tag_title'] = 'Список заданий';
            $this->data['cost'] = $task['cost'];
            $this->data['id'] = $id;
            if (is_null($this->data['cost'])) {
                $this->data['error'] = 'У данного задания нет сформированной стоимости';
                $this->data['content'] = 'Error_401';

                $this->load->view($this->template, $this->data);
            }
            else {

                $this->data['content'] = $this->_defineRoleView(__FUNCTION__, true);   
                $payment = ['id'  => $this->data['id'],
                            'user'=> $this->data['username'],
                            'cost'=>  $this->data['cost'],
                            'paid'=> 0];
                if (!isset($this->data['username'])) 
                {
                    $payment['user'] = 'Guest';
                }   
                if (isset($paymentExists)) 
                {
                    $this->payments_model->update($id, $payment);
                }  
                else 
                {
                    $this->payments_model->create($payment);
                }   
                $this->load->view($this->template, $this->data);
            }      
        }
        else 
        {
            echo '<div class="alert aler-danger>Платеж не проходит</div>'; 
        }
    }
    public function success() 
    {

        $this->data['url'] = $this->_defineURL(__FUNCTION__);
        $this->data['content'] = $this->_defineRoleView(__FUNCTION__, true);
        $this->data['Shp_service'] = $_REQUEST["Shp_service"];
        $this->data['tag_title'] = 'Успешное проведение платежа';
        $this->data['out_summ'] = $_REQUEST["OutSum"];
        
        $this->data['Shp_user'] = $_REQUEST["Shp_user"];
        $this->data['crc'] = $_REQUEST["SignatureValue"];
        $this->data['inv_id'] = $_REQUEST["InvId"];


        if ($this->data['Shp_service'] === 'DICOM') {
            $data = [];
            $data['name'] = $this->data['Shp_user'];
            $this->load->model('payments_model');
            $this->_sendPaymentNote($data);
            $this->payments_model->updateCertainField($this->data['inv_id'], $this->data['out_summ'], 'paid');
        }
        elseif ($this->data['Shp_service'] === 'Library') {
            $this->load->model('login_model');
            $user = $this->login_model->showByEmail($this->data['Shp_user']);
            $this->login_model->updateCertainFieldId($user['UserID'], 'Yes', 'articlesPaid');
        }
        elseif ($this->data['Shp_service'] === 'Lawyer') {
            $this->load->model('LAWpayments_model');
            $payment = ['user'=>  $this->data['Shp_user'],
                        'paid'=> $this->data['out_summ']]; 
            $this->LAWpayments_model->create($payment);
        }
        $this->load->view($this->template, $this->data);
    }
    public function fail() 
    {
        $this->load->view('Payment_fail_view');
    }
    public function result() 
    {
        $this->load->view('Payment_result_view');
    }
    public function thirdpartyPayment() 
    {
        $this->load->model('payments_model');
        $this->data['content'] = $this->_defineRoleView(__FUNCTION__, true);
        $this->data['url'] = $this->_defineURL(__FUNCTION__);
        $this->data['tag_title'] = 'Оплата стороннего задания';
        $this->data['footer'] = 'None';
        $this->data['id'] = $this->payments_model->selectLast('id')+1;
         $payment = ['id'  => $this->data['id'],
                     'user'=> 'Partner',
                     'cost'=>  '1',
                     'paid'=> 'trying'];
        $this->payments_model->create($payment);

        $this->load->view($this->template, $this->data); 

    }
    /*public function thirdpartySuccess() 
    {   
        $this->data['url'] = $this->_defineURL(__FUNCTION__);
        $this->data['content'] = $this->_defineRoleView(__FUNCTION__, true);
        $this->data['Shp_service'] = $_REQUEST["Shp_service"];
        $this->data['tag_title'] = 'Успешное проведение платежа';
        $this->data['out_summ'] = $_REQUEST["OutSum"];
        
        $this->data['Shp_user'] = $_REQUEST["Shp_user"];
        $this->data['crc'] = $_REQUEST["SignatureValue"];
        $this->data['inv_id'] = $_REQUEST["InvId"];


        if ($this->data['Shp_service'] === 'DICOM') {
            $data = [];
            $data['name'] = $this->data['Shp_user'];
            $this->load->model('payments_model');
            $this->_sendPaymentNote($data);
            $this->payments_model->updateCertainField($this->data['inv_id'], $this->data['out_summ'], 'paid');
        }
    }
    public function thirdpartyFail() 
    {
        $this->load->view('Payment_fail_view');
    }*/
}