<?php
	class Produto{
		public $codigo;
		public $descricao;
		public $preco;
		public $qtde;
		public $fornecedor;
		
		function __construct($cod="",$desc="",$pre="",$qtde="",$for){
			$this->codigo = $cod;
			$this->descricao = $desc;
			$this->preco = $pre;
			$this->qtde = $qtde;
			$this->fornecedor = $for;
		}
		
		function imprimeEtiqueta(){
			echo $this->codigo . '<br />';
			echo $this->descricao . '<br />';
			echo $this->preco . '<br />';
			echo $this->qtde . '<br />';
			echo '<br />';
		}	
	}
?>