<?php
session_start();
include 'config.php';

// Hubi login
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if(isset($_POST['mark_read'], $_POST['ayah_range'])){
    $date_read = date('Y-m-d');

    $mysql = $conn->prepare(
        "INSERT INTO quran_progress
         (user_id, ayah_range, date_read)
          VALUES (:user_id, :ayah_range, :date_read)"
    );

    $mysql->bindParam(':user_id', $user_id);
    $mysql->bindParam(':ayah_range', $_POST['ayah_range']);
    $mysql->bindParam(':date_read', $date_read);
    $mysql->execute();

    $_SESSION['success'] = "Quran reading recorded!";
    header("Location: dhashboard.php"); // redirect sax ah
    exit;
}
?>