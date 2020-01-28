 <!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>A tomar por Mundo - INICIO</title>
		
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
				
				$( "#tabs" ).tabs();
				
				declararEvento("clicBandera");
				
				// Para la búsqueda.
				declararEvento( "clicIr" );
				declararEvento( "keyPressBusqueda" );
				
				// Para el login y logout.
				declararEvento( "entrar" );
				declararEvento( "cerrar" );
				
				// Para las consultas de lvl.
				declararEvento( "clicClima" );
				declararEvento( "clicContinente" );
				
				// Para lapaginacion asincrona.
				declararEvento( "clicAntSig" );
				
				//Para el alta asíncrono.
				declararEvento( "clicAlta");
				
			} );
			
			/**
			* Valida los datos aportados por el usuario en el formulario.
			*
			* Con esta funcion validamos los datos aportados por el usuario en el formulario para poder enviarlos a traves de todo el script. Las variables @nomUsu, @apeUsu, @email, @password, @descUsu, son las variables de insercion que otorgará el usuario en el formulario de registro para poder darse de alta en la pagina web y quedar registrado en la base de datos.
			*
			* Creada por Jesús López
			* No tiene variables de entrada.
			* @bvalidacion nos indica que todos los datos aportados por el usuario han sido otorgados correctamente.
			*/	
			
			function validacionUsu() {
				var bvalidacion = true;
				
				var nomUsu, apeUsu, email, password, descUsu;
				
				nomUsu = document.altausuario.nomUsu.value;
				apeUsu = document.altausuario.apeUsu.value;
				email = document.altausuario.email.value;
				password = document.altausuario.password.value;
				descUsu = document.altausuario.descUsu.value;
				
				if ( nomUsu == "" ) {
					bvalidacion = false;
				}
				if ( apeUsu == "" ) {
					bvalidacion = false;
				}
				if ( email == "" ) {
					bvalidacion = false;
				}
				if ( password == "" ) {
					bvalidacion = false;
				}
				if ( descUsu == "" ) {
					bvalidacion = false;
				}
				
				return bvalidacion;
			}
			
			/**
			* Valida los datos aportados por el usuario en el formulario.
			*
			* Con esta funcion validamos los datos aportados por el usuario en el formulario para poder enviarlos a traves de todo el script. Las variables @clima, @tipo, @desc, @img, son las variables de insercion que otorgará el usuario en el formulario de insercion para poder dar de alta un nuevo clima en la pagina web y registrarlo en la base de datos.
			*
			* Creada por Jesús López
			* No tiene variables de entrada.
			* @bvalidacion nos indica que todos los datos aportados por el usuario han sido otorgados correctamente.
			*/	
			
			function validacionClima() {
				var bvalidacion = true;
				
				var clima, tipo, img, desc;
				
				clima = document.altaClima.clima.value;
				tipo = document.altaClima.tipo.value;
				desc = document.altaClima.desc.value;
				img = document.altaClima.img.value;

				if ( clima == "" ) {
					bvalidacion = false;
				}                       
				if ( tipo == "" ) {     
					bvalidacion = false;
				}                       
				if ( desc == "" ) {     
					bvalidacion = false;
				}                       
				if ( img == "" ) {      
					bvalidacion = false;
				}                       

				return bvalidacion;
			}
			
			/**
			* Declara un evento sobre un nodo.
			*
			* Con esta funcion declaramos el evento de actualizacion de divisas sobre el enlace de actualizar de nuestra tabla de divisas.
			*
			* Creada por Jesús López
			* No tiene variables de entrada.
			* No tiene variables de retorno.
			*/	
			
			window.onload = function() {
				var nodosActualizar;

				nodosActualizar = document.getElementsByClassName( "actualizar" );
				for ( i = 0; i < nodosActualizar.length; i++ ) {
					nodosActualizar[ i ].onclick = actDivisa;
				}
			}
			
			/**
			* Recoge la informacion de nuestros nodos.
			*
			* Recoge la informacion necesaria de nuestros nodos objetivo ya que son aquellos que queremos actualizar.
			*
			* Creada por Jesús López
			* La variable de entrada e nos sirve para indicar que queremos iniciar la funcion preventDefault() que evita que se escriba la # al ser un enlace <a>. Ademas de declarar la funcion createForm que sera nuestro formulario de actualizacion.
			* No tiene variables de retorno.
			*/	
			
			function actDivisa( e ) {
				var nodosAct, nodoTr;
				var idDivisa, codDivisa;
				
				e.preventDefault(); // 
				
				nodoTr = this.parentNode.parentNode;
				idDivisa = nodoTr.getAttribute( "data" );
				
				// Para el nombre del equipo.
				nodoTd = this.parentNode.previousSibling;
				codDivisa = nodoTd.innerHTML;
				
				alert ( idDivisa + "\n" +
						codDivisa );
						
				createForm ( idDivisa, codDivisa );
			}
			
			/**
			* Crea el formulario de actualizacion.
			*
			* Crea el formulario de actualizacion, y lo añade en la parte inferior de a la pestaña en la que se encuentra la tabla divisas.
			*
			* Creada por Jesús López
			* Las variables de entrada idDivisa y codDivisa son las variables objetivo de nuestro formulario.
			* No tiene variables de retorno.
			*/	
			
			function createForm ( idDivisa, codDivisa ) {
				var formAct;
				var nodosBody;
				var nodosOver, nodosCapaInterna;
				
				formAct = "<div class='overactdivisa'>";
				formAct+= 	"<div class='capainternaact'>";
				formAct+= 		"<form name='actdivisa' method='POST' onsubmit='return validacion();' action='actdivisa.php'>";
				formAct+= 			"<div>";
				formAct+= 				"<input name='iddivisa' type='text' value=" + idDivisa + " readonly />"; 
				formAct+= 			"</div>";
				formAct+= 			"<div>";
				formAct+= 				"<input name='coddivisa' type='text' maxlength='20' value='" + codDivisa + "' />";
				formAct+= 			"</div>";
				formAct+= 			"<div>";
				formAct+= 				"<input type='submit' value='Actualizar' />";
				formAct+= 			"</div>";
				formAct+= 		"</form>";				
				formAct+= 	"</div>";
				formAct+= "</div>";
				
				$( "div#tabs-9" ).append( formAct );
				
				nodosOver = document.getElementsByClassName( "overactdivisa" );
				nodosCapaInterna = document.getElementsByClassName( "capainternaact" );
				nodosOver[ 0 ].onclick = salirOverlayActualizacion;
				nodosCapaInterna[ 0 ].onclick = salirOverlayActualizacion;
			}
			
		</script>
	</head>
	<body>
		<div class="contenedor">
			<div class="subcontenedor">
				<header>
					<div class="logo">
						<img src="banderas/logo1.png" class="anchura100" />
					</div>
					
					¡¡¡HOLA BIENVENIDO!!!

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
				<main>
					<div id="tabs">
						<ul>
							<li><a href="#tabs-1">Paises</a></li>
							<li><a href="#tabs-2">Categorias</a></li>
							<li><a href="#tabs-3">Foros</a></li>
							<li><a href="#tabs-4">Climas</a></li>
							<li><a href="#tabs-5">Continentes</a></li>
							<li><a href="#tabs-6">Registro</a></li>
							<li><a href="#tabs-7">Adm.Climas</a></li>
							<li><a href="#tabs-8">Act.Perfil</a></li>
							<li><a href="#tabs-9">Tabla divisas</a></li>
						</ul>
						<div id="tabs-1">
							<?php
								echo $divPaises;
								
								echo $listado;
							?>
						</div>
						<div id="tabs-2">
							<?php
								echo $divCategorias;
							?>
						</div>
						<div id="tabs-3">
							<?php
								echo $divForos;
							?>
						</div>
						<div id="tabs-4">
							<?php
								echo $divClimas;
							?>
						</div>
						<div id="tabs-5">
							<?php
								echo $divContinentes;
							?>
						</div>
						<div id="tabs-6">
							<form name="altausuario" method="POST" onsubmit="return validacionUsu();" action="registro.php">
								<div>
									<label>Nombre</label>
								</div>
								<div class="nombreUsu">
									<div>
										<input name="nomUsu" type="text" maxlength="50" placeholder="Aqui tu nombre" />
									</div>
								</div>
								<div>
									<label>Apellidos</label>
								</div>
								<div class="apeUsu">
									<div>
										<input name="apeUsu" type="text" maxlength="50" placeholder="Aqui tus apellidos" />
									</div>
								</div>
								<div>
									<label>Direccion correo electronico</label>
								</div>
								<div class="email">
									<div>
										<input name="email" type="text" maxlength="100" placeholder="Aqui tu e-mail" />
									</div>
								</div>
								<div>
									<label>Contraseña</label>
								</div>
								<div class="password">
									<div>
										<input name="password" type="password" maxlength="25" />
									</div>
								</div>
								<div>
									<label>Descripcion</label>
								</div>
								<div>
									<textarea name="descUsu" placeholder="cuentanos un poco sobre ti"></textarea>
								</div>
								<div>
									<input type="submit" value="Grabar" />
								</div>
								</br>
								<div class="altaAsincrona">
									ALTA ASÍNCRONA
								</div>
							</form>
						</div>
						<div id="tabs-7">
							<form name="altaClima" method="POST" onsubmit="return validacionClima();" action="admclima.php">
								<div>
									<input name="clima" type="text" maxlength="25" placeholder="Nombre Clima" />
								</div>
								<div>
									<label>Tipo Clima</label>
									<input name="tipo" type="text" maxlength="25" placeholder="Tipo" />
								</div>
								<div>
									<label>Descripcion</label>
								</div>
								<div>
									<textarea name="desc" placeholder="cuentanos un poco sobre él"></textarea>
								</div>
							
								<div>
									<label>IMAGEN</label>
									<input name="img" type="text" maxlength="250" placeholder="URL" />
								</div>
								<?php 
									echo $listContinentes;
								?>
								<div>
									<input type="submit" value="Añadir" />
								</div>
							</form>
						</div>
						<div id="tabs-8">
							<?php
								echo $formAct;
								
							?>
						</div>
						<div id="tabs-9">
							<?php
								echo $tableDivisas;
							?>
						</div>
					</div>
				</main>
			</div>
		</div>
	</body>
</html>