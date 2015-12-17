<?php
/* Encapsulamento da Criação da Interface
* e Direcionamento de Fluxo usando 
* TPage e TAction
*/

	function __autoload($classe){
		if(file_exists("../app.widgets/$classe.class.php")){
			include_once "../app.widgets/$classe.class.php";
		}
	}
	
	class pagina extends TPage{
		private $table; //Esta pagina terá uma tabela
		private $content; //Linha que contera a celula Tripla
		//com o resultado do click
		
		/* Método __construct()
		* Instancia uma nova pagina
		*/
		function __construct(){
			parent::__construct();
			
			//Cria uma Tabela
			$this->table = new TTable();
			
			//Define as propriedades da Tabela
			$this->table->border = 1;
			$this->table->width = 500;
			$this->table->style = 'border-collapse:collapse';
			
			//Adiciona uma linha na tabela
			$row = $this->table->addRow();
			
			//Cria tres Ações
			$action1 = new TAction(array($this,'onProdutos'));
			$action2 = new TAction(array($this,'onContatos'));
			$action3 = new TAction(array($this,'onEmpresa'));
			
			//Cria tres Links
			$link1 = new TElement('a');
			$link2 = new TElement('a');
			$link3 = new TElement('a');
			
			//Define Ação dos Links
			$link1->href = $action1->serialize();
			$link2->href = $action2->serialize();
			$link3->href = $action3->serialize();
			
			//Define o Rotulo dos Links
			$link1->add('Produtos');
			$link2->add('Contatos');
			$link3->add('Empresa');
			
			//Adiciona os Links na Linha
			//Logo serão Criadas 3 Linhas
			$row->addCell($link1);
			$row->addCell($link2);
			$row->addCell($link3);
			
			//Cria uma linha para o Conteudo
			//Cria uma linha e atribui a referencia a $content
			$this->content = $this->table->addRow();
			
			//Adiciona a tabela na pagina
			parent::add($this->table);
		}
		
		/* Método onProdutos()
		* Executado quando o usuário clicar no link Produtos
		* @param $get = variavel $_GET
		*/
		function onProdutos($get){
			$texto = 'PRODUTOS PRODUTOS PRODUTOS PRODUTOS <br />
					PRODUTOS PRODUTOS<br />';
			
			//Adiciona o $texto a uma Celula da
			//Linha de Conteudo $content e atribui a 
			//referencia a variavel $celula
			$celula = $this->content->addCell($texto);
			//Deixa a celula com a dimensão de 3 Colunas
			$celula->colspan = 3;
			
			//Cria uma Janela Pop-Up
			$win = new TWindow('Promoção');
			//Define o Tamanho
			$win->setPosition(200,100);
			$win->setSize(240,100);
			
			//Adiciona Texto na janela
			$win->add('TEXTO TEXTO TEXTO TEXTO');
			
			//exibe a janela
			$win->show();
		}
		
		function onContatos($get){
			//SEM IMPLEMENTAÇÃO
		}
		
		function onEmpresa($get){
			//SEM IMPLEMENTAÇÃO
		}
	}
	
	//Instancia uma Pagina
	$objPagina = new pagina();
	//Exibe a pagina juntamente com seu
	//conteudo e interpreta a URL
	$objPagina->show();
?>