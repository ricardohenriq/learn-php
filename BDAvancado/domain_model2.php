<?php
/*
Class Produto
Representa um produto a ser vendido
*/

final class Produto
{
	private $descricao;
	private $estoque;
	private $preco_custo;

	/*
	Metodo construct
	Definir alguns valores iniciais
	928035940
	*/
	public function __Construct ($descricao,$estoque,$preco_custo)
	{
		$this -> descricao   = $descricao;
		$this -> estoque     = $estoque;
		$this -> preco_custo = $preco_custo;
	}
	/*
	Método registraCompra
	Regista uma compra, actualiza custo e incrementa o estoque actual
	*/

	public function registraCompra($unidades,$preco_custo)
	{
		$this -> preco_custo = $preco_custo;
		$this -> estoque    +=$unidades;
	}
	/*
	Método resgistraVenda
	Regista uma venda e decrementa o estoque
	*/

	public function resgistraVenda($unidades)
	{
		$this -> estoque -= $unidades;
	}
	/*
	Método getEstoque
	Retorna a quantidade em estoque
	*/

	public function getEstoque()
	{
		return $this -> estoque;
	}
	/*
	Método calculaPrecoVenda
	Rotorna o preço da venda Baseado em uma margem de 
	30% sobre o custo
	*/

	public function calculaPrecoVenda()
	{
		return $this -> preco_custo * 1.3;
	}
}
#Fim da Class Produto
#----------------------------------
/*
Class venda 
Representa uyma venda de produto
*/
class Venda 
{
	private $itens; //Itens da venda

	/*
	Método addItem
	Adicion aum item na venda
	*/
	public function addItem($quantidade, Produto $produto)
	{
		$this -> itens [] = array($quantidade, $produto);
	}
	/*
	getItens
	Retornar o array de Itens da venda
	*/
	public function getItens()
	{
		return $this -> itens;
	}
	public function finalizarVenda()
	{
		foreach ($this -> itens as $item) 
		{
		
		$quantidade = $item [0];
		$produto    = $item [1];

		//Soma Total
		$total += $produto -> calculaPrecoVenda() * $quantidade;
		//Diminuir estoque
		$produto-> resgistraVenda ($quantidade);
		}
		return $total;
	}

}
#Fim da Class Venda
#-----------------------------------

//Intanciar o objecto venda
$venda = new Venda;
//Adicionar alguns produtos
$venda -> addItem(3,new Produto('Vinho', 10, 15)); //58.5
$venda -> addItem(2,new Produto('Salame', 20, 20)); //52
$venda -> addItem(1,new Produto('Queijo', 30, 10)); //13

//finalizar a venda
echo $venda-> finalizarVenda();

?>