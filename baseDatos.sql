-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
-- ¡¡¡IMPORTANTE!!! NECESIAS CREAR LA BASE DE DATOS Y DESPUES CARGAR ESTE ARCHIVO SQL
--
-- Servidor: localhost:3306
-- Tiempo de generación: 09-04-2018 a las 10:14:50
-- Versión del servidor: 10.1.31-MariaDB-cll-lve
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo`
--

CREATE TABLE IF NOT EXISTS `archivo` (
  `id_archivo` int(11) NOT NULL AUTO_INCREMENT,
  `archivo_hyzher` int(11) NOT NULL,
  `archivo_titulo` varchar(255) NOT NULL,
  `archivo_familia` varchar(255) NOT NULL,
  `archivo_ruta` varchar(255) NOT NULL,
  `archivo_derechos` varchar(255) NOT NULL,
  `archivo_notas` varchar(255) NOT NULL,
  `archivo_creado` datetime NOT NULL,
  `archivo_modificado` datetime NOT NULL,
  `archivo_intentos` int(11) NOT NULL,
  `archivo_estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_archivo`),
  UNIQUE KEY `archivo_titulo` (`archivo_titulo`),
  UNIQUE KEY `archivo_ruta` (`archivo_ruta`),
  KEY `archivo_hyzher` (`archivo_hyzher`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `id_blog` int(11) NOT NULL AUTO_INCREMENT,
  `blog_hyzher` int(11) NOT NULL,
  `blog_personaje` int(11) DEFAULT NULL,
  `blog_fragmento` int(11) DEFAULT NULL,
  `blog_imagen` int(11) DEFAULT NULL,
  `blog_categoria` int(11) NOT NULL,
  `blog_clasificacion` int(11) NOT NULL,
  `blog_titulo` varchar(255) NOT NULL,
  `blog_familia` varchar(255) NOT NULL,
  `blog_url` varchar(255) NOT NULL,
  `blog_texto` text,
  `blog_archivo` int(11) DEFAULT NULL,
  `blog_archivoactivo` tinyint(4) DEFAULT NULL,
  `blog_derechos` varchar(255) DEFAULT NULL,
  `blog_creado` datetime NOT NULL,
  `blog_modificado` datetime NOT NULL,
  `blog_intentos` int(11) NOT NULL,
  `blog_estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_blog`),
  UNIQUE KEY `blog_titulo` (`blog_titulo`),
  UNIQUE KEY `blog_url` (`blog_url`),
  KEY `blog_hyzher` (`blog_hyzher`),
  KEY `blog_personaje` (`blog_personaje`),
  KEY `blog_fragmento` (`blog_fragmento`),
  KEY `blog_imagen` (`blog_imagen`),
  KEY `blog_categoria` (`blog_categoria`),
  KEY `blog_clasificacion` (`blog_clasificacion`),
  KEY `blog_archivo` (`blog_archivo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `blog`
--

INSERT INTO `blog` (`id_blog`, `blog_hyzher`, `blog_personaje`, `blog_fragmento`, `blog_imagen`, `blog_categoria`, `blog_clasificacion`, `blog_titulo`, `blog_familia`, `blog_url`, `blog_texto`, `blog_archivo`, `blog_archivoactivo`, `blog_derechos`, `blog_creado`, `blog_modificado`, `blog_intentos`, `blog_estado`) VALUES
(1, 1, NULL, NULL, NULL, 1, 1, 'Historia', 'Escritos Hlymboo', 'Historia', '<p style="text-align: justify;">A nombre de todo Hlymboo, yo <strong>Hakyn Seyer</strong>, quiero darte las gracias por tomarte el tiempo en visitar esta p&aacute;gina web. Ojala pudiera expresarte todo lo que siento al ver por fin culminado todos estos a&ntilde;os de total planeaci&oacute;n y sobre todo el tiempo invertido en la construcci&oacute;n de esta web... &iexcl;Mmmmm!, ahora que lo pienso, durante el desarrollo de este proyecto muy pocas veces, lo hab&iacute;a llamado p&aacute;gina web, as&iacute; que si no te molesta me tomar&eacute; la libertad de llamarlo por el verdadero nombre con el cual fue bautizado... "<strong>HLYMBOO</strong>".</p>\r\n<p style="text-align: justify;">Bueno, en esta secci&oacute;n quisiera hablar un poco sobre su proceso de construcci&oacute;n... Corr&iacute;a el a&ntilde;o del 2014 en el caluroso verano de mi pa&iacute;s M&eacute;.... &iquest;Hum?... Lo s&eacute;, creo que estoy siendo un poco molesto; intentar&eacute; ser m&aacute;s directo.</p>\r\n<p style="text-align: justify;">Hlymboo comenz&oacute; su despertar desde al a&ntilde;o 2014, cuando por casualidad comenz&eacute; a preguntarme del por qu&eacute; no publicar ciertas cosas que pasaban por mi mente y mostrarlas a todo el mundo con el f&iacute;n de encontrar personas que se sientan identificados conmigo y quien sabe quiz&aacute;s hasta mi futura pareja pueda... &iexcl;Qghhh!... Lo siento... Bueno como dec&iacute;a, la idea original era crear un lugar para publicar mis cosas, algo muy sencillo y f&aacute;cil de controlar. Entonces fue cuando comenz&eacute; a mirar diversas herramientas para hacer realidad mi peque&ntilde;o sue&ntilde;o<strong>... ...</strong></p>\r\n<p>&nbsp;</p>\r\n<table style="margin-left: auto; margin-right: auto;" width="1013" cellspacing="0" cellpadding="10">\r\n<tbody>\r\n<tr style="height: 43px; background-color: #2bbda9; text-align: center;">\r\n<td style="width: 121.05px; height: 43px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">Mediados del 2014</span></td>\r\n<td style="width: 293.083px; height: 43px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"Ohhh, mira lo que he encontrado... Puedo subir mis cosas aqui en Blogger..."</span></td>\r\n<td style="width: 269.45px; height: 43px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">2 semanas despu&eacute;s</span></td>\r\n<td style="width: 301.417px; height: 43px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"No me gust&oacute; mi personalizaci&oacute;n de mi blog... Adios Blogger"</span></td>\r\n</tr>\r\n<tr style="height: 50px; background-color: #d3f0eb;">\r\n<td style="width: 121.05px; height: 28px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">Finales del 2014</span></td>\r\n<td style="width: 293.083px; height: 28px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"Ohhh, mira esto se ve interesante... Quiz&aacute;s pueda pueda hacer mi pagina web en Jimdo..."</span></td>\r\n<td style="width: 269.45px; height: 28px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">3 semanas despu&eacute;s</span></td>\r\n<td style="width: 301.417px; height: 28px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"Odio la publicidad que me pone y adem&aacute;s no entiendo mucho estos elementos... &iexcl;&iquest;Qu&eacute; diablos esta sucediendo aqu&iacute;?!"</span></td>\r\n</tr>\r\n<tr style="height: 50px; background-color: #2bbda9; text-align: center;">\r\n<td style="width: 121.05px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">Inicios del 2015</span></td>\r\n<td style="width: 293.083px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"Bueno quiz&aacute;s, lo que busco es muy complejo, a lo mejor lo que necesito es solo subir mis ideas a alguna red social y ya"</span></td>\r\n<td style="width: 269.45px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">1 mes despu&eacute;s</span></td>\r\n<td style="width: 301.417px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"&iquest;Por qu&eacute; no se ajusta el texto a como yo quiero, por qu&eacute; no hay un organizador o algo similar?, me pierdo entre tanto comentario"</span></td>\r\n</tr>\r\n<tr style="height: 50px; background-color: #d3f0eb;">\r\n<td style="width: 121.05px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">Inicios del 2015</span></td>\r\n<td style="width: 293.083px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"Voy a tomar un descanso, total quien va a querer leer mis tonterias, mejor me dedico a mis otras aficiones"</span></td>\r\n<td style="width: 269.45px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">2 meses despu&eacute;s</span></td>\r\n<td style="width: 301.417px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"Me gusta mucho su punto de vista pero le falta esto, esto y esto otro... &iquest;Por qu&eacute; se tuvo que morir ese personaje que tanto me agradaba?... &iexcl;Grrr!"</span></td>\r\n</tr>\r\n<tr style="height: 47px; background-color: #2bbda9;">\r\n<td style="width: 121.05px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">Mediados del 2015</span></td>\r\n<td style="width: 293.083px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"Ok voy a hacer un segundo intento, har&eacute; mi propia p&aacute;gina web y lo llamar&eacute; <strong>Hlymboo</strong>"</span></td>\r\n<td style="width: 269.45px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">1 mes despu&eacute;s</span></td>\r\n<td style="width: 301.417px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"Estos usuarios mencionan que use WordPress, pero estos otros mencionan que lo mejor es crearlo desde 0"</span></td>\r\n</tr>\r\n<tr style="height: 47px; background-color: #d3f0eb;">\r\n<td style="width: 121.05px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">Mediados del 2015</span></td>\r\n<td style="width: 293.083px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"Bueno necesitar&eacute; aprender Html y Css... Creo que no ser&aacute; muy complicado"</span></td>\r\n<td style="width: 269.45px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">1 mes despu&eacute;s</span></td>\r\n<td style="width: 301.417px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"Qued&oacute; bien, pero le falta algo... Me fastidia crear el contenido con etiquetas"</span></td>\r\n</tr>\r\n<tr style="height: 47px; background-color: #2bbda9;">\r\n<td style="width: 121.05px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">Mediados del 2015</span></td>\r\n<td style="width: 293.083px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"Mmmm... Interesante... necesito un lenguaje de programaci&oacute;n orientado al servidor y de una base de datos"</span></td>\r\n<td style="width: 269.45px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">5 meses despu&eacute;s</span></td>\r\n<td style="width: 301.417px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"En que me he metido, esto de programar es todo un lio, tardo demasiado en aprender lo esencial que ya hasta he dejado a un lado mis pasatiempos"</span></td>\r\n</tr>\r\n<tr style="height: 47px; background-color: #d3f0eb;">\r\n<td style="width: 121.05px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">Finales del 2015</span></td>\r\n<td style="width: 293.083px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"Bueno ya he invertido tanto tiempo en aprender por mi cuenta las herramientas para crear mi sue&ntilde;o, as&iacute; que manos a la obra"</span></td>\r\n<td style="width: 269.45px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">8 meses despu&eacute;s</span></td>\r\n<td style="width: 301.417px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"Bueno me tom&oacute; cas&iacute; 1 a&ntilde;o pero creo que ya m&aacute;s o menos esta decente, lo &uacute;nico que me gustar&iacute;a es algo m&aacute;s de vida a mi web"</span></td>\r\n</tr>\r\n<tr style="height: 47px; background-color: #2bbda9;">\r\n<td style="width: 121.05px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">Mediados del 2016</span></td>\r\n<td style="width: 293.083px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"As&iacute; que javascript... bueno le echar&eacute; el ojo"</span></td>\r\n<td style="width: 269.45px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">6 meses despu&eacute;s</span></td>\r\n<td style="width: 301.417px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"&iquest;Encerio?... tuve que empezar desde cero por quinta vez... &iquest;Por qu&eacute; me haces esto dios?"</span></td>\r\n</tr>\r\n<tr style="height: 50px; background-color: #d3f0eb;">\r\n<td style="width: 121.05px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">Inicios del 2017</span></td>\r\n<td style="width: 293.083px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"Por fin he logrado algo que me satisface por ahora"</span></td>\r\n<td style="width: 269.45px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">2 meses despu&eacute;s</span></td>\r\n<td style="width: 301.417px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"Solo unas pruebas m&aacute;s"</span></td>\r\n</tr>\r\n<tr style="height: 47px; background-color: #2bbda9;">\r\n<td style="width: 121.05px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">Actualidad</span></td>\r\n<td style="width: 293.083px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"Le falta esto, no le quedar&aacute; mal un poco de esto por ac&aacute;... Quiz&aacute;s en un futuro agregue esto"</span></td>\r\n<td style="width: 269.45px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">Realidad</span></td>\r\n<td style="width: 301.417px; height: 47px; text-align: center; vertical-align: middle;"><span style="font-size: 11pt;">"Trabajo, trabajo y m&aacute;s trabajo... creo que esto ya se convirti&oacute; en un pasatiempo para mi"</span></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>\r\n<p style="text-align: justify;">En fin, lo de arriba solo fue un peque&ntilde;o resumen del tormento que fue para mi crear este sue&ntilde;o hecho realidad, ahora mi pr&oacute;ximo trabajo es darle vida a <strong>Hlymboo</strong> con las letras que yacen encerradas en mi mente. Al inicio el proyecto tenia la mirada de ser algo personal, algo &iacute;ntimo por as&iacute; decirlo, pero conforme le tom&eacute; cari&ntilde;o a la construcci&oacute;n de esto, me percat&eacute; de que tal vez pueda ir m&aacute;s all&aacute;... no s&eacute;, quiz&aacute;s en un futuro&nbsp;<strong>Hlymboo</strong> este conformado por un mont&oacute;n de familias de <strong>Hyzhers</strong>, compartiendo fragmentos y mostrando el potencial que tenemos cada uno de nosotros... "<em>Te invito a leer la pesta&ntilde;a de Gracias para entender esta nueva visi&oacute;n que tengo </em>".&nbsp;</p>\r\n<p style="text-align: justify;">Por &uacute;ltimo, voy a anexar las novedades o mejoras que trae consigo <strong>Hlymboo</strong> en su etapa actual, sin m&aacute;s por el momento, se despide tu <strong>Hyzher</strong> <strong>Hakyn Seyer</strong>.</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li><strong>Hlymboo</strong>&nbsp;<strong><em>Fase:</em></strong>&nbsp; "<em>Beta Cerrada 1.0.0&nbsp;</em>"&nbsp;<strong><em>Actualizaci&oacute;n:</em></strong>&nbsp; "<em>Parasito Morado "</em>&nbsp;<strong><em>Fecha:&nbsp;</em></strong>&nbsp;"<em>5 Abril 2017&nbsp;</em>"</li>\r\n<ol>\r\n<li><em>A&ntilde;adido pesta&ntilde;a Historia.</em></li>\r\n<li><em>A&ntilde;adido pesta&ntilde;a Gracias.</em></li>\r\n<li><em>A&ntilde;adido tabl&oacute;n de entradas futuras.</em></li>\r\n<li><em>A&ntilde;adido pesta&ntilde;a de entradas.</em></li>\r\n<li><em>A&ntilde;adido secci&oacute;n de opiniones.</em></li>\r\n<li><em>A&ntilde;adido &aacute;rea de fragmentos.</em></li>\r\n<li><em>A&ntilde;adido &aacute;rea de leyendas.</em></li>\r\n<li><em>A&ntilde;adido &aacute;rea de escritores.</em></li>\r\n<li><em>A&ntilde;adido personaje femenino oculto.</em></li>\r\n<li><strong><em>Feliz cumplea&ntilde;os HLYMBOO</em></strong><em>.<br /> <br /> </em></li>\r\n</ol>\r\n<li><strong>Hlymboo&nbsp;<em>Fase:</em></strong><em>&nbsp;</em>"<em>Beta Cerrada 1.1.0&nbsp;</em>"&nbsp;<strong><em>Actualizaci&oacute;n:</em></strong><em>&nbsp;</em>"<em>Multitud&nbsp;Familiar&nbsp;"&nbsp;<strong>Fecha:&nbsp;</strong></em>"8<em>&nbsp;Mayo 2017&nbsp;</em>"</li>\r\n<ol>\r\n<li><em>Mejora en la presentaci&oacute;n de entradas (Ahora son Familias).</em></li>\r\n<li><em>A&ntilde;adido slider "Nuestras Familias".</em></li>\r\n<li><em>A&ntilde;adido botones de redes sociales para compartir, twittear y me gusta para cada familia.</em></li>\r\n<li><em>A&ntilde;adido hoja de perfil de autores.</em></li>\r\n<li><em>A&ntilde;adido interfaz beta para usuarios Hyzhers.</em></li>\r\n<li><em>Actualizaci&oacute;n del lay-out de Hlymboo inicio.</em></li>\r\n<li><strong><em>Bienvenidos a Hlymboo familias</em></strong><em>.<br /> <br /> </em></li>\r\n</ol>\r\n<li><strong>Hlymboo&nbsp;<em>Fase:</em></strong><em>&nbsp;</em>"<em>Beta Cerrada 1.2.0&nbsp;</em>"&nbsp;<strong><em>Actualizaci&oacute;n:</em></strong><em>&nbsp;</em>"Locos<em>&nbsp;Filtros&nbsp;"&nbsp;<strong>Fecha:&nbsp;</strong></em>"5<em>&nbsp;Junio&nbsp;2017&nbsp;</em>"</li>\r\n<ol>\r\n<li>A&ntilde;adido filtros para buscar familias de inter&eacute;s personal (Bloque:&nbsp;Entradas-Familias).</li>\r\n<li>Se ha eliminado la paginaci&oacute;n, en su lugar se ha implementado la opci&oacute;n de aumentar la b&uacute;squeda (Bot&oacute;n que aparece debajo de las familias).</li>\r\n<li>A&ntilde;adido un bot&oacute;n de resetear la b&uacute;squeda. &Uacute;til cuando se han generado muchas familias (Bloque: Entradas-Familias).</li>\r\n<li>Cambio de colores&nbsp;en las familias (Bloque: Entradas-Familias).</li>\r\n<li>Men&uacute; principal inteligente, ahora podr&aacute; ponerse fijo o normal dependiendo de los sitios dentro de Hlymboo.</li>\r\n<li>Cambio de estilos de fuente a las leyendas (Men&uacute; principal).</li>\r\n<li>Eliminaci&oacute;n del marco purpura en las im&aacute;genes que aparecen dentro de cada blog-Familiar, un punto a favor para no distraerse.</li>\r\n<li>Mejora en el dise&ntilde;o responsivo para dispositivos m&oacute;viles; ahora las Entradas-Familias se ver&aacute;n con la imagen o t&iacute;tulo representativo del blog.</li>\r\n<li><strong><em>Los filtros locos de HLYMBOO</em></strong><em>.</em></li>\r\n</ol>\r\n</ul>', NULL, 1, 'Derechos de autor 2017 Joaquin Reyes', '2017-04-05 21:58:18', '2017-04-05 21:58:18', 0, 1),
(2, 1, 1, NULL, NULL, 1, 1, 'Gracias', 'Escritos Hlymboo', 'Gracias', '<p style="text-align: justify;">Bueno, bueno, terminemos esto de una vez por todas... Hola humano del mundo no virtual, o mejor deber&iacute;a de decir,&nbsp; "hola <strong>HUESPED</strong>"... A nombre de Hlymboo y de mi padre <strong>Hakyn Seyer</strong> y bla bla bla bla, te doy nuestra m&aacute;s grata bienvenida y sobre todo nuestra gratitud por visitar <strong>Hlymboo</strong>. &iexcl;Uffff!... No se cu&aacute;ntas veces he dicho esto mismo, supongo que deber&iacute;a de pedirle a mi padre una sustituci&oacute;n de trabajo; en fin no hay tiempo para replicar.</p>\r\n<p style="text-align: justify;">Ahora escuchame atentamente t&uacute; HUESPED. En Hlymboo podr&aacute;s encontrar un sin fin de fragmentos de alma mental, supongo que ustedes lo conocen como entradas, recuerdos &oacute;... &iquest;an&eacute;cdotas?... &iexcl;C&oacute;mo sea es algo que no me interesa en lo absoluto!... Como te dec&iacute;a, estos fragmentos forman parte vital del n&uacute;cleo de Hlymboo por lo que son parte de la vida del mismo, as&iacute; que cualquier perturbaci&oacute;n o anomal&iacute;a que presente <strong>Hlymboo</strong> lo sufrir&aacute;n peor sus habitantes llamados <strong>Hyzhers</strong>... As&iacute; que te pido por favor respeto y sobre todo amabilidad en tu estad&iacute;a por <strong>Hlymboo</strong>... (Pensando)-Qu&eacute; tonter&iacute;as estoy diciendo, ja, como si realmente ellos fueran as&iacute;, hasta yo misma har&iacute;a lo contrario.</p>\r\n<p style="text-align: justify;">Despu&eacute;s del serm&oacute;n que te acabo de recitar, mi siguiente deber es darte un panorama de lo que podr&aacute;s encontrar aqu&iacute;, as&iacute; que presta atenci&oacute;n:</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<ul style="text-align: justify;">\r\n<li><strong>Tipos de Fragmentos (Entradas)</strong>\r\n<ol>\r\n<li>Libros (Completos o por capitulos).</li>\r\n<li>Rese&ntilde;as (De cualquier cosa).</li>\r\n<li>Criticas (De cualquier cosa).</li>\r\n<li>Vida social (Memorias sobre la vida de un Huesped o Hyzher).</li>\r\n<li>Avisos (De cualquier cosa).</li>\r\n<li>Noticias (De cualquier cosa).</li>\r\n<li><em>Cualquier otra cosa que se le ocurra a los Hyzhers</em>.</li>\r\n</ol>\r\n</li>\r\n</ul>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">Supongo que era m&aacute;s sencillo decirte que aqu&iacute; yac&eacute;n fragmentos de cualquier clase, <strong>pero ojo</strong>, siempre existir&aacute;n reglas para el contenido, por lo que cualquier fragmento con sint&oacute;mas de peligro ser&aacute;n evaluados por el <strong>tribunal Hyzher-SH1</strong>, as&iacute; que no te ilusiones tanto Huesped, tal parece que este universo virtual es igual a tu universo real, o al menos eso quiero suponer yo.</p>\r\n<p style="text-align: justify;">Ahora si eres detallista sabr&aacute;s que Hlymboo se encuentra en una etapa joven, mi padre decidi&oacute; llamarlo fase beta privada, algo que todav&iacute;a sigo sin entender... &iquest;Qu&eacute; diablos es una beta?... Bueno el punto es el siguiente, la invitaci&oacute;n a ser parte de Hlymboo y convertirte en <strong>Hyzher</strong> esta disponible para todos los Huespedes, pero por el momento solo se podr&aacute; dar entrada a unos cuantos, debido a aspectos que no tengo permiso de comentarte por ahora. As&iacute; que si tienes inter&eacute;s en compartir tus fragmentos al mundo de <strong>Hlymboo</strong>, ser escuchado por otros Huespedes y sobre todo formar parte de la familia <strong>Hyzher</strong>, deber&aacute;s tomar en cuenta los siguientes requisitos.</p>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<ul style="text-align: justify;">\r\n<li><strong>Requisitos para publicar en HLYMBOO</strong>\r\n<ol>\r\n<li>Tener ganas de contar experiencias, historias, &oacute; cualquier clase de escrito a la comunidad de Huespedes.</li>\r\n<li>Al menos tener en mente la creaci&oacute;n de 1 personaje original para darle vida a Hlymboo.</li>\r\n<li>Entender el concepto de familia, una vez teniendo el rango de Hyzher ser&aacute;s alguien importante para nosotros.</li>\r\n<li>Respetar el trabajo de los dem&aacute;s, me refiero a no copiar, plagiar o alterar contenidos de otros sitios web sin consentimiento del autor original (s&eacute; alguien valioso, no alguien lamentable).</li>\r\n<li>Apoyar a la comunidad de Hlymboo (Nos gustar&iacute;a ver a donde puede llegar <strong>Hlymboo</strong>, hasta el m&iacute;nimo apoyo es suficiente).</li>\r\n</ol>\r\n</li>\r\n</ul>\r\n<p style="text-align: justify;">&nbsp;</p>\r\n<p style="text-align: justify;">As&iacute; que la invitaci&oacute;n est&aacute; servida, si te interesa ser valiente y dejar de ser simplemente espectador de contenidos, pues con gusto eres bienvenido a formar parte de esta familia rara, lo s&eacute; somos raros aqu&iacute; pero tambi&eacute;n especiales. As&iacute; que manda un correo al email de mi padre y con gusto &eacute;l te responder&aacute; tus dudas.</p>\r\n<p style="text-align: center;"><strong>hakynseyer@gmail.com</strong></p>', NULL, 1, 'Derechos de autor 2017 Joaquin Reyes', '2017-04-05 21:58:35', '2017-04-05 21:58:35', 0, 1);
INSERT INTO `blog` (`id_blog`, `blog_hyzher`, `blog_personaje`, `blog_fragmento`, `blog_imagen`, `blog_categoria`, `blog_clasificacion`, `blog_titulo`, `blog_familia`, `blog_url`, `blog_texto`, `blog_archivo`, `blog_archivoactivo`, `blog_derechos`, `blog_creado`, `blog_modificado`, `blog_intentos`, `blog_estado`) VALUES
(8, 1, NULL, NULL, 3, 3, 1, 'Shigatsu wa Kimi no Uso por HakynS', 'Anime Hakyns', 'Shigatsu-wa-Kimi-no-Uso-por-HakynS', '<p><strong>"Shigatsu wa Kimi no Uso"</strong> una historia original de <strong>&ldquo;Naoshi Arakawa&rdquo;</strong> y adaptada a anime por <strong>"A-1 Pictures"</strong>, siendo emitida por primera vez el 9 de Octubre del 2014 y culminando el 19 de marzo del 2015, por lo que tenemos como primera rese&ntilde;a a un anime practicamente reciente&hellip; No s&eacute; si sea una buena idea comenzar esta secci&oacute;n de rese&ntilde;as con este anime pero bueno, tarde o temprano tendr&iacute;a que salir, as&iacute; que aqu&iacute; esta.</p>\r\n<figure class="image align-center"><img src="http://a1p.jp/wp-content/uploads/2014/03/kimiuso_l.jpg" width="480" height="680" />\r\n<figcaption><strong><em>Fuente: </em></strong><a href="http://a1p.jp/works/kimiuso/" target="_blank" rel="noopener noreferrer">A-1 Pictures</a></figcaption>\r\n</figure>\r\n<p>&nbsp;</p>\r\n<h2>El Titulo</h2>\r\n<p>&nbsp;</p>\r\n<p>Cada vez que comienzo un anime siempre me da curiosidad el nombre por el cual ser&aacute; reconocido por m&iacute; a&ntilde;os despu&eacute;s, tenemos en la mayor&iacute;a de los casos animes con un t&iacute;tulo directo, otros tantos animes con un t&iacute;tulo un poco confuso y en nuestro caso tenemos <strong>"Shigatsu wa Kimi no Uso"</strong>. Al tratar de leer esto exclam&eacute;&hellip; &iexcl;Qu&eacute; diablos con este t&iacute;tulo largo!. Eso se debe a que por lo general suelo olvidar por completo animes con t&iacute;tulos largos y termino por llamarlos por sus adjetivos, por lo que para m&iacute; es el anime <strong>&ldquo;Pianista de los problemas con gafas&rdquo;</strong>, no es lo m&aacute;s original y adem&aacute;s es igual de largo, pero qu&eacute; s&eacute; yo, as&iacute; es como lo recuerdo m&aacute;s.</p>\r\n<figure class="image align-right"><img src="http://a1p.jp/wp-content/uploads/2014/03/kimiuso.gif" width="391" height="99" />\r\n<figcaption><strong><em>Fuente: </em></strong><a href="http://a1p.jp/works/kimiuso/" target="_blank" rel="noopener noreferrer">A-1 Pictures</a></figcaption>\r\n</figure>\r\n<p>En cuanto a su significado, debo de admitir que fue lo que m&aacute;s me enganch&oacute;, ya que fuera de jap&oacute;n fue nombrado como <strong>"Your Lie in April"</strong>, por lo que para nuestro idioma <strong>"Shigatsu wa Kimi no Uso"</strong> podr&iacute;a significar algo como <strong>&ldquo;Mintiendo en Abril&rdquo;</strong> &oacute; <strong>&ldquo;Tu mentira en Abril&rdquo;</strong>.</p>\r\n<p>A pesar de ser un t&iacute;tulo interesante, debo de admitir que fui enga&ntilde;ado por m&iacute; mismo al imaginar de que tratar&iacute;a este anime. Cuando me pasaron este t&iacute;tulo de anime por mensaje privado y yo sin haber visto alguna rese&ntilde;a o alguna opini&oacute;n, pens&eacute;&hellip; &iexcl;Wuaa! de seguro ser&aacute; ese tipo de anime que trate sobre un homicidio realizado por error por el protagonista y &eacute;ste &uacute;ltimo tendr&aacute; que realizar una gran haza&ntilde;a para no terminar en la c&aacute;rcel, genial.</p>\r\n<p>Pese a mi gran error, nunca me hubiera imaginado la historia profunda que guardaba consigo mismo esta historia original de <strong>"Naoshi Arakawa"</strong>.</p>\r\n<h2>El Argumento</h2>\r\n<p>&nbsp;</p>\r\n<figure class="image align-left"><img src="http://www.kimiuso.jp/assets/img/story/episode/photo/04/photo2.jpg" width="535" height="301" />\r\n<figcaption><strong><em>Fuente: </em></strong><a href="http://www.kimiuso.jp/" target="_blank" rel="noopener noreferrer">Web Oficial</a></figcaption>\r\n</figure>\r\n<p>Esta m&aacute;s que claro que este no es un anime de homicidios o detectives, pero si no lo es&hellip; &iquest;De qu&eacute; trata?... Bueno, ac&eacute;rcate peque&ntilde;o aprendiz, te lo susurrar&eacute; por el o&iacute;do&hellip; <strong>"Shigatsu wa Kimi no Uso"</strong> es un <strong>anime rom&aacute;ntico musical</strong>.</p>\r\n<p style="text-align: left;">&iexcl;&iquest;Un musical?!... Es lo que me pregunte mentalmente al ver los primeros minutos del anime y d&eacute;jame decirte que mis expectativas del anime pasaron de lo m&aacute;s alto de la monta&ntilde;a a lo m&aacute;s profundo del abismo.</p>\r\n<p style="text-align: left;">Pero no todo fue malo, ya que a pesar de ser un g&eacute;nero del cual no soy partidario, decid&iacute; darle la oportunidad y pues no me quejo, por algo he elegido este anime como mi primera rese&ntilde;a, y ahora d&eacute;jame contarte m&aacute;s a detalle de su historia.</p>\r\n<h2>La Historia</h2>\r\n<p>&nbsp;</p>\r\n<p>La historia de <strong>"Shigatsu wa Kimi no Uso"</strong> no es muy compleja y dir&iacute;a que no es uno de los puntos m&aacute;s fuertes del anime, ya que al menos para m&iacute;, cada situaci&oacute;n clim&aacute;tica era predecible minutos despu&eacute;s; eso si, hay algo rescatable, y es la excelente forma de llevar esos momentos de m&aacute;ximo cl&iacute;max de la narraci&oacute;n a la acci&oacute;n, a lo que me refiero es el c&oacute;mo se desenvuelven los personajes en&nbsp; las situaciones clave de la historia.</p>\r\n<p>Ahora s&iacute; veamos en que situaci&oacute;n nos encontramos en <strong>"Shigatsu wa Kimi no Uso"</strong>.</p>\r\n<figure class="image align-right"><img src="http://www.kimiuso.jp/assets/img/story/episode/photo/23/photo1.jpg" width="535" height="300" />\r\n<figcaption><strong><em>Fuente: </em></strong><a href="http://www.kimiuso.jp/" target="_blank" rel="noopener noreferrer">Web Oficial</a></figcaption>\r\n</figure>\r\n<p>Tenemos a un chico pianista (Me reservo los nombres para m&aacute;s adelante)&hellip; Nos presentan a este chico como una persona con un talento incre&iacute;ble para el piano, as&iacute; que tenemos a un <strong>pianista profesional</strong>. El problema de esto es que su incre&iacute;ble talento se pasa de las expectativas normales ya que es incre&iacute;ble imaginar que un chico de 6, 7 u 8 a&ntilde;os pueda dejar en la lona a pianistas amateurs o incluso algunos profesionales (espero que no sea el &uacute;nico en pensar en esto, je), al ver eso me hace pensar en lo siguiente... Para los que est&aacute;n aprendiendo a tocar piano... &iexcl;Mmmm!... Suerte con ello.</p>\r\n<p>Pero no todo es genialidad en este chico pianista, ya que la vida le dar&aacute; un golpe duro, un golpe tan duro que al mismo tiempo lo mantendr&aacute; hundido en lo m&aacute;s profundo del oc&eacute;ano, me refiero a: <strong>&ldquo;La relaci&oacute;n entre madre e hijo&rdquo;</strong>. Y es la mam&aacute; del protagonista la que para m&iacute; representa la clave maestra para introducirnos en esta historia, el &uacute;nico detalle es que estas escenas puede pasar desapercibidas al ser incluidas en cap&iacute;tulos con enfoques diferentes, quitandole importancia a estas escenas y enfocandonos m&aacute;s en otras, por lo que no llega a funcionar del todo bien.</p>\r\n<figure class="image align-center"><img src="http://www.kimiuso.jp/assets/img/story/episode/photo/09/photo4.jpg" width="700" />\r\n<figcaption><strong><em>Fuente: </em></strong><a href="http://www.kimiuso.jp/" target="_blank" rel="noopener noreferrer">Web Oficial</a></figcaption>\r\n</figure>\r\n<p>Despu&eacute;s nos encontramos al mismo chico pianista en un estado sumamente fatal, ya m&aacute;s grande (quiz&aacute;s unos 14 o 15 a&ntilde;os) y con el argumento de que ahora ya no se encuentra su madre cerca de &eacute;l (f&aacute;cil de deducir del por qu&eacute;). A ese problema se le anexa el hecho de que ahora sus dotes de pianista majestuoso pasaron a ser algo m&aacute;s cercano a un <strong>gato pianista</strong>&hellip; Solo dir&eacute; que su madre juega un papel importante para el trauma por el cual pasar&aacute; gran parte del anime este chico.</p>\r\n<p>Pasamos m&aacute;s minutos de Lorem (Contenido bla, bla, bla)&hellip; Y como si fuese una divinidad pasamos de una situaci&oacute;n triste a una situaci&oacute;n m&aacute;s alegre, nuestro peque&ntilde;o pianista ahora se encuentra en la escuela.&nbsp;</p>\r\n<p>&iexcl;Claro que nuestro pianista tiene que ir a la escuela!... No queremos que se vuelva analfabeta y dar mala ense&ntilde;anza al p&uacute;blico general, pero al llegar a esta fase m&uacute;ltiples preguntas se generan en mi mente, como&hellip; <strong>&iquest;Qui&eacute;n diablos le pagar&aacute; la colegiatura a este chico?</strong>, <strong>&iquest;por qu&eacute; hay un piano cerca de un campo de beisbol?</strong>, <strong>&iquest;d&oacute;nde diablos est&aacute;n los profesores?</strong>... A menos que me equivoque, creo que nunca se resolver&aacute;n dichas preguntas.</p>\r\n<figure class="image align-left"><img src="http://www.kimiuso.jp/assets/img/story/episode/photo/01/photo5.jpg" width="535" />\r\n<figcaption><strong><em>Fuente: </em></strong><a href="http://www.kimiuso.jp/" target="_blank" rel="noopener noreferrer">Web Oficial</a></figcaption>\r\n</figure>\r\n<p>En fin, en la escuela es donde nos encontramos a la mayor&iacute;a de los personajes con los cuales nuestro pianista de mala suerte tratar&aacute; de olvidar sus amargas experiencias. Lo siguiente no logro entender, supongo que nunca conocer&eacute; a alguien similar&hellip; <strong>&ldquo;Dos deportistas y un chico pianista&rdquo;</strong>, supongo que es la combinaci&oacute;n perfecta para un trio escolar, lo s&eacute; no estoy siendo muy optimista, pero es raro de imaginar.</p>\r\n<p>Ahora como suele suceder con los tr&iacute;os de&hellip; &iquest;Personajes principales?... Nunca est&aacute; de m&aacute;s un cuarto, &iquest;verdad?... y a pesar de que se sospecha que ya est&aacute; ocupado ese lugar por alguien m&aacute;s, pues termina por sustituirla alguien que para m&iacute; es la cereza del pastel y a la cual yo he llamado <strong>&ldquo;La chica rara del viol&iacute;n&rdquo;</strong>.</p>\r\n<figure class="image align-center"><img src="http://www.kimiuso.jp/assets/img/story/episode/photo/01/photo3.jpg" width="700" />\r\n<figcaption><strong><em>Fuente: </em></strong><a href="http://www.kimiuso.jp/" target="_blank" rel="noopener noreferrer">Web Oficial</a></figcaption>\r\n</figure>\r\n<p style="text-align: left;">&nbsp;Ahora tenemos a los dos deportistas, al chico problemas y a la chica rara del viol&iacute;n, entre los cuatro tendr&aacute;n que luchar juntos con el fin de derrotar al <strong>kaiju Godzilla</strong>, usando a su m&aacute;s fiel arma de combate su poderoso <strong>&ldquo;megazord&rdquo;</strong>&hellip; Ok, ok, estoy siendo muy pesado, pero lo siguiente te lo dej&oacute; a ti para que lo descubras por t&iacute; mismo; lo &uacute;nico que te dir&eacute; ser&aacute; lo &uacute;ltimo en este apartado.</p>\r\n<p>La relaci&oacute;n que hay entre el chico problemas y la chica rara del viol&iacute;n es tan buena que en cualquier escena en donde ellos dos aparezcan lo disfrutar&aacute;s hasta morir y habr&aacute; escenas que te har&aacute;n dudar de si existir&aacute; un romance oportuno la siguiente escena que se vean... El estudio de animaci&oacute;n lo hizo muy bien en esas escenas.</p>\r\n<h2>Los Personajes</h2>\r\n<p>&nbsp;</p>\r\n<p>Antes de mencionar los nombres de los personajes har&eacute; la siguiente pregunta para aquellos que ya han visto el anime&hellip; &iquest;Dime al menos 6 nombres de los personajes que act&uacute;an en este anime?</p>\r\n<p>S&iacute; lograste mencionarlos, pues felicidades, has amado este anime m&aacute;s que yo, por otro lado si no lo lograste pues d&eacute;jame decirte&hellip; &hellip; &hellip; &hellip;. Estas como yo.</p>\r\n<p>Ahora pasar&eacute; a expresar mis ideas para algunos personajes involucrados en este anime&hellip; Ojo, no voy a describirlos a detalle por lo que si lo deseas puedes revisar su ficha t&eacute;cnica en su wiki o en alguna otra p&aacute;gina.</p>\r\n<h3>Kousei Arima (El chico Problemas)</h3>\r\n<p>&nbsp;</p>\r\n<figure class="image align-left"><img src="http://www.kimiuso.jp/assets/img/story/episode/photo/22/photo1.jpg" width="535" />\r\n<figcaption><strong><em>Fuente: </em></strong><a href="http://www.kimiuso.jp/" target="_blank" rel="noopener noreferrer">Web Oficial</a></figcaption>\r\n</figure>\r\n<p>He aqu&iacute; a nuestro protagonista, el prodigio del piano y del cual se centrar&aacute; el anime desde el inicio hasta el final. Un chico muy tranquilo, nervioso y en algunas ocasiones, antisocial. M&aacute;s datos de &eacute;l pueden revisarlo en la red.</p>\r\n<p>Para ser <strong>un protagonista</strong> me pareci&oacute; alguien <strong>muy balanceado</strong>, el m&aacute;s real a mi punto de vista, aunque para mi tuvo un peque&ntilde;o detalle en su ni&ntilde;ez, pero pese a todo eso, me parece un buen protagonista (le falt&oacute; poco para ser alguien genial), ya que se sale del contexto de lo habitual y eso es bueno.</p>\r\n<p>Su evoluci&oacute;n a lo largo del anime fue de lo que realmente me sorprendi&oacute;, ya que en lo personal siento que fue &eacute;l <strong>el &uacute;nico que realmente avanz&oacute;</strong>, es decir, para m&iacute; fue el &uacute;nico que pudo madurar (en tan solo un capitulo pas&oacute; de un ni&ntilde;o a un hombre);&nbsp; se convirti&oacute; de aquel muchacho t&iacute;mido y hundido en la depresi&oacute;n a un muchacho con nuevas metas y sanado emocionalmente.</p>\r\n<p>Lo que no me agrado es la forma en que se relaciona con sus amigos, es decir, con los dos deportistas, ya que siento que el trato con ellos es horrible a tal grado que se asemeja al trato que realiza con sus viejos oponentes pianistas, ojo, dejamos a un lado el trato que tiene con la chica rara del viol&iacute;n porque ella es un caso especial.</p>\r\n<p>En fin, es un buen personaje, pero no alguien con el cual vaya a recordar por el resto de mi vida, ya que como pregunt&eacute; al inicio de este apartado, &eacute;l fue uno de los tantos personajes que no pude acordarme de su nombre&hellip; Lo s&eacute;, que lamentable.</p>\r\n<h3>Kaori Miyazono (La chica rara del viol&iacute;n)</h3>\r\n<p>&nbsp;</p>\r\n<figure class="image align-right"><img src="http://www.kimiuso.jp/assets/img/story/episode/photo/02/photo2.jpg" width="535" />\r\n<figcaption><strong><em>Fuente: </em></strong><a href="http://www.kimiuso.jp/" target="_blank" rel="noopener noreferrer">Web Oficial</a></figcaption>\r\n</figure>\r\n<p>Sin duda alguna <strong>la chica m&aacute;s popular del anime</strong>, y estoy completamente seguro de que a la mayor&iacute;a de la gente que ya vio el anime, es su personaje favorito. En ese sentido encuentro un punto a su favor, pero veamos a quien tenemos aqu&iacute;.</p>\r\n<p>Al inicio nos presentan a una chica tierna, amable, valiente, alegre por la vida y hasta cierto punto un poco torpe, su personalidad no es algo original pero si es un personaje que funciona muy pero muy bien. La relaci&oacute;n que mantiene con el protagonista es genial a tal grado que un romance sale de nuestras mentes al estar la escena enfocada en estos dos, no tengo objeci&oacute;n en ello.</p>\r\n<p>En cuesti&oacute;n a su evoluci&oacute;n en el anime, para m&iacute; se queda un poco debajo del protagonista, ya que hubo situaciones en las que <strong>me dej&oacute; con mal sabor de boca</strong>, y esas son las escenas del &ldquo;supuesto romance&rdquo; y aunque al final se enfoca en eso, estoy m&aacute;s que seguro que la mayor&iacute;a de los que ya vieron este anime se quedar&oacute;n con la cara de What?!!!... Really?!!!... Al no abrirse m&aacute;s sentimentalmente al protagonista y esperarse hasta el final por el argumento que narra ella.</p>\r\n<p>Algo importante a destacar de este personaje es el hecho de que se nos muestra a una Kaori como <strong>dos personas distintas</strong> aunque yo me arriesgar&eacute; a mencionar que fueron tres Kaoris distintas, por lo que hay que poner mucha atenci&oacute;n en las escenas en que ella sale y por su puesto entender m&aacute;s all&aacute; de las acciones que &eacute;sta realice, quiz&aacute;s sea necesario repetir escenas para entender mejor esto.</p>\r\n<p>Para m&iacute; y quiz&aacute;s suena mal pero&hellip; <strong>Kaori Miyazono debi&oacute; tomar el lugar de&nbsp; Kousei Arima</strong>, me refiero a que debi&oacute; ser ella la que tomara el peso de todo el anime y no Kousei, ya que siento que se hubiera creado una mejor historia alrededor de su vida y como todo lo dem&aacute;s es influenciado en ella hasta llegar a reflejar sus m&uacute;ltiples mascaras de personalidad. Algo que realmente me hubiera gustado ver.</p>\r\n<h3>Tsubaki Sawabe (Mi personaje favorito)</h3>\r\n<p>&nbsp;</p>\r\n<figure class="image align-left"><img src="http://www.kimiuso.jp/assets/img/story/episode/photo/15/photo1.jpg" width="535" />\r\n<figcaption><strong><em>Fuente: </em></strong><a href="http://www.kimiuso.jp/" target="_blank" rel="noopener noreferrer">Web Oficial</a></figcaption>\r\n</figure>\r\n<p>Qu&eacute; puedo decir de ella, fue <strong>la personaje que m&aacute;s cari&ntilde;o tuve</strong>, se gan&oacute; un acceso directo a mis recuerdos. Si pudiera har&iacute;a toda esta rese&ntilde;a contando cosas positivas de Tsubaki, pero debo de admitirlo y soy consciente de ello&hellip; Despu&eacute;s de Kousei y Kaori, <strong>todos los siguientes personajes son solamente desechables</strong> o al menos no&nbsp; fueron tan relevantes y trabajados como los dos anteriores, puedes colocar a alguien m&aacute;s que reciba su historia y para adelante con el anime.</p>\r\n<p>En fin, comenzar&eacute; con lo negativo de Tsubaki, tiene el mismo problema que la mayor&iacute;a de los siguientes personajes y esa es su falta de esencia, es decir, les falt&oacute; mucho trabajar en estos personajes. Y eso es pr&aacute;cticamente lo que <strong>los hunde en el olvido</strong>.</p>\r\n<p>Al menos con Tsubaki nos mostraron un poco la relaci&oacute;n que se cre&oacute; con Kousei en la infancia, y tambi&eacute;n un poco durante la relaci&oacute;n actual con este &uacute;ltimo.&nbsp; A pesar de que fueron solo peque&ntilde;os fragmentos en los que aparec&iacute;a la verdadera Tsubaki, <strong>me qued&eacute; satisfecho y feliz por lo que fue ella para Kousei</strong>. Sin duda alguna, si t&uacute; logras tener a alguien as&iacute; en tu vida real, ser&iacute;as un tonto si la dejaras ir.</p>\r\n<h3>Emi Igawa (La chica m&aacute;s guapa)</h3>\r\n<p>&nbsp;</p>\r\n<figure class="image align-right"><img src="http://www.kimiuso.jp/assets/img/story/episode/photo/08/photo3.jpg" width="535" />\r\n<figcaption><strong><em>Fuente: </em></strong><a href="http://www.kimiuso.jp/" target="_blank" rel="noopener noreferrer">Web Oficial</a></figcaption>\r\n</figure>\r\n<p>Como mencion&eacute; con el personaje anterior, despu&eacute;s de Kousei y Kaori todos los dem&aacute;s presentan el mismo problema, y pues Emi Igawa entra en lo mismo, falta de trabajo en el personaje. Falt&oacute; m&aacute;s por explicar ya que yo no me trago el hecho de que ella solo <strong>existe para vencer Kousei en el piano</strong>, la verdad es muy plano ese argumento.</p>\r\n<p>En fin, puse a ella en este sitio ya que en primera Emi, Kaori y Tsubaki fueron los &uacute;nicos personajes que me aprend&iacute; durante todo el transcurso del anime, lo s&eacute; es lamentable, y en segundo, porque ella se me hizo <strong>la personaje m&aacute;s linda del anime, la m&aacute;s elegante, la m&aacute;s profesional</strong>, es decir, cuando uno piensa en pianistas profesionales o al menos si me lo preguntaran a m&iacute;, la descripci&oacute;n que dar&iacute;a ser&iacute;a alguien como Emi Igawa, y eso sin haber visto antes este anime.</p>\r\n<p>Y bueno pr&aacute;cticamente eso es todo con respecto al este apartado, ya que no encuentro sentido explicar m&aacute;s personajes teniendo la wiki del anime.</p>\r\n<h2>Los Aspectos Tecnicos</h2>\r\n<p>&nbsp;</p>\r\n<h3>Openings y Endings</h3>\r\n<p>&nbsp;</p>\r\n<figure class="image align-left"><img src="http://www.kimiuso.jp/assets/img/music/07/img_photo.jpg" width="535" />\r\n<figcaption><strong><em>Fuente: </em></strong><a href="http://www.kimiuso.jp/" target="_blank" rel="noopener noreferrer">Web Oficial</a></figcaption>\r\n</figure>\r\n<p>Llegar a este punto puede llegar a ser un tremendo dolor de cabeza para m&iacute; y eso se debe a que soy una persona muy selectiva; si no m&aacute;s recuerdo en este apartado se nos presentaron dos openings y dos endings, entonces mi respuesta es&hellip; &hellip; &hellip; <strong>Los cuatro lograron vencerme</strong>, ya que tanto sus openings como sus endings me agradaron mucho, mucho, mucho.</p>\r\n<p>Hay que reconocer la verdad y esa es que no esperes a tener frente a tus ojos un majestuoso opening o ending con mucho apartado visual y sonoro, ya que realmente la historia y animaci&oacute;n no se presta para ello, por lo que simplemente te topar&aacute;s con <strong>openings y endings sencillos</strong>, sin miedo a spoiler, y con una banda sonora muy adecuado con respecto al anime. Hay veces que lo sencillo funciona muy bien y este es un ejemplo de ello.</p>\r\n<h3>Animaci&oacute;n</h3>\r\n<p>&nbsp;</p>\r\n<p><strong>Los colores son muy ricos y le dan esa sensaci&oacute;n de tranquilidad</strong> ya que no abusan tanto de luces fuertes ni oscuros demasiado tristones, por lo que es un punto fuerte a su favor, te aseguro que disfrutaras de su paleta de colores.</p>\r\n<p>El dibujo de los personajes es bueno, nada fuera de lo com&uacute;n excepto solo un detalle que al menos not&eacute; en la mayor&iacute;a si no es que en todas las mujeres, y esa es la forma en que <strong>resaltan sus labios</strong>&hellip; je no s&eacute; del por qu&eacute; me fij&eacute; en eso pero ah&iacute; lo dejo como curiosidad.</p>\r\n<figure class="image align-center"><img src="http://www.kimiuso.jp/assets/img/story/episode/photo/06/photo1.jpg" width="700" />\r\n<figcaption><strong><em>Fuente: </em></strong><a href="http://www.kimiuso.jp/" target="_blank" rel="noopener noreferrer">Web Oficial</a></figcaption>\r\n</figure>\r\n<p>Por &uacute;ltimo <strong>la animaci&oacute;n</strong> como tal&hellip; &iexcl;Puff!... Ah&iacute; si <strong>dej&oacute; a deber y mucho</strong>, ya que en ocasiones te encontrar&aacute;s con escenas en donde los pianistas y violinistas se encuentran est&aacute;ticos, mientras escuchas al mismo tiempo su interpretaci&oacute;n musical (Supongo que lo hicieron por presupuesto porque no encuentro otra raz&oacute;n coherente para justificarlo), no recuerdo hasta qu&eacute; punto puede llegar a molestar, pero si prep&aacute;rate porque abusan mucho por no decir que bastante. Otro punto a considerar y que la verdad entiendo del porque lo hicieron pero que aun as&iacute; para m&iacute; fue muy molesto, son los acercamientos laterales a las tomas en donde sal&iacute;a Kousei, y esto se debe a que en estas tomas eliminan parte del armaz&oacute;n de los lentes de Kousei con el fin de ver sus ojos&hellip; &iquest;Algo bueno o algo malo?</p>\r\n<h3>Apartado&nbsp;musical</h3>\r\n<p>&nbsp;</p>\r\n<figure class="image align-right"><img src="http://www.kimiuso.jp/assets/img/music/02/img_photo.jpg" width="535" />\r\n<figcaption><strong><em>Fuente: </em></strong><a href="http://www.kimiuso.jp/" target="_blank" rel="noopener noreferrer">Web Oficial</a></figcaption>\r\n</figure>\r\n<p>Al inicio en el argumento planteaba que se trataba de un <strong>anime rom&aacute;ntico musical</strong>, por el hecho de que los personajes principales se dedican a interpretar m&uacute;sicas cl&aacute;sicas. Aqu&iacute; depende del gusto de cada uno de ustedes. Si te gusta escuchar m&uacute;sica cl&aacute;sica, pues felicidades ya que <strong>encontrar&aacute;s muchas referencias musicales a compositores cl&aacute;sicos</strong>; ahora, si ese no es el caso pero aun quieres verla solo tienes dos opciones, la primera que adelantes dichas escenas en las que Kousei o Kaori se encuentran interpretando m&uacute;sica cl&aacute;sica o de plano mejor optes por leer su manga.</p>\r\n<p>En resumen, <strong>la animaci&oacute;n queda a deber</strong> para una historia muy entretenida, su <strong>apartado musical dentro del anime es pasable</strong> si eres una persona que suele escuchar m&uacute;sica instrumental y por &uacute;ltimo <strong>los openings y endings son el plus que motivan</strong> a ver las entradas y salidas de cada cap&iacute;tulo.&nbsp;</p>\r\n<p style="text-align: left;">&nbsp;</p>\r\n<h2>Lo que le gust&oacute; a Hakyn Seyer (Alerta de Spoiler, bajo tu responsabilidad)</h2>\r\n<p>&nbsp;</p>\r\n<p>No me voy a extender como suelo hacerlo por lo que solo dir&eacute; los puntos que m&aacute;s me gustaron y de los cuales volver&iacute;a a ver u oir una y otra vez.</p>\r\n<p style="background: #F7FDA5;"><strong>Los openings, endings y otras canciones relacionadas al anime</strong>. Mis canciones favoritas son estas tres, cuando puedo las escucho una y otra vez... &iquest;Cu&aacute;les fueron tus canciones favoritas?</p>\r\n<p><iframe src="//www.youtube.com/embed/SnXkhkEvNIM" width="560" height="314" allowfullscreen="allowfullscreen"></iframe></p>\r\n<p>&nbsp;</p>\r\n<p><iframe style="margin: 0 auto;" src="//www.youtube.com/embed/Dg_rIdKoKbY" width="560" height="314" allowfullscreen="allowfullscreen"></iframe></p>\r\n<p><iframe src="//www.youtube.com/embed/glkPhRlQlqs" width="560" height="314" allowfullscreen="allowfullscreen"></iframe></p>\r\n<p style="background: #F7FDA5;"><strong>Emi Igawa</strong>, me gust&oacute; mucho su poca participaci&oacute;n y bueno, si le&iacute;ste l&iacute;neas arriba, creo que ya queda claro del por qu&eacute; esta aqu&iacute;... &iquest;T&uacute; que opinas?</p>\r\n<figure class="image align-center"><img src="http://www.kimiuso.jp/assets/img/chara/chara6_2.png" width="535" />\r\n<figcaption>\r\n<p><strong><em>Fuente: </em></strong><a href="http://www.kimiuso.jp/" target="_blank" rel="noopener noreferrer">Web Oficial</a></p>\r\n</figcaption>\r\n</figure>\r\n<p style="text-align: left;">&nbsp;</p>\r\n<figure class="image align-left"><img src="http://www.kimiuso.jp/assets/img/story/episode/photo/11/photo2.jpg" width="535" />\r\n<figcaption>\r\n<p><strong><em>Fuente: </em></strong><a href="http://www.kimiuso.jp/" target="_blank" rel="noopener noreferrer">Web Oficial</a></p>\r\n</figcaption>\r\n</figure>\r\n<p style="background: #F7FDA5;"><strong>Capitulo 13</strong>, el mejor de todo el anime&hellip; Si pudiera pagar&iacute;a por tener ese cap&iacute;tulo y desechar&iacute;a todo lo dem&aacute;s, al diablo todo el anime salvo el cap&iacute;tulo 13, es m&aacute;s, podr&iacute;a solo hacer una rese&ntilde;a de ese cap&iacute;tulo y todo lo dem&aacute;s lo mandar&iacute;a al olvido. Para los que ya lo vieron sabr&aacute;n que ese cap&iacute;tulo trata sobre la despedida de Kousei a su mam&aacute;; la escena en la que rompe en llanto Kousei al decirle adi&oacute;s a su mam&aacute; por su interpretaci&oacute;n musical m&aacute;s los flashback que suceden a lo largo del cap&iacute;tulo&hellip;&nbsp; realmente te rompen el coraz&oacute;n. Si eres muy emp&aacute;tico como yo, sentir&aacute;s el doble de dolor ante semejante cap&iacute;tulo 13,&nbsp; ahora que si eres una persona sensible no veo otra salida m&aacute;s que prepararse para llorar. Tantos a&ntilde;os de remordimiento con entre Kousei y su mam&aacute;, realmente te hacen reflexionar y desde mi punto de vista es en este el cap&iacute;tulo en donde Kousei logr&oacute; madurar por completo&hellip; ... ... ... <strong>&ldquo;&iquest;Crees que le haya llegado a mi mam&aacute;?&rdquo;</strong>&nbsp;</p>\r\n<figure class="image align-right"><img src="http://www.kimiuso.jp/assets/img/story/episode/photo/15/photo5.jpg" width="535" />\r\n<figcaption>\r\n<p><strong><em>Fuente: </em></strong><a href="http://www.kimiuso.jp/" target="_blank" rel="noopener noreferrer">Web Oficial</a></p>\r\n</figcaption>\r\n</figure>\r\n<p style="background: #F7FDA5;"><strong>El final con Tsubaki Sawabe</strong>. No s&eacute; qu&eacute; tan despistado este, pero para m&iacute; el final de este anime me gust&oacute; bastante, y qued&eacute; satisfecho. Por un lado era m&aacute;s que claro que Kaori ten&iacute;a que morir y no es por ser malo pero para m&iacute; tiene m&aacute;s peso los lazos o v&iacute;nculos que se crearon entre Kousei y Tsubaki que los creados por Kousei y Kaori&hellip; Y me arriesgo a decir que s&iacute;, yo soy fan del romance entre Tsubaki y Kousei que el de Kousei y Kaori por lo antes mencionado. Respeto la vida de Kaori pero la verdad siento que como amistad era m&aacute;s que suficiente y Tsubaki pr&aacute;cticamente creci&oacute; con Kousei, y Kaori bueno, su enfermedad, pero Tsubaki es Tsubaki&hellip; y Kaori&hellip; &iexcl;Hay ya!... Me quedo con Tsubaki y sus patadas a las tobillos de Kousei.</p>\r\n<h2>La Calificaci&oacute;n</h2>\r\n<p>&nbsp;</p>\r\n<p>No soy de los que suele calificar cualquier cosa con n&uacute;meros, trato de evitarlo si puedo as&iacute; que para calificarlo optar&eacute; por una escala diferente y esta ser&aacute; la siguiente.</p>\r\n<p style="text-align: center;"><em><strong>Horrible-Pasable-Bueno-Excelente</strong></em></p>\r\n<p>Entonces doy a <strong>"Shigatsu wa Kimi no Uso"</strong> &nbsp;la calificaci&oacute;n de:</p>\r\n<p style="text-align: center;"><strong><em><span style="font-size: 18pt;">&iexcl;&iexcl;&iexcl; "BUENO" !!!</span></em></strong></p>\r\n<p style="text-align: center;"><strong><em><span style="font-size: 18pt;">(Recomendado para ver cuando tengas tiempo)</span></em></strong></p>\r\n<p><strong>Nota 1:</strong> Es un anime que tendr&aacute;s que ver si o si en tu vida, tu elige cuando, pero <strong>no lo recomiendo como primer anime</strong> para aquellas <strong>personas que apenas inician</strong> en el mundo del anime-manga ya que <strong>lo encontrar&aacute;s muy lento al inicio y quiz&aacute;s aburrido</strong> por las canciones cl&aacute;sicas, as&iacute; que mejor esp&eacute;rate hasta tener m&aacute;s experiencia con otros animes.</p>\r\n<p><strong>Nota 2:</strong> Si eres como yo que nunca antes ha visto un anime rom&aacute;ntico o rom&aacute;ntico musical, descuida, yo tambi&eacute;n sufr&iacute; en los primeros cap&iacute;tulos, ya que yo ven&iacute;a de ver animes muy r&aacute;pidos y de 100% golpes hasta morir. Mi sugerencia es que le des una oportunidad y si no lo soportas d&eacute;jalo, tarde o temprano le dar&aacute;s una oportunidad, te lo aseguro. Te apuesto a que en unos a&ntilde;os m&aacute;s <strong>encontrar&aacute;s todo un nuevo mundo en animes de este estilo</strong>, y pensar&aacute;s que no todo anime bueno deber&aacute; ser aquel en la que la violencia se encuentra a la esquina de cada cap&iacute;tulo.</p>\r\n<h2>El Fin</h2>\r\n<p>&nbsp;</p>\r\n<p>Sin m&aacute;s por el momento muchas gracias y cualquier aclaraci&oacute;n, reclamo, critica u opini&oacute;n, con gusto la aceptar&eacute; siempre y cuando sea con respeto, un poco de sarcasmo si gustan je, y sobre todo con mucha honestidad; muchas gracias y que el anime los guie a encontrarse a s&iacute; mismos.</p>\r\n<p><strong>Si te gusto comp&aacute;rtelo en tus redes sociales, para as&iacute; motivarme a realizar este tipo de contenido, dif&uacute;ndelo a quien creas que pueda gustarle y recuerda... Si te interesa formar parte de HLYMBOO, por favor lee las bases en la pesta&ntilde;a <a href="../Gracias">Gracias</a>, misma que se encuentra en el men&uacute; principal de esta p&aacute;gina.</strong></p>\r\n<p style="text-align: center;"><span style="font-size: 14pt;"><em>"Fracasar no significa dejar morir tus sue&ntilde;os, tan solo son un aviso para no dejarlos morir"</em></span></p>\r\n<p>&nbsp;</p>', NULL, 0, 'Derechos de autor 2017 Joaquin Reyes', '2017-04-09 02:42:54', '2017-04-09 02:42:54', 0, 1),
(12, 1, NULL, NULL, 5, 4, 1, 'Un Poco De Todo', 'Vida Hakyns', 'Un-Poco-De-Todo', '<p>A donde quiere que mires siempre existir&aacute; una segunda opci&oacute;n, no importa por donde vayas, siempre existir&aacute; ese algo por el cu&aacute;l te har&aacute; detenerte y esperar para poder elegir. Desde elegir una simple marca de refresco hasta elegir a la persona adecuada con la que pretender&aacute;s pasar el resto de vida, el mundo en si es el infierno de las elecciones, es por eso que no importa las buenas o malas decisiones que tomes, siempre existir&aacute; esa incertidumbre de saber si vas por el buen o mal camino&hellip; Eso para m&iacute; se llama vivir.</p>\r\n<p>No quiero o m&aacute;s bien no tengo ganas de contar por ahora sobre mi vida, por lo que simplemente qu&eacute;date con la idea de que soy algo m&aacute;s valioso que un pedazo de letras pasando por tu mente&hellip; &iquest;Alguna vez te has sentido conforme con las decisiones que has tomado en tu vida?... En mi caso, d&eacute;jame decirte que no, incluso me atrever&iacute;a a decir que muchas de las cosas por las que actualmente me encuentro son m&aacute;s que errores de mi vida y todo se debi&oacute; a que no me siento conforme con las elecciones que he tomado.</p>\r\n<figure class="image align-right"><img src="https://images.pexels.com/photos/3008/drinks-supermarket-cans-beverage.jpg?w=940&amp;h=650&amp;auto=compress&amp;cs=tinysrgb" alt="Refrescos" width="420" height="279" />\r\n<figcaption>CC0 License</figcaption>\r\n</figure>\r\n<p>Si t&uacute; eres de esas personas que verdaderamente sabe que elegir o por lo menos no se detiene a mirar la marca de refresco por el cual comprar, d&eacute;jame decirte que realmente te tengo envidia, ya que para m&iacute; esas peque&ntilde;as cosas son un terrible sufrimiento&hellip; Hay muchas opciones all&aacute; afuera, &iquest;cu&aacute;l elegir?...&nbsp; &iquest;cu&aacute;l es mejor?...&nbsp; &iquest;y si elijo mal?</p>\r\n<p>Entonces tal vez se pregunten&hellip; &iquest;C&oacute;mo sobre llevo esto?... Pues bueno, la respuesta a este dilema y por la cual he sobrevivido todos estos a&ntilde;os es la siguiente: <strong>&ldquo;Un poco de todo&rdquo;</strong>.</p>\r\n<p>Esa absurda frase naci&oacute; en m&iacute; de forma espont&aacute;nea y a pesar de que para m&iacute; es horrible el vivir as&iacute; ya que podr&iacute;a significar que estoy tratando de evadir los problemas, para las pocas personas que han tenido el gusto u obligaci&oacute;n de conocerme ven en m&iacute; una persona interesante... Yo mismo me siento como una persona que aparenta tener muchas facetas, me siento como el <strong>aficionado a muchas cosas</strong>, me explico m&aacute;s adelante.</p>\r\n<figure class="image align-left"><img src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg?w=940&amp;h=650&amp;auto=compress&amp;cs=tinysrgb" alt="Escritor" width="420" height="280" />\r\n<figcaption>CC0 License</figcaption>\r\n</figure>\r\n<p>Hay d&iacute;as en los que me siento escritor, otros d&iacute;as en los que me siento programador y otros d&iacute;as me siento carpintero, soldador, innovador, cocinero, mec&aacute;nico, cr&iacute;tico, maestro, estudiante, administrador, bloguero, m&uacute;sico y la lista sigue y sigue y sigue. Y para los que a estas alturas piensan que solo soy hablador o que tal vez no sea tan anormal, pues d&eacute;jame decirte que es m&aacute;s complejo de lo que se puede describir en palabras. Soy una persona que cuando se presenta una oportunidad me gusta aprenderlo hasta donde m&aacute;s pueda para seguir con otra oportunidad y nuevamente aprender. Entonces mi vida se resume as&iacute;: <strong>oportunidad-aprender-aplicar</strong>, las tres cosas en un ciclo sin fin.</p>\r\n<p>La incertidumbre, la curiosidad y el hambre por aprender un mont&oacute;n de cosas es lo que supongo me motiva para tratar de lograr satisfacer mi mente, es como si mi alma estuviera cada d&iacute;a retando a mi cuerpo a aprender algo nuevo, as&iacute; sea algo tan insignificante.</p>\r\n<p>Tal vez t&uacute; no logres ver el problema de esto, pero cuando uno pretende aprender de todo surge el principal problema y ese es el siguiente&hellip;&nbsp; <strong>&ldquo;Tratar de aprender&rdquo;</strong>&hellip; Significa que no sabes en que momento decirte a ti mismo que ya fue suficiente; &nbsp;pueden pasar minutos, horas, d&iacute;as o meses para pasar al siguiente nuevo aprendizaje. El retomar un aprendizaje viejo siempre est&aacute; a la puerta de todos d&iacute;as en mi mente, puede que en el futuro lo vuelva a retomar para reforzar o mejorar (el periodo de esto es tambi&eacute;n incierto); pero&hellip; &nbsp;&iquest;Por qu&eacute; retomar algo que ya aprend&iacute;?... Bueno, todo es debido a m&uacute;ltiples factores como pueden ser: falta de motivaci&oacute;n para continuar en su momento inicial, alguna cosa me llam&oacute; m&aacute;s la atenci&oacute;n y lo dej&eacute;, surgi&oacute; alg&uacute;n problema mayor y tengo que atenderlo, ya aprend&iacute; lo suficiente o lo necesario al momento.</p>\r\n<p>Como expres&eacute; al inicio <strong>no me considero experto para cualquier &aacute;rea</strong>, sino m&aacute;s bien soy una especie de aficionado que trata de conocer m&aacute;s sobre c&oacute;mo las personas agregan nuevos elementos a la vida. Desde compartir tutoriales de matem&aacute;ticas, hasta compartir experiencias de vida, para m&iacute; todo eso lo veo como aprendizaje (lo s&eacute; mi concepto de aprendizaje puede ser extra&ntilde;o)&hellip; &nbsp;Es como si esas personas estuvieran habl&aacute;ndome a m&iacute; para tratarme de transmitir algo importante de la vida; por lo tanto, cualquier cosa que me cause curiosidad, lo m&aacute;s seguro es que intente aprenderlo cuanto antes.</p>\r\n<figure class="image align-center"><img src="https://images.pexels.com/photos/140945/pexels-photo-140945.jpeg?w=940&amp;h=650&amp;auto=compress&amp;cs=tinysrgb" alt="Buscador" width="600" height="400" />\r\n<figcaption>CC0 License</figcaption>\r\n</figure>\r\n<p>Quiz&aacute;s el ejemplo m&aacute;s claro que pueda dar ahora es esta misma p&aacute;gina web. Tard&eacute; muchos a&ntilde;os en hacerlo realidad (Ojo, no fue realizado todo de golpe, eso s&iacute; ser&iacute;a extremadamente raro para m&iacute;), pero lo que s&iacute; quiero recalcar es el hecho de que ahora me pregunto del por qu&eacute; tuve que sufrir tanto en su realizaci&oacute;n s&iacute; pude haber creado mejor una web m&aacute;s modesta y r&aacute;pida con herramientas como Wordpress, alg&uacute;n Framework o hasta quiz&aacute;s contratar a alguien experto&hellip; Ya no importa lamentarse (Siempre lo hago cuando algo termino), al final es m&aacute;s fuerte mi deseo por seguir aprendiendo.</p>\r\n<figure class="image align-right"><img src="https://images.pexels.com/photos/270360/pexels-photo-270360.jpeg?w=940&amp;h=650&amp;auto=compress&amp;cs=tinysrgb" alt="Programando" width="420" height="279" />\r\n<figcaption>CC0 License</figcaption>\r\n</figure>\r\n<p>&iquest;Quieres saber algo raro?... Hice esta p&aacute;gina por el simple hecho de subir a gusto mis creaciones raras que se me ocurren d&iacute;a tras d&iacute;a, que tonto, teniendo tantas plataformas para subir por ejemplo mis escritos literarios del Hakyn adolescente XD,&nbsp; o mis rese&ntilde;as de anime. &iquest;Enserio tuve que optar por crear desde cero una p&aacute;gina web para satisfacerme?... &iexcl;Hummm!... Quiz&aacute;s sea una persona que ama tener el control de mis cosas&hellip;. &iexcl;&iquest;Hummm?!... qui&eacute;n sabe.</p>\r\n<p>Las elecciones son tan complicadas que ojala, y lo que digo tal vez suene fatal, pero ser&iacute;a m&aacute;s f&aacute;cil un mundo en donde existieran pocas elecciones. Lo s&eacute;, eso ser&iacute;a pr&aacute;cticamente vivir en esclavitud, pero al menos el sufrimiento m&uacute;ltiple que vivo d&iacute;a tras d&iacute;a en mi mente ser&iacute;a enfocado a otras m&aacute;s directas (tal vez m&aacute;s horribles, total la vida es un asco).</p>\r\n<p>Para el colmo es tanta mi mala suerte de poder elegir una cosa, que decid&iacute; graduarme de <strong>ingeniero industrial</strong> (Ojo, no quiero ofender a ning&uacute;n ingeniero industrial ya que yo amo lo que estudi&eacute;). C&oacute;mo sabr&aacute;n algunos, el perfil de un ingeniero industrial puede abarcar muchas cosas, lo que nos hace ser vers&aacute;tiles en muchos trabajos (No todos obvio). Para los que no sepan que es la ingenier&iacute;a industrial se los dir&eacute; a como uno de mis maestros (ing. Industrial) se refer&iacute;a&hellip; <em>Un ingeniero industrial es aquel que debe de saber de todo pero que al mismo tiempo est&aacute; bien tonto</em> (T&uacute; puedes cambiar la &uacute;ltima palabra por alg&uacute;n otro sin&oacute;nimo XD).</p>\r\n<p>Entonces <strong>saber un poco de todo</strong>&hellip; creo que me tom&eacute; esa frase muy enserio, maldito pecado. En fin, a este punto puedes pensar que soy una persona dedicada y que busca la superaci&oacute;n pero d&eacute;jame decirte que es todo lo contrario, el ambiente en mi mente es algo igual a esto&hellip; &ldquo;&iexcl;Diablos&hellip; Ya dec&iacute;dete por una sola cosa y enf&oacute;cate en eso por el resto de tu vida cab?#$4n!&rdquo;.</p>\r\n<figure class="image align-left"><img src="https://images.pexels.com/photos/60783/pexels-photo-60783.jpeg?w=940&amp;h=650&amp;auto=compress&amp;cs=tinysrgb" alt="Musico" width="420" height="279" />\r\n<figcaption>CC0 License</figcaption>\r\n</figure>\r\n<p>Cuando camino por la calle y me encuentro a alg&uacute;n m&uacute;sico tocando su guitarra para conseguir dinero, o simplemente promocionarse, me pregunto del c&oacute;mo le hizo para elegir y dedicarse a aprender profesionalmente ese espec&iacute;fico instrumento entre cientos o quiz&aacute;s miles de instrumentos musicales chidos existentes. La verdad <strong>siento envidia de personas as&iacute;</strong>.</p>\r\n<p>Quiz&aacute;s mi vida pueda parecer un asco, pero a pesar de no enfocarme en una o pocas cosas, no lamento para nada todos los aprendizajes que he adquirido en todos estos a&ntilde;os, ya que cada una significa un reto m&aacute;s por el cual he superado con &eacute;xito, adem&aacute;s de que me da seguridad el saber que siempre estar&aacute;n ah&iacute; guardados en mi mente por si en un futuro los necesite usar. Lo qu&eacute; si detesto es que por m&aacute;s que me diga a m&iacute; mismo, <strong>&ldquo;lo has hecho bien&rdquo;</strong>, nunca podr&eacute; sentirme conforme con lo que tengo, siempre quiero ir m&aacute;s all&aacute;&hellip; Errores tras errores en m&iacute; retorcida mente.</p>\r\n<p>Otra cosa a recalcar es el hecho de que cuando estoy enfocado en algo nuevo, digamos un &aacute;rea &ldquo;A&rdquo;, siempre me viene a la cabeza la incertidumbre de pensar sobre el &aacute;rea &ldquo;B&rdquo; que dejaste interrumpido d&iacute;as atr&aacute;s (es decir, lo dejaste a medias y no lo terminaste como quer&iacute;as). &iexcl;Aaaaaay! Esa sensaci&oacute;n de que no puedes olvidarlo y dejarlo en el olvido, lo aborrezco mucho&hellip; Es m&aacute;s, al momento de escribir esto, estoy pensando sobre la culminaci&oacute;n de un capitulo que dej&eacute; a medias de un libro que estoy escribiendo ahora.</p>\r\n<p>Creo que ya fue suficiente mencionar la mediocridad de m&iacute; vida diaria, as&iacute; que intentar&eacute; pensar positivamente, por lo que aqu&iacute; te pongo algunas de las ventajas que seg&uacute;n yo he experimentado con los a&ntilde;os... Quiz&aacute;s t&uacute; seas como yo o quiz&aacute;s hayas conocido a alguien similar a m&iacute;.</p>\r\n<ul style="border-left: solid 3px #34A873; border-radius: 12px;">\r\n<li><strong>Aprendizaje diario:</strong> Siempre, pero siempre lograr&aacute;s aprender algo nuevo cada d&iacute;a, hasta lo m&aacute;s insignificante es muy valioso&hellip; Es una necesidad a superar.</li>\r\n<li><strong>Somos menos tontos:</strong> Al realizar ciertas cosas por ti mismo, te hace menos ingenuo y m&aacute;s astuto cuando tengas que realizar trabajos en equipo o cuando solicitas la ayuda de alguien experto; este &uacute;ltimo igual te podr&aacute; marear con su experiencia, pero estoy m&aacute;s que seguro que sufrir&aacute; un poco m&aacute;s antes de lograrlo.</li>\r\n<li><strong>Activos las 24 horas:</strong> Siempre hay algo que hacer, desde realizar alg&uacute;n trabajo en el hogar, hasta programar una web o escribir. No tenemos horario de salida, por lo que saliendo de tu trabajo ordinario siempre habr&aacute; algo que hacer en tu casa... M&aacute;s que trabajo yo dir&iacute;a que es pasi&oacute;n por hacer algo, un s&uacute;per-hobby.</li>\r\n<li><strong>Multifuncional:</strong> Dependiendo de lo que estudiaste, siempre tendr&aacute;s el plus de ponerte el sobrenombre de algo m&aacute;s: &ldquo;M&uacute;sico, Escritor, Programador, Cocinero, Planeador, Supervisor, Mec&aacute;nico, Fontanero, etc&rdquo;&hellip; y lo mejor de todo es que puedes demostrarlo con acciones debido a que si lo sabes hacer (Ojo, no ser&aacute;s perfecto pero si&nbsp; ser&aacute;s muy h&aacute;bil).</li>\r\n<li><strong>Creativo ante problemas:</strong> Hay ciertos problemas que por m&aacute;s que intentes pensar cuadradamente (Sin salir del ambiente) no podr&aacute;s resolverlo f&aacute;cilmente, pero si eres como yo, tendr&aacute;s experiencias m&uacute;ltiples y podr&aacute;s combinarlos para resolver el problema en tiempo record (Tal vez no se vea profesional pero igual funciona muy bien). Es gracioso ver la reacci&oacute;n de los dem&aacute;s al verte solucionar dicho problema a tu estilo alocado.</li>\r\n</ul>\r\n<p>Ahora como todo no puede ser perfecto te menciono algunas de las desventajas por las que personas como yo sufren de esta terrible maldici&oacute;n.</p>\r\n<ul style="border-left: solid 3px #920707; border-radius: 12px;">\r\n<li><strong>No conformista:</strong> Siempre estar&aacute; presente esa voz que te dir&aacute;, &ldquo;lo pudiste hacer de esta otra forma&rdquo;&hellip; es algo horrible.</li>\r\n<li><strong>Falta de tiempo:</strong> Por m&aacute;s r&aacute;pido que vayas, siempre te faltar&aacute; tiempo. Deseamos d&iacute;as de 48 horas.</li>\r\n<li><strong>Antisociales:</strong> El tiempo invertido por aprender cosas nuevas, como el asistir a cursos de paga, ver video-tutoriales en internet o simplemente experimentar por tu propia cuenta consume mucho de tu vida social, por lo que solo tendr&aacute;s pocos amigos y ni se diga de la dificultad para relaciones amorosas&hellip; &iexcl;Maldito tiempo!</li>\r\n<li><strong>Dificultad para ser convencido:</strong> Debido a que tienes hasta cierto punto el conocimiento de otras &aacute;reas, siempre te quedar&aacute; la duda de si realmente el camino por el que la otra persona sugiere es la m&aacute;s adecuada&hellip; y es mucho peor cuando la otra persona es como t&uacute; (cr&eacute;eme lo he vivido).</li>\r\n<li><strong>Vamos al grano:</strong> Al no disponer de mucho tiempo y por necedad de no hacerlo de la forma normal debido al gran consumo de tiempo, siempre intentar&aacute;s ir lo m&aacute;s r&aacute;pido posible para terminar cierta actividad y continuar con otra cosa, por lo que siempre tendr&aacute;s que realizar dos o tres tareas simult&aacute;neas a la vez. Este problema es mucho peor cuando interact&uacute;as con personas, dile adi&oacute;s al rollo argumental sin sentido, no hay tiempo para eso por lo que vamos al grano&hellip; &iexcl;Dios! hay tantas an&eacute;cdotas graciosas que podr&iacute;a contar.</li>\r\n</ul>\r\n<p>Es insuficiente explicar todo en palabras, ya que hay muchas cosas que faltan por explicar y algunas otras m&aacute;s que simplemente no se pueden explicar con palabras sino m&aacute;s bien con acciones. Solo espero que ustedes los lectores puedan entender el como soy, aunque sea un poco.</p>\r\n<p>En fin,&nbsp; me gustar&iacute;a saber que opinan ustedes los reales, sobre personas como yo&hellip; &iquest;Has conocido a alguien similar a m&iacute;?, &iquest;Qu&eacute; experiencias tienes con gente similar a m&iacute;?... S&eacute; libre en opinar con respeto sobre este tema, sin m&aacute;s por ahora me despido con esta &uacute;ltima palabra, adi&oacute;s.</p>\r\n<figure class="image align-center"><img src="https://images.pexels.com/photos/28216/pexels-photo.jpg?w=940&amp;h=650&amp;auto=compress&amp;cs=tinysrgb" alt="Escritor" width="600" height="400" />\r\n<figcaption>CC0 License</figcaption>\r\n</figure>\r\n<p>&nbsp;</p>', NULL, 0, 'Derechos de autor 2017 Joaquin Reyes', '2017-04-29 22:06:55', '2017-04-29 22:06:55', 0, 1),
(13, 1, NULL, NULL, NULL, 2, 2, 'Historias Hlymboo 01-jrs', 'Hlymboo 01-jrs', 'Historias-Hlymboo-01-jrs', '<p><span data-offset-key="fj7es-0-0">-&iquest;D&oacute;nde me encuentro?... ... ... &iquest;En qu&eacute; clase de realidad alterna me encuentro?... &iexcl;</span><span data-offset-key="fj7es-0-1">&Ntilde;ia,&ntilde;ia,&ntilde;ia</span><span data-offset-key="fj7es-0-2">!, supongo que debo comenzar por algo. &iexcl;Huuummm!, creo que mis piernas no responden a mi llamado, &iexcl;&ntilde;</span><span data-offset-key="fj7es-0-3">ia, &ntilde;ia, &ntilde;ia</span><span data-offset-key="fj7es-0-4">!... Puedo ver a lo lejos una especie de fortaleza, una taberna y algo que parece asemejarse a un burdel... &iquest;A d&oacute;nde deber&iacute;a ir? </span></p>', NULL, 0, 'Todos los derechos reservados Joaquín Reyes Sánchez', '2017-08-30 22:16:46', '2017-08-30 22:16:46', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categoria`),
  UNIQUE KEY `categoria_tipo` (`categoria_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria_tipo`) VALUES
(3, 'Anime'),
(1, 'Avisos | Comunicados'),
(2, 'Libros'),
(4, 'Realidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacion`
--

CREATE TABLE IF NOT EXISTS `clasificacion` (
  `id_clasificacion` int(11) NOT NULL AUTO_INCREMENT,
  `clasificacion_tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_clasificacion`),
  UNIQUE KEY `clasificacion_tipo` (`clasificacion_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `clasificacion`
--

INSERT INTO `clasificacion` (`id_clasificacion`, `clasificacion_tipo`) VALUES
(2, 'Público +15'),
(1, 'Todo Hlymboo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunicado`
--

CREATE TABLE IF NOT EXISTS `comunicado` (
  `id_comunicado` int(11) NOT NULL AUTO_INCREMENT,
  `comunicado_hyzher` int(11) NOT NULL,
  `comunicado_pagina` int(11) NOT NULL,
  `comunicado_numero1` varchar(255) NOT NULL,
  `comunicado_numero2` varchar(255) DEFAULT NULL,
  `comunicado_numero3` varchar(255) DEFAULT NULL,
  `comunicado_creado` datetime NOT NULL,
  PRIMARY KEY (`id_comunicado`),
  KEY `comunicado_hyzher` (`comunicado_hyzher`),
  KEY `comunicado_pagina` (`comunicado_pagina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles`
--

CREATE TABLE IF NOT EXISTS `detalles` (
  `id_detalles` int(11) NOT NULL AUTO_INCREMENT,
  `detalles_hyzher` int(11) NOT NULL,
  `detalles_fragmentos` int(11) NOT NULL,
  `detalles_personajes` int(11) NOT NULL,
  `detalles_tareas` int(11) NOT NULL,
  `detalles_leyendas` int(11) NOT NULL,
  `detalles_prestigio` double NOT NULL,
  PRIMARY KEY (`id_detalles`),
  KEY `detalles_hyzher` (`detalles_hyzher`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `detalles`
--

INSERT INTO `detalles` (`id_detalles`, `detalles_hyzher`, `detalles_fragmentos`, `detalles_personajes`, `detalles_tareas`, `detalles_leyendas`, `detalles_prestigio`) VALUES
(1, 1, 3, 2, 4, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fragmento`
--

CREATE TABLE IF NOT EXISTS `fragmento` (
  `id_fragmento` int(11) NOT NULL AUTO_INCREMENT,
  `fragmento_hyzher` int(11) NOT NULL,
  `fragmento_titulo` varchar(255) NOT NULL,
  `fragmento_lado1` text NOT NULL,
  `fragmento_lado2` text NOT NULL,
  `fragmento_creado` datetime NOT NULL,
  `fragmento_modificado` datetime NOT NULL,
  `fragmento_intentos` int(11) NOT NULL,
  `fragmento_estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_fragmento`),
  UNIQUE KEY `fragmento_titulo` (`fragmento_titulo`),
  KEY `fragmento_hyzher` (`fragmento_hyzher`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE IF NOT EXISTS `grado` (
  `id_grado` int(11) NOT NULL AUTO_INCREMENT,
  `grado_tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_grado`),
  UNIQUE KEY `grado_tipo` (`grado_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`id_grado`, `grado_tipo`) VALUES
(1, 'Kyzher');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hyzher`
--

CREATE TABLE IF NOT EXISTS `hyzher` (
  `id_hyzher` int(11) NOT NULL AUTO_INCREMENT,
  `hyzher_nombre` varchar(255) NOT NULL,
  `hyzher_alias` varchar(255) NOT NULL,
  `hyzher_email` varchar(255) NOT NULL,
  `hyzher_grado` int(11) NOT NULL,
  `hyzher_llave` varchar(255) NOT NULL,
  `hyzher_pregunta1` varchar(255) NOT NULL,
  `hyzher_respuesta1` varchar(255) NOT NULL,
  `hyzher_pregunta2` varchar(255) NOT NULL,
  `hyzher_respuesta2` varchar(255) NOT NULL,
  `hyzher_creado` datetime NOT NULL,
  `hyzher_modificado` datetime NOT NULL,
  `hyzher_estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_hyzher`),
  UNIQUE KEY `hyzher_alias` (`hyzher_alias`),
  UNIQUE KEY `hyzher_email` (`hyzher_email`),
  KEY `hyzher_grado` (`hyzher_grado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `hyzher`
--

INSERT INTO `hyzher` (`id_hyzher`, `hyzher_nombre`, `hyzher_alias`, `hyzher_email`, `hyzher_grado`, `hyzher_llave`, `hyzher_pregunta1`, `hyzher_respuesta1`, `hyzher_pregunta2`, `hyzher_respuesta2`, `hyzher_creado`, `hyzher_modificado`, `hyzher_estado`) VALUES
(1, 'Joaquin Reyes Sanchez', 'Hakyn Seyer', 'hakynseyer@gmail.com', 1, '$2y$10$dhCcvrHXVT9XoCsKcFnVcOT7n7EOkT6WG/DfAlh9wV0GmWCT.D.BO', 'Mi mayor miedo', 'La muerte', 'Mi pasatiempo favorito', 'Soñar despierto', '2017-04-05 21:45:37', '2017-04-05 21:45:37', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE IF NOT EXISTS `imagen` (
  `id_imagen` int(11) NOT NULL AUTO_INCREMENT,
  `imagen_hyzher` int(11) NOT NULL,
  `imagen_titulo` varchar(255) NOT NULL,
  `imagen_familia` varchar(255) NOT NULL,
  `imagen_ruta` varchar(255) NOT NULL,
  `imagen_fuente` varchar(255) NOT NULL,
  `imagen_notas` varchar(255) NOT NULL,
  `imagen_creado` datetime NOT NULL,
  `imagen_modificado` datetime NOT NULL,
  `imagen_intentos` int(11) NOT NULL,
  `imagen_estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_imagen`),
  UNIQUE KEY `imagen_titulo` (`imagen_titulo`),
  UNIQUE KEY `imagen_ruta` (`imagen_ruta`),
  KEY `imagen_hyzher` (`imagen_hyzher`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id_imagen`, `imagen_hyzher`, `imagen_titulo`, `imagen_familia`, `imagen_ruta`, `imagen_fuente`, `imagen_notas`, `imagen_creado`, `imagen_modificado`, `imagen_intentos`, `imagen_estado`) VALUES
(3, 1, 'SWKNU1', 'Anime Hakyn', '/home/hlymsxma/public_html/puerta/hyzher/imagenes/SWKNU1.jpg', '© Naoshi Arakawa', 'Anime Shigatsu wa Kimi no Uso... Autor original por Naoshi Arakawa', '2017-04-09 02:20:18', '2017-04-09 02:45:53', 3, 1),
(4, 1, 'Hzoul-PL', 'Libros Hakyn', '/home/hlymsxma/public_html/puerta/hyzher/imagenes/Hzoul-PL.jpg', '© Joaquin Reyes', 'Portada de mi libro Hzoul el precio de la libertad', '2017-04-20 01:40:38', '2017-04-20 01:41:14', 1, 1),
(5, 1, 'HakynSentado', 'Real Hakyn', '/home/hlymsxma/public_html/puerta/hyzher/imagenes/HakynSentado.jpg', '© Joaquin Reyes', 'Hakyn Seyer sentado y mirando algo extraño en la calle, durante el atardecer del pueblo donde vivo.', '2017-04-30 00:19:40', '2017-04-30 00:19:48', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `indicador`
--

CREATE TABLE IF NOT EXISTS `indicador` (
  `id_indicador` int(11) NOT NULL AUTO_INCREMENT,
  `indicador_blog` int(11) NOT NULL,
  `indicador_vistas` int(11) DEFAULT NULL,
  `indicador_gustados` int(11) DEFAULT NULL,
  `indicador_disgustados` int(11) DEFAULT NULL,
  `indicador_motivacion` double DEFAULT NULL,
  PRIMARY KEY (`id_indicador`),
  KEY `indicador_blog` (`indicador_blog`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE IF NOT EXISTS `ingreso` (
  `id_ingreso` int(11) NOT NULL AUTO_INCREMENT,
  `ingreso_user` varchar(255) NOT NULL,
  `ingreso_pass` varchar(255) NOT NULL,
  `ingreso_email` varchar(255) NOT NULL,
  `ingreso_estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_ingreso`),
  UNIQUE KEY `ingreso_user` (`ingreso_user`),
  UNIQUE KEY `ingreso_email` (`ingreso_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `ingreso`
--

INSERT INTO `ingreso` (`id_ingreso`, `ingreso_user`, `ingreso_pass`, `ingreso_email`, `ingreso_estado`) VALUES
(1, 'Kyna-HL001F', '$2y$10$KbCXD8kvQlZcq9NW9VOgM.nZ54QNlQnm2pWqjZAOh9wSMFn9Zio9S', 'hakynseyer@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `leyenda`
--

CREATE TABLE IF NOT EXISTS `leyenda` (
  `id_leyenda` int(11) NOT NULL AUTO_INCREMENT,
  `leyenda_hyzher` int(11) NOT NULL,
  `leyenda_personaje` int(11) DEFAULT NULL,
  `leyenda_escrito` varchar(88) NOT NULL,
  PRIMARY KEY (`id_leyenda`),
  UNIQUE KEY `leyenda_escrito` (`leyenda_escrito`),
  KEY `leyenda_personaje` (`leyenda_personaje`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nucleo`
--

CREATE TABLE IF NOT EXISTS `nucleo` (
  `id_nucleo` int(11) NOT NULL AUTO_INCREMENT,
  `nucleo_hyzher` int(11) NOT NULL,
  `nucleo_familia` varchar(255) NOT NULL,
  `nucleo_cerradura` varchar(255) NOT NULL,
  `nucleo_creado` datetime NOT NULL,
  PRIMARY KEY (`id_nucleo`),
  KEY `nucleo_hyzher` (`nucleo_hyzher`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opinion`
--

CREATE TABLE IF NOT EXISTS `opinion` (
  `id_opinion` int(11) NOT NULL AUTO_INCREMENT,
  `opinion_hyzher` int(11) DEFAULT NULL,
  `opinion_blog` int(11) NOT NULL,
  `opinion_texto` text NOT NULL,
  `opinion_spam` int(11) NOT NULL,
  `opinion_hyzh` int(11) DEFAULT NULL,
  `opinion_creado` datetime NOT NULL,
  `opinion_estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_opinion`),
  KEY `opinion_hyzher` (`opinion_hyzher`),
  KEY `opinion_blog` (`opinion_blog`),
  KEY `opinion_spam` (`opinion_spam`),
  KEY `opinion_hyzh` (`opinion_hyzh`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagina`
--

CREATE TABLE IF NOT EXISTS `pagina` (
  `id_pagina` int(11) NOT NULL AUTO_INCREMENT,
  `pagina_nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id_pagina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `perfil_hyzher` int(11) NOT NULL,
  `perfil_imagen` int(11) DEFAULT NULL,
  `perfil_fragmento` int(11) DEFAULT NULL,
  `perfil_nacimiento` date NOT NULL,
  `perfil_lugar` varchar(255) NOT NULL,
  `perfil_soy` text NOT NULL,
  `perfil_social1` varchar(255) DEFAULT NULL,
  `perfil_social2` varchar(255) DEFAULT NULL,
  `perfil_social3` varchar(255) DEFAULT NULL,
  `perfil_social4` varchar(255) DEFAULT NULL,
  `perfil_etiqueta` varchar(255) DEFAULT NULL,
  `perfil_estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_perfil`),
  KEY `perfil_hyzher` (`perfil_hyzher`),
  KEY `perfil_imagen` (`perfil_imagen`),
  KEY `perfil_fragmento` (`perfil_fragmento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personaje`
--

CREATE TABLE IF NOT EXISTS `personaje` (
  `id_personaje` int(11) NOT NULL AUTO_INCREMENT,
  `personaje_hyzher` int(11) NOT NULL,
  `personaje_imagen` int(11) DEFAULT NULL,
  `personaje_nombre` varchar(255) NOT NULL,
  `personaje_familia` varchar(255) NOT NULL,
  `personaje_edad` varchar(255) NOT NULL,
  `personaje_sexo` varchar(255) NOT NULL,
  `personaje_relacion` varchar(255) NOT NULL,
  `personaje_personalidad` text NOT NULL,
  `personaje_historia` text NOT NULL,
  `personaje_metas` text NOT NULL,
  `personaje_extras` text NOT NULL,
  `personaje_creado` datetime NOT NULL,
  `personaje_modificado` datetime NOT NULL,
  `personaje_intentos` int(11) NOT NULL,
  `personaje_estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_personaje`),
  UNIQUE KEY `personaje_nombre` (`personaje_nombre`),
  KEY `personaje_hyzher` (`personaje_hyzher`),
  KEY `personaje_imagen` (`personaje_imagen`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `personaje`
--

INSERT INTO `personaje` (`id_personaje`, `personaje_hyzher`, `personaje_imagen`, `personaje_nombre`, `personaje_familia`, `personaje_edad`, `personaje_sexo`, `personaje_relacion`, `personaje_personalidad`, `personaje_historia`, `personaje_metas`, `personaje_extras`, `personaje_creado`, `personaje_modificado`, `personaje_intentos`, `personaje_estado`) VALUES
(1, 1, NULL, 'Khallyt Hzeyer', 'Hlymboo', 'Desconocido', 'Femenino', '<p><p>Hija de Hakyn Seyer</p></p>', '<p>Desconocido</p>', '<p>Desconocido</p>', '<p>Desconocido</p>', '<p>Desconocido</p>', '2017-04-05 21:55:46', '2017-04-05 21:55:53', 1, 1),
(2, 1, NULL, 'Personaje misterioso ', 'Hlymboo', 'desconocido', 'masculino', '<p><p><p>de otra dimensión</p></p></p>', '<p>Desconocido</p>', '<p>Desconocido</p>', '<p>Desconocido</p>', '<p>Desconocido</p>', '2017-08-30 22:15:29', '2017-08-30 22:15:33', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planeacion`
--

CREATE TABLE IF NOT EXISTS `planeacion` (
  `id_planeacion` int(11) NOT NULL AUTO_INCREMENT,
  `planeacion_blog` int(11) NOT NULL,
  `planeacion_proceso` int(11) NOT NULL,
  `planeacion_etapa1` datetime DEFAULT NULL,
  `planeacion_etapa2` datetime DEFAULT NULL,
  `planeacion_etapa3` datetime DEFAULT NULL,
  `planeacion_etapa4` datetime DEFAULT NULL,
  `planeacion_etapa5` datetime DEFAULT NULL,
  `planeacion_etapa6` datetime DEFAULT NULL,
  PRIMARY KEY (`id_planeacion`),
  KEY `planeacion_blog` (`planeacion_blog`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `planeacion`
--

INSERT INTO `planeacion` (`id_planeacion`, `planeacion_blog`, `planeacion_proceso`, `planeacion_etapa1`, `planeacion_etapa2`, `planeacion_etapa3`, `planeacion_etapa4`, `planeacion_etapa5`, `planeacion_etapa6`) VALUES
(1, 1, 80, '2017-04-05 21:58:18', '2017-04-05 22:00:40', '2017-04-05 22:34:34', '2017-06-05 02:13:20', NULL, NULL),
(2, 2, 60, '2017-04-05 21:58:35', '2017-04-05 21:59:49', '2017-04-05 22:34:29', NULL, NULL, NULL),
(8, 8, 60, '2017-04-09 02:42:54', '2017-04-11 01:33:52', '2017-04-12 19:57:00', NULL, NULL, NULL),
(12, 12, 60, '2017-04-29 22:06:55', '2017-04-30 13:27:52', '2017-05-01 13:00:05', NULL, NULL, NULL),
(13, 13, 60, '2017-08-30 22:16:46', '2017-08-30 22:20:55', '2017-08-30 22:22:02', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `spam`
--

CREATE TABLE IF NOT EXISTS `spam` (
  `id_spam` int(11) NOT NULL AUTO_INCREMENT,
  `spam_tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`id_spam`),
  UNIQUE KEY `spam_tipo` (`spam_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `spam`
--

INSERT INTO `spam` (`id_spam`, `spam_tipo`) VALUES
(1, 'Normal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE IF NOT EXISTS `tarea` (
  `id_tarea` int(11) NOT NULL AUTO_INCREMENT,
  `tarea_blog` int(11) NOT NULL,
  `tarea_planeacion` int(11) DEFAULT NULL,
  `tarea_descripcion` varchar(255) NOT NULL,
  `tarea_programada` date NOT NULL,
  `tarea_estado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_tarea`),
  KEY `tarea_blog` (`tarea_blog`),
  KEY `tarea_planeacion` (`tarea_planeacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD CONSTRAINT `archivo_ibfk_1` FOREIGN KEY (`archivo_hyzher`) REFERENCES `hyzher` (`id_hyzher`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`blog_hyzher`) REFERENCES `hyzher` (`id_hyzher`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `blog_ibfk_2` FOREIGN KEY (`blog_personaje`) REFERENCES `personaje` (`id_personaje`) ON UPDATE CASCADE,
  ADD CONSTRAINT `blog_ibfk_3` FOREIGN KEY (`blog_fragmento`) REFERENCES `fragmento` (`id_fragmento`) ON UPDATE CASCADE,
  ADD CONSTRAINT `blog_ibfk_4` FOREIGN KEY (`blog_imagen`) REFERENCES `imagen` (`id_imagen`) ON UPDATE CASCADE,
  ADD CONSTRAINT `blog_ibfk_5` FOREIGN KEY (`blog_categoria`) REFERENCES `categoria` (`id_categoria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `blog_ibfk_6` FOREIGN KEY (`blog_clasificacion`) REFERENCES `clasificacion` (`id_clasificacion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `blog_ibfk_7` FOREIGN KEY (`blog_archivo`) REFERENCES `archivo` (`id_archivo`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `comunicado`
--
ALTER TABLE `comunicado`
  ADD CONSTRAINT `comunicado_ibfk_1` FOREIGN KEY (`comunicado_hyzher`) REFERENCES `hyzher` (`id_hyzher`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comunicado_ibfk_2` FOREIGN KEY (`comunicado_pagina`) REFERENCES `pagina` (`id_pagina`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD CONSTRAINT `detalles_ibfk_1` FOREIGN KEY (`detalles_hyzher`) REFERENCES `hyzher` (`id_hyzher`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `fragmento`
--
ALTER TABLE `fragmento`
  ADD CONSTRAINT `fragmento_ibfk_1` FOREIGN KEY (`fragmento_hyzher`) REFERENCES `hyzher` (`id_hyzher`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `hyzher`
--
ALTER TABLE `hyzher`
  ADD CONSTRAINT `hyzher_ibfk_1` FOREIGN KEY (`hyzher_grado`) REFERENCES `grado` (`id_grado`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`imagen_hyzher`) REFERENCES `hyzher` (`id_hyzher`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `indicador`
--
ALTER TABLE `indicador`
  ADD CONSTRAINT `indicador_ibfk_1` FOREIGN KEY (`indicador_blog`) REFERENCES `blog` (`id_blog`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `leyenda`
--
ALTER TABLE `leyenda`
  ADD CONSTRAINT `leyenda_ibfk_1` FOREIGN KEY (`leyenda_personaje`) REFERENCES `personaje` (`id_personaje`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `nucleo`
--
ALTER TABLE `nucleo`
  ADD CONSTRAINT `nucleo_ibfk_1` FOREIGN KEY (`nucleo_hyzher`) REFERENCES `hyzher` (`id_hyzher`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `opinion`
--
ALTER TABLE `opinion`
  ADD CONSTRAINT `opinion_ibfk_1` FOREIGN KEY (`opinion_hyzher`) REFERENCES `hyzher` (`id_hyzher`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `opinion_ibfk_2` FOREIGN KEY (`opinion_blog`) REFERENCES `blog` (`id_blog`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `opinion_ibfk_3` FOREIGN KEY (`opinion_spam`) REFERENCES `spam` (`id_spam`) ON UPDATE CASCADE,
  ADD CONSTRAINT `opinion_ibfk_4` FOREIGN KEY (`opinion_hyzh`) REFERENCES `opinion` (`id_opinion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`perfil_hyzher`) REFERENCES `hyzher` (`id_hyzher`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `perfil_ibfk_2` FOREIGN KEY (`perfil_imagen`) REFERENCES `imagen` (`id_imagen`) ON UPDATE CASCADE,
  ADD CONSTRAINT `perfil_ibfk_3` FOREIGN KEY (`perfil_fragmento`) REFERENCES `fragmento` (`id_fragmento`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `personaje`
--
ALTER TABLE `personaje`
  ADD CONSTRAINT `personaje_ibfk_1` FOREIGN KEY (`personaje_hyzher`) REFERENCES `hyzher` (`id_hyzher`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personaje_ibfk_2` FOREIGN KEY (`personaje_imagen`) REFERENCES `imagen` (`id_imagen`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `planeacion`
--
ALTER TABLE `planeacion`
  ADD CONSTRAINT `planeacion_ibfk_1` FOREIGN KEY (`planeacion_blog`) REFERENCES `blog` (`id_blog`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD CONSTRAINT `tarea_ibfk_1` FOREIGN KEY (`tarea_blog`) REFERENCES `blog` (`id_blog`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tarea_ibfk_2` FOREIGN KEY (`tarea_planeacion`) REFERENCES `planeacion` (`id_planeacion`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
