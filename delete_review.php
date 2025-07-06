<?php include "includes/header.php"; ?>

<?php
session_start();
include 'includes/db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM reviews WHERE id = $id");
$review = $result->fetch_assoc();

if ($_SESSION['user_id'] != $review['user_id']) {
    die("Akses ditolak.");
}

$conn->query("DELETE FROM reviews WHERE id = $id");
header("Location: detail.php?id=" . $review['place_id']);
exit;
?>
<?php include "includes/footer.php"; ?>
