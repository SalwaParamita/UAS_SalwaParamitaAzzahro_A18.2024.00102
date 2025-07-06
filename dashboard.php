<?php include "includes/header.php"; ?>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<h2>Selamat datang, <?= $_SESSION['name'] ?>!</h2>
<p><a href="logout.php">Logout</a></p>
<?php include "includes/footer.php"; ?>
