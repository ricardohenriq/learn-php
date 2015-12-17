<?php
	include_once 'Produto-class.php';
	
	$produto = new Produto(1,'Pendrive',1,345.67);
	echo $produto->preco . '<br />';	
?>