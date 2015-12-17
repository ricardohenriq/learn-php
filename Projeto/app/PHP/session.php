<?php
/* 
* Registrar a visita de um usuario no site
* Usando a Classe TSession que encapsula $_SESSION[]
*/
	function __autoload($classe){
		if(file_exists("../app.widgets/$classe.class.php")){
			include_once "../app.widgets/$classe.class.php";
		}
	}
	
	//O construtor da classe não retorna nenhum Objeto
	//Somente chama a Função session_start()
	new TSession();
	
	if(!TSession::getValue('counted')){
		echo 'Registrando Visita<br />';
		TSession::setValue('counted',true);
	}else{
		echo 'Visita Registrada<br />';
	}
?>