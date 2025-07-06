<?php include "includes/header.php"; ?>

<?php
session_start();
include "includes/db.php";

// Harus login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Ambil ID tempat dari URL
$place_id = $_GET['id'] ?? 0;

// Ambil data tempat
$place = $conn->query("SELECT * FROM places WHERE id = $place_id")->fetch_assoc();

if (!$place) {
    echo "Tempat tidak ditemukan.";
    exit;
}

// Jika user submit review
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $comment = $_POST['comment'];
    $rating = (int) $_POST['rating'];

    $conn->query("INSERT INTO reviews (user_id, place_id, comment, rating)
                  VALUES ($user_id, $place_id, '$comment', $rating)");

    echo "<p style='color:green;'>✅ Review berhasil ditambahkan!</p>";
}
?>

<h2>Review: <?= htmlspecialchars($place['name']) ?></h2>

<form method="post">
    Rating (1–5): 
    <select name="rating" required>
        <option value="">--Pilih--</option>
        <?php for ($i = 1; $i <= 5; $i++) echo "<option value='$i'>$i</option>"; ?>
    </select><br>
    Komentar:<br>
    <textarea name="comment" rows="4" cols="40" required></textarea><br>
    <button type="submit">Kirim Review</button>
</form>

<p><a href="index.php">← Kembali</a></p>
<?php include "includes/footer.php"; ?>
