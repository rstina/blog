<?php
/**************************************** *
 * filename: unpublish-update.php
 * author: Stina Englesson
 * date 2020-04-02
 * 
 * update publish status in db
**************************************** */
require_once '../db.php';

$id = htmlentities($_GET['id']);
$publish = "unpublish";

$sql = "UPDATE blog
SET 
publish = '$publish'
WHERE id = $id;";

$stmt = $db->prepare($sql);
$stmt->execute();

header('Location: index.php');