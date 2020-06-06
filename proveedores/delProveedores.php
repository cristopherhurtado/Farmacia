<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require('../class/proveedoresModel.php');
//creamos una instancia de la clase rolModel
$proveedores = new proveedoresModel;

if (isset($_GET['id'])) {
	$id = (int) $_GET['id'];

	//preguntamos si existe datos asociados al id
	$res = $proveedores->getProveedorId($id);

	if ($res) {
		//eliminar
		$sql = $proveedores->deleteProveedores($id);

		if ($sql) {
			$msg = 'ok';
			header('Location: proveedores.php?mg=' . $msg);
		}else{
			$msg = 'error';
			header('Location: proveedores.php?er=' . $msg);
		}

	}else{
		$msg = 'error';
		header('Location: proveedores.php?e=' . $msg);
	}
}
