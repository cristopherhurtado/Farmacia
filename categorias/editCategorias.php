<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

require('../class/categoriasModel.php');
require('../class/config.php');

$categorias = new categoriasModel;

if (isset($_GET['id'])) {

	$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

	$res = $categorias->getCategoriaId($id);

	if (!$res) {
		$msg = 'error';
		header('Location: categorias.php?e=' . $msg);
	}

	if (isset($_POST['enviar']) && $_POST['enviar'] == 'si') {

		$codigo = trim(strip_tags($_POST['codigo']));
		$nombre = trim(strip_tags($_POST['nombre']));

		if (!$codigo) {
			$mensaje = 'Ingrese el codigo de la categoria';
		}elseif (!$nombre) {
			$mensaje = 'Ingrese nombre de la categoria';
		}else{

			$sql = $categorias->editCategorias($id, $codigo, $nombre);

			if ($sql) {
				$msg = 'ok';
				header('Location: verCategorias.php?m=' . $msg . '&id=' . $id);
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
	<title>Categorias</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<?php include('../partials/header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Categorias</h3>

				<?php if(isset($_GET['m'])): ?>
					<p class="alert alert-success">La categoria se ha modificado correctamente</p>
				<?php endif; ?>

				<?php if(isset($mensaje)): ?>
					<p class="alert alert-danger"><?php echo $mensaje; ?></p>
				<?php endif; ?>

				<form action="" method="post">
					<div class="form-group">
						<label>Codigo</label>
						<input type="text" name="codigo" value="<?php echo $res['codigo']; ?>" placeholder="Codigo de la categoria" class="form-control">
					</div>
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" name="nombre" value="<?php echo $res['nombre']; ?>" placeholder="Nombre de la categoria" class="form-control">
					</div>
					<div class="form-group">
						<input type="hidden" name="enviar" value="si">
						<button type="submit" class="btn btn-success">Modificar</button>
						<a href="categorias.php" class="btn btn-link">Volver</a>
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
