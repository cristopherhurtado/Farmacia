<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

require('../class/clientesModel.php');
require('../class/imagenesModel.php');
require('../class/config.php');


$clientes = new clientesModel;
$imagenes = new imagenesModel;

if (isset($_POST['enviar']) && $_POST['enviar'] == 'si') {
	$nombre = trim(strip_tags($_POST['nombre']));
	$rut = trim(strip_tags($_POST['rut']));
	$direccion = trim(strip_tags($_POST['direccion']));
	$fecha_nac = trim(strip_tags($_POST['fecha_nac']));
	$persona = trim(strip_tags($_POST['persona']));
	$imagenes = trim(strip_tags($_POST['imagen']));


	if (!$nombre) {
		$mensaje = 'Ingrese el nombre del clienter';
	}elseif (!$rut) {
		$mensaje = 'Ingrese rut del cliente';
	}elseif (!$direccion) {
		$mensaje = 'Ingrese direccion del cliente';
	}elseif (!$fecha_nac) {
		$mensaje = 'Ingrese fecha de nacimiento del cliente';
	}elseif (!$persona) {
		$mensaje = 'Ingrese el tipo de persona del cliente';
	}elseif (!$imagen) {
		$mensaje = 'Ingrese la imagen del cliente';
	}else{

		$res = $clientes->getClienteNombre($nombre);

		if ($res) {
			$mensaje = 'El cliente ingresado ya existe';
		}else{
			$res = $clientes->setClientes($nombre, $rut, $direccion, $fecha_nac, $persona, $imagenes);

			if ($res) {
				$msg = 'ok';
				header('Location: clientes.php?m=' . $msg);
			}
		}
	}
	}

if(isset($_SESSION['autenticado']) && $_SESSION['rol'] == 'Administrador' || $_SESSION['rol'] == 'Jefe de Local' || $_SESSION['rol'] == 'Vendedor'):
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nuevo Cliente</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<?php include('../partials/header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Nuevo Cliente</h3>
				<?php if(isset($mensaje)): ?>
					<p class="alert alert-danger"><?php echo $mensaje; ?></p>
				<?php endif; ?>

				<form action="" method="post">
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" name="nombre" value="" placeholder="Ingrese nombre del cliente" class="form-control">
					</div>
					<div class="form-group">
						<label>Rut</label>
						<input type="text" name="rut" value="" placeholder="Ingrese rut del cliente" class="form-control">
					</div>
					<div class="form-group">
						<label>Direccion</label>
						<input type="text" name="direccion" value="" placeholder="Ingrese direccion del cliente" class="form-control">
					</div>
					<div class="form-group">
						<label>Fecha Nacimiento</label>
						<input type="date" name="fecha_nac" value="" placeholder="Ingrese fecha de nacimiento del cliente" class="form-control">
					</div>
					<div class="form-group">
						<label>Persona</label>
						<input type="text" name="persona" value="" placeholder="Ingrese que tipo de persona es el clinete 1/2" class="form-control">
					</div>
					<div class="form-group">
						<input type="hidden" name="enviar" value="si">
						<button type="submit" class="btn btn-success">Guardar</button>
						<a href="<?php echo BASE_URL . 'imagenes/addImagenesClientes.php?id='?>" class="btn btn-warning">Agregar Imagen</a>
						<a href="clientes.php" class="btn btn-link">Volver</a>
					</div>
				</form>
			</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php else:
	header('Location: ' . BASE_URL . 'index.php');
	endif;
?>
