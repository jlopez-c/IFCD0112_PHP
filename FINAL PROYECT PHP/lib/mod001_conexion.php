<?php

	/**
	* Conecta con la base de datos
	*
	* Esta funcion se encarga de conectarse a la base de datos para poder acceder a ella, permite conectarse si esta bien o muestra un mensaje de error si no se ha podido establecer la conexion.
	* 
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @return retorna la conexion con la base de datos.
	*/	

	function mod001_conectoBD () {
		$direccion = "localhost";
		$usuario = "root";
		$contrasena = "";
		$database = "BaseDestinosJesus";
		
		$db = mysqli_connect ( $direccion, $usuario, $contrasena, $database );
		if ( !$db ) {
			echo "conexion fallida";
		} 
		
		return $db;
	}
	
	/**
	* Desconecta con la base de datos
	*
	* Esta funcion se encarga de desconectar a la base de datos una vez finalizada la llamada del modelo de acceso a datos.
	* 
	* Creada por Jesús López
	* No tiene variables de entrada.
	* No tiene variables de salida.
	*/	
	
	function mod001_desconectoBD ( $link ) {
		if ( $link ) {
			mysqli_close( $link );
		}
	}
?>
