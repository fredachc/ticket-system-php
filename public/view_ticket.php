<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
session_start();
require_once "../config/db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];

$stmt = $pdo->prepare("SELECT * FROM tickets WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$tickets = $stmt->fetchAll();
?>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">My Tickets</h2>

        <a href="create_ticket.php" class="btn btn-primary">
            + Create New Ticket
        </a>
    </div>

    <?php if (count($tickets) == 0): ?>

        <div class="alert alert-info">
            No tickets found.
        </div>

    <?php else: ?>

        <div class="row g-3">

            <?php foreach ($tickets as $t): ?>

                <div class="col-12">
                    <div class="card shadow-sm hover-shadow">

                        <div class="card-body">

                            <div class="d-flex justify-content-between align-items-start">

                                <h5 class="card-title mb-2">
                                    <?php echo htmlspecialchars($t["title"]); ?>
                                </h5>

                                <?php if ($t["status"] == "open"): ?>
                                    <span class="badge bg-success">Open</span>
                                <?php elseif ($t["status"] == "closed"): ?>
                                    <span class="badge bg-secondary">Closed</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">
                                        <?php echo htmlspecialchars($t["status"]); ?>
                                    </span>
                                <?php endif; ?>

                            </div>

                            <p class="card-text text-muted">
                                <?php echo nl2br(htmlspecialchars($t["description"])); ?>
                            </p>

                            <div class="d-flex justify-content-between">
                                <small class="text-muted">
                                    Created: <?php echo $t["created_at"]; ?>
                                </small>
                            </div>

                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</div>

<style>
    .hover-shadow {
        transition: 0.2s ease-in-out;
    }

    .hover-shadow:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }
</style>