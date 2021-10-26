<?php
session_start(); 
if(!isset($_SESSION['user_adm'])){
    $_SESSION['no_user'] = "<div class='alert alert-danger' role='alert'>Necessário estar logado para acessar</div>";
    header("Location: index.php");
}
require_once("../connectdb.php");

$user_input = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(!empty($user_input['signup'])){
    $find_user = "SELECT * FROM users WHERE login = :login OR email = :email";
    $result_user = $conn -> prepare($find_user);
    $result_user -> bindParam(':login', $user_input['login']);
    $result_user -> bindParam(':email', $user_input['email']);
    $result_user -> execute();

    if($user_input['status'] == 'on'){
        $status = 'administrador';
    } else {
        $status = 'padrão';
    }

    if(($result_user) && ($result_user -> rowCount() == 1)){
        $row_user = $result_user -> fetch(PDO::FETCH_ASSOC);
        if($row_user['login'] == $user_input['login']){
            $_SESSION['exists_user'] = "<div class='alert alert-danger' role='alert'>Login informado já possuí cadastro</div>";
            header("Location: signup.php");
        } else {
            $_SESSION['exists_user'] = "<div class='alert alert-danger' role='alert'>Email informado já possuí cadastro</div>";
            header("Location: signup.php");
        }
    } else {
        $insert_user = "INSERT INTO users (status, name, email, telephone, login, pass) VALUES (:status, :name, :email, :telephone, :login, :pass)";
        $result_user = $conn -> prepare($insert_user);
        $result_user -> bindParam(':status', $status);
        $result_user -> bindParam(':name', $user_input['name']);
        $result_user -> bindParam(':email', $user_input['email']);
        $result_user -> bindParam(':telephone', $user_input['telephone']);
        $result_user -> bindParam(':login', $user_input['login']);
        $result_user -> bindParam(':pass', md5($user_input['pass']));
        $result_user -> execute();
        $_SESSION['exists_user'] = "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso!</div>";
        header("Location: signup.php");
    }
}