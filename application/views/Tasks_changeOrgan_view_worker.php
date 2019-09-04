<?php
$attr = array('class' => 'form-horizontal',
	       'role' => 'form');
echo form_open('Tasks/changeOrgan/'.$taskId, $attr); 
?>
<div class="form-group">
    <div class="col-lg-4 col-lg-offset-4 col-xs-4">
    <?php
        $options = ['Позвоночник'                  => 'Позвоночник',                
                    'Крупнные суставы'             => 'Крупнные суставы',
                    'Мозг'                         => 'Мозг',
                    'Легкие'                       => 'Легкие',   
                    'Почки'                        => 'Почки',  
                    'Печень'                       => 'Печень',    
                    'Сердечно-сосудистая система'  => 'Сердечно-сосудистая система',
                    'Пищевод'                      => 'Пищевод',
                    'Желудок'                      => 'Желудок', 
                    'Кишечник'                     => 'Кишечник',
                    'Желчный пузырь'               => 'Желчный пузырь',
                    'Надпочечники'                 => 'Надпочечники',
                    'Мочевой пузырь'               => 'Мочевой пузырь',
                    'Селезенка'                    => 'Селезенка'];
        $attr = array ('class'   => 'form-control');
        echo form_dropdown('organ', $options, 'Позвоночник', $attr);
    ?>
    </div>
</div>
<div class="form-group">
    <div class="col-lg-4 col-lg-offset-4 col-xs-4">
<?php 
    $attr= array('class' => 'btn btn-primary');
    echo form_submit('submit', 'Добавить тег', $attr); 
?>
    </div>
</div>
<?= form_close(); ?>