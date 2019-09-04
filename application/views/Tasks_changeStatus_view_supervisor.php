<?php
$attr = array('class' => 'form-horizontal',
	       'role' => 'form');
echo form_open('Tasks/changeStatus/'.$taskId, $attr); 
?>
<div class="form-group">
    <div class="col-lg-4 col-lg-offset-4 col-xs-4">
    <?php
        $options = ['Поступило'          => 'Поступило',                
                    'В обработке'        => 'В обработке' ,
                    'Ждут заключения'    => 'Ждут заключения' ,
                    'Ждут отправки'      => 'Ждут отправки'
                    ];  
        $attr = array ('class'   => 'form-control');
        echo form_dropdown('status', $options, 'Поступило', $attr);
    ?>
    </div>
</div>
<div class="form-group">
    <div class="col-lg-4 col-lg-offset-4 col-xs-4">
<?php 
    $attr= array('class' => 'btn btn-primary');
    echo form_submit('submit', 'Изменить статус', $attr); 
?>
    </div>
</div>
<?= form_close(); ?>