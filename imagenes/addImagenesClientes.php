<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

require('../class/imagenesModel.php');
require('../class/clientesModel.php');
require('../class/config.php');

$imagenes = new imagenesModel;
$clientes = new clientesModel;

if (isset($_GET['id'])) {
	$cliente = (int) $_GET['id'];
  //echo "<pre>";
  //var_dump($);
  //echo "</pre>";
  //die();

	$cli = $clientes->getClienteId($cliente);

	if (isset($_POST['enviar']) && $_POST['enviar'] == 'si') {
		$titulo = trim(strip_tags($_POST['titulo']));
    $clientes_id = (int)$_POST['id'];

		$imagen = $_FILES['imagen']['name'];
		$tmp_name = $_FILES['imagen']['tmp_name'];
		$upload = $_SERVER['DOCUMENT_ROOT'] . '/farmacia/img/clientes/';

		$fichero_subido = $upload . basename($_FILES['imagen']['name']);

		if (move_uploaded_file($_FILES['imagen']['tmp_name'], $fichero_subido)){

			$sql = $imagenes->setImagen($titulo, $clientes_id);
			if (!$sql) {
				$mensaje = 'La imagen no se ha registrado correctamente';
			}else{
				$_SESSION['success'] = 'La imagen se ha registrado correctamente';
				header('Location: ' . BASE_URL . 'clientes/verClientes.php?id=' . $cliente);
			}
		}else{
			$mensaje = 'La imagen no ha podido ser cargada en el servidor';
		}
	}
}

if(isset($_SESSION['autenticado']) && $_SESSION['rol'] == 'Administrador'):
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nueva Imagen</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<?php include('../partials/header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Nueva Imagen</h3>
				<?php if(isset($mensaje)): ?>
					<p class="alert alert-danger"><?php echo $mensaje; ?></p>
				<?php endif; ?>
				<p class="text-danger">Si tiene un asterisco es obligatorio</p>
				<form action="" method="post" enctype="multipart/form-data">
					
					<div class="form-group">
						<label>Título<span class="text-danger">*</span></label>
						<input type="text" name="titulo" value="<?php echo @($titulo); ?>" placeholder="Título de la imagen" class="form-control">
					</div>
					<div class="form-group">
						<label>Imagen<span class="text-danger">*</span></label>
						<input type="file" name="imagen" class="form-control">
					</div>
					<div class="form-group">
						<input type="hidden" name="enviar" value="si">
						<button type="submit" class="btn btn-success">Guardar</button>
						<a href="<?php echo BASE_URL . 'clientes/verClientes.php?id=' . $cliente; ?>" class="btn btn-link">Volver</a>
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
