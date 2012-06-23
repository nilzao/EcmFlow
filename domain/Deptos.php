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
      $lstDpto = $Deptos->selectAll();
      //print_r($arrayx);
      $vl = knl_view_Loader::getInstance();
      $vl->setVar("deptos",$lstDpto);
      $vl->display("DeptoList");
  }
  
  public function formadd(){
	  $vl = knl_view_Loader::getInstance();
      //$vl->setVar("deptos",$lstDpto);
      $vl->display("DeptoForm");
  }
  
  public function add(){
  	  //implementar gravação
  	  echo "gravando no banco";
  }
}
