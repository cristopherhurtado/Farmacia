<?php
require_once('modelo.php');

class productosModel extends Modelo
{
	public function __construct(){

		parent::__construct();
	}

	public function getProductos(){

		$pro = $this->_db->query("SELECT p.id, p.nombre AS NOMBRE, p.codigo AS CODIGO, p.precio AS PRECIO, c.categorias_id as CATEGORIA, m.marcas_id_id as MARCA
FROM productos p INNER JOIN categorias c ON p.categorias_id = c.id INNER JOIN marcas m ON p.marcas_id = m.id");

		return $pro->fetchall();

	}

	public function getProductoId($id){
		$id = (int) $id;

		$pro = $this->_db->prepare("SELECT p.id, p.nombre AS NOMBRE, p.codigo AS CODIGO, p.precio AS PRECIO, c.categorias_id as CATEGORIA, m.marcas_id_id as MARCA
    FROM productos p INNER JOIN categorias c ON p.categorias_id = c.id INNER JOIN marcas m ON p.marcas_id = m.id  WHERE id = ?");
		$pro->bindParam(1, $id);
		$pro->execute();

		return $pro->fetch();
	}

	public function getProductoNombre($nombre){
		$pro = $this->_db->prepare("SELECT id FROM productos WHERE nombre = ?");
		$pro->bindParam(1, $nombre);
		$pro->execute();

		return $pro->fetch();
	}

	public function setProductos($nombre, $codigo, $precio, $categorias_id, $marcas_id, $descripcion){
		$pro = $this->_db->prepare("INSERT INTO productos VALUES(null, ?, ?, ?, ?, ?, ?)");
		$pro->bindParam(1, $nombre);
		$pro->bindParam(2, $codigo);
		$pro->bindParam(3, $precio);
		$pro->bindParam(4, $categorias_id);
		$pro->bindParam(5, $marcas_id);
		$pro->bindParam(6, $descripcion);
		$pro->execute();

		$row = $pro->rowCount();
		return $row;
	}

	public function editProductos($nombre, $codigo, $precio, $categorias_id, $marcas_id, $descripcion){
		$id = (int) $id;

		$pro = $this->_db->prepare("UPDATE productos SET nombre = ?, codigo = ?, precio = ?, categorias_id = ?, marcas_id = ? descripcion = ?; WHERE id = ?");
		$pro->bindParam(7, $id);
		$pro->bindParam(1, $nombre);
		$pro->bindParam(2, $codigo);
		$pro->bindParam(3, $precio);
		$pro->bindParam(4, $categorias_id);
		$pro->bindParam(5, $marcas_id);
		$pro->bindParam(6, $descripcion);
		$pro->execute();

		$row = $pro->rowCount();
		return $row;
	}
}
