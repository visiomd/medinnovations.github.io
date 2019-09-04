<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tasks extends MY_Controller {

    public function __construct($lang='')
    {
        parent::__construct();
        $this->_defineLanguage($lang);
        $this->text = $this->lang->{'language'};
        $this->data = array('lang'              => $lang,
                            'text'              => $this->text,
                            'role'              => $this->_defineRole(),
                            'username'          => $this->data['username']);

        $this->load->model('tasks_model');
    }
    public function Renderer() {
        $this->data['url'] = $this->_defineURL(__FUNCTION__);
        $this->data['content'] = $this->_defineRoleView(__FUNCTION__, false);
        $this->data['tag_title'] = 'Ваши задания';
        $this->load->view($this->template, $this->data);
    }
    public function Individual() 
    {
        $payments = $this->payments_model->getFinishedPayments();
        $tasks = $this->tasks_model->getTasksFilteredByUsername($filterParam);
        foreach ($tasks["Заявки"] as $key => $t) {
            $tasks["Заявки"][$key]['paid'] = "No";
        }
        foreach ($tasks["Заявки"] as $key => $t) {
           foreach ($payments as $key1 => $p) {
                if ($t['id'] == $p['id']) {
                    $tasks["Заявки"][$key]['paid'] = "Yes";
                }
           }
        }
    }
    public function Supervisor($filterName = " ", $filterParam = " ")
    {
        $this->load->model('payments_model');
        $this->load->model('login_model');
        $this->load->model('t_events_model');

        $payments = $this->payments_model->getFinishedPayments();
        $statuses  = $this->t_events_model->getAllRecordsAscEvents();

       
        $tasksYear = $this->tasks_model->getTasksFilteredByYear();
        $tasksQuarter = $this->tasks_model->getTasksFilteredByQuarter();
        $tasksMonth =  $this->tasks_model->getTasksFilteredByMonth();
        $tasksTotal =  $this->tasks_model->getTasksFiltered1();

        switch ($filterName) {
            case 'year':
                $tasks = $tasksYear;
                break;
            case 'quarter':
                $tasks = $tasksQuarter;
                break;
            case 'month':
                $tasks = $tasksMonth;
                break;
            case 'id':
                $tasks = $this->tasks_model->getTasksFilteredById($filterParam);
                break;
            case 'username':
                $tasks = $this->tasks_model->getTasksFilteredByUsername($filterParam);
                break;
            default:
                $tasks =  $tasksTotal;
        }

        $statusesFiltered = [];
        $emails = [];

        foreach ($statuses as $key => $value) {
          $statusesFiltered[$value['taskId']] = [];
        }
        foreach ($statuses as $key => $value) {
          array_push($statusesFiltered[$value['taskId']], $statuses[$key]);
        }

        foreach ($tasks["Заявки"] as $key => $t) {
          $emails[$t['id']] = $this->login_model->getSingleRecord(null, ['name' => $t['customer']])['email'];
        }
        
        foreach ($tasks["Заявки"] as $key => $t) {
            $tasks["Заявки"][$key]['paid'] = "No";
        }
        foreach ($tasks["Заявки"] as $key => $t) {
           foreach ($payments as $key1 => $p) {
                if ($t['id'] == $p['id']) {
                    $tasks["Заявки"][$key]['paid'] = "Yes";
                }
           }
        }

        $moment = 'moment-with-locales.js';
        $tasksJs = 'tasks.js';

       
        $this->data['js'] = [$moment, $tasksJs];
        $this->data['tasks'] = $tasks;
        $this->data['tasksEvents'] = $statuses;
        $this->data['tasksEventsFiltered'] = $statusesFiltered;
        $this->data['url'] = $this->_defineURL(__FUNCTION__);
        $this->data['content'] = $this->_defineRoleView(__FUNCTION__, false);
        $this->data['tag_title'] = 'Список заданий';
        $this->data['report'] = ['year'     => $tasksYear,
                                 'quarter'  => $tasksQuarter,
                                 'month'    =>  $tasksMonth,
                                 'total'    => $tasksTotal];
        $this->data['emails'] = $emails;
        $this->load->view($this->template, $this->data);

    }
    public function askQuestion() {
        $question = $_POST['question'];
        $id = $_POST['id'];
        if (isset($question)) {
            $this->_sendQuestionToAdministrators($question, $this->data['username'], $id);
            redirect('Tasks/provided');
        }
    }
    public function generateGooogleDoc($data, $date) {

      $page = 'https://script.google.com/macros/s/AKfycbzh8CPJIp_9cBIQd4DzsRahG7wkpzgydWhMZb5WRjA/dev'.'?numberReport='.$data.'&dateReport='.$date;
      redirect($page);
    }
    public function delete($id = NULL)
    {
        header('Access-Control-Allow-Origin: *');
           $this->load->model('tasks_model');
            $taskExists = $this->tasks_model->exists($id);
            if ($taskExists == true) {
                $this->tasks_model->updateCertainField($id, 'Удалено', 'status');
                if ($this->data['role'] === 'Worker') {
                    echo "OK";
                }
                elseif ($this->data['role'] === 'Individual' ||
                    $this->data['role'] === 'Organization' ||
                    $this->data['role'] === 'Moderator' ||
                    $this->data['role'] === 'Admin' ||
                    $this->data['role'] === 'Doctor')
                {
                    echo "OK";
                }
            }
            else {
                show_404();
            }
    }


    public function take($id) {
        $name = $this->_defineName();
        $this->tasks_model->updateDbField($id, $name);
        redirect('Tasks');
    }
    public function done($id) {
        $this->load->model('login_model');
        $task = $this->tasks_model->showById($id);
        $user = $this->login_model->showByField($task['customer'], 'name');
        $this->tasks_model->updateCertainField($id, 'pending', 'processed');
        $this->_sendEndTaskNote($user[0], $id);
        redirect('Tasks/received');
    }
    public function provided($lang='') {
        //Меню
        $role = $this->_defineRole();

       //Получаем данные для фильтрации данных по конкретному пользователю
        $email =  $this->data['username'];
        $name = $this->_defineName();

        $this->load->model('payments_model');
        $payments = $this->payments_model->getAllRecords(null);

        if ($role === 'Doctor') {
            $this->load->model('doctors_model');
            $doctor = $this->doctors_model->getSingleRecord(null, ['name'=> $name]);
            $tasks = $this->tasks_model->getSomeRecords(null, ['doctor' => $doctor['id']]);
            $this->data['doctor'] = $doctor;
            for ($j = 0, $c1 = count($tasks); $j < $c1; $j++) {
                $tasks[$j]['paid'] = 'No';
            }
            //Фильтрация данных
            for($i = 0, $c = count($payments); $i < $c; $i++) {
                for ($j = 0, $c1 = count($tasks); $j < $c1; $j++) {
                    if ($payments[$i]['id'] === $tasks[$j]['id']) {
                        if ($payments[$i]['cost'] === $payments[$i]['paid']) {
                            $tasks[$j]['paid'] = 'Yes';
                        }
                    }
                }
            }

            $this->data['tasks'] = $tasks;
            $this->data['countTasks'] = count($tasks);
        }
        elseif ($role === 'Admin' || $role === 'Individual' || $role === 'Organization') {
            $tasks = $this->tasks_model->getSomeRecords(null, ['customer'=> $name, 'partial' => 'No']);
            for ($j = 0, $c1 = count($tasks); $j < $c1; $j++) {
                $tasks[$j]['paid'] = 'No';
            }
            //Фильтрация данных
            for($i = 0, $c = count($payments); $i < $c; $i++) {
                for ($j = 0, $c1 = count($tasks); $j < $c1; $j++) {
                    if ($payments[$i]['id'] === $tasks[$j]['id']) {
                        if ($payments[$i]['cost'] === $payments[$i]['paid']) {
                            $tasks[$j]['paid'] = 'Yes';
                        }
                    }
                }
            }
            $this->data['tasks'] = $tasks;
            $this->data['countTasks'] = count($tasks);
        }
        $this->data['name'] = $name;
        $this->data['url'] = $this->_defineURL(__FUNCTION__);
        $this->data['content'] = $this->_defineRoleView(__FUNCTION__, false);
        $this->data['tag_title'] = 'Ваши задания';
        $this->data['payments'] = $payments;
        $this->data['css'] = ['background.css', 'provided.css'];
        $this->load->view($this->template, $this->data);
    }
    public function changePrice($taskId) {
        $this->load->model('login_model');
        $task = $this->tasks_model->showById($taskId);
        $this->data['url'] = $this->_defineURL(__FUNCTION__);
        $this->data['content'] = $this->_defineRoleView(__FUNCTION__, false);

        $this->data['taskId'] = $taskId;
        $customer = $task['customer'];
        $condition = ['name'=> $customer];
        $user = $this->login_model->where($condition)[0];
        $userEmail = $user['email'];
        $this->load->view($this->template, $this->data);
        if (isset($_POST['cost'])) {
            $cost = $_POST['cost'];
            $this->tasks_model->updateCertainField($taskId, $cost, 'cost');
            $this->_sendPriceSetNote($userEmail, $taskId);
            echo '<div class="alert alert-success">Вы успешно изменили цену</div>';
            if ($this->_defineRole() === 'Admin') {
                redirect('Tasks/provided'.$lang);
            }

        }

    }
    public function changeDescription($taskId) {
        $this->data['menu'] = null;
        $task = $this->tasks_model->showById($taskId);
        $this->data['url'] = $this->_defineURL(__FUNCTION__);
        $this->data['content'] = $this->_defineRoleView(__FUNCTION__, false);

        $this->data['taskId'] = $taskId;
        $customer = $task['customer'];
        $condition = ['name'=> $customer];
        $user = $this->login_model->where($condition)[0];
        $userEmail = $user['email'];
        $this->load->view($this->template, $this->data);
        if (isset($_POST['description'])) {
            $description = $_POST['description'];
            $this->tasks_model->updateCertainField($taskId, $description, 'description');
            redirect('Tasks/provided'.$lang);
        }

    }
    public function ajaxChangeStatus($taskId)
    {
        $this->load->model('t_events_model');


        $task = $this->tasks_model->showById($taskId);
        $this->data['url'] = $this->_defineURL(__FUNCTION__);
        $this->data['content'] = $this->_defineRoleView(__FUNCTION__, false);

        $this->data['taskId'] = $taskId;
        $customer = $task['customer'];
        $condition = ['name'=> $customer];

        $this->load->view($this->template, $this->data);
        if (isset($_POST['status'])) {
            $status = $_POST['status'];
            $ymd = date('Y/m/d');
            $hi =  date('H:i:s');
            $this->tasks_model->updateCertainField($taskId, $status, 'status');
            $taskEvent = ['taskId'           => $taskId,
                          'eventDescription' => "Статус задания поменян с « ".$task['status']." » на "."«".$_POST['status']." » ".$ymd." в ".$hi
                        ];

            $this->t_events_model->create($taskEvent);
        }
    }
    public function getStatusChanges($taskId)
    {
        $this->load->model('tasks_model');
        $this->load->model('t_events_model');


        $status = $this->tasks_model->getSingleRecord(null,['id'=> $taskId])['status'];
        $event = $this->t_events_model->getLastRecord($taskId, 'eventDescription');
        $data = ['status' => $status,
                 'event'  => $event
               ];
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    public function changeStatus($taskId, $status) {
        $this->load->model('t_events_model');
        $this->load->model('login_model');
        $status = urldecode($status);
        $task = $this->tasks_model->showById($taskId);
        $this->data['url'] = $this->_defineURL(__FUNCTION__);
        $this->data['content'] = $this->_defineRoleView(__FUNCTION__, false);

        $this->data['taskId'] = $taskId;
        $customer = $task['customer'];
        $condition = ['name'=> $customer];
        $customerMail = $this->login_model->getSingleRecord(null, $condition)['email'];
            $ymd = date('Y/m/d');
            $hi =  date('H:i:s');
            $this->tasks_model->updateCertainField($taskId, $status, 'status');
            $taskEvent = ['taskId'           => $taskId,
                          'eventDescription' => "Статус задания поменян с « ".$task['status']." » на "."« ".$status." » ".$ymd." в ".$hi
                        ];
            $this->t_events_model->create($taskEvent);
            if ($status == 'Обрабатывается') {
                $text = '<div>Добрый день</div>'.
                        '<div>Ваша заявка принята в исполнение.</div>';
                $this->_sendStatusChangeNotificationCustomers($customerMail, $status, $text, $taskId);
            }
            elseif($status == 'Исполнено') {
                $text = '<div>Добрый день</div>'.
                        '<div>Обработка снимков была завершена.</div>'.
                        '<div>Результаты заявки доступны в личном кабинете на сайте  medinnovations.ru </div>';
                $this->_sendStatusChangeNotificationCustomers($customerMail, $status, $text, $taskId);
            }

            $textForWorkers = $taskEvent['eventDescription'];

            $this->_sendStatusChangeNotificationWorkers($status, $textForWorkers, $taskId);
            redirect('Tasks/Supervisor'.$lang);

    }
    public function deleteAttachments($taskId, $attachmentId) {
      $task = $this->tasks_model->showById($taskId);
      $attachments = $task['attachments'];
      $attachments = explode(',', $attachments);
      unset($attachments[$attachmentId]);
      $attachments = implode(',', $attachments);
      $this->tasks_model->updateCertainField($taskId, $attachments, 'attachments');
       if ($this->_defineRole() == 'Supervisor') {
            redirect('Tasks/Supervisor'.$lang);
        }
        else if($this->_defineRole() == 'Individual') {
            redirect('Tasks/provided/'.$lang);
        }

    }
    public function changeReceipts($taskId) {
        $receipts = [];
        if (empty($_POST['column'])) {
            $receipts = '0,0,0,0,0';
            $this->tasks_model->updateCertainField($taskId, $receipts, 'receipts');
        }
        if (isset($_POST['column'])) {

            foreach ($_POST['column'] as $receipt) {
                $receipts[$receipt] = 1;
            }
            for ($i = 0; $i <= 4; $i++) {
                if (array_key_exists($i, $receipts)) {

                }
                else {
                  $receipts[$i] = 0;
                }
            }
            ksort($receipts);
            $receipts = implode(',', $receipts);
            $this->tasks_model->updateCertainField($taskId, $receipts, 'receipts');

        }
        redirect('Tasks/'.$lang);

    }
    public function changeOrgan($taskId) {
        $task = $this->tasks_model->showById($taskId);
        $this->data['url'] = $this->_defineURL(__FUNCTION__);
        $this->data['content'] = $this->_defineRoleView(__FUNCTION__, false);
        if ($this->_defineRole() === 'Supervisor') {
        $this->data['menu'] = [$this->text['HEADER_PROFILE']      => base_url().'Profile/',
                               $this->text['HEADER_TASKS']        => base_url().'Tasks/',
                               'Обработчики'                      => base_url().'Workers/',
                               'Создать обработчика'              => base_url().'Users/createWorker/'];
        }
        $this->data['taskId'] = $taskId;

        $this->load->view($this->template, $this->data);
        $organ = $task['organ'];
        if (isset($_POST['organ'])) {
            if (strpos($organ, ',') === true) {
                $organs = explode(",", $organ);
                $count = count($organs);
                $organs[$count+1] = $_POST['organ'];
                $tag = implode(",", $organs);
            }
            elseif ($organ === 'Нет') {
                $tag = $_POST['organ'];
            }
            else {
                $tag = $organ.','.$_POST['organ'];
            }
            $this->tasks_model->updateCertainField($taskId, $tag, 'organ');
            if ($this->_defineRole() === 'Supervisor') {
                redirect('Tasks/Supervisor'.$lang);
            }
            else if($this->_defineRole() === 'Individual') {
                redirect('Tasks/provided/'.$lang);
            }
        }
    }
        public function provideAttachments($tId) {
          $this->data['id']  = $tId;
          $this->data['content'] = $this->_defineRoleView(__FUNCTION__, false);

          $task = $this->tasks_model->showById($tId);

          if (isset($_FILES['userfile']['tmp_name'])) {
            $this->load->view($this->template, $this->data);
            echo "File loaded";
            $page['struct'] = ["Заявки", $tId, "Файл был загружен"];

            $this->load->view($this->template, $this->data);
            $this->load->view('Toasts', $page);
            if ($_FILES['userfile']['name'] !== '' ) {
            $name = $_FILES['userfile']['name'];
            $uploadfile = './assets/taskAtttachments/' .$tId.'/'.$name;
            $folder = './assets/taskAtttachments/' .$tId;

            if (!file_exists($folder))
            {
                mkdir($folder, 0777, true);
            }

            $tmpFile = $_FILES['userfile']['tmp_name'];
            $onErrorMessage = 'Ошибка при загрузке';
            $this->_moveFilesToFolder($tmpFile, $uploadfile, $onErrorMessage);
            if ($task['attachments'] == Null) {
                $newAttachment = $_FILES['userfile']['name'];
                $this->tasks_model->updateCertainField($tId, $newAttachment, 'attachments');
                if ($this->_defineRole() == 'Supervisor') {
                    redirect('Tasks/Supervisor'.$lang);
                }
                else if($this->_defineRole() == 'Individual') {
                    redirect('Tasks/provided/'.$lang);
                }
            }
            else {
                $newAttachment =  $task['attachments'].','.$_FILES['userfile']['name'];
                $this->tasks_model->updateCertainField($tId, $newAttachment, 'attachments');
                if ($this->_defineRole() == 'Supervisor') {
                    redirect('Tasks/Supervisor'.$lang);
                }
                else if($this->_defineRole() == 'Individual') {
                    redirect('Tasks/provided/'.$lang);
                }
            }
                }
          }
          else {
            $page['struct'] = ["Заявки", $tId, "Файл не был загружен"];
            $this->load->view($this->template, $this->data);
            $this->load->view('Toasts', $page);

          }

    }


    public function trace($taskId, $taskStatus)
    {
        $task = $this->tasks_model->showById($taskId);
        $this->tasks_model->updateCertainField($taskId, $taskStatus, 'processed');
        redirect($task['link']);
    }
    public function download($id)
    {
        $task = $this->tasks_model->showById($id);
        if (isset($task['result']))
        {
            ignore_user_abort(true);
            header('Content-Description: File Transfer');
            header('Content-Type: application/x-rar-compressed');
            header('Content-Disposition: attachment; filename=' . $task['id'].'.rar');
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: '. filesize($task['result']));
            ob_clean();
            flush();
            if (readfile($task['result']) !== false && !connection_aborted())
            {
                  $this->tasks_model->updateCertainField($id, 'done', 'processed');
            }
        }

    }
}
