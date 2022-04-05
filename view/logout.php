<?php 	
echo '<p> Thanks for logging out ' .$_SESSION['userid']. '</p>';
$_SESSION['userid'] = "";
session_destroy();
setcookie('userid', null, -1, '/');

 ?>
