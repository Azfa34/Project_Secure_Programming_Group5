<?php
session_start();
if (!isset($_SESSION['info'])) {
    header('Location: home.php'); // Redirect to home page if accessed directly
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Success</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="alert alert-success mt-5">
            <?php
            echo $_SESSION['info'];
            unset($_SESSION['info']); // Clear the message after displaying
            ?>
        </div>
        <a href="home.php" class="btn btn-primary">Back to Home</a>
    </div>
</body>
</html>
