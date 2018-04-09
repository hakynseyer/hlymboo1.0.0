var link = 'http://localhost/portal/hacer/php/realiza/ajax_hyzher.inc.php';

function ajax_global(ajax_H, accion){
	$.ajax({
		type: 'POST',
		url: link,
		dataType: 'JSON',
		cache: false,
		data: ajax_H,
		success: function(salida){
			if (salida['validado']) {
				switch (accion){
					// FRAGMENTOS
					case 'CAM_FRAG':
						$('#ajax_titulo').text(salida['titulo']);
						$('#ajax_creacion').text(salida['creado']);
						$('#ajax_modificacion').text(salida['modificado']);
						$('#ajax_intentos').text(salida['intentos']);
						if (salida['estado'] == 0) {
							$('#ajax_oculto').prop("checked",true);
						}else{
							$('#ajax_visible').prop("checked",true);
						}
						$('#ajax_frontal').val(salida['frontal']);
						$('#ajax_posterior').val(salida['posterior']);
						$('#ajax_cam_id').val(salida['id']);									
						break;
					case 'CAM_FRAG_ERRORES':
						$('#ajax_titulo').text(salida['titulo']);
						$('#ajax_creacion').text(salida['creado']);
						$('#ajax_modificacion').text(salida['modificado']);
						$('#ajax_intentos').text(salida['intentos']);
						break;
					case 'BOR_FRAG':
						$('#ajax_bor_titulo').text(salida['titulo']);
						$('#ajax_bor_creacion').text(salida['creado']);
						$('#ajax_bor_id').val(salida['id']);
						break;

					// ARCHIVOS
					case 'CAM_ARCH':
						$('#ajax_titulo').text(salida['titulo']);
						$('#ajax_intentos').text(salida['intentos']);
						$('#ajax_creacion').text(salida['creado']);
						$('#ajax_modificacion').text(salida['modificado']);
						if (salida['estado'] == 0) {
							$('#ajax_oculto').prop("checked",true);
						}else{
							$('#ajax_visible').prop("checked",true);
						}
						$('#ajax_familia').val(salida['familia']);
							$('#cam_familia_select option[value="'+salida['familia']+'"]').prop('selected', true);
							$('#cam_familia_select').css('background', '#755860');
						$('#ajax_derechos').val(salida['derechos']);
						$('#ajax_notas').val(salida['notas']);
						$('#ajax_cam_id').val(salida['id']);
						break;
					case 'CAM_ARCH_ERRORES':
						$('#ajax_titulo').text(salida['titulo']);
						$('#ajax_intentos').text(salida['intentos']);
						$('#ajax_creacion').text(salida['creado']);
						$('#ajax_modificacion').text(salida['modificado']);
						break;
					case 'BOR_ARCH':
						$('#ajax_bor_titulo').text(salida['titulo']);
						$('#ajax_bor_creacion').text(salida['creado']);
						$('#ajax_bor_id').val(salida['id']);
						break;

					// IMAGENES
					case 'CAM_IMG':
						$('#ajax_titulo').text(salida['titulo']);
						$('#ajax_intentos').text(salida['intentos']);
						$('#ajax_creacion').text(salida['creado']);
						$('#ajax_modificacion').text(salida['modificado']);
						if (salida['estado'] == 0) {
							$('#ajax_oculto').prop("checked",true);
						}else{
							$('#ajax_visible').prop("checked",true);
						}
						$('#ajax_familia').val(salida['familia']);
							$('#cam_familia_select option[value="'+salida['familia']+'"]').prop('selected', true);
							$('#cam_familia_select').css('background', '#755860');
						$('#ajax_fuente').val(salida['fuente']);
						$('#ajax_notas').val(salida['notas']);
						$('#ajax_cam_id').val(salida['id']);
						break;
					case 'CAM_IMG_ERRORES':
						$('#ajax_titulo').text(salida['titulo']);
						$('#ajax_intentos').text(salida['intentos']);
						$('#ajax_creacion').text(salida['creado']);
						$('#ajax_modificacion').text(salida['modificado']);
						break;
					case 'BOR_IMG':
						$('#ajax_bor_titulo').text(salida['titulo']);
						$('#ajax_bor_creacion').text(salida['creado']);
						$('#ajax_bor_id').val(salida['id']);
						break;

					// PERSONAJES
					case 'CAM_PER':
						$('#ajax_nombre').text(salida['nombre']);
						$('#ajax_intentos').text(salida['intentos']);
						$('#ajax_creacion').text(salida['creado']);
						$('#ajax_modificacion').text(salida['modificado']);
						if (salida['estado'] == 0) {
							$('#ajax_oculto').prop("checked",true);
						}else{
							$('#ajax_visible').prop("checked",true);
						}
						$('#ajax_familia').val(salida['familia']);
							$('#cam_familia_select option[value="'+salida['familia']+'"]').prop('selected', true);
							$('#cam_familia_select').css('background', '#755860');
							familiaTipica.teclearC = true;
						$('#ajax_edad').val(salida['edad']);
						$('#ajax_sexo').val(salida['sexo']);
						$('#ajax_relacion').val(salida['relacion']);
                        if(salida['personalidad'] != null){
                            tinymce.get('ajax_personalidad').setContent(salida['personalidad']);
                        }
						// $('#ajax_personalidad').val(salida['personalidad']);
                        if(salida['historia'] != null){
                            tinymce.get('ajax_historia').setContent(salida['historia']);
                        }
						// $('#ajax_historia').val(salida['historia']);
                        if(salida['metas'] != null){
                            tinymce.get('ajax_metas').setContent(salida['metas']);
                        }
						// $('#ajax_metas').val(salida['metas']);
                        if(salida['extras'] != null){
                            tinymce.get('ajax_extras').setContent(salida['extras']);
                        }
						// $('#ajax_extras').val(salida['extras']);
						$('#ajax_imagen').val(salida['imagen']);
							$('#infoImagenCambiar').find('#imagenNombre').text($('#slider2').find('input[value='+salida['imagen']+']').closest('section').find('span#titulo').text());
							$('#infoImagenCambiar').find('#imagenCreado').text($('#slider2').find('input[value='+salida['imagen']+']').closest('section').find('span#fam').text());
							$('#infoImagenCambiar').find('#imagenNotas').text($('#slider2').find('input[value='+salida['imagen']+']').closest('section').find('span#notas').text());
							// galeriaForm2.slider.css('margin-left', ((galeriaForm2.imagen.find('input#id[value='+salida['imagen']+']').closest('section').index())*-100)+'%');
							// galeriaForm2.imagenSiguiente = salida['imagen'];
						$('#ajax_cam_id').val(salida['id']);
						break;
					case 'CAM_PER_ERRORES':
						$('#ajax_nombre').text(salida['nombre']);
						$('#ajax_intentos').text(salida['intentos']);
						$('#ajax_creacion').text(salida['creado']);
						$('#ajax_modificacion').text(salida['modificado']);
						break;
					case 'BOR_PER':
						$('#ajax_bor_nombre').text(salida['nombre']);
						$('#ajax_bor_creacion').text(salida['creado']);
						$('#ajax_bor_id').val(salida['id']);
						break;

					// LEYENDAS
					case 'BOR_LEY':
						$('#ajax_bor_id').val(salida['id']);
						$('#ajax_bor_personaje').text(salida['personaje']);
						$('#ajax_bor_escrito').text(salida['escrito']);
						break;
                    
                    // BLOGS
                    case 'CAM_BLOG_TEXTO':
                    	$('#ajax_con_titulo').text(salida['titulo']);
                        $('#ajax_con_modificacion').text(salida['modificado']);
                        if(salida['texto'] != null){
                        	tinymce.get('con_texto').setContent(salida['texto']);
                        }else{
                            tinymce.get('con_texto').setContent("");
                        }
                        $('#ajax_con_id').val(salida['id']);
                        // $('#con_texto').val(salida['texto']);
                    	break;
                    case 'CAM_BLOG_TEXTO_ERRORES':
                    	$('#ajax_con_titulo').text(salida['titulo']);
                        $('#ajax_con_modificacion').text(salida['modificado']);
                    	break;
                    case 'CAM_BLOG_DETALLES':
                        $('#ajax_titulo').text(salida['titulo']);
                        $('#ajax_creacion').text(salida['creado']);
                        $('#ajax_modificacion').text(salida['modificado']);
                        if (salida['estado'] == 0) {
							$('#ajax_oculto').prop("checked",true);
						}else{
							$('#ajax_visible').prop("checked",true);
						}
                        $('#ajax_familia').val(salida['familia']);
							$('#cam_familia_select option[value="'+salida['familia']+'"]').prop('selected', true);
							$('#cam_familia_select').css('background', '#755860');
							familiaTipica.teclearC = true;
                        $('#cam_categoria_select option[value="'+salida['categoria']+'"]').prop('selected', true);
                            $('#cam_categoria_select').css('background', '#755860');
                        $('#cam_clasificacion_select option[value="'+salida['clasificacion']+'"]').prop('selected', true);
                            $('#cam_clasificacion_select').css('background', '#755860');
                        $('#det_derechos').val(salida['derechos']);
                        $('#ajax_det_id').val(salida['id']);
                        break;
                    case 'CAM_BLOG_DETALLES_ERRORES':
                	  	$('#ajax_titulo').text(salida['titulo']);
                        $('#ajax_creacion').text(salida['creado']);
                        $('#ajax_modificacion').text(salida['modificado']);
                    	break;
                    case 'CAM_BLOG_PFI':
                	 	$('#ajaxPFI_titulo').text(salida['titulo']);
                        $('#ajaxPFI_creacion').text(salida['creado']);
                        $('#ajaxPFI_modificacion').text(salida['modificado']);
                        $('#mod_personaje_select option[value="'+salida['personaje']+'"]').prop('selected', true);
                        if (salida['personaje'] != null) {
                            $('#mod_personaje_select').css('background', '#755860');
                        }
                        $('#mod_fragmento_select option[value="'+salida['fragmento']+'"]').prop('selected', true);
                        if (salida['fragmento'] != null) {
                            $('#mod_fragmento_select').css('background', '#755860');
                        }
                        $('#mod_archivo_select option[value="'+salida['archivo']+'"]').prop('selected', true);
                        if (salida['archivo'] != null) {
                            $('#mod_archivo_select').css('background', '#755860');
                        }
                        if (salida['habilitado'] == 0) {
							$('#ajax_oculto2').prop("checked",true);
						}else{
							$('#ajax_visible2').prop("checked",true);
						}
                        $('#ajax_imagen').val(salida['imagen']);
							$('#infoImagenCambiar').find('#imagenNombre').text($('#slider2').find('input[value='+salida['imagen']+']').closest('section').find('span#titulo').text());
							$('#infoImagenCambiar').find('#imagenCreado').text($('#slider2').find('input[value='+salida['imagen']+']').closest('section').find('span#fam').text());
							$('#infoImagenCambiar').find('#imagenNotas').text($('#slider2').find('input[value='+salida['imagen']+']').closest('section').find('span#notas').text());
						$('#ajax_pfi_id').val(salida['id']);
                    	break;
                    case 'CAM_BLOG_PFI_ERRORES':
                    	$('#ajaxPFI_titulo').text(salida['titulo']);
                        $('#ajaxPFI_creacion').text(salida['creado']);
                        $('#ajaxPFI_modificacion').text(salida['modificado']);
                    	break;
                    case 'BOR_BLOG':
                    	$('#ajax_bor_titulo').text(salida['titulo']);
                        $('#ajax_bor_creacion').text(salida['creado']);
                        $('#ajax_bor_modificacion').text(salida['modificado']);
                        $('#ajax_bor_id').val(salida['id']);
                    	break;

                    //GRADOS
                    case 'BOR_GRAD':
                    	$('#ajax_bor_grado').text(salida['tipo']);
                    	$('#ajax_bor_id').val(salida['id']);
                    	break;

                    //CATEGORIAS
                    case 'BOR_CAT':
                    	$('#ajax_bor_categoria').text(salida['tipo']);
                    	$('#ajax_bor_id').val(salida['id']);
                    	break;

                    //CLASIFICACIONES
                    case 'BOR_CLA':
                    	$('#ajax_bor_clasificacion').text(salida['tipo']);
                    	$('#ajax_bor_id').val(salida['id']);
                    	break;

                    //TAREAS
                    case 'CAM_TAR':
                    	$('#ajax_titulo').text(salida['titulo']);
                    	$('#ajax_familia').text(salida['familia']);
                    	$('#ajax_publicacion').text(salida['publicacion']);
                    	if (salida['estado'] == 0) {
							$('#ajax_oculto').prop("checked",true);
						}else{
							$('#ajax_visible').prop("checked",true);
						}
						$('#ajax_descripcion').val(salida['descripcion']);
						$('#ajax_dia_select option[value="'+salida['dia']+'"]').prop('selected', true);
						$('#ajax_mes_select option[value="'+salida['mes']+'"]').prop('selected', true);
						$('#ajax_anio_select option[value="'+salida['anio']+'"]').prop('selected', true);
                    	$('#ajax_cam_id').val(salida['id']);
                    	break;
                    case 'CAM_TAR_ERRORES':
                    	$('#ajax_titulo').text(salida['titulo']);
                    	$('#ajax_familia').text(salida['familia']);
                    	$('#ajax_publicacion').text(salida['publicacion']);
                    	break;
                    case 'BOR_TAR':
                    	$('#ajax_bor_titulo').text(salida['titulo']);
                    	$('#ajax_bor_familia').text(salida['familia']);
                    	$('#ajax_bor_publicacion').text(salida['publicacion']);
                    	$('#ajax_bor_id').val(salida['id']);
                    	break;

                    //SPAMS
                    case 'BOR_SPAM':
                    	$('#ajax_bor_spam').text(salida['tipo']);
                    	$('#ajax_bor_id').val(salida['id']);
                    	break;

                    //OPINIONES
                    case 'EST_OPI':
                        $('#formOpiniones').click();
                        break
                    case 'BOR_OPI':
                        $('#formOpiniones').click();
                        break;

                    //PERFILES
                    case 'CAM_PERF':
                        $('#ajax_dia_select option[value="'+salida['dia']+'"]').prop('selected', true);
                        $('#ajax_mes_select option[value="'+salida['mes']+'"]').prop('selected', true);
                        $('#ajax_anio_select option[value="'+salida['anio']+'"]').prop('selected', true);
                        $('#ajax_lugar').val(salida['lugar']);
                        $('#ajax_soy').val(salida['soy']);
                        if(salida['soy'] != null){
                            tinymce.get('ajax_soy').setContent(salida['soy']);
                        }
                        $('#ajax_perfil_id').val(salida['id']);
                        break;
                    case 'CAM_IMG_PERF':
                        $('#ajax_imagen').val(salida['imagen']);
                            $('#infoImagenCambiar').find('#imagenNombre').text($('#slider2').find('input[value='+salida['imagen']+']').closest('section').find('span#titulo').text());
                            $('#infoImagenCambiar').find('#imagenCreado').text($('#slider2').find('input[value='+salida['imagen']+']').closest('section').find('span#fam').text());
                            $('#infoImagenCambiar').find('#imagenNotas').text($('#slider2').find('input[value='+salida['imagen']+']').closest('section').find('span#notas').text());
                        $('#ajax_pfi_id').val(salida['id']);
                        break;
                    case 'CAM_SOC_PERF':
                        if(salida['social1'] != null){
                           $('#ajax_social1').val(salida['social1']);   
                        }
                        if(salida['social1'] != null){
                            $('#ajax_social2').val(salida['social2']);
                        }
                        if(salida['social1'] != null){
                            $('#ajax_social3').val(salida['social3']);
                        }
                        if(salida['social1'] != null){
                            $('#ajax_social4').val(salida['social4']);
                        }
                        $('#mod_fragmento_select option[value="'+salida['fragmento']+'"]').prop('selected', true);
                        if (salida['fragmento'] != null) {
                            $('#mod_fragmento_select').css('background', '#755860');
                        }
                        $('#ajax_social_id').val(salida['id']);
                        break;
                    case 'CAM_EST_PERF':
                        $('#ajax_estado_id').val(salida['id']);
                        break;
                    case 'ETI_PERF':
                        $('#ajax_hyzher').text(salida['imagen']);
                        $('#ajax_lugar').text(salida['lugar']);
                        $('#ajax_soy').val(salida['soy']);
                        if (salida['estado'] == 0) {
                             $('#ajax_estado').text("Oculto");
                        }else{
                             $('#ajax_estado').text("Visible");
                        }
                        if(salida['etiqueta'] != null){
                            $('#ajax_etiqueta').val(salida['etiqueta']);
                        }
                        $('#ajax_cam_id').val(salida['id']);                      
                        $('#ajax_cam_hyzher').val(salida['hyzher']);
                        break;
                    case 'ETI_PERF_ERROES':
                        $('#ajax_hyzher').text(salida['imagen']);
                        $('#ajax_lugar').text(salida['lugar']);
                        $('#ajax_soy').val(salida['soy']);
                        if (salida['estado'] == 0) {
                             $('#ajax_estado').text("Oculto");
                        }else{
                             $('#ajax_estado').text("Visible");
                        }
                        break;
                    case 'BOR_PERF':
                        $('#ajax_hyzher_borrar').text(salida['imagen']);
                        $('#ajax_lugar_borrar').text(salida['lugar']);
                        if (salida['estado'] == 0) {
                             $('#ajax_estado_borrar').text("Oculto");
                        }else{
                             $('#ajax_estado_borrar').text("Visible");
                        }
                        $('#ajax_bor_id').val(salida['id']);                      
                        $('#ajax_bor_hyzher').val(salida['hyzher']);
                        break;

                    //DETALLES
                    case 'CAM_DETA':
                        $('#ajax_hyzher').text(salida['hyzher']);
                        $('#ajax_fragmentos').text(salida['fragmentos']);
                        $('#ajax_personajes').text(salida['personajes']);
                        $('#ajax_tareas').text(salida['tareas']);
                        $('#ajax_leyendas').text(salida['leyendas']);
                        $('#fragmentos').val(salida['fragmentos']);
                        $('#personajes').val(salida['personajes']);
                        $('#tareas').val(salida['tareas']);
                        $('#leyendas').val(salida['leyendas']);
                        $('#ajax_cam_id').val(salida['id']);
                        break;
                    case 'DETALLES_ERRORES':
                        $('#ajax_hyzher').text(salida['hyzher']);
                        $('#ajax_fragmentos').text(salida['fragmentos']);
                        $('#ajax_personajes').text(salida['personajes']);
                        $('#ajax_tareas').text(salida['tareas']);
                        $('#ajax_leyendas').text(salida['leyendas']);
                        break;

                    //NUCLEOS
                    case 'CAM_NUCLEO_FAM1':
                        $('#ajax_hyzherF1').text(salida['hyzher']);
                        $('#ajax_familiaF1').text(salida['familia_numero']);
                        $('#ajax_creadoF1').text(salida['creado']);
                        $('#ajax_familia1').val(salida['familia']);
                        $('#cam_familia1_select option[value="'+salida['familia']+'"]').prop('selected', true);
                        $('#ajax_camF1_id').val(salida['id']);
                        break;
                    case 'CAM_NUCLEO_FAM1_ERRORES':
                        $('#ajax_hyzherF1').text(salida['hyzher']);
                        $('#ajax_familiaF1').text(salida['familia']);
                        $('#ajax_creadoF1').text(salida['creado']);
                        break;
                    case 'CAM_NUECLEO_FAMT':
                        $('#ajax_hyzherFT').text(salida['hyzher']);
                        $('#ajax_familiaFT').text(salida['familia_numero']);
                        $('#ajax_creadoFT').text(salida['creado']);
                        $('#ajax_familiaT').val(salida['familia']);
                        $('#cam_familiaT_select option[value="'+salida['familia']+'"]').prop('selected', true);
                        $('#ajax_camFT_familia').val(salida['familia']);
                        $('#ajax_camFT_id').val(salida['id']);
                        break;
                    case 'CAM_NUCLEO_FAMT_ERRORES':
                        $('#ajax_hyzherFT').text(salida['hyzher']);
                        $('#ajax_familiaFT').text(salida['familia_numero']);
                        $('#ajax_creadoFT').text(salida['creado']);
                        break;
                    case 'CAM_CERRADURA':
                        $('#ajax_hyzherCR').text(salida['hyzher']);
                        $('#ajax_familiaCR').text(salida['familia_numero']);
                        $('#ajax_cerraduraCR').text(salida['cerradura']);
                        $('#ajax_creadoCR').text(salida['creado']);
                        $('#ajax_camCR_familia').val(salida['familia']);
                        $('#ajax_camCR_id').val(salida['id']);
                        break;
                    case 'CAM_CERRADURA_ERRORES':
                        $('#ajax_hyzherCR').text(salida['hyzher']);
                        $('#ajax_familiaCR').text(salida['familia_numero']);
                        $('#ajax_cerraduraCR').text(salida['cerradura']);
                        $('#ajax_creadoCR').text(salida['creado']);
                        break;
                    case 'BOR_NUCLEO':
                        $('#ajax_bor_hyzherCR').text(salida['hyzher']);
                        $('#ajax_bor_familiaCR').text(salida['familia_numero']);
                        $('#ajax_bor_creadoCR').text(salida['creado']);
                        $('#ajax_bor_id').val(salida['id']);
                        break;

                    //INGRESOS
                    case 'CAM_INGRESO_PASS':
                        $('#ajax_user').text(salida['user']);
                        $('#ajax_email').text(salida['email']);
                        $('#ajax_cam_pass').val(salida['id']);
                        break;
                    case 'CAM_INGRESOS_PASS_ERROR':
                        $('#ajax_user').text(salida['user']);
                        $('#ajax_email').text(salida['email']);
                        break;
                    case 'BOR_INGRESO':
                        $('#ajax_bor_user').text(salida['user']);
                        $('#ajax_bor_email').text(salida['email']);
                        $('#ajax_bor_id').val(salida['id']);
                        break;
				}
			}
		},
		error: function(){
			alert("Hubo un problema con la conexión del servidor");
		}
	});
}

// BLOQUEADOR DE SCROLL
var bloquedarScroll = {
	main: function(){
		this.variables();
	},
	variables: function(){
		this.activo = false;
	},
	accion: function(){
		if (this.activo) {
			$('body').addClass('bloqueador-scroll');
		}else{
			$('body').removeClass('bloqueador-scroll');
		}
	}
};
bloquedarScroll.main();