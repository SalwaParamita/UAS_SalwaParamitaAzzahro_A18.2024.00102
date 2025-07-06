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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comment = $_POST['comment'];
    $rating = $_POST['rating'];

    $conn->query("UPDATE reviews SET comment='$comment', rating=$rating WHERE id=$id");
    header("Location: detail.php?id=" . $review['place_id']);
    exit;
}
?>

<h2>Edit Review</h2>
<form method="post">
    <textarea name="comment" required><?= htmlspecialchars($review['comment']) ?></textarea><br>
    <input type="number" name="rating" value="<?= $review['rating'] ?>" min="1" max="5" required><br>
    <button type="submit">Simpan</button>
</form>
<?php include "includes/footer.php"; ?>
