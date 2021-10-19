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

    <div class="container">
        <div class="row my-5">
            <div class="col-md-3 mx-auto my-5">
                <div class="logo mb-3">
                    <div class="col-md-12 text-center">
                        <h1>Alterar Usuário</h1>
                    </div>
                    <?php
                        $find_user = "SELECT status, name, email, telephone, login, pass FROM users WHERE id = ".$_GET['update']."";
                        $result_user = $conn -> prepare($find_user);
                        $result_user -> execute();
                        $row_user = $result_user -> fetch(PDO::FETCH_ASSOC);
                    ?>
                    <form action="alter_user.php" method="post">
                        <div class="form-check form-switch my-4">
                            <input class="form-check-input" name="status" type="checkbox" role="switch" <?php if($row_user['status'] == "administrador"){echo "checked";} ?>></input>
                            <label class="form-check-label">Será administrador?</label>
                        </div>
                        <div class="form-group my-3">
                            <input type="text" name="name" class="form-control" placeholder="Nome Completo" value="<?php echo $row_user['name']; ?>" required></input>
                        </div>
                        <div class="form-group my-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $row_user['email']; ?>" required></input>
                        </div>
                        <div class="form-group my-3">
                            <input type="text" name="telephone" class="form-control" placeholder="Celular" maxlength="11" value="<?php echo $row_user['telephone']; ?>"></input>
                        </div>
                        <div class="form-group my-3">
                            <input type="text" name="login" class="form-control" readonly value="<?php echo $row_user['login']; ?>" required></input>
                        </div>
                        <div class="form-group my-3">
                            <input type="password" name="pass" class="form-control" placeholder="Senha"></input>
                        </div>
                        <div class="col-md-12 text-center my-3">
                            <input type="submit" name="update" class="btn btn-primary" value="Alterar"></input>
                        </div>
                    </form>
                    <?php 
                        if(isset($_SESSION['update_user'])){
                            echo $_SESSION['update_user'];
                            unset($_SESSION['update_user']);
                        }
                    ?>
                </div>
            </div>    
        </div>
    </div>   


    <script src="js/bootstrap.js"></script>
</body>
</html>