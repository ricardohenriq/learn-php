<?php
	class Fornecedor{
		public $codigo;
		public $razaoSocial;
		public $endereco;
		public $cidade;
		public $contato;
		
		function __construct($cod="",$rs="",$end="",$cid=""){
			$this->codigo = $cod;
			$this->razaoSocial = $rs;
			$this->endereco = $end;
			$this->cidade = $cid;
			
			$this->contato = new Contato();
		}
		
		function setContato($nome,$tel,$email){
			$this->contato->setContato($nome,$tel,$email);
		}
		
		function getContato(){
			return $this->contato->getContato();
		}
		//CONTATO E FORNECEDOR TEM UM "COMPOSIÇÃO"
	}
?>