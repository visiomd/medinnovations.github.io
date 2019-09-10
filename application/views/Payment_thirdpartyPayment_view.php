<?php
  $mrh_login = "Medinnovations.ru";
  $mrh_pass1 = "v4rl8Oiqa2dsScMFi50n";
  $inv_id = $id;
  $inv_desc = "Компьютерно-диагностическая обработка (КТ, МРТ, ПЭТ)";
  $out_summ = strval(10);
  $Shp_user = $username;
  $Shp_service = 'DICOM';
  $def_sum = "10";

  $Receipt = ["sno"    => "usn_income_outcome",
              "items"  => ["name"             => $inv_desc,
                           "quantity"         => 1,
                            "sum"             => $out_summ,
                            "payment_method"  => "full_prepayment",
                            "payment_object"  => "service"
                          ]];
  $Receipt = json_encode($Receipt);
  $crc  = md5("$mrh_login::$inv_id:$Receipt:$mrh_pass1:Shp_service=$Shp_service:Shp_user=$Shp_user");
?>
<ul class="collection with-header">
        <li class="collection-header"><h4><i class="material-icons">info_outline</i> Информация о платеже </h4>
          <h4>(Цена услуги определяется по договору с заказчиком)</h4>
        </li>
        <li class="collection-item">
          <table class="centered">
          <thead class="teal lighten-4">
            <tr>
                <th><i class="material-icons">format_list_numbered</i> Заявка</th>
                <th>Цена (рублей)</th>
                <th><i class="material-icons">room_service </i>Услуга </th>
                <th><i class="material-icons">link </i>Ссылка на оплату </th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td>№ <?= $id; ?></td>
              <td>..</td>
              <td><?= $inv_desc; ?></td>
              <td>
                <h5>Введите цену, указанную в договоре</h5>
                <?php
                  print "<html><script ".
                  "src='https://auth.robokassa.ru/Merchant/PaymentForm/FormFLS.js?".
                  "MerchantLogin=$mrh_login&DefaultSum=$def_sum&InvId=$inv_id&Receipt=$Receipt".
                  "&Description=$inv_desc&SignatureValue=$crc&Shp_service=$Shp_service&Shp_user=$Shp_user'></script></html>";
              ?>
              </td>
            </tr>
          </tbody>
        </table>
      </li>
</ul>
<ul class="collapsible">
    <li>
      <div class="collapsible-header">
        <h5><i class="material-icons">share</i>Поделиться ссылкой с другом </h5>
        <div class="col s4 offset-s3">
        <h5>
        <script src="https://vk.com/js/api/share.js?95"></script>
        <script>
            document.write(VK.Share.button(false,{type: "custom", text: "<img src=\"https://vk.com/images/share_32.png\" width=\"32\" height=\"32\" />"}));
        </script> 
        </h5>
        </div>


      </div>
      <div class="collapsible-body">
        <input type="text" value="http://www.medinnovations.ru/Payment/thirdpartyPayment">
        <a href="#" target="_blank"><img class="qrcode" src="http://qrcoder.ru/code/?http%3A%2F%2Fwww.medinnovations.ru%2FPayment%2FthirdpartyPayment&4&0" width="164" height="164" border="0" title="QR код"></a>
      </div>
    </li>
</ul>
<script>
  $(document).ready(function(){
    $('.collapsible').collapsible();
  });
</script>

