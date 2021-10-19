<?php 
    session_start(); 
    if(!isset($_SESSION['user_adm'])){
        $_SESSION['no_user'] = "<div class='alert alert-danger' role='alert'>Necessário estar logado para acessar</div>";
        header("Location: index.php");
    }
    include_once("connectdb.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="shortcut icon" href="pics/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    <title>Área do Administrador</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
                <li class="nav-item active dropdown">
                    <a class="nav-link active navbar-brand dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                        <?php echo $_SESSION['user_adm']; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="myprofile_adm.php">Minha Conta</a></li>
                        <li><a class="dropdown-item" href="signout.php">Sair</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="crudd_users.php">Usuários</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-5">
    <a class="text-light" href="signup.php"><button type="button" class="btn btn-primary">Adicionar</button></a>
</div>
<div class="container">
    <?php 
        if(isset($_SESSION['user_deleted'])){
            echo $_SESSION['user_deleted'];
            unset($_SESSION['user_deleted']);
        }
    ?>
</div>
                    
<div class="container">
    <table class="table">
        <thead>
            <tr class="table-primary">
                <th scope="col">ID</th>
                <th scope="col">Login</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Celular</th>               
                <th scope="col">Tipo de Acesso</th>
                <th scope="col">Alterar  |  Remover</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $find_users = "SELECT * FROM users";
                $result_users = $conn -> prepare($find_users);
                $result_users -> execute();
                if($result_users){
                    while($row_users = $result_users -> fetch(PDO::FETCH_ASSOC)){
                        echo"<tr>
                        <th scope='row'>". $row_users['id'] ."</th>
                        <td>". $row_users['login'] ."</td>
                        <td>". $row_users['name'] ."</td>
                        <td>". $row_users['email'] ."</td>
                        <td>". $row_users['telephone'] ."</td>
                        <td>". $row_users['status']  ."</td>
                        <td>
                            <a class='text-light' href='update_user.php?update=".$row_users['id']."'><button type='button' class='btn btn-primary'>Alterar</button></a>
                            <a class='text-light' href='delete_user.php?del=".$row_users['id']."'><button type='button' class='btn btn-danger'>Remover</button></a>
                        </td>
                    </tr>";
                    }
                } 
                
            ?>    
        </tbody>
    </table>
</div>
    
    
    <script src=js/bootstrap.bundle.js></script>
</body>
</html>