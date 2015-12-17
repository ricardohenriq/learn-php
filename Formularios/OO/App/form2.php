<?php
/* Criar um Formulario com
* Abstração de Componentes
* Usando Tabela (TTable)
* FOCO --
* Criar Formulario Orientado a Objetos e Estatico
*/
	function __autoload($classe){
		if(file_exists("../app.widgets/$classe.class.php")){
			include_once "../app.widgets/$classe.class.php";
		}
	}
	
	class emailForm extends TPage{
		private $form;
		
		function __construct(){
			parent::__construct();
			
			//Cria o Formulario
			$this->form = new TForm('formPessoas');
			
			//Cria a Tabala
			$table = new TTable();
			
			//Adiciona tabela no Formulario
			$this->form->add($table);
			
			//Cria uma serie de Campos de entrada de dados
			$nome = new TEntry('Nome');
			$email = new TEntry('Email');
			$titulo = new TEntry('Titulo');
			$mensagem = new TText('Mensagem');
			
			//Adiciona uma linha para o Campo Nome
			$row = $table->addRow();
			$row->addCell(new TLabel('Nome: '));
			$row->addCell($nome);
			
			//Adiciona uma linha para o Campo Email
			$row = $table->addRow();
			$row->addCell(new TLabel('Email: '));
			$row->addCell($email);
			
			//Adiciona uma linha para o Campo Titulo
			$row = $table->addRow();
			$row->addCell(new TLabel('Titulo: '));
			$row->addCell($titulo);
			
			//Adiciona uma linha para o Campo Mensagem
			$row = $table->addRow();
			$row->addCell(new TLabel('Mensagem: '));
			$row->addCell($mensagem);
			
			//Cria dois Botões de Ação para o Formulario
			$action1 = new TButton('action1');
			$action2 = new TButton('action2');
			//Define as Ações dos Botões
			$action1->setAction(new TAction(array($this,'onSend')), 'Enviar');
			$action2->setAction(new TAction(array($this,'onView')), 'Visualizar');
			
			//Adiciona uma linha para as ações do Formulario
			$row = $table->addRow();
			$row->addCell($action1);
			$row->addCell($action2);
			
			// Define quais são os campos do Formulario, para que eles possam 
			//ser acessados e visualizados antes deles serem repassados
			//ao script que por exemplo poderá armazane-los em um BD
			$this->form->setFields(array($nome,$email,$titulo,$mensagem,$action1,$action2));
			
			parent::add($this->form);
		}
		
		/* Function onView
		* Visualiza os Dados do formulario
		*/
		function onView(){
			//Obtem dados do Formulario
			$data = $this->form->getData();
			//Atribui os dados de volta ao Formulario
			$this->form->setData($data);
			//Cria uma Janela
			$window = new TWindow('Dados do Formulario');
			//Define posição e tamanho
			$window->setPosition('300','70');
			$window->setSize('300','150');
			
			//Monta o Texto a ser Exibido
			$output = "Nome: $data->Nome\n";
			$output .= "Email: $data->Email\n";
			$output .= "Titulo: $data->Titulo\n";
			$output .= "Mensagem:\n$data->Mensagem\n";
			
			//Cria o Objeto de Texto
			$texto = new TText('TEXTO','300');
			$texto->setSize('290','120');
			$texto->setValue($output);
			
			//Adiciona o objeto a janela
			$window->add($texto);
			$window->show();
		}
		
		function onSend(){
			//SEM IMPLEMENTAÇÃO
		}
	}
	
	$pagina = new emailForm();
	$pagina->show();
?>