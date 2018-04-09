<div class="contenedor-body">
	<aside class="panel-izquierdo" id="p_izq">

		<?php
		if ($Hyzher && $Menu_HZ) {
			if(isset($_COOKIE['menuHyzher']) && $_COOKIE['menuHyzher'] === 'ocultar'){
				$OcultarMH = 'MH-ocultar';
			}else{
				$OcultarMH = '';
			}
			?>
			<nav class="menu-hyzher <?php echo $OcultarMH;?>" id="nav_MH">
				<div class="encabezado">
					<span onclick="accionMenuHyzher();">
						<i class="fa fa-archive" aria-hidden="true"></i>
					</span>
					<span>
						<a href="<?php echo REALIDAD;?>">
							Cerrar Sesión
						</a>
					</span>
				</div>
				<ul>
					<li>
						<a href="<?php echo AUTORES.'/'.str_replace(' ', '-', $Hyzher_usuario);?>">
							<i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php echo $Hyzher_usuario;?>
						</a>
					</li>
				</ul>

				<div class="tabs" id="tabs_menu_lateral">
					<button>Hyzhers</button>
					<button>1 Mensaje</button>
				</div>

				<div class="contenidos" id="contenidos_tabs_menu_lateral">
					<div class="contenido-hijo">
						<ul>
							<li class="titulo">
								Ideas y Frases
							</li>
							<li>
								<a href="<?php echo FRAGMENTOS;?>">
									<i class="fa fa-object-group" aria-hidden="true"></i>Fragmentos
								</a>
							</li>
							<li>
								<a href="<?php echo LEYENDAS;?>">
									<i class="fa fa-pencil" aria-hidden="true"></i>Leyendas
								</a>
							</li>

							<li class="titulo">
								Multimedia
							</li>
							<li>
								<a href="<?php echo IMAGENES;?>">
									<i class="fa fa-picture-o" aria-hidden="true"></i>Imagenes
								</a>
							</li>
							<li>
								<a href="<?php echo ARCHIVOS;?>">
									<i class="fa fa-floppy-o" aria-hidden="true"></i>Archivos
								</a>
							</li>

							<li class="titulo">
								Blogs
							</li>
							<li>
								<a href="<?php echo BLOGS;?>">
									<i class="fa fa-book" aria-hidden="true"></i>Entradas
								</a>
							</li>
							<li>
								<a href="<?php echo TAREAS;?>">
									<i class="fa fa-calendar-check-o" aria-hidden="true"></i>Tareas
								</a>
							</li>
							<li>
								<a href="<?php echo OPINIONES;?>">
									<i class="fa fa-comments" aria-hidden="true"></i>Opiniones
								</a>
							</li>

							<li class="titulo">
								Individuos
							</li>
							<li>
								<a href="<?php echo PERSONAJES;?>">
									<i class="fa fa-id-card-o" aria-hidden="true"></i>Personajes
								</a>
							</li>
							<li>
								<a href="<?php echo PERFILES;?>">
									<i class="fa fa-user-secret" aria-hidden="true"></i>Perfiles
								</a>
							</li>
							
							<?php
								if(isset($HLyzher) && $HLyzher === true){
									?>
									<li class="titulo">
										Administradores
									</li>
									<li>
										<a href="<?php echo CATEGORIAS;?>">
											<i class="fa fa-coffee" aria-hidden="true"></i>Categorias
										</a>
									</li>
									<li>
										<a href="<?php echo CLASIFICACIONES;?>">
											<i class="fa fa-lock" aria-hidden="true"></i>Clasificaciones
										</a>
									</li>
									<li>
										<a href="<?php echo SPAMS;?>">
											<i class="fa fa-binoculars" aria-hidden="true"></i>Spams
										</a>
									</li>
									<li>
										<a href="<?php echo GRADOS;?>">
											<i class="fa fa-universal-access" aria-hidden="true"></i>Grados
										</a>
									</li>
									<li>
										<a href="<?php echo ETIQUETAS;?>">
											<i class="fa fa-flag-checkered" aria-hidden="true"></i>Etiquetas
										</a>
									</li>
									<li>
										<a href="<?php echo DETALLES;?>">
											<i class="fa fa-crosshairs" aria-hidden="true"></i>Detalles
										</a>
									</li>
									<li>
										<a href="<?php echo NUCLEOS;?>">
											<i class="fa fa-users" aria-hidden="true"></i>Nucleos
										</a>
									</li>
									<li>
										<a href="<?php echo INGRESOS;?>">
											<i class="fa fa-key" aria-hidden="true"></i>Ingresos
										</a>
									</li>
									<?php
								}
							?>
						</ul>
					</div>
					<div class="contenido-hijo">
						<p>Hola Hyzher, mi nombre es Joaquín Reyes Sánchez creador y dueño de este sitio web, tú puedes llamarme Hakin Seyer. A nombre de todos los espiritus y fragmentos de Hlymboo te doy la más alegre y amistosa bienvenida, espero que disfrutes tu estadia mientras estes aquí, el lienzo de las letras es lo que le da vida a Hlymboo, por lo que estoy ancioso de leer tus fragmentos... ¡Ahhh!... Por cierto, si llegas a tener algún problema no dudes en comunicarte conmigo, desde ahora somos familia.</p>
						<p>Comunícate aqui:</p>
					</div>
				</div>
			</nav>
			<?php
		}
		?>

	</aside>
	
	<script>
		function accionMenuHyzher(){
			if(Galletas.readCookie('menuHyzher') === 'mostrar'){
				MH_accion.main(true);
				Galletas.createCookie("menuHyzher", "ocultar", "");
			}else if(Galletas.readCookie('menuHyzher') === 'ocultar'){
				MH_accion.main(false);
				Galletas.createCookie("menuHyzher", "mostrar", "");
			}else{
				MH_accion.main(true);
				Galletas.createCookie("menuHyzher", "ocultar", "");
			}	
		}
	</script>