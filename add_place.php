<?php include "includes/header.php"; ?>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include "includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    $query = $conn->query("INSERT INTO places (name, location, description)
                           VALUES ('$name', '$location', '$description')");

    if ($query) {
        echo "<p style='color:green;'>✅ Tempat berhasil ditambahkan!</p>";
    } else {
        echo "<p style='color:red;'>❌ Gagal: " . $conn->error . "</p>";
    }
}
?>

<h2>Tambah Tempat Kuliner</h2>
<form method="post">
    Nama Tempat: <input type="text" name="name" required><br>
    Lokasi: <input type="text" name="location" required><br>
    Deskripsi: <br><textarea name="description" rows="4" cols="40" required></textarea><br>
    <button type="submit">Tambah</button>
</form>

<p><a href="index.php">← Kembali ke Halaman Utama</a></p>
<?php include "includes/footer.php"; ?>
