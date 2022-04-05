<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zippy Used Autos</title>
    <link rel="stylesheet" href="view/css/main.css">
</head>

<?php
if (isset($_GET["logout"])) {

} elseif (isset($_GET["firstname"]) && !$_GET["firstname"] == false ) {
	echo '<p>Hello '.$_GET["firstname"].'</p><a href="./index.php?logout">Logout</a>';
} else {
	echo '<a href="./index.php?register">Register Here</a>';
}
 ?>

<body>
