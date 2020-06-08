<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

require('../class/proveedoresModel.php');
require('../class/config.php');

$proveedores = new proveedoresModel;

if (isset($_GET['id'])) {

	$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

	$res = $proveedores->getProveedorId($id);

	if (!$res) {
		$msg = 'error';
		header('Location: proveedores.php?e=' . $msg);
	}
}

if(isset($_SESSION['autenticado']) && $_SESSION['rol'] == 'Administrador' || $_SESSION['rol'] == 'Supervisor(a)' ):
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Proveedores</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<?php include('../partials/header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Proveedor</h3>

				<?php if(isset($_GET['m'])): ?>
					<p class="alert alert-success">El proveedor se ha modificado correctamente</p>
				<?php endif; ?>

				<?php if(isset($mensaje)): ?>
					<p class="alert alert-danger"><?php echo $mensaje; ?></p>
				<?php endif; ?>

				<table class="table table-hover">
					<tr>
						<th>Proveedor:</th>
						<td><?php echo $res['nombre']; ?></td>
					</tr>
					<tr>
						<th>Rut:</th>
						<td>
							<?php
								echo $res['rut'];
							?>
						</td>
					</tr>
					<tr>
						<th>Direccion:</th>
						<td>
							<?php
								echo $res['direccion'];
							?>
						</td>
					</tr>
					<tr>
						<th>Email:</th>
						<td>
							<?php
								echo $res['email'];
							?>
						</td>
					</tr>
					<tr>
						<th>Contacto:</th>
						<td>
							<?php
								echo $res['contacto'];
							?>
						</td>
					</tr>
				</table>
				<p>
					<a href="editProveedores.php?id=<?php echo $res['id']; ?>" class="btn btn-link">Editar</a>
					<a href="proveedores.php" class="btn btn-link">Volver</a>
		  	</p>
			</div>
		</div>
	</div>
</body>
</html>
<?php else:
	header('Location: ' . BASE_URL . 'index.php');
	endif;
?>
