<?php include "includes/header.php"; ?>

<?php
include "includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    $conn->query($sql);

    echo "Pendaftaran berhasil. <a href='login.php'>Login di sini</a>";
}
?>

<h2>Register</h2>
<form method="post">
    Nama: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Daftar</button>
</form>
<?php include "includes/footer.php"; ?>
