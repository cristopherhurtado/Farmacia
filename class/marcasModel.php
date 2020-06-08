<?php
require_once('modelo.php');

class marcasModel extends Modelo
{
	public function __construct(){

		parent::__construct();
	}


	public function getMarcas(){

		$marcas = $this->_db->query("SELECT id, nombre FROM marcas ORDER BY nombre");


		return $marcas->fetchall();
	}

	public function getMarcaId($id){
		$id = (int) $id;

		$marca = $this->_db->prepare("SELECT id, nombre, created_at, update_at FROM marcas WHERE id = ?");
		$marca->bindParam(1, $id);
		$marca->execute();

		return $marca->fetch();
	}

	public function getMarcaNombre($nombre){
		$marca = $this->_db->prepare("SELECT id FROM marcas WHERE nombre = ?");
		$marca->bindParam(1, $nombre);
		$marca->execute();

		return $marca->fetch();
	}

	public function setMarcas($nombre){
		$marca = $this->_db->prepare("INSERT INTO marcas VALUES(null, ?, now(), now())");
		$marca->bindParam(1, $nombre);
		$marca->execute();

		$row = $marca->rowCount();
		return $row;
	}


	public function editMarcas($id, $nombre){

		$id = (int) $id;

		$marca = $this->_db->prepare("UPDATE marcas SET nombre = ?, update_at = now() WHERE id = ?");
		$marca->bindParam(1, $nombre);
		$marca->bindParam(2, $id);
		$marca->execute();

		$row = $marca->rowCount();

		return $row;
	}

}
