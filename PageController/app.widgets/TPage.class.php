<?php
/**
 * classe TPage
 * classe para controle do fluxo de execuчуo
 * mediante parametros passados via URL
 */
class TPage extends TElement
{
    /**
     * mщtodo __construct()
     */
    public function __construct()
    {
        // define o elemento que irс representar
        parent::__construct('html');
    }
    
    /**
     * mщtodo show()
     * exibe o conteњdo da pсgina
     */
    public function show()
    {
        $this->run();
        parent::show();
    }
    
    /**
     * mщtodo run()
     * executa determinado mщtodo de acordo com os parтmetros recebidos
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
			//Vefirifica se foi passado um Mщtodo //Estruturado
            if ($class)
            {
                //$object = $class == get_class($this) ? $this : new $class;
				$object = new $class;
                if (method_exists($object, $method))
                {
                    call_user_func(array($object, $method), $_GET);
					//Irс chamar o mщtodo dentro do objeto com o 
					//$_GET 'Bruto', dentro do mщtodo serс feito a 
					//segregaчуo do que foi passado
					//junto com a URL : //page1.php?method=listar
					//e que foi capturado com o $_GET
                }
            }
            else if (function_exists($method))
            {
                call_user_func($method, $_GET);
				//Irс chamar o mщtodo com o $_GET 'Bruto', dentro
				//do mщtodo serс feito a segregaчуo do que foi passado
				//junto com a URL : //page1.php?method=listar
				//e que foi capturado com o $_GET
            }
        }
    }
}
?>