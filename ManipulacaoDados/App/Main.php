<?php
	/*****************************************************/
	
	//Abre Conexão com o MySql
	$dbHost = 'localhost:3306';//Local e Porta de acesso ao Banco de Dados
	$dbUser = 'root';//Login do Banco de Dados
	$dbPass = '';//Senha do Banco de Dados
	$dbName = 'livro';//Nome do Banco de Dados que Trabalharemos
	$conn = new mysqli($dbHost,$dbUser,$dbPass,$dbName);//Cria Objeto Conexão com Banco

	if($conn){
		echo "Conexão Estabelecida com $dbName<br />";
	}else{
		die('Não foi possível conectar: ' . mysqli_connect_error());
	}
	
	/*****************************************************/
	
	//Cria e Executa Query INSERT
	$codigo = 99;//Codigo do livro a ser inserido no Banco
	$nome = 'O Magico de OZ';//Nome do livro a ser inserido no Banco
	//Query 1 de Inserção de $codigo e $nome
	$sqlInsert1 = $conn->prepare("INSERT INTO famosos (codigo, nome) VALUES (?, ?);");
	$sqlInsert1->bind_param('is',$codigo,$nome);
	//true se conseguir executar a Sql no Banco
	$sqlOK = $sqlInsert1->execute();
	
	if($sqlOK){
		echo 'Query executado com sucesso<br />';
	}else{
		echo 'Não foi possuivel executar a Query';
	}
	
	/*****************************************************/
	
	//Cria e Executa Query SELECT
	$sqlSelect1 = $conn->prepare("SELECT codigo, nome FROM famosos WHERE codigo = ?;");
	$sqlSelect1->bind_param('i', $codigo);//Variavel criada no INSERT
	$sqlSelect1->execute();
	$sqlSelect1->bind_result($cod,$nom);
	
	print '<table border="1">';
	while($sqlSelect1->fetch()){
		print '<tr>';
		print '<td>'.$cod.'</td>';
		print '<td>'.$nom.'</td>';
		print '</tr>';
	}   
	print '</table>';
	
	/*****************************************************/
	
	//Cria e Executa Query UPDATE
	$sqlUpdate1 = $conn->prepare("UPDATE famosos SET nome = 'Sobrenatural' WHERE codigo = ?;");
	$sqlUpdate1->bind_param('i', $codigo);//Variavel criada no INSERT
	$sqlUpdate1->execute();

	/*****************************************************/
	
	//Cria e Executa Query DELETE
	$sqlDelete1 = $conn->prepare("DELETE FROM famosos WHERE codigo = ?;");
	$sqlDelete1->bind_param('i', $codigo);//Variavel criada no INSERT
	$sqlDelete1->execute();
	
	/*****************************************************/
	
	//Fecha conexão com o Banco
	$desconn = $conn->close();//true se conseguir se desconectar com o Banco
	
	if($desconn){
		echo 'Conexão Encerrada<br />';
	}else{
		echo 'Conexão ainda Não Encerrada<br />';
	}	
?>