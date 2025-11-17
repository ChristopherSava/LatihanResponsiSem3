<!DOCTYPE html><html><head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.card-custom { max-width: 900px; margin: 40px auto; border-radius: 10px; }
.img-left { width: 100%; height: 100%; object-fit: cover; border-radius: 10px 0 0 10px; }
</style>
<title>Register</title>
</head><body class="bg-light">

<?php
session_start(); 
include 'connection.php';

$msg = '';

if(isset($_POST['register'])){
    $nama = $_POST['nama'];
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $confirm = $_POST['confirm'];

    if($pass !== $confirm){
        $msg = "Konfirmasi password tidak sama";
    } else {

        $stmt = $conn->prepare("INSERT INTO users(username, password, nama_lengkap) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user, $pass, $nama);

        if($stmt->execute()){
            header("Location: login.php?msg=success");
            exit;
        } else {
            $msg = "Username sudah digunakan";
        }
    }
}
?>

<div class='card shadow card-custom'>
    <div class='row g-0'>

        <div class='col-md-5'>
            <img src='film.jpg' class='img-left'>
        </div>

        <div class='col-md-7 p-4'>
            <h3>Register</h3>
            <p>Isi semua data dengan benar</p>

            <?php if($msg) echo "<div class='alert alert-danger'>$msg</div>"; ?>

            <form method='post'>
                <label>Nama Lengkap</label>
                <input class='form-control mb-2' name='nama' required>

                <label>Username</label>
                <input class='form-control mb-2' name='username' required>

                <label>Password</label>
                <input class='form-control mb-2' name='password' type='password' required>

                <label>Konfirmasi Password</label>
                <input class='form-control mb-3' name='confirm' type='password' required>

                <button class='btn btn-primary' name='register'>Register</button>

                <a href='login.php' class='btn btn-secondary'>Kembali</a>
            </form>

            <p class='mt-3'>Sudah punya akun? <a href='login.php'>Login di sini</a></p>
        </div>
    </div>
</div>

</body></html>
