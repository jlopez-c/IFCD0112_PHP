<?php
	require ("mod003_logica.php");
	
	/**
	* Construye el overlay de busqueda de paises.
	*
	* Con esta funcion construimos el overlay que contiene la informacion de la busqueda del pais que hemos decidido recopilar informacion, esta funcion es utilizada por el CONTROLADOR AJAX.
	*
	* Creada por Jesús López
	* @$palabras es la variable que recoge la cadena de caracteres introducida en el campo busqueda del body.
	* @$capaOverlay la salida de esta funcion contiene el overlay creado con la informacion del pais que hemos escogido.
	*/	
	
	function mod004_getBusqueda( $palabras ) {
		$arDataBusq = mod003_getBusqueda( $palabras );
		
		$capaOverlay = "<div class='overlay oculto'>";
		$capaOverlay.= 	"<div class='zonadatos'>";
			for ( $i = 0; $i < count ( $arDataBusq ); $i++ ) {
				$capaOverlay.= "<div class='pais'>";
				$capaOverlay.= 	"<div class='datospais'>";
				$capaOverlay.= 		"<h1>".$arDataBusq[ $i ][ 2 ]."</h1>";
				
				$capaOverlay.= 		"<p>Código: ".$arDataBusq[ $i ][ 1 ]."</p>";
				$capaOverlay.= 		"<p>Extensión: ".$arDataBusq[ $i ][ 3 ]." km2</p>";
				$capaOverlay.= 	"</div>";
				$capaOverlay.= "</div>";
			}
		$capaOverlay.= "</div>";
		$capaOverlay.= "</div>";
		
		return $capaOverlay;
	}
	
	/**
	* Construye la estructura del login para iniciar sesion. Esta funcion es utilizada por el controlador main.php
	*
	* Con esta funcion construimos los campos de introduccion necesarios para iniciar sesion en nuestra pagina.
	*
	* Creada por Jesús López
	* No tiene argumentos de entrada
	* @$capaLogin la salida de esta funcion nos entrega la estructura del login.
	*/	
	
	function mod004_setCamposLogin() {
		$capaLogin = "<div class='login'>";
		$capaLogin.= 	"<div class='camposlogin'>";
		$capaLogin.= 		"<input type='text' placeholder='Tu email' />";
		$capaLogin.= 	"</div>";
		$capaLogin.= 	"<div class='camposlogin'>";
		$capaLogin.= 		"<input type='password' placeholder='Contraseña' />";
		$capaLogin.= 	"</div>";
		$capaLogin.= 	"<div class='camposlogin'>";
		$capaLogin.= 		"Entrar";
		$capaLogin.= 	"</div>";
		$capaLogin.= "</div>";
		
		return $capaLogin;
	}
		
	/**
	* Construye la estructura del saludo al usuario.
	*
	* La primera vez que hemos iniciado sesion en nuestra pagina, con esta funcion construimos de llamada asincrona establecemos un saludo personalizado para el usuario, al cual se le muestra un cordial saludo con el nombre que haya introducido
	*
	* Creada por Jesús López
	* @$usuario, @$contrasena ambas entradas son los datos con los que el usuario se registro en la pagina web, necesarias para establecer una sesion.
	* @$arDatosLogin si los datos aportados son correctos nos retorna el saludo personalizado para el usuario, en caso de ser erroneos, nos mostrara un mensaje en pantalla que nos indica que se ha producido un fallo, y nos volvera a establecer la estructura login con los campos de estrada vacios.
	*/
	
	function mod004_setLogin( $usuario, $contrasena ) {
		$arDatosUsuario = mod003_setLogin( $usuario, $contrasena );
		// JESUSLOPEZCENTENO@GMAIL.COM
		if ( $arDatosUsuario[ "idusuario" ] > 0 ) {
			//echo "OK";
			$arDatosLogin[ "estado" ] = "OK";
			
			
			$arDatosLogin[ "capaUsuario" ] = "<div class='sesion'>";
			$arDatosLogin[ "capaUsuario" ].= "<div class='loginusuario'>";
			$arDatosLogin[ "capaUsuario" ].= "Hola ";
			$arDatosLogin[ "capaUsuario" ].= $arDatosUsuario[ "nomusuario" ];
			$arDatosLogin[ "capaUsuario" ].= "</div>";
			$arDatosLogin[ "capaUsuario" ].= "<div class='logout'>";
			$arDatosLogin[ "capaUsuario" ].=	"Cerrar sesión";
			$arDatosLogin[ "capaUsuario" ].= "</div>";
			$arDatosLogin[ "capaUsuario" ].= "</div>";
			
			
		} else {
			//echo "ERROR";
			$arDatosLogin[ "estado" ] = "ERROR";
			$arDatosLogin[ "capaError" ] = "<div class='overlayusuario'>";
			$arDatosLogin[ "capaError" ].= "<p>El usuario no es correcto</p>";
			$arDatosLogin[ "capaError" ].= "</div>";
			$arDatosLogin[ "tipo" ][ "color" ] = "red";
			$arDatosLogin[ "tipo" ][ "fuente" ] = "12px";
		}
		
		return $arDatosLogin;
	}
	
	/**
	* Construye la estructura del saludo al usuario.
	*
	* Cuando ya habiamos iniciado sesion y hemos cambiado de pagina o catualizado la misma, con esta funcion construimos de nuevo, pero de manera sincrona, el saludo personalizado para el usuario, al cual se le muestra un cordial saludo con el nombre que haya introducido
	*
	* Creada por Jesús López
	* No tiene argumentos de entrada
	* @$capaSaludo la salida de esta funcion nos retorna el saludo personalizado.
	*/
	
	function mod004_setSaludo() {
		$capaSaludo = "<div class='sesion'>";
		$capaSaludo.= "<div class='loginusuario'>";
	    $capaSaludo.=	"Hola " . $_SESSION[ "nomusuario" ];
	    $capaSaludo.= "</div>";
		$capaSaludo.= "<div class='logout'>";
		$capaSaludo.=	"Cerrar sesión";
		$capaSaludo.= "</div>";
		$capaSaludo.= "</div>";
		
		return $capaSaludo;
	}
	
	/**
	* Nos permite cerrar sesion.
	*
	* Esta funcion que unicamente se comunica con el controlador AJAX y el mod003, nos permite realizar una limpieza de las variables de sesion almacenadas al hacer el login y por tanto dar por finalizada la sesion de un usuario determinado.
	*
	* Creada por Jesús López
	* No tiene argumentos de entrada
	* @$capaLogout nos retorna la limpieza de las variables de sesion.
	*/
	
	function mod004_setLogout() {
		$capaLogout = mod003_setLogout();

		return $capaLogout;
	}
	
	/**
	* Construye una tabla con la lista de paises de nuestra base de datos.
	*
	* Esta funcion nos otorga en estructura de tabla la lista de paises que tenemos almacenados, con la singularidad de que esta paginada de manera sincrona, mostrandonoslos de tres en tres.
	*
	* Creada por Jesús López
	* @$ipag la entrada de esta funcion le permite saber el numero de la pagina en que se cuentra para asi conocer cual es el trio de paises que debe mostrar.
	* @$tablePaises nos retorna la tabla de paises que ha sido creada.
	*/
	
	function mod004_getPaises( $ipag ) {
		$arDataPaises = mod003_getPaises( $ipag );
		
		$tablePaises = "<table>";
		$tablePaises.= 	"<thead>";
		$tablePaises.= 		"<tr>";
		$tablePaises.= 			"<th>";
		$tablePaises.= 				"Nombre Pais";
		$tablePaises.= 			"</th>";
		$tablePaises.= 			"<th>";
		$tablePaises.= 				"Bandera";
		$tablePaises.= 			"</th>";
		$tablePaises.= 			"<th>";
		$tablePaises.= 				"Ciudades disponibles";
		$tablePaises.= 			"</th>";		
		$tablePaises.= 		"</tr>";
		$tablePaises.= 	"</thead>";
		$tablePaises.= 	"<tbody>";
		for ( $i = 0; $i < count( $arDataPaises ); $i++ ) {
			$tablePaises.= "<tr>";
			$tablePaises.= 	"<td>";
			$tablePaises.= 		$arDataPaises[ $i ][ 2 ];
			$tablePaises.= 	"</td>";
			$tablePaises.= 	"<td>";
			$tablePaises.= 		"<img src='".$arDataPaises[ $i ][ 5 ]."' class='anchura100 bandera' data='".$arDataPaises[ $i ][ 0 ]."'/>";
			$tablePaises.= 	"</td>";
			$tablePaises.= 	"<td>";
			$tablePaises.= "<a href='ciudades.php?idPais=".$arDataPaises[ $i ][ 0 ]."'>Ir a ciudades.</a>";
			$tablePaises.= 	"</td>";
			$tablePaises.= "</tr>";
		}
		
		$tablePaises.= "</tbody>";
		$tablePaises.= "</table>";
		
		return $tablePaises;
	}
	
	/**
	* Contruye la paginacion de la funcion anterior mod004_getPaises.
	*
	* Esta funcion nos proporciona la paginacion, en este caso con letras, del la tabla de paises creada anteriormente, ademas de que es la encargada de enviar cuantos paises queremos que sean mostrados simultaneamente en pantalla. Por otra parte esta funcion, le otorga a la paginacion la posibilidad de avanzar y retroceder de uno en uno el numero de pagina en el que nos encontramos, asi como irnos a la primera pagina o a la ultima sea cual sea en la que nos encontremos, esta paginacion es ciclica, es decir una vez que llega al final, si seguimos avanzando llegaremos al principio y viceversa.
	*
	* Creada por Jesús López
	* @$ipag la entrada de esta funcion le permite saber el numero de la pagina en que se cuentra para asi conocer cual es el trio de paises que debe mostrar.
	* @$listado nos retorna la paginacion.
	*/
	
	function mod004_getCountPaises( $ipag ) {
		$numPaises = mod003_getCountPaises();

		$arLetras = range( "A", "Z" );
		
		$listado = "<div class='paginacion'> ";
			if ( $ipag == 1 ) {
				$listado.= "&lt;&lt; ";
				$listado.= "&nbsp;&nbsp;";
				$listado.= "<a href='main.php?ipag=".ceil( $numPaises/3 )."'>&lt; </a>";
				$listado.= "&nbsp;&nbsp;";
			} else {
				$listado.= "<a href='main.php?ipag=1'>&lt;&lt; </a>";
				$listado.= "&nbsp;&nbsp;";
				$listado.= "<a href='main.php?ipag=".( $ipag - 1 )."'>&lt; </a>";
				$listado.= "&nbsp;&nbsp;";
				$listado.= "<a href='main.php?ipag=".( $ipag - 1 )."'> ".$arLetras[ $ipag - 2 ]." </a>";
			}
				$listado.= "&nbsp;&nbsp;";
				$listado.= $arLetras[ $ipag -1 ];			
				$listado.= "&nbsp;&nbsp;";			

			if ( $ipag == ceil( $numPaises/3 ) ) {
				$listado.= "<a href='main.php?ipag=1'> &gt;</a>";
				$listado.= "&nbsp;&nbsp;";
				$listado.= " &gt;&gt;";
			} else {
				$listado.= "<a href='main.php?ipag=".( $ipag + 1 )."'> ".$arLetras[ $ipag ]." </a>";
				$listado.= "&nbsp;&nbsp;";
				$listado.= "<a href='main.php?ipag=".( $ipag + 1 )."'> &gt;</a>";
				$listado.= "&nbsp;&nbsp;";
				$listado.= "<a href='main.php?ipag=".ceil( $numPaises/3 )."'> &gt;&gt;</a>";
			}
		$listado.= " </div>";
		
		return $listado;
	}
	
	/**
	* Contruye una lista con las categorias de nuestra base de datos.
	*
	* Esta funcion nos muestra en pantalla una lista, en forma de tabla de las categorias almacenadas, siendo cada una de estas un enlace que nos dirige hacia una nueva paginacion en la que se encuentran los destinos que pertenecen a la categoria que hemos seleccionado en esta funcion.
	*
	* Creada por Jesús López
	* No tiene argumentos de entrada
	* @$tableCategorias nos retorna la tabla de categorias.
	*/
	
	function mod004_getCategorias() {
		$arCategorias = mod003_getCategorias();
		
		$tableCategorias = "<div class='padrecategorias'>";
		for ( $i = 0; $i < count( $arCategorias ); $i++ ) {
			$tableCategorias.=	"<a href='categorias.php?idCategoria=".$arCategorias[ $i ][ 0 ]."' class='categorias'>";
			$tableCategorias.=		"<div>";
			$tableCategorias.=			$arCategorias[ $i ][ 1 ];
			$tableCategorias.=		"</div>";
			$tableCategorias.=	"</a>";
			$tableCategorias.=	"<br>";
		}
		$tableCategorias.="</div>";
			
		return $tableCategorias;
	}
	
	/**
	* Muestra los destinos pertenecientes a la categoria que habiamos seleccionado en la funcion anterior.
	*
	* Esta funcion nos otorga de manera sincrona, habiendo sido redirecionados a otro controlador los nombres de los destinos que pertenecieran a la categoria de la funcion creada anteriormente mod004_getCategorias.
	*
	* Creada por Jesús López
	* @$idCategoria es el id de la categoria selecionada anteriormente, @$ipag es la pagina en la que nos encontramos.
	* @$destinos nos retorna el nombre de los destinos.
	*/
	
	function mod004_getDataDestinosCategoria( $idCategoria, $ipag ) {
		$arDestinos = mod003_getDataDestinosCategoria( $idCategoria, $ipag );
	
		$destinos = "<div class='destinos'>";
		for ( $i = 0; $i < count( $arDestinos ); $i++ ) {
			$destinos.= "<div class='destino'>";
			$destinos.= 	"<div class='nomdestino'>";
			$destinos.= 		$arDestinos[ $i ][ 1 ];
			$destinos.= 	"</div>";
			$destinos.= "</div>";
		}
		$destinos.= "</div>";
		 
		return $destinos;
	}
	
	/**
	* Crea un enlace que nos lleva a la siguiente pagina de destinos.
	*
	* Esta funcion, en caso de que haya mas de cuatro destinos con el mismo idCategoria, nos permite mostrar los cuatro siguientes.
	*
	* Creada por Jesús López
	* @$idCategoria es el id de la categoria selecionada anteriormente, @$ipag es la pagina en la que nos encontramos.
	* @$divSiguiente la salida es el enlace a la siguiente pagina.
	*/
	
	function mod004_getCountDestinosCategoria( $idCategoria, $ipag ) {
		$numDestinos = mod003_getCountDestinosCategoria( $idCategoria );
				
		if ( $ipag == ceil( $numDestinos / 4 ) ) {
			$pagSiguiente = 1;
		} else {
			$pagSiguiente = $ipag + 1;
		}
		$divSiguiente = "<a href='categorias.php?idCategoria=".$idCategoria."&ipag=".$pagSiguiente."'>Siguiente</a>";
		
		return $divSiguiente;
	}	
	
	/**
	* Crea una tabla basada en los datos de la tabla foros.
	*
	* Esta funcion, nos muestra en pantalla una tabla con los datos almacenados en la tabla foros, asi como nos permite redirecionarnos al interior del contenido de cada foro pulsando en su nombre.
	*
	* Creada por Jesús López
	* No tiene argumentos de entrada.
	* @$tableForos muestra el contenido de la tabla foros.
	*/
	
	function mod004_getForos() {
		$arForos = mod003_getForos();
			
		$tableForos = "<table>";
		$tableForos.= 	"<thead>";
		$tableForos.= 		"<tr>";
		$tableForos.= 			"<th>";
		$tableForos.= 				"Nº Foro";
		$tableForos.= 			"</th>";
		$tableForos.= 			"<th>";
		$tableForos.= 				"Nombre Foro";
		$tableForos.= 			"</th>";
		$tableForos.= 			"<th>";
		$tableForos.= 				"Fecha de Creación";
		$tableForos.= 			"</th>";
		$tableForos.= 			"<th>";
		$tableForos.= 				"Creador";
		$tableForos.= 			"</th>";			
		$tableForos.= 		"</tr>";
		$tableForos.= 	"</thead>";
		$tableForos.= 	"<tbody>";
		for ( $i = 0; $i < count( $arForos ); $i++ ) {
			$tableForos.= "<tr>";
			$tableForos.= 	"<td>";
			$tableForos.= 		$arForos[ $i ][ 0 ];
			$tableForos.= 	"</td>";
			$tableForos.= 	"<td><i>";
			$tableForos.= "<a href='foros.php?idForo=".$arForos[ $i ][ 0 ]."'>".$arForos[ $i ][ 1 ]."</a>";
			$tableForos.= 	"</i></td>";	
			$tableForos.= 	"<td>";
			$tableForos.= 		$arForos[ $i ][ 2 ];
			$tableForos.= 	"</td>";
			$tableForos.= 	"<td>";
			$tableForos.= 		$arForos[ $i ][ 3 ];
			$tableForos.= 	"</td>";				
			$tableForos.= "</tr>";
		}
		$tableForos.= "</tbody>";
		$tableForos.= "</table>";
			
		return $tableForos;
	}
	
	/**
	* Muestra el los datos internos de cada foro.
	*
	* Esta funcion, nos muestra a partir del idForo que transmitimos con la funcion anterior mod004_getForos los datos que contiene.
	*
	* Creada por Jesús López
	* @$idForo es el id del foro que transmitimos.
	* @$strForo muestra el contenido del foro.
	*/
	
	function mod004_mainForo( $idForo ) {
		$arForo = mod003_mainForo( $idForo );
		
		$strForo = "<div class='foros'>";
		for ( $i = 0; $i < count ( $arForo ); $i++ ) {
			if( $arForo[ $i ][ 0 ] != -1 ) {
				$strForo.= "<div class='comentario'>"; 
				$strForo.= 	"<p>El usuario: </i>".$arForo[ $i ][ 3 ]."</p>";
				$strForo.= 	"<i>Ha Comentado: </i>".$arForo[ $i ][ 2 ]."</p>";
				$strForo.= "</div>";
			} else {
			$strForo.= "<h1>".$arForo[ 0 ][ 2 ]."</h1>";
			}
		}
		
		return $strForo;
	}
	
	/**
	* Crea un overlay con las ciudades del pais que hemos hecho clic en su respectivo pais.
	*
	* Esta funcion contruye un overlay con el nombre de la ciudad o ciudades que tengamos almacenadas con el idPais que transmitimos e indicandonos si es o no la capital del mismo, nos los indica con un si o un no, ya que en el mod003 hemos realizado el tratamiento de los datos.
	*
	* Creada por Jesús López
	* @$idPais es la entrada que nos permite saber que ciudades hay que mostrar en pantalla.
	* @$capaOverlay devuelve el overlay de las ciudades.
	*/
	
	function mod004_getCiudades( $idPais ) {
		$arCiudades = mod003_getCiudades( $idPais );
		
		$capaOverlay = "<div class='overlay oculto'>";

			for ( $i = 0; $i < count ( $arCiudades ); $i++ ) {
				$capaOverlay.= 	"<div class='zonadatos'>";
				$capaOverlay.= 	"<div class='datosciudad'>";
				$capaOverlay.= 		"<h1>".$arCiudades[ $i ][ 1 ]."</h1>";
				
				$capaOverlay.= 		"<p> ¿Es capital?".$arCiudades[ $i ][ 2 ]."</p>";
				$capaOverlay.= 	"</div>";
				$capaOverlay.= "</div>";
			}
		$capaOverlay.= "</div>";
		$capaOverlay.= "</div>";
		
		return $capaOverlay;
	}
	
	/**
	* Nos redireciona a un controlador con los datos de las ciudades.
	*
	* Esta funcion realiza la misma funcion que la anterior, solo que nos envia al contralador ciudades, mostrandonos alli los datos y no en un overlay.
	*
	* Creada por Jesús López
	* @$idPais es la entrada que nos permite saber que ciudades hay que mostrar en pantalla.
	* @$strNomPais devuelve la cadena de datos de las ciudades.
	*/
	
	function mod004_getCity( $idPais ) {
		$arCity = mod003_getCity( $idPais );
		
		$strNomPais = "<div class='ciudades'>";
		for ( $i = 0; $i < count ( $arCity ); $i++ ) {
			$strNomPais.= "<div class='ciudad'>"; 
			$strNomPais.= 	"<p>".$arCity[ $i ][ 1 ]."</p>";
			$strNomPais.= 	"<p><i>¿Capital?: </i>".$arCity[ $i ][ 2 ]."</p>";
			$strNomPais.= "</div>";
		}
		
		return $strNomPais;
	}
	
	/**
	* Nos muestra los climas almacenados asi como las ciudades con dicho clima.
	*
	* Esta funcion permite mostrar al usuario los climas, se pueden mostrar tantos como se quiera alterando el numero de items, tiene una paginacion asincrona y ademas permite saber que ciudades le corresponden a cada clima si hacemos click en la imagen siendo una consulta de 1 lvl.
	*
	* Creada por Jesús López
	* @$ipag es la pagina en la que nos encontramos. @$numItems es el numero de elementos que queremos mostrar.
	* @$listClimas devuelve el listado de climas asi como la paginacion.
	*/
	
	function mod004_getClimas( $ipag, $numItems ) {
		$arClimas = mod003_getClimas( $ipag, $numItems );
		$numPagTotales = mod003_getTotalPaginas( $numItems );
		
		$listClimas = "<div class='climas'>";
		$listClimas.="<i>Pincha en el clima para desplegar las ciudades correspondientes.</i>";
		
		for ( $i = 0; $i < count ( $arClimas ); $i++ ) {
			
			$listClimas.= "<div class='clima' data='".$arClimas[ $i ][ 0 ]."'>";
			$listClimas.=  "<h3>".$arClimas[ $i ][ 1 ]."</h3>";
			$listClimas.= 	"<img src='".$arClimas[ $i ][ 4 ]."' class='anchura100' />";
			$listClimas.= "</div>";
			
		}
		$listClimas.= "</div>";
		
		$listClimas.= "<div class='paginacion2'>";
			$listClimas.= "<div data-ipag='1' data-numitems='".$numItems."'>Inicio</div>";
			if ( $ipag != 1 ) {
				$listClimas.= "<div data-ipag='" . ( $ipag - 1 ). "' data-numitems='".$numItems."'>Ir a la página: " . ( $ipag - 1 ) . "</div>";
			}
			if ( $numPagTotales > $ipag ) {
				$listClimas.= "<div data-ipag='" . ( $ipag + 1 ). "' data-numitems='".$numItems."'>Ir a la página: " . ( $ipag + 1 ) . "</div>";
			}
		$listClimas.= "<div data-ipag='".$numPagTotales."' data-numitems='".$numItems."'>Fin</div>";
		$listClimas.= "</div>";

		return $listClimas;
	}
	
	/**
	* Nos muestra las ciudades pertenecientes al clima mostrado en pantalla.
	*
	* Con esta funcion que trabaja junto con la anterior, podemos mostrar por pantalla las ciudades pertenecientes al clima en el que habiamos clicado.
	*
	* Creada por Jesús López
	* @$idClima es el id del clima necesario para mostrar las ciudades que le pertenecen
	* @$listConsultaCiudades devuelve el listado de ciudades.
	*/
	
	function mod004_consultaCiudades( $idClima ) {
		$arConsultaCiudades = mod003_consultaCiudades( $idClima );
		
		$listConsultaCiudades = "<div class='consultaciudades'>";
		
		for ( $i = 0; $i < count ( $arConsultaCiudades ); $i++ ) {
			
			$listConsultaCiudades.= "<div class='consultaciudad' data='".$arConsultaCiudades[ $i ][ 0 ]."'>";
			$listConsultaCiudades.=  $arConsultaCiudades[ $i ][ 1 ];
			$listConsultaCiudades.= "</div>";
			
		}
		$listConsultaCiudades.= "</div>";
		
		return $listConsultaCiudades;
	}
	
	/**
	* Nos muestra los continentes de nuestra base de datos.
	*
	* Esta funcion permite mostrar al usuario los continentes dispopnibles, esta funcion junto con las proximas dos seran  una consulta de 2 lvl.
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @$listContinentes devuelve el listado de continentes.
	*/
	
	function mod004_getContinentes() {
		$arContinentes = mod003_getContinentes();
		
		$listContinentes = "<div class='continentes'>";
		$listContinentes.="<i style= color:red;>Pincha en el continente para desplegar los paises correspondientes.</i>";
		
		for ( $i = 0; $i < count ( $arContinentes ); $i++ ) {
			
			$listContinentes.= "<div class='continente' data='".$arContinentes[ $i ][ 0 ]."'>";
			$listContinentes.=  "<h3>".$arContinentes[ $i ][ 1 ]."</h3>";
			$listContinentes.= "</br>";
			$listContinentes.= "</div>";
			
		}
		$listContinentes.= "</div>";

		return $listContinentes;
	}
	
	/**
	* Nos muestra los paises que pertenecen al continente seleccionado.
	*
	* Esta funcion permite mostrar al usuario los paises pertenecientes al continente anteriormente seleccionado, y este pais a su vez transmitira su id para mostrar la ciudades que le pertenecen a el.
	*
	* Creada por Jesús López
	* @$idContinente es el id del continente que nos permite saber que paises le pertenecen.
	* @$listConsultaPaises devuelve el listado de paises.
	*/
	
	function mod004_consultaPaises( $idContinente ) {
		$arConsultaPaises = mod003_consultaPaises( $idContinente );
		
		$listConsultaPaises = "<div class='consultapaises'>";
		$listConsultaPaises.="<i style= color:blue;>Pincha en el pais para desplegar las ciudades correspondientes.</i>";
		
		for ( $i = 0; $i < count ( $arConsultaPaises ); $i++ ) {
			
			$listConsultaPaises.= "<div class='consultapais' data='".$arConsultaPaises[ $i ][ 0 ]."'>";
			$listConsultaPaises.=  "<h4>".$arConsultaPaises[ $i ][ 2 ]."</h4>";
			$listConsultaPaises.= "</div>";
			
		}
		$listConsultaPaises.= "</div>";
		
		return $listConsultaPaises;
		
	}
	
	/**
	* Nos muestra las ciudades que pertenecen al pais seleccionado.
	*
	* Esta funcion permite mostrar al usuario las ciudades pertenecientes al pais anteriormente seleccionado, esta funcion junto con las dos anteriores forman una consulta de nivel 2.
	*
	* Creada por Jesús López
	* @$idPais es el id del pais que nos permite saber que ciudades le pertenecen.
	* @$listConsultaCiudades devuelve el listado de ciudades.
	*/
	
	function mod004_consultaCiudades2( $idPais ) {
		$arConsultaCiudades = mod003_consultaCiudades2( $idPais );
		
		$listConsultaCiudades = "<div class='consultaciudades'>";
		
		for ( $i = 0; $i < count ( $arConsultaCiudades ); $i++ ) {
			
			$listConsultaCiudades.= "<div class='consultaciudad' data='".$arConsultaCiudades[ $i ][ 0 ]."'>";
			$listConsultaCiudades.=  $arConsultaCiudades[ $i ][ 1 ];
			$listConsultaCiudades.= "</div>";
			
		}
		$listConsultaCiudades.= "</div>";
		
		return $listConsultaCiudades;
	}
	
	/**
	* Nos envia los datos necesarios para realizar un registro.
	*
	* Esta funcion consiste en enviar los datos que proporciona un usuario nuevo para realizar un registro en la pagina y asi quedar almacenado en la base de datos. 
	*
	* Creada por Jesús López
	* @$nomUsu, @$apeUsu, @$email, @$password, @$descUsu son todos los campos requeridos de la tabla usuarios para poder realizar un registro.
	* @$idUsu devuelve el nuevo idUsu generado.
	*/
	
	function mod004_registroUsu( $nomUsu, $apeUsu, $email, $password, $descUsu ) {
		$idUsu = mod003_registroUsu( $nomUsu, $apeUsu, $email, $password, $descUsu );
		
		return $idUsu;
	}
	
	/**
	* Crea el formulario de actualizacion.
	*
	* Esta funcion crea el formulario de actualizacion, basandose en las variables de sesion actuales para detectar a dicho usuario.. 
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @$strForm devuelve el formulario de actualizacion.
	*/
	
	function mod004_actUsu() {
	//	$arUsu = mod003_actUsu();
		
		$strForm = "<form name='actusuario' method='POST' onsubmit='return validacionUsu();' action='actusu.php'>";
		$strForm.= "	<div>";
		$strForm.= "	<input name='idUsu' type='text' value=".$_SESSION[ "idusuario" ]." readonly /> ";
		$strForm.= "	</div>";
		$strForm.= "	<div>";
		$strForm.= "		<label>Nombre</label>";
		$strForm.= "	</div>";
		$strForm.= "	<div class='nombreUsu'>";
		$strForm.= "		<div>";
		$strForm.= "			<input name='nomUsu' type='text' value=".$_SESSION[ "nomusuario" ]." maxlength='50' placeholder='Nuevo nombre' />";
		$strForm.= "		</div>";
		$strForm.= "	</div>";
		$strForm.= "	<div>";
		$strForm.= "		<label>Apellidos</label>";
		$strForm.= "	</div>";
		$strForm.= "	<div class='apeUsu'>";
		$strForm.= "		<div>";
		$strForm.= "			<input name='apeUsu' type='text' maxlength='50' placeholder='Cambia tus apellidos' />";
		$strForm.= "		</div>";
		$strForm.= "	</div>";
		$strForm.= "	<div>";
		$strForm.= "		<label>Direccion correo electronico</label>";
		$strForm.= "	</div>";
		$strForm.= "	<div class='email'>";
		$strForm.= "		<div>";
		$strForm.= "			<input name='email' type='text' maxlength='100' placeholder='Nuevo e-mail' />";
		$strForm.= "		</div>";
		$strForm.= "	</div>";
		$strForm.= "	<div>";
		$strForm.= "		<label>Contraseña</label>";
		$strForm.= "	</div>";
		$strForm.= "	<div class='password'>";
		$strForm.= "		<div>";
		$strForm.= "			<input name='password' type='password' maxlength='25' placeholder='Nuevo password' />";
		$strForm.= "		</div>";
		$strForm.= "	</div>";
		$strForm.= "	<div>";
		$strForm.= "		<label>Descripcion</label>";
		$strForm.= "	</div>";
		$strForm.= "	<div>";
		$strForm.= "		<textarea name='descUsu' placeholder='Cuentanos un poco sobre ti'></textarea>";
		$strForm.= "	</div>";
		$strForm.= "	<div>";
		$strForm.= "		<input type='submit' value='Actualizar' />";
		$strForm.= "	</div>";
		$strForm.= "</form>";
		
		return $strForm;
	}
	
	/**
	* Crea un mensaje de aviso de inicio de sesion.
	*
	* Esta funcion crea un mensaje de aviso de inicio de sesion, en caso de que no haya ninguna iniciada, ya que para poder actualizar los datos del usuario es necesario que este este conectado. 
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @$mensaje devuelve el mensaje de aviso.
	*/
	
	function mod004_sesionrequerida() {
				
		$mensaje = "<h3> 'Debes haber iniciado sesion para poder actualizar.' </h3>";
		
		return $mensaje;
	}
	
	/**
	* Crea un desplegable con la lista de continentes.
	*
	* Esta funcion crea un un desplegable con la lista de continentes que sera necesario indicar al cual pertenece el clima que vamos a dar de alta a traves de una transaccion. 
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @$listContinentes devuelve el despegable de continentes.
	*/
	
	function mod004_getDataContinentes() {
		$arDataContinentes = mod003_getDataContinentes();
		
		$listContinentes = "<select name='continentes'>";
		for ( $i = 0; $i < count ( $arDataContinentes ); $i++  ) {
			$listContinentes.= "<option value='" . $arDataContinentes[ $i ][ 0 ] . "'>" . $arDataContinentes[ $i ][ 1 ] . "</option>";
		}
		$listContinentes.= "</select>";
		
		return $listContinentes;
	}
	
	/**
	* Transmite todas los campos de la tabla climas.
	*
	* Esta funcion trabaja junto con un formulario de insercion que hemos creado en la vista, transmite todas las variables de los campos necesarios para la insercion.
	*
	* Creada por Jesús López
	* @$nomClima, @$tipoClima, @$descClima, @$imgClima, @$idContinente son todos los campos necesarios para realizar una insercion en la tabla climas.
	* @$idClima devuelve el nuevo id del clima introducido.
	*/
	
	function  mod004_insClima( $nomClima, $tipoClima, $descClima, $imgClima, $idContinente ) {
		$idClima =  mod003_insClima( $nomClima, $tipoClima, $descClima, $imgClima, $idContinente );
		
		return $idClima;
	}
	
	/**
	* Construye una tabla con la lista de divisas de nuestra base de datos.
	*
	* Esta funcion nos otorga en estructura de tabla la lista de divisas que tenemos almacenadas ademas de un boton de un enlace para actualizar la tabla.
	*
	* Creada por Jesús López
	* No tiene variables de entrada.
	* @$tableDivisas nos retorna la tabla de divisas que ha sido creada.
	*/
	
	function mod004_getDivisas() {
		$arDivisas = mod003_getDivisas();
			
			$tableDivisas = "<table>";
			$tableDivisas.= 	"<thead>";
			$tableDivisas.= 		"<tr>";
			$tableDivisas.= 			"<th>";
			$tableDivisas.= 				"Nombre Divisa";
			$tableDivisas.= 			"</th>";
			$tableDivisas.= 			"<th>";
			$tableDivisas.= 				"Código Divisa";
			$tableDivisas.= 			"</th>";						
			$tableDivisas.= 		"</tr>";
			$tableDivisas.= 	"</thead>";
			$tableDivisas.= 	"<tbody>";
			for ( $i = 0; $i < count( $arDivisas ); $i++ ) {
				$tableDivisas.=	"<tr data='".$arDivisas[ $i ][ 0 ]."'>";
				$tableDivisas.= 	"<td>";
				$tableDivisas.= 		$arDivisas[ $i ][ 2 ];
				$tableDivisas.= 	"</td>";
				$tableDivisas.= 	"<td>";
				$tableDivisas.= 		$arDivisas[ $i ][ 1 ];
				$tableDivisas.= 	"</td>";	
				$tableDivisas.=		"<td>";
				$tableDivisas.=			"<a href='#' class='actualizar'>Actualizar</a>";
				$tableDivisas.=		"</td>";				
				$tableDivisas.= "</tr>";
			}
			
			$tableDivisas.= "</tbody>";
			$tableDivisas.= "</table>";
			
			return $tableDivisas;
	}
	
	/**
	* Crea un mensaje personalizado para el usuario.
	*
	* Esta funcion crea un mensaje personalizado para el usuario en funcion del numero de filas que hayan sido afectadas por la actualizacion de datos que hayamos insertado, nos puede indicar que todo ha ido bien, que no se ha actualizado debido a que no ha habido modificaciones o que se ha producido un error interno.
	*
	* Creada por Jesús López
	* @$idDivisa nos indica donde actualizar, @$codDivisa es el dato a actualizar.
	* @$mensaje nos retorna el mensaje personalizado.
	*/
	
	function mod004_actDivisa( $idDivisa, $codDivisa ) {
		$ifilas = mod003_actDivisa( $idDivisa, $codDivisa );
		
		$mensaje = "<div class='mensaje'>";
		switch ( $ifilas ) {
			case -1:
			
				$mensaje.= "Se ha producido un error interno. Vuelva a intentarlo más tarde.";
			break;
			case 0:
				$mensaje.= "Debido a que no se modifico nada en el formulario no he actualizado nada";
			break;
			case 1:
				$mensaje.= "Actualización de los datos de divisa realizada de forma correcta.";
			break;
			default:
				$mensaje.= "Estamos revisando el código. Por aquí no debería pasar nunca ya que es una actualizacion por clave primaria y solo puede actualizar como máximo una fila.";
			break;
		}
		$mensaje.= "</div>";
		
		return $mensaje;
	}	
?>