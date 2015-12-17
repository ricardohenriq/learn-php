<?php
	include_once '../Interfaces/Aluno-interface.php';
	class Aluno implements IAluno{
		private $nome;
		
		function setNome($nome){
			$this->nome = $nome;
		}
		
		function getNome(){
			return $this->nome;
		}
	}
?>