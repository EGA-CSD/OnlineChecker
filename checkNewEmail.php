<?php

  include_once "zimbra_api.php";
  
  function check_new_message(){
    $token = getToken("narongsak@ega.or.th", "Acho08mkr", "https://accounts.mail.go.th/service/soap");
    $folder = getFolderRequest($token, "https://accounts.mail.go.th/service/soap");
    echo $folder;
    $begin = strpos($folder,' u="') + strlen(' u="');
    $end = strpos($folder, '" name="');
    $num_msg = substr($folder, $begin, $end-$begin);
    return "You've got ".$num_msg." new emails";
  }
  
?>  