<div class="row">
    <div class="col s12 m12">
      <div class="card">
        <div class="card-content center-align">
        <?php if(isset($error)):?>
        	<span class="card-title">Возникла ошибка</span>
        	<p class="flow-text"><?= $error; ?></p>
		<?php else:?>
         	<span class="card-title">Возникла ошибка</span>
        	<p class="flow-text">У вас недостаточно прав для просмотра страницы</p>
        </div>
    	<?php endif; ?>
      </div>
    </div>
</div>