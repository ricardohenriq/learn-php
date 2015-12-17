<?php
/*
 * classe Cliente
 * Active Record para tabela Cliente
 */
class Cliente extends TRecord
{
	   const TABLENAME = 'cliente';
	   private $cidade;
	   /*
	    * m�todo get_nome_cidade()
	    * executado sempre se for acessada a propriedade "nome_cidade"
	    */
	   function get_nome_cidade()
	   {
		      // instancia Cidade, carrega
		      // na mem�ria a cidade de c�digo $this->id_cidade
		      if (empty($this->cidade))
			         $this->cidade = new Cidade($this->id_cidade);
		   // retorna o objeto instanciado
		   return $this->cidade->nome;
	  }
}
?>

