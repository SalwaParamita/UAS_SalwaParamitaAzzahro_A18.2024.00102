<?php
include "includes/db.php";
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rate it Up - Tempat Kuliner</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">

<h1 class="mb-4">Tempat Kuliner</h1>

<?php
$result = $conn->query("SELECT * FROM places");

while ($row = $result->fetch_assoc()):
?>
    <div class="card mb-4">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="images/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" width="250">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($row['name']) ?> - <?= htmlspecialchars($row['location']) ?></h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars($row['description'])) ?></p>
                    <a href="detail.php?id=<?= $row['id'] ?>" class="btn btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; ?>

</body>
</html>
