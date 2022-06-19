<?php

/*
Site: CRUD PHP
Autor: Wagner Andrade
Data: 18/06/2022
 */

/* Define a página atual pela url */
$pagina = 'home';

if (isset($_GET['i'])) {
    $pagina = addslashes($_GET['i']);
}
/* Limpar a memoria cache no servidor */
ob_start();
include 'app/Views/conexao.php';

include_once 'app/Views/head.php';

include_once 'app/Views/nav.php';

/* Carregar a página escolhida pelo usuário */

switch ($pagina) {
    case 'home':
        include 'app/Views/cadastrar.php';
        break;
    case 'listar':
        include 'app/Views/listar.php';
        break;
    case 'mensagem':
        include 'app/Views/mensagem.php';
        break;
    case 'visualizar':
        include 'app/Views/visualizar.php';
        break;
    case 'editar':
        include 'app/Views/editar.php';
        break;
    case 'apagar':
        include 'app/Views/apagar.php';
        break;
    case 'default':
        include 'app/Views/cadastrar.php';
        break;
}

include_once 'app/Views/footer.php';
?>