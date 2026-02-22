<?php
session_start();
include 'config.php';

// Hubi user login
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Haddii id la siiyay
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $mysql = $conn->prepare(
      "DELETE FROM tasks WHERE id=:id AND user_id=:user_id"
    );
    $mysql->bindParam(':id', $id);
    $mysql->bindParam(':user_id', $user_id);
    $mysql->execute();
}

// Redirect sax ah
header("Location: dhashboard.php");
exit;
?>