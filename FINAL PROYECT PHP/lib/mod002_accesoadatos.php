 <?php
	require ("mod001_conexion.php");
	
	/**
	* Lanza la query de recuperacion de la busqueda del usuario.
	*
	* Adquiere de la tabla paises y almacena en un array aquellos que coincidan con la busqueda realizada por el usuario a traves de la variable de entrada que le introducimos.
	*
	* Creada por Jesús López
	* @$palabras es la variable que recoge la cadena de caracteres introducida en el campo busqueda del body.
	* @$arRetorno es el array que recoge la informacion de la query que hemos lanzado almacenando los datos de la tabla paises en este caso.
	*/

	function mod002_getBusqueda( $palabras ) {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT *";
		$strSQL.= " FROM 110_paises";
		$strSQL.= " WHERE 110_nomPais LIKE '%" . $palabras . "%'";
		
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		$arRetorno[ 0 ][ 0 ] = -1;
		$arRetorno[ 0 ][ 1 ] = "";
		$arRetorno[ 0 ][ 2 ] = "No tengo nombres de jugadores con los datos " . $palabras;
		$arRetorno[ 0 ][ 3 ] = "";
		$arRetorno[ 0 ][ 4 ] = "";
		
		if ( $result ) {
			while ( $row = mysqli_fetch_array( $result ) ) {
				$arRetorno[ $i ][ 0 ] = $row[ "110_idPais" ];
				$arRetorno[ $i ][ 1 ] = $row[ "110_codPais" ];
				$arRetorno[ $i ][ 2 ] = utf8_encode( $row[ "110_nomPais" ] );
				$arRetorno[ $i ][ 3 ] = $row[ "110_extensionKm2" ];
				$arRetorno[ $i ][ 4 ] = $row[ "110_descCultura" ];
				
				$i++;
			}
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	}

	/**
	* Lanza la query de recuperacion de los usuarios que intenten hacer login.
	*
	* Esta funcion realiza una query filtrando con los datos introducidos por el usuario en este caso email y contrasena, para poder hacer el login a nuestra web y almacenar su id en una variable de sesion.
	*
	* Creada por Jesús López
	* @$usuario, @$contrasena,son los campos introducidos por el usuario al iniciar sesion.
	* @$arRetorno es el array que recoge la informacion de la query que hemos lanzado en este caso de la tabla usuarios.
	*/

	function mod002_setLogin( $usuario, $contrasena ) {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT *";
		$strSQL.= " FROM 300_usuarios";
		$strSQL.= " WHERE 300_email = '" . $usuario . "'";
		$strSQL.= " AND 300_password = '" . $contrasena . "'";
		
		$result = mysqli_query( $link, $strSQL );
		
		$arRetorno[ "idusuario" ] = -2;
		$arRetorno[ "nomusuario" ] = "Usuario no existe";
		$arRetorno[ "apellidos" ] = "";
		$arRetorno[ "desc" ] = "";
		
		if ( $result ) {
			if ( $row = mysqli_fetch_array( $result ) ) {
				$arRetorno[ "idusuario" ] = $row[ "300_idUsu" ];
				$arRetorno[ "nomusuario" ] = utf8_encode ( $row[ "300_nomUsu" ] );
				$arRetorno[ "apellidos" ] = utf8_encode ( $row[ "300_apeUsu" ] );
				$arRetorno[ "desc" ] = utf8_encode ( $row[ "300_descUsu" ] );
			}
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	}
	
	/**
	* Lanza la query de recuperacion de paises.
	*
	* Esta funcion realiza una query de recuperacion de datos de la tabla paises, en este caso limitando en 3 la informacion mostrada en pantalla dependiendo del ipag en el que nos encontramos.
	*
	* Creada por Jesús López
	* @$ipag para saber en que pagina nos encontramos y limitar el numero de elementos por pagina.
	* @$arRetorno es el array que recoge la informacion de la query que hemos lanzado en este caso de la tabla paises.
	*/
	
	function mod002_getPaises( $ipag ) {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT *";
		$strSQL.= " FROM 110_paises";
		$strSQL.= " LIMIT ".( $ipag * 3  - 3 ).", 3";
		
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			while ( $row = mysqli_fetch_array( $result ) ) {
				$arRetorno[ $i ][ 0 ] = $row[ "110_idPais" ];
				$arRetorno[ $i ][ 1 ] = $row[ "110_codPais" ];
				$arRetorno[ $i ][ 2 ] = utf8_encode( $row[ "110_nomPais" ] );
				$arRetorno[ $i ][ 3 ] = $row[ "110_extensionKm2" ];
				$arRetorno[ $i ][ 4 ] = $row[ "110_descCultura" ];
				$arRetorno[ $i ][ 5 ] = $row[ "110_bandera" ];
				$arRetorno[ $i ][ 6 ] = $row[ "100_idDivisa" ];
				$arRetorno[ $i ][ 7 ] = $row[ "600_idContinente" ];
				
				$i++;
			}
		}
		
		mod001_desconectoBD( $link );

		return $arRetorno;
	}
	
	/**
	* Lanza una query que permite contar el numero de paises.
	*
	* Esta funcion realiza una query que permite contar el numero de paises, para asi poder hacer mas adelante la operacion que permita saber el numero de paginas totales que tendra nuestra web relacionadas con el script completo de paises.
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @$arRetorno es el array que recoge el numero de paises obtenido en la query.
	*/
	
	function mod002_getCountPaises() {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT COUNT(*) AS numpaises";
		$strSQL.= " FROM 110_paises";
		
		$result = mysqli_query( $link, $strSQL );
		if ( $result ) {
			if ( $row = mysqli_fetch_array( $result ) ) {
				$retorno = $row[ "numpaises" ];				
			}
		}
		
		mod001_desconectoBD( $link );
		
		return $retorno;
	}
	
	/**
	* Lanza la query de recuperacion de categorias.
	*
	* Esta funcion realiza una query de recuperacion de datos de la tabla categorias y lo transmite al modelo logico.
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @$arRetorno es el array que recoge la informacion de la query que hemos lanzado en este caso de la tabla categorias.
	*/
	
	function mod002_getCategorias() {
		$link = mod001_conectoBD();

		$strSQL = "SELECT *";
		$strSQL.= " FROM 400_categorias";
		
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			while ( $row = mysqli_fetch_array( $result ) ) {
				$arRetorno[ $i ][ 0 ] = $row[ "400_idCategoria" ];
				$arRetorno[ $i ][ 1 ] = utf8_encode( $row[ "400_nomCategoria" ] );
				
				$i++;
			}
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	}
	
	/**
	* Lanza la query de recuperacion de destinos.
	*
	* Esta funcion realiza una query de recuperacion de datos de la tabla destinos filtrando aquellos que pertenezcan a una categoria en especial y ademas limita en 4 el numero de resultados por pagina.
	*
	* Creada por Jesús López
	* @$idCategoria para filtrar aquellos destinos que pertenezcan a una categoria en concreto, @$ipag para saber en que pagina nos encontramos y limitar el numero de elementos por pagina.
	* @$arRetorno es el array que recoge la informacion de la query que hemos lanzado en este caso de la tabla destinos.
	*/
	
	function mod002_getDataDestinosCategoria( $idCategoria, $ipag ) {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT *";
		$strSQL.= " FROM 000_destinos";
		$strSQL.= " WHERE 400_idCategoria = ".$idCategoria;
		$strSQL.= " LIMIT ".( $ipag * 4 - 4 ).", 4";
		
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		$arRetorno[ 0 ][ 0 ] = -1;
		$arRetorno[ 0 ][ 1 ] = "Esta categoria esta sola, y desolada =(";
		$arRetorno[ 0 ][ 2 ] = "";
		$arRetorno[ 0 ][ 3 ] = "";
		$arRetorno[ 0 ][ 4 ] = "";
		
		if ( $result ) {
			while ( $row = mysqli_fetch_array( $result ) ) {
				$arRetorno[ $i ][ 0 ] = $row[ "000_idDestino" ];
				$arRetorno[ $i ][ 1 ] = $row[ "000_nomdestino" ];
				$arRetorno[ $i ][ 2 ] = $row[ "000_descDestino" ];
				$arRetorno[ $i ][ 3 ] = $row[ "000_ubicacion" ];
				$arRetorno[ $i ][ 4 ] = $row[ "400_idCategoria" ];
				
				$i++;
			}
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	}
	
	/**
	* Lanza una query que permite contar el numero de destinos.
	*
	* Esta funcion realiza una query que permite contar el numero de destinos que hay dentro de una categoria en especifico.
	*
	* Creada por Jesús López
	* @$idCategoria permite filtrar que destinos hay dentro de la categoria indicada.
	* @$arRetorno es el array que recoge el numero de destinos obtenido en la query.
	*/
	
	function mod002_getCountDestinosCategoria( $idCategoria ) {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT COUNT( * ) as numDestinos";
		$strSQL.= " FROM 000_destinos";
		$strSQL.= " WHERE 400_idCategoria = ".$idCategoria;
		
		$result = mysqli_query( $link, $strSQL );
		
		if ( $result ) {
			if ( $row = mysqli_fetch_array( $result ) ) {
				$retorno = $row[ "numDestinos" ];
			}
		}
		
		mod001_desconectoBD( $link );
		
		return $retorno;
	}
	
	/**
	* Lanza la query de recuperacion de foros y usuarios.
	*
	* Esta funcion realiza una query de recuperacion de datos de la tabla foros y de la tabla usuarios, para poder encontrar aquellos usuarios que hayan interactuado en algun foro en concreto.
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @$arRetorno es el array que recoge la informacion de la query que hemos lanzado en este caso de la tabla foros y usuarios.
	*/
	
	function mod002_getForos() {
		$link = mod001_conectoBD();

		$strSQL = "SELECT 	320_idForo, 320_nomForo, 320_fechaCreacion, 300_nomUsu";
		$strSQL.= " FROM 320_FOROS, 300_usuarios";
		$strSQL.= " WHERE 320_FOROS.300_idUsu =  300_usuarios.300_idUsu";
			
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			while ( $row = mysqli_fetch_array( $result ) ) {
				$arRetorno[ $i ][ 0 ] = $row[ "320_idForo" ];
				$arRetorno[ $i ][ 1 ] = utf8_encode( $row[ "320_nomForo" ] );
				$arRetorno[ $i ][ 2 ] = utf8_encode( $row[ "320_fechaCreacion" ] );
				$arRetorno[ $i ][ 3 ] = utf8_encode( $row[ "300_nomUsu" ] );
				
				$i++;
			}
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	}

	/**
	* Lanza la query de recuperacion de los comentarios que hay en un foro especifico.
	*
	* Esta funcion realiza una query de recuperacion de los comentarios que hay en cada foro y que usuarios han sido los que lo escribieron dependiendo del foro que especifiquemos.
	*
	* Creada por Jesús López
	* @$idForo para especificar de que foro queremos recuperar la informacion
	* @$arRetorno es el array que recoge la informacion de la query que hemos lanzado en este caso de la tabla forosusuarios y usuarios.
	*/

	function mod002_mainForo( $idForo ) {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT 300_nomUsu, 320_idForo, 321_fechaHoraInteraccion, 321_comentario";
		$strSQL.= " FROM 321_forosusuarios, 300_usuarios";
		$strSQL.= " WHERE 300_usuarios.300_idUsu = 321_forosusuarios.300_idUsu"; 
		$strSQL.= " AND 320_idForo =".$idForo;

		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		$arRetorno[ 0 ][ 0 ] = -1;
		$arRetorno[ 0 ][ 1 ] = "";
		$arRetorno[ 0 ][ 2 ] = "Nadie ha comentado en este foro, lo sentimos = ( ";
		$arRetorno[ 0 ][ 3 ] = "";
		
		if ( $result ) {
			while ( $row = mysqli_fetch_array( $result ) ) {
				$arRetorno[ $i ][ 0 ] = $row[ "320_idForo" ];
				$arRetorno[ $i ][ 1 ] = $row[ "321_fechaHoraInteraccion" ];
				$arRetorno[ $i ][ 2 ] = utf8_encode( $row[ "321_comentario" ] );
				$arRetorno[ $i ][ 3 ] = utf8_encode( $row[ "300_nomUsu" ] );
				
				$i++;
			}
		}
		
		mod001_desconectoBD( $link );

		return $arRetorno;
	}
	
	/**
	* Lanza la query de recuperacion de las ciudades que hay en un pais especifico.
	*
	* Esta funcion realiza una query de recuperacion de los datos de las ciudades que comparten el id pais que hemos especificado.
	*
	* Creada por Jesús López
	* @$idPais para especificar de que pais queremos recuperar las ciudades
	* @$arRetorno es el array que recoge la informacion de las ciudades que pertenecen al pais indicado.
	*/
	
	function mod002_getCiudades( $idPais ) {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT *";
		$strSQL.= " FROM 110_paises, 111_ciudades";
		$strSQL.= " WHERE 110_paises.110_idPais = 111_ciudades.110_idPais";
		$strSQL.= " AND 110_paises.110_idPais =".$idPais; 

		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			while ( $row = mysqli_fetch_array( $result ) ) {
				$arRetorno[ $i ][ 0 ] = $row[ "111_idCiudad" ];
				$arRetorno[ $i ][ 1 ] = utf8_encode( $row[ "111_nomCiudad" ] );
				$arRetorno[ $i ][ 2 ] = $row[ "111_bCapital" ];
				$arRetorno[ $i ][ 3 ] = $row[ "110_idPais" ];
				$arRetorno[ $i ][ 4 ] = $row[ "500_idHorario" ];
				$arRetorno[ $i ][ 5 ] = $row[ "200_idClima" ];
				$arRetorno[ $i ][ 6 ] = $row[ "600_idContinente" ];
				
				$i++;
			}
		}
		
		mod001_desconectoBD( $link );

		return $arRetorno;
	}

	/**
	* Lanza la query de recuperacion de las ciudades que hay en un pais especifico.
	*
	* Esta funcion realiza una query de recuperacion de los datos de las ciudades que comparten el id pais que hemos especificado. La funcion es practicamente la misma que la anterior, solo que esta la utilizamos para otro fin dentro del modelo de presentacion.
	*
	* Creada por Jesús López
	* @$idPais para especificar de que pais queremos recuperar las ciudades
	* @$arRetorno es el array que recoge la informacion de las ciudades que pertenecen al pais indicado.
	*/
	
	function mod002_getCity( $idPais ) {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT *";
		$strSQL.= " FROM 110_paises, 111_ciudades";
		$strSQL.= " WHERE 110_paises.110_idPais = 111_ciudades.110_idPais";
		$strSQL.= " AND 110_paises.110_idPais =".$idPais; 
		
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			while ( $row = mysqli_fetch_array( $result ) ) {
				$arRetorno[ $i ][ 0 ] = $row[ "111_idCiudad" ];
				$arRetorno[ $i ][ 1 ] = utf8_encode( $row[ "111_nomCiudad" ] );
				$arRetorno[ $i ][ 2 ] = $row[ "111_bCapital" ];
				$arRetorno[ $i ][ 3 ] = $row[ "110_idPais" ];
				$arRetorno[ $i ][ 4 ] = $row[ "500_idHorario" ];
				$arRetorno[ $i ][ 5 ] = $row[ "200_idClima" ];
				$arRetorno[ $i ][ 6 ] = $row[ "600_idContinente" ];
				
				$i++;
			}
		}
		
		mod001_desconectoBD( $link );

		return $arRetorno;
	}
	
	/**
	* Recupera la informacion de la tabla climas.
	*
	* Esta funcion realiza una query de recuperacion de los datos de los climas, limitando el numero de resultados mostrados en pantalla dependiendo del numero de items y el numero de pagina que le pasemos.
	*
	* Creada por Jesús López
	* @$ipag para saber en que pagina nos encontramos, @$numItems para indicar el numero de elementos que tiene que aparecer por pantalla.
	* @$arRetorno devuelve el array de los climas.
	*/
	
	function mod002_getClimas( $ipag, $numItems ) {
		$link = mod001_conectoBD();

		$strSQL = "SELECT *";
		$strSQL.= " FROM 200_climas";
		$strSQL.= " LIMIT ". ( ( $ipag * $numItems ) - $numItems ) . ", " . $numItems;
		
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		$arRetorno[ 0 ][ 0 ] = -1;
		$arRetorno[ 0 ][ 1 ] = "No hay más climas.";
		
		if ( $result ) {
			while ( $row = mysqli_fetch_array( $result ) ) {
				$arRetorno[ $i ][ 0 ] = $row[ "200_idClima" ];
				$arRetorno[ $i ][ 1 ] = utf8_encode( $row[ "200_nomClima" ] );
				$arRetorno[ $i ][ 2 ] = utf8_encode( $row[ "200_tipoClima" ] );
				$arRetorno[ $i ][ 3 ] = utf8_encode( $row[ "200_descClima" ] );
				$arRetorno[ $i ][ 4 ] = $row[ "200_imgClima" ];
				
				$i++;
			}
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	}
	
	/**
	* Lanza una query que permite contar el numero de climas.
	*
	* Esta funcion realiza una query que permite contar el numero de climas, para asi poder hacer mas adelante la operacion que permita saber el numero de paginas totales que tendra nuestra web relacionadas con el script completo de climas.
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @$arRetorno es el array que recoge el numero de climas obtenido en la query.
	*/
	
	function mod002_getTotalPaginas() {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT COUNT(*) AS NUMCLIMAS";
		$strSQL.= " FROM 200_climas";
		
		$result = mysqli_query( $link, $strSQL );		
		
		if ( $result ) {
			if ( $row = mysqli_fetch_array( $result ) ) {
				$retorno = $row[ "NUMCLIMAS" ];
			}
		}
		
		mod001_desconectoBD( $link );
		
		return $retorno;
	}
	
	/**
	* Lanza la query de recuperacion de las ciudades que tienen un clima especifico.
	*
	* Esta funcion realiza una query de recuperacion de los datos de las ciudades que comparten el id clima que hemos especificado.
	*
	* Creada por Jesús López
	* @$idClima para especificar de que clima queremos recuperar las ciudades.
	* @$arRetorno es el array que recoge la informacion de las ciudades que pertenecen al clima indicado.
	*/
	
	function mod002_consultaCiudades( $idClima ) {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT *";
		$strSQL.= " FROM 111_ciudades";
		$strSQL.= " WHERE 200_idClima =".$idClima;
		
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			while ( $row = mysqli_fetch_array( $result ) ) {
				$arRetorno[ $i ][ 0 ] = $row[ "111_idCiudad" ];
				$arRetorno[ $i ][ 1 ] = utf8_encode( $row[ "111_nomCiudad" ] );
				$arRetorno[ $i ][ 2 ] = $row[ "111_bCapital" ];
				$arRetorno[ $i ][ 3 ] = $row[ "110_idPais" ];
				$arRetorno[ $i ][ 4 ] = $row[ "500_idHorario" ];
				$arRetorno[ $i ][ 5 ] = $row[ "200_idClima" ];
				
				$i++;
			}
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	}
	
	/**
	* Lanza la query de recuperacion de continentes.
	*
	* Esta funcion realiza una query de recuperacion de datos de la tabla continentes y enviarselo al modelo logico.
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @$arRetorno es el array que recoge la informacion de la query que hemos lanzado en este caso de la tabla continentes.
	*/
	
	function mod002_getContinentes() {
		$link = mod001_conectoBD();

		$strSQL = "SELECT *";
		$strSQL.= " FROM 600_continentes";
		
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			while ( $row = mysqli_fetch_array( $result ) ) {
				$arRetorno[ $i ][ 0 ] = $row[ "600_idContinente" ];
				$arRetorno[ $i ][ 1 ] = utf8_encode( $row[ "600_nomContinente" ] );
				$arRetorno[ $i ][ 2 ] = $row[ "600_extensionKm2" ];
				$arRetorno[ $i ][ 3 ] = $row[ "600_habitantes" ];
				
				$i++;
			}
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	}
	
	/**
	* Lanza la query de recuperacion de los paises que hay en un continente especifico.
	*
	* Esta funcion realiza una query de recuperacion de los datos de las paises que comparten el id continente que hemos especificado.
	*
	* Creada por Jesús López
	* @$idContinente para especificar de que continente queremos recuperar los paises
	* @$arRetorno es el array que recoge la informacion de los paises que pertenecen al continente indicado.
	*/
	
	function mod002_consultaPaises( $idContinente ) {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT *";
		$strSQL.= " FROM 110_paises";
		$strSQL.= " WHERE 600_idContinente =".$idContinente;
		
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		
		$arRetorno[ 0 ][ 0 ] = -1;
		$arRetorno[ 0 ][ 2 ] = "No hay paises.";
		$arRetorno[ 0 ][ 6 ] = -2;
		
		if ( $result ) {
			while ( $row = mysqli_fetch_array( $result ) ) {
				$arRetorno[ $i ][ 0 ] = $row[ "110_idPais" ];
				$arRetorno[ $i ][ 1 ] = $row[ "110_codPais" ];
				$arRetorno[ $i ][ 2 ] = utf8_encode( $row[ "110_nomPais" ] );
				$arRetorno[ $i ][ 3 ] = $row[ "110_extensionKm2" ];
				$arRetorno[ $i ][ 4 ] = $row[ "110_descCultura" ];
				$arRetorno[ $i ][ 5 ] = $row[ "110_bandera" ];
				$arRetorno[ $i ][ 6 ] = $row[ "600_idContinente" ];
				
				$i++;
			}
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	}

	/**
	* Lanza la query de recuperacion de las ciudades que pertenecen a un pais especificado.
	*
	* Esta funcion realiza una query de recuperacion de los datos de las ciudades que comparten el id pais que hemos especificado.
	*
	* Creada por Jesús López
	* @$idPais para especificar de que pais queremos recuperar las ciudades.
	* @$arRetorno es el array que recoge la informacion de las ciudades que pertenecen al pais indicado.
	*/

	function mod002_consultaCiudades2( $idPais ) {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT *";
		$strSQL.= " FROM 111_ciudades";
		$strSQL.= " WHERE 110_idPais =".$idPais;
		
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			while ( $row = mysqli_fetch_array( $result ) ) {
				$arRetorno[ $i ][ 0 ] = $row[ "111_idCiudad" ];
				$arRetorno[ $i ][ 1 ] = utf8_encode( $row[ "111_nomCiudad" ] );
				$arRetorno[ $i ][ 2 ] = $row[ "111_bCapital" ];
				$arRetorno[ $i ][ 3 ] = $row[ "110_idPais" ];
				$arRetorno[ $i ][ 4 ] = $row[ "500_idHorario" ];
				$arRetorno[ $i ][ 5 ] = $row[ "200_idClima" ];
				
				$i++;
			}
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	}
	
	/**
	* Permite crear una insercion en la tabla usuarios.
	*
	* Esta funcion lanza una query de insercion que nos permita dar de alta un nuevo usuario a traves de los datos proporcionados en el formulario de la vista.
	*
	* Creada por Jesús López
	* @$nomUsu, @$apeUsu, @$email, @$password, @$descUsu son todos los campos necesarios para realizar la query de insercion.
	* @$idUsu devuelve el nuevo id del usuario registrado.
	*/
	
	function mod002_registroUsu( $nomUsu, $apeUsu, $email, $password, $descUsu ) {
		$link = mod001_conectoBD();
			
		$strSQL = "INSERT INTO 300_usuarios";
		$strSQL.= " ( 300_idUsu, 300_nomUsu, 300_apeUsu, 300_email, 300_password, 300_descUsu )";
		$strSQL.= " VALUES ";
		$strSQL.= "( null, ";
		$strSQL.= " '".$nomUsu."', ";
		$strSQL.= " '".$apeUsu."', ";
		$strSQL.= " '".$email."', ";
		$strSQL.= " '".$password."', ";
		$strSQL.= " '".$descUsu."') ";
		
		
		$result = mysqli_query( $link, $strSQL );
		
		if ( !$result ) {
			$idUsu = -1;
		} else {
			$idUsu = mysqli_insert_id ( $link );
			
		}
		
		return $idUsu;		
	}
	
	//function mod002_actUsu() {
	//	$link = mod001_conectoBD();
	//	
	//	$strSQL = "SELECT *";
	//	$strSQL.= " FROM 300_usuarios"
	//	$strSQL.= " WHERE 300_idUsu =".$_SESSION[ "idusuario" ];
	//	
	//	$result = mysqli_query( $link, $strSQL );
	//	
	//	if ( $result ) {
	//		if ( $row = mysqli_fetch_array( $result ) ) {
	//			$arRetorno[ 0 ] = $row[ "300_idUsu" ];
	//			$arRetorno[ 1 ] = utf8_encode ( $row[ "300_nomUsu" ] );
	//			$arRetorno[ 2 ] = utf8_encode ( $row[ "300_apeUsu" ] );
	//			$arRetorno[ 3 ] = utf8_encode ( $row[ "300_email" ] );
	//			$arRetorno[ 4 ] = utf8_encode ( $row[ "300_password" ] );
	//			$arRetorno[ 5 ] = utf8_encode ( $row[ "300_descUsu" ] );
	//		}
	//	}
	//	
	//	mod001_desconectoBD( $link );
	//	
	//	return $arRetorno;
	//}
	
	/**
	* Lanza la query de recuperacion de continentes.
	*
	* Esta funcion realiza una query de recuperacion de datos de la tabla continentes y enviarselo al modelo logico.
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @$arRetorno es el array que recoge la informacion de la query que hemos lanzado en este caso de la tabla continentes.
	*/
	
	function mod002_getDataContinentes() {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT *";
		$strSQL.= " FROM 600_continentes";
		
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			while ( $row = mysqli_fetch_array( $result ) ) {
				$arRetorno[ $i ][ 0 ] = $row[ "600_idContinente" ];
				$arRetorno[ $i ][ 1 ] = utf8_encode ( $row[ "600_nomContinente" ] );
				
				$i++;
			}
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	}
	
	/**
	* Esta funcion inicia una transaccion en la tabla climas y continentesclimas.
	*
	* Esta funcion  crea query de insercion en la tabla climas y tambien en la tabla continentesclimas e inicia una transaccion que nos permite hacer una insercion simultanea controlada por los comandos rollback (que en caso de error en alguna insercion, cancela todo el proceso y no deja inserciones a medias) y commit ( que solo en caso de que todas las operciones hayan ido bien, hara la insercion en todas las tablas afectadas).
	*
	* Creada por Jesús López
	* @$nomClima, @$tipoClima, @$descClima, @$imgClima, @$idContinente son todos los campos necesarios para realizar una insercion en la tabla climas.
	* @$error devuelve en caso de error el comando ROLLBACK y en caso de que todo vaya bien el comando COMMIT.
	*/
	
	function  mod002_insClima( $nomClima, $tipoClima, $descClima, $imgClima, $idContinente ) {
		$link = mod001_conectoBD();
		
		$strSQL = "START TRANSACTION";
		$result = mysqli_query( $link, $strSQL );
		
		$strSQL = "INSERT INTO 200_climas";
		$strSQL.= " ( 200_idClima, 200_nomClima, 200_tipoClima, 200_descClima, 200_imgClima )";
		$strSQL.= " VALUES ";
		$strSQL.= "( null, ";
		$strSQL.= " '".$nomClima."', ";
		$strSQL.= " '".$tipoClima."', ";
		$strSQL.= " '".$descClima."', ";
		$strSQL.= " '".$imgClima."') ";
		
		$result = mysqli_query( $link, $strSQL );
	
		if ( !$result ) {
			$error = -1;
			
			$strSQL = "ROLLBACK";
			$result = mysqli_query( $link, $strSQL );

		} else {
			$idClima = mysqli_insert_id ( $link );
			
			$strSQL = "INSERT INTO 610_continentesclimas";
			$strSQL.= " ( 600_idContinente, 200_idClima )";
			$strSQL.= " VALUES ";
			$strSQL.= "( " . $idContinente . ", ";
			$strSQL.= $idClima .")";
					
			$result = mysqli_query( $link, $strSQL );
			if ( !$result ) {
				$error = -1;
				
				$strSQL = "ROLLBACK";
				$result = mysqli_query( $link, $strSQL );
			} else {
				$strSQL = "COMMIT";
				$result = mysqli_query( $link, $strSQL );
				$error = $idClima;
			}
		}
		
		return $error;		
	}
	
	/**
	* Lanza la query de recuperacion de divisas.
	*
	* Esta funcion realiza una query de recuperacion de datos de la tabla divisas y enviarselo al modelo logico.
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @$arRetorno es el array que recoge la informacion de la query que hemos lanzado en este caso de la tabla divisas.
	*/
	
	function mod002_getDivisas() {
		$link = mod001_conectoBD();
		
		$strSQL = "SELECT *";
		$strSQL.= " FROM 100_divisas";
		
		$result = mysqli_query( $link, $strSQL );
		
		$i = 0;
		if ( $result ) {
			while ( $row = mysqli_fetch_array( $result ) ) {
				$arRetorno[ $i ][ 0 ] = $row[ "100_idDivisa" ];
				$arRetorno[ $i ][ 1 ] = $row[ "100_codDivisa" ];
				$arRetorno[ $i ][ 2 ] = utf8_encode( $row[ "100_nomDivisa" ] );
				$arRetorno[ $i ][ 3 ] = $row[ "100_divisaDolares" ];
				$arRetorno[ $i ][ 4 ] = $row[ "100_dolaresDivisa" ];
				
				$i++;
			}
		}
		
		mod001_desconectoBD( $link );
		
		return $arRetorno;
	}
	
	/**
	* Lanza la query de actualizacion de divisas.
	*
	* Esta funcion realiza una query de actualizacion de datos de la tabla divisas y enviarselo al modelo logico.
	*
	* Creada por Jesús López
	* @$idDivisa nos indica donde actualizar, @$codDivisa es el dato a actualizar.
	* @$ifilas devuelve el numero de filas afectadas en la actualizacion.
	*/
	
	function mod002_actDivisa( $idDivisa, $codDivisa ) {
		$link = mod001_conectoBD();
		
		$strSQL = "UPDATE 100_divisas SET";
		$strSQL.= " 100_codDivisa = '" . $codDivisa . "'";
		$strSQL.= " WHERE 100_idDivisa = " . $idDivisa;
		
		$result = mysqli_query( $link, $strSQL );
		
		if ( !$result ) {
			$ifilas = -1;
		} else {
			$ifilas = mysqli_affected_rows( $link );
		}
			
		return $ifilas;
	}

?>