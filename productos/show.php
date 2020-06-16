<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

require('../class/categoriasModel.php');
require('../class/marcasModel.php');
require('../class/productosModel.php');
require('../class/config.php');

$categorias = new categoriasModel;
$marcas = new marcasModel;
$productos = new productosModel;

if (isset($_GET['id'])) {

	$id = (int) $_GET['id'];

	$res = $productos->getProductoId($id);

	if (!$res) {
		$mensaje = 'El dato no es valido';
	}
}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Productos</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<?php include('../partials/header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Productos</h3>

				<?php include('../partials/mensajes.php'); ?>

				<table class="table table-hover">
					<tr>
						<th>Nombre:</th>
						<td><?php echo $res['nombre']; ?></td>
					</tr>
					<tr>
						<th>Codigo:</th>
						<td><?php echo $res['codigo']; ?></td>
					</tr>
					<tr>
						<th>Precio:</th>
						<td><?php echo $res['precio']; ?></td>
					</tr>
					<tr>
						<th>Categoria:</th>
						<td><?php echo $res['categorias']; ?></td>
					</tr>
					<tr>
						<th>Marca:</th>
						<td><?php echo $res['marcas']; ?></td>
					</tr>
					<tr>
						<th>Descripcion:</th>
						<td><?php echo $res['descripcion']; ?></td>
					</tr>
				</table>
				<p>
					<a href="edit.php?id=<?php echo $res['id']; ?>" class="btn btn-link">Editar</a>
					<a href="index.php" class="btn btn-link">Volver</a>
					<!--<a href="#" class="btn btn-danger">Eliminar</a>-->
				</p>
			</div>
		</div>
	</div>
</body>
</html>
