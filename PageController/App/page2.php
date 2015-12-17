<?php
/* 1ª Exemplo de passagem de parametros pela URL
* atraves do clique de em links
*/

	function __autoload($classe){
		if(file_exists("../app.widgets/$classe.class.php")){
			include_once "../app.widgets/$classe.class.php";
		}
	}
	
	/* Método onProdutos()
	* Executado quando o usuario clicar no link Produtos
	* @param $get = variavel $_GET
	*/
	function onProdutos($get){
		echo 'Produto 1<br /> 
			Produto 2 Produto 3<br />
			Produto 4<br />';
	}
	
	/* Método onContatos()
	* Executado quando o usuario clicar no link Contatos
	* @param $get = variavel $_GET
	*/
	function onContatos($get){
		echo '9999-9999<br /> 
			8888-8888<br />
			7777-7777<br />';
	}
	
	/* Método onEmpresa()
	* Executado quando o usuario clicar no link Empresa
	* @param $get = variavel $_GET
	*/
	function onEmpresa($get){
		echo 'Empresa<br /> 
			de 1982<br />
			Barra Funda<br />';
	}
	
	//Exibe Links
	echo "<a href='?method=onProdutos'>Produtos</a><br />";
	echo "<a href='?method=onContatos'>Contatos</a><br />";
	echo "<a href='?method=onEmpresa'>Empresa</a><br />";
	
	$pagina = new TPage();
	$pagina->show();
?>