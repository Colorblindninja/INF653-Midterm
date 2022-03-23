<?php

    $dsn = '';
    $username = '';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include(ROOT . '/view/database_error.php');
        exit();
    }
?>
