<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require('../class/marcasModel.php');
require('../class/config.php');
//creamos una instancia de la clase rolModel
$marcas = new marcasModel;

if (isset($_GET['id'])) {
	$id = (int) $_GET['id'];

	//preguntamos si existe datos asociados al id
	$res = $marcas->getMarcaId($id);

	if ($res) {
		//eliminar
		$mar = $marcas->deleteMarcas($id);

		if ($mar) {
			$msg = 'ok';
			header('Location: marcas.php?mg=' . $msg);
		}else{
			$msg = 'error';
			header('Location: marcas.php?er=' . $msg);
		}

	}else{
		$msg = 'error';
		header('Location: marcas.php?e=' . $msg);
	}
}
