<div class="text-center"><a href="https://www.youtube.com/watch?v=ianh5PCdCIA&feature=youtu.be"><h2>Видеоинструкция о работе с личным кабинетом</h2></a></div>
<div class="text-center"><a href="https://www.youtube.com/watch?v=puZtrTgQmtQ&feature=youtu.be"><h2>Видеоинструкция о просмотре результатов обработки</h2></a></div>
<?php if(empty($tasks)):?>
<div class="alert alert-success" style='text-align: center; font-weight: bold;'>У вас нет заданий</div>
<?php else: ?>
<?php foreach($tasks as $t): ?>
    <?php if($t['partial'] === 'No'): ?>
    <div class="panel panel-default">
    <div class="panel-heading">
            <h4 class="pull-right"><?= $text['TASK_DELETE'];?> <a href="<?= base_url().'/Tasks/delete/'.$t['id'].'/'.$lang; ?>">X</a></h4>
            <h4 class="text-center"><a href="<?= base_url().$t['link']; ?>"><?= $text['INIT_FILES'];?></a></h4>
            <h4>Номер задания:<?= $t['id']; ?></h4>
            <h4>Время и дата поступления заказа:<?= $t['timeCreated']; ?></h4>
            <?php if($t['processed'] === 'No'): ?>
            <div style='text-align: center; font-weight: bold;'>[Задание принято к исполнению]</div>  
            <div class="progress">
                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:10%">10%</div>
            </div>
            <?php elseif($t['processed'] === 'downloaded'): ?>
            <div style='text-align: center; font-weight: bold;'>[Задание скачано обработчиком]</div>     
            <div class="progress">
                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:30%">30%</div>
            </div>
            <?php elseif($t['processed'] === 'uploaded'):?>
            <div style='text-align: center; font-weight: bold;'>[Задание выполнено загрузчиком, но не скачано заказчиком]</div>         
            <div class="progress">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">70%</div>
            </div>
            <?php elseif($t['processed'] === 'pending'): ?>
            <div style='text-align: center; font-weight: bold;'>[Ожидается подтверждения заказчиком]</div>
            <div class="progress">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%">90%</div>
            </div>
            <?php elseif($t['processed'] === 'done'):?>
            <div style='text-align: center; font-weight: bold;'>[Задание выполнено]</div>     
            <div class="progress">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">100%</div>
            </div>   
            <?php else: ?>
            <?php endif;?>
 
        </div>
        <div class="panel-body">
            <?php
            $attr = array('class' => 'form-horizontal',
                           'role' => 'form');
            echo form_open('Tasks/changeDescription/'.$t['id'], $attr); 
            ?>
            <div class="form-group mt-20">
               <div class="col-xs-6 col-md-4">
                    <?php if(isset($t['description'])): ?>
                    <h4><?= $t['description']; ?></h4>
                    <?php else:?>
                    <h4>Комментариев нет</h4>
                    <?php endif; ?>
               </div>
               <div class="col-xs-6 col-md-4">
                <?php
                    $attr = array ('placeholder' => 'Комментарий',
                                    'class'      => 'form-control');
                    echo form_input('description', set_value('description'), $attr);
                ?>
                </div>
                <div class="col-xs-6 col-md-4">
                <?php 
                $attr= array('class' => 'btn btn-primary');
                echo form_submit('submit', 'Изменить комментарий', $attr); 
                ?>
                </div>
            </div>
            <?= form_close(); ?>
            <div class="form-group mt-20">
                <div class="col-xs-6 col-md-4">
                    <?php if($t['paid'] === 'Yes'):?>
                    <h4>Заказ оплачен</h4>
                    <?php else: ?>
                    <h4>Заказ не оплачен</h4>
                    <?php endif; ?> 
                </div>
                <div class="col-xs-12 col-md-8">
                    <?php if($t['paid'] === 'Yes'):?>
                    <button type="button" class="btn btn-primary disabled">Оплатить</button>
                    <?php else: ?>   
                    <a href="<?= base_url().'Payment/index/'.$t['id']; ?>"><button type="button" class="btn btn-primary active">Оплатить</button></a>
                    <?php endif; ?>
                </div>
            </div>   
            <div class="form-group mt-20" style='text-align: center; font-weight: bold;'>
                <div class="col-xs-18 col-md-12"> 
                <?php if($t['processed'] === 'pending' || $t['processed'] === 'uploaded' || $t['processed'] === 'done' ):?>
                <a href="<?= base_url().$t['result']; ?>"><h3><?= $text['RESULT'];?></h3></a>
                <?php else:?>
                <h4>Обработка не закончена, результат недоступен для скачивания. </h4>
                <?php endif;?>
                </div>
                </div>
            </div>
    </div>
        <?php endif;?>                
<?php endforeach; ?> 
<?php endif; ?>

