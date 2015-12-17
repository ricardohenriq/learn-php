<?php
/*
 * classe Venda
 * Active Record para tabela Venda
 */
class Venda extends TRecord
{
	   const TABLENAME = 'venda';
	   private $itens;	   // array de objetos do tipo Item
	   /*
	    * fun��o addItem()
	    * adiciona um item (produto) � venda
	    */
	   public function addItem(Item $item)
	   {
		      $this->itens[] = $item;
	   }
	   /*
	    * fun��o store()
	    * armazena uma venda e seus itens no banco de dados
	    */
	   public function store()
	   {
		      // armazena a venda
  		    parent::store();
		   // percorre os itens da venda
		   foreach ($this->itens as $item)
		   {
			      $item->id_venda    = $this->id;
			      // armazena o item
			      $item->store();
		   }
	  }

	 /*
	  * fun��o get_itens()
	  * retorna os itens da venda
	  */
	 public function get_itens()
	 {
		    // instancia um reposit�rio de Item
		    $repositorio = new TRepository('Item');
		    // define o crit�rio de sele��o
		    $criterio = new TCriteria;
		    $criterio->add(new TFilter('id_venda', '=', $this->id));
		    // carrega a cole��o de itens
		    $this->itens = $repositorio->load($criterio);
		    // retorna os itens
		    return $this->itens;
	 }
	 /*
	  * m�todo get_cliente()
	  * retorna o objeto cliente vinculado � venda
	  */
	 function get_cliente()
	 {
		    // instancia Cliente, carrega
		    // na mem�ria o cliente de c�digo $this->id_cliente
		    $cliente = new Cliente($this->id_cliente);
		    // retorna o objeto instanciado
		    return $cliente;
	 }


}
?>

