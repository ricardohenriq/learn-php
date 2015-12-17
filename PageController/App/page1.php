<?php
/* 1ª Exemplo de passagem de parametros pela URL
* page1.php?method=olaMundo&nome=Ricardo
* page1.php?class=Clientes&method=listar
*/
	include_once '../app.widgets/TElement.class.php';
	include_once '../app.widgets/TPage.class.php';
	
	function olaMundo($param){
		echo 'Ola ' . $param['nome'] . '<br />';
	}
	
	class mundo{
		function helloWorld($param){
			echo 'Hello ' . $param['nome'] . '<br />';
		}
	}
	
	$pagina = new TPage();
	$pagina->show();
?>