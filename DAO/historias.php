<?php
require_once 'conexion.php';
require_once '../Clases/Historia';

function createHistoriaDAO($historia)
{

	$his = new Historia();
	$his = $$historia;
	
	$conexion = conectar();
	$consulta = "INSERT INTO 
					historias(id, idProyecto, titulo, numero, detalle, prioridad, riesgo, orden, prueba, costo)
    			VALUES ('". $his->getId() ."','". $his->getIdProyectio() ."', '". $his->getTitulo() ."', '". $his->getNumero() ."', '". $his->getDetalle() ."', '". $his->getPrioridad() ."', '". $his->getRiesgo() ."', '". $his->getOrden() ."','". $his->getPrueba() ."', '". $his->getCosto() ."');";
	$resultado = pg_query($consulta) or die('Consulta fallida: ' . pg_last_error());
	$aux = pg_fetch_row($resultado);
	pg_free_result($resultado);
	pg_close($conexion);
	if($aux==0)
	{
		return false;
	}
	else
	{
		return true;
	}
}

function getHistriaDAO($idHistoria)
{
$conexion = conectar();

		$consulta = "SELECT 
						id, 
						id_proyecto, 
						titulo, 
						numero, 
						detalle,
						riesgo,
       					orden,
						prueba,
						costo
  					FROM 
						historias
					WHERE 
						id = '". $idHistoria ."';";

  							
		$resultado = pg_query($consulta) or die('Consulta fallida: ' . pg_last_error());
		$aux = pg_fetch_row($resultado);
		  	   pg_free_result($resultado);
			   pg_close($conexion);
		if(!$aux)
		{
			return false;
		}
		else
		{
		//Crear objeto historia y cargarle los datos
				$historia = new Historia();
				$historia->setId($aux[0]);
				$historia->setIdProyecto($aux[1]);
				$historia->setTitulo($aux[2]);
				$historia->setNumero($aux[3]);
				$historia->setDetalle($aux[4]);
				$historia->setRiesgo($aux[5]);
				$historia->setOrden($aux[6]);
				$historia->setPrueba($aux[7]);
				$historia->setCosto($aux[8]);				
				
				
			return $historia;
		}
	}	

function getHistoriasDeProyectoDAO($idProyecto)
{
	$conexion = conectar();
	$consulta = "SELECT 
					id, 
					id_proyecto, 
					titulo, 
					numero, 
					detalle, 
					riesgo, 
					orden, 
					prueba, 
       				costo
  				FROM 
					historias;				
				WHERE
					id_proyecto = ".$idProyecto."
				ORDER BY
				  	orden ASC;";
		
	$resultado = pg_query($consulta) or die('Consulta fallida: ' . pg_last_error());
	$lista = array();
	$lista = pg_fetch_all($resultado);
	$listaHistorias = array();
	if(!empty ($lista))
	{
		foreach ($lista as $h)
		{
				$historia = new Historia();
				$historia->setId($h[id]);
				$historia->setIdProyecto($h[id_proyecto]);
				$historia->setTitulo($h[titulo]);
				$historia->setNumero($h[numero]);
				$historia->setDetalle($h[detalle]);
				$historia->setRiesgo($h[riesgo]);
				$historia->setOrden($h[orden]);
				$historia->setPrueba($h[prueba]);
				$historia->setCosto($h[costo]);
				
				array_push($listaHistorias, $historia);
		}
		pg_free_result($resultado);
		pg_close($conexion);
		return $listaComentarios;
	}
	else
	{
		pg_free_result($resultado);
		pg_close($conexion);
		return null;
	}
}

function updateHistoriaDAO($historia)
{
	$conexion = conectar();
	$consulta = "UPDATE
					historias
				SET 
					id_proyecto=".$historia->getIdProyecto().", 
					titulo='".$historia->getTitulo()."', 
					numero=".$historia->getNumero().", 
					detalle='".$historia->getDetalle()."', 
					riesgo='".$historia->getRiesgo()."',
					orden=".$historia->getOrden().", 
					prueba='".$historia->getPrueba()."', 
					costo=".$historia->getCosto()."
				WHERE 
					id=".$historia->getId().";
	";
	$resultado = pg_query($consulta) or die('Consulta fallida: ' . pg_last_error());
	$aux = pg_fetch_row($resultado);
	pg_free_result($resultado);
	pg_close($conexion);
	if($aux==0)
	{
		return false;
	}
	else
	{
		return true;
	}
}




function deleteHistoriaDAO($idHistoria)
{
	$conexion = conectar();
	$consulta = "DELETE FROM 
					historias
				WHERE 
					id =". $idHistoria .";";
	$resultado = pg_query($consulta) or die('Consulta fallida: ' . pg_last_error());
	$aux = pg_fetch_row($resultado);
	pg_free_result($resultado);
	pg_close($conexion);
	if($aux==0)
	{
		return false;
	}
	else
	{
		return true;
	}
}


function updateOrdenHistoriasDAO($listHistoria)
{
	$conexion = conectar();
	
	pg_query("BEGIN") or die("Error al conectarse con la BD\n");
	
	$flag = true;
	
	foreach ($listHistoria as $h)
	{
		if($flag)
		{
			$consulta = "UPDATE
						historias
					SET
						orden=".$historia->getOrden().",
					WHERE
						id=".$historia->getId().";
			";
			$resultado = pg_query($consulta) or die('Consulta fallida: ' . pg_last_error());
			
			if(!$resultado)
			{
				$flag = false;
			}
		}	
	}
	
	if($flag)
	{
		pg_query("COMMIT") or die("Error al conectarse con la BD\n");
	}
	else
	{
		pg_query("ROLLBACK") or die("Error al conectarse con la BD\n");
	}
	
	
	pg_close($conexion);
	if(!$flag)
	{
		return false;
	}
	else
	{
		return true;
	}
}
//recuperar un rango de historias para cambiarles el orden
function getRangoHistoriasDeProyectoDAO($idProyecto, $id1, $id2)
{
	$conexion = conectar();
	$consulta = "SELECT
					id,
					id_proyecto,
					titulo,
					numero,
					detalle,
					riesgo,
					orden,
					prueba,
       				costo
  				FROM
					historias
				WHERE
					id_proyecto = ".$idProyecto."
					AND
					(
						(orden <= ".$id1." AND orden >= ".$id2.")
						or
						(orden >= ".$id1." AND orden <= ".$id2.")
					)
				ORDER BY
				  	orden ASC;";

	$resultado = pg_query($consulta) or die('Consulta fallida: ' . pg_last_error());
	$lista = array();
	$lista = pg_fetch_all($resultado);
	$listaHistorias = array();
	if(!empty ($lista))
	{
		foreach ($lista as $h)
		{
				$historia = new Historia();
				$historia->setId($h[id]);
				$historia->setIdProyecto($h[id_proyecto]);
				$historia->setTitulo($h[titulo]);
				$historia->setNumero($h[numero]);
				$historia->setDetalle($h[detalle]);
				$historia->setRiesgo($h[riesgo]);
				$historia->setOrden($h[orden]);
				$historia->setPrueba($h[prueba]);
				$historia->setCosto($h[costo]);
				
				array_push($listaHistorias, $historia);
		}
		pg_free_result($resultado);
		pg_close($conexion);
		return $listaComentarios;
	}
	else
	{
		pg_free_result($resultado);
		pg_close($conexion);
		return null;
	}
}


