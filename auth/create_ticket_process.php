<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

session_start();
require_once "../config/db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ../public/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /*
    // 🔍 DEBUG（先開住）
    var_dump($_POST);
    var_dump($_SESSION["user_id"]);
    exit();
    */
    
    $user_id = $_SESSION["user_id"];
    $title = $_POST["title"];
    $description = $_POST["description"];

    $stmt = $pdo->prepare("
        INSERT INTO tickets (user_id, title, description, status)
        VALUES (?, ?, ?, 'Open')
    ");

    $stmt->execute([$user_id, $title, $description]);
    /*echo "INSERT DONE";
    exit();*/

    header("Location: ../public/dashboard.php");
    exit();
}
?>