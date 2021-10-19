<?php
session_start(); 
if(!isset($_SESSION['user'])){
    $_SESSION['no_user'] = "<div class='alert alert-danger' role='alert'>Necessário estar logado para acessar</div>";
    header("Location: index.php");
}

include_once("../connectdb.php");

$user_input = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(!empty($user_input['update'])){


    var_dump($user_input['status']);

    $find_user = "SELECT * FROM users WHERE login = :login OR email = :email";
    $result_user = $conn -> prepare($find_user);
    $result_user -> bindParam(':login', $user_input['login']);
    $result_user -> bindParam(':email', $user_input['email']);
    $result_user -> execute();

    if(($result_user) && ($result_user -> rowCount() == 1)){
        $row_user = $result_user -> fetch(PDO::FETCH_ASSOC);
        if($row_user['login'] == $user_input['login'] && empty($user_input['pass'])){
            $update_user = "UPDATE users SET name = :name, email = :email, telephone = :telephone WHERE login = :login";
            $result_user = $conn -> prepare($update_user);
            $result_user -> bindParam(':name', $user_input['name']);
            $result_user -> bindParam(':email', $user_input['email']);
            $result_user -> bindParam(':telephone', $user_input['telephone']);
            $result_user -> bindParam(':login', $user_input['login']);
            $result_user -> execute();
            $_SESSION['update_user'] = "<div class='alert alert-success' role='alert'>Usuário alterado com sucesso!</div>";
            header("Location: myprofile.php");
        } elseif ($row_user['login'] == $user_input['login'] && isset($user_input['pass'])){
            $update_user = "UPDATE users SET name = :name, email = :email, telephone = :telephone, pass = :pass WHERE login = :login";
            $result_user = $conn -> prepare($update_user);
            $result_user -> bindParam(':name', $user_input['name']);
            $result_user -> bindParam(':email', $user_input['email']);
            $result_user -> bindParam(':telephone', $user_input['telephone']);
            $result_user -> bindParam(':pass', md5($user_input['pass']));
            $result_user -> bindParam(':login', $user_input['login']);
            $result_user -> execute();
            $_SESSION['update_user'] = "<div class='alert alert-success' role='alert'>Usuário alterado com sucesso!</div>";
            header("Location: myprofile.php");
        } else {
            $_SESSION['update_user'] = "<div class='alert alert-danger' role='alert'>Erro ao encontrar usuário</div>";
            header("Location: myprofile.php");
        }

    } 
}