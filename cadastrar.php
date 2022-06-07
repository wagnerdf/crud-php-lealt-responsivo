<?php
include_once './conexao.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastrar usuário</title>
    </head>
<body>
    <h1>Cadastrar</h1>
    <?php
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(!empty($dados['cadUser'])){
            var_dump($dados);
            $query_usuario = "INSERT INTO usuarios (nome, email) VALUES ('" . $dados['nome'] . "', '". $dados['email'] ."')";
            $cad_usuario = $conn->prepare($query_usuario);
            $cad_usuario->execute();
        }
    ?>
    <form name="cad-user" method="POST" action="">
        <label>Nome: </label>
        <input type="text" name="nome" id="nome" placeholder="Nome completo"><br><br>
        
        <label>E-mail: </label>
        <input type="email" name="email" id="email" placeholder="Seu melhor e-mail"><br><br>

        <input type="submit" value="cadastrar" name="cadUser">
    </form>
</body>
</html>