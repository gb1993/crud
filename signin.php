<?php
session_start();

require_once("connectdb.php");

$user_input = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(!empty($user_input['signin'])){
    $find_user = "SELECT * FROM users WHERE login = :login AND pass = :pass";
    $result_user = $conn -> prepare($find_user);
    $result_user -> bindParam(':login', $user_input['login']);
    $result_user -> bindParam(':pass', md5($user_input['pass']));
    $result_user -> execute();
    
    if(($result_user) && ($result_user -> rowCount() == 1)){
        $row_user = $result_user -> fetch(PDO::FETCH_ASSOC);
        if($row_user['status'] == "administrador"){
            $_SESSION['user_adm'] = $row_user['name'];
            $_SESSION['user_adm_id'] = $row_user['id'];
            header('Location: adm/app.php');
        } else {
            $_SESSION['user'] = $row_user['name'];
            $_SESSION['user_id'] = $row_user['id'];
            header('Location: user/app.php');
        }
    } else {
        $_SESSION['no_user'] = "<div class='alert alert-danger' role='alert'>Usuário ou senha inválidos</div>";
        header("location: index.php");
    }
}