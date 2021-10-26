<!DOCTYPE html>
<html lang="pt-br">
<body>

<?php require_once("header.php"); ?>

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
    
</body>
</html>