<?php
/* Criar um Front Controller
* no arquivo index.php
*/
	function __autoload($classe){
		$pastas = array('app.widgets','app.control','app.ado','app.model');
		
		foreach($pastas as $pasta){
			if(file_exists("../$pasta/$classe.class.php")){
				include_once "../$pasta/$classe.class.php";
			}
		}
	}
	
	class TApplication{
		static public function run(){
			if($_GET){
				$classe = $_GET['class'];
				if(class_exists($classe)){
					$pagina = new $classe;
					$pagina->show();
				}
			}
		}
	}
	
	TApplication::run();
?>