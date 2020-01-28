 <?php
	require ("lib/mod004_presentacion.php");
	
	if ( isset( $_GET[ "idForo" ] ) ) {
		$idForo = $_GET[ "idForo" ];

		$strForo = mod004_mainForo( $idForo );
	}

	require ("vista/vista_foros.php");
?>
