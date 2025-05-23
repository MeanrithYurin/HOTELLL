<?php
session_start();
require('inc/db_config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login-form.css">
    <?php require('inc/link.php'); ?>
</head>
<body class="bg-light">

<div class="login-form text-center rounded bg-white shadow overflow-hidden">
    <form method="POST" action="">
        <h4 class="bg-dark text-white py-3">ADMIN LOGIN PANEL</h4>
        <div class="p-4">
            <div class="mb-3">
                <label class="form-label">Admin Name</label>
                <input name="admin_name" required type="text" class="form-control shadow text-center" placeholder="Admin Name">
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <input name="admin_password" required type="password" class="form-control shadow-none text-center" placeholder="Password">
            </div>
            <button name="login" type="submit" class="btn btn-primary w-100">LOGIN</button>
        </div>
    </form>
</div>

<?php
if (isset($_POST['login'])) {
    $admin = $_POST['admin_name'];
    $pwd = $_POST['admin_password'];

    $stmt = $con->prepare("SELECT * FROM `admin` WHERE `admin_name` = ?");
    $stmt->bind_param("s", $admin);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        if ($row['admin_pw']) {
            session_regenerate_id(true);
            $_SESSION['admin'] = $row['admin_name'];
            header("location: dashboard.php");
            exit;
        }
    }
    echo "<div class='alert alert-danger text-center mt-3'>Invalid Credentials</div>";
}
?>

<?php require('inc/scripts.php'); ?>
</body>
</html>
