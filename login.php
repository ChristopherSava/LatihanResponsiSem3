<!DOCTYPE html><html><head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.card-custom { max-width: 900px; margin: 40px auto; border-radius: 10px; }
.img-left { width: 100%; height: 100%; object-fit: cover; border-radius: 10px 0 0 10px; }
</style>
<title>Login</title>
</head><body class="bg-light">

<?php
session_start(); 
include 'connection.php';

$msg='';

if(isset($_GET['msg'])){
    if($_GET['msg']=='success') $msg='Register berhasil';
    if($_GET['msg']=='logout') $msg='Logout berhasil';
    if($_GET['msg']=='belum') $msg='Silakan login terlebih dahulu';
}

if(isset($_POST['login'])){
    $u = $_POST['username'];
    $p = $_POST['password'];

    $q = $conn->query("SELECT * FROM users WHERE username='$u' AND password='$p'");

    if($q->num_rows > 0){
        $_SESSION['user'] = $q->fetch_assoc();
        header('Location: index.php');
    } else {
        $msg = 'Login gagal';
    }
}
?>

<div class='card shadow card-custom'>
    <div class='row g-0'>
        
        <div class='col-md-5'>
            <img src='film.jpg' class='img-left'>
        </div>

        <div class='col-md-7 p-4'>
            <h3>Login</h3>
            <p>Masukkan username dan password</p>

            <?php 
            if($msg) {
                echo "<div class='alert alert-info'>$msg</div>";
            }
            ?>

            <form method='post'>
                <label>Username</label>
                <input name='username' class='form-control mb-2' required>

                <label>Password</label>
                <input name='password' type='password' class='form-control mb-3' required>

                <button class='btn btn-primary' name='login'>Login</button>
            </form>

            <p class='mt-3'>Belum punya akun? <a href='register.php'>Daftar di sini</a></p>

            <p>Default admin : admin | admin</p>
        </div>
    </div>
</div>

</body></html>
