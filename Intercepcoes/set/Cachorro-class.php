<?php
	class Cachorro{
		private $nascimento;
		private $nome;
		
		function __construct($nome){
			$this->nome = $nome;
		}
		
		//Intecepta Atribuição de valores a uma variavel
		function __set($propriedade,$valor){
			if($propriedade == 'nascimento'){//$propriedade == Atributo/Variavel
				//Verifica se o $valor é dividido em 3 partes separadas por '/'
				if(count(explode('/',$valor))==3){
					echo "Dado valor: $valor foi atribuido a propriedade: $propriedade<br />";
					$this->$propriedade = $valor;
				}else{
					echo "Dado valor: $valor não foi atribuido a propriedade: $propriedade<br />";
				}
			}
		}
	}
?>