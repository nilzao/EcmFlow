<?php
/**
* View Helper estatica 
* carrega com ob_start() o conteudo do arquivo da view no método display()
*/
class knl_view_Loader {
/**
 * instancia da própria helper retornada no metodo getInstance()
 * @var objeto
 */
    private static $instance;
    private $vars = array();

/**
 * __construct privada somente para evitar instancia, a nao ser pelo metodo
 * getInstance()
 */    
    private function __construct() {}

/**
 * retorna uma instancia a classe View Helper
 * @return object
 */
    public static function getInstance() {
       if(!isset(self::$instance)) {
           self::$instance = new self();
       }
       return self::$instance;
    }
    
    public function setVar($name, $var) {
        $this->vars[$name] = $var;
    }
    
    public function getVar($name, $error=true) {
        if(isset($this->vars[$name])) {
            return $this->vars[$name];
        } elseif($error) {
            throw new Exception("Variável $name não está definida!");
        }
    }
    
    public function isSetVar($name){
    	return isset($this->vars[$name]);
    }
    
    public function display($view, $echo = true, $extension = false) {
        $knl_helper = $this;
        ob_start();
        try {
        	if($extension){
        		require("extensions/$view.php");
        	} else {
        		require("view/$view.php");
        	}
            $visualizacao = ob_get_clean(); 
            if($echo){echo $visualizacao;} 
            return $visualizacao;
        } catch(Exception $e) {
            ob_end_clean();
            print_r($e);
            require("view/error.php");
        }
    }
}
?>
