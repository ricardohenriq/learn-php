<?php
/* Criar um Formulario com
* Abstração de Componentes
* Usando Tabela (TTable)
* FOCO --
* Criar Formulario Estruturado e com BD
*/
	function __autoload($classe){
		$pastas = array('app.widgets','app.ado');
		foreach($pastas as $pasta){
			if(file_exists("../$pasta/$classe.class.php")){
				include_once "../$pasta/$classe.class.php";
			}
		}
	}
	
	//Cria uma classe para manipulação dos Registros de Pessoas
	class pessoaRecord extends TRecord{
		const TABLENAME = 'pessoa';//Nome da tabela no banco de dados
	}
	
	//Instancia um Formulario
	$form = new TForm('formPessoa');
	
	//Instancia uma Tabela
	$table = new TTable();
	
	//Define as propriedades da Tabela
	$table->style = 'border:2px solid #989898';
	$table->width = '400px';
	
	//Adiciona a tabela no formulario
	$form->add($table);
	
	//Cria os Campos do Formulario
	$codigo = new TEntry('id');
	$nome = new TEntry('nome');
	$endereco = new TEntry('endereco');
	$datanasc = new TEntry('datanasc');
	$sexo = new TRadioGroup('sexo');
	$linguas = new TCheckGroup('linguas');
	$qualifica = new TText('qualifica');
	
	//Define o tamanho para o campo Codigo
	$codigo->setSize('100');
	//Define como somente leitura
	$codigo->setEditable(false);
	
	//Cria um vetor com as opções de Sexo
	$itens = array();
	$itens['M'] = 'MASCULINO';
	$itens['F'] = 'FEMININO';
	
	//Define o tamanho para o campo Data de Nascimento
	$datanasc->setSize('100');
	
	//Adiciona as opções ao Radio Button
	$sexo->addItems($itens);
	//Define opção Ativa
	$sexo->setValue('M');
	//Define posição dos Elementos
	$sexo->setLayout('horizontal');
	
	//Cria um vetor com as opções de Idiomas
	$itens = array();
	$itens['I'] = 'Ingles';
	$itens['E'] = 'Espanhol';
	$itens['P'] = 'Portugues';
	//Adiciona as opções ao Check Button
	$linguas->addItems($itens);
	//Define opções Ativas
	$linguas->setValue(array('I','P'));
	
	//Define um valor padrão para o campo
	$qualifica->setValue('<Digite suas qualificações aqui>');
	$qualifica->setSize('240','100');
	
	//Adiciona uma linha para o Campo Codigo na Tabela
	$row = $table->addRow();
	$row->addCell(new TLabel('Codigo: '));
	$row->addCell($codigo);
	
	//Adiciona uma linha para o Campo Nome na Tabela
	$row = $table->addRow();
	$row->addCell(new TLabel('Nome: '));
	$row->addCell($nome);
	
	//Adiciona uma linha para o Campo Endereço na Tabela
	$row = $table->addRow();
	$row->addCell(new TLabel('Endereço: '));
	$row->addCell($endereco);
	
	//Adiciona uma linha para o Campo Data de Nascimento na Tabela
	$row = $table->addRow();
	$row->addCell(new TLabel('Data de Nascimento: '));
	$row->addCell($datanasc);
	
	//Adiciona uma linha para o Campo Sexo na Tabela
	$row = $table->addRow();
	$row->addCell(new TLabel('Sexo: '));
	$row->addCell($sexo);
	
	//Adiciona uma linha para o Campo Linguas na Tabela
	$row = $table->addRow();
	$row->addCell(new TLabel('Linguas: '));
	$row->addCell($linguas);
	
	//Adiciona uma linha para o Campo Qualificações na Tabela
	$row = $table->addRow();
	$row->addCell(new TLabel('Qualificações: '));
	$row->addCell($qualifica);
	
	//Adiciona um Botão de Ação ao Formulario
	//Ele irá executar a função onSave()
	$submit = new TButton('action1');
	$submit->setAction(new TAction('onSave'),'Salvar');
	
	$row = $table->addRow();
	$row->addCell(new TLabel(''));
	$row->addCell($submit);
	
	// Define quais são os campos do Formulario, para que eles possam 
	//ser acessados e visualizados antes deles serem repassados
	//ao script que por exemplo poderá armazane-los em um BD
	$form->setFields(array($codigo,$nome,$endereco,$datanasc,$sexo,$linguas,$qualifica,$submit));
	
	//Instancia uma nova Pagina
	$pagina = new TPage();
	//Adiciona o formulario a Pagina
	$pagina->add($form);
	//Exibe a pagina e seu conteudo
	$pagina->show();
	
	/* Function onSave
	* Obtem os dados do Formulario e salva na Base de Dados
	*/
	function onSave(){
		global $form;
		$pessoa = $form->getData('pessoaRecord');
		
		try{
			//Inicia uma Transação com o Banco 'my_livro'
			TTransaction::open('my_livro');
			$pessoa->linguas = implode(' ',$pessoa->linguas);
			$pessoa->datanasc = conv_data_to_us($pessoa->datanasc);
			$pessoa->store();
			//Finaliza a Transação
			TTransaction::close();
			new TMessage('Info','Dados armazenados com Sucesso');
			
		}catch(Exception $e){
			//Exibe a mensagem gerada pela exceção
			new TMessage('Error','<b>Erro</b>' . $e->getMessage());
			//Desfaz todas as alterações no Banco de Dados
			TTransaction::rollback();
		}
	}
	
	/* Function onEdit
	* Carrega os dados do registro no formulario
	* @param $param = parametros passados via URL ($_GET)
	* form3.php?method=onEdit&id=13
	*/
	function onEdit($param){
		global $form;
		
		try{
			//Inicia uma Transação com o Banco 'my_livro'
			TTransaction::open('my_livro');
			
			//Obtem a Pessoa a partir do parametro Id
			$pessoa = new pessoaRecord($param['id']);
			$pessoa->linguas = explode(' ',$pessoa->linguas);
			$pessoa->datanasc = conv_data_to_br($pessoa->datanasc);
			$form->setData($pessoa);
			//Finaliza a Transação
			TTransaction::close();
			new TMessage('Info','Dados recuperados com Sucesso');
			
		}catch(Exception $e){
			//Exibe a mensagem gerada pela exceção
			new TMessage('Error','<b>Erro</b>' . $e->getMessage());
			//Desfaz todas as alterações no Banco de Dados
			TTransaction::rollback();
		}
	}
	
	/* Function conv_data_to_us
	* Converte uma data do formato brasileiro para o americano
	* @param $data = data (dd/mm/aaaa) a ser convertida
	*/
	function conv_data_to_us($data){
		$dia = substr($data,0,2);
		$mes = substr($data,3,2);
		$ano = substr($data,6,4);
		
		return "$ano-$mes-$dia";
	}
	
	/* Function conv_data_to_br
	* Converte uma data do formato americano para o brasileiro
	* @param $data = data (aaaa/mm/dd) a ser convertida
	*/
	function conv_data_to_br($data){
		$ano = substr($data,0,4);
		$mes = substr($data,5,2);
		$dia = substr($data,8,2);
		
		return "$dia/$mes/$ano";
	}
?>