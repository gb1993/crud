<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="pics/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>

    <title>Sistema</title>
</head>
<body>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-3 mx-auto my-5">
                <div class="logo mb-3">
                    <div class="col-md-12 text-center">
                        <h1>LOGIN</h1>
                    </div>
                    <form action="signin.php" method="post">
                        <div class="form-group my-3">
                            <input type="text" name="login" class="form-control" placeholder="Usuário" required>
                        </div>
                        <div class="form-group my-3">
                            <input type="password" name="pass" class="form-control" placeholder="Senha" required>
                        </div>
                        <div class="form-group my-3">
                            <p class="text-center">Ao acessar você aceita os <a href="terms.php">termos de uso</a></p>
                        </div>
                        <div class="col-md-12 text-center my-3">
                            <input type="submit" name="signin" class="btn btn-block btn-primary" value="Acessar"></input>
                        </div>
                        <?php if(isset($_SESSION['no_user'])){
                                echo $_SESSION['no_user'];
                                unset($_SESSION['no_user']);
                            }
                        ?>
                    </form>
                </div>
            </div>    
        </div>
    </div>   


    <script src="js/bootstrap.js"></script>
</body>
</html>