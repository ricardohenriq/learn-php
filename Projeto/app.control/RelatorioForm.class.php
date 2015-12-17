<?php
/*
 * classe RelatorioForm
 * relat�rio de vendas por per�odo
 */
class RelatorioForm extends TPage
{
    private $form;   // formul�rio de entrada

    /*
     * m�todo construtor
     * cria a p�gina e o formul�rio de par�metros
     */
    public function __construct()
    {
        parent::__construct();

        // instancia um formul�rio
        $this->form = new TForm('form_relat_vendas');

        // instancia uma tabela
        $table = new TTable;

        // adiciona a tabela ao formul�rio
        $this->form->add($table);

        // cria os campos do formul�rio
        $data_ini = new TEntry('data_ini');
        $data_fim = new TEntry('data_fim');

        // define os tamanhos
        $data_ini->setSize(100);
        $data_fim->setSize(100);

        // adiciona uma linha para o campo data inicial
        $row=$table->addRow();
        $row->addCell(new TLabel('Data Inicial:'));
        $row->addCell($data_ini);

        // adiciona uma linha para o campo data final
        $row=$table->addRow();
        $row->addCell(new TLabel('Data Final:'));
        $row->addCell($data_fim);

        // cria um bot�o de a��o
        $gera_button=new TButton('gera');

        // define a a��o do bo�o
        $gera_button->setAction(new TAction(array($this, 'onGera')), 'Gerar Relat�rio');

        // adiciona uma linha para a a��o do formul�rio
        $row=$table->addRow();
        $row->addCell($gera_button);

        // define quais s�o os campos do formul�rio
        $this->form->setFields(array($data_ini, $data_fim, $gera_button));

        // adiciona o formul�rio � p�gina
        parent::add($this->form);
    }

    /*
     * m�todo onGera
     * gera o relat�rio, baseado nos par�metros do formul�rio
     */
    function onGera()
    {
        // obt�m os dados do formul�rio
        $dados = $this->form->getData();

        // joga os dados de volta ao formul�rio
        $this->form->setData($dados);

        // l� os campos do formul�rio, converte para o padr�o americano
        $data_ini = $this->conv_data_to_us($dados->data_ini);
        $data_fim = $this->conv_data_to_us($dados->data_fim);

        // instancia uma nova tabela
        $table = new TTable;
        $table->border = 1;
        $table->width = '80%';
        $table->style = 'border-collapse:collapse';

        // adiciona uma linha para o cabe�alho do relat�rio
        $row = $table->addRow();
        $row->bgcolor = '#a0a0a0';

        // adiciona as c�lulas ao cabe�alho
        $cell = $row->addCell('Data');
        $cell = $row->addCell('Cliente/Produtos');
        $cell = $row->addCell('Qtde');

        $cell->align = 'right';
        $cell = $row->addCell('Pre�o');
        $cell->align = 'right';
        try
        {
            // inicia transa��o com o banco 'pg_livro'
            TTransaction::open('pg_livro');

            // instancia um reposit�rio da classe Venda
            $repositorio = new TRepository('Venda');

            // cria um crit�rio de sele��o por intervalo de datas
            $criterio = new TCriteria;
            $criterio->add(new TFilter('data_venda', '>=', $data_ini));
            $criterio->add(new TFilter('data_venda', '<=', $data_fim));
            $criterio->setProperty('order', 'data_venda');

            // l� todas vendas que satisfazem ao crit�rio
            $vendas = $repositorio->load($criterio);

            // verifica se retornou algum objeto
            if ($vendas)
            {
                // percorre as vendas
                foreach ($vendas as $venda)
                {
                    // adiciona uma linha � tabela e define suas propriedades
                    $row = $table->addRow();
                    $row->bgcolor = "#e0e0e0";

                    // adiciona c�lulas para data da venda e dados do cliente
                    $cell = $row->addCell($this->conv_data_to_br($venda->data_venda));
                    $cell = $row->addCell($venda->id_cliente . ' : ' . $venda->cliente->nome);
                    $cell->colspan=3;

                    // verifica se a venda possui itens
                    if ($venda->itens)
                    {
                        $sub_total =0;
                        $total_qtde=0;

                        // percorre os itens da venda

                        foreach ($venda->itens as $item)
                        {
                            // adiciona uma linha para cada item da venda
                            $row = $table->addRow();

                            // adiciona as c�lulas com os dados do item
                            $cell = $row->addCell('');
                            $cell = $row->addCell($item->id_produto . ' : ' . $item->descricao);
                            $cell = $row->addCell($item->quantidade);
                            $cell->align = 'right';
                            $cell = $row->addCell(number_format($item->preco_venda,2,',','.'));
                            $cell->align = 'right';

                            // acumula totais de valor e quantidade
                            $sub_total += $item->quantidade * $item->preco_venda;
                            $total_qtde += $item->quantidade;
                        }
                       // adiciona uma linha para os totais da venda
                       $row = $table->addRow();
                       $cell = $row->addCell('');
                       $cell = $row->addCell('<b>Sub-Total</b>');
                       $cell = $row->addCell('<b>'.$total_qtde.'</b>');
                       $cell->align = 'right';
                       $cell = $row->addCell('<b>'.number_format($sub_total,2,',','.').'</b>');
                       $cell->align = 'right';
                    }
              }
            }
            // finaliza a transa��o
            TTransaction::close();
        }
        catch (Exception $e)		     // em caso de exce��o
        {
            // exibe a mensagem gerada pela exce��o
            new TMessage('error', $e->getMessage());
            // desfaz todas altera��es no banco de dados
            TTransaction::rollback();
        }
        // adiciona a tabela � p�gina
        parent::add($table);
    }

    /*
     * m�todo conv_data_to_us()
     * Converte uma data para o formato yyyy-mm-dd
     * @param $data = data no formato dd/mm/yyyy
     */
    function conv_data_to_us($data)
    {
        $dia = substr($data,0,2);
        $mes = substr($data,3,2);
        $ano = substr($data,6,4);
        return "{$ano}-{$mes}-{$dia}";
    }

    /*
     * m�todo conv_data_to_br()
     * Converte uma data para o formato dd/mm/yyyy
     * @param $data = data no formato yyyy-mm-dd
     */
    function conv_data_to_br($data)
    {
        // captura as partes da data
        $ano = substr($data,0,4);
        $mes = substr($data,5,2);
        $dia = substr($data,8,4);

        // retorna a data resultante
        return "{$dia}/{$mes}/{$ano}";
    }
}
?>
