<?php
session_start();
ob_start();
include_once './conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);



if(empty($id)){
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
    header("Location: listar.php");
    exit();
}

$query_usuario = "SELECT id, nome, email FROM usuarios WHERE id = $id LIMIT 1";
$result_usuario = $conn->prepare($query_usuario);
$result_usuario->execute();

if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
    var_dump($row_usuario);
}else{
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado!</p>";
    header("Location: listar.php");
    exit();
}

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
    <h3>Editar</h3>

    <?php
    //Receber os dados do formulário
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    //VErificar se o usuário clicou no botão
    if(!empty($dados['EditUsuario'])){
        $empty_input = false;
        $dados = array_map('trim', $dados);
        if(in_array("", $dados)){
            $empty_input = true;
            echo "<p style='color: #f00;'>Erro: Necessário preencher todos campos!</p>";
        }elseif(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
            $empty_input = true;
            echo "<p style='color: #f00;'>Erro: Necessário preencher com e-mail valido!</p>";
        }
        if(!$empty_input){
           $query_up_usuario = "UPDATE usuarios SET nome=:nome, email=:email WHERE id=:id";
           $edit_usuario = $conn->prepare($query_up_usuario);
           $edit_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
           $edit_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
           $edit_usuario->bindParam(':id', $id, PDO::PARAM_INT);
           if($edit_usuario->execute()){
            $_SESSION['msg'] = "<p style='color: green;'>Usuário editado com sucesso!</p>";
                header("Location: listar.php");
           }else{
                echo "<p style='color: #f00;'>Erro: Usuário não editado com sucesso!</p>";
           }
        }
    }
    ?>

    <form id="editar-usuario" method="POST" action="">
        <label>Nome: </label>
        <input type="text" name="nome" id="nome" placeholder="Nome completo" value="<?php 
        if(isset($dados['nome'])){
            echo $dados['nome'];
        }elseif (isset($row_usuario['nome'])){
             echo $row_usuario['nome']; 
        } 
        ?>" required><br><br> 

        <label>E-mail: </label>
        <input type="email" name="email" id="email" placeholder="Seu melhor e-mail" value="<?php 
         if(isset($dados['email'])){
            echo $dados['email'];
        }elseif (isset($row_usuario['email'])){
             echo $row_usuario['email']; 
        }
        ?>" required><br><br>

        <input type="submit" value="Salvar" name="EditUsuario">

    </form>
    </div>
</div>
<br>
<?php
include_once './footer.php';
?>





</body>
</html>