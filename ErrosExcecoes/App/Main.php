<?php
	include_once '../Classes/OpenFile-class.php';
	include_once '../Classes/ParameterException-class.php';
	include_once '../Classes/FileNotFoundException-class.php';
	include_once '../Classes/FilePermitionException-class.php';
	
	//Usando Função die()
	$arquivo = OpenFile::abrir('../Arquivos/Arquivo.txt');
	echo $arquivo . '<br />';
	
	//Verificando Flag retornada
	$arquivo = OpenFile::abrir2('../Arquivos/Arquivo2.txt');
	if($arquivo){
		echo $arquivo . '<br />';
	}else{
		echo 'Arquivo Inexistente' . '<br />';
	}
	
	//Tratando Erro
	//Define a função OpenFile::manipulaErro como a manipuladora de Erros
	set_error_handler('OpenFile::manipulaErro');
	$arquivo = OpenFile::abrir3('../Arquivos/Arquivo2.txt');
	
	//Tratando Exceções
	try{
		$arquivo = OpenFile::abrir4('../Arquivos/Arquivo2.txt');
	}catch(Exception $e){
		echo $e->getFile() . ' : ' . $e->getline() . ' # ' . $e->getMessage() . '<br />';
	}
	
	//Tratando Exceções com Exceções Proprias
	try{
		$arquivo = OpenFile::abrir4();
	}catch(ParameterException $e){
		echo $e->getFile() . ' : ' . $e->getline() . ' # ' . $e->getMessage() . '<br />';
	}catch(FileNotFoundException $e){
		echo $e->getFile() . ' : ' . $e->getline() . ' # ' . $e->getMessage() . '<br />';
	}catch(FilePermitionException $e){
		echo $e->getFile() . ' : ' . $e->getline() . ' # ' . $e->getMessage() . '<br />';
	}
?>