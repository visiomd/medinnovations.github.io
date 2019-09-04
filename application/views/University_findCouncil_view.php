<div class="panel panel-info">
    <div class="panel-heading text-center pattern1"><h3 style="color:white;">Поиск диссертационного совета</h3></div>
    <div class="panel-body">
      	<div class="col-xs-12 col-md-8">
        <?php echo form_open('University/council/'); ?>
        <?php
          $attr = array ('class'   => 'form-control mt-10');
          echo form_dropdown('city', $cities, $cities['Архангельск'], $attr);
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
                      'style' => 'height: 5em; font-size: 20px; color: black; border: 1px solid #026873;'); 
        echo form_submit('submit', 'Поиск', $attr); 
        ?>
        <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div class="row">
    <h4 class="text-center text-info">
		<div>Перечень доступных шифров научных специальностей</div>
	</h4>
    <?php foreach ($categories as $key=>$c): ?>      
        <div class="col-md-6">
		    <a class="btn btn-block btn-default" onclick="fillInput()"><?= $c; ?></a>
	    </div>	
    <?php endforeach; ?>	
</div>	