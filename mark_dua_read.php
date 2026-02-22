<?php
session_start();
include 'config.php';

// Hubi login
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if(isset($_POST['mark_read'], $_POST['dua_id'], $_POST['day'])){
    $date_read = date('Y-m-d');

    $mysql = $conn->prepare(
        "INSERT IGNORE INTO dua_progress 
        (user_id, dua_id, day, date_read) 
        VALUES (:user_id, :dua_id, :day, :date_read)"
    );

    $mysql->bindParam(':user_id', $user_id);
    $mysql->bindParam(':dua_id', $_POST['dua_id']);
    $mysql->bindParam(':day', $_POST['day']);
    $mysql->bindParam(':date_read', $date_read);
    $mysql->execute();

    $_SESSION['success'] = "Daily Dua marked as read!";
    header("Location: dhashboard.php"); // redirect sax ah
    exit;
}
?>