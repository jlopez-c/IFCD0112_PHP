 <?php
	require ("lib/mod004_presentacion.php");
	
	if ( isset( $_GET[ "idCategoria" ] ) ) {
		if ( isset( $_GET[ "ipag" ] ) ) {
			$ipag = $_GET[ "ipag" ];
		} else {
			$ipag = 1;
		}
		
		$idCategoria = $_GET[ "idCategoria" ];
		
		$destinos = mod004_getDataDestinosCategoria( $idCategoria, $ipag );
		
		$divSiguiente = mod004_getCountDestinosCategoria ( $idCategoria, $ipag );
	}
	
	require ("vista/vista_categorias.php");
?>
