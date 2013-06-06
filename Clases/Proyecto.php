<?php

class Proyecto {
	protected $id;
	protected $nombre;
	protected $fechaInicio;
	protected $fechaFin;
	protected $historias;
	protected $evas;
	protected $roles; //roles del usuario actual
	
	function setId($id) { $this->id = $id; }
	function getId() { return $this->id; }
	function setNombre($nombre) { $this->nombre = $nombre; }
	function getNombre() { return $this->nombre; }
	function setFechaInicio($fechaInicio) { $this->fechaInicio = $fechaInicio; }
	function getFechaInicio() { return $this->fechaInicio; }
	function setFechaFin($fechaFin) { $this->fechaFin = $fechaFin; }
	function getFechaFin() { return $this->fechaFin; }
	function setHistorias($historias) { $this->historias = $historias; }
	function getHistorias() { return $this->historias; }
	function setEvas($evas) { $this->evas = $evas; }
	function getEvas() { return $this->evas; }
	function setRoles($roles) { $this->roles = $roles; }
	function getRoles() { return $this->roles; }
}

?>