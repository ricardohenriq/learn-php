<?php
	final class ContaPoupanca extends Conta{
	//Não poder ser Superclasse
		public $aniversario;
		
		/* Método Construtor (Sobrescrito)
		* Agora, também inicializa a Variavel $aniversario
		*/
		function __construct($ag="",$cod="",$dt="",$tit="",$sen="",$sal="",$ani=""){
			//Chamada ao Método Construtor da Classe Pai
			parent::__construct($ag,$cod,$dt,$tit,$sen,$sal);
			$this->aniversario = $ani;
		}
		
		/* Método Retirar (Sobrescrito)
		* Verifica se há $saldo para retirar a $quantia
		*/
		function retirar($quantia){
			if($this->saldo >= $quantia){
				//Executa metodo da Classe Pai
				parent::retirar($quantia);
				
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