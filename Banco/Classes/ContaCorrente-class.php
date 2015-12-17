<?php
	class ContaCorrente extends Conta{
		public $limite;
		
		/* Método Construtor (Sobrescrito)
		* Agora, também inicializa a Variavel $limite
		*/
		function __construct($ag="",$cod="",$dt="",$tit="",$sen="",$sal="",$lim=""){
			//Chamada ao Método Construtor da Classe Pai
			parent::__construct($ag,$cod,$dt,$tit,$sen,$sal);
			$this->limite = $lim;
		}
		
		/* Método Retirar (Sobrescrito)
		* Verifica se há $saldo para retirar a $quantia
		* e se esta dentro do $limite
		*/
		function retirar($quantia){
			if(($this->saldo + $this->saldo) >= $quantia){
				//Executa metodo da Classe Pai
				parent::retirar($quantia);
				
				//Imposto sobre movimentação financeira
				$cpmf = 0.05;
				//Debita o Imposto
				parent::retirar($quantia * $cpmf);
				
				return true;
			}else{
				echo 'Retirada não permitida';
				return false;
			}
		}
		
		/* Método transferirValor (Sobrescrito)
		* Método transfere valor de uma conta a outra
		*/
		public function transferirValor($conta,$valor){
			if($this->retirar($valor)){
				$conta->depositar($valor);
			}
		}
	}
?>