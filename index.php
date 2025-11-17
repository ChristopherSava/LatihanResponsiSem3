<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-custom { max-width: 900px; margin: 40px auto; border-radius: 10px; }
        .img-left { width: 100%; height: 100%; object-fit: cover; border-radius: 10px 0 0 10px; }
    </style>
    <title>Dashboard</title>
</head>
<body class="bg-light">

<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php?msg=belum');
}

$user  = $_SESSION['user']['nama_lengkap'];
$films = $conn->query("SELECT * FROM film");
?>

<div class="container mt-4">

    <h3>Selamat datang, <?= $user ?></h3>

    <a href="tambah.php" class="btn btn-primary">Tambah Film</a>
    <a href="logout.php" class="btn btn-danger">Logout</a>

    <table class="table table-bordered mt-3">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Sutradara</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>

        <?php 
        $total = 0; 
        while ($f = $films->fetch_assoc()):
            $total += $f['harga_tiket']; 
        ?>
        <tr>
            <td><?= $f['id_film'] ?></td>
            <td><?= $f['judul_film'] ?></td>
            <td><?= $f['sutradara'] ?></td>
            <td><?= $f['harga_tiket'] ?></td>
            <td>
                <a href="edit.php?id=<?= $f['id_film'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="hapus.php?id=<?= $f['id_film'] ?>" class="btn btn-danger btn-sm">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>

    </table>

    <h4>Total Harga Tiket: <?= $total ?></h4>

</div>

</body>
</html>
