<?php include "includes/header.php"; ?>

<?php
session_start();
include "includes/db.php";

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    die("Anda harus login terlebih dahulu.");
}

// Ambil data dari form
$user_id = $_SESSION['user_id'];
$place_id = $_POST['place_id'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

// Simpan review ke database
$stmt = $conn->prepare("INSERT INTO reviews (user_id, place_id, comment, rating) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iisi", $user_id, $place_id, $comment, $rating);
$stmt->execute();

// Kembali ke halaman detail tempat kuliner
header("Location: detail.php?id=$place_id");
exit;
?>
<?php include "includes/footer.php"; ?>
