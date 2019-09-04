<div class="modal fade" id="modal-container-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="<?= $areaHidden; ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title" id="myModalLabel1" style="text-align:center;">Заявка на консультацию</h4>
            </div>
            <div class="modal-body">
            <?= validation_errors('<div class="alert alert-danger" style="text-align:center;">', '</div>'); ?>
            <?php
            $attr = ['class' => 'form-horizontal',
                     'role'  => 'form'];
            echo form_open('Mail/', $attr); 
            ?>
            <label for="name">Имя:</label>
                <?php
                    $attr = ['placeholder' => 'Имя',
                             'id'          => 'name',
                             'class'       => 'form-control'];
                    echo form_input('name', set_value('name'), $attr);
                ?>
            </br>
            <label for="topic">Тема:</label>
                <?php
                    $attr = ['placeholder' => 'Тема',
                             'id'          => 'topic',
                             'class'       => 'form-control'];
                    echo form_input('topic', set_value('topic'), $attr);
                ?>
            </br>
            <label for="date">Удобная дата:</label>
                <?php
                    $attr = ['placeholder' => 'Дата',
                             'id'          => 'date',
                             'class'       => 'form-control',
                             'type'        => 'date'];
                    echo form_input('date', set_value('date'), $attr);
                ?>
            </br>
            <label for="phone">Телефон:</label>
                <?php
                    $attr = ['placeholder' => 'Телефон',
                             'id'          => 'phone',
                             'class'       => 'form-control',
                             'type'        => 'tel'];
                    echo form_input('phone', set_value('phone'), $attr);
                ?>
            </br>
            <label for="phone">E-mail:</label>
                <?php
                    $attr = ['placeholder' => 'E-mail',
                             'id'          => 'phone',
                             'class'       => 'form-control',
                             'type'        => 'email'];
                    echo form_input('email', set_value('email'), $attr);
                ?>
            </br>
            <label for="text">Текст:</label>
                <?php
                    $attr = ['value' => 'Текст сообщения',
                             'id'    => 'date',
                             'class' => 'form-control'];
                    echo form_textarea('text', set_value('text'), $attr);
                ?>
            </br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Отмена</button> 
            <?php 
            $attr = array('class' => 'btn btn-info');
            echo form_submit('submit', 'Отправить', $attr); 
            ?>
            </div>
    </div>
</div>
<?php echo form_close(); ?>
</div>
