<?php
/*
 * classe Produto
 * Active Record para tabela Produto
 */
class Produto extends TRecord
{
    const TABLENAME = 'produto';
	
	   private $fabricante;
	   /*
	    * m�todo get_nome_fabricante()
	    * retorna o nome do fabricante do produto
	    */
	   function get_nome_fabricante()
	   {
		      // instancia Fabricante, carrega
		      // na mem�ria a fabricante de c�digo $this->id_fabricante
		      if (empty($fabricante))
			         $this->fabricante = new Fabricante($this->id_fabricante);
		      // retorna o nome do fabricante
        return $this->fabricante->nome;
		
    }
	
}
?>

