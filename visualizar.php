<?php
session_start();
ob_start();
include_once './conexao.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
$pesquisa = filter_input(INPUT_GET, "pesquisarUsuario");

if(empty($id) AND empty($pesquisa)){
   $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
   header("Location: listar.php");
   exit();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
    <?php
        include_once './head.php';
    ?>
<body>

<?php
include_once './nav.php';
?>

<div class="form_title">
    <div class="form_border">
    <h3>Visualizar</h3>

    <?php


    if($id != null){
        $query_usuario = "SELECT id, nome, email FROM usuarios WHERE id = $id LIMIT 1";
        $result_usuario = $conn->prepare($query_usuario);
        $result_usuario->execute();

        if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            // echo "<pre>", var_dump($row_usuario), "</pre>";
            extract($row_usuario);
            //echo "ID: " . $row_usuario['id'] . "<br>";
            echo "ID: $id <br>";
            echo "Nome: $nome <br>";
            echo "E-mail: $email <br>";

        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
            header("Location: listar.php");
        }
    }

    if($pesquisa != null){
        $query_pesquisa = "SELECT * FROM usuarios WHERE nome like '%$pesquisa%'";
        $result_pesquisa = $conn->prepare($query_pesquisa);
        $result_pesquisa->execute();

        if(($result_pesquisa) AND ($result_pesquisa->rowCount() != 0)){
            while($row_pesquisa = $result_pesquisa->fetch(PDO::FETCH_ASSOC)){
                extract($row_pesquisa);
                echo "ID: $id <br>";
                echo "Nome: $nome <br>";
                echo "E-mail: $email <br>";
                echo "<hr>";
            } 
        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Dados da pesquisa não encontrado</p>";
            header("Location: listar.php");
        }


    }

    ?>
    </div>
</div>
<br>

<?php
    include_once './footer.php';
?>



</body>
</html>