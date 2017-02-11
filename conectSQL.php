<?php
            
            $dblocation = "localhost";
            $dbname = "db";
            $dbuser = "admin";
            $dbpasswd = "777";
            $mysqli = new mysqli($dblocation,$dbuser,$dbpasswd,$dbname);
            $mysqli->set_charset("utf8");
  if ($mysqli->connect_errno) {
                                        die('Ошибка соединения: ' . $mysqli->connect_errno);
            }
            
?>