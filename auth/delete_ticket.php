<?php
session_start();
require_once "../config/db.php";

// 1️⃣ check login
if (!isset($_SESSION["user_id"])) {
    header("Location: ../public/login.php");
    exit();
}

// 2️⃣ only admin
if ($_SESSION["role"] !== "admin") {
    die("Access denied");
}

// 3️⃣ get ticket id
$ticket_id = $_POST["ticket_id"];

// 4️⃣ delete
$stmt = $pdo->prepare("DELETE FROM tickets WHERE id = ?");
$stmt->execute([$ticket_id]);

// 5️⃣ redirect back
header("Location: ../public/admin_tickets.php");
exit();
?>