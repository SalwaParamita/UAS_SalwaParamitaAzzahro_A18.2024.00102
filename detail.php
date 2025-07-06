<?php include "includes/header.php"; ?>

<?php
session_start();
include "includes/db.php";

// Ambil ID tempat dari URL
$place_id = $_GET['id'] ?? 0;

// Ambil data tempat
$place = $conn->query("SELECT * FROM places WHERE id = $place_id")->fetch_assoc();

if (!$place) {
    echo "<h2>Tempat tidak ditemukan.</h2>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($place['name']) ?> | Rate it Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f8f9fa;
        }
        h2 {
            color: #333;
        }
        .place-img {
            width: 400px;
            height: auto;
            margin-bottom: 20px;
        }
        .review {
            background-color: #fff;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .review small {
            color: #888;
        }
        .form-section {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 30px;
        }
        textarea, input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h2><?= htmlspecialchars($place['name']) ?></h2>
<img src="images/<?= htmlspecialchars($place['image']) ?>" alt="<?= htmlspecialchars($place['name']) ?>" width="400">
<p><strong>Lokasi:</strong> <?= htmlspecialchars($place['location']) ?></p>
<p><?= nl2br(htmlspecialchars($place['description'])) ?></p>

<?php if (!empty($place['image'])): ?>
    <img src="uploads/<?= htmlspecialchars($place['image']) ?>" alt="<?= htmlspecialchars($place['name']) ?>" class="place-img">
<?php endif; ?>

<hr>
<h3>Review Pengguna:</h3>

<?php
$reviews = $conn->query("
    SELECT r.id, r.comment, r.rating, r.created_at, r.user_id, u.name 
    FROM reviews r 
    JOIN users u ON r.user_id = u.id 
    WHERE r.place_id = $place_id
    ORDER BY r.created_at DESC
");

if ($reviews->num_rows > 0) {
    while ($r = $reviews->fetch_assoc()) {
        echo "<div class='review'>";
        echo "<strong>" . htmlspecialchars($r['name']) . "</strong> ⭐ " . $r['rating'] . "/5<br>";
        echo nl2br(htmlspecialchars($r['comment'])) . "<br>";
        echo "<small>" . $r['created_at'] . "</small>";

        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $r['user_id']) {
            echo "<br><a href='edit_review.php?id=" . $r['id'] . "'>Edit</a> | ";
            echo "<a href='delete_review.php?id=" . $r['id'] . "' onclick=\"return confirm('Yakin hapus review ini?')\">Hapus</a>";
        }

        echo "</div>";
    }
} else {
    echo "<p>Belum ada review untuk tempat ini.</p>";
}
?>

<?php if (isset($_SESSION['user_id'])): ?>
    <div class="form-section">
        <h3>Tambahkan Review</h3>
        <form action="tambah_review.php" method="POST">
            <input type="hidden" name="place_id" value="<?= $place_id ?>">

            <label>Rating (1–5):</label>
            <input type="number" name="rating" min="1" max="5" required>

            <label>Komentar:</label>
            <textarea name="comment" rows="4" required></textarea>

            <button type="submit">Kirim Review</button>
        </form>
    </div>
<?php else: ?>
    <p><em>Login untuk menulis review.</em></p>
<?php endif; ?>

<p><a href="index.php">← Kembali ke Daftar Tempat</a></p>

</body>
</html>
<?php include "includes/footer.php"; ?>
