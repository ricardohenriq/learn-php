<?php
/*
 * classe Item
 * Active Record para tabela Item
 */
class Item extends TRecord
{
	   const TABLENAME = 'item';
	   private $produto;
	   /*
	    * m�todo get_descricao()
	    * retorna a descri��o do produto
	    */
	   function get_descricao()
	   {
		      // instancia Produto, carrega
		      // na mem�ria o produto de c�digo $this->id_produto
		      if (empty($this->produto))
			         $this->produto = new Produto($this->id_produto);
		      // retorna a descri��o do produto instanciado
		      return $this->produto->descricao;
	   }
	  /*
	   * m�todo get_preco_venda()
	   * retorna o pre�o de venda do produto
	   */
	  function get_preco_venda()
	  {
		     // instancia Produto, carrega
		     // na mem�ria o produto de c�digo $this->id_produto
		     if (empty($this->produto))
			        $this->produto = new Produto($this->id_produto);
		     // retorna o pre�o de venda do produto instanciado
		     return $this->produto->preco_venda;
	  }
}
?>

