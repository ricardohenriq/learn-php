<?php
	class Cesta{
		private $itens = array();
		
		//Expecifica o tipo do Parametro
		function adicionaItem(Produto $item){
			//Adiciona no Final do Array
			$this->itens[] = $item;
		}
		
		function exibeLista(){
			foreach($this->itens as $item){
				$item->imprimeEtiqueta();
			}
		}
		
		function calculaTotal(){
			$total = 0;
			foreach($this->itens as $item){
				$total += $item->preco;
			}
			return $total;
		}
	}
?>