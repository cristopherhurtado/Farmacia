<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require('../class/marcasModel.php');
require('../class/config.php');
session_start();
//creamos una instancia de la clase rolModel
$marcas = new marcasModel;

//print_r($res);
if (isset($_POST['enviar']) && $_POST['enviar'] == 'si') {
	$nombre = trim(strip_tags($_POST['nombre']));

	if (!$nombre) {
		$mensaje = 'Ingrese el nombre del rol';
	}else{

		//consulta por la existencia del rol ingresao
		$res = $marcas->getMarcaNombre($nombre);

		if ($res) {
			$mensaje = 'El rol ingresado ya existe';
		}else{
			$res = $marcas->setMarcas($nombre);

			if ($res) {
				$msg = 'ok';
				header('Location: marcas.php?m=' . $msg);
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
	<title>Nuevo Rol</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<?php include('../partials/header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Nuevo Rol</h3>
				<?php if(isset($mensaje)): ?>
					<p class="alert alert-danger"><?php echo $mensaje; ?></p>
				<?php endif; ?>

				<form action="" method="post">
					<div class="form-group">
						<label>Nombre del rol</label>
						<input type="text" name="nombre" value="<?php echo @($nombre); ?>" placeholder="Nombre del rol" class="form-control">
					</div>
					<div class="form-group">
						<input type="hidden" name="enviar" value="si">
						<button type="submit" class="btn btn-success">Guardar</button>
						<a href="marcas.php" class="btn btn-link">Volver</a>
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
