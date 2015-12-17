<?php
	class OpenFile{
		static function abrir($arq = null){
			//Função die() aborta a execução do programa
			if(!$arq){
				die('Falta parametro com nome do Arquivo');
			}else if(!file_exists($arq)){
				die('Arquivo inexistente');
			}else if(!$retorno = @file_get_contents($arq)){
				die('Impossivel ler o Retorno');
			}else{
				echo 'Arquivo Encontrado<br />';
				return $retorno;
			}
		}
		
		/*************************************************/
		
		static function abrir2($arq = null){
			//Retornando Flags
			if(!$arq){
				return false;
			}else if(!file_exists($arq)){
				return false;
			}else if(!$retorno = @file_get_contents($arq)){
				return false;
			}else{
				echo 'Arquivo Encontrado<br />';
				return $retorno;
			}
		}
		
		/*************************************************/
		static function abrir3($arq = null){
			//Lançando Erros
			if(!$arq){
				trigger_error('Falta o parametro com o Nome do Arquivo',E_USER_NOTICE);
				return false;
			}else if(!file_exists($arq)){
				trigger_error('Arquivo Não Exite',E_USER_WARNING);//E_USER_ERROR
				return false;
			}else if(!$retorno = @file_get_contents($arq)){
				trigger_error('Impossivel ler o Arquivo',E_USER_ERROR);//E_USER_WARNING
				return false;
			}else{
				echo 'Arquivo Encontrado<br />';
				return $retorno;
			}
		}
		
		static function manipulaErro($numero,$mensagem,$arquivo,$linha){
			$mensagem = "Arquivo -> $arquivo : Linha -> $linha : #Nº -> $numero : Mensagem -> $mensagem";
			
			//Escreve no Log todo tipo de Erro
			$log = fopen('../Arquivos/Log.log','a');
			fwrite($log,$mensagem);
			fclose($log);
			
			echo $mensagem . '<br />';
		}
		
		/*************************************************/
		
		static function abrir4($arq = null){
			//Lançando Exceções
			if(!$arq){
				//throw new Exception('Falta o parametro com o Nome do Arquivo');
				throw new ParameterException('Falta o parametro com o Nome do Arquivo');
			}else if(!file_exists($arq)){
				throw new Exception('Arquivo Não Exite');
				//throw new FileNotFoundException('Arquivo Não Exite');
			}else if(!$retorno = @file_get_contents($arq)){
				throw new Exception('Impossivel ler o Arquivo');
				//throw new FilePermitionException('Impossivel ler o Arquivo');
			}else{
				echo 'Arquivo Encontrado<br />';
				return $retorno;
			}
		}
	}
?>