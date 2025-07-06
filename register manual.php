<?php include "includes/header.php"; ?>

<?php
include "includes/db.php";

$name = "Salwa";
$email = "salwaparamita@gmail.com";
$password = "123456";
$role = "user";

$hash = password_hash($password, PASSWORD_DEFAULT);

$query = $conn->query("INSERT INTO users (name, email, password, role) 
VALUES ('$name', '$email', '$hash', '$role')");

if ($query) {
    echo "✅ Berhasil daftar user!";
} else {
    echo "❌ Gagal: " . $conn->error;
}
?>
<?php include "includes/footer.php"; ?>
