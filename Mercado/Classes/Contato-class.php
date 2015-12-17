<?php
	class Contato{
		public $nome;
		public $telefone;
		public $email;
		
		function setContato($nome,$tel,$email){
			$this->nome = $nome;
			$this->telefone = $tel;
			$this->email = $email;
		}
		
		function getContato(){
			return "{$this->nome}<br />{$this->telefone}<br />{$this->email}";
		}
	}
?>