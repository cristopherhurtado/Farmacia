<?php
require_once('modelo.php');

class mediosPagoModel extends Modelo
{
	public function __construct(){

		parent::__construct();
	}


	public function getMediosPago(){

		$mediosPago = $this->_db->query("SELECT id, nombre FROM medios_pago ORDER BY nombre");


		return $mediosPago->fetchall();
	}

	public function getMedioPagoId($id){
		$id = (int) $id;

		$medioPago = $this->_db->prepare("SELECT id, nombre FROM medios_pago WHERE id = ?");
		$medioPago->bindParam(1, $id);
		$medioPago->execute();

		return $medioPago->fetch();
	}

	public function getMedioPagoNombre($nombre){
		$medioPago = $this->_db->prepare("SELECT id FROM medios_pago WHERE nombre = ?");
		$medioPago->bindParam(1, $nombre);
		$medioPago->execute();

		return $medioPago->fetch();
	}

	public function setMediosPago($nombre){
		$medioPago = $this->_db->prepare("INSERT INTO medios_pago VALUES(null, ?)");
		$medioPago->bindParam(1, $nombre);
		$medioPago->execute();

		$row = $medioPago->rowCount();
		return $row;
	}


	public function editMediosPago($id, $nombre){

		$id = (int) $id;

		$medioPago = $this->_db->prepare("UPDATE medios_pago SET nombre = ? WHERE id = ?");
		$medioPago->bindParam(1, $nombre);
		$medioPago->bindParam(2, $id);
		$medioPago->execute();

		$row = $medioPago->rowCount();

		return $row;
	}

}
