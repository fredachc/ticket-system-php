<?php
session_start();
require_once "../config/db.php";

// 1️⃣ 檢查登入
if (!isset($_SESSION["user_id"])) {
    header("Location: ../public/login.php");
    exit();
}

// 2️⃣ 只允許 admin
if ($_SESSION["role"] !== "admin") {
    die("Access denied");
}

// 3️⃣ 接收資料
$ticket_id = $_POST["ticket_id"];
$status = $_POST["status"];

// 4️⃣ 更新 database
$stmt = $pdo->prepare("UPDATE tickets SET status = ? WHERE id = ?");
$stmt->execute([$status, $ticket_id]);

// 5️⃣ 返回 admin page
header("Location: ../public/admin_tickets.php");
exit();
?>