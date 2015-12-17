<?php
    //conexão com o banco de dados
	mysql_connect("localhost","teste","teste");
	mysql_select_db("searchengine" );
 
    //verifica a página atual caso seja informada na URL, senão atribui como 1ª página
	$pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
 
    //seleciona todos os itens da tabela
	$cmd = "SELECT * FROM produtos";
	$produtos = mysql_query($cmd);
   
    //conta o total de itens
	$total = mysql_num_rows($produtos);
   
    //seta a quantidade de itens por página, neste caso, 2 itens
	$registros = 2;
   
    //calcula o número de páginas arredondando o resultado para cima
	$numPaginas = ceil($total/$registros);
   
    //variavel para calcular o início da visualização com base na página atual
	$inicio = ($registros*$pagina)-$registros;
 
    //seleciona os itens por página
	$cmd = "SELECT * FROM produtos LIMIT $inicio,$registros";
	$produtos = mysql_query($cmd);
	$total = mysql_num_rows($produtos);
 
    //exibe os produtos selecionados
	while ($produto = mysql_fetch_array($produtos)) {
		echo $produto['id']." - ";
		echo $produto['nome']." - ";
		echo $produto['descricao']." - ";
		echo "R$ ".$produto['valor']."<br />";
	}
 
    //exibe a paginação
    if($pagina > 1) {
        echo "<a href='paginacao.php?pagina=".($pagina - 1)."' class='controle'>&laquo; anterior</a>".'&nbsp;&nbsp;';
    }
     
    for($i = 1; $i < $numPaginas + 1; $i++) {
        $ativo = ($i == $pagina) ? 'numativo' : '';
        echo "<a href='paginacao.php?pagina=".$i."' class='numero ".$ativo."'> ".$i." </a>".'&nbsp;&nbsp;';
    }
         
    if($pagina < $numPaginas) {
        echo "<a href='paginacao.php?pagina=".($pagina + 1)."' class='controle'>proximo &raquo;</a>".'&nbsp;&nbsp;';
    }
?>