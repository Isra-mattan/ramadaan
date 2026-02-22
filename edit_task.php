<?php 
session_start();
include 'config.php';

// Hubi login
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$id = isset($_GET['id']) ? $_GET['id'] : 0;  

if($id == 0){
    echo "Task ID lama helin!";
    exit;
}

// Fetch task
$mysql = $conn->prepare("SELECT * FROM tasks WHERE id=:id AND user_id=:user_id");
$mysql->bindParam(':id', $id);
$mysql->bindParam(':user_id', $user_id);
$mysql->execute();
$task = $mysql->fetch(PDO::FETCH_ASSOC);

if(!$task){
    echo "Task ma jiro ama ma lihid ogolaansho aad ku aragto.";
    exit;
}

if(isset($_POST['update'])){
    $subject = $_POST['subject'];
    $topic = $_POST['topic'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $mysql = $conn->prepare("UPDATE tasks SET subject=:subject, topic=:topic, due_date=:due_date, status=:status WHERE id=:id AND user_id=:user_id");
    $mysql->bindParam(':subject', $subject);
    $mysql->bindParam(':topic', $topic);
    $mysql->bindParam(':due_date', $due_date);
    $mysql->bindParam(':status', $status);
    $mysql->bindParam(':id', $id);
    $mysql->bindParam(':user_id', $user_id);
    $mysql->execute();

    header("Location: dhashboard.php"); // redirect sax ah
    exit;
}
?>