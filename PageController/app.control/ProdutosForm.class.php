<?php
/*
 * classe ProdutosForm
 * Formul�rio de cadastro de Produtos
 */
class ProdutosForm extends TPage
{
    private $form; // formul�rio
    
    /*
     * m�todo construtor
     * Cria a p�gina e o formul�rio de cadastro
     */
    function __construct()
    {
        parent::__construct();

        // instancia um formul�rio
        $this->form = new TForm('form_produtos');

        // instancia uma tabela
        $table = new TTable;
        
        // adiciona a tabela ao formul�rio
        $this->form->add($table);
        
        // cria os campos do formul�rio
        $codigo      = new TEntry('id');
        $descricao   = new TEntry('descricao');
        $estoque     = new TEntry('estoque');
        $preco_custo = new TEntry('preco_custo');
        $preco_venda = new TEntry('preco_venda');
        $fabricante  = new TCombo('id_fabricante');
        
        // carrega os fabricantes do banco de dados
        TTransaction::open('pg_livro');
        // instancia um reposit�rio de Fabricante
        $repository = new TRepository('Fabricante');
        // carrega todos objetos
        $collection = $repository->load(new TCriteria);
        // adiciona objetos na combo
        foreach ($collection as $object)
        {
            $items[$object->id] = $object->nome;
        }
        $fabricante->addItems($items);
        TTransaction::close();
        
        // define alguns atributos para os campos do formul�rio
        $codigo->setEditable(FALSE);
        $codigo->setSize(100);
        $estoque->setSize(100);
        $preco_custo->setSize(100);
        $preco_venda->setSize(100);
        
        // adiciona uma linha para o campo c�digo
        $row=$table->addRow();
        $row->addCell(new TLabel('C�digo:'));
        $row->addCell($codigo);
        
        // adiciona uma linha para o campo descri��o
        $row=$table->addRow();
        $row->addCell(new TLabel('Descri��o:'));
        $row->addCell($descricao);
        
        // adiciona uma linha para o campo estoque
        $row=$table->addRow();
        $row->addCell(new TLabel('Estoque:'));
        $row->addCell($estoque);
        
        // adiciona uma linha para o campo preco de custo
        $row=$table->addRow();
        $row->addCell(new TLabel('Pre�o Custo:'));
        $row->addCell($preco_custo);
        
        // adiciona uma linha para o campo pre�o de venda
        $row=$table->addRow();
        $row->addCell(new TLabel('Pre�o Venda:'));
        $row->addCell($preco_venda);
        
        // adiciona uma linha para o campo fabricante
        $row=$table->addRow();
        $row->addCell(new TLabel('Fabricante:'));
        $row->addCell($fabricante);
        
        // cria um bot�o de a��o para o formul�rio
        $button1=new TButton('action1');
        // define a a��o dos bot�o
        $button1->setAction(new TAction(array($this, 'onSave')), 'Salvar');
        
        // adiciona uma linha para a a��o do formul�rio
        $row=$table->addRow();
        $row->addCell('');
        $row->addCell($button1);
        
        // define quais s�o os campos do formul�rio
        $this->form->setFields(array($codigo, $descricao, $estoque, $preco_custo, $preco_venda, $fabricante, $button1));
        
        // adiciona o formul�rio na p�gina
        parent::add($this->form);
    }
        
    
    /*
     * m�todo onEdit
     * Edita os dados de um registro
     */
    function onEdit($param)
    {
        try
        {
            if (isset($param['key']))
            {
                // inicia transa��o com o banco 'pg_livro'
                TTransaction::open('pg_livro');
                
                // obt�m o Produto de acordo com o par�metro
                $produto = new Produto($param['key']);
                // lan�a os dados do produto no formul�rio
                $this->form->setData($produto);
                
                // finaliza a transa��o
                TTransaction::close();
            }
        }
        catch (Exception $e) // em caso de exce��o
        {
            // exibe a mensagem gerada pela exce��o
            new TMessage('error', '<b>Erro</b>' . $e->getMessage());
            // desfaz todas altera��es no banco de dados
            TTransaction::rollback();
        }
    }
    
    /*
     * m�todo onSave
     * Executado quando o usu�rio clicar no bot�o salvar
     */
    function onSave()
    {
        try
        {
            // inicia transa��o com o banco 'pg_livro'
            TTransaction::open('pg_livro');
            
            // l� os dados do formul�rio e instancia um objeto Produto
            $produto = $this->form->getData('Produto');
            // armazena o objeto no banco de dados
            $produto->store();
            
            // finaliza a transa��o
            TTransaction::close();
            // exibe mensagem de sucesso
            new TMessage('info', 'Dados armazenados com sucesso');
        }
        catch (Exception $e) // em caso de exce��o
        {
            // exibe a mensagem gerada pela exce��o
            new TMessage('error', '<b>Erro</b>' . $e->getMessage());
            // desfaz todas altera��es no banco de dados
            TTransaction::rollback();
        }
    }
}
?>
