<?php
/*
 * classe ClientesForm
 * formul�rio de cadastro de Clientes
 */
class ClientesForm extends TPage
{
    private $form; // formul�rio

    /*
     * m�todo construtor
     * cria a p�gina e o formul�rio de cadastro
     */
    function __construct()
    {
        parent::__construct();
        // instancia um formul�rio
        $this->form = new TForm('form_clientes');

        // instancia uma tabela
        $table = new TTable;

        // adiciona a tabela ao formul�rio
        $this->form->add($table);

        // cria os campos do formul�rio
        $codigo    = new TEntry('id');
        $nome      = new TEntry('nome');
        $endereco  = new TEntry('endereco');
        $telefone  = new TEntry('telefone');
        $cidade    = new TCombo('id_cidade');

        // define alguns atributos para os campos do formul�rio
        $codigo->setEditable(FALSE);
        $codigo->setSize(100);
        $nome->setSize(300);
        $endereco->setSize(300);

        // carrega as cidades do banco de dados
        TTransaction::open('pg_livro');

        // instancia um reposit�rio de Cidade
        $repository = new TRepository('Cidade');

        // carrega todos os objetos
        $collection = $repository->load(new TCriteria);

        // adiciona objetos na combo
        foreach ($collection as $object)
        {
            $items[$object->id] = $object->nome;
        }
        $cidade->addItems($items);

        TTransaction::close();

        // adiciona uma linha para o campo c�digo
        $row=$table->addRow();
        $row->addCell(new TLabel('C�digo:'));
        $row->addCell($codigo);

        // adiciona uma linha para o campo nome
        $row=$table->addRow();
        $row->addCell(new TLabel('Nome:'));
        $row->addCell($nome);

        // adiciona uma linha para o campo endere�o
        $row=$table->addRow();
        $row->addCell(new TLabel('Endereco:'));
        $row->addCell($endereco);

        // adiciona uma linha para o campo telefone
        $row=$table->addRow();
        $row->addCell(new TLabel('Telefone:'));
        $row->addCell($telefone);

        // adiciona uma linha para o campo cidade
        $row=$table->addRow();
        $row->addCell(new TLabel('Cidade:'));
        $row->addCell($cidade);

        // cria um bot�o de a��o para o formul�rio
        $button1=new TButton('action1');

        // define a a��o do bot�o
        $button1->setAction(new TAction(array($this, 'onSave')), 'Salvar');

        // adiciona uma linha para a a��o do formul�rio
        $row=$table->addRow();
        $row->addCell('');
        $row->addCell($button1);

        // define quais s�o os campos do formul�rio
        $this->form->setFields(array($codigo, $nome, $endereco, $telefone, $cidade, $button1));

        // adiciona o formul�rio na p�gina
        parent::add($this->form);
    }


    /*
     * m�todo onEdit
     * edita os dados de um registro
     */
    function onEdit($param)
    {
        try
        {
            if (isset($param['key']))
            {
                // inicia transa��o com o banco 'pg_livro'
                TTransaction::open('pg_livro');

                // obt�m o Cliente de acordo com o par�metro
                $cliente = new Cliente($param['key']);

                // lan�a os dados do cliente no formul�rio
                $this->form->setData($cliente);

                // finaliza a transa��o
                TTransaction::close();
            }
        }
        catch (Exception $e)		    // em caso de exce��o
        {
            // exibe a mensagem gerada pela exce��o
            new TMessage('error', '<b>Erro</b>' . $e->getMessage());
            // desfaz todas altera��es no banco de dados
            TTransaction::rollback();
        }
    }

    /*
     * m�todo onSave
     * executado quando o usu�rio clicar no bot�o salvar
     */
    function onSave()
    {
        try
        {
            // inicia transa��o com o banco 'pg_livro'
            TTransaction::open('pg_livro');

            // l� os dados do formul�rio e instancia um objeto Cliente
            $cliente = $this->form->getData('Cliente');

            // armazena o objeto no banco de dados
            $cliente->store();

            // finaliza a transa��o
            TTransaction::close();

            // exibe mensagem de sucesso
            new TMessage('info', 'Dados armazenados com sucesso');
        }
        catch (Exception $e)		     // em caso de exce��o
        {
            // exibe a mensagem gerada pela exce��o
            new TMessage('error', '<b>Erro</b>' . $e->getMessage());

            // desfaz todas altera��es no banco de dados
            TTransaction::rollback();
        }
    }
}
?>
