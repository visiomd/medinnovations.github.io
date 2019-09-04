<div class="row">
    <div class="col s4 offset-s4">
        <h2><i class="medium material-icons">person_pin</i>Страница входа</h2>
         <?= validation_errors('<div class="card red lighten-2">', '</div>'); ?>
    </div>
</div>
<div class="row">
    <div class="input-field col s4 offset-s4">
<?php
$attr = array('class' => 'validate',
               'role' => 'form');
echo form_open('Login/'.$lang, $attr); 
?>
    <label for="email" data-error="<?php echo form_error('email'); ?>">Email:</label>
    <?php
        $attr = array ('placeholder' => "E-mail",
                       'id'          => 'email');
        echo form_input('email', set_value('email'), $attr);
    ?>
    </div>
</div>
<div class="row">
        <div class="input-field col s4 offset-s4">
<label for="password"><?= $text['PASSWORD'] ;?>:</label>
    <?php
        $attr = array ('placeholder' => $text['PASSWORD'],
                       'class'       => 'form-control',
                       'id'          => 'password',
                       'onkeyup'     => 'checkCapsWarning(event)',
                       'onfocus'     => 'checkCapsWarning(event)',
                       'onblur'      => 'removeCapsWarning()');
        echo form_password('password', set_value('password'), $attr);
    ?>
    </div>
</div>
<div class="row">
        <div class="input-field col s4 offset-s4">
<?php 
    $attr= array('class' => 'btn btn-default btn-block btn-custom');
    echo form_submit('submit', $text['ENTER'], $attr); 
?>
    </div>
</div>
<?php echo form_close(); ?>

