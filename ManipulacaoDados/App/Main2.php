<?php
	//CONSULTA MULTICRITERIO
	$artista = $_POST['artista'];
	$album = $_POST['album'];
	$gravadora = $_POST['gravadora'];
	
	$sqlSelect = "SELECT codigo, nome FROM discos WHERE ";
	
	if(isset($artista)){
		$sqlSelect .= "artista LIKE '%$artista%' AND";		
	}if(isset($album)){
		$sqlSelect .= "album LIKE '%$album%' AND";		
	}if(isset($gravadora)){
		$sqlSelect .= "gravadora LIKE '%$gravadora%' AND";		
	}
	
	//echo substr($sqlSelect,0,-4) . '<br />';
?>