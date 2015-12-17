<?php
	include_once 'XMLBase-class.php';
	class Produto extends XMLBase{
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
		
		//Intercepta a chamada a Metodos
		function __call($metodo,$parametros){
			echo "Voce tentou executar o Metodo: $metodo<br />";
			foreach($parametros as $key => $parametro){
				echo "Parametro: $key = $parametro<br />";
			}
		}
		
		function __toString(){
			return (string)$this->codigo;
		}
		
		/*function toXml(){
			return 
<<<XML
				<produto>
					<codigo>{$this->codigo}</codigo>
					<descricao>{$this->descricao}</descricao>
					<qtde>{$this->qtde}</qtde>
					<preco>{$this->preco}</preco>
				</produto>
XML;
		}*/
	}
?>