<?php
/**************************************** *
 * filename: publish-update.php
 * author: Stina Englesson
 * date 2020-04-02
 * 
 * update publish status in db
**************************************** */
include_once '../db.php';

$id = htmlentities($_GET['id']);
$publish = "publish";

$sql = "UPDATE blog
SET 
publish = '$publish', date = CURRENT_TIMESTAMP
WHERE id = $id;";

$stmt = $db->prepare($sql);
$stmt->execute();

header('Location: index.php');