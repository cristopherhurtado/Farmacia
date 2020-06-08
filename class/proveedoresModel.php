<?php
require_once('modelo.php');

class proveedoresModel extends Modelo
{
	public function __construct(){

		parent::__construct();
	}


	public function getProveedores(){

		$proveedores = $this->_db->query("SELECT id, nombre, rut, direccion, email, contacto FROM proveedores ORDER BY nombre");


		return $proveedores->fetchall();
	}

	public function getProveedorId($id){
		$id = (int) $id;

		$proveedor = $this->_db->prepare("SELECT id, nombre, rut, direccion, email, contacto FROM proveedores WHERE id = ?");
		$proveedor->bindParam(1, $id);
		$proveedor->execute();

		return $proveedor->fetch();
	}


	public function getProveedorNombre($nombre){
		$proveedor = $this->_db->prepare("SELECT id FROM proveedores WHERE nombre = ?");
		$proveedor->bindParam(1, $nombre);
		$proveedor->execute();

		return $proveedor->fetch();
	}

	public function setProveedores($nombre, $rut, $direccion, $email, $contacto){
		$proveedor = $this->_db->prepare("INSERT INTO proveedores VALUES(null, ?, ?, ?, ?, ?)");
		$proveedor->bindParam(1, $nombre);
		$proveedor->bindParam(2, $rut);
		$proveedor->bindParam(3, $direccion);
		$proveedor->bindParam(4, $email);
		$proveedor->bindParam(5, $contacto);
		$proveedor->execute();

		$row = $proveedor->rowCount();
		return $row;
	}

	public function editProveedores($id, $nombre, $rut, $direccion, $email, $contacto){

		$id = (int) $id;

		$proveedor = $this->_db->prepare("UPDATE proveedores SET nombre = ?, rut = ?, direccion = ?, email = ?, contacto = ?; WHERE id = ?");
		$proveedor->bindParam(1, $nombre);
		$proveedor->bindParam(6, $id);
		$proveedor->bindParam(2, $rut);
		$proveedor->bindParam(3, $direccion);
		$proveedor->bindParam(4, $email);
		$proveedor->bindParam(5, $contacto);
		$proveedor->execute();

		$row = $proveedor->rowCount();

		return $row;
	}

	
}
