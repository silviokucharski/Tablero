<?php
	
function getUsuarioPorLog($user, $pass)
{
	require_once '../Modelo/usuario';
	$Usuario = new Usuario();
	$Usuario = comprobarUsuario($user, $pass);//obtener el usuario
	
	if($Usuario==false)
	{
		//return error
		return false;
	}
	else
	{
		//recuperar los proyectos y roles del usuario
		$proyectosUsuario = array();
		$proyectosUsuario = getProyectosDeUsuarioController($Usuario->getId());
		$Usuario->setProyectos($proyectosUsuario);
		return $Usuario;
	}
}

function setUsuario($nombre, $usuario, $mail, $pass)
{
	require_once '../Modelo/usuario';
	
	$usuario = new Usuario();
	$usuario -> setNombre($nombre);
	if(usuarioLibre($nombre) )
	{
		return 1;// error 1, nombre ocupado
	}
	else
	{
		if(insertarUsuario($nombre, $usuario, $mail, $pass)) 
		{
			return 0; // sin errores
		}
		else
		{
			return 2;// error 2 no manejado
		}
	}
	
}




	
?>
	
	
	
