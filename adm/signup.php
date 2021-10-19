<!DOCTYPE html>
<html lang="pt-br">
<body>
<?php include_once("header.php"); ?>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-3 mx-auto my-5">
                <div class="logo mb-3">
                    <div class="col-md-12 text-center">
                        <h1>Cadastrar Usuário</h1>
                    </div>
                    <form action="register_user.php" method="post">
                        <div class="form-check form-switch my-4">
                            <input class="form-check-input" name="status" type="checkbox" role="switch"></input>
                            <label class="form-check-label">Será administrador?</label>
                        </div>
                        <div class="form-group my-3">
                            <input type="text" name="name" class="form-control" placeholder="Nome Completo" required></input>
                        </div>
                        <div class="form-group my-3">
                            <input type="email" name="email" class="form-control" placeholder="Email"></input>
                        </div>
                        <div class="form-group my-3">
                            <input type="text" name="telephone" class="form-control" placeholder="Celular" maxlength="11"></input>
                        </div>
                        <div class="form-group my-3">
                            <input type="text" name="login" class="form-control" placeholder="Usuário" required></input>
                        </div>
                        <div class="form-group my-3">
                            <input type="password" name="pass" class="form-control" placeholder="Senha" required></input>
                        </div>
                        <div class="col-md-12 text-center my-3">
                            <input type="submit" name="signup" class="btn btn-primary" value="Criar"></input>
                        </div>
                    </form>
                    <?php 
                        if(isset($_SESSION['exists_user'])){
                            echo $_SESSION['exists_user'];
                            unset($_SESSION['exists_user']);
                        }
                    ?>
                </div>
            </div>    
        </div>
    </div>   
</body>
</html>