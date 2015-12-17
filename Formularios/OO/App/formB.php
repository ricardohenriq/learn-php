<?php
/* Criar um Formulario com
* Abstração de Componentes
* Usando Painel (TPanel)
* FOCO --
* Design e Layout
*/
	function __autoload($classe){
		if(file_exists("../app.widgets/$classe.class.php")){
			include_once "../app.widgets/$classe.class.php";
		}
	}
	
	//Cria o Formulario
	$form = new TForm('formPessoas');
	
	//Cria um Painel
	$painel = new TPanel('440','200');
	
	//Adicona o Painel ao Formulario
	$form->add($painel);
	
	//Cria um rotulo de texto para o Titulo
	$titulo = new TLabel('Exemplo');
	$titulo->setFontFace('Arial');
	$titulo->setFontColor('#ff0000');
	$titulo->setFontSize('18');
	
	//Posiciona o titulo no Painel
	$painel->put($titulo,'120','4');
	
	$imagem = new TImage('../app.images/mouse.png');
	//Posiciona a imagem no painel
	$painel->put($imagem,'320','120'); 
	
	//Cria uma serie de Campos de entrada de dados
	$codigo = new TEntry('codigo');
	$nome = new TEntry('nome');
	$endereco = new TEntry('endereco');
	$telefone = new TEntry('telefone');
	$cidade = new TCombo('cidade');
	$itens = Array();
	$itens['1'] = 'Porto Alegre';
	$itens['2'] = 'Lajeado';
	$cidade->addItems($itens);
	
	//Ajusta o Tamanho destes Campos
	$codigo->setSize('70');
	$nome->setSize('140');
	$endereco->setSize('140');
	$telefone->setSize('140');
	$cidade->setSize('140');
	
	//Cria uma serie de Rotulos de Texto
	$label1 = new TLabel('Código');
	$label2 = new TLabel('Nome');
	$label3 = new TLabel('Cidade');
	$label4 = new TLabel('Endereço');
	$label5 = new TLabel('Telefone');
	
	//Posiciona os Campos e os Rotulos dentro do Painel
	$painel->put($label1,'10','40');
	$painel->put($codigo,'10','60');
	$painel->put($label2,'10','90');
	$painel->put($nome,'10','110');
	$painel->put($label3,'10','140');
	$painel->put($cidade,'10','160');
	$painel->put($label4,'200','40');
	$painel->put($endereco,'200','60');
	$painel->put($label5,'200','90');
	$painel->put($telefone,'200','110');
	
	//Exibe o Formulario
	$form->show();
?>