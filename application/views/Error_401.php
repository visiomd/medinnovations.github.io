<div class="alert alert-danger text-center">
<?php if(isset($error)):?>
	<h3><?= $error; ?></h3>
<?php else:?>
	<h3>У вас недостаточно прав для просмотра страницы</h3>
<?php endif; ?>	
</div>