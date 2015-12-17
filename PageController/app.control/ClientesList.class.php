<?php
/*
 * classe ClientesList
 * listagem de Clientes
 */
class ClientesList extends TPage
{
    private $form;     // formul�rio de buscas
    private $datagrid; // listagem
    private $loaded;

    /*
     * m�todo construtor
     * cria a p�gina, o formul�rio de buscas e a listagem
     */
    public function __construct()
    {
        parent::__construct();
        // instancia um formul�rio
        $this->form = new TForm('form_busca_clientes');

        // instancia uma tabela
        $table = new TTable;

        // adiciona a tabela ao formul�rio
        $this->form->add($table);

        // cria os campos do formul�rio
        $nome = new TEntry('nome');

        // adiciona uma linha para o campo nome
        $row=$table->addRow();
        $row->addCell(new TLabel('Nome:'));
        $row->addCell($nome);

        // cria dois bot�es de a��o para o formul�rio
        $find_button = new TButton('busca');
        $new_button = new TButton('cadastra');

        // define as a��es dos bot�es
        $find_button->setAction(new TAction(array($this, 'onReload')), 'Buscar');
        $obj = new ClientesForm;
        $new_button->setAction(new TAction(array($obj, 'onEdit')), 'Cadastrar');

        // adiciona uma linha para aas a��es do formul�rio
        $row=$table->addRow();
        $row->addCell($find_button);
        $row->addCell($new_button);

        // define quais s�o os campos do formul�rio
        $this->form->setFields(array($nome, $find_button, $new_button));

        // instancia objeto DataGrid
        $this->datagrid = new TDataGrid;

        // instancia as colunas da DataGrid
        $codigo   = new TDataGridColumn('id',         'C�digo', 'right', 50);
        $nome     = new TDataGridColumn('nome',       'Nome',    'left', 140);
        $endereco = new TDataGridColumn('endereco',   'Endereco','left', 140);
        $cidade   = new TDataGridColumn('nome_cidade','Cidade', 'left', 140);

        // adiciona as colunas � DataGrid
        $this->datagrid->addColumn($codigo);
        $this->datagrid->addColumn($nome);
        $this->datagrid->addColumn($endereco);
        $this->datagrid->addColumn($cidade);

        // instancia duas a��es da DataGrid
        //$obj = new ClientesForm;
        $action1 = new TDataGridAction(array($obj, 'onEdit'));
        $action1->setLabel('Editar');

        $action1->setImage('ico_edit.png');
        $action1->setField('id');
        $action2 = new TDataGridAction(array($this, 'onDelete'));
        $action2->setLabel('Deletar');
        $action2->setImage('ico_delete.png');
        $action2->setField('id');

        // adiciona as a��es � DataGrid
        $this->datagrid->addAction($action1);
        $this->datagrid->addAction($action2);

        // cria o modelo da DataGrid, montando sua estrutura
        $this->datagrid->createModel();

        // monta a p�gina atrav�s de uma tabela
        $table = new TTable;
        $table->width='100%';

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
     * m�todo onReload()
     * carrega a DataGrid com os objetos do banco de dados
     */
    function onReload()
    {
        // inicia transa��o com o banco 'pg_livro'
        TTransaction::open('pg_livro');

        // instancia um reposit�rio para Cliente
        $repository = new TRepository('Cliente');

        // cria um crit�rio de sele��o de dados
        $criteria = new TCriteria;

        // ordena pelo campo id
        $criteria->setProperty('order', 'id');

        // obt�m os dados do formul�rio de buscas
        $dados = $this->form->getData();

        // verifica se o usu�rio preencheu o formul�rio
        if ($dados->nome)
        {
            // filtra pelo nome do cliente
            $criteria->add(new TFilter('nome', 'like', "%{$dados->nome}%"));
        }

        // carrega os produtos que satisfazem o crit�rio
        $clientes = $repository->load($criteria);
        $this->datagrid->clear();
        if ($clientes)
        {
            foreach ($clientes as $cliente)
            {
                // adiciona o objeto na DataGrid
                $this->datagrid->addItem($cliente);
            }
        }

        // finaliza a transa��o
        TTransaction::close();
        $this->loaded = true;
    }

    /*
     * m�todo onDelete()
     * executada quando o usu�rio clicar no bot�o excluir da datagrid
     * pergunta ao usu�rio se deseja realmente excluir um registro
     */
    function onDelete($param)
    {
        // obt�m o par�metro $key
        $key=$param['key'];

        // define duas a��es
        $action1 = new TAction(array($this, 'Delete'));
        $action2 = new TAction(array($this, 'teste'));

        // define os par�metros de cada a��o
        $action1->setParameter('key', $key);
        $action2->setParameter('key', $key);

        // exibe um di�logo ao usu�rio
        new TQuestion('Deseja realmente excluir o registro?', $action1, $action2);
    }

    /*
     * m�todo Delete()
     * exclui um registro
     */
    function Delete($param)
    {
        // obt�m o par�metro $key
        $key=$param['key'];

        // inicia transa��o com o banco 'pg_livro'
        TTransaction::open('pg_livro');

        // instancia objeto Cliente
        $cliente = new Cliente($key);

        // deleta objeto do banco de dados
        $cliente->delete();

        // finaliza a transa��o
        TTransaction::close();

        // recarrega a datagrid
        $this->onReload();

        // exibe mensagem de sucesso
        new TMessage('info', "Registro exclu�do com sucesso");
    }

    /*
    * m�todo show()
    * executada quando o usu�rio clicar no bot�o excluir
    */
    function show()
    {
        // se a listagem ainda n�o foi carregada
        if (!$this->loaded)
        {
            $this->onReload();
        }
        parent::show();
    }
}
?>
