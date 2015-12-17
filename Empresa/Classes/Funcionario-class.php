<?php
	class Funcionario{
		public $codigo;
		public $nome;
		protected $salario;
		private $nascimento;
		const EMPRESA = 'XXX';
		static $diasDeTrabalho = 200;
		
		/* Método setSalari
		* Atribui  parametro $sal a propriedade $salario
		*/
		public function setSalario($sal){
			if(is_numeric($sal)&&($sal > 0)){
				$this->salario = $sal;
			}
		}
		
		public function getSalario(){
			return $this->salario;
		}
		
		static function imprime($caminho){
			$arq = fopen($caminho,'r');
			while($linha = fgets($arq,200)){
				echo $linha . '<br />';
			}
		}
	}
?>