<?php
session_start();
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

        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }

        //Receber o número da página
        $pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
        $pagina = (!empty ($pagina_atual)) ? $pagina_atual : 1;
        //var_dump($pagina);

        //Setar a quantidade de registros por páginas
        $limite_resultado = 4;

        //Calcular o inicio da visualização
        $inicio = ($limite_resultado * $pagina) - $limite_resultado;


        $query_usuarios = "SELECT id, nome, email FROM usuarios ORDER BY id DESC LIMIT $inicio, $limite_resultado";
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

                echo "<a href='visualizar.php?id=$id'>Visualizar</a><br>";
                echo "<a href='editar.php?id=$id'>Editar</a>";
                echo "  -  ";   
                echo "<a onclick='deleteProfile($id);' href='#'>Apagar</a>";

                echo "<hr>";
            }
            // Contar a quantidade de registro no BD
            $query_qnt_registros = "SELECT COUNT(*) AS num_result FROM usuarios";
            $result_qnt_registros =  $conn->prepare($query_qnt_registros);
            $result_qnt_registros->execute();
            $row_qnt_registros = $result_qnt_registros->fetch(PDO::FETCH_ASSOC);
            
            //Quantidade de página
            $qnt_pagina = ceil($row_qnt_registros['num_result'] / $limite_resultado);


            //Maximo de link
            $maximo_link = 2;

            echo "<a href='listar.php?page=1'>Primeira </a>";

            for($pagina_anterior = $pagina - $maximo_link; $pagina_anterior <= $pagina - 1; $pagina_anterior ++){
                if($pagina_anterior >= 1){
                    echo "<a href='listar.php?page=$pagina_anterior'> $pagina_anterior </a>";
                }
            }


            echo "<a href=''> $pagina </a>";

            for($proxima_pagina = $pagina + 1; $proxima_pagina <= $pagina + $maximo_link; $proxima_pagina++){
                if($proxima_pagina <= $qnt_pagina){     
                    echo "<a href='listar.php?page=$proxima_pagina'> $proxima_pagina </a>";
                }
            }

            echo "<a href='listar.php?page=$qnt_pagina'> Última</a>";

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

<script>
  //Mensagem de confirmação e redirecionamento para o script de exclusão de usuário
  function deleteProfile($id) {
    if (confirm("Você realmente deseja excluir o usuário?")) {
        location.href = 'apagar.php?id='+$id;
    }
}
</script>



</body>
</html>