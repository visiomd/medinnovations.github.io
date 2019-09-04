<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiUpload extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
    }
	public function index()
    {

      $this->load->view('ApiUpload_view');

      $this->load->model('login_model');
      $this->load->model('doctors_model');
      $id = $this->guid();
      if (isset($_POST['email']))
      {
          $email = $_POST['email'];
          $user = $this->login_model->showByEmail($email);
          $userName = $user['name'];
          $folderName = $userName.'_'.$id;
          $path = './Upload/server/php/files/'.$folderName;

          if (!file_exists($path))
          {
              mkdir($path, 0777, true);
              $uploadfile = $path .'/'. basename($_FILES['userfile']['name']);
              if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile))
              {
                  move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
                  $path = '/Upload/server/php/files/'.$folderName;
                  $uploadfile = $path .'/'. basename($_FILES['userfile']['name']);
                  $path = './Upload/server/php/files/'.$folderName;


              }
              else
              {
                  echo "При загрузке возникла ошибка\n";
              }

          }
      }
      if(isset($_POST['slices']))
      {
        $engToRus = ["Abdomen"     => "Брюшная полость и забрюшинное пространство",
                     "Chest"       => "Грудная клетка",
                     "Head"        => "Голова и шейный отдел",
                     "Lower Limbs" => "Кости свободных верхних и нижних конечностей",
                     "Upper Limbs" => "Кости свободных верхних и нижних конечностей",
                     "Pelvis"      => "Малый таз",
                     "Spine"       => "Позвоночник",
                     "Shoulders"   => "Кости свободных верхних и нижних конечностей"
                   ];
        if ($_POST['regionsInvestigations'] !== '') {
          $organs = explode(',', $_POST['regionsInvestigations']);

          $organsList = [];
          foreach ($organs as $key => $o) {
            foreach ($engToRus as $key1 => $e) {
              if ($o == $key1) {
                $organsList[$key] = $engToRus[$key1];
              }
            }
        }
        $organs = array_unique($organs);   
        $organs = implode(',', $organsList);
        
        }
        

        $this->load->model('tasks_model');
        $task = array('folder'      => $path,
                      'link'        => $uploadfile,
                      'customer'    => $userName,
                      'slices'      => $_POST['slices'],
                      'comment'     => $_POST['last'],
                      'organ'       => $organs,
                      'cost'       => '28900',
                      'parent'      => $_POST['taskStructure']);
        $this->tasks_model->create($task);

        if ($_POST['last'] == 1) {

            $series = $this->tasks_model->getSeries();
            $seriesIds = [];

            foreach ($series as $key => $s) {
                $seriesIds[$s['id']] = $s['parent'];
            }
            //print_r($series);
            //print_r($seriesIds);
            //Старшие задания [получаем только уникальные значения]
            $tasks = $this->tasks_model->getUniqueValues();
            //print_r($tasks);
            $indxs = [];
            //$indxs = $this->tasks_model->getSeriesOfTask(1);
            foreach ($seriesIds as $sKey => $s) {
                $indxs[$sKey] = [];
            }
            foreach ($seriesIds as $sKey => $s) {
                $parentId = $s;
                $parentIndxs = $this->tasks_model->getSeriesOfTask($parentId);
                $indxs[$sKey] = $parentIndxs;
            }
            foreach ($indxs as $iKey => $i) {
                foreach ($i as $iiKey => $ii) {
                    $indxs[$iKey][$iiKey] = $indxs[$iKey][$iiKey]['id'];
                }
            }
            //Помечаем задания как серии
            foreach ($series as $sKey => $s) {
                $this->tasks_model->updateCertainField($s['id'], 'Yes', 'partial');
            }
            foreach ($series as $sKey => $s) {
                $this->tasks_model->updateCertainField($s['id'], 'Null', 'Parent');
            }


        foreach ($tasks as $tKey => $t) {
            $taskInfo =  ['timeCreated' => $t['timeCreated'],
                          'folder'      => $t['folder'],
                          'link'        => $t['link'],
                          'customer'    => $t['customer'],
                          'organ'       => $t['organ'],
                          'cost'       =>  '28900',
                          'slices'      => 0,
                          'complex'     => implode(',', $indxs[$t['id']])
                        ];
            $this->tasks_model->create($taskInfo);
        }
        $this->_sendUploadNote($userName, $email, $user['role']);
        }


        /*
        lvl1 - сам доктор,
        lvl2 - доктор, стоящий на 1 уровень выше
        lvl3 - доктор, стоящий на 2 уровня выше
        */
        //print_r($userName);
        //$lvl1 = $this->doctors_model->getSingleRecord(null, ['name'=> $userName]);
         //print_r($lvl1);
       /* $lvl1Money = $lvl1['money'] + 70;
        $this->doctors_model->updateCertainField($lvl1['id'], $lvl1Money, "money");

        $lvl2 = $this->doctors_model->getSingleRecord(null, ['id' => $lvl1['parentId']]);
        //print_r($lvl2);
        $lvl2Money = $lvl2['money'] + 60;
        $this->doctors_model->updateCertainField($lvl2['id'], $lvl2Money, "money");

        $lvl3 = $this->doctors_model->getSingleRecord(null, ['id' => $lvl2['parentId']]);
       // print_r($lvl3);
        $lvl3Money = $lvl3['money'] + 50;
        $this->doctors_model->updateCertainField($lvl3['id'], $lvl3Money, "money");  */






        }
    }
}
