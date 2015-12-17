<?php
	//include 'biblioteca.php';//Gera Warning se .php nao existir
	//require 'biblioteca2.php';//Gera Error se .php nao existir
	//include_once 'biblioteca.php';//Inclui só uma vez
	//require 'biblioteca2.php';//Inclui só uma vez
	$mensagem = "Mensagem em PHP";//String
	$peso = 1.3;//Float	
	$valor = 3;//Inteiro
	$soma = $peso + $valor;
	$varBool = TRUE;
	$carros = array('Cadillac','Ferrari','Mustang','Ferrari');
	$vazio = NULL;
	
	Class Computador{//Objeto
		var $cpu;
		function ligar(){
			echo ("Ligou a $this->cpu<br />");
		}
		function contar(){
			$vazio = 0;
			while($vazio < 5){
				echo $vazio;
				$vazio++;
			}
			echo '<br />';
		}
		function contar2(){
			for($vazio = 0; $vazio < 6; $vazio += 2){
				echo $vazio;
			}
			echo '<br />';
		}
		function verifica($a){
			switch($a){
				case 0:
					echo ('Zero<br />');
					break;
				case 1:
					echo ('Um<br />');
					break;
				default:
					echo ('Diferente de Zero e Um<br />');
			}
		}
		function exibir(){
			global $carros;//Referencia o array fora da classe
			foreach($carros as $carro){
				echo ("$carro<br />");
			}
		}
	}
	
	define("PI",3.14);//Constante
	$a = "10";//Usado para converção automatica
	
	//static $total;//armazena o valor da ultima execução
	//excelente para se usar em função que é muito chamada
	
	//function incrementa(&$variavel, $valor)
	//& é para as alterações serem na variavel passada
	//igual aos ponteiros em C++
	
	//Função com quantidade de argumentos variaveis
	function ola(){
		$argumentos = func_get_args();
		$quantidade = func_num_args();
		for($n=0; $n<$quantidade; $n++){
			echo 'Ola ' . $argumentos[$n];
		}
		echo '<br />';
	}
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Inicio PHP</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<!-- <link rel="stylesheet" type="text/css" href="" media="screen"/>

		<script type="text/javascript" src=""></script> -->
	</head>
	<body>
		<h1>Inicio PHP</h1>
		<div>			
			<?php
				//echo 'echo<br />';
				echo 'Soma = $soma<br />';
				echo "Soma = $soma<br />";
				echo "Mensagem = $mensagem<br />";
				
				$graus = 90;
				$angRetangulo = ($graus == 90); //TRUE
				if($angRetangulo){
					echo ('Angulo Retangulo<br />');
				}
				echo ("Carro = $carros[0]<br />");
				
				$objComputador = new Computador();
				$objComputador->cpu = "500Mhz";
				$objComputador->ligar();
				$objComputador->contar();
				$objComputador->contar2();
				$objComputador->verifica(2);
				$objComputador->exibir();
				
				echo (4+5-1*7)%2 . '<br />';//0
				echo $a + 5 . '<br />';//15
				
				ola('Dom','Pedro','Segundo');
				
				//Manipulação de Arquivo
				//$arq = fopen("../File.txt","r");
				//$arq = fopen("http://www.x.com","w");
				//$arq = fopen("ftp://user:password@x.com","wb");
				
				//Enquanto nao chegou no EOF
				/*
				while(!feof($arq)){
					//le uma linha do arquivo
					$buffer = fgets($arq,4096);
					//Imprime a linha
					echo $buffer;
				}
				fclose($arq);
				*/
				
				/*
				fwrite($arq,"Linha 1\n");
				fwrite($arq,"Linha 2\n");
				fclose($arq);
				*/
				
				//le todo o arquivo
				//echo file_get_contents("../File.txt");
				
				//le todo o arquivo, cada posição no array é uma linha
				//$arq = file("../File.txt");
				//echo $arq[0];
				//echo $arq[1];
				
				//COPIA UM ARQUIVO
				//$origem = "../File.txt";
				//$destino = "../File2.txt";
				//if(copy($origem,$destino)){
					//echo "Copia realizada";
				//}
				
				//RENOMEIA UM ARQUIVO/PASTA
				//$origem = "../File.txt";
				//$destino = "../File2.txt";
				//if(rename($origem,$destino)){
					//echo "Renomeação realizada";
				//}
				
				//APAGA UM ARQUIVO
				//$arq = "../File.txt";
				//if(unlink($arq)){
					//echo "Arquivo apagado";
				//}
				
				//VERIFICA SE UM ARQUIVO EXISTE
				//$arq = "../File.txt";
				//if(file_exists($arq)){
					//echo "Arquivo existe";
				//}
				
				//Existe outras função para manipulação
				//de Arquivos e Pastas
				
				//Concatenação
				$fruta = "Maçã";
				$salario = 400;
				echo $fruta .' é a fruta de Adão<br />';
				echo "{$fruta} é a fruta de Adão<br />";
				echo "O salario é $salario<br />";
				echo 'O salario é ' . $salario . '<br />';
				
				echo strtoupper('MaiscuLo<br />');
				
				$str = substr('América',1);
				echo $str . '<br />';
				$str = substr('América',1,3);
				echo $str . '<br />';
				$str = substr('América',0,-1);
				echo $str . '<br />';
				$str = substr('América',-2);
				echo $str . '<br />';
				
				$str = "Texto";
				echo str_pad($str,20,'*',STR_PAD_LEFT) . '<br />';
				echo str_pad($str,20,'*',STR_PAD_BOTH) . '<br />';
				echo str_pad($str,20,'*') . '<br />';
				
				echo str_repeat($str,3) . '<br />';
				
				echo strlen($str) . '<br />';
				
				echo str_replace('T','Z',$str) . '<br />';
				
				echo strpos($str,'x') . '<br />';
				
				$carros[2] = 'Camaro';
				echo $carros[2] . '<br />';
				
				//Array Associativos
				$cores = array('vermelho' => 'ff0000');
				$cores['preto'] = '000000';
				foreach($cores as $cor){
					echo $cor . '<br />';
				}
				foreach($cores as $chave => $cor){
					echo $chave . ' => ' . $cor . '<br />';
				}
				
				//Arrays Multidimencionais
				$carros2 = array('Palio' => 
									array('cor' => 'azul','potencia' => '1.0'),
								'Gol' =>
									array('cor' => 'vermelho','potencia' => '1.4')
								);
				echo $carros2['Palio']['cor']. '<br />';
				foreach($carros2 as $modelo => $caracteristicas){
					echo $modelo . '<br />';
					foreach($caracteristicas as $caracteristica => $valor){
						echo $caracteristica . ' => ' . $valor . '<br />';
					}	
				}
				
				//Adiciona ao elemento ao final
				$a = array(1,2,3,4);
				array_push($a,5);
				var_dump($a);
				echo '<br />';
				
				//Remove elemento ao final	
				array_pop($a);
				var_dump($a);
				echo '<br />';
				
				//Remove elemento do inicio	
				array_shift($a);
				var_dump($a);
				echo '<br />';
				
				//Adiciona elemento no inicio	
				array_unshift($a,6);
				var_dump($a);
				echo '<br />';
				
				//Reverter ordem do array
				$b = array_reverse($a, true);
				var_dump($b);
				echo '<br />';
				
				//Concatenar arrays, se ambos tiverem as mesmas
				//chaves o segundo sobrepoem o primeiro
				$c = array_merge($a,$b);
				var_dump($c);
				echo '<br />';
				
				//Retornas as chaves de um array
				$indices = array_keys($cores);
				print_r($indices);
				echo '<br />';
				
				//Retorna o valor da chave
				$valor = array_keys($cores,'ff0000');
				print_r($valor);
				echo '<br />';
				
				//Retornas os valores de um array
				$valores = array_values($cores);
				print_r($valores);
				echo '<br />';
				
				//Extrair porção de array
				$carros3 = array_slice($carros,0,2);
				print_r($carros3);
				echo '<br />';
				
				//Conta quantas posições tem o array
				echo count($a) . '<br />';
				
				//Verifica se o array tem determinado valor 
				//Retorna 1 se tiver
				echo in_array('Ferrari',$carros) . '<br />';
					
				//Ordena array pelo seu valor, 
				//Não mantem associação de indices
				sort($carros);
				print_r($carros);
				echo '<br />';
				
				//Ordena array pelo seu valor reverso, 
				//Não mantem associação de indices
				rsort($carros);
				print_r($carros);
				echo '<br />';
				
				//Ordena array pelo seu valor, 
				//Mantem associação de indices
				//fazer reverso: arsort($carros);
				asort($carros);
				print_r($carros);
				echo '<br />';
				
				//Ordena array pelo seu indices
				//fazer reverso: krsort($cores);
				ksort($cores);
				print_r($cores);
				echo '<br />';
				
				//Converte uma string em um array, separando os
				//elementos por meio de um separador
				$str2 = '12/02/2013';
				$arr = explode('/',$str2);
				print_r($arr);
				echo '<br />';
				
				//Converte um array em uma string, juntando os
				//elementos por meio de um caracter
				$data = implode('/',$arr);
				echo $data . '<br />';
			?>
		</div>
	</body>
</html>

<!-- 
	OPERADORES RELACIONAIS
	== Igual
	=== Igual até os Tipos
	!= ou <> Diferente
	> Maior que
	< Menor que
	>= Maior ou Igual que
	<= Menor ou Igual que
	
	OPERADORES LOGICOS
	and "E" Retorna TRUE se ambos forem verdadeiros
	or "OU" Retorna TRUE se algum for verdadeiro
	xor "OU EXCLUSIVO" Retorna TRUE se algum for verdadeiro mas não ambos
	! Nega o operando (inverte valor/tipo)
	&& "E" Retorna TRUE se ambos forem verdadeiros
	|| "OU" Retorna TRUE se algum for verdadeiro
	and e or (Tem maior precedencia)
-->