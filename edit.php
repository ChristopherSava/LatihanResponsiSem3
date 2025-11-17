<!DOCTYPE html><html><head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Edit Film</title>
</head><body class="bg-light">

<?php
session_start();
include 'connection.php';

$id = $_GET['id'];
$q = $conn->query("SELECT * FROM film WHERE id_film=$id");
$data = $q->fetch_assoc();

if(isset($_POST['update'])){
    $j = $_POST['judul'];
    $s = $_POST['sutradara'];
    $h = $_POST['harga'];

    $stmt = $conn->prepare("UPDATE film SET judul_film=?, sutradara=?, harga_tiket=? WHERE id_film=?");
    $stmt->bind_param("ssii", $j, $s, $h, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<div class='container col-4 mt-5 p-4 card shadow'>
    <h3>Edit Film</h3>

    <form method="post">

        <label>ID Film</label>
        <input class='form-control mb-2' value="<?= $data['id_film'] ?>" readonly>

        <label>Judul</label>
        <input name="judul" class='form-control mb-2' value="<?= $data['judul_film'] ?>" required>

        <label>Sutradara</label>
        <input name="sutradara" class='form-control mb-2' value="<?= $data['sutradara'] ?>" required>

        <label>Harga</label>
        <input type='number' name="harga" class='form-control mb-2' value="<?= $data['harga_tiket'] ?>" required>

        <button 
            class='btn btn-primary w-100' 
            name='update' 
            type='submit'
        >Update</button>

    </form>
</div>

</body></html>
