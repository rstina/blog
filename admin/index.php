<?php
/**************************************** *
 * filename: index.php
 * author: Stina Englesson & Jing-Jing Lin
 * date 2020-03-27
 * 
 * landing page for admin
**************************************** */

require_once '../db.php';
require_once '../header-admin.php';

?>

<h1>Administrera blogginlägg</h1>

<?php 
require_once '../read-admin.php';
require_once '../footer.php'; 
?>