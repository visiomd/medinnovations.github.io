<h1>Платеж прошел успешно</h1>
<?php
$mrh_pass1 = "eJEP6oI6Ghr9HeCCO7s5";
//    echo $Shp_user;
//echo $out_summ;
//echo '</br>';
//echo strtoupper($crc);
//echo '</br>';
$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass1:Shp_user=$Shp_user"));
//echo $my_crc;
if (strtoupper($crc) === $my_crc)
{
   //
}
?>