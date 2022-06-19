<?php
session_start();
ob_start();
?>

<div class="form_title">
    <div class="form_border">
    <h3>Cadastrar</h3>
    <?php
        //Recebe os dados do formulário
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //Verifica se usuário clicou no botão
        if(!empty($dados['cadUser'])){
            //var_dump($dados); <- mensagem na pagina
            $empty_input = false;

            $dados = array_map('trim', $dados);
            if(in_array("", $dados)){
                $empty_input = true;
                echo "<p style='color: #f00;'>Erro: Necessário preencher todos campos!</p>";
                
            }elseif(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
                $empty_input = true;
                echo "<p style='color: #f00;'>Erro: Necessário preencher com e-mail válido!</p>";
            }
            
            if(!$empty_input){
            
                $query_usuario = "INSERT INTO usuarios (nome, email) VALUES (:nome, :email)";
                $cad_usuario = $conn->prepare($query_usuario);
                $cad_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
                $cad_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
                $cad_usuario->execute();
            if($cad_usuario->rowCount()){
                unset($dados);
                $_SESSION['msg'] = "<p style='color: green;'>Usuário cadastrado com sucesso!</p>";
                header("Location: ?i=listar");
            }else{
                echo "<p style='color: #f00;'>Erro: Usuário não cadastrado!</p>";
            }
            }
        }
    ?>
    <form name="cad-user" method="POST" action="">

        <div class="form-group row col-md-5 mb-3">
            <label for="inputNome" class="col-sm-2 col-form-label">Nome: </label>
            <div class="col-sm-10">
            <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome completo" value="<?php
            if(isset($dados['nome'])){
                echo $dados['nome'];
            }?>" required autofocus>
            </div>
        </div>

        <div class="form-group row col-md-5 mb-3">
            <label for="inputEmail" class="col-sm-2 col-form-label">E-mail: </label>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="email" placeholder="O melhor e-mail" value="<?php
            if(isset($dados['email'])){
                echo $dados['email'];
            }?>" required>
            </div>
        </div>
        <div class="form-group row col-md-5 mb-3">
            <input type="submit" value="Cadastrar" name="cadUser" class="btn btn-primary">
        </div>
        
    </form>
    </div>
</div>