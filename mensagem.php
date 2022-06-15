<?php
session_start();
include_once './conexao.php';
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
    <h3>Mensagem</h3>
    <br>

    <?php
    
        $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        echo "<pre>", var_dump($data), "</pre>";
    
    ?>



    <form name="add_msg" action="" method="POST">
        
    <div class="form-group row col-md-4 mb-3" >
        <label for="inputNome" class="col-sm-2 col-form-label">Nome: </label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control" id="name" placeholder="Nome completo" required>
        </div>
    </div>

    <div class="form-group row col-md-4 mb-3" >
        <label for="inputEmail" class="col-sm-2 col-form-label">E-mail: </label>
        <div class="col-sm-10">
            <input type="email" name="email" class="form-control" id="email" placeholder="O melhor e-mail" required>
        </div>
    </div>

    <div class="form-group row col-md-4 mb-3" >
        <label for="inputAssunto" class="col-sm-2 col-form-label">Assunto: </label>
        <div class="col-sm-10">
            <input type="text" name="subject" class="form-control" id="subject" placeholder="Assunto da mensagem" required>
        </div>
    </div>

    <div class="form-group row col-md-4 mb-3" >
        <label for="inputConteudo" class="col-sm-2 col-form-label">Conteúdo: </label>
        <div class="col-sm-10">
            <input type="text" name="content" class="form-control" id="content" placeholder="Conteudo da mensagem" required>
        </div>
    </div>

    <div class="form-group row col-md-4 mb-3" >
    <button type="submit" name="SendAddMsg" class="btn btn-primary">Enviar</button>
    </div>

    









    </form>



    </div>
</div>
<br>
<?php
include_once './footer.php';
?>

</body>
</html>