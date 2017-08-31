<?php
  function getToken($account, $password, $url){
    //$password = "Acho08mkr";
    //$account = "narongsak.mala@ega.or.th";
    //$password = "Acho20mkr";
    //$account = "pepsi2@mail.centos7.lan";
    //$url = "https://192.168.243.146/service/soap";
    $body = '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope">'
        .'<soap:Header>'
        .'<context xmlns="urn:zimbra"/>'
        .'</soap:Header>'
        .'<soap:Body>'
        .'<AuthRequest xmlns="urn:zimbraAccount">'
        .'<account by="name">'.$account.'</account>'
        .'<password>'.$password.'</password>'
        .'</AuthRequest>'
        .'</soap:Body>' 
        .'</soap:Envelope>';
   
    $headers = array('Content-Type: application/soapxml','Connection: keep-alive','Connection: close',"Content-length: ".strlen($body),"Cache-Control: no-cache",
      "Pragma: no-cache",
      "SOAPAction: \"run\"",);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    
    $result = curl_exec($ch);
    
    if (curl_errno($ch)) 
    {
      // moving to display page to display curl errors
      echo curl_errno($ch)."</br>" ;
      echo curl_error($ch)."</br>";
    }
    
    curl_close($ch);
    
    if( $result == NULL ){
      echo "error: no response"."</br>";
    }else{
      $begin = strpos($result,'<authToken>')+strlen('<authtoken>');
      if( $begin === false ){
        echo "No found token";
      }
      $end = strpos($result,'</authToken>');
      $token = substr($result, $begin, $end-$begin);
      //echo "<br/></br>token: ".$token;
    }
    return $token;
  }
  
  /************************ ZIMBRA API *************************/
  // GetFolderRequest
  function getFolderRequest($token, $url){
    $body = '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope">'
        .'<soap:Header>'
        .'<context xmlns="urn:zimbra">'
        .'<format type="xml"/>'
        .'<authToken>'.$token.'</authToken>'
        .'</context>'
        .'</soap:Header>'
        .'<soap:Body>'
        .'<GetFolderRequest xmlns="urn:zimbraMail" visible="1">'
        .'<folder l="2" ></folder>'
        .'</GetFolderRequest>'
        .'</soap:Body>' 
        .'</soap:Envelope>';
   
    $headers = array('Content-Type: application/soapxml','Connection: keep-alive','Connection: close',"Content-length: ".strlen($body),"Cache-Control: no-cache","Pragma: no-cache","SOAPAction: \"run\"",);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    
    $result = curl_exec($ch);
    
    if (curl_errno($ch)) 
    {
      // moving to display page to display curl errors
      echo curl_errno($ch)."</br>" ;
      echo curl_error($ch)."</br>";
    }
    
    curl_close($ch);
    return $result;
  }
?>
