<!DOCTYPE html><html><head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.card-custom { max-width: 900px; margin: 40px auto; border-radius: 10px; }
.img-left { width: 100%; height: 100%; object-fit: cover; border-radius: 10px 0 0 10px; }
</style>
<title>Tambah Film</title>
</head><body class="bg-light">

<?php
session_start(); 
include 'connection.php';

if(!isset($_SESSION['user'])) 
    header('Location: login.php?msg=belum');

if(isset($_POST['simpan'])){
    $j = $_POST['judul'];
    $s = $_POST['sutradara'];
    $h = $_POST['harga'];

    $stmt = $conn->prepare("INSERT INTO film(judul_film, sutradara, harga_tiket) VALUES (?, ?, ?)");
    $stmt->bind_param('ssi', $j, $s, $h);
    $stmt->execute();

    header('Location: index.php');
    exit;
}
?>

<div class='container col-4 mt-5 p-4 card shadow'>
    <h3>Tambah Film</h3>

    <form method='post'>
        <label>Judul</label>
        <input class='form-control mb-2' name='judul' required>

        <label>Sutradara</label>
        <input class='form-control mb-2' name='sutradara' required>

        <label>Harga</label>
        <input type='number' class='form-control mb-2' name='harga' required>

        <button class='btn btn-primary w-100' name='simpan'>Simpan</button>
    </form>
</div>

</body></html>
