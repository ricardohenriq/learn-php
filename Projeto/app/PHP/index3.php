<?php

    // Inicializa o buffer e bloqueia qualquer saída para o navegador
    ob_start();
    
    // Executamos o phpinfo() normalmente
    phpinfo();
    
    // Neste momento nenhuma saída foi enviada ao navegador
    
    // Recebemos o valor do buffer na variável $resultado
    $resultado = ob_get_contents();
    
    // Já podemos encerrar o buffer e limpar tudo que há nele
    ob_end_clean();
    
    // Agora é só gravar um arquivo com os dados coletados
    $ok = file_put_contents('phpinfo.html', $resultado);
    
    // Envia uma mensagem para o usuário indicando se ocorreu tudo OK
    if ($ok) {
        print 'Arquivo gravado com sucesso.<br />';
        print '<a href="phpinfo.html">Clique aqui para visualizar</a>';
    } else {
        print 'Ocorreu um erro. Verifique o permissionamento.';
    }
    
?>