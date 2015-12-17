<?php
	class Estagiario extends Funcionario{
		const CPF = '999.999.999-99';
		
		function __construct(){
			echo parent::EMPRESA . ' ' . self::CPF . '<br />';
		}
		
		function getSalario(){
			return $this->salario * 1.12;
		}
	}
?>