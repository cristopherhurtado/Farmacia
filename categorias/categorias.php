<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

require('../class/categoriasModel.php');
require('../class/config.php');

$categorias = new categoriasModel;
$res = $categorias->getCategorias();

if(isset($_SESSION['autenticado']) && $_SESSION['rol'] == 'Administrador' || $_SESSION['rol'] == 'Supervisor' || $_SESSION['rol'] == 'Jefe de Local'
|| $_SESSION['rol'] == 'Vendedor' || $_SESSION['rol'] == 'Reponedor' || $_SESSION['rol'] == 'Promotora' || $_SESSION['rol'] == 'Cliente'):
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
					<p class="alert alert-success">La categoria se ha registrado correctamente</p>
				<?php endif; ?>

				<?php if(isset($_GET['mg'])): ?>
					<p class="alert alert-success">La categoria se ha eliminado correctamente</p>
				<?php endif; ?>

				<?php if(isset($_GET['e'])): ?>
					<p class="alert alert-danger">El dato no existe</p>
				<?php endif; ?>

				<?php if(isset($_GET['er'])): ?>
					<p class="alert alert-danger">El dato no ha podido ser eliminado</p>
				<?php endif; ?>

				<a href="addCategorias.php" class="btn btn-primary">Nueva Categoria</a>
				<?php if(isset($res) && count($res)): ?>
					<table class="table table-hover">
						<tr>
							<th>Codigo</th>
							<th>Categoria</th>
						</tr>
						<?php foreach($res as $r): ?>
							<tr>
								<td>
									<a href="verCategorias.php?id=<?php echo $r['id']; ?>"><?php echo $r['codigo']; ?></a>
								</td>
								<td><?php echo $r['nombre'] ?></td>
							</tr>
						<?php endforeach; ?>
					</table>
				<?php else: ?>
					<p class="text-info mt-3">No hay categorias registradas</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</body>
</html>
<?php else:
	header('Location: ' . BASE_URL . 'index.php');
	endif;
?>
