<?php
	class Pessoa{
		public $codigo;
		public $nome;
		public $altura;
		public $idade;
		public $nascimento;
		public $escolaridade;
		public $salario;
		public $contas;
				
		/* Método Constutor Completo
		* Inicializa Todos os Atributos
		*/
		function __construct($cod="",$nom="",$alt="",$ida="",$nasc="",$esc="",$sal=""){
			$this->codigo = $cod;
			$this->nome = $nom;
			$this->altura = $alt;
			$this->idade = $ida;
			$this->nascimento = $nasc;
			$this->escolaridade = $esc;
			$this->salario = $sal;
			$this->conta = NULL;
		}
		
		/* Metodo Destrutor
		* Finaliza o Objeto
		*/
		function __destruct(){
			//Método pode ficar vazio
			echo "Objeto $this->codigo Destruido<br />";
		}
		
		/* Método crescer
		* Aumenta a Altura em $centimetros
		* Não pode ser sobrescrito por classes filhas
		*/
		final function crescer($centimetros){
			if($centimetros > 0){
				$this->altura += $centimetros;
			}
		}
		
		/* Método formar
		* Altera a $escolaridade para $titulacao
		*/
		function formar($titulacao){
			$this->escolaridade = $titulacao;
		}
		
		/* Método envelhecer
		* Almenta a $idade em $anos
		*/
		function envelhecer($anos){
			if($anos > 0){
				$this->idade += $anos;
			}
		}
	}
?>