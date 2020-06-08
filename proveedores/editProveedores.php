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

	if (isset($_POST['enviar']) && $_POST['enviar'] == 'si') {

		$nombre = trim(strip_tags($_POST['nombre']));
		$rut = trim(strip_tags($_POST['rut']));
		$direccion = trim(strip_tags($_POST['direccion']));
		$email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
		$contacto = trim(strip_tags($_POST['contacto']));

		if (!$nombre) {
			$mensaje = 'Ingrese el nombre del proveedor';
		}elseif (!$rut) {
			$mensaje = 'Ingrese rut del proveedor';
		}elseif (!$direccion) {
			$mensaje = 'Ingrese direccion del proveedor';
		}elseif (!$email) {
			$mensaje = 'Ingrese email del proveedor';
		}elseif (!$contacto) {
			$mensaje = 'Ingrese contacto del proveedor';
		}else{

			$sql = $proveedores->editProveedores($id, $nombre, $rut, $direccion, $email, $contacto);

			if ($sql) {
				$msg = 'ok';
				header('Location: verProveedores.php?m=' . $msg . '&id=' . $id);
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
	<title>Proveedor</title>
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

				<form action="" method="post">
					<div class="form-group">
						<label>Nombre del Proveedor</label>
						<input type="text" name="nombre" value="<?php echo $res['nombre']; ?>" placeholder="Nombre del proveedor" class="form-control">
					</div>
					<div class="form-group">
						<label>Rut del Proveedor</label>
						<input type="text" name="rut" value="<?php echo $res['rut']; ?>" placeholder="Rut del proveedor" class="form-control">
					</div>
					<div class="form-group">
						<label>Direccion del Proveedor</label>
						<input type="text" name="direccion" value="<?php echo $res['direccion']; ?>" placeholder="Direccion del proveedor" class="form-control">
					</div>
					<div class="form-group">
						<label>Email del Proveedor</label>
						<input type="email" name="email" value="<?php echo $res['email']; ?>" placeholder="Email del proveedor" class="form-control">
					</div>
					<div class="form-group">
						<label>Contacto del Proveedor</label>
						<input type="text" name="contacto" value="<?php echo $res['contacto']; ?>" placeholder="Contacto del proveedor" class="form-control">
					</div>
					<div class="form-group">
						<input type="hidden" name="enviar" value="si">
						<button type="submit" class="btn btn-success">Modificar</button>
						<a href="proveedores.php" class="btn btn-link">Volver</a>
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
