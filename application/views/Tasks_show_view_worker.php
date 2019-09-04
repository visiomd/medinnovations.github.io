<div class="panel panel-default">
    <div class="panel-heading">
        <div>Сотрудник обработки:<?= $task['worker']; ?></div>
        <div>Заказчик:<?= $task['customer']; ?></div>
    </div>
    <div class="panel-body">
        <div>Описание:<?= $task['description']; ?></div>
        <form enctype="multipart/form-data" action="http://medinnovations.ru/Tasks/show/<?= $task['id']; ?>" method="POST" class="form-horizontal">
        <input type="hidden" name="MAX_FILE_SIZE" value="700000000" />
        <label class="btn btn-primary">Выбрать файл
            <input name="userfile" type="file" style="display:none"/>
        </label>  
        <div class="form-group">
            <div class="col-xs-4">
                <input type="submit" class="btn btn-primary mt-10" value="Отправить файл" />
            </div>
        </div>
        </form>
    </div>
</div>
<a class="btn btn-primary btn-lg" href="<?=base_url(); ?>Tasks/received">Назад</a>







	
