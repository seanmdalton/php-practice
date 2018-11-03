<?php
  require_once './loadList.php';
  require_once './loadCert.php';
  require_once './timeManip.php';

  $list = new loadList();
  $cert = new loadCert();
  $timeManip = new timeManip();


  $list->from_file('./sites');

  $expiry_time = 1542738180; #$cert->parse_url('https://www.google.com')->load_cert()->get_cert_detail('validTo_time_t');

  // echo gmdate("Y-m-d\TH:i:s\Z", $expiry_time);

  // echo  gmdate("Y-m-d\TH:i:s\Z", $certinfo['validTo_time_t']);

  echo $timeManip->calc_time_until($expiry_time);

?>
