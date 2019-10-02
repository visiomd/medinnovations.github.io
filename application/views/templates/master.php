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
    <ul id="company" class="dropdown-content">
      <li><a href="<?= base_url();?>Main/aboutUs">О компании</a></li>
      <li><a href="<?= base_url();?>Main/history">История развития</a></li>             
      <li><a href="<?= base_url();?>Main/science">Публикации</a></li>
      <li><a href="<?= base_url();?>Main/media">Галерея</a></li>
      <li><a href="<?= base_url();?>Main/coop">Сотрудничество</a></li>
      <li><a href="<?= base_url();?>Main/vacancies">Вакансии</a></li>
      <li><a href="<?= base_url();?>Main/contacts">Контакты</a></li>
    </ul>
    <nav class="teal lighten-4">
      <div id="nabBarEl" class="nav-wrapper">
        <a href="<?= base_url(); ?>" class="brand-logo"><i class="material-icons">language</i>Medinnovations.ru</a>
        <ul class="right ">
          <li><a href="<?= base_url();?>Main">Главная</a></li>
          <li><a href="<?= base_url();?>Main/services/">Услуги</a></li>
          <li style="width: 170px"><a class="dropdown-trigger" data-target="company" data-constrainwidth="false" href="#!">Компания</a></li>
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

                    <div class="col s4">
                        <h5 class="white-text">Услуги</h5>
                        <ul class="treeCSS">
                            <li><a class="grey-text text-lighten-3" href="aboutMESID.html">Медицинская диагностика</a>
                                <ul>
                                    <li><a class="grey-text text-lighten-3"href="<?= base_url();?>Main/aboutMesid">МЭСИД</a></li>
                                    <li><a class="grey-text text-lighten-3" href="<?= base_url();?>Main/aboutMesidWork">Как это работает</a></li>
                                    <li><a class="grey-text text-lighten-3" href="<?= base_url();?>Main/aboutMesidExamples">Примеры работ</a></li>
                                </ul>
                            </li>
                            <li><a class="grey-text text-lighten-3" href="<?= base_url();?>Main/software">Разработка ПО</a>
                                <ul style="padding-left: 12px">
                                  <li><a class="grey-text text-lighten-3" href="<?= base_url();?>Main/software#AutoLiRADS">AutoLiRADS</a></li>
                                  <!-- Определение классификационного типа глиомы -->
                                  <li><a class="grey-text text-lighten-3" href="<?= base_url();?>Main/software#glioma">Glioma Project</a></li>
                                  <!-- Генерация плотностных карт по МРТ  -->
                                  <li><a class="grey-text text-lighten-3" href="<?= base_url();?>Main/software#syntheticCT">syntheticCT</a></li>
                                  <!-- Quantification of lesion volume in disseminated forms of pulmonary tuberculosis -->
                                  <li><a class="grey-text text-lighten-3" href="<?= base_url();?>Main/software#disTuberculosis">Volume disTuberculosis</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="col s4">
                        <h5 class="white-text">Информация</h5>
                        <div class="row">
                            <div class="col s6">
                                <ul class="treeCSS">
                                    <li><a class="grey-text text-lighten-3" href="<?= base_url();?>Main/aboutUs">О компании</a></li>
                                    <li><a class="grey-text text-lighten-3" href="<?= base_url();?>Main/history">История развития</a></li>                        
                                    <li><a class="grey-text text-lighten-3" href="<?= base_url();?>Main/science">Научная работа</a></li>
                                </ul>
                            </div>
                            <div class="col s6">
                                <ul class="treeCSS">
                                    <li><a class="grey-text text-lighten-3" href="<?= base_url();?>Main/media">Галерея</a></li>
                                    <li><a class="grey-text text-lighten-3" href="<?= base_url();?>Main/coop">Сотрудничество</a></li>
                                    <li><a class="grey-text text-lighten-3" href="<?= base_url();?>Main/vacancies">Вакансии</a></li>
                                    <li><a class="grey-text text-lighten-3" href="<?= base_url();?>Main/contacts">Контакты</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="col s4" style="text-align: right;">
                        <h6 class="white-text">ООО "АЛЬФАБЕТАГАММА"</h6>
                        <p>Телефон: +7 (965) 382-11-23</p>
                        <div class="divider"></div>
                        <ul>
                            <li><a class="grey-text text-lighten-3" href="http://medinnovations.ru/University/">Институт</a></li>
                            <li><a class="grey-text text-lighten-3" href="http://medinnovations.ru/Payment/thirdpartyPayment">Оплата услуг</a></li>
                            <li><a class="grey-text text-lighten-3 modal-trigger" href="#modal1">Задать вопрос</a></li>
                            <li>
                            <a class="grey-text text-lighten-3" href="tel:+79126952728" "=" "><h5><i class="material-icons prefix ">phone</i>+7(912)6952728</h5></a></li>
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
<?php if($content === "Tasks_Supervisor_view"): ?>
<script src="https://api.trello.com/1/client.js?key=d7d7a689ea01ebd8e691cde9d145383d"></script>
<?php endif; ?>
<?php if(isset($js)): ?>
    <?php foreach ($js as $script): ?>
        <script src="<?= base_url();?>assets/js/<?=$script?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>

</html>
