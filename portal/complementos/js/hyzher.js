	//Modificar web
$('#p_cent').css('width', '83%');
$('#p_izq').css('display', 'block');

	// FORM GALERIA
var galeriaForm1 = {
	paneles: [],

	main: function(){
		this.variables();
		this.capturar();
		this.eventos();
	},
	variables: function(){
		this.imagenActual = 0;
		this.imagenSiguiente = 0;
		this.vistaInfinita;

		this.marco1 = $('#marco1');
		this.slider = $('#slider1');
		this.imagen = this.slider.find('section');
		this.familia = this.imagen.find('input#familia');

		this.btnDerecha = this.marco1.find('#m_der');
		this.btnIzquierda = this.marco1.find('#m_izq');
		this.btncapturar = this.marco1.find('#m_capturar');

		this.elInfor = $('#infoImagenNuevo');
		this.elNombre = this.elInfor.find('#imagenNombre');
		this.elCreado = this.elInfor.find('#imagenCreado');
		this.elNota = this.elInfor.find('#imagenNotas');

		this.elId = $('#imagen');

		this.selector = $('#selectImgFamNuevo');
	},
	capturar: function(){
		this.imagenesTotales = this.imagen.length;
		for (var i = 0; i < this.imagenesTotales; i++) {
			this.paneles.push('<section>'+this.imagen.eq(i).html()+'</section>');
		}
	},
	eventos: function(){
		this.btnDerecha.on('click', this.moverDerecha.bind(this));
		this.btnIzquierda.on('click', this.moverIzquierda.bind(this));
		this.btncapturar.on('click', this.capturarImagen.bind(this));
		this.slider.on('click', this.capturarImagen.bind(this));
		this.selector.on('change', this.filtrar.bind(this));
	},
	vistaInfinita: function(){
		this.vistaInfinita = setInterval(this.moverInfinito.bind(this), 2000);
	},
	moverInfinito: function(){
		this.movimientoDerecha(1000);
	},
	moverDerecha: function(){
		clearInterval(this.vistaInfinita);
		this.movimientoDerecha(500);
	},
	moverIzquierda: function(){
		clearInterval(this.vistaInfinita);
		this.movimientoIzquierda(500);
	},
	movimientoDerecha: function(tiempo){
		this.imagenesTotales = this.slider.children().length;
		this.imagenSiguiente += 1;
		if (this.imagenSiguiente >= this.imagenesTotales) {
			this.imagenSiguiente = 0;
			this.slider.animate({'opacity': '0'},tiempo);
		}
		this.imagenActual = this.imagenSiguiente;
		this.slider.animate({'margin-left': (this.imagenActual*-100) +'%'},tiempo);
		this.slider.animate({'opacity': '1'},tiempo);
	},
	movimientoIzquierda: function(tiempo){
		this.imagenesTotales = this.slider.children().length;
		if (this.imagenSiguiente <= 0) {
			this.imagenSiguiente = this.imagenesTotales;
			this.slider.animate({'opacity': '0'},tiempo);
		}
		this.imagenSiguiente -= 1;
		this.imagenActual = this.imagenSiguiente;
		this.slider.animate({'margin-left': (this.imagenActual*-100) +'%'},tiempo);
		this.slider.animate({'opacity': '1'},tiempo);
	},
	filtrar: function(){
		this.imagenesTotales = this.imagen.length;
		var familia = this.selector.val(),
			contador = 0;


		this.slider.children().remove();

		if (familia == "imagenesHlymboo") {
			for (var i = 0; i < this.imagenesTotales; i++) {
				this.slider.append(this.paneles[i]);
			}
			this.slider.css('width',((this.imagenesTotales)*100)+'%');
		}else{
			for (var i = 0; i < this.imagenesTotales; i++) {
				if (this.familia.eq(i).val() == familia) {
					this.slider.append(this.paneles[i]);
					contador +=1;
				}
			}
			this.slider.css('width',((contador)*100)+'%');
			this.slider.animate({'margin-left': '0%'},0);
			this.imagenSiguiente = 0;
			this.imagenActual = 0;
		};
	},
	capturarImagen: function(){
		var capturadoId = this.slider.children().eq(this.imagenActual).find('input#id').val(),
			capturadoNombre = this.slider.children().eq(this.imagenActual).find('span#titulo').text(),
			capturadoCreado = this.slider.children().eq(this.imagenActual).find('span#fam').text(),
			capturadoNotas = this.slider.children().eq(this.imagenActual).find('span#notas').text();

		this.elId.val(capturadoId);
		this.elNombre.text(capturadoNombre);
		this.elCreado.text(capturadoCreado);
		this.elNota.text(capturadoNotas);
	}
};
galeriaForm1.main();

var galeriaForm2 = {
	paneles: [],

	main: function(){
		this.variables();
		this.capturar();
		this.eventos();
	},
	variables: function(){
		this.imagenActual = 0;
		this.imagenSiguiente = 0;
		this.vistaInfinita;

		this.marco1 = $('#marco2');
		this.slider = $('#slider2');
		this.imagen = this.slider.find('section');
		this.familia = this.imagen.find('input#familia');

		this.btnDerecha = this.marco1.find('#m_der');
		this.btnIzquierda = this.marco1.find('#m_izq');
		this.btncapturar = this.marco1.find('#m_capturar');

		this.elInfor = $('#infoImagenCambiar');
		this.elNombre = this.elInfor.find('#imagenNombre');
		this.elCreado = this.elInfor.find('#imagenCreado');
		this.elNota = this.elInfor.find('#imagenNotas');

		this.elId = $('#ajax_imagen');

		this.selector = $('#selectImgFamCambiar');
	},
	capturar: function(){
		this.imagenesTotales = this.imagen.length;
		for (var i = 0; i < this.imagenesTotales; i++) {
			this.paneles.push('<section>'+this.imagen.eq(i).html()+'</section>');
		}
	},
	eventos: function(){
		this.btnDerecha.on('click', this.moverDerecha.bind(this));
		this.btnIzquierda.on('click', this.moverIzquierda.bind(this));
		this.btncapturar.on('click', this.capturarImagen.bind(this));
		this.slider.on('click', this.capturarImagen.bind(this));
		this.selector.on('change', this.filtrar.bind(this));
	},
	vistaInfinita: function(){
		this.vistaInfinita = setInterval(this.moverInfinito.bind(this), 2000);
	},
	moverInfinito: function(){
		this.movimientoDerecha(1000);
	},
	moverDerecha: function(){
		clearInterval(this.vistaInfinita);
		this.movimientoDerecha(500);
	},
	moverIzquierda: function(){
		clearInterval(this.vistaInfinita);
		this.movimientoIzquierda(500);
	},
	movimientoDerecha: function(tiempo){
		this.imagenesTotales = this.slider.children().length;
		this.imagenSiguiente += 1;
		if (this.imagenSiguiente >= this.imagenesTotales) {
			this.imagenSiguiente = 0;
			this.slider.animate({'opacity': '0'},tiempo);
		}
		this.imagenActual = this.imagenSiguiente;
		this.slider.animate({'margin-left': (this.imagenActual*-100) +'%'},tiempo);
		this.slider.animate({'opacity': '1'},tiempo);
	},
	movimientoIzquierda: function(tiempo){
		this.imagenesTotales = this.slider.children().length;
		if (this.imagenSiguiente <= 0) {
			this.imagenSiguiente = this.imagenesTotales;
			this.slider.animate({'opacity': '0'},tiempo);
		}
		this.imagenSiguiente -= 1;
		this.imagenActual = this.imagenSiguiente;
		this.slider.animate({'margin-left': (this.imagenActual*-100) +'%'},tiempo);
		this.slider.animate({'opacity': '1'},tiempo);
	},
	filtrar: function(){
		this.imagenesTotales = this.imagen.length;
		var familia = this.selector.val(),
			contador = 0;


		this.slider.children().remove();

		if (familia == "imagenesHlymboo") {
			for (var i = 0; i < this.imagenesTotales; i++) {
				this.slider.append(this.paneles[i]);
			}
			this.slider.css('width',((this.imagenesTotales)*100)+'%');
		}else{
			for (var i = 0; i < this.imagenesTotales; i++) {
				if (this.familia.eq(i).val() == familia) {
					this.slider.append(this.paneles[i]);
					contador +=1;
				}
			}
			this.slider.css('width',((contador)*100)+'%');
			this.slider.animate({'margin-left': '0%'},0);
			this.imagenSiguiente = 0;
			this.imagenActual = 0;
		};
	},
	capturarImagen: function(){
		var capturadoId = this.slider.children().eq(this.imagenActual).find('input#id').val(),
			capturadoNombre = this.slider.children().eq(this.imagenActual).find('span#titulo').text(),
			capturadoCreado = this.slider.children().eq(this.imagenActual).find('span#fam').text(),
			capturadoNotas = this.slider.children().eq(this.imagenActual).find('span#notas').text();

		this.elId.val(capturadoId);
		this.elNombre.text(capturadoNombre);
		this.elCreado.text(capturadoCreado);
		this.elNota.text(capturadoNotas);
	}
};
galeriaForm2.main();


				// LIMPIADOR
var limpiador = {
	main: function(){
		this.variables();
		this.eventos();
	},
	variables: function(){
		this.btnLimpiarIN = $('#Lim_nuevoI');
		this.btnLimpiarFN = $('#Lim_nuevoF');

		this.elBorrado = $('#el_borrado');

		this.elNuevo = $('#el_nuevo');
			this.inputs1 = this.elNuevo.find('input[type="text"]');
			this.inputs1_P = this.elNuevo.find('input[type="password"]');
			this.inputs1_E = this.elNuevo.find('input[type="email"]');
			this.textareas1 = this.elNuevo.find('textarea');
			this.selector1 = this.elNuevo.find('select');
			this.errores1 = this.elNuevo.find('div#El_Error');

		this.btnLimpiarIC = $('#Lim_cambiadoI');
		this.btnLimpiarFC = $('#Lim_cambiadoF');

		this.elCambiado = $('#el_cambiado');
			this.inputs2 = this.elCambiado.find('input[type="text"]');
			this.inputs2_P = this.elCambiado.find('input[type="password"]');
			this.textareas2 = this.elCambiado.find('textarea[cols="30"]');
			this.selector2 = this.elCambiado.find('select');
			this.errores2 = this.elCambiado.find('div#El_Error');

		this.btnLimpiarID = $('#Lim_detalleI');
		this.btnLimpiarFD = $('#Lim_detalleF');

		this.elDetallado = $('#el_detallado');
			this.inputs3 = this.elDetallado.find('input[type="text"]');
			this.textareas3 = this.elDetallado.find('textarea');
			this.selector3 = this.elDetallado.find('select');
			this.errores3 = this.elDetallado.find('div#El_Error');

		this.btnLimpiarIP = $('#Lim_pfiI');
		this.btnLimpiarFP = $('#Lim_pfiF');

		this.elPFi = $('#el_pfi');
			this.inputs4 = this.elPFi.find('input[type="text"]');
			this.textareas4 = this.elPFi.find('textarea');
			this.selector4 = this.elPFi.find('select');
			this.errores4 = this.elPFi.find('div#El_Error');

		this.btnLimpiarIT = $('#Lim_contI');
		this.btnLimpiarFT = $('#Lim_contF');

		this.elEscrito = $('#el_escrito');
			this.textareas5 = this.elEscrito.find('textarea');

//Del Fórmulario Perfil
		this.btnLimpiarIPER = $('#Lim_perfI');
		this.btnLimpiarFPER = $('#Lim_perfF');

		this.elPerfil = $('#el_perfil');
			this.inputs5 = this.elPerfil.find('input[type="text"]');
			this.textareas5 = this.elPerfil.find('textarea');
			this.selector5 = this.elPerfil.find('select');
			this.errores5 = this.elPerfil.find('div#El_Error');

//Del Fórmulario Nucleos Familia 1
		this.btnLimpiarINUCF1 = $('#Lim_fam1I');
		this.btnLimpiarFNUCF1 = $('#Lim_fam1F');

		this.laFamilia1 = $('#la_familia1');
			this.inputs6 = this.laFamilia1.find('input[type="text"]');
			this.selector6 = this.laFamilia1.find('select');
			this.errores6 = this.laFamilia1.find('div#El_Error');

//Del fórmulario Nucleos Familia T
		this.btnLimpiarINUCFT = $('#Lim_famTI');
		this.btnLimpiarFNUCFT = $('#Lim_famTF');

		this.laFamiliaT = $('#la_familiaT');
			this.inputs7 = this.laFamiliaT.find('input[type="text"]');
			this.selector7 = this.laFamiliaT.find('select');
			this.errores7 = this.laFamiliaT.find('div#El_Error');

		this.spanslider1 = $('#infoImagenNuevo').find('span');
		this.spanslider2 = $('#infoImagenCambiar').find('span');
		this.oculto = $('#ajax_oculto');
		this.habilitar = $('#ajax_oculto2');
	},
	eventos: function(){
		this.btnLimpiarIN.on('click', this.limpiarN.bind(this));
		this.btnLimpiarFN.on('click', this.limpiarN.bind(this));

		this.btnLimpiarIC.on('click', this.limpiarC.bind(this));
		this.btnLimpiarFC.on('click', this.limpiarC.bind(this));

		this.btnLimpiarID.on('click', this.limpiarD.bind(this));
		this.btnLimpiarFD.on('click', this.limpiarD.bind(this));

		this.btnLimpiarIP.on('click', this.limpiarP.bind(this));
		this.btnLimpiarFP.on('click', this.limpiarP.bind(this));

		this.btnLimpiarIT.on('click', this.limpiarT.bind(this));
		this.btnLimpiarFT.on('click', this.limpiarT.bind(this));

		this.btnLimpiarIPER.on('click', this.limpiarPER.bind(this));
		this.btnLimpiarFPER.on('click', this.limpiarPER.bind(this));

		this.btnLimpiarINUCF1.on('click', this.limpiarFAM1.bind(this));
		this.btnLimpiarFNUCF1.on('click', this.limpiarFAM1.bind(this));

		this.btnLimpiarINUCFT.on('click', this.limpiarFAMT.bind(this));
		this.btnLimpiarFNUCFT.on('click', this.limpiarFAMT.bind(this));
	},
	limpiarN: function(){
		this.inputs1.val('');
		this.inputs1_P.val('');
		this.inputs1_E.val('');
		this.textareas1.val('');
		this.selector1.css('background','#fff');
		this.selector1.find('option[value="Vacio"]').prop('selected', true);
		this.errores1.remove();
		this.spanslider1.text('');
	},
	limpiarC: function(){
		this.inputs2.val('');
		this.inputs2_P.val('');
		this.textareas2.val('');
		this.selector2.css('background','#fff');
		this.selector2.find('option[value="Vacio"]').prop('selected', true);
		this.errores2.remove();
		this.spanslider2.text('');
		this.oculto.prop('checked', true);
	},
	limpiarD: function(){
		this.inputs3.val('');
		this.textareas3.val('');
		this.selector3.css('background','#fff');
		this.selector3.find('option[value="Vacio"]').prop('selected', true);
		this.errores3.remove();
		this.oculto.prop('checked', true);
	},
	limpiarP: function(){
		this.inputs4.val('');
		this.textareas4.val('');
		this.selector4.css('background','#fff');
		this.selector4.find('option[value="Vacio"]').prop('selected', true);
		this.errores4.remove();
		this.spanslider2.text('');
		this.oculto.prop('checked', true);
		this.habilitar.prop('checked', true);
	},
	limpiarPER: function(){
		this.inputs5.val('');
		this.textareas5.val('');
		this.selector5.css('background','#fff');
		this.selector5.find('option[value="Vacio"]').prop('selected', true);
		this.errores5.remove();
	},
	limpiarFAM1: function(){
		this.inputs6.val('');
		this.selector6.css('background','#fff');
		this.selector6.find('option[value="Vacio"]').prop('selected', true);
		this.errores6.remove();
	},
	limpiarFAMT: function(){
		this.inputs7.val('');
		this.selector7.css('background','#fff');
		this.selector7.find('option[value="Vacio"]').prop('selected', true);
		this.errores7.remove();
	},
	limpiarT: function(){
		this.textareas5.val('');
	}
};
limpiador.main();

		// SELECTOR FAMILIA
var familiaTipica = {
	main: function(){
		this.variables();
		this.eventos();
	},
	variables: function(){
		this.teclearN = false;
		this.teclearC = false;
		this.teclearF1 = false;
		this.teclearFT = false;

		this.selectorN = $('#n_familia_select');
		this.inputN = $('#familia');

		this.selectorFam1 = $('#cam_familia1_select');
		this.inputFam1 = $('#ajax_familia1');

		this.selectorFamT = $('#cam_familiaT_select');
		this.inputFamT = $('#ajax_familiaT');

		this.selectorC = $('#cam_familia_select');
		this.inputC = $('#ajax_familia');

		this.selectorCaT = $('#n_categoria_select');
		this.selectorCaT2 = $('#cam_categoria_select');

		this.selectorClA = $('#n_clasificacion_select');
		this.selectorClA2 = $('#cam_clasificacion_select');

		this.selectorPer = $('#mod_personaje_select');

		this.selectorFra = $('#mod_fragmento_select');

		this.selectorArc = $('#mod_archivo_select');
	},
	eventos: function(){
		this.selectorN.on('change', this.cambioN.bind(this));
		this.inputN.on('keyup', this.normalN.bind(this));

		this.selectorFam1.on('change', this.cambioFam1.bind(this));
		this.inputFam1.on('keyup', this.normalFam1.bind(this));

		this.selectorFamT.on('change', this.cambioFamT.bind(this));
		this.inputFamT.on('keyup', this.normalFamT.bind(this));

		this.selectorC.on('change', this.cambioC.bind(this));
		this.inputC.on('keyup', this.normalC.bind(this));

		this.selectorCaT.on('change', this.cambioCaT.bind(this));
		this.selectorCaT2.on('change', this.cambioCaT2.bind(this));

		this.selectorClA.on('change', this.cambioClA.bind(this));
		this.selectorClA2.on('change', this.cambioClA2.bind(this));

		this.selectorPer.on('change', this.cambioPER.bind(this));

		this.selectorFra.on('change', this.cambioFra.bind(this));

		this.selectorArc.on('change', this.cambioArc.bind(this));
	},
	cambioN: function(){
		var valor = this.selectorN.val();
		if (valor != "Vacio") {
			this.selectorN.css('background','#755860');
			this.inputN.val(valor);
			this.teclearN = true;
		}else{
			this.selectorN.css('background','#fff');
			this.inputN.val('').focus();
			this.teclearN = false;
		}
	},
	normalN: function(){
		if (this.teclearN) {
			this.selectorN.find('option[value="Vacio"]').prop('selected', true);
			this.selectorN.css('background','#fff');
			this.teclearN = false;
		}
	},
	cambioFam1: function(){
		var valor = this.selectorFam1.val();
		if (valor != "Vacio") {
			this.selectorFam1.css('background','#755860');
			this.inputFam1.val(valor);
			this.teclearF1 = true;
		}else{
			this.selectorFam1.css('background','#fff');
			this.inputFam1.val('').focus();
			this.teclearF1 = false;
		}
	},
	normalFam1: function(){
		if (this.teclearF1) {
			this.selectorFam1.find('option[value="Vacio"]').prop('selected', true);
			this.selectorFam1.css('background','#fff');
			this.teclearF1 = false;
		}
	},
	cambioFamT: function(){
		var valor = this.selectorFamT.val();
		if (valor != "Vacio") {
			this.selectorFamT.css('background','#755860');
			this.inputFamT.val(valor);
			this.teclearFT = true;
		}else{
			this.selectorFamT.css('background','#fff');
			this.inputFamT.val('').focus();
			this.teclearFT = false;
		}
	},
	normalFamT: function(){
		if (this.teclearFT) {
			this.selectorFamT.find('option[value="Vacio"]').prop('selected', true);
			this.selectorFamT.css('background','#fff');
			this.teclearFT = false;
		}
	},
	cambioC: function(){
		var valor = this.selectorC.val();
		if (valor != "Vacio") {
			this.selectorC.css('background','#755860');
			this.inputC.val(valor);
			this.teclearC = true;
		}else{
			this.selectorC.css('background','#fff');
			this.inputC.val('').focus();
			this.teclearC = false;
		}
	},
	normalC: function(){
		if (this.teclearC) {
			this.selectorC.find('option[value="Vacio"]').prop('selected', true);
			this.selectorC.css('background','#fff');
			this.teclearC = false;
		}
	},
	cambioCaT: function(){
		var valor = this.selectorCaT.val();
		if (valor != "Vacio") {
			this.selectorCaT.css('background','#755860');
		}else{
			this.selectorCaT.css('background','#fff');
		}
	},
	cambioClA: function(){
		var valor = this.selectorClA.val();
		if (valor != "Vacio") {
			this.selectorClA.css('background','#755860');
		}else{
			this.selectorClA.css('background','#fff');
		}
	},
	cambioCaT2: function(){
		var valor = this.selectorCaT2.val();
		if (valor != "Vacio") {
			this.selectorCaT2.css('background','#755860');
		}else{
			this.selectorCaT2.css('background','#fff');
		}
	},
	cambioClA2: function(){
		var valor = this.selectorClA2.val();
		if (valor != "Vacio") {
			this.selectorClA2.css('background','#755860');
		}else{
			this.selectorClA2.css('background','#fff');
		}
	},
	cambioPER: function(){
		var valor = this.selectorPer.val();
		if (valor != "Vacio") {
			this.selectorPer.css('background','#755860');
		}else{
			this.selectorPer.css('background','#fff');
		}
	},
	cambioFra: function(){
		var valor = this.selectorFra.val();
		if (valor != "Vacio") {
			this.selectorFra.css('background','#755860');
		}else{
			this.selectorFra.css('background','#fff');
		}
	},
	cambioArc: function(){
		var valor = this.selectorArc.val();
		if (valor != "Vacio") {
			this.selectorArc.css('background','#755860');
		}else{
			this.selectorArc.css('background','#fff');
		}
	}
};
familiaTipica.main();
