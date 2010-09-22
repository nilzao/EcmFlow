<?php	
error_reporting(E_ALL | E_STRICT);
function __autoload($class_name) {
    if(substr($class_name,0,4)=='knl_') {
    	if (substr($class_name,0,7)=='knl_dao') {$location = "dao/".substr($class_name,8).".php";}
    	else if (substr($class_name,0,9)=='knl_model') {$location = "model/".substr($class_name,10).".php";}
    	else {$location = str_replace("_","/",substr($class_name,4)).".php";}
        if(file_exists($location)) {
            require_once $location;
        } else {
            throw new Exception("Classe $class_name não foi encontrada");
        }
    }
}

$path = './lib/adodb5'. PATH_SEPARATOR ."./lib/mailer";
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once("adodb.inc.php");
header( 'Content-type: text/html; charset=utf-8' );
$shell = (isset($argv)) ? $argv : array();
knl_controller_FrontController::dispatch($shell);
?>
