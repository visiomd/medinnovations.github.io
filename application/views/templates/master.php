<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?= (isset($tag_title)) ? "Медицинский портал: $tag_title" : NULL  ?></title>
    <meta name ="keywords" content = "Медицинский портал, medinnovations.ru, обработка рентгеновских снимков">
    <meta name ="description" content = "Медицинский портал, medinnovations.ru">
    <meta charset="utf-8">
    <meta name="robots" content="index, follow">
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="<?= base_url();?>assets/css/materialize.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="<?= base_url();?>assets/css/customizations.css">
    <?php if(isset($css)): ?>
    <?php foreach ($css as $stylesheet): ?>
        <link rel="stylesheet" href="<?= base_url();?>assets/css/<?=$stylesheet?>"/>
    <?php endforeach; ?>
    <?php endif; ?>
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/img/favicon16.ico"/>
</head>
<body>
    <nav class="teal lighten-4">
      <div id="nabBarEl" class="nav-wrapper">
        <a href="<?= base_url(); ?>" class="brand-logo"><i class="material-icons">language</i>Medinnovations.ru</a>
        <ul class="right ">
        <?php if($content === 'Main_index_view'):?>
           <li class="tab"><a id="aboutPage" href="#">О нас</a></li>
           <li class="tab"><a id="examplesPage" href="#">Примеры работ</a></li>
           <li class="tab"><a id="contactPage" href="#">Контакты</a></li>
        <?php endif; ?>
          <?php if(!isset($username)): ?>  
          <li><a href="<?= base_url().'Login/'.$lang; ?>">Вход</a></li>
          <li><a href="<?= base_url().'Register/'.$lang; ?>">Регистрация</a></li>
          <?php else: ?>
          <li><a href="<?= base_url().'Logout/'.$lang; ?>">Выход</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>
<div class="row">
    <?php $this->load->view($content); ?>
</div>


<footer class="page-footer blue-grey darken-1">
   <div class="container">
     <div class="row">
       <div class="col l6 s12">
            <h5 class="white-text">Медицинские сервисы</h5>
        </div>
        <div class="col l4 offset-l2 s12">
            <ul>
                <li><a class="grey-text text-lighten-3" href="<?= base_url().'University/'; ?>"><h5><?= $text['UNIVERSITY']; ?></h5></a></li>
                <li><a class="grey-text text-lighten-3" href="<?= base_url().'Payment/thirdpartyPayment'; ?>"><h5>Оплата услуг</h5></a></li>
                <li><a class="grey-text text-lighten-3" href="<?= base_url().'University'; ?>"><h5>Вопрос/Ответ</h5></a> 
		            <li><a class="grey-text text-lighten-3" href="tel:+79126952728"><h5><i class="material-icons prefix">phone</i>+7(912)6952728</h5></a></li>
            </ul>
        </div>
    </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
         © 2016-2019 Medinnovations.ru
        </div>
    </div>
</footer>
<script src="<?= base_url(); ?>assets/js/materialize.min.js"></script>
<?php if($content === "Tasks_Supervisor_view_supervisor"): ?>
<script src="https://api.trello.com/1/client.js?key=d7d7a689ea01ebd8e691cde9d145383d"></script>
<?php endif; ?>
<?php if(isset($js)): ?>
    <?php foreach ($js as $script): ?>
        <script src="<?= base_url();?>assets/js/<?=$script?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>

</html>
