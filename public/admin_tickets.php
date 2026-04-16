<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION["role"] !== "admin") {
    echo "Access denied (Admin only)";
    exit();
}

$stmt = $pdo->query("SELECT * FROM tickets ORDER BY created_at DESC");
$tickets = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<!-- 🔝 Navbar -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Admin Panel</span>
        <a href="dashboard.php" class="btn btn-light btn-sm">Back</a>
    </div>
</nav>

<div class="container mt-5">

    <h2 class="mb-4">Manage Tickets</h2>

    <div class="card p-4 shadow">

        <table class="table table-hover table-bordered align-middle">

            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th style="width: 250px;">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($tickets as $t): ?>
                    <tr>
                        <td><?php echo $t["id"]; ?></td>

                        <td><?php echo htmlspecialchars($t["title"]); ?></td>

                        <td><?php echo htmlspecialchars($t["description"]); ?></td>

                        <td>
                            <?php
                            $status = $t["status"];
                            $badge = "bg-secondary";

                            if ($status == "Open") $badge = "bg-danger";
                            if ($status == "In Progress") $badge = "bg-warning";
                            if ($status == "Resolved") $badge = "bg-success";
                            ?>

                            <span class="badge <?php echo $badge; ?>">
                                <?php echo $status; ?>
                            </span>
                        </td>

                        <td>

                            <!-- Update -->
                            <form action="../auth/update_status.php" method="POST" class="d-flex gap-2 mb-2">

                                <input type="hidden" name="ticket_id" value="<?php echo $t["id"]; ?>">

                                <select name="status" class="form-select form-select-sm">
                                    <option>Open</option>
                                    <option>In Progress</option>
                                    <option>Resolved</option>
                                </select>

                                <button class="btn btn-primary btn-sm">Update</button>
                            </form>

                            <!-- Delete -->
                            <form action="../auth/delete_ticket.php" method="POST"
                                  onsubmit="return confirm('Delete this ticket?');">

                                <input type="hidden" name="ticket_id" value="<?php echo $t["id"]; ?>">

                                <button class="btn btn-danger btn-sm w-100">Delete</button>
                            </form>

                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

    </div>

</div>

</body>
</html>