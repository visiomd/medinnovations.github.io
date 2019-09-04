 <script type="text/javascript">
  var deleteTaskPopup = function(id) {
  var popup = confirm("Вы точно хотите удалить заявку №  "+id+" ?");
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
  <div class="col s4 m2">
    <ul class="collapsible">
      <li>
      <div class="collapsible-header teal darken-4 white-text">Проверка заказа  <span class="new badge"  data-badge-caption="<?= $statistics["Inited"]; ?> "></span></div>
<?php foreach($tasks as $t): ?>
<?php if ($t['status'] === 'Проверка заказа'): ?>
  <div class="collapsible-body">
          <?php
              $statuses = ['Проверка заказа', 'Обрабатывается', 'Ждут заключения', 'Исполнено'];
              $keyNextStatus = array_search($t['status'], $statuses);
              $nextStatus = $statuses[$keyNextStatus+1];
              $date = date_create($t['timeCreated']);
              $timeMD = date_format($date, 'm-d');
              $timeYMD =  date_format($date, 'Y-m-d');
              $id = $timeMD."-R-".$t['id'];
          ?>
            <div class="collection">
                <a class="collection-item active teal darken-4 center-align">Заявка № <?= $t['id']; ?></a>
                <a class="collection-item active card-time teal darken-1 center-align" data-time="<?= $t['timeCreated']; ?>"></a>
                <a class="collection-item active teal lighten-4 center-align"><?= $t['customer']; ?></a>
                <a class="collection-item btn" href="<?=base_url();?>Tasks/changeStatus/<?= $t['id'];?>/<?= $nextStatus; ?>">Поднять +1</a>
                <a class="collection-item btn" href="<?= base_url().'Tasks/generateGooogleDoc/'.$id.'/'.$timeYMD;?>">Google</a>
                <a class="trello collection-item btn" data-id="<?= $t['id']; ?>" data-customer="<?= $emails[$t['id']]; ?>" data-time="<?= $t['timeCreated']; ?>" data-organ="<?= $t['organ']; ?>">Trello</a>
                <a class="collection-item btn modal-trigger" href="#modal<?=$t['id'];?>">Подробнее</a>
            </div>
            <div id="modal<?=$t['id'];?>" class="modal bottom-sheet">
                <div class="modal-content">
                 <button class="waves-effect waves-light btn right"><i class="material-icons">drag_handle</i> <?= $t['status']; ?></button>    
                <button class="waves-effect waves-light btn left"><i class="material-icons">assignment</i> Заявка № <?=$t['id'];?></button>
                <button class="waves-effect waves-light btn left card-time" data-time="<?= $t['timeCreated']; ?>"><i class="material-icons">access_time</i></button>
                <div class="card">
                  <div class="card-content">
                    <div class="col s12">
                    <h5>Информация о пользователе:</h5>
                    <div class="chip teal white-text">
                         <i class="material-icons">account_circle</i>
                        <?= $t['customer']; ?>
                    </div>
                    <div class="chip teal white-text">
                         <i class="material-icons">email</i>
                        <?= $emails[$t['id']]; ?>
                    </div>
                    </div>
                    <div class="col s12">
                    <h5>Информация о цене:</h5>
                    <div class="chip teal white-text">
                        <i class="material-icons">attach_money</i>
                        <?php if(is_null($t['cost'])): ?>
                        Стоимость: 0 руб.
                         <?php else: ?>
                         Стоимость: <?= $t['cost']; ?> руб.
                        <?php endif; ?>  
                    </div>
                    <div class="chip teal white-text">
                        <?php if($t['paid'] === 'Yes'):?>
                          <i class="material-icons">verified_user</i> Оплачена
                          <?php else: ?>
                          <i class="material-icons">block </i> Не оплачена
                          <?php endif; ?>
                    </div>
                    </div>
                    <h5>Области исследования:</h5>
                     <?php $organs = explode(',', $t['organ']); ?>
                     <?php if($organs !== " "):?>
                     <?php foreach ($organs as $key => $o) :?>
                     <div class="chip teal white-text"><?= $o; ?><i class="close material-icons">close</i></div> 
                     <?php endforeach; ?>
                     <?php endif; ?>
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
                    <?php $ids = explode(',', $t['complex']); ?>
                    <ul class="collapsible">
                       <li>
                          <div class="collapsible-header"><h5><i class="material-icons">drafts</i> Снимки</h5> <span class="new badge"  data-badge-caption="<?= count($ids); ?> "></span> </div>
                          <div class="collapsible-body">
                    <?php foreach($ids as $key=>$id): ?>
                       <a class="chip teal white-text" href="<?= base_url().'Tasks/trace/'.$id.'/downloaded'; ?>"><?= 'Часть '. ($key+1); ?></a>
                    <?php endforeach; ?>
                        </li>
                    </ul>
                    <ul class="collapsible">
                      <li>
                      <?php if (isset($tasksEventsFiltered[$t['id']])) :?>
                      <div class="collapsible-header"><h5><i class="material-icons">drafts</i> История</h5> <span class="new badge"  data-badge-caption="<?= count($tasksEventsFiltered[$t['id']]); ?> "></span> </div>
                      <div class="collapsible-body">
                      <?php foreach ($tasksEventsFiltered[$t['id']] as $te): ?>
                          <div><?= $te['eventDescription']; ?></div>
                      <?php endforeach; ?>
                      </div>
                      </li>
                      <?php else: ?>
                        <div class="collapsible-header"><h5><i class="material-icons">history</i> История</h5> <span class="new badge"  data-badge-caption="Измнений в статусах нет"></span> </div>
                      <?php endif; ?>
                    </ul>

                </div>
                <div class="card-action">
                    <a href="<?= base_url();?>Tasks/provideAttachments/<?=$t['id']; ?>">Работа с файлами</a>
                    <a onclick="deleteTaskPopup(<?= $t['id']; ?>)"><i class="material-icons">delete</i> Удалить</a>
                </div>
            </div>


                <div class="modal-footer">
                  <a href="#!" class="modal-close waves-effect waves-green btn-flat">Ок</a>
                </div>


            </div>
            </div>
        </div>

<?php endif; ?>

<?php endforeach ; ?>
</li>
 </ul>
</div>

<div class="col s4 m2">
    <ul class="collapsible">
      <li>
      <div class="collapsible-header teal darken-4 white-text">Обрабатывается<span class="new badge"  data-badge-caption="<?= $statistics["Processing"]; ?>"></span></div>
<?php foreach($tasks as $t): ?>
<?php if ($t['status'] === 'Обрабатывается'): ?>
        <div class="collapsible-body">
          <?php
              $statuses = ['Проверка заказа', 'Обрабатывается', 'Ждут заключения', 'Исполнено'];
              $keyNextStatus = array_search($t['status'], $statuses);
              $nextStatus = $statuses[$keyNextStatus+1];
              $nextStatus1 = $statuses[$keyNextStatus+2];
              $date = date_create($t['timeCreated']);
              $timeMD = date_format($date, 'm-d');
              $timeYMD =  date_format($date, 'Y-m-d');
              $id = $timeMD."-R-".$t['id'];
          ?>
            <div class="collection">
                <a class="collection-item active teal darken-4 center-align">Заявка № <?= $t['id']; ?></a>
                <a class="collection-item active card-time teal darken-1 center-align" data-time="<?= $t['timeCreated']; ?>"></a>
                <a class="collection-item active teal lighten-4 center-align"><?= $t['customer']; ?></a>
                <a class="collection-item btn" href="<?=base_url();?>Tasks/changeStatus/<?= $t['id'];?>/<?= $nextStatus; ?>">Поднять +1</a>
                <a class="collection-item btn" href="<?=base_url();?>Tasks/changeStatus/<?= $t['id'];?>/<?= $nextStatus1; ?>">Поднять +2</a>
                <a class="collection-item btn" href="<?= base_url().'Tasks/generateGooogleDoc/'.$id.'/'.$timeYMD;?>">Google</a>
                <a class="trello collection-item btn" data-id="<?= $t['id']; ?>" data-customer="<?= $emails[$t['id']]; ?>" data-time="<?= $t['timeCreated']; ?>" data-organ="<?= $t['organ']; ?>">Trello</a>
                <a class="collection-item btn modal-trigger" href="#modal<?=$t['id'];?>">Подробнее</a>
            </div>
            <div id="modal<?=$t['id'];?>" class="modal bottom-sheet">
                <div class="modal-content">
                 <button class="waves-effect waves-light btn right"><i class="material-icons">drag_handle</i> <?= $t['status']; ?></button>    
                <button class="waves-effect waves-light btn left"><i class="material-icons">assignment</i> Заявка № <?=$t['id'];?></button>
                <button class="waves-effect waves-light btn left card-time" data-time="<?= $t['timeCreated']; ?>"><i class="material-icons">access_time</i></button>
                <div class="card">
                  <div class="card-content">
                    <div class="col s12">
                    <h5>Информация о пользователе:</h5>
                    <div class="chip teal white-text">
                         <i class="material-icons">account_circle</i>
                        <?= $t['customer']; ?>
                    </div>
                    <div class="chip teal white-text">
                         <i class="material-icons">email</i>
                        <?= $emails[$t['id']]; ?>
                    </div>
                    </div>
                    <div class="col s12">
                    <h5>Информация о цене:</h5>
                    <div class="chip teal white-text">
                        <i class="material-icons">attach_money</i>
                        <?php if(is_null($t['cost'])): ?>
                        Стоимость: 0 руб.
                         <?php else: ?>
                         Стоимость: <?= $t['cost']; ?> руб.
                        <?php endif; ?>  
                    </div>
                    <div class="chip teal white-text">
                        <?php if($t['paid'] === 'Yes'):?>
                          <i class="material-icons">verified_user</i> Оплачена
                          <?php else: ?>
                          <i class="material-icons">block </i> Не оплачена
                          <?php endif; ?>
                    </div>
                    </div>
                    <h5>Области исследования:</h5>
                     <?php $organs = explode(',', $t['organ']); ?>
                     <?php if($organs !== " "):?>
                     <?php foreach ($organs as $key => $o) :?>
                     <div class="chip teal white-text"><?= $o; ?><i class="close material-icons">close</i></div> 
                     <?php endforeach; ?>
                     <?php endif; ?>
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
                    <?php $ids = explode(',', $t['complex']); ?>
                    <ul class="collapsible">
                       <li>
                          <div class="collapsible-header"><h5><i class="material-icons">drafts</i> Снимки</h5> <span class="new badge"  data-badge-caption="<?= count($ids); ?> "></span> </div>
                          <div class="collapsible-body">
                    <?php foreach($ids as $key=>$id): ?>
                       <a class="chip teal white-text" href="<?= base_url().'Tasks/trace/'.$id.'/downloaded'; ?>"><?= 'Часть '. ($key+1); ?></a>
                    <?php endforeach; ?>
                        </li>
                    </ul>
                    <ul class="collapsible">
                      <li>
                      <?php if (isset($tasksEventsFiltered[$t['id']])) :?>
                      <div class="collapsible-header"><h5><i class="material-icons">history</i> История</h5> <span class="new badge"  data-badge-caption="<?= count($tasksEventsFiltered[$t['id']]); ?> "></span> </div>
                      <div class="collapsible-body">
                      <?php foreach ($tasksEventsFiltered[$t['id']] as $te): ?>
                          <div><?= $te['eventDescription']; ?></div>
                      <?php endforeach; ?>
                      </div>
                      </li>
                      <?php else: ?>
                        <div class="collapsible-header"><h5><i class="material-icons">drafts</i> История</h5> <span class="new badge"  data-badge-caption="Измнений в статусах нет"></span> </div>
                      <?php endif; ?>
                    </ul>

                </div>
                <div class="card-action">
                    <a href="<?= base_url();?>Tasks/provideAttachments/<?=$t['id']; ?>">Работа с файлами</a>
                    <a onclick="deleteTaskPopup(<?= $t['id']; ?>)"><i class="material-icons">delete</i> Удалить</a>
                </div>
            </div>


                <div class="modal-footer">
                  <a href="#!" class="modal-close waves-effect waves-green btn-flat">Ок</a>
                </div>


            </div>
            </div>
        </div>

<?php endif; ?>

<?php endforeach ; ?>
</li>
 </ul>
</div>

<div class="col s4 m2">
    <ul class="collapsible">
      <li>
      <div class="collapsible-header teal darken-4 white-text">Ждут заключения<span class="new badge"  data-badge-caption="<?= $statistics["Waiting"]; ?>"></span></div>
<?php foreach($tasks as $t): ?>
<?php if ($t['status'] === 'Ждут заключения'): ?>
        <div class="collapsible-body">
          <?php
              $statuses = ['Проверка заказа', 'Обрабатывается', 'Ждут заключения', 'Исполнено'];
              $keyNextStatus = array_search($t['status'], $statuses);
              $nextStatus = $statuses[$keyNextStatus+1];
              $date = date_create($t['timeCreated']);
              $timeMD = date_format($date, 'm-d');
              $timeYMD =  date_format($date, 'Y-m-d');
              $id = $timeMD."-R-".$t['id'];
          ?>
            <div class="collection">
                <a class="collection-item active teal darken-4 center-align">Заявка № <?= $t['id']; ?></a>
                <a class="collection-item active card-time teal darken-1 center-align" data-time="<?= $t['timeCreated']; ?>"></a>
                <a class="collection-item active teal lighten-4 center-align"><?= $t['customer']; ?></a>
                <a class="collection-item btn" href="<?=base_url();?>Tasks/changeStatus/<?= $t['id'];?>/<?= $nextStatus; ?>">Поднять +1</a>
                <a class="collection-item btn" href="<?= base_url().'Tasks/generateGooogleDoc/'.$id.'/'.$timeYMD;?>">Google</a>
                <a class="trello collection-item btn" data-id="<?= $t['id']; ?>" data-customer="<?= $emails[$t['id']]; ?>" data-time="<?= $t['timeCreated']; ?>" data-organ="<?= $t['organ']; ?>">Trello</a>
                <a class="collection-item btn modal-trigger" href="#modal<?=$t['id'];?>">Подробнее</a>
            </div>
            <div id="modal<?=$t['id'];?>" class="modal bottom-sheet">
                <div class="modal-content">
                 <button class="waves-effect waves-light btn right"><i class="material-icons">drag_handle</i> <?= $t['status']; ?></button>    
                <button class="waves-effect waves-light btn left"><i class="material-icons">assignment</i> Заявка № <?=$t['id'];?></button>
                <button class="waves-effect waves-light btn left card-time" data-time="<?= $t['timeCreated']; ?>"><i class="material-icons">access_time</i></button>
                <div class="card">
                  <div class="card-content">
                    <div class="col s12">
                    <h5>Информация о пользователе:</h5>
                    <div class="chip teal white-text">
                         <i class="material-icons">account_circle</i>
                        <?= $t['customer']; ?>
                    </div>
                    <div class="chip teal white-text">
                         <i class="material-icons">email</i>
                        <?= $emails[$t['id']]; ?>
                    </div>
                    </div>
                    <div class="col s12">
                    <h5>Информация о цене:</h5>
                    <div class="chip teal white-text">
                        <i class="material-icons">attach_money</i>
                        <?php if(is_null($t['cost'])): ?>
                        Стоимость: 0 руб.
                         <?php else: ?>
                         Стоимость: <?= $t['cost']; ?> руб.
                        <?php endif; ?>  
                    </div>
                    <div class="chip teal white-text">
                        <?php if($t['paid'] === 'Yes'):?>
                          <i class="material-icons">verified_user</i> Оплачена
                          <?php else: ?>
                          <i class="material-icons">block </i> Не оплачена
                          <?php endif; ?>
                    </div>
                    </div>
                    <h5>Области исследования:</h5>
                     <?php $organs = explode(',', $t['organ']); ?>
                     <?php if($organs !== " "):?>
                     <?php foreach ($organs as $key => $o) :?>
                     <div class="chip teal white-text"><?= $o; ?><i class="close material-icons">close</i></div> 
                     <?php endforeach; ?>
                     <?php endif; ?>
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
                    <?php $ids = explode(',', $t['complex']); ?>
                    <ul class="collapsible">
                       <li>
                          <div class="collapsible-header"><h5><i class="material-icons">drafts</i> Снимки</h5> <span class="new badge"  data-badge-caption="<?= count($ids); ?> "></span> </div>
                          <div class="collapsible-body">
                    <?php foreach($ids as $key=>$id): ?>
                       <a class="chip teal white-text" href="<?= base_url().'Tasks/trace/'.$id.'/downloaded'; ?>"><?= 'Часть '. ($key+1); ?></a>
                    <?php endforeach; ?>
                        </li>
                    </ul>
                    <ul class="collapsible">
                      <li>
                      <?php if (isset($tasksEventsFiltered[$t['id']])) :?>
                      <div class="collapsible-header"><h5><i class="material-icons">history</i> История</h5> <span class="new badge"  data-badge-caption="<?= count($tasksEventsFiltered[$t['id']]); ?> "></span> </div>
                      <div class="collapsible-body">
                      <?php foreach ($tasksEventsFiltered[$t['id']] as $te): ?>
                          <div><?= $te['eventDescription']; ?></div>
                      <?php endforeach; ?>
                      </div>
                      </li>
                      <?php else: ?>
                        <div class="collapsible-header"><h5><i class="material-icons">history</i> История</h5> <span class="new badge"  data-badge-caption="Измнений в статусах нет"></span> </div>
                      <?php endif; ?>
                    </ul>

                </div>
                <div class="card-action">
                    <a href="<?= base_url();?>Tasks/provideAttachments/<?=$t['id']; ?>">Работа с файлами</a>
	            <a onclick="deleteTaskPopup(<?= $t['id']; ?>)"><i class="material-icons">delete</i> Удалить</a>
                </div>
            </div>


                <div class="modal-footer">
                  <a href="#!" class="modal-close waves-effect waves-green btn-flat">Ок</a>
                </div>


            </div>
            </div>
        </div>

<?php endif; ?>

<?php endforeach ; ?>

</li>
 </ul>
</div>

<div class="col s4 m2">
    <ul class="collapsible">
      <li>
      <div class="collapsible-header teal darken-4 white-text">Исполнено<span class="new badge"  data-badge-caption="<?= $statistics["Finished"]; ?>"></span></div>
<?php foreach($tasks as $t): ?>
<?php if ($t['status'] === 'Исполнено'): ?>
          <div class="collapsible-body">
          <?php
              $statuses = ['Проверка заказа', 'Обрабатывается', 'Ждут заключения', 'Исполнено'];
              $keyNextStatus = array_search($t['status'], $statuses);
              $nextStatus = $statuses[$keyNextStatus];
              $date = date_create($t['timeCreated']);
              $timeMD = date_format($date, 'm-d');
              $timeYMD =  date_format($date, 'Y-m-d');
              $id = $timeMD."-R-".$t['id'];
          ?>
            <div class="collection">
                <a class="collection-item active teal darken-4 center-align">Заявка № <?= $t['id']; ?></a>
                <a class="collection-item active card-time teal darken-1 center-align" data-time="<?= $t['timeCreated']; ?>"></a>
                <a class="collection-item active teal lighten-4 center-align"><?= $t['customer']; ?></a>
                <a class="collection-item btn" href="<?=base_url();?>Tasks/changeStatus/<?= $t['id'];?>/<?= $nextStatus; ?>" disabled>Поднять +1</a>
                <a class="collection-item btn" href="<?= base_url().'Tasks/generateGooogleDoc/'.$id.'/'.$timeYMD;?>">Google</a>
                <a class="trello collection-item btn" data-id="<?= $t['id']; ?>" data-customer="<?= $emails[$t['id']]; ?>" data-time="<?= $t['timeCreated']; ?>" data-organ="<?= $t['organ']; ?>">Trello</a>
                <a class="collection-item btn modal-trigger" href="#modal<?=$t['id'];?>">Подробнее</a>
            </div>
            <div id="modal<?=$t['id'];?>" class="modal bottom-sheet">
                <div class="modal-content">
                 <button class="waves-effect waves-light btn right"><i class="material-icons">drag_handle</i> <?= $t['status']; ?></button>    
                <button class="waves-effect waves-light btn left"><i class="material-icons">assignment</i> Заявка № <?=$t['id'];?></button>
                <button class="waves-effect waves-light btn left card-time" data-time="<?= $t['timeCreated']; ?>"><i class="material-icons">access_time</i></button>
                <div class="card">
                  <div class="card-content">
                    <div class="col s12">
                    <h5>Информация о пользователе:</h5>
                    <div class="chip teal white-text">
                         <i class="material-icons">account_circle</i>
                        <?= $t['customer']; ?>
                    </div>
                    <div class="chip teal white-text">
                         <i class="material-icons">email</i>
                        <?= $emails[$t['id']]; ?>
                    </div>
                    </div>
                    <div class="col s12">
                    <h5>Информация о цене:</h5>
                    <div class="chip teal white-text">
                        <i class="material-icons">attach_money</i>
                        <?php if(is_null($t['cost'])): ?>
                        Стоимость: 0 руб.
                         <?php else: ?>
                         Стоимость: <?= $t['cost']; ?> руб.
                        <?php endif; ?>  
                    </div>
                    <div class="chip teal white-text">
                        <?php if($t['paid'] === 'Yes'):?>
                          <i class="material-icons">verified_user</i> Оплачена
                          <?php else: ?>
                          <i class="material-icons">block </i> Не оплачена
                          <?php endif; ?>
                    </div>
                    </div>
                    <h5>Области исследования:</h5>
                     <?php $organs = explode(',', $t['organ']); ?>
                     <?php if($organs !== " "):?>
                     <?php foreach ($organs as $key => $o) :?>
                     <div class="chip teal white-text"><?= $o; ?><i class="close material-icons">close</i></div> 
                     <?php endforeach; ?>
                     <?php endif; ?>
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
                    <?php $ids = explode(',', $t['complex']); ?>
                    <ul class="collapsible">
                       <li>
                          <div class="collapsible-header"><h5><i class="material-icons">drafts</i> Снимки</h5> <span class="new badge"  data-badge-caption="<?= count($ids); ?> "></span> </div>
                          <div class="collapsible-body">
                    <?php foreach($ids as $key=>$id): ?>
                       <a class="chip teal white-text" href="<?= base_url().'Tasks/trace/'.$id.'/downloaded'; ?>"><?= 'Часть '. ($key+1); ?></a>
                    <?php endforeach; ?>
                        </li>
                    </ul>
                    <ul class="collapsible">
                      <li>
                      <?php if (isset($tasksEventsFiltered[$t['id']])) :?>
                      <div class="collapsible-header"><h5><i class="material-icons">history</i> История</h5> <span class="new badge"  data-badge-caption="<?= count($tasksEventsFiltered[$t['id']]); ?> "></span> </div>
                      <div class="collapsible-body">
                      <?php foreach ($tasksEventsFiltered[$t['id']] as $te): ?>
                          <div><?= $te['eventDescription']; ?></div>
                      <?php endforeach; ?>
                      </div>
                      </li>
                      <?php else: ?>
                        <div class="collapsible-header"><h5><i class="material-icons">drafts</i> История</h5> <span class="new badge"  data-badge-caption="Измнений в статусах нет"></span> </div>
                      <?php endif; ?>
                    </ul>
                </div>
                <div class="card-action">
                    <a href="<?= base_url();?>Tasks/provideAttachments/<?=$t['id']; ?>">Работа с файлами</a>
                    <a onclick="deleteTaskPopup(<?= $t['id']; ?>)"><i class="material-icons">delete</i> Удалить</a>
                </div>
            </div>


                <div class="modal-footer">
                  <a href="#!" class="modal-close waves-effect waves-green btn-flat">Ок</a>
                </div>


            </div>
            </div>
        </div>

<?php endif; ?>

<?php endforeach ; ?>

</li>
 </ul>
</div>

       <div class="col s6 m4">
          <ul class="collapsible">
            <li>
              <div class="collapsible-header"><i class="material-icons">search</i>Поиск заявок</div>
              <div class="collapsible-body">
                <ul class="collapsible">
                  <li>
                    <div class="collapsible-header"><i class="material-icons">format_list_numbered</i>По номеру заявки</div>
                    <div class="collapsible-body">
                      <span>C:</span>
                      <input type="text" class="datepicker">
                      <span>До:</span>
                      <input type="text" class="datepicker">
                    </div>
                  </li>
                  <li>
                    <div class="collapsible-header"><i class="material-icons">account_box</i>По пользователю</div>
                    <div class="collapsible-body">
                      <div class="input-field">
                        <i class="material-icons prefix">textsms</i>
                          <input type="text" id="autocomplete-input" class="autocomplete">
                          <label for="autocomplete-input">...</label>
                        </div>
                    </div>
                  </li>
                  <li>
                    <div class="collapsible-header"><i class="material-icons">access_time</i>По временным параметрам</div>
                    <div class="collapsible-body">
                      <span>C:</span>
                      <input type="text" class="datepicker">
                      <span>До:</span>
                      <input type="text" class="datepicker">
                    </div>
                  </li>
                  </ul>
              </div>
          </li>
            <li>
              <div class="collapsible-header"><i class="material-icons">build</i>Состояние служб</div>
              <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
            </li>
            <li>
              <div class="collapsible-header"><i class="material-icons">drafts</i>Отчетность</div>
              <div class="collapsible-body">
                <table>
                  <thead>
                    <tr>
                      <th>Период</th>
                      <th>Проверка заказа</th>
                      <th>Обрабатывается</th>
                      <th>Ждут заключения</th>
                      <th>Исполнено</th>
                      <th>Документ</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td>Все время</td>
                      <td><?= $statistics["Inited"]; ?></td>
                      <td><?= $statistics["Processing"]; ?></td>
                      <td><?= $statistics["Waiting"]; ?></td>
                      <td><?= $statistics["Finished"]; ?></td>
                      <td>Скачать</td>
                    </tr>
                    <tr>
                      <td>Год</td>
                      <td>Jellybean</td>
                      <td>$3.76</td>
                      <td>Alvin</td>
                      <td>Eclair</td>
                      <td>Скачать</td>
                    </tr>
                    <tr>
                      <td>Квартал</td>
                      <td>Lollipop</td>
                      <td>$7.00</td>
                      <td>Alvin</td>
                      <td>Eclair</td>
                      <td>Скачать</td>
                    </tr>
                    <tr>
                      <td>Месяц</td>
                      <td>Lollipop</td>
                      <td>$7.00</td>
                      <td>Alvin</td>
                      <td>Eclair</td>
                      <td>Скачать</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </li>
            <li>
              <div class="collapsible-header"><i class="material-icons">history</i>История заявок</div>
              <div class="collapsible-body">
                <?php foreach ($tasksEvents as $te): ?>
                    <p style="padding: 5px;">Задание № <?= $te['taskId']; ?>.<?= $te['eventDescription']; ?></p>
                <?php endforeach; ?>
            </div>
            </li>
        </ul>
        </div>
</div>
