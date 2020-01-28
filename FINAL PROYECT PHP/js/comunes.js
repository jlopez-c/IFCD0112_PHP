/**
* Declara los eventos
*
* Esta funcion, dependiendo del caso que se active nos permite declarar el evento a ejecutar sobre un objeto en concreto.
*
* Creada por Jesús López
* evento es la variable de entrada, que en cada case es la funcion creada en eventos.js .
* No tiene variables de retorno, el retorno es la propia accion del evento invocado.
*/	
function declararEvento( evento ) {
	switch ( evento ) {
		case "clicBandera":
			$( ".bandera" ).on( "click", clicBandera );
		break;	
		
		case "clicIr":
			$( ".ir" ).on( "click", clicIr );
		break;
		
		case "keyPressBusqueda":
			$( "div.campobusqueda input[type='text']" ).on( "keyup", keyPressBusqueda );
		break;
		
		case "entrar":
			$( "div.camposlogin:eq(2)" ).on( "click", entrar );
		break;
		
		case "cerrar":
			$( ".logout" ).on( "click", cerrar );
		break;
		
		case "clicClima":
			$( ".clima" ).on( "click", clicClima );
		break;
		
		case "clicContinente":
			$( ".continente" ).on( "click", clicContinente );
		break;
		
		case "clicPaises":
			$( ".consultapais" ).on( "click", clicPaises );
		break;
		
		case "clicAntSig":
			$( ".paginacion2 div" ).on( "click", clicAntSig );
		break;
		
		case "clicAlta":
			$( "div.altaAsincrona" ).on( "click", clicAlta );
		break;
	}
}