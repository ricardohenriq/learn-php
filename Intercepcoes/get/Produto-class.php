<?php
	class Produto{
		public $codigo;
		public $descricao;
		public $qtde;
		private $preco;
		const MARGEM = 10;
		
		function __construct($cod,$desc,$qtde,$preco){
			$this->codigo = $cod;
			$this->descricao = $desc;
			$this->qtde = $qtde;
			$this->preco = $preco;
		}
		
		//Intercepta a obtenção de propriedades
		function __get($propriedade){
			if($propriedade == 'preco'){
				return $this->$propriedade * (1 +(self::MARGEM / 100));
			}
		}
	}
?>