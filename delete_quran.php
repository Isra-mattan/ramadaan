<?php
session_start();
include 'config.php';

// Hubi in user login yahay
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Haddii id la siiyay
if(isset($_GET['id'])){
    $stmt = $conn->prepare("DELETE FROM quran_progress 
                            WHERE id=:id AND user_id=:user_id");

    $stmt->bindParam(':id', $_GET['id']);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
}

// Redirect sax ah
header("Location: dhashboard.php");
exit;
?>