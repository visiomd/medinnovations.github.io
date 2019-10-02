<form enctype="multipart/form-data" action="http://medinnovations.ru/ApiUpload1" method="POST" id="ApiUpload">
    <input type="hidden" name="MAX_FILE_SIZE" value="70000000000000" />
    <input type ='text' name="email"  value='' placeholder='Email'/>
    <input type ='text' name="regionsInvestigations"  value='' placeholder='regionsInvestigations'/>
    <input type ='text' name="taskStructure"  value='' placeholder='taskStructure'/>
    <input type ='text' name="last"  value='' placeholder='last'/>
    <input type ='text' name="slices"  value='' placeholder='Слои'/>
    <textarea name="comment" form="ApiUpload">Введите ваш комментарий</textarea>
    <!-- Название элемента input определяет имя в массиве $_FILES -->
    Отправить этот файл: <input name="userfile" type="file" />
    <input type="submit" value="Отправить файл" />
    В случае успешной загрузки вы окажитесь на странице вашего профиля.        
</form>






