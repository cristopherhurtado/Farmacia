<?php
require_once('modelo.php');

class proveedoresModel extends Modelo
{
	public function __construct(){
		//disponemos de lo declarado en el constructor de la clase modelo
		parent::__construct();
	}

	//traemos todos los roles de la tabla roles
	public function getProveedores(){
		//consulta a la tabla roles usando el objeto db de la clase modelo
		$proveedores = $this->_db->query("SELECT id, nombre, rut, direccion, email, contacto FROM proveedores ORDER BY nombre");

		//retornamos lo que haya en la tabla roles
		return $proveedores->fetchall();
	}

	public function getProveedord($id){
		$id = (int) $id;

		$proveedor = $this->_db->prepare("SELECT id, nombre, rut, direccion, email, contacto FROM proveedores WHERE id = ?");
		$proveedor->bindParam(1, $id);
		$proveedor->execute();

		return $proveedor->fetch();
	}

	//verificar el registro previo de un rol
	public function getProveedorNombre($nombre){
		$proveedor = $this->_db->prepare("SELECT id FROM proveedores WHERE nombre = ?");
		$proveedor->bindParam(1, $nombre);
		$proveedor->execute();

		return $proveedor->fetch();
	}

	public function setProveedores($nombre){
		$proveedor = $this->_db->prepare("INSERT INTO proveedores VALUES(null, ?, ?, ?, ?, ?)");
		$proveedor->bindParam(1, $nombre); //definimos el valor de cada ?
		$proveedor->execute();//ejecutamos la consulta

		$row = $proveedor->rowCount(); //devuelve la cantidad de registros insertados
		return $row;
	}

	//metodo para actualizar o modificar roles
	public function editProveedores($id, $nombre, $rut, $direccion, $email, $contacto){
		//print_r($nombre);exit;
		$id = (int) $id;

		$proveedor = $this->_db->prepare("UPDATE proveedores SET nombre = ?, rut = ?, direccion = ?, email = ?, contacto = ?; WHERE id = ?");
		$proveedor->bindParam(1, $nombre);
		$proveedor->bindParam(2, $id);
		$proveedor->execute();

		$row = $proveedor->rowCount(); //devuelve la cantidad de registros modificadas
		//print_r($row);exit;
		return $row;
	}

	//metodo para eliminar roles
	public function deleteProveedores($id){
		$id = (int) $id;

		$proveedor = $this->_db->prepare("DELETE FROM proveedores WHERE id = ?");
		$proveedor->bindParam(1, $id);
		$proveedor->execute();

		$row = $proveedor->rowCount();
		return $row;
	}
}
