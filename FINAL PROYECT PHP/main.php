 <?php
	session_start();
?>
 <?php
	require ("lib/mod004_presentacion.php");
	
	if ( isset( $_GET[ "ipag" ] ) ) {
		$ipag = $_GET[ "ipag" ];
	} else {
		$ipag = 1;
	}
	
	if ( isset( $_GET[ "numItems" ] ) ) {
		$numItems = $_GET[ "numItems" ];
	} else {
		$numItems = 1;
	}

	$divForos =  mod004_getForos();

	$divCategorias = mod004_getCategorias();
	
	$divPaises = mod004_getPaises( $ipag );
	
	$listado = mod004_getCountPaises( $ipag );
	
	$divClimas = mod004_getClimas( $ipag, $numItems );
	
	$divContinentes = mod004_getContinentes();
	
	$listContinentes = mod004_getDataContinentes();
	
	$tableDivisas = mod004_getDivisas();
	
	if ( isset ( $_SESSION[ "idusuario" ] ) ) {

		$capaLoginSaludo = mod004_setSaludo();
		$formAct = mod004_actUsu();
	} else {
		$formAct = mod004_sesionrequerida();
		$capaLoginSaludo = mod004_setCamposLogin();
	}

	require ("vista/vista_main.php");
?>
