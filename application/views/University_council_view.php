<div class="panel panel-info">
    <div class="panel-heading text-center pattern1"><h3 style="color:white;">Поиск диссертационного совета</h3></div>
    <div class="panel-body">
        <div class="col-xs-12 col-md-8">
        <?php echo form_open('University/council/'); ?>
        <?php
          $attr = array ('class'   => 'form-control mt-10');
          echo form_dropdown('city', $cities, $cities[$curCity], $attr);
        ?>
        <?php
              $attr = array ('placeholder' => 'Научная специальность',
                             'class'       => 'form-control name mt-20',
                             'id'          => 'Search');
              echo form_input('council', set_value('council'), $attr);
        ?>
        </div>
        <div class="col-xs-6 col-md-4">
        <?php
        $attr = array('class' => 'btn btn-block mt-10',
                      'style' => 'height: 5em; font-size: 20px; color: black; border: 1px solid #026873;' ); 
        echo form_submit('submit', 'Поиск', $attr); 
        ?>
        <?php echo form_close(); ?>
        </div>
    </div>
</div>
<?php if(empty($matches)): ?>
<div class='panel panel-primary'>
        <div class='panel-heading pattern1'>
            <div><h3 style="color:black; text-align: center;">Диссертационных советов по данному критерию не найдено</h3></div>
            <div><h3 style="color:black; text-align: center">Попробуйте еще раз</h3></div>
        </div>
</div>
<?php else :?>
<?php foreach($matches as $m): ?>
<div class='panel-group'>
    <div class='panel panel-primary'>
        <div class='panel-heading pattern1'>
            <div class="pull-right"><h4 style="color:black;">[<?= $m['City'];?>]</h4></div>
            <div><h3 style="color:black;"><?= $m['Organization'];?></h3></div>
        </div>
        <div class='panel-body'>
            <h4 style="color:black;">Детали приказа</h1>
            <div class="table-responsive">          
            <table class="table">
                <thead>
                  <tr>
                    <th>Код №1</th>
                    <th>Код №2</th>
                    <th>Код №3</th>
                    <th>Номер</th>
                    <th>Дата</th>
                    <th>Ссылка</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  <td><?= $m['Code1'];?></td>
                  <td><?= $m['Code2'];?></td>
                  <td><?= $m['Code3'];?></td>
                  <td><?= $m['Order_number'];?></td>
                  <td><?= $m['Order_date'];?></td>
                  <td><a href="<?= $m['Link'];?>"><?= $m['Link'];?></a></td>
                  </tr> 
                </tbody>
            </table>
            </div>
        </div>
</div> 
<?php endforeach; ?>
<?php endif; ?>