 <?php
	require ("lib/mod004_presentacion.php");
	
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
	}
	
	require ("vista/vista_registro.php");
?>
