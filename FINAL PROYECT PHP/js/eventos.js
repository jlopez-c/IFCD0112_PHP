/**
* Crea el evento entrar.
*
* Esta funcion, dependiendo del caso que se active nos permite declarar el evento a ejecutar sobre un objeto en concreto.
*
* Creada por Jesús López
* No tiene variables de entrada.
* No tiene variables de retorno, el retorno es la propia accion del evento invocado.
*/	

function entrar() {
	var usuario;
	var contrasena;
	
	usuario = $( "div.login div.camposlogin:eq(0) input[type='text']" ).val();
	contrasena = $( "div.login div.camposlogin:eq(1) input[type='password']" ).val();
	
	var datos = "accion=entrar&usuario=" + usuario + "&contrasena=" + contrasena;
	
	$.ajax ( {
		type: "POST",
		url: "ajax/controladorAJAX.php",
		data: datos,
		error: function() {
			alert ("Se ha producido un error.");
		},
		success: function ( dataAjax, textStatus ) {

			data = JSON.parse( dataAjax );

			if ( data[ "estado" ] == "OK" ) {
				
				$( ".logout" ).removeClass ( "oculto" );
				$( ".login" ).addClass ( "oculto" );
				$( "header" ).append ( data[ "capaUsuario" ] );
				
			} else {
				$( ".camposlogin:eq(0) input" ).val ( "" );
				$( ".camposlogin:eq(1) input" ).val ( "" );
				
				$( "body" ).append ( data[ "capaError" ] );
				
				$( ".overlayusuario" ).css( "background-color", data[ "tipo" ][ "color" ] );
				
				$( ".overlayusuario" ).fadeOut( 5000, function() {
				});
					
			}
			declararEvento( "cerrar" );
		}   
	});
}

/**
* Crea el evento cerrar.
*
* Esta funcion, dependiendo del caso que se active nos permite declarar el evento a ejecutar sobre un objeto en concreto.
*
* Creada por Jesús López
* No tiene variables de entrada.
* No tiene variables de retorno, el retorno es la propia accion del evento invocado.
*/	

function cerrar() {
	var datos = "accion=cerrar";
	
	$.ajax ( {
		type: "POST",
		url: "ajax/controladorAJAX.php",
		data: datos,
		error: function() {
			alert ("Se ha producido un error.");
		},
		success: function ( data, textStatus ) {
			
			$( ".sesion" ).remove ();
			
			$( "header" ).append ( data );
			
			$( ".login" ).removeClass ( "oculto" );
		}   
	});
}

/**
* Crea el evento clicBandera.
*
* Esta funcion, dependiendo del caso que se active nos permite declarar el evento a ejecutar sobre un objeto en concreto.
*
* Creada por Jesús López
* No tiene variables de entrada.
* No tiene variables de retorno, el retorno es la propia accion del evento invocado.
*/	

function clicBandera() {
	var datos = "accion=getCiudades&idPais=" + $( this ).attr( "data" );
	alert( datos );
	$.ajax ( {
		type: "POST",
		url: "ajax/controladorAJAX.php",
		data: datos,
		error: function() {
			alert ("Se ha producido un error.");
		},
		success: function ( data, textStatus ) {
			$( ".overlay" ).remove();
			
			$( "body" ).append ( data );
			
			$( ".overlay" ).removeClass( "oculto" );
		}   
	});
}

/**
* Crea el evento buscar.
*
* Esta funcion, dependiendo del caso que se active nos permite declarar el evento a ejecutar sobre un objeto en concreto.
*
* Creada por Jesús López
* quebuscar es la variable de entrada.
* No tiene variables de retorno, el retorno es la propia accion del evento invocado.
*/	

function buscar ( quebuscar ) {
	var datos = "accion=getBusqueda&palabras=" + quebuscar;
	
	$.ajax ( {
		type: "POST",
		url: "ajax/controladorAJAX.php",
		data: datos,
		error: function() {
			alert ("Se ha producido un error.");
		},
		success: function ( data, textStatus ) {
			$( "body" ).append ( data );
			
			$( ".overlay" ).removeClass( "oculto" );
		}   
	});
}

/**
* Crea el evento clicIr.
*
* Esta funcion, dependiendo del caso que se active nos permite declarar el evento a ejecutar sobre un objeto en concreto.
*
* Creada por Jesús López
* No tiene variables de entrada.
* No tiene variables de retorno, el retorno es la propia accion del evento invocado.
*/	

function clicIr() {
	alert ( 'Has presionado en ir y toca buscar: ' + $( "div.campobusqueda input[type='text']" ).val() );
	
	buscar( $( "div.campobusqueda input[type='text']" ).val() );
}

/**
* Crea el evento clicIr keyPressBusqueda.
*
* Esta funcion, dependiendo del caso que se active nos permite declarar el evento a ejecutar sobre un objeto en concreto.
*
* Creada por Jesús López
* No tiene variables de entrada.
* No tiene variables de retorno, el retorno es la propia accion del evento invocado.
*/	

function keyPressBusqueda() {

	if( event.keyCode == 13 ) {
		console.log ( "tecla 13" );
		
		buscar( $(this).val() );
    } 
}

/**
* Crea el evento clicClima.
*
* Esta funcion, dependiendo del caso que se active nos permite declarar el evento a ejecutar sobre un objeto en concreto.
*
* Creada por Jesús López
* No tiene variables de entrada.
* No tiene variables de retorno, el retorno es la propia accion del evento invocado.
*/	

function clicClima() {
	
	var datos = "accion=consultaCiudades&idClima=" + $( this ).attr( "data" );
	
	$.ajax ( {
		type: "POST",
		url: "ajax/controladorAJAX.php",
		data: datos,
		error: function() {
			alert ("Se ha producido un error.");
		},
		success: function ( data, textStatus ) {

			$( ".consultaciudades" ).remove();

			$( "div#tabs-4" ).append ( data );
		}   
	});
}

/**
* Crea el evento clicContinente.
*
* Esta funcion, dependiendo del caso que se active nos permite declarar el evento a ejecutar sobre un objeto en concreto.
*
* Creada por Jesús López
* No tiene variables de entrada.
* No tiene variables de retorno, el retorno es la propia accion del evento invocado.
*/	

function clicContinente() {
	
	var datos = "accion=consultaPaises&idContinente=" + $( this ).attr( "data" );
	
	$.ajax ( {
		type: "POST",
		url: "ajax/controladorAJAX.php",
		data: datos,
		error: function() {
			alert ("Se ha producido un error.");
		},
		success: function ( data, textStatus ) {

			$( ".consultapaises" ).remove();
			$( ".consultaciudades" ).remove();

			$( "div#tabs-5" ).append ( data );
			
			declararEvento( "clicPaises" );
		}   
	});
}

/**
* Crea el evento clicPaises.
*
* Esta funcion, dependiendo del caso que se active nos permite declarar el evento a ejecutar sobre un objeto en concreto.
*
* Creada por Jesús López
* No tiene variables de entrada.
* No tiene variables de retorno, el retorno es la propia accion del evento invocado.
*/	

function clicPaises() {
	var datos = "accion=consultaCiudades2&idPais=" + $( this ).attr( "data" );
	
	$.ajax ( {
		type: "POST",
		url: "ajax/controladorAJAX.php",
		data: datos,
		error: function() {
			alert ("Se ha producido un error.");
		},
		success: function ( data, textStatus ) {
			$( ".consultaciudades" ).remove();
			$( "div#tabs-5" ).append ( data );
			
		}   
	});
}

/**
* Crea el evento getPropData.
*
* Esta funcion, dependiendo del caso que se active nos permite declarar el evento a ejecutar sobre un objeto en concreto.
*
* Creada por Jesús López
* @ nodoOrigen es la variable de entrada
* No tiene variables de retorno, el retorno es la propia accion del evento invocado.
*/	

function getPropData( nodoOrigen ) {	
	var numItems = $( nodoOrigen ).attr( "data-numitems" );
	var datos = "accion=setPaginacion&ipag=" + $( nodoOrigen ).attr( "data-ipag" ) + "&numitems=" + numItems;
	
	return datos;
}

/**
* Crea el evento clicAntSig.
*
* Esta funcion, dependiendo del caso que se active nos permite declarar el evento a ejecutar sobre un objeto en concreto.
*
* Creada por Jesús López
* nodo es la variable de entrada
* No tiene variables de retorno, el retorno es la propia accion del evento invocado.
*/	

function clicAntSig( nodo ) {
	var datos;
	
	if ( typeof nodo === "object" ) { 
		datos = getPropData( $(this) );
	} else {
		datos = getPropData( nodo );
	}
		
	$.ajax ( {
		type: "POST",
		url: "ajax/controladorAJAX.php",
		data: datos,
		error: function() {
			alert ("Se ha producido un error.");
		},
		success: function ( data, textStatus ) {
			$( "div#tabs-4" ).empty();
			$( "div#tabs-4" ).append ( data );
			
			declararEvento( "clicAntSig" );
			declararEvento( "clicClima" );
		}   
	});
}

/**
* Crea el evento clicAlta.
*
* Esta funcion nos permite dar de alta de manera asincrona a un nuevo usuario controlando ademas el error que se produce cuando no todos los campos estan rellenados.
*
* Creada por Jesús López
* No tiene variables de entrada
* No tiene variables de retorno, el retorno es la propia accion del evento invocado.
*/	

function clicAlta() {
	var nomUsu, apeUsu, email, password, descUsu;
	
	var validacionnomUsu = document.getElementsByName( "nomUsu" );
	nomUsu = $( "form input[name='nomUsu']" ).val();
	var validacionapeUsu = document.getElementsByName( "apeUsu" );
	apeUsu = $( "form input[name='apeUsu']" ).val();
	var validacionemail = document.getElementsByName( "email" );
	email = $( "form input[name='email']" ).val();
	var validacionpassword = document.getElementsByName( "password" );
	password = $( "form input[type='password']" ).val();
	var validaciondescUsu = document.getElementsByName( "descUsu" );
	descUsu = $( "textarea[name='descUsu']" ).val();
	
	var bvalidacion = true;
	
	validacionnomUsu[ 0 ].style.border = "";
	validacionapeUsu[ 0 ].style.border = "";
	validacionemail[ 0 ].style.border = "";
	validacionpassword[ 0 ].style.border = "";
	validaciondescUsu[ 0 ].style.border = "";
	
	
	if ( nomUsu == "" ) {
					validacionnomUsu[ 0 ].style.border = "1px solid red";
					bvalidacion = false;
				}
				if ( apeUsu == "" ) {
					validacionapeUsu[ 0 ].style.border = "1px solid red";
					bvalidacion = false;
				}
				if ( email == "" ) {
					validacionemail[ 0 ].style.border = "1px solid red";
					bvalidacion = false;
				}
				if ( password == "" ) {
					validacionpassword[ 0 ].style.border = "1px solid red";
					bvalidacion = false;
				}
				if ( descUsu == "" ) {
					validaciondescUsu[ 0 ].style.border = "1px solid red";
					bvalidacion = false;
				}
				if( bvalidacion ) {
								
					var datos = "accion=clicAlta&nomUsu=" + nomUsu + "&apeUsu=" + apeUsu + "&email=" + email + "&password=" + password + "&descUsu=" + descUsu;
					
					$.ajax ( {
						type: "POST",
						url: "ajax/controladorAJAX.php",
						data: datos,
						error: function() {
							alert ("Se ha producido un error.");
						},
						success: function ( dataAjax, textStatus ) {

							alert( datos );
						}   
					});
				}	else {
					alert("Completa todos los campos.");
				}
}


