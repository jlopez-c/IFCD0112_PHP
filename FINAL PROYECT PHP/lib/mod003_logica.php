 <?php
	require ("mod002_accesoadatos.php");
	
	//require ("internaslogica.php");
	//require ("accesoadisco.php");

	/**
	* Transmite la busqueda del usuario en forma de array.
	*
	* Transmite la busqueda del usuario en forma de array y lo envia al modelo presentacion.
	*
	* Creada por Jesús López
	* @$palabras la busqueda del usuario.
	* @$arDataBusq devuelve el array con la informacion buscada.
	*/
	
	function mod003_getBusqueda( $palabras ) {
		$arDataBusq = mod002_getBusqueda( $palabras );
		
		return $arDataBusq;
	}
	
	/**
	* Almacena variables de sesion.
	*
	* Esta funcion almacena el idusuario y el nomusuario como variables de sesion una vez que el usuario a hecho login en la web.
	*
	* Creada por Jesús López
	* @$usuario, @$contrasena,son los campos introducidos por el usuario al iniciar sesion.
	* @$arDatosUsuario devuelve el array con los datos del usuario que ha iniciado sesion.
	*/
	
	function mod003_setLogin( $usuario, $contrasena ) {
		$arDatosUsuario = mod002_setLogin( $usuario, $contrasena );
	
		if ( $arDatosUsuario[ "idusuario" ] > 0 ) {
			$_SESSION[ "idusuario" ] = $arDatosUsuario[ "idusuario" ];
			$_SESSION[ "nomusuario" ] = $arDatosUsuario[ "nomusuario" ];
		} 
		
		return $arDatosUsuario;
	}
	
	/**
	* Elimina las variables de sesion.
	*
	* Vacia el array de variables de sesion para poder hacer un logout y/o que otro usuario pueda inicar sesion de nuevo.
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* No tiene variables de salida.
	*/
	
	function mod003_setLogout() {
		
		unset( $_SESSION[ "idusuario"] );
		unset( $_SESSION[ "nomusuario" ] );
		
	}
	
	/**
	* Transmite el array de Paises.
	*
	* Esta funcion transmite el array de Paises al modelo presentacion.
	*
	* Creada por Jesús López
	* @$ipag para indicar en que pagina nos encontramos.
	* @$arDataPaises el array de Paises.
	*/
	
	function mod003_getPaises( $ipag ) {
		$arDataPaises = mod002_getPaises( $ipag );
		
		return $arDataPaises;
	}
	
	/**
	* Transmite el numero de Paises.
	*
	* Esta funcion transmite el numero de Paises al modelo presentacion.
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @$numPaises retorna el numero de paises.
	*/
	
	function mod003_getCountPaises() {
		$numPaises = mod002_getCountPaises();
		
		return $numPaises;
	}
	
	/**
	* Transmite el array de Categorias.
	*
	* Esta funcion transmite el array de Categorias al modelo presentacion.
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @$arCategorias array de Categorias.
	*/
	
	function mod003_getCategorias() {
		$arCategorias = mod002_getCategorias();
		
		return $arCategorias;
	}
	
	/**
	* Transmite el array de Destinos.
	*
	* Esta funcion transmite el array de Destinos al modelo presentacion indicando la pagina en la que se encuentra y la categoria que pertenece dicho destino.
	*
	* Creada por Jesús López
	* @$ipag para indicar en que pagina nos encontramos, @$idCategoria para saber a que categoria pertenece el destino.
	* @$arDestinos el array de Destinos.
	*/
	
	function mod003_getDataDestinosCategoria( $idCategoria, $ipag ) {
		$arDestinos = mod002_getDataDestinosCategoria( $idCategoria, $ipag );
		
		return $arDestinos;
	}
	
	/**
	* Transmite el numero de destinos.
	*
	* Transmite el numero de destinos por categoria al modelo de presentacion.
	*
	* Creada por Jesús López
	* @$idCategoria para saber a que categoria pertenece el destino.
	* @$numDestinos devuelve el numero de destinos por categoria.
	*/
	
	function mod003_getCountDestinosCategoria( $idCategoria ) {
		$numDestinos = mod002_getCountDestinosCategoria( $idCategoria );
	
		
		return $numDestinos;
	}
	
	/**
	* Transmite el array de Foros.
	*
	* Esta funcion transmite el array de Foros al modelo presentacion.
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @$arForos el array de Foros.
	*/
	
	function mod003_getForos() {
		$arForos = mod002_getForos();
		
		return $arForos;
	}
	
	/**
	* Transmite el array de informacion de cada foro.
	*
	* Esta funcion transmite el array de informacion de cada foro al modelo presentacion.
	*
	* Creada por Jesús López
	* @$idForo para saber en que foro nos encontramos.
	* @$arForo el array de informacion del foro.
	*/
	
	function mod003_mainForo( $idForo ) {
		$arForo = mod002_mainForo( $idForo );
		
		return $arForo;
	}
	
	/**
	* Transmite las ciudades de cada pais.
	*
	* Esta funcion transmite las ciudqades de cada pais al modelo de presentacion, ademas de realizar una conversion de datos que nos indica con palabras en vez de de manera booleana si la ciudad es capital o no de dicho pais.
	*
	* Creada por Jesús López
	* @$idPais para saber a que pais pertenece cada ciudad.
	* @$arCiudades devuelve el array de ciudades.
	*/
	
	function mod003_getCiudades( $idPais ) {
		$arCiudades = mod002_getCiudades( $idPais );
		
		for ( $i = 0; $i < count ( $arCiudades ); $i++ ) {
			if( $arCiudades[ $i ][ 2 ] == 1 ) {
				$arCiudades[ $i ][ 2 ] = " SÍ";
			} else {
				$arCiudades[ $i ][ 2 ] = " NO";
			}
		}
		return $arCiudades;
	}
	
	/**
	* Transmite el array de la ciudad.
	*
	* Esta funcion transmite el array de la ciudad que pertenece al pais que le indicamos con su id.
	*
	* Creada por Jesús López
	* @idPais para saber que ciudades pertenecen a dicho pais.
	* @$arCity el array de la ciudad.
	*/
	
	function mod003_getCity( $idPais ) {
		$arCity = mod002_getCity( $idPais );
		
		return $arCity;
	}
	
	/**
	* Transmite el array de climas.
	*
	* Esta funcion transmite el array de climas al modelo presentacion.
	*
	* Creada por Jesús López
	* @$ipag para saber en que pagina nos encontramos, @$numItems para indicar el numero de elementos que tiene que aparecer por pantalla.
	* @$arClimas devuelve el array del clima.
	*/
	
	function mod003_getClimas( $ipag, $numItems ) {
		$arClimas = mod002_getClimas( $ipag, $numItems );
		
		
		return $arClimas;
		
	}
	
	/**
	* Transmite el numero de paginas totales.
	*
	* Esta funcion transmite el numero de paginas totales al modelo de presentacion, ya que es aqui donde se hace dicha operacion dividiendo el numero total de climas entre el numero de elementos que queremos mostrar.
	*
	* Creada por Jesús López
	* @$numItems para indicar el numero de elementos que tiene que aparecer por pantalla.
	* @$numPagTotales devuelve el nuumero de paginas totales que tendra nuestra paginacion.
	*/
	
	function mod003_getTotalPaginas( $numItems ) {
		$numClimas = mod002_getTotalPaginas();
		
		$numPagTotales = floor( $numClimas / $numItems );
		
		return $numPagTotales; 
	}
	
	/**
	* Transmite el array de la ciudad.
	*
	* Esta funcion transmite el array de la ciudad que pertenece al clima que le indicamos con su id.
	*
	* Creada por Jesús López
	* @idClima para saber que ciudades pertenecen a dicho clima.
	* @$arConsultaCiudades el array de la ciudad.
	*/
	
	function mod003_consultaCiudades( $idClima ) {
		$arConsultaCiudades = mod002_consultaCiudades( $idClima );
		
		return $arConsultaCiudades;
		
	}
	
	/**
	* Transmite el array de los continentes.
	*
	* Esta funcion transmite el array de los continentes al modelo presentacion.
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @$arContinentes el array de los continentes.
	*/
	
	function mod003_getContinentes() {
		$arContinentes = mod002_getContinentes();
		
		return $arContinentes;
		
	}
	
	/**
	* Transmite el array de los paises.
	*
	* Esta funcion transmite el array de los paises que pertenecen al continente que le indicamos con su id.
	*
	* Creada por Jesús López
	* @idContinente para saber que paises pertenecen a dicho continente.
	* @$arConsultaPaises el array de los paises.
	*/
	
	function mod003_consultaPaises( $idContinente ) {
		$arConsultaPaises = mod002_consultaPaises( $idContinente );
		
		return $arConsultaPaises;
		
	}
	
	/**
	* Transmite el array de la ciudad.
	*
	* Esta funcion transmite al modelo presentacion el array de la ciudad que pertenece al pais que le indicamos con su id.
	*
	* Creada por Jesús López
	* @idPais para saber que ciudades pertenecen a dicho pais.
	* @$arConsultaCiudades el array de la ciudad.
	*/
	
	function mod003_consultaCiudades2( $idPais ) {
		$arConsultaCiudades = mod002_consultaCiudades2( $idPais );
		
		return $arConsultaCiudades;
		
	}
	
	/**
	* Transmite todas los campos de la tabla usuarios.
	*
	* Esta funcion trabaja junto con un formulario de insercion que hemos creado en la vista, transmite todas las variables de los campos necesarios para la insercion en la tabla usuarios y asi pueda registrarse una nueva persona.
	*
	* Creada por Jesús López
	* @$nomUsu, @$apeUsu, @$email, @$password, @$descUsu son todos los campos necesarios para realizar una insercion en la tabla usuarios.
	* @$idUsu devuelve el nuevo id del usuario registrado.
	*/
	
	function mod003_registroUsu( $nomUsu, $apeUsu, $email, $password, $descUsu ) {
		$idUsu = mod002_registroUsu( $nomUsu, $apeUsu, $email, $password, $descUsu );
		
		return $idUsu;
	}
	
	/**
	* Transmite el array con los datos de un usuario especifico.
	*
	* Esta funcion transmite el array con los datos de un usuario para poder actualizar su perfil.
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @$arUsu devuelve el array del usuario.
	*/
	
	function mod003_actUsu() {
		//$arUsu = mod002_actUsu();
		
		return $arUsu;
	}
	
	/**
	* Transmite el array de datos de continentes.
	*
	* Esta funcion transmite el array de datos de continentes al modelo presentacion.
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @$arDataContinentes devuelve el nuevo id del clima introducido.
	*/
	
	function mod003_getDataContinentes() {
		$arDataContinentes = mod002_getDataContinentes();
		
		return $arDataContinentes;
	}

	/**
	* Transmite todas los campos de la tabla climas.
	*
	* Esta funcion transmite todas las variables de los campos necesarios para la insercion de un nuevo clima al modelo presentacion.
	*
	* Creada por Jesús López
	* @$nomClima, @$tipoClima, @$descClima, @$imgClima, @$idContinente son todos los campos necesarios para realizar una insercion en la tabla climas.
	* @$idClima devuelve el nuevo id del clima introducido.
	*/

	function  mod003_insClima( $nomClima, $tipoClima, $descClima, $imgClima, $idContinente ) {
		$idClima =  mod002_insClima( $nomClima, $tipoClima, $descClima, $imgClima, $idContinente );
		
		return $idClima;
	}

	/**
	* Crea un array con las letras del abecedario.
	*
	* Esta funcion crea un array con las letras del abecedario para enviarlo al modelo presentacion y emplearlo a modo de paginacion con letras.
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @$arLetras devuelve el array letras.
	*/	
	
	function mod003_getLetras() {
		$arLetras = [ "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z" ];
		
		return $arLetras;
	}
	
	/**
	* Transmite el array de datos de divisas.
	*
	* Esta funcion transmite el array de datos de divisas al modelo presentacion.
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @$arDivisas devuelve el array de divisas.
	*/
	
	function mod003_getDivisas() {
		$arDivisas = mod002_getDivisas();

		return $arDivisas;
	}
	
	/**
	* Transmite las variables necesarias para el modelo de acceso a datos.
	*
	* Esta funcion transmite el array de datos de divisas al modelo presentacion.
	*
	* Creada por Jesús López
	* @$idDivisa nos indica donde actualizar, @$codDivisa es el dato a actualizar.
	* @$ifilas devuelve el numero de filas afectadas en la actualizacion.
	*/
	
	function mod003_actDivisa( $idDivisa, $codDivisa ) {
		$ifilas = mod002_actDivisa( $idDivisa, $codDivisa );
		
		return $ifilas;
	}
	
?>
