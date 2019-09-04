<div class="text-center">
    <?php
        $attr = array('class' => 'form-horizontal',
                      'role' => 'form');
        echo form_open('Tasks/addComment/', $attr); 
    ?>
    <h1>Внести свой вклад</h1>
    <div>
        <?php
            $attr = array ('placeholder' => 'ID задания',
                           'class'       => 'form-control',
                           'id'          => 'textareaComment');
            echo form_input('id', set_value('id'), $attr);
        ?>
    </div>
    <div>
        <?php
            $attr = array ('placeholder' => 'Комментарий',
                           'class'       => 'form-control mt-10',
                           'id'          => 'textareaComment');
            echo form_textarea('comment', set_value('comment'), $attr);
        ?>
    </div>
    <div>
            <?php
                $attr =  array('class' => 'btn btn-primary btn-lg mt-30'); 
                echo form_submit('add', 'Добавить комментарий к заданию', $attr); 
            ?>
    </div>
    <?php echo form_close(); ?>
</div>