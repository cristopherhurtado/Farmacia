<?php
require_once('modelo.php');

class clientesModel extends Modelo
{
	public function __construct(){

		parent::__construct();
	}

	public function getClientes(){

		$clientes = $this->_db->query("SELECT id, nombre, rut, direccion, fecha_nac, persona FROM clientes ORDER BY nombre");

		return $clientes->fetchall();
	}

	public function getClienteId($id){
		$id = (int) $id;

		$cliente = $this->_db->prepare("SELECT id, nombre, rut, direccion, fecha_nac, persona FROM clientes WHERE id = ?");
		$cliente->bindParam(1, $id);
		$cliente->execute();

		return $cliente->fetch();
	}

	public function getClienteNombre($nombre){
		$cliente = $this->_db->prepare("SELECT id FROM clientes WHERE nombre = ?");
		$cliente->bindParam(1, $nombre);
		$cliente->execute();

		return $cliente->fetch();
	}

	public function setClientes($nombre, $rut, $direccion, $fecha_nac, $persona){
		$cliente = $this->_db->prepare("INSERT INTO clientes VALUES(null, ?, ?, ?, ?, ?)");
		$cliente->bindParam(1, $nombre);
		$cliente->bindParam(2, $rut);
		$cliente->bindParam(3, $direccion);
		$cliente->bindParam(4, $fecha_nac);
		$cliente->bindParam(5, $persona);
		$cliente->execute();

		$row = $cliente->rowCount();
		return $row;
	}

	public function editClientes($id, $nombre, $rut, $direccion, $fecha_nac, $persona){
		$id = (int) $id;

		$cliente = $this->_db->prepare("UPDATE clientes SET nombre = ?, rut = ?, direccion = ?, fecha_nac = ?, persona = ?; WHERE id = ?");
		$cliente->bindParam(6, $id);
		$cliente->bindParam(1, $nombre);
		$cliente->bindParam(2, $rut);
		$cliente->bindParam(3, $direccion);
		$cliente->bindParam(4, $fecha_nac);
		$cliente->bindParam(5, $persona);
		$cliente->execute();

		$row = $cliente->rowCount();
		return $row;
	}
}
