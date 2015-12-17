<?php
	//Interpreta o Documento XML
	$xml1 = simplexml_load_file('../Arquivos/XML1.xml');
	
	//Exibe as informações do Objeto criado
	var_dump($xml1);
	echo '<br />';
	
	//Acessando propriedades diretamente
	echo 'Pais: ' . $xml1->nome . '<br />';
	
	//Acessando propriedades indiretamente
	foreach($xml1->children() as $elemento => $valor){
		echo $elemento . ' => ' . $valor . '<br />';
	}
	
	/************************************************/
	
	//Interpreta o Documento XML
	$xml2 = simplexml_load_file('../Arquivos/XML2.xml');
	
	//Exibe as informações do Objeto criado
	var_dump($xml2);
	echo '<br />';
	
	//Acessando propriedades diretamente
	echo 'Pais: ' . $xml2->nome . '<br />';
	echo 'Costa: ' . $xml2->geografia->costa . '<br />';
	
	/************************************************/
	
	//Interpreta o Documento XML
	$xml3 = simplexml_load_file('../Arquivos/XML3.xml');
	
	//Alteração de Propriedades
	$xml3->nome = 'EUA';
	$xml3->geografia->clima = 'Frio';
	
	//Adiciona Nodos
	$xml3->addChild('presidente','Fernando Henrique');
	$xml3->geografia->addChild('catastrofe','Tornado');
	
	//Exibindo o XML
	echo $xml3->asXML() . '<br />';
	var_dump($xml3);
	echo '<br />';
	
	//Grava no arquivo
	//file_put_contents('../Arquivos/XML3.xml',$xml3->asXML());
	
	/************************************************/
	
	//Interpreta o Documento XML
	$xml4 = simplexml_load_file('../Arquivos/XML4.xml');
	
	//Acessando diretamente pelo Indice
	echo $xml4->municipios->nome[0] . '<br />';
	echo $xml4->municipios->nome[1] . '<br />';
	
	//Acessando indiretamente
	foreach($xml4->municipios->nome as $municipio){
		echo 'Municipio: ' . $municipio . '<br />';
	}
	
	//Acessando e Imprimindo Tags com Atributos diretamente
	foreach($xml4->estados->estado as $estado){
		echo str_pad('Estado: ' . $estado['nome'],40) . 
			'Capital: ' . $estado['capital'] . '<br />';
	}
	
	//Acessando e Imprimindo Tags com Atributos indiretamente
	foreach($xml4->estados->estado as $estado){
		foreach($estado->attributes() as $key => $valor){
			echo "$key => $valor<br />";
		}
	}
	
?>