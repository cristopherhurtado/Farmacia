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

if (isset($_POST['enviar']) && $_POST['enviar'] == 'si') {
	$nombre = trim(strip_tags($_POST['nombre']));
	$codigo = trim(strip_tags($_POST['codigo']));
	$precio = trim(strip_tags($_POST['precio']));
	$categorias_id = (int) $_POST['categorias'];
	$marcas_id = (int) $_POST['marcas'];
  $descripcion = trim(strip_tags($_POST['descripcion']));

	if (!$nombre) {
		$mensaje = 'Ingrese el nombre del producto';
	}elseif (!$codigo) {
		$mensaje = 'Ingrese el codigo del producto';
	}elseif (!$precio) {
		$mensaje = 'Ingrese precio del producto';
	}elseif ($categorias_id) {
		$mensaje = 'Seleccione categoria';
	}elseif ($marcas_id) {
		$mensaje = 'Seleccione marca';
	}elseif ($descripcion) {
		$mensaje = 'Ingrese descripcion';
	}else{

		//$res = $productos->getUsuarioEmail($email);

		if ($res) {
			$mensaje = 'El producto ingresado ya existe';
		}else{

			$sql = $productos->setProducto($nombre, $codigo, $precio, $categorias_id, $marcas_id, $descripcion);

			if ($sql) {
				$_SESSION['success'] = 'El producto se ha registrado correctamente';
				header('Location: index.php');
			}else{
				$_SESSION['danger'] = 'El producto no se ha registrado';
				header('Location: index.php');
			}
		}
	}
}
if(isset($_SESSION['autenticado']) && $_SESSION['rol'] == 'Administrador' || $_SESSION['rol'] == 'Jefe de Local'):
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Nuevo Producto</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		<?php include('../partials/header.php'); ?>
		<div class="row">
			<div class="col-md-6 mt-3">
				<h3>Nuevo Producto</h3>
				<?php if(isset($mensaje)): ?>
					<p class="alert alert-danger"><?php echo $mensaje; ?></p>
				<?php endif; ?>
				<form action="" method="post">
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" name="nombre" value="<?php echo @($nombre); ?>" placeholder="Nombre del producto" class="form-control">
					</div>
					<div class="form-group">
						<label>Codigo</label>
						<input type="text" name="codigo" value="<?php echo @($codigo); ?>" placeholder="Codigo del producto" class="form-control">
					</div>
					<div class="form-group">
						<label>Precio</label>
						<input type="text" name="precio" value="<?php echo @($precio); ?>" placeholder="Precio del producto" class="form-control">
					</div>
					<div class="form-group">
						<label>Categoria</label>
						<select name="categorias" class="form-control">
							<option value="">Seleccione...</option>
							<?php
								$res = $categorias->getCategorias();
								foreach($res as $r):
							?>
								<option value="<?php echo $r['id']; ?>"><?php echo $r['nombre']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label>Marca</label>
						<select name="marcas" class="form-control">
							<option value="">Seleccione...</option>
							<?php
								$res = $marcas->getMarcas();
								foreach($res as $r):
							?>
								<option value="<?php echo $r['id']; ?>"><?php echo $r['nombre']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label>Descripcion</label>
						<input type="text" name="descripcion" value="<?php echo @($descripcion); ?>" placeholder="Descripccion del producto" class="form-control">
					</div>
					<div class="form-group">
						<input type="hidden" name="enviar" value="si">
						<button type="submit" class="btn btn-success">Guardar</button>
						<a href="index.php" class="btn btn-link">Volver</a>
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
