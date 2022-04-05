<?php

    $dsn = 'mysql:host=grp6m5lz95d9exiz.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=ayymqm9lwu8727rl';
    $username = 'c4y7tfufdjwdvq6q';
    $password = 'bqkba3fqkpxwzo5i';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include(ROOT . '/view/database_error.php');
        exit();
    }
?>
