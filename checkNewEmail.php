<?php
  include_once "zimbra_api.php";
  //$token = getToken("pepsi2@mail.centos7.lan", "Acho20mkr", "https://192.168.243.146/service/soap");
  //$folder = getFolderRequest($token, "https://192.168.243.146/service/soap");
  $token = getToken("narongsak@ega.or.th", "Acho08mkr", "https://accounts.mail.go.th/service/soap");
  $folder = getFolderRequest($token, "https://accounts.mail.go.th/service/soap");
  echo $folder;
  $begin = strpos($folder,' u="') + strlen(' u="');
  $end = strpos($folder, '" name="');
  $num_msg = substr($folder, $begin, $end-$begin);
  echo "You've got ".$num_msg." new emails"
?>