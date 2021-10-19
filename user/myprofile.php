<!DOCTYPE html>
<html lang="pt-br">
<body>
<?php include_once("header.php"); ?>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-3 mx-auto my-5">
                <div class="logo mb-3">
                    <div class="col-md-12 text-center">
                        <h1>Meu Perfil</h1>
                    </div>
                    <?php
                        $find_user = "SELECT status, name, email, telephone, login, pass FROM users WHERE id = ".$_SESSION['user_id']."";
                        $result_user = $conn -> prepare($find_user);
                        $result_user -> execute();
                        $row_user = $result_user -> fetch(PDO::FETCH_ASSOC);
                    ?>
                    <form action="alter_myself.php" method="post">
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