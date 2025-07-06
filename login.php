<?php include "includes/header.php"; ?>

<?php
include "includes/db.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    echo "<p>📧 Email masuk: $email</p>";
    echo "<p>🔐 Password masuk: $password</p>";

    $query = $conn->query("SELECT * FROM users WHERE email = '$email'");
    
    if ($query->num_rows === 0) {
        echo "<p style='color:red;'>❌ Email tidak ditemukan di database</p>";
    } else {
        $user = $query->fetch_assoc();
        echo "<p>✅ Email cocok. Password hash di DB: {$user['password']}</p>";

        if (password_verify($password, $user['password'])) {
            echo "<p style='color:green;'>✅ Password cocok. Login sukses!</p>";
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            header("Location: dashboard.php");
            exit;
        } else {
            echo "<p style='color:red;'>❌ Password tidak cocok</p>";
        }
    }
}
?>

<h2>Login Debug</h2>
<form method="post">
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
<?php include "includes/footer.php"; ?>
