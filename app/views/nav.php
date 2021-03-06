
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #e3f2fd;">
<a class="navbar-brand" href="?i=home">
    <img src="app/img/crud.png" width="220" height="80" class="d-inline-block align-top" alt="CRUD - Usuários">
  </a>
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="?i=home">Cadastrar</a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="?i=listar">listar</a>
      </li>

      <li class="nav-item active">
        <a class="nav-link" href="?i=mensagem">Mensagem</a>
      </li>
    </ul>
    <form action="" class="form-inline my-2 my-lg-0" name="pesquisar-user" method="GET" action="">
      <input class="form-control mr-sm-2" type="search" name="pesquisarUsuario" id="pesquisarUsuario" placeholder="Pesquisar usuários" aria-label="Pesquisar">
      <button type="button" class="btn btn-outline-success my-2 my-sm-0" onclick="pesquisar()">Pesquisar usuário</button>
    </form>
  </div>
</nav>

