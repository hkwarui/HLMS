<?php

  $DBhost = "localhost";
  $DBuser = "root";
  $DBpass = "";
  $DBname = "hlms";

  date_default_timezone_set('Africa/Nairobi');

  $DBcon = new MySQLi($DBhost,$DBuser,$DBpass,$DBname);

     if ($DBcon->connect_errno) {
         die("ERROR : -> ".$DBcon->connect_error);
     }
