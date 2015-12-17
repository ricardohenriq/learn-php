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
			$template = file_get_contents('../HTML/template.html');
			
			if($_GET){
				$classe = $_GET['class'];
				if(class_exists($classe)){
					$pagina = new $classe;
					ob_start();//Nãp será renderizado mais nenhum HTML
					//Porem o mesmo sera armazenado no buffer
					$pagina->show();//HTML gerado mas nao renderizado (mas foi armazenado)
					$content = ob_get_contents();//Pega o 
					ob_end_clear();
				}/*else if(function_exists($method)){
					call_user_func($method, $_GET);
				}*/
			}
			echo str_replace('#CONTENT#',$content,$template);
		}
	}
	
	TApplication::run();
?>