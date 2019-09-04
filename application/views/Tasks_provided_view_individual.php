<script type="text/javascript">
  var createTaskPopup = function(id) {
  var popup = confirm("вы точно хотите Удалить заявку №  "+id+" ?");
  if (popup == true) {
      $.ajax({ type: "GET",   
             url: "http://www.medinnovations.ru/Tasks/delete/"+id,
       success: function(msg) {
             document.location.reload(true);        
       }      
      });
  }
  
};
</script>
<div class="col s12 m8">    
    <div class="teal lighten-4 white-text"><h3><i class="material-icons">assignment</i> Заявки <button class="btn-floating btn-large waves-effect waves-light teal darken-4"><?= $countTasks; ?></button></h3></div>
<?php foreach($tasks as $t): ?>
    <?php if($t['partial'] === 'No'): ?>
            <div id="modal<?=$t['id'];?>" class="modal bottom-sheet">
            <div class="modal-content">
                <button class="waves-effect waves-light btn right"><i class="material-icons">drag_handle</i> <?= $t['status']; ?></button>
                <button class="waves-effect waves-light btn left"><i class="material-icons">assignment</i> Заявка № <?=$t['id'];?></button>
                <button class="waves-effect waves-light btn left card-time" data-time="<?= $t['timeCreated']; ?>"><i class="material-icons">access_time</i></button>
                <div class="card">
                  <div class="card-content">
                     <h5> Области исследования:</h5>
                     <?php $organs = explode(',', $t['organ']); ?>
                     <?php if($organs !== " "):?>
                     <?php foreach ($organs as $key => $o) :?>
                     <div class="chip"><?= $o; ?><i class="close material-icons">close</i></div> 
                     <?php endforeach; ?>
                     <?php endif; ?>
                      <div>
                      <ul class="collection">
                      <?php if(is_null($t['cost'])): ?>
                         <li class="collection-item">[Нет цены]</li>
                      <?php else: ?>
                          <li class="collection-item active">Стоимость: <?= $t['cost']; ?> руб.</li>
                      <?php endif; ?>
                      </ul>
                      </div>
                     <?php if(!empty($t['attachments'])):?>
                      <table class="grey lighten-5 centered">
                      <thead>
                      <tr>
                        <th>Файл</th>
                        <th>Удалить</th>
                      </tr>
                      </thead>
                      <tbody>  
                      <?php if (count(explode(',', $t['attachments'])) > 1):?>
                      <?php foreach (explode(',', $t['attachments']) as $key=>$atachment):?>
                            <tr>
                            <td>
                            <a href="<?= base_url().'assets/taskAtttachments/'.$t['id'].'/'.$atachment; ?>">Скачать <?= $atachment; ?></a>
                            </td>
                            <td>
                            <a href="<?= base_url().'/Tasks/deleteAttachments/'.$t['id'].'/'.$key; ?>">x</a>
                            </td>
                            </tr>
                      <?php endforeach;?>
                      <?php else: ?>
                            <tr>
                            <td>
                            <a href="<?= base_url().'assets/taskAtttachments/'.$t['id'].'/'.$t['attachments']; ?>">Скачать <?= $t['attachments']; ?></a>
                            </td>
                            <td>
                             <a href="<?= base_url().'/Tasks/deleteAttachments/'.$t['id'].'/0'; ?>">x</a>
                            </td>
                            </tr>
                      <?php endif; ?>
                    </tbody>
                    </table>
                    <?php endif; ?>
                    <h5>Регламент обработки</h5>
                    <p>Срок исполнения заявки - 3 рабочиз дня с момента с момента перевода заявки в статус "В исполнении"</p>
                  </div>
                  <div class="card-action">
                     <a href="<?= base_url();?>Tasks/provideAttachments/<?=$t['id']; ?>"><i class="material-icons">file_upload</i>Приложить документы</a>
                      <?php if($t['paid'] === 'Yes'):?>
                          <a>[Оплачен]</a>
                      <?php else: ?>
                          <a href="<?=base_url();?>Payment/index/<?= $t['id']; ?>"><i class="material-icons">payment</i>Оплатить</a>
                      <?php endif; ?>
                      <a onclick="createTaskPopup(<?= $t['id']; ?>)"><i class="material-icons">delete</i> Удалить</a>
                  </div>
                </div>


            </div>
            <div class="modal-footer">
                  <a href="#!" class="modal-close waves-effect waves-green btn-flat">Ок</a>
            </div>
        </div>  
        <div class="col s4">
              <div class="collection">
                <a class="collection-item active teal darken-4">Заявка № <?= $t['id']; ?></a>
                <a class="collection-item active card-time teal darken-1" data-time="<?= $t['timeCreated']; ?>"></a>
                <a class="collection-item active teal lighten-4"><?= $t['status']; ?></a>
                <a class="collection-item modal-trigger" href="#modal<?=$t['id'];?>">Подробнее</a>
              </div>
        </div>

        
  <?php endif; ?>
<?php endforeach; ?>
</div>

<div class="col s5 m4">
            
            <ul class="collapsible">
             <li>
              <a id="menu" class="waves-effect waves-light btn right" ><i class="material-icons">menu</i></a>
            <div class="tap-target" data-target="menu">
                <div class="tap-target-content">
                    <h4>Тех. поддержка:</h4>
                    <h4>+7(912)6952728</h4>
                    <a class="waves-effect waves-light btn btn-small" href="http://medinnovations.ru/xuploader.zip">Mac</a>
                    <a class="waves-effect waves-light btn btn-small" href="http://medinnovations.ru/Xuploader.exe">Windows</a>    
                </div>
            </div>  
              <div class="collapsible-header"><i class="material-icons">drafts</i><a href="http://www.medinnovations.ru/Offer">Офферта</a></div>
            </li>    
            <li>
  
              <div class="collapsible-header">
                 
                <i class="material-icons">info_outline</i>Инструкции</div>
              <div class="collapsible-body">
                <ul class="collapsible">
                  <li>
                    <div class="collapsible-header"><i class="material-icons">info_outline</i>Что нужно сделать</div>
                    <div class="collapsible-body">
                       <ul class="collection with-header">
                          <li class="collection-header"><h4>Действия:</h4></li>
                          <li class="collection-item">
                              <div>
                                <a class="secondary-content"><i class="material-icons">filter_1</i></a>
                                Отсканируйте или сфотографируйте перечисленные документы. [Смотри раздел Что нужно иметь]
                                </div>
                          </li>
                           <li class="collection-item">
                                <div>
                                <a class="secondary-content"><i class="material-icons">filter_2</i></a>
                                <a onclick="$('.tap-target').tapTarget('open')">Скачать программу загрузчик</a>
                              </div>
                          </li>
                           <li class="collection-item">
                             <div>
                                <a class="secondary-content"><i class="material-icons">filter_3</i></a>
                                Запустить программу загрузчик
                            </div>
                          </li>
                           <li class="collection-item">
                            <div>
                                <a class="secondary-content"><i class="material-icons">filter_4</i></a>
                                Действовать согласно инструкции в программе
                            </div>
                          </li>
                        </ul>
                  </div>
                  </li>
                  <li>
                    <div class="collapsible-header"><i class="material-icons">info_outline</i>Что нужно иметь</div>
                    <div class="collapsible-body">
                    <ul class="collection with-header">
                          <li class="collection-header"><h4>Документы:</h4></li>
                          <li class="collection-item">
                              <div>
                                <a class="secondary-content"><i class="material-icons">filter_1</i></a>
                                Снимки КТ/МРТ (хранятся на диске)
                                </div>
                          </li>
                           <li class="collection-item">
                                <div>
                                <a class="secondary-content"><i class="material-icons">filter_2</i></a>
                                Результаты всех анализов без персональных данных
                               
                              </div>
                          </li>
                           <li class="collection-item">
                             <div>
                                <a class="secondary-content"><i class="material-icons">filter_3</i></a>
                               Заключение рентгенолога к снимкам КТ/МРТ без персональных данных
                            </div>
                          </li>
                        </ul>
                  </li>
                  </ul>
              </div>
          </li>
            <li>
              <div class="collapsible-header"><i class="material-icons">account_circle</i>Информация об аккаунте</div>
              <div class="collapsible-body">
                <div><i class="material-icons">account_box</i> Имя: <?= $name; ?></div>
                <div><i class="material-icons">email </i> Почта: <?= $username; ?></div>
              </div>
            </li>
            <li>
              <div class="collapsible-header"><i class="material-icons">help</i>Обращение за помощью</div>
              <div class="collapsible-body">
                 <a onclick="$('.tap-target').tapTarget('open')">Техническая поддержка по телефону</a>
                 <p>Техническая поддержка по почте</p>
                  <form action="<?= base_url();?>Tasks/askQuestion/" method="post">
                    <div class="input-field">
                          <i class="material-icons prefix">label</i>
                          <input type="text" name="id" placeholder="# Заявки" required=""> 
                    </div>
                    <div class="input-field">
                      <i class="material-icons prefix">mode_edit</i>
                      <textarea id="question" class="materialize-textarea" name="question" required></textarea>
                      <label for="question">Описание проблемы</label>
                    </div>
                    <div class="input-field">
                      <input class="btn waves-effect waves-light" type="submit" value="Задать вопрос">
                    </div>
                </form>
            </div>
            </li>
        </ul>
</div>
   

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.collapsible');
      var options = {};
      var instances = M.Collapsible.init(elems, options);
    });
    document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var options = {};
    var instances = M.Modal.init(elems, options);
  });
     $(document).ready(function(){
        $('.tap-target').tapTarget();

  M.textareaAutoResize($('#textarea1'));    
  });
</script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/moment-with-locales.js"></script>
<script type="text/javascript">
    moment.locale("ru");
    var cards = document.querySelectorAll('.card-time');
    for (var i = 0, l = cards.length; i < l; i++) {
        cards[i].innerHTML += " "+moment(cards[i].dataset.time).format("YYYY, DD MMMM,  HH:mm:ss");
    }
</script>

