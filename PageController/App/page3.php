<?php
/* Abstração e Emcapsulamento do envio dos controles
* page1.php?method=olaMundo&nome=Ricardo
* page1.php?class=Clientes&method=listar
* Pela Classe TAction
*/
	include_once '../app.widgets/TAction.class.php';
	
	class pessoa{
		private $nome;
		
		function setNome($parametro){
			echo 'setNome executado<br />';
		}
	}
	
	function printName($parametro){
		echo 'printName executado<br />';
	}
	
	$objPessoa = new pessoa();
	$action1 = new TAction(array($objPessoa,'setNome'));
	$action1->setParameter('nome','Bill');
	echo $action1->serialize() . '<br />';
	
	$action2 = new TAction('printName');
	$action2->setParameter('nome','Jobs');
	echo $action2->serialize() . '<br />';
?>