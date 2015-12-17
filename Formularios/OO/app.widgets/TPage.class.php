<?php
/**
 * classe TPage
 * classe para controle do fluxo de execu��o
 * mediante parametros passados via URL
 */
class TPage extends TElement
{
    /**
     * m�todo __construct()
     */
    public function __construct()
    {
        // define o elemento que ir� representar
        parent::__construct('html');
    }
    
    /**
     * m�todo show()
     * exibe o conte�do da p�gina
     */
    public function show()
    {
        $this->run();
        parent::show();
    }
    
    /**
     * m�todo run()
     * executa determinado m�todo de acordo com os par�metros recebidos
     */
    public function run()
    {
        if ($_GET)//Verifica se foi passado algo junto com a URL
		//page1.php?method=olaMundo&nome=Ricardo
		//page1.php?class=Clientes&method=listar
        {
            $class = isset($_GET['class']) ? $_GET['class'] : NULL;
			//Vefirifica se foi passado uma Classe //POO
            $method = isset($_GET['method']) ? $_GET['method'] : NULL;
			//Vefirifica se foi passado um M�todo //Estruturado
            if ($class)
            {
                //$object = $class == get_class($this) ? $this : new $class;
				$object = new $class;
                if (method_exists($object, $method))
                {
                    call_user_func(array($object, $method), $_GET);
					//Ir� chamar o m�todo dentro do objeto com o 
					//$_GET 'Bruto', dentro do m�todo ser� feito a 
					//segrega��o do que foi passado
					//junto com a URL : //page1.php?method=listar
					//e que foi capturado com o $_GET
                }
            }
            else if (function_exists($method))
            {
                call_user_func($method, $_GET);
				//Ir� chamar o m�todo com o $_GET 'Bruto', dentro
				//do m�todo ser� feito a segrega��o do que foi passado
				//junto com a URL : //page1.php?method=listar
				//e que foi capturado com o $_GET
            }
        }
    }
}
?>