<?php
	class Funcionario{
		public $cargo;
		public $nome;
		public $id = 123;
		
		public function setCargo($car){
			$this->cargo = $car;
		}
		public function getCargo(){
			return $this->cargo;
		}
		
		public function setNome($no){
			$this->nome = $no;
		}
		public function getNome(){
			return $this->nome;
		}
		
		public function printNomeCargo($arr){
			echo 'Nome = ' . $arr[0] .  '<br />';
			echo 'Cargo = ' . $arr[1] .  '<br />';
		}
	}
	
	class Estagiario extends Funcionario{
		public $bolsa;
		
		public function setBolsa($bol){
			$this->bolsa = $bol;
		}
		public function getBolsa(){
			return $this->bolsa;
		}
	}
	
	function hello(){
		echo 'Hello World' .  '<br />';
	}
	
	function sayMessage($mens){
		echo "$mens" .  '<br />';
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Manipular Objetos</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<!-- <link rel="stylesheet" type="text/css" href="" media="screen"/>

		<script type="text/javascript" src=""></script> -->
	</head>
	<body>
		<h1>Manipular Objetos</h1>
		<div>	
			<?php
				$objFuncionario = new Funcionario();
				$objFuncionario->setNome('Ricardo');
				$objFuncionario->setCargo("Gerente de Projetos");
				echo $objFuncionario->getNome() . '<br />';
				echo $objFuncionario->getCargo() . '<br />';
				
				$objEstagiario = new Estagiario();
				$objEstagiario->setNome('Luthor');
				$objEstagiario->setCargo("Auxiliar Administrativo");
				$objEstagiario->setBolsa(434);
				echo $objEstagiario->getNome() . '<br />';
				echo $objEstagiario->getCargo() . '<br />';
				echo $objEstagiario->getBolsa() . '<br />';
				
				//Pega Metodos e Variaveis da Classe
				print_r(get_class_methods('Funcionario'));
				echo '<br />';
				print_r(get_class_vars('Funcionario'));
				echo '<br />';
				
				//Pega Variaveis do Objeto
				print_r(get_object_vars($objFuncionario));
				echo '<br />';
				
				//Retorna nome da Classe
				echo get_class($objFuncionario) .  '<br />';
				
				//Retorna nome da Classe Ancestral
				echo get_parent_class($objEstagiario) .  '<br />';
				//echo get_parent_class('Estagiario') .  '<br />';
				
				//Verifica se Objeto/Classe é uma subclasse
				//Retorna 1 se verdadeiro
				echo is_subclass_of('Estagiario','Funcionario') .  '<br />';
				
				//Chamada Simples, Metodo fora de Classe sem parametro
				call_user_func('hello');
				
				//Chamada Simples, Metodo fora de Classe com parametro
				call_user_func('sayMessage','Olá Mundo');
				
				//Metodo dentro de Classe com parametro
				call_user_func(array($objFuncionario,'printNomeCargo'),array('Bill','CEO'));
				
				//Metodo dentro de Classe sem parametro
				//call_user_func(array($objFuncionario,'printNomeCargo'));
				
				//Metodo Estatico (static) dentro de Classe sem parametro
				//call_user_func(array(Funcionario,'printNomeCargo'));
			?>
		</div>
	</body>
</html>