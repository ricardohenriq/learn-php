<?php
	include_once 'Produto-class.php';
		
	$produto = new Produto(789,'Pendrive',15,345.67);
	$produto->vender(10);
	echo $produto . '<br />';
	echo $produto->toXml() . '<br />';
	
?>