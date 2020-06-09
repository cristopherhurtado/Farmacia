<?php
require_once('modelo.php');

class categoriasModel extends Modelo
{
	public function __construct(){

		parent::__construct();
	}

	public function getCategorias(){

		$categorias = $this->_db->query("SELECT id, codigo, nombre FROM categorias ORDER BY nombre");


		return $categorias->fetchall();
	}

	public function getCategoriaId($id){
		$id = (int) $id;

		$categoria = $this->_db->prepare("SELECT id, codigo, nombre FROM categorias WHERE id = ?");
		$categoria->bindParam(1, $id);
		$categoria->execute();

		return $categoria->fetch();
	}


	public function getCategoriaNombre($codigo, $nombre){
		$categoria = $this->_db->prepare("SELECT id FROM categorias WHERE nombre = ?");
		$categoria->bindParam(1, $codigo);
		$categoria->bindParam(2, $nombre);
		$categoria->execute();

		return $categoria->fetch();
	}

	public function setCategorias($codigo, $nombre){
		$categoria = $this->_db->prepare("INSERT INTO categorias VALUES(null, ?, ?)");
		$categoria->bindParam(1, $codigo);
		$categoria->bindParam(2, $nombre);
		$categoria->execute();

		$row = $categoria->rowCount();
		return $row;
	}

	public function editCategorias($id, $codigo, $nombre){

		$id = (int) $id;

		$categoria = $this->_db->prepare("UPDATE categorias SET codigo = ?, nombre = ? WHERE id = ?");
	  $categoria->bindParam(3, $id);
		$categoria->bindParam(1, $codigo);
		$categoria->bindParam(2, $nombre);
		$categoria->execute();

		$row = $categoria->rowCount();

		return $row;
	}


}
