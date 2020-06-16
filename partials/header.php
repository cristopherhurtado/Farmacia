<?php
//require($_SERVER['DOCUMENT_ROOT'] . '/farmacia/class/config.php');
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<img  src="../img/Farmacias.png" alt="" width="15%">
  <!--<a class="navbar-brand" href="#">Farmacia</a>-->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo BASE_URL . 'index.php' ?>">Home <span class="sr-only">(current)</span></a>
      </li>

      <?php if(isset($_SESSION['autenticado']) && $_SESSION['rol'] == 'Administrador'): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Administración
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Vistas</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo BASE_URL . 'categorias/categorias.php' ?>">Categorias</a>
            <a class="dropdown-item" href="<?php echo BASE_URL . 'clientes/clientes.php' ?>">Clientes</a>
            <a class="dropdown-item" href="<?php echo BASE_URL . 'marcas/marcas.php' ?>">Marcas</a>
            <a class="dropdown-item" href="<?php echo BASE_URL . 'medios_pago/mediosPago.php' ?>">Medios de Pago</a>
            <a class="dropdown-item" href="<?php echo BASE_URL . 'productos/'; ?>">Productos</a>
            <a class="dropdown-item" href="<?php echo BASE_URL . 'proveedores/proveedores.php' ?>">Proveedores</a>
            <a class="dropdown-item" href="<?php echo BASE_URL . 'roles/roles.php' ?>">Roles</a>
            <a class="dropdown-item" href="<?php echo BASE_URL . 'usuarios/usuarios.php' ?>">Usuarios</a>
          </div>
        </li>
      <?php elseif(isset($_SESSION['autenticado']) && $_SESSION['rol'] == 'Supervisor'): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Supervisor
          </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?php echo BASE_URL . 'proveedores/proveedores.php' ?>">Proveedores</a>
            <a class="dropdown-item" href="<?php echo BASE_URL . 'marcas/marcas.php' ?>">Marcas</a>
            <a class="dropdown-item" href="<?php echo BASE_URL . 'usuarios/usuarios.php' ?>">Usuarios</a>
            <a class="dropdown-item" href="<?php echo BASE_URL . 'medios_pago/mediosPago.php' ?>">Medios de Pago</a>
            <a class="dropdown-item" href="<?php echo BASE_URL . 'categorias/categorias.php' ?>">Categorias</a>
          </div>
        </li>
      <?php endif; ?>
      <li class="nav-item">
      <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
      <li class="nav-item">
        <?php if(!isset($_SESSION['autenticado'])): ?>
          <a class="nav-link" href="<?php echo BASE_URL . 'usuarios/login.php' ?>">Iniciar Session</a>
        <?php else: ?>
          <a class="nav-link" href="<?php echo BASE_URL . 'usuarios/cerrar.php' ?>">Cerrar Session</a>
        <?php endif; ?>
      </li>
    </ul>
  </div>
</nav>
