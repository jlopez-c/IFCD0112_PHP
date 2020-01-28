 <?php
	session_start();
?>
<?php
	require ("lib/mod004_presentacion.php");
	
	if ( isset( $_GET[ "idPais" ] ) ) {
		$idPais = $_GET[ "idPais" ];	
	}

	$strNomCity = mod004_getCity( $idPais );

	if ( isset ( $_SESSION[ "idusuario" ] ) ) {		
		$capaLoginSaludo = mod004_setSaludo();
	} else {
		$capaLoginSaludo = mod004_setCamposLogin();
	}

	require ("vista/vista_ciudades.php");
?>
