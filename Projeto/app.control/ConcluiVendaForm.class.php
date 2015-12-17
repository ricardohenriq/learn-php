<?php
/*
 * classe ConcluiVenda
 * formul�rio de conclus�o de venda
 */
class ConcluiVendaForm extends TForm
{
    public $button;	   // bot�o de a��o do formul�rio

    /*
     * m�todo construtor
     * Cria a p�gina e o formul�rio de cadastro
     */
    function __construct()
    {
        parent::__construct('form_conclui_venda');
        // instancia uma tabela
        $table = new TTable;

        // adiciona a tabela ao formul�rio
        parent::add($table);

        // cria os campos do formul�rio
        $cliente      = new TEntry('id_cliente');
        $desconto     = new TEntry('desconto');
        $valor_total  = new TEntry('valor_total');
        $valor_pago   = new TEntry('valor_pago');

        // define alguns atributos para os campos do formul�rio
        $valor_total->setEditable(FALSE);
        $cliente->setSize(100);
        $desconto->setSize(100);
        $valor_total->setSize(100);
        $valor_pago->setSize(100);

        // adiciona uma linha para o campo cliente
        $row=$table->addRow();
        $row->addCell(new TLabel('Cliente:'));
        $row->addCell($cliente);

        // adiciona uma linha para o campo desconto
        $row=$table->addRow();
        $row->addCell(new TLabel('Desconto:'));
        $row->addCell($desconto);

        // adiciona uma linha para o campo valor total
        $row=$table->addRow();
        $row->addCell(new TLabel('Valor Total:'));
        $row->addCell($valor_total);

        // adiciona uma linha para o campo valor pago
        $row=$table->addRow();
        $row->addCell(new TLabel('Valor Pago:'));
        $row->addCell($valor_pago);

        // cria um bot�o de a��o para o formul�rio
        $this->button=new TButton('action1');

        // adiciona uma linha para as a��es do formul�rio
        $row=$table->addRow();
        $row->addCell('');
        $row->addCell($this->button);

        // define quais s�o os campos do formul�rio
        parent::setFields(array($cliente, $desconto, $valor_total, $valor_pago, $this->button));
    }
}
?>
