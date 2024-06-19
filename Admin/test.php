<?php

$hostname = 'localhost';$username = 'root';$password = '';
try {
$db = new PDO("mysql:host=$hostname;dbname=mydbpdo", 
                          $username, $password);
/*** The SQL SELECT statement ***/

$sql = "UPDATE persons SET age=24 WHERE 
                  firstname='myint' AND lastname='aung'";
$db->exec($sql);
$db = null;
}
catch(PDOException $e)
{

  echo $e->getMessage(); 

}

?>