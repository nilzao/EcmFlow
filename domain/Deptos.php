<?php
class knl_domain_Deptos {
  private static $instance;

  private function __construct(){}

  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance;
  }

  public function handle(){
  	$request = knl_lib_Registry::getRequestObj()->getInstance();
  	$metodo = $request->getGet('action');
  	if (method_exists($this,$metodo)){
  		$this->$metodo();
  	}
  }

  public function lst(){
      $Deptos = knl_dao_knl_depto::getInstance();
      $arrayx = $Deptos->selectAll();
      //print_r($arrayx);
      $GruposPerm = knl_dao_knl_grupo::getInstance();
      foreach($arrayx as $v){
         $arrGrupos = $GruposPerm->selectByIdDepto($v->get_Id());
         foreach($arrGrupos as $vg){
             echo $vg->get_nome().": ".$vg->get_id_knl_perm_bin()."<br>";
         }
      }

  }
}
?>
