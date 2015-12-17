<?php
	abstract class Conta{
		public $agencia;
		public $codigo;
		public $dataDeCriacao;
		public $titular;
		public $senha;
		public $saldo;
		public $cancelada;
		
		/* Método Constutor Completo
		* Inicializa Todos os Atributos
		*/
		function __construct($ag="",$cod="",$dt="",$tit="",$sen="",$sal=""){
			$this->agencia = $ag;
			$this->codigo = $cod;
			$this->dataDeCriacao = $dt;
			$this->titular = $tit;
			$this->senha = $sen;
			$this->cancelada = false;
			
			//Chamada a metodos
			$this->depositar($sal);	
		}
		
		/* Metodo Destrutor
		* Finaliza o Objeto
		*/
		function __destruct(){
			//Método pode ficar vazio
			echo "Objeto $this->codigo Destruido<br />";
		}
		
		/* Método retirar
		* Diminui $saldo em $quantia
		*/
		public function retirar($quantia){
			if($quantia > 0){
				$this->saldo -= $quantia;
			}
		}
		
		/* Método depositar
		* Almenta $saldo em $quantia
		*/
		public function depositar($quantia){
			if($quantia > 0){
				$this->saldo += $quantia;
			}
		}
		
		/* Método obterSaldo
		* Retorna o $saldo
		*/
		public function obterSaldo(){
			return $this->saldo;
		}
		
		/* Método transferirValor
		* Método abstrato que transfere valor de uma conta a outra
		*/
		abstract public function transferirValor($conta,$valor);
	}
?>