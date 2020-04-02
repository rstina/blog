<?php 
/**************************************** *
 * filename: db.php
 * author: Stina Englesson & Jing-Jing Lin
 * date 2020-03-27
 * 
 * connect to database and server
**************************************** */

$db_server   = "localhost"; // adress till dator server
$db_database = "blog_db"; // ändras alltid
$db_username = "root"; // ändras alltid
$db_password = "root"; // ändras alltid

try{ // skapar objekt 
  $db = new PDO("mysql:host=$db_server;dbname=$db_database;charset=utf8" 
                , $db_username 
                , $db_password);

  $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION); 

  // echo "<h2>Connected Successfully</h2>";

  // vid minsta fel, catch och få error 
}catch(PDOException $e){
  echo "<h2>Error: " . $e-> getMessage() . "</h2>";
}