<?php
	//Carrega as Bibliotecas (Uma unica vez)
	include_once '../Classes/Funcionario-class.php';
	include_once '../Classes/Estagiario-class.php';
	
	$pedro = new Funcionario();
	$pedro->setSalario(550);
	echo $pedro->getSalario() . '<br />';
	
	$joao = new Estagiario();
	$joao->setSalario(550);
	echo $joao->getSalario() . '<br />';
	
	echo $joao::EMPRESA . '<br />';
	$classFunc = "Funcionario";
	echo $classFunc::EMPRESA . '<br />';
	
	echo $pedro::$diasDeTrabalho . '<br />';
	echo Funcionario::$diasDeTrabalho . '<br />';
	$pedro::$diasDeTrabalho = 300;
	echo Estagiario::$diasDeTrabalho . '<br />';
	
	Funcionario::imprime('../Arquivos/readme.txt');
?>