<?php
	class XMLBase{
		function toXml(){
			$retorno = '<' . get_class($this) . '>' . "\n";
			$propriedades = get_object_vars($this);//Não pega as Variaveis Private
			foreach($propriedades as $propriedade => $valor){
				$retorno .= "\t<$propriedade>$valor</$propriedade>";
			}
			$retorno .= '</' . get_class($this) . '>' . "\n";
			return $retorno;
		}
	}
?>