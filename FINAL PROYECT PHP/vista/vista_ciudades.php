 <!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Listado Ciudades</title>
		<style>

			
		</style>
		
		<script src="js/comunes.js"></script>
		<script src="js/eventos.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		
		<script>
		
			/**
			* Invoca a Ajax atraves de jquery para poder declarar los eventos.
			*
			* Con $( function() ) invocamos a Ajax atraves de jquery para poder declarar las funciones de eventos asincronos que hemos creado y que son necesarios para el correcto funcionamiento de nuestra web y de todas las funciones creadas en los modelos de presentacion, logica y acceso a datos.
			*
			* Creada por Jesús López
			* No tiene variables de entrada.
			* No tiene variables de retorno, el retorno es la propia accion del evento activado.
			*/	
		
			$( function() {
				// Para la búsqueda.
				declararEvento( "clicIr" );
				declararEvento( "keyPressBusqueda" );
				
				// Para el login y logout.
				declararEvento( "entrar" );
				declararEvento( "cerrar" );
			} );
		</script>
	</head>
	<body>
		<div class="contenedor">
			<div class="subcontenedor">
				<header>
					<div class="logo">
						<img src="banderas/logo1.png" class="anchura100" />
					</div>
					
					HOLA BIENVENIDO!!!

					<div class="busqueda">
						<div class="campobusqueda">
							<input type="text" placeholder="Aquí tu búsqueda" />
						</div>
						<div class="ir">
							Ir
						</div>
					</div>
					<div>
						<?php
							echo $capaLoginSaludo;
						?>
					</div>
				</header>
					<?php
						echo $strNomCity;
					?>
			</div>
		</div>
	</body>

</html>