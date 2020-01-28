 <?php
	require ("lib/mod004_presentacion.php");
	
	if ( isset( $_POST[ "iddivisa" ] ) && isset( $_POST[ "coddivisa" ] ) ) {
		$idDivisa = $_POST[ "iddivisa" ];

		$codDivisa = $_POST[ "coddivisa" ];
		
		$mensaje = mod004_actDivisa( $idDivisa, $codDivisa );
	}else {
		$mensaje = "Hola";
	}
	
	require ("vista/vista_actdivisas.php");
?>
