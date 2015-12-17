<?php
/*
 * fun��o formata_string
 * exibe um valor com as casas decimais
 */
function formata_money($valor)
{
    return number_format($valor, 2, ',', '.');
	
}
/*
 * classe VendasForm
 * formul�rio de vendas
 */
class VendasForm extends TPage
{
    private $form;       // formul�rio de novo item
    private $datagrid;   // listagem de itens
    private $loaded;

    /*
     * m�todo construtor
     * cria a p�gina e o formul�rio de cadastro
     */
    public function __construct()
    {
        parent::__construct();

        // instancia nova se��o
        new TSession;

        // instancia um formul�rio
        $this->form = new TForm('form_vendas');

        // instancia uma tabela
        $table = new TTable;

        // adiciona a tabela ao formul�rio
        $this->form->add($table);

        // cria os campos do formul�rio
        $codigo      = new TEntry('id_produto');
        $quantidade = new TEntry('quantidade');

        // define os tamanhos
        $codigo->setSize(100);

        // adiciona uma linha para o campo c�digo
        $row=$table->addRow();
        $row->addCell(new TLabel('C�digo:'));
        $row->addCell($codigo);

        // adiciona uma linha para o campo quantidade
        $row=$table->addRow();
        $row->addCell(new TLabel('Quantidade:'));
        $row->addCell($quantidade);

        // cria dois bot�es de a��o para o formul�rio
        $save_button = new TButton('save');
        $fim_button = new TButton('fim');

        // define as a��es dos bot�es
        $save_button->setAction(new TAction(array($this, 'onAdiciona')), 'Adicionar');
        $fim_button->setAction(new TAction(array($this, 'onFinal')), 'Finalizar');

        // adiciona uma linha para as a��es do formul�rio
        $row=$table->addRow();
        $row->addCell($save_button);
        $row->addCell($fim_button);

        // define quais s�o os campos do formul�rio
        $this->form->setFields(array($codigo, $quantidade, $save_button, $fim_button));

        // instancia objeto DataGrid
        $this->datagrid = new TDataGrid;

        // instancia as colunas da DataGrid
        $codigo    = new TDataGridColumn('id_produto', 'C�digo', 'right', 50);

        $descricao = new TDataGridColumn('descricao',   'Descri��o','left', 200);
        $quantidade= new TDataGridColumn('quantidade',  'Qtde',      'right', 40);
        $preco     = new TDataGridColumn('preco_venda', 'Pre�o',    'right', 70);

        // define um transformador para a coluna pre�o
        $preco->setTransformer('formata_money');

        // adiciona as colunas � DataGrid
        $this->datagrid->addColumn($codigo);
        $this->datagrid->addColumn($descricao);
        $this->datagrid->addColumn($quantidade);
        $this->datagrid->addColumn($preco);

        // cria uma a��o para a datagrid
        $action = new TDataGridAction(array($this, 'onDelete'));
        $action->setLabel('Deletar');
        $action->setImage('ico_delete.png');
        $action->setField('id_produto');

        // adiciona a a��o � DataGrid
        $this->datagrid->addAction($action);

        // cria o modelo da DataGrid, montando sua estrutura
        $this->datagrid->createModel();

        // monta a p�gina atrav�s de uma tabela
        $table = new TTable;

        // cria uma linha para o formul�rio
        $row = $table->addRow();

        $row->addCell($this->form);
        // cria uma linha para a datagrid

        $row = $table->addRow();
        $row->addCell($this->datagrid);

        // adiciona a tabela � p�gina
        parent::add($table);
    }


    /*
     * m�todo onAdiciona()
     * executada quando o usu�rio clicar no bot�o salvar do formul�rio
     */
    function onAdiciona()
    {
        // obt�m os dados do formul�rio
        $item = $this->form->getData('Item');

        // l� vari�vel $list da se��o
        $list = TSession::getValue('list');

        // acrescenta produto na vari�vel $list
        $list[$item->id_produto]= $item;

        // grava vari�vel $list de volta � se��o
        TSession::setValue('list', $list);

        // recarrega a listagem
        $this->onReload();
    }

    /*
     * m�todo onDelete()
     * executada quando o usu�rio clicar no bot�o excluir da datagrid
     */
    function onDelete($param)
    {
        // l� vari�vel $list da se��o
        $list = TSession::getValue('list');

        // exclui a posi��o que armazena o produto de c�digo $key
        unset($list[$param['key']]);

        // grava vari�vel $list de volta � se��o
        TSession::setValue('list', $list);

        // recarrega a listagem
        $this->onReload();
    }

    /*
     * m�todo onReload()
     * carrega a DataGrid com os objetos
     */
    function onReload()
    {
        // obt�m a vari�vel de se��o $list
        $list = TSession::getValue('list');

        // limpa a datagrid
        $this->datagrid->clear();
        if ($list)
        {
            // inicia transa��o com o banco 'pg_livro'
            TTransaction::open('pg_livro');
            // percorre o array $list
            foreach ($list as $item)
            {
                // adiciona cada objeto $item na datagrid
                $this->datagrid->addItem($item);
            }
            // fecha transa��o
            TTransaction::close();
        }
        $this->loaded = true;
    }

    /*
     * m�todo onFinal()
     * executada quando o usu�rio finalizar a Venda
     */
    function onFinal()
    {
        // instancia uma nova janela
        $janela = new TWindow('Concui Venda');
        $janela->setPosition(520,200);
        $janela->setSize(250,180);

        // l� a vari�vel $list da se��o
        $list = TSession::getValue('list');

        // inicia transa��o com o banco 'pg_livro'
        TTransaction::open('pg_livro');

        $total = 0;
        foreach ($list as $item)
        {
            // soma o total de produtos vendidos
            $total += $item->preco_venda * $item->quantidade;
        }

        // fecha a transa��o
        TTransaction::close();

        // instancia formul�rio de conclus�o de venda
        $form = new ConcluiVendaForm;

        // define a a��o do bot�o deste formul�rio
        $form->button->setAction(new TAction(array($this, 'onGravaVenda')), 'Salvar');

        // preenche o formul�rio com o valor_total
        $dados = new StdClass;
        $dados->valor_total = $total;
        $form->setData($dados);

        // adiciona o formul�rio � janela
        $janela->add($form);
        $janela->show();
    }

    /*
     * m�todo onGravaVenda()
     * executada quando o usu�rio Finalizar a venda
     */
    function onGravaVenda()
    {
        date_default_timezone_set('America/Sao_Paulo');
        // obt�m os dados do formul�rio de conclus�o de venda
        $form = new ConcluiVendaForm;
        $dados = $form->getData();

        // inicia transa��o com o banco 'pg_livro'
        TTransaction::open('pg_livro');

        // instancia novo objeto Venda
        $venda = new Venda;

        // define os atributos a serem gravados
        $venda->id_cliente  = $dados->id_cliente;
        $venda->data_venda  = date('Y-m-d');
        $venda->desconto    = $dados->desconto;
        $venda->valor_total = $dados->valor_total;
        $venda->valor_pago  = $dados->valor_pago;

        // l� a vari�vel $list da se��o
        $itens = TSession::getValue('list');
        if ($itens)
        {
            // percorre os itens
            foreach ($itens as $item)
            {
                // adiciona o item na venda
                $venda->addItem($item);
            }
        }
        // armazena venda no banco de dados
        $venda->store();

        // finaliza a transa��o
        TTransaction::close();

        // limpa lista de itens da se��o
        TSession::setValue('list', array());

        // exibe mensagem de sucesso
        new TMessage('info', 'Venda registrada com sucesso');

        // recarrega lista de itens
        $this->onReload();
    }

    /*
     * fun��o show()
     * executada quando o usu�rio clicar no bot�o excluir
     */
    function show()
    {
        if (!$this->loaded)
        {
            $this->onReload();
        }
        parent::show();
    }
}
?>
