<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

require('../class/clientesModel.php');
require('../class/config.php');

$clientes = new clientesModel;

if (isset($_GET['id'])) {

	$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

	$res = $clientes->getClienteId($id);

	if (!$res) {
		$msg = 'error';
		header('Location: clientes.php?e=' . $msg);
	}

	if (isset($_POST['enviar']) && $_POST['enviar'] == 'si') {

		$nombre = trim(strip_tags($_POST['nombre']));
		$rut = trim(strip_tags($_POST['rut']));
		$direccion = trim(strip_tags($_POST['direccion']));
		$fecha_nac = trim(strip_tags($_POST['fecha_nac']));
		$persona = trim(strip_tags($_POST['persona']));

		if (!$nombre) {
			$mensaje = 'Ingrese el nombre del cliente';
		}elseif (!$rut) {
			$mensaje = 'Ingrese rut del cliente';
		}elseif (!$direccion) {
			$mensaje = 'Ingrese direccion del cliente';
		}elseif (!$fecha_nac) {
			$mensaje = 'Ingrese fecha de nacimiento del cliente';
		}elseif (!$persona) {
			$mensaje = 'Ingrese el tipo de persona del cliente';
		}else{

			$sql = $clientes->editClientes($id, $nombre, $rut, $direccion, $fecha_nac, $persona);

			if ($sql) {
				$msg = 'ok';
				header('Location: verClientes.php?m=' . $msg . '&id=' . $id);
			}
		}
	}
}

if(isset($_SESSION['autenticado']) && $_SESSION['rol'] == 'Administrador'):
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Clientes</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<?php include('../partials/header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Clientes</h3>

				<?php if(isset($_GET['m'])): ?>
					<p class="alert alert-success">El cliente se ha modificado correctamente</p>
				<?php endif; ?>

				<?php if(isset($mensaje)): ?>
					<p class="alert alert-danger"><?php echo $mensaje; ?></p>
				<?php endif; ?>

				<form action="" method="post">
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" name="nombre" value="<?php echo $res['nombre']; ?>" placeholder="Ingrese nombre del cliente" class="form-control">
					</div>
					<div class="form-group">
						<label>Rut</label>
						<input type="text" name="rut" value="<?php echo $res['rut']; ?>" placeholder="Ingrese rut del cliente" class="form-control">
					</div>
					<div class="form-group">
						<label>Direccion</label>
						<input type="text" name="direccion" value="<?php echo $res['direccion']; ?>" placeholder="Ingrese direccion del cliente" class="form-control">
					</div>
					<div class="form-group">
						<label>Fecha de Nacimiento</label>
						<input type="date" name="fecha_nac" value="<?php echo $res['fecha_nac']; ?>" placeholder="Ingrese fecha de nacimiento del cliente" class="form-control">
					</div>
					<div class="form-group">
						<label>Persona</label>
						<input type="text" name="persona" value="<?php echo $res['persona']; ?>" placeholder="Ingrese que tipo de persona es el clinete 1/2" class="form-control">
					</div>
					<div class="form-group">
						<input type="hidden" name="enviar" value="si">
						<button type="submit" class="btn btn-success">Modificar</button>
						<a href="clientes.php" class="btn btn-link">Volver</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<?php else:
	header('Location: ' . BASE_URL . 'index.php');
	endif;
?>
