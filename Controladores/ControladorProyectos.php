<?php
require_once '../Clases/Proyecto';


	function getProyectosDeUsuarioController($idUsuario)
	{
		$listaProyectos = array();
		$listaProyectos = getProyectosDeUsuarioDAO($idUsuario);

		for ($x == 0; $x < count($listaProyectos); $x++)
		{			
			$listaProyectos[$x]->setRoles(getRolesByProyecto($listaProyectos[$x]->getId(), $idUsuario));
		}
		
		return $listaProyectos; 
			
	}
	
	function getProyecto($idProyecto)
	{
		
		$pro = new Proyecto();
		$pro = getProyectoByID($idProyecto);	
		if($pro = false)
		{
			return false; 
		}
		else
		{
			//$pro-> $roles
			return $pro;
		}
	}
	
	function updateProyectoController($proyecto)
	{
		return updateProtectoDAO($proyecto);		
	}
	
	function createProyectController($proyecto)
	{
		return createProyectoDAO($proyecto);
	}
	
	function deleteProyectoController($idProyecto)
	{
		return deleteProyectoDAO($idProyecto);
	}
	
?>