<?php
	include_once '../Classes/Fornecedor-class.php';
	include_once '../Classes/Produto-class.php';
	include_once '../Classes/Cesta-class.php';
	include_once '../Classes/Contato-class.php';
	
	$objForncedor = new Fornecedor(123,'Limitada SA','Rua 99','Rondonopolis');
	print_r($objForncedor);
	echo '<br />';
	
	$objProduto = new Produto(456,'Chocolate',1.23,4,$objForncedor);
	$objProduto2 = new Produto(867,'Leite',2.13,9,$objForncedor);
	$objProduto3 = new Produto(358,'Amendoin',3.93,2,$objForncedor);
	print_r($objProduto);
	echo '<br />';
	//PRODUTO E FORNECEDOR TEM UMA "ASSOCIAÇÃO"
	
	$cesta = new Cesta();
	$cesta->adicionaItem($objProduto);
	$cesta->adicionaItem($objProduto2);
	$cesta->adicionaItem($objProduto3);
	
	echo 'Total: ' . $cesta->calculaTotal() . '<br />';
	echo $cesta->exibeLista();
	//CESTA E PRODUTO TEM UMA "AGREGAÇÃO"
	
	$objForncedor->contato->setContato('Pedro','9999-9999','pedro@gmail');
	echo $objForncedor->contato->getContato();
	//CONTATO E FORNECEDOR TEM UM "COMPOSIÇÃO"
	
	
?>