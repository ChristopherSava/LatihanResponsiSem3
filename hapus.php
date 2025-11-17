<?php 
include 'connection.php'; 
    $id=$_GET['id']; $conn->query("DELETE FROM film WHERE id_film=$id"); 
    header('Location: index.php'); 
?>