<?php
require_once '../Clases/Historia';
require_once '../Controladores/ControladorHistoria';
session_start();

$server = new SoapServer(null, array('uri' => 'urn:webservices'));

$server->setClass('HistoriasWS');

$server->handle();

class WSHistorias
{
	function createHistoria($history)
	{
		return json_encode(createHistoriaController($historia));
	}
	
	function getHistroia($idHistoria)
	{
		return json_encode(getHistriaControaldor($idHistoria));
	}
	
	function getAllHistoriasDeProyecto($idProyecto)
	{	
		return json_encode(getH);
	}
	
	function updateHistoria($historia)
	{
		
	}
	
	function deleteHistoria($idHistoria)
	{
		
	}
}