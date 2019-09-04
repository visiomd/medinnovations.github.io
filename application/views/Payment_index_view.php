<?php
  $mrh_login = "Medinnovations.ru";
  $mrh_pass1 = "v4rl8Oiqa2dsScMFi50n";
  $inv_id = $id;
  $inv_desc = "Компьютерно-диагностическая обработка (КТ, МРТ, ПЭТ)";
  $out_summ = strval($cost);
  $Shp_user = $username;
  $Shp_service = 'DICOM';
  $Receipt = ["sno"    => "usn_income_outcome",
              "items"  => ["name"             => $inv_desc,
                           "quantity"         => 1,
                            "sum"             => $out_summ,
                            "payment_method"  => "full_prepayment",
                            "payment_object"  => "service"
                          ]];
  $Receipt = json_encode($Receipt);
  $crc  = md5("$mrh_login:$out_summ:$inv_id:$Receipt:$mrh_pass1:Shp_service=$Shp_service:Shp_user=$Shp_user");
?>
<ul class="collection with-header">
        <div class="header"></div>
        <li class="collection-header"><h4>Информация о платеже</h4></li>
        <li class="collection-item">
          <table class="centered">
          <thead class="teal lighten-4">
            <tr>
                <th><h5><i class="material-icons">format_list_numbered</i> Заявка</h5></th>
                <th><h5><i class="material-icons">attach_money</i> Цена</h5></th>
                <th><h5><i class="material-icons">room_serviceУслуга </i> </h5></th>
                <th><h5><i class="material-icons">linkСсылка на оплату </i> </h5></th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td><h5> № <?= $id; ?></h5></td>
              <td><h5><?= $cost; ?></h5></td>
              <td><h5><?= $inv_desc; ?></h5></td>
              <td>
                <?php
                  print "<html><script language=JavaScript ".
                  "src='https://auth.robokassa.ru/Merchant/PaymentForm/FormMS.js?".
                  "MerchantLogin=$mrh_login&OutSum=$out_summ&InvoiceID=$inv_id&Receipt=$Receipt".
                  "&Description=$inv_desc&SignatureValue=$crc&Shp_service=$Shp_service&Shp_user=$Shp_user'></script></html>";
              ?>
              </td>
            </tr>
          </tbody>
        </table>
      </li>
</ul>
