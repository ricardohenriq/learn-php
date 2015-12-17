<?php
	//Carrega as Bibliotecas (Uma unica vez)
	include_once '../Classes/Conta-class.php';
	include_once '../Classes/ContaCorrente-class.php';
	include_once '../Classes/ContaPoupanca-class.php';
	include_once '../Classes/Pessoa-class.php';
	
	//Criação de um Objeto Pessoa
	$ricardo = new Pessoa();
	$ricardo->codigo = 9;
	$ricardo->nome = 'Ricardo';
	$ricardo->altura = '1.85';
	$ricardo->idade = 19;
	$ricardo->nascimento = '19/09/1992';
	$ricardo->escolaridade = 'Ensino Superior';
	$ricardo->contas = NULL;
	print_r($ricardo);
	echo '<br /><br />';
	
	//Criação de Objeto Conta (Descendentes)
	$contas[0] = new ContaCorrente(6677,'cc.343.1234','12/11/2010',$ricardo,12345,567.89,120.00);
	$contas[1] = new ContaPoupanca(6677,'pp.343.1234','12/11/2010',$ricardo,12345,567.89,'12/1992');
	print_r($contas[0]);
	echo '<br /><br />';
	print_r($contas[1]);
	echo '<br /><br />';
	
	//Atrelando as Contas a Pessoa
	$ricardo->contas = $contas;
	echo 'Numero da conta corrente: ' . $ricardo->contas[0]->codigo . '<br />';
	echo 'Numero da conta poupança: ' . $ricardo->contas[1]->codigo . '<br />';
	
	//Testando Métodos
	$ricardo->envelhecer(1);
	echo 'Ricardo tem ' . $ricardo->idade . ' anos' . '<br />';
	
	
	
	//AO FINAL DO SCRIPT OS DESCONSTUTORES
	//SÃO CHAMADOS AUTOMATICAMENTE, MAS
	//PODEM SEREM CHAMADOS A QUALQUER MOMENTO
?>