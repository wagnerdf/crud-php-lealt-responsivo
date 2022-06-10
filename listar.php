<?php
include_once './conexao.php';
?>
<!DOCTYPE html>
<html>
    <?php
        include_once './head.php';
    ?>
<body>

<?php
include_once './nav.php';
?>

<div class="form_title">
    <div class="form_border">
    <h3>Listar</h3>

    <?php

        $query_usuarios = "SELECT id, nome, email FROM usuarios";
        $result_usuarios = $conn->prepare($query_usuarios);
        $result_usuarios->execute();

        if(($result_usuarios) AND ($result_usuarios->rowCount() != 0)){
            while($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)){
                //var_dump($row_usuario);
                extract($row_usuario);
                //echo "ID: " . $row_usuario['id'] . "<BR>";
                echo "ID: $id <br>";
                echo "Nome: $nome <br>";
                echo "E-mail: $email <br>";
                echo "<hr>";
            }
        }else{
            echo "<p style='color: #f00;'>Erro: Nenhum usuário encontrado!</p>";
        }

    ?>



    </div>
</div>
<br>
<?php
include_once './footer.php';
?>




<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>