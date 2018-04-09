<!DOCTYPE html>
<html lang="es" prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta name="description" content="Visita Hlymboo, el sitio en donde encontrarás cualquier tipo de fragmento informativo... desde blogs, reseñas, criticas, libros o demás. Ven y encuentra algún fragmento interesante el día de hoy.">
	<meta name="author" content="Joaquín Reyes S.">
	<meta name="language" content="es">
	<meta property="og:title" content="HLYMBOO" />
	<meta property="og:type" content="Website" />
	<meta property="og:image" content="http://hlymboo.com/portal/complementos/imagenes/LogotipoHlymboo.jpg" />
	<meta property="og:description" 
  	content="Visita Hlymboo, el sitio en donde encontrarás cualquier tipo de fragmento informativo... desde blogs, reseñas, criticas, libros o demás. Ven y encuentra algún fragmento interesante el día de hoy." />
	<link rel='shortcut icon' href= '<?php echo FAVICON;?>' />
	<base href="<?php echo HLYMBOO;?>">
	<?php
	if (isset($Titulo) && !empty($Titulo)) {
		?>
		<title><?php echo $Titulo;?></title>
		<?php
	}else{
		?>
		<title>Blog de Hakin Seyer</title>
		<?php
	}
	?>
	<link rel="stylesheet" href="<?php echo ESTILOS;?>">
	<link rel="stylesheet" href="<?php echo FAWESOME;?>">
	<script src="<?php echo JQUERY;?>"></script>
	
	<?php
		if (isset($Hyzher) && $Hyzher == true) {
			?>
			<script src="<?php echo AJAX_HYZHER;?>"></script>
			<?php
			if (isset($Script) && !empty($Script)) {
				?>
				<script src="<?php echo $Script;?>"></script>
				<?php
			}
		}
	?>
</head>
<body oncontextmenu="return true">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-96991245-1', 'auto');
  ga('send', 'pageview');
</script>