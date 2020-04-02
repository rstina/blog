<?php
/**************************************** *
 * filename: index.php
 * author: Stina Englesson
 * date 2020-04-02
 * 
 * landing page for admin
**************************************** */

require_once '../db.php';
require_once '../header-admin.php';

?>

<h1>Administrera blogginlägg</h1>

<?php 
require_once 'read.php';
require_once '../footer.php'; 
?>