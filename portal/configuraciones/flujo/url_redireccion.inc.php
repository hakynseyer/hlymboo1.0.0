<?php
class redireccion{
	public function redirigir($enlace){
		header('Location:'.$enlace,true,301);
		exit();
	}
}