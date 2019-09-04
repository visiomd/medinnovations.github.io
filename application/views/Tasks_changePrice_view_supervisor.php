<?php
$attr = array('class' => 'form-horizontal',
	       'role' => 'form');
echo form_open('Tasks/changePrice/'.$taskId, $attr); 
?>
<div class="form-group">
   <div class="col-lg-4 col-lg-offset-4 col-xs-4">
    <?php
     	$attr = array ('placeholder' => 'Новая цена',
                        'class'      => 'form-control');
     	echo form_input('cost', set_value('cost'), $attr);
    ?>
    </div>
</div>
<div class="form-group">
    <div class="col-lg-4 col-lg-offset-4 col-xs-4">
<?php 
    $attr= array('class' => 'btn btn-primary');
    echo form_submit('submit', 'Сохранить изменения', $attr); 
?>
    </div>
</div>
<?= form_close(); ?>