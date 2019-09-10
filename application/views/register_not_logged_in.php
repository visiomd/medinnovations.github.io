<?php
$attr = array('class' => 'form-horizontal');
echo form_open('Register/'.$lang, $attr); 
?>
<div class="row">
    <div class="col s6 offset-s3">
        Регистрируясь на сайте, вы соглашаетесь с условиями публичной оферты
        <a href="http://medinnovations.ru/Offer"> Ссылка</a>
        <h2><i class="medium material-icons">person_pin</i>Страница регистрации</h2>
        
        <?= validation_errors('<div class="card red lighten-2">', '</div>'); ?>
        <label for="name"><?= $text['NAME'] ; ?>:</label>
        <?php
          $attr = array ('placeholder' => '**'.$text['NAME'],
                         'id'          => 'name',
                         'class'       => 'form-control',
                          'onkeyup'     => 'withoutCyr(this)');
          echo form_input('name', set_value('name'), $attr);
        ?>
        <label for="mail">E-mail:</label>
        <?php
          $attr = array ('placeholder' => '**E-mail',
                         'id'          => 'mail',
                         'class'       => 'form-control');
          echo form_input('email', set_value('email'), $attr);
        ?>
        <label for="password"><?= $text['PASSWORD'] ; ?>:</label>
        <?php
        $attr = array ('placeholder' => '**'.$text['PASSWORD'],
                         'id'          => 'password',
                         'class'       => 'form-control',
                         'onkeyup'     => 'checkCapsWarning(event)',
                         'onfocus'     => 'checkCapsWarning(event)',
                         'onblur'      => 'removeCapsWarning()');
          echo form_password('password', set_value('password'), $attr);
        ?>
        <?php
          $attr = array ('placeholder' => $text['EMPTY_FIELD'],
                         'id'          => 'verification');
          echo form_input('verification', set_value('verification'), $attr);
        ?>
        <?php
        $options = ['Individual'         => $text['INDIVIDUAL'],                
                    'Organization'       => $text['ORGANIZATION']];
        $attr = array ();
        echo form_dropdown('role', $options, $text['INDIVIDUAL'], $attr);
        ?>
        <?php $attr = array('class' => 'btn'); 
        echo form_submit('submit', $text['REGISTER'], $attr); 
        ?>
        <div class="alert alert-danger"><p  style="font-size: 2vmin;">**-<?= $text['REGISTER_REQUIRED']; ?></p></div>
        <div style="display:none;color:red" id="capsIndicator"><?= $text['CAPSLOCK'];?></div>
    </div>
</div>
<?= form_close(); ?>
