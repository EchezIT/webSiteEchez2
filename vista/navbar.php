<!DOCTYPE html>
<html lang="en">
<body>
<!--Se agrega una barra de navegación para acceder a los CRUDs, y agregar la funcionalidad "buscar"-->
<div class="menu">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="vistaHome.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="http://localhost/ProyectoIndicadores1_Trabajo/vista">Vistas <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Reload</a>
      </li>
      <li class="nav-item dropdown" >
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Inventario TI
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="border-radius: 10px">
		    <a class="dropdown-item" href="vistaAlquilado.php">PCs Alquilados</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="vistaUsuarios.php">Usuario</a>
          <a class="dropdown-item" href="vistaRol.php">Rol</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cerrarSesion.php">Exit</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Borrar">Search</button> <!--No esta cogiendo el value-->
    </form>
  </div>
</nav>
</div>
