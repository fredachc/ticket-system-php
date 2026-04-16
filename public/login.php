<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php session_start(); ?>

<!DOCTYPE html>
<html>


<head>
    <title>Login</title>
</head>
<body>



<div class="container d-flex justify-content-center align-item-center" style="height:100vh;">
    <div class="card p-4 shadow" style="width:400px;">
        <h3 class="mb-3 text-center">Login</h3>

<?php
if (isset($_SESSION['error'])) {
    echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}
?>

<form action="../auth/login_process.php" method="POST">

    <div class="mb-3">
        <label class="form-label">Username:<label>
        <input type="text" name="username" required class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Password:<label>
        <input type="password" name="password" required class="form-control">
    </div>


    <button class="btn btn-primary w-100" type="submit" class="btn">Login</button>
    </div>
</div>

</form>
</div>
</body>
</html>