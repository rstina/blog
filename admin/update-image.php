<?php
/**************************************** *
 * update image in db to empty
**************************************** */
require_once '../db.php';

if(isset($_GET['id'])){
  $id = htmlspecialchars($_GET['id']); 
  $sql = "UPDATE blog SET image = '' WHERE id = $id;";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
}

header('Location:edit.php?id='.$id);