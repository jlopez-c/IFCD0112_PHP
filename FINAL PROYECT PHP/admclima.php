 <?php
	require ("lib/mod004_presentacion.php");
	
	if ( isset ( $_POST[ "clima" ] ) && 
	     isset ( $_POST[ "tipo" ] ) &&
		 isset ( $_POST[ "desc" ] ) &&
		 isset ( $_POST[ "img" ] ) &&
		 isset ( $_POST[ "continentes" ] ) ) {
		
		$clima = $_POST[ "clima" ];
		$tipo = $_POST[ "tipo" ];
		$desc = $_POST[ "desc" ];
		$img = $_POST[ "img" ];
		$continentes = $_POST[ "continentes" ];
		
		$idClima = mod004_insClima( $clima, $tipo, $desc, $img, $continentes );
	}
	
	require ("vista/vista_admclima.php");
?>
