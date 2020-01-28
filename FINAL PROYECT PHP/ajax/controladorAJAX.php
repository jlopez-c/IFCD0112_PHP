<?php
	session_start();
?>
<?php
	require( "../lib/mod004_presentacion.php" );
	
	$accion = $_POST[ "accion" ];
	
	switch ( $accion ) {
		case "getCiudades":
			if ( isset ( $_POST[ "idPais" ] ) ) {
				$idPais = $_POST[ "idPais" ];
				$datos = mod004_getCiudades( $idPais );
			} else {

			}
			echo $datos;
		break;
			
		case "getBusqueda":
			if ( isset ( $_POST[ "palabras" ] ) ) {
				$palabras = $_POST[ "palabras" ];
				$datos = mod004_getBusqueda( $palabras );
			} else {
				
			}
			echo $datos;
		break;
		
		case "entrar":
			if ( isset ( $_POST[ "usuario" ] ) && isset ( $_POST[ "contrasena" ] ) ) {
				
				$usuario = $_POST[ "usuario" ];
				$contrasena = $_POST[ "contrasena" ];
				
				$arDatos = mod004_setLogin( $usuario, $contrasena );
			} else {

			}
			echo json_encode( $arDatos );
		break;
		
		case "cerrar":
		
			$datos = mod004_setLogout();
			
			echo $datos;
		break;
		
		case "consultaCiudades":
			if ( isset ( $_POST[ "idClima" ] ) ) {
				$idClima = $_POST[ "idClima" ];
				$datos =  mod004_consultaCiudades( $idClima );
			} else {
				
			}
			
			echo $datos;
		break;
		
		case "consultaPaises":
			if ( isset ( $_POST[ "idContinente" ] ) ) {
				$idContinente = $_POST[ "idContinente" ];
				$datos =  mod004_consultaPaises( $idContinente );
			} else {
				
			}
			
			echo $datos;
		break;
		
		case "consultaCiudades2":
			if ( isset ( $_POST[ "idPais" ] ) ) {
				$idPais = $_POST[ "idPais" ];
				$datos = mod004_consultaCiudades2( $idPais );
			} else {

			}
			echo $datos;
		break;
		
		case "setPaginacion":
			if ( isset ( $_POST[ "ipag" ] ) && isset ( $_POST[ "numitems" ] ) ) {
				$ipag = $_POST[ "ipag" ];
				$numItems = $_POST[ "numitems" ];
				$datos = mod004_getClimas( $ipag, $numItems );
			} else {
				
			}
			echo $datos;
		break;
		
		case "clicAlta":
			if ( isset ( $_POST[ "nomUsu" ] ) && 
				 isset ( $_POST[ "apeUsu" ] ) &&
				 isset ( $_POST[ "email" ] ) &&
				 isset ( $_POST[ "password" ] ) &&
				 isset ( $_POST[ "descUsu" ] ) ) {
		
				 $nomUsu = $_POST[ "nomUsu" ];
				 $apeUsu = $_POST[ "apeUsu" ];
				 $email = $_POST[ "email" ];
				 $password = $_POST[ "password" ];
				 $descUsu = $_POST[ "descUsu" ];
				 
				 $idUsu = mod004_registroUsu( $nomUsu, $apeUsu, $email, $password, $descUsu );
				 
			} else {

			}
			echo $datos;
		break;
		

		default:
			echo "Acción no permitida";
		break;
	}
?>