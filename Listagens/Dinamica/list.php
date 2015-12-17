<?php
/*
* Lista Dinamica com BD
*/
	//Exibe inicio da tabela
	echo '<table border="1">
			<tr style="background-color:#c0c0c0">
				<td></td>
				<td width="70">Codigo</td>
				<td width="140">Nome</td>
				<td width="70">Telefone</td>
			</tr>';
	
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
	
	//Cria e Executa Query SELECT
	$sqlSelect1 = $conn->prepare("SELECT codigo, nome, telefone FROM nerd LIMIT 3;");
	$sqlSelect1->execute();
	$sqlSelect1->bind_result($cod,$nom,$tel);
	
	while($sqlSelect1->fetch()){
		echo "<tr>
				<td><a href=\"edit.php?id=$cod\"><img border=\"0\" src=\"app.images/ico_edit.png\"/></a></td>
				<td align=\"left\">$cod</td>
				<td align=\"left\">$nom</td>
				<td align=\"left\">$tel</td>
			</tr>";
	}
	
	echo '</table>';
	
	//Fecha conexão com o Banco
	$desconn = $conn->close();//true se conseguir se desconectar com o Banco
	
	if($desconn){
		echo 'Conexão Encerrada<br />';
	}else{
		echo 'Conexão ainda Não Encerrada<br />';
	}
?>