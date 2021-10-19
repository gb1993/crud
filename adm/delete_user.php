<?php
session_start(); 
if(!isset($_SESSION['user_adm'])){
    $_SESSION['no_user'] = "<div class='alert alert-danger' role='alert'>Necessário estar logado para acessar</div>";
    header("Location: index.php");
}
include_once("../connectdb.php");

    if(isset($_GET['del'])){
        $del_user = $_GET['del'];
        $delete_user = "DELETE FROM users WHERE id = :id";
        $result_user = $conn -> prepare($delete_user);
        $result_user -> bindParam(':id', $del_user);
        $result_user -> execute();
        $_SESSION['user_deleted'] = "<div class='alert alert-success' role='alert'>Usuário removido com sucesso!</div>";
        header("Location: crudd_users.php");
    }