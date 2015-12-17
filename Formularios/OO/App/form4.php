<?php
/* Criar um Formulario com
* Abstração de Componentes
* Usando Painel (TPanel)
* FOCO --
* Criar Formulario Orientado a Objetos e com BD
*/
	function __autoload($classe){
		$pastas = array('app.widgets','app.ado');
		foreach($pastas as $pasta){
			if(file_exists("../$pasta/$classe.class.php")){
				include_once "../$pasta/$classe.class.php";
			}
		}
	}
	
	//Active Record para a tabela livro
	class livroRecord extends TRecord{
		const TABLENAME = 'livros';//Nome da tabela no banco de dados
	}
	
	class livroForm extends TPage{
		private $form;
		
		function __construct(){
			parent::__construct();
			//Instancia um novo Formulario
			$this->form = new TForm('livroForm');
			
			//Isntancia o Painel
			$painel = new TPanel('400','300');
			$this->form->add($painel);
			
			//Coloca o campo ID no Formulario
			$painel->put(new TLabel('ID'),'10','10');
			$painel->put($id = new TEntry('id'),'100','10');
			$id->setSize('100');
			$id->setEditable(false);
			
			//Coloca o campo titulo no formulario
			$painel->put(new TLabel('Titulo'),'10','40');
			$painel->put($titulo = new TEntry('titulo'),'100','40');
			
			//Coloca o campo autor no formulario
			$painel->put(new TLabel('Autor'),'10','70');
			$painel->put($autor = new TEntry('autor'),'100','70');
			
			//coloca o campo tema no formulario
			$painel->put(new TLabel('Tema'),'10','100');
			$painel->put($tema = new TCombo('tema'),'100','100');
			
			//Cria um vetor com as opções da Combo Tema
			$itens = array();
			$itens['1'] = 'Administração';
			$itens['2'] = 'Matematica';
			$itens['3'] = 'Informatica';
			//Adiciona os na Combo
			$tema->addItems($itens);
			
			//Coloca o campo editora no formulario
			$painel->put(new TLabel('Editora'),'10','130');
			$painel->put($editora = new TEntry('editora'),'100','130');
			$editora->setSize('100');
			
			//Coloca o campo ano no formulario
			$painel->put(new TLabel('Ano'),'210','130');
			$painel->put($ano = new TEntry('ano'),'260','130');
			$ano->setSize('40');
			
			//coloca o campo resumo no formulario
			$painel->put(new TLabel('Remuno'),'10','160');
			$painel->put($resumo = new TText('resumo'),'100','160');
			
			//Cria uma Ação
			$painel->put($acao = new TButton('action'),'320','240');
			$acao->setAction(new TAction(array($this,'onSave')),'Salvar');
			
			//Define quais são os Campos do Formulario
			$this->form->setFields(array($id,$titulo,$autor,$tema,$editora,$ano,$resumo,$acao));
			
			parent::add($this->form);
		}
		
		/* Function onSave
		* Obtem os dados do Formulario e salva na Base de Dados
		*/
		function onSave(){
						
			try{
				//Inicia uma Transação com o Banco 'my_livro'
				TTransaction::open('my_livro');
				//Obtem dados
				$livro = $this->form->getData('livroRecord');
				//Armazena Registro
				$livro->store();
				//Joga os dados de volta para o formulario
				//$this->form->setData($livro);
				//Define o formulario como não editavel
				$this->form->setEditable(false);
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
		
		/* Function onEdit NÃO ESTA FUNCINANDO
		* Carrega os dados do registro no formulario
		* @param $param = parametros passados via URL ($_GET)
		* form3.php?class=livroForm&method=onEdit&id=13
		*/
		function onEdit($param){
			
			try{
				//Inicia uma Transação com o Banco 'my_livro'
				TTransaction::open('my_livro');
				//Obtem a Pessoa a partir do parametro Id
				$livro = new livroRecord($param['id']);
				//Joga os dados de para o formulario
				$this->form->setData($livro);
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
	}
	
	//Instancia e Exibe a pagina
	$pagina = new livroForm();
	$pagina->show();
?>