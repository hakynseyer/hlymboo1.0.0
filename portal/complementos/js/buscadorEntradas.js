$(function(){
	$('#FormBuscador').submit(function(e){
		e.preventDefault();
	});

	$('#FormBuscador select[name="autores"]').change(function(){
		$('#FormBuscador select[name="autores"]').css('background','#3BB0A8');
			$('#FormBuscador select[name="categorias"]').css('background','#f6effc');
			$('#FormBuscador select[name="clasificaciones"]').css('background','#f6effc');

		var Autor = $('#FormBuscador select[name="autores"]').val();
		Pag = 0;

		if(Autor == 0){
			$('#FormBuscador select[name="autores"]').css('background','#f6effc');
		}

			enviarOtraDimension();
			esconderModulos();

		$('#FormBuscador select[name="categorias"] option[value="0"]').prop('selected',true);
		$('#FormBuscador select[name="clasificaciones"] option[value="0"]').prop('selected',true);
		ajax(Autor, 'Autores', Pag, MuestraSolo);
	});
//Pagina web realizada por joaquin reyes Sanchez, poseedor de todos los derechos como autor y creador de www.hlymboo.com
	$('#FormBuscador select[name="categorias"]').change(function(){
		$('#FormBuscador select[name="categorias"]').css('background','#3BB0A8');
			$('#FormBuscador select[name="autores"]').css('background','#f6effc');
			$('#FormBuscador select[name="clasificaciones"]').css('background','#f6effc');

		var Categoria = $('#FormBuscador select[name="categorias"]').val();	
		Pag = 0;

		if(Categoria == 0){
			$('#FormBuscador select[name="categorias"]').css('background','#f6effc');
		}

			enviarOtraDimension();
			esconderModulos();

		$('#FormBuscador select[name="autores"] option[value="0"]').prop('selected',true);
		$('#FormBuscador select[name="clasificaciones"] option[value="0"]').prop('selected',true);
		ajax(Categoria, 'Categorias', Pag, MuestraSolo);
	});

	$('#FormBuscador select[name="clasificaciones"]').change(function(){
		$('#FormBuscador select[name="clasificaciones"]').css('background','#3BB0A8');
			$('#FormBuscador select[name="autores"]').css('background','#f6effc');
			$('#FormBuscador select[name="categorias"]').css('background','#f6effc');

		var Clasificacion = $('#FormBuscador select[name="clasificaciones"]').val();	
		Pag = 0;

		if(Clasificacion == 0){
			$('#FormBuscador select[name="clasificaciones"]').css('background','#f6effc');
		}

			enviarOtraDimension();
			esconderModulos();

		$('#FormBuscador select[name="autores"] option[value="0"]').prop('selected',true);
		$('#FormBuscador select[name="categorias"] option[value="0"]').prop('selected',true);
		ajax(Clasificacion, 'Clasificaciones', Pag, MuestraSolo);
	});

	$('#FormBuscador button[name="buscar"]').click(function(){
			$('#FormBuscador select[name="clasificaciones"]').css('background','#f6effc');
			$('#FormBuscador select[name="autores"]').css('background','#f6effc');
			$('#FormBuscador select[name="categorias"]').css('background','#f6effc');

		var Familia = $('#FormBuscador input[name="familias"]').val();
		Pag = 0;
			
			enviarOtraDimension();
			esconderModulos();

		$('#FormBuscador select[name="autores"] option[value="0"]').prop('selected',true);
		$('#FormBuscador select[name="categorias"] option[value="0"]').prop('selected',true);
		$('#FormBuscador select[name="clasificaciones"] option[value="0"]').prop('selected',true);

		ajax(Familia, 'Familias', Pag, 1);

	});

	$('#entradasPaginador button[name="paginas"]').click(function(){
		ajaxBotones();
	});

		$('#entradasPaginador button[name="reiniciar"]').click(function(){
			Pag = 0;
			$(window).scrollTop($('#entradasPaginador').offset().top);
			esconderModulos();
			ajaxBotones();
		});

	$('#entradasPaginador button[name="paginasAutores"]').click(function(){
		ajax(Autor, 'Autores', Pag, MuestraSolo);
	});

		$('#entradasPaginador button[name="reiniciarAutores"]').click(function(){
			Pag = 0;
			$(window).scrollTop($('#entradasPaginador').offset().top);
			esconderModulos();
			ajax(Autor, 'Autores', Pag, MuestraSolo);
		});

	$('#entradasPaginador button[name="paginasPersonajes"]').click(function(){
		ajax(Personaje, 'Personajes', Pag, MuestraSolo);
	});

		$('#entradasPaginador button[name="reiniciarPersonajes"]').click(function(){
			Pag = 0;
			$(window).scrollTop($('#entradasPaginador').offset().top);
			esconderModulos();
			ajax(Personaje, 'Personajes', Pag, MuestraSolo);
		});

});


function esconderModulos(){
	$('#entradasPaginador').find('div.panelUE').remove();
	$('#entradasPaginador div[id="mensaje"]').remove();
	$('#entradasPaginador div[id="botones"]').hide();
}


function enviarOtraDimension(){
	if($(window).width >= 768){
		$('.tablon-tareas').hide();
	}
}

function ajaxBotones(){
	var Autor = $('#FormBuscador select[name="autores"]').val();
	var Categoria = $('#FormBuscador select[name="categorias"]').val();
	var Clasificacion = $('#FormBuscador select[name="clasificaciones"]').val();
	var Familia = $('#FormBuscador input[name="familias"]').val();

	if( Autor != '0'){
		ajax(Autor, 'Autores', Pag, MuestraSolo);
	}else if( Categoria != '0'){
		ajax(Categoria, 'Categorias', Pag, MuestraSolo);
	}else if( Clasificacion != '0'){
		ajax(Clasificacion, 'Clasificaciones', Pag, MuestraSolo);
	}else if( Familia != ''){
		ajax(Familia, 'Familias', Pag, 1);
	}else{
		ajax('', '', Pag, MuestraSolo);
	}
}

function ajax(valor,accion,pagina,coloca){
	$.ajax({
		type: 'POST',
		url: 'http://localhost/portal/hacer/php/realiza/ajax/ajax_ultimas_entradas.inc.php',
		dataType: 'JSON',
		cache: false,
		data: {'valor':valor, 'accion':accion, 'pagina': pagina, 'coloca': coloca},
		success: function(codigo){
			if(codigo['estado']){
				$('#entradasPaginador').find('div.panelUE').removeAttr('id');
				$('#entradasPaginador').append(codigo['salida']).find('div#panelesFuturos').hide().fadeIn('slow');

				$('#entradasPaginador button[name="paginas"]').attr('disabled', false);
					$('#entradasPaginador button[name="paginasAutores"]').attr('disabled', false);
					$('#entradasPaginador button[name="paginasPersonajes"]').attr('disabled', false);
				
				$('#entradasPaginador div[id="botones"]').appendTo('#entradasPaginador');
				$('#entradasPaginador div[id="botones"]').fadeIn('fast');

					if($(window).width >= 768){
						$('.tablon-tareas').css('display','block');
					}

				Pag= Pag + coloca;
			}else{
				$('#entradasPaginador button[name="paginas"]').attr('disabled', true);
				$('#entradasPaginador button[name="paginasAutores"]').attr('disabled', true);
				$('#entradasPaginador button[name="paginasPersonajes"]').attr('disabled', true);
				
				$('#entradasPaginador').append('<div id="mensaje">Has llegado al Final</div>');
				$('#entradasPaginador div[id="botones"]').appendTo('#entradasPaginador');

			}
		},
		error: function(){
			alert("Hubo un problema con la conexión del servidor");
		}
	});
}

function op_entradaFamiliar(Entrada){
	$(document).ready(function(){
	    Galletas.createCookie("entradasFamiliares", "index", "");
	});
	window.location="/"+Entrada;
}
