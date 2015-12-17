<?php
	include_once '../Classes/Aluno-class.php';

	$objAluno = new Aluno();
	$objAluno->setNome('Bill');
	echo $objAluno->getNome();
?>