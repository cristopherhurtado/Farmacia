<?php
require_once('modelo.php');

class imagenesModel extends Modelo
{

	public function __construct(){
		parent::__construct();
	}

	public function getImagenes(){
		$img = $this->_db->query("SELECT img.titulo as imagen, c.id, c.nombre as cliente FROM imagenes_cliente img INNER JOIN clientes c ON img.clientes_id = c.id");

		return $img->fetchall();
	}

	public function getImagenTitulo($titulo){
		$id = (int) $id;

		$img = $this->_db->prepare("SELECT id FROM imagenes_cliente WHERE id = ?");
		$img->bindParam(1, $titulo);
		$prod->execute();

		return $img->fetch();
	}

	public function getImagenCliente($cliente){
		$cliente = (int) $cliente;

		$img = $this->_db->prepare("SELECT id, titulo FROM imagenes_cliente WHERE clientes_id = ?");
		$img->bindParam(1, $cliente);
		$img->execute();

		return $img->fetchall();
	}

	public function setImagen($titulo, $clientes_id){
		$cliente = (int) $cliente;

		$img = $this->_db->prepare("INSERT INTO imagenes_cliente VALUES(null, ?, ?, now(), now())");
		$img->bindParam(1, $titulo);
		$img->bindParam(2, $clientes_id);
		$img->execute();

		$row = $img->rowCount();
		return $row;
	}
}
