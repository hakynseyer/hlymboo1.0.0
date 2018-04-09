$('#header_toggle').click(function(){
	$(this).next().slideToggle();
});

//Quita el click derecho
var delHlymboo = {
	main:function(){
		this.inicial();
	},
	inicial: function(){
		document.oncontextmenu = function(){return false};
	}
}
// delHlymboo.main();

//Quita la seleccion del texto
var delHyzher = {
	main: function(){
		this.inicial();
	},
	inicial: function(){
		function disableselect(e){
			return false;
		}
		function reEnable(){
			return true;
		}
			document.onselectstart = new Function ("return false")
		if (window.sidebar){
			// document.onmousedown = disableselect
			document.onclick     = reEnable
		}

		document.onselectstart = function() {return false;}
		// document.onmousedown = function() {return false;}
	}
}
delHyzher.main();

//DETALLES DE LOS TABLONES
var detallesTablones = {
	main: function(){
		this.variables();
		this.eventos();
	},
	variables: function(){
		this.imagen = $('#imagenTablon');
		this.tituloImagen = $('#tituloImagen');
		this.detalleTablon = $('#detalleTablon');
		this.hyzherTablon = $('#hyzherTablon');
		this.fuenteTablon = $('#fuenteTablon');
	},
	eventos: function(){
		this.imagen.on('click', this.mostrarDetalles.bind(this));
	},
	mostrarDetalles: function(){
		this.detalleTablon.animate({'opacity':'1'},1000,function(){
			this.tituloImagen.css('opacity', '0');
			this.hyzherTablon.css('opacity', '0');
			this.fuenteTablon.css('opacity', '0');
		});
	}
}
// detallesTablones.main();

//MOVIMIENTO DE LOS TABLONES
var tablones = {
	main: function(moverTablones){
		if(moverTablones){
			this.variables();
			this.eventos();
			this.incializado();
			
			infinitoTablones(true);
		}
	},
	variables: function(){
		this.estado = false;
		this.Tablones = $('#TablonesGenerales');
		this.CuadroFinal = $('#TablonesGenerales').find('span:last');
		this.CuadroPrimero = $('#TablonesGenerales').find('span:first');
		this.botonAdelante = $('#tablonAdelante');
		this.botonAtras = $('#tablonAtras');
	},
	eventos: function(){
		this.botonAdelante.on('click', this.moverAdelante.bind(this));
		this.botonAtras.on('click', this.moverAtras.bind(this));
	},
	incializado: function(){
		this.CuadroFinal.insertBefore(this.CuadroPrimero);
		this.Tablones.css('margin-left', '-100%');
	},
	moverAdelante: function(){
		this.estado = true;
		if(this.estado == true){
			infinitoTablones(false);	
		}
		this.Tablones.animate({'margin-left':'-200%'},1000,function(){
			$('#TablonesGenerales span:first').insertAfter('#TablonesGenerales span:last');
			$('#TablonesGenerales').css('margin-left','-100%');
		});
	},
	moverAtras: function(){
		this.estado = true;
		if(this.estado == true){
			infinitoTablones(false);	
		}
		this.Tablones.animate({'margin-left':'0'},1000,function(){
			$('#TablonesGenerales span:last').insertBefore('#TablonesGenerales span:first');
			$('#TablonesGenerales').css('margin-left','-100%');
		});
	},
	moverInfinito: function(){
		this.Tablones.animate({'margin-left':'0'},1000,function(){
			$('#TablonesGenerales span:last').insertBefore('#TablonesGenerales span:first');
			$('#TablonesGenerales').css('margin-left','-100%');
		});
	}
};
if(typeof(MovimientoTablon) !== "undefined"){
	tablones.main(MovimientoTablon);
}

function infinitoTablones(estado){
	if (estado) {
		infinitoT = setInterval(function(){
			tablones.moverInfinito();
		}, 60000);
	}else{
		clearInterval(infinitoT);
	}
}

//MOVIMIENTO DE LOS PANELES
var paneles = {
	main: function(moverPaneles){
		if(moverPaneles){
			this.variables();
			this.eventos();
			this.incializado();
			
			infinitoPaneles(true);
		}
	},
	variables: function(){
		this.estado = false;
		this.Paneles = $('#PanelesGenerales');
		this.PanelFinal = $('#PanelesGenerales').find('span:last');
		this.PanelPrimero = $('PanelesGenerales').find('span:first');
		this.botonAdelante = $('#panelAdelante');
		this.botonAtras = $('#panelAtras');
	},
	eventos: function(){
		this.botonAdelante.on('click', this.moverAdelante.bind(this));
		this.botonAtras.on('click', this.moverAtras.bind(this));
	},
	incializado: function(){
		this.PanelFinal.insertBefore(this.PanelPrimero);
		this.Paneles.css('margin-left', '-100%');
	},
	moverAdelante: function(){
		this.estado = true;
		if(this.estado == true){
			infinitoPaneles(false);	
		}
		this.Paneles.animate({'margin-left':'-200%'},600,function(){
			$('#PanelesGenerales span:first').insertAfter('#PanelesGenerales span:last');
			$('#PanelesGenerales').css('margin-left','-100%');
		});
	},
	moverAtras: function(){
		this.estado = true;
		if(this.estado == true){
			infinitoPaneles(false);	
		}
		this.Paneles.animate({'margin-left':'0'},600,function(){
			$('#PanelesGenerales span:last').insertBefore('#PanelesGenerales span:first');
			$('#PanelesGenerales').css('margin-left','-100%');
		});
	},
	moverInfinito: function(){
		this.Paneles.animate({'margin-left':'0'},1000,function(){
			$('#PanelesGenerales span:last').insertBefore('#PanelesGenerales span:first');
			$('#PanelesGenerales').css('margin-left','-100%');
		});
	}
};
if(typeof(MovimientoPanel) !== "undefined"){
	paneles.main(MovimientoPanel);
}

function infinitoPaneles(estado){
	if (estado) {
		infinitoP = setInterval(function(){
			paneles.moverInfinito();
		}, 10000);
	}else{
		clearInterval(infinitoP);
	}
}


//COOKIES
var Galletas = {
  createCookie: function(name, value, days) {
    if (days) {
      var date = new Date();
      date.setTime(date.getTime()+(days*24*60*60*1000));
      var expires = "; expires="+date.toGMTString();
    }else var expires = "";
      document.cookie = name+"="+value+expires+"; path=/";
  },

  readCookie: function(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
  },

  eraseCookie: function(name) {
    Galletas.createCookie(name,"",-1);
  }
};

//HEADER
function pegarHeader(accion){
	if(accion){
		if($(window).width >= 768){
			$('header').css({'position':'fixed', 'top':'0px','height': '50px', 'margin-bottom':'0px', 'border-bottom': 'solid 1px #f6effc'});
		}
	}else{
		$('header').css('position','static');
		$('.contenedor-body').css('margin-top', '0px');
	}
}

//FAMILIAS
function op_familia(accion, mover){
	if (accion == 'mostrar') {
		$('#entradasFamiliares').fadeIn('slow');
		if(mover){
			window.scrollTo(0,$('#entradasFamiliares').offset().top);
		}
	}else{
		$('#entradasFamiliares').css('display','none');
	}
}

//ENTRADAS
var scrollEntradas = {
	main: function(moverEntradas){
		if(moverEntradas){
			this.variables();
			this.mover();
		}
	},
	variables: function(){
		this.Entradas = $('#entradasPaginador');
	},
	mover: function(){
		this.Entradas.offset().top;
		window.scrollTo(0,this.Entradas.offset().top);
	}
}

//MENU HYZHER
var MH_accion = {
	main: function(accion){
		this.variables();
		if(accion){
			this.mostrar();
		}else{
			this.ocultar();
		}
	},
	variables: function(){
		this.menu = $('#nav_MH');
	},
	mostrar: function(){
		this.menu.addClass('MH-ocultar');
	},
	ocultar: function(){
		this.menu.removeClass('MH-ocultar');
	}
}

//TABS HYZHER
var tabsMenuLateral = {
	main:function(){
		this.variables();
		this.inicial();
		this.eventos();
	},
	variables: function(){
		this.tabsMadre = $('#tabs_menu_lateral');
		this.contenidosMadre = $('#contenidos_tabs_menu_lateral');
		this.tabs = this.tabsMadre.find('button');
		this.contenido = this.contenidosMadre.find('.contenido-hijo');
	},
	inicial: function(){
		this.tabs.eq(0).add(this.contenido.eq(0)).addClass('activo');
	},
	eventos: function(){
		this.tabsMadre.on('click', 'button', function(){
			var tabActivo = $(this);
			var conteActivo = tabActivo.index();
			tabActivo.addClass('activo').siblings().removeClass('activo');
			$('.contenido-hijo').eq(conteActivo).addClass('activo').siblings().removeClass('activo');
		});
	}
}
tabsMenuLateral.main();

//FRAGMENTO POSTERIOR
var fragmentoPosterior = {
	main:function(estado){
		this.variables(estado);
		this.accion();
	},
	variables: function(estado){
		this.estado = estado;

		this.Frontal = $('#frag_Frontal');
		this.Posterior = $('#frag_Posterior');
	},
	accion: function(){
		if(this.estado){
			this.Frontal.animate({'opacity':'0'}, 500, function(){
				$('#frag_Frontal').css('display', 'none');
				$('#frag_Posterior').css('display', 'flex');
				$('#frag_Posterior').animate({'opacity': '1'},600);
			});
		}else{
			this.Posterior.animate({'opacity':'0'}, 500, function(){
				$('#frag_Posterior').css('display', 'none');
				$('#frag_Frontal').css('display', 'flex');
				$('#frag_Frontal').animate({'opacity': '1'},600);
			});
		}
	}
}