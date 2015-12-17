<?php
	include_once 'app.widgets/TElement.class.php';
	include_once 'app.widgets/TStyle.class.php';
	
	/*********************************************/
	//CONSTRÓI HTML
	
	//Inicia o documento 'html' <html>
	$html = new TElement('html');
	
	//Instancia a seção 'head' <head>
	$head = new TElement('head');
	$html->add($head);//Adiciona ao 'html' <html>
	
	//Define o titulo da Pagina 'title' <title>
	$title = new TElement('title');
	$title->add('Titulo da Pagina');
	$head->add($title);//Adiciona  ao 'head' <head>
	
	//Instancia a seção 'body' <body>
	$body = new TElement('body');
	$body->style = 'background-color:#cccccc';
	$html->add($body);//Adiciona ao 'html' <html>
	
	//Instancia um Paragrafo 'p' <p>
	$p = new TElement('p');
	$p->align = 'center';
	$p->id = 'paragrafo1';
	$p->add('Flamengo');
	$body->add($p);//Adiciona ao 'body' <body>
	
	//Instancia uma imagem 'img' <img>
	$img = new TElement('img');
	$img->src = 'app.images/Flamengo.png';
	$img->width = '120';
	$img->height = '120';
	$body->add($img);//Adiciona ao 'body' <body>
	
	$hr = new TElement('hr');
	$hr->width = '650';
	$hr->align = 'center';
	$body->add($hr);//Adiciona ao 'body' <body>
	
	$a = new TElement('a');
	$a->href = 'http://www.flamengo.com.br/';
	$a->add('Visite o Site');
	$body->add($a);
	
	$br = new TElement('br');
	$body->add($br);
	
	$button = new TElement('button');
	$button->type = 'button';
	$button->onclick = "alert('FLAMENGO');";
	$button->add('Click Me');
	$body->add($button);
	
	//Exibe o HTML com todos seus elementos filhos
	$html->show();
	
	/*********************************************/
	//CONSTRÓI CSS
	
	//Cria um Estilo para uma Tag, id, class
	$style = new TStyle('p#paragrafo1');
	$style->color = '#ffff00';
	$style->font_family = 'Verdana';
	$style->font_size = '20pt';
	$style->font_weight = 'bold';
	
	$style->show();
?>