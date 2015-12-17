<?php
/*
 * classe FabricantesList
 * Cadastro de Fabricantes
 * Cont�m o formul�ro e a listagem
 */
class FabricantesList extends TPage
{
    private $form;      // formul�rio de cadastro
    private $datagrid;  // listagem
    private $loaded;
    
    /*
     * m�todo construtor
     * Cria a p�gina, o formul�rio e a listagem
     */
    public function __construct()
    {
        parent::__construct();
        
        // instancia um formul�rio
        $this->form = new TForm('form_fabricantes');
        
        // instancia uma tabela
        $table = new TTable;
        
        // adiciona a tabela ao formul�rio
        $this->form->add($table);
        
        // cria os campos do formul�rio
        $codigo = new TEntry('id');
        $nome   = new TEntry('nome');
        $site   = new TEntry('site');
        
        // define os tamanhos
        $codigo->setSize(40);
        $site->setSize(200);
        
        // adiciona uma linha para o campo c�digo
        $row=$table->addRow();
        $row->addCell(new TLabel('C�digo:'));
        $row->addCell($codigo);
        
        // adiciona uma linha para o campo nome
        $row=$table->addRow();
        $row->addCell(new TLabel('Nome:'));
        $row->addCell($nome);
        
        // adiciona uma linha para o campo site
        $row=$table->addRow();
        $row->addCell(new TLabel('Site:'));
        $row->addCell($site);
        
        // cria um bot�o de a��o (salvar)
        $save_button=new TButton('save');
        // define a a��o do bot�o
        $save_button->setAction(new TAction(array($this, 'onSave')), 'Salvar');
        
        // adiciona uma linha para a a��o do formul�rio
        $row=$table->addRow();
        $row->addCell($save_button);
        
        // define quais s�o os campos do formul�rio
        $this->form->setFields(array($codigo, $nome, $site, $save_button));
        
        // instancia objeto DataGrid
        $this->datagrid = new TDataGrid;
        
        // instancia as colunas da DataGrid
        $codigo   = new TDataGridColumn('id',       'C�digo',  'right',  50);
        $nome     = new TDataGridColumn('nome',     'Nome',    'left',  180);
        $site     = new TDataGridColumn('site',     'Site',    'left',  180);
        
        // adiciona as colunas � DataGrid
        $this->datagrid->addColumn($codigo);
        $this->datagrid->addColumn($nome);
        $this->datagrid->addColumn($site);
        
        // instancia duas a��es da DataGrid
        $action1 = new TDataGridAction(array($this, 'onEdit'));
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
     * fun��o onReload()
     * Carrega a DataGrid com os objetos do banco de dados
     */
    function onReload()
    {
        // inicia transa��o com o banco 'pg_livro'
        TTransaction::open('pg_livro');
        
        // instancia um reposit�rio para Fabricante
        $repository = new TRepository('Fabricante');
        
        // cria um crit�rio de sele��o, ordenado pelo id
        $criteria = new TCriteria;
        $criteria->setProperty('order', 'id');
        // carrega os objetos de acordo com o criterio
        $fabricantes = $repository->load($criteria);
        $this->datagrid->clear();
        if ($fabricantes)
        {
            // percorre os objetos retornados
            foreach ($fabricantes as $fabricante)
            {
                // adiciona o objeto na DataGrid
                $this->datagrid->addItem($fabricante);
            }
        }
        // finaliza a transa��o
        TTransaction::close();
        $this->loaded = true;
    }
    
    /*
     * fun��o onSave()
     * Executada quando o usu�rio clicar no bot�o salvar do formul�rio
     */
    function onSave()
    {
        // inicia transa��o com o banco 'pg_livro'
        TTransaction::open('pg_livro');
        // obt�m os dados no formul�rio em um objeto Fabricante
        $fabricante = $this->form->getData('Fabricante');
        // armazena o objeto
        $fabricante->store();
        
        // finaliza a transa��o
        TTransaction::close();
        // exibe mensagem de sucesso
        new TMessage('info', 'Dados armazenados com sucesso');
        // re-carrega listagem
        $this->onReload();
    }
    
    /*
     * m�todo onDelete()
     * Executada quando o usu�rio clicar no bot�o excluir da datagrid
     * Pergunta ao usu�rio se deseja realmente excluir um registro
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
        new TQuestion('Deseja realmente excluir o registro ?', $action1, $action2);
    }
    
    /*
     * m�todo Delete()
     * Exclui um registro
     */
    function Delete($param)
    {
        // obt�m o par�metro $key
        $key=$param['key'];
        
        // inicia transa��o com o banco 'pg_livro'
        TTransaction::open('pg_livro');
        
        // instanicia objeto Fabricante
        $fabricante = new Fabricante($key);
        // deleta objeto do banco de dados
        $fabricante->delete();
        
        // finaliza a transa��o
        TTransaction::close();
        
        // re-carrega a datagrid
        $this->onReload();
        // exibe mensagem de sucesso
        new TMessage('info', "Registro Exclu�do com sucesso");
    }
    
    /*
     * m�todo onEdit()
     * Executada quando o usu�rio clicar no bot�o visualizar
     */
    function onEdit($param)
    {
        // obt�m o par�metro e exibe mensagem
        $key=$param['key'];
        // inicia transa��o com o banco 'pg_livro'
        TTransaction::open('pg_livro');
        
        // instanicia objeto Fabricante
        $fabricante = new Fabricante($key);
        // lan�a os dados do fabricante no formul�rio
        $this->form->setData($fabricante);
        
        // finaliza a transa��o
        TTransaction::close();
        $this->onReload();
    }
    
    /*
     * m�todo show()
     * Executada quando o usu�rio clicar no bot�o excluir
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
