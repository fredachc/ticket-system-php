<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION["role"] ?? 'user';
$username = $_SESSION["username"] ?? 'User';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<!-- 🔝 Navbar -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Ticket System</span>
        <span class="text-white">
            Welcome, <?php echo htmlspecialchars($username); ?>
        </span>
    </div>
</nav>

<!-- 📦 Main Content -->
<div class="container mt-5">

    <h2 class="mb-4">Dashboard</h2>

    <div class="card p-4 shadow">

        <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
        <p><strong>Role:</strong> <?php echo htmlspecialchars($role); ?></p>

        <hr>

        <!-- Buttons -->
        <div class="d-flex gap-2 flex-wrap">

            <a href="create_ticket.php" class="btn btn-primary">
                Create Ticket
            </a>

            <a href="view_ticket.php" class="btn btn-secondary">
                View Tickets
            </a>

            <?php if ($role === "admin"): ?>
                <a href="admin_tickets.php" class="btn btn-warning">
                    Manage Tickets (Admin)
                </a>
            <?php endif; ?>

            <a href="logout.php" class="btn btn-danger ms-auto">
                Logout
            </a>

        </div>

    </div>

</div>

</body>
</html>