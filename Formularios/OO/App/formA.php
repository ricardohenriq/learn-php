<?php
/* Criar um Formulario com
* Abstração de Componentes
* Usando Tabela (TTable)
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
	
	//Cria a Tabala para Organizar Layout
	$table = new TTable();
	$table->border = '1';
	$table->style = 'background-color:#f2f2f2';
	
	//Adiciona tabela no Formulario
	$form->add($table);
	
	//Cria um rotulo de texto para o Titulo
	$titulo = new TLabel('Exemplo');
	$titulo->setFontFace('Arial');
	$titulo->setFontColor('#ff0000');
	$titulo->setFontSize('18');
	
	//Adiciona uma linha na tabela
	$row = $table->addRow();
	$titulo = $row->addCell($titulo);
	$titulo->colspan = 2;
	
	//Cria duas outras tabelas (Subtabelas)
	$table1 = new TTable();
	$table2 = new TTable();
	
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
	
	//Adiciona Linha na SubTabela para o $codigo
	$row = $table1->addRow();
	$row->addCell($label1);
	$row->addCell($codigo);
	
	//Adiciona Linha na SubTabela para o $nome
	$row = $table1->addRow();
	$row->addCell($label2);
	$row->addCell($nome);
	
	//Adiciona Linha na SubTabela para o $cidade
	$row = $table1->addRow();
	$row->addCell($label3);
	$row->addCell($cidade);
	
	//Adiciona Linha na SubTabela para o $endereco
	$row = $table2->addRow();
	$row->addCell($label4);
	$row->addCell($endereco);
	
	//Adiciona Linha na SubTabela para o $telefone
	$row = $table2->addRow();
	$row->addCell($label5);
	$row->addCell($telefone);
	
	//Adiciona as Tabelas lado a lado na Tabela Principal
	$row = $table->addRow();
	$row->addCell($table1);
	$row->addCell($table2);
	
	//Exibe o Formulario
	$form->show();
?>