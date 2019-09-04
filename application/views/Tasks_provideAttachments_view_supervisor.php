<div class="row">
	<div class="col s6 offset-s3">
		<h4>Загрузка файла к заявке № <?= $id; ?></h4>
		<form enctype="multipart/form-data" action="<?= base_url();?>Tasks/provideAttachments/<?= $id; ?>" method="post">
		  <div class="file-field input-field">
		  	<input type="hidden" name="MAX_FILE_SIZE" value="700000000" />
		    <div class="btn">
		      <span>Выбрать файл</span>
		      <input type="file" name="userfile">
		    </div>
		    <div class="file-path-wrapper">
		      <input class="file-path validate" type="text">
		    </div>
		  </div>
		   <input class="btn waves-effect waves-light" type="submit" value="Отправить" />
		</form>

	</div>
</div>
