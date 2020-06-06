<?php
require_once('modelo.php');

class marcasModel extends Modelo
{
	public function __construct(){
		//disponemos de lo declarado en el constructor de la clase modelo
		parent::__construct();
	}

	//traemos todos los roles de la tabla roles
	public function getMarcas(){
		//consulta a la tabla roles usando el objeto db de la clase modelo
		$marcas = $this->_db->query("SELECT id, nombre FROM marcas ORDER BY nombre");

		//retornamos lo que haya en la tabla roles
		return $marcas->fetchall();
	}

	public function getMarcaId($id){
		$id = (int) $id;

		$marca = $this->_db->prepare("SELECT id, nombre, created_at, updated_at FROM marcas WHERE id = ?");
		$marca->bindParam(1, $id);
		$marca->execute();

		return $marca->fetch();
	}

	//verificar el registro previo de un rol
	public function getMarcaNombre($nombre){
		$marca = $this->_db->prepare("SELECT id FROM marcas WHERE nombre = ?");
		$marca->bindParam(1, $nombre);
		$marca->execute();

		return $marca->fetch();
	}

	public function setMarcas($nombre){
		$marca = $this->_db->prepare("INSERT INTO marcas VALUES(null, ?, now(), now())");
		$marca->bindParam(1, $nombre); //definimos el valor de cada ?
		$marca->execute();//ejecutamos la consulta

		$row = $marca->rowCount(); //devuelve la cantidad de registros insertados
		return $row;
	}

	//metodo para actualizar o modificar roles
	public function editMarcas($id, $nombre){
		//print_r($nombre);exit;
		$id = (int) $id;

		$marca = $this->_db->prepare("UPDATE marcas SET nombre = ?, updated_at = now() WHERE id = ?");
		$marca->bindParam(1, $nombre);
		$marca->bindParam(2, $id);
		$marca->execute();

		$row = $marca->rowCount(); //devuelve la cantidad de registros modificadas
		//print_r($row);exit;
		return $row;
	}

	//metodo para eliminar roles
	public function deleteMarcas($id){
		$id = (int) $id;

		$marca = $this->_db->prepare("DELETE FROM marcas WHERE id = ?");
		$marca->bindParam(1, $id);
		$marca->execute();

		$row = $marca->rowCount();
		return $row;
	}
}
