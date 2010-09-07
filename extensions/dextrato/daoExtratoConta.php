<?php
class knl_extensions_dextrato_daoExtratoConta {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_agencia,numero,obs,id_empresa
                             FROM d_extrato_conta
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_agencia,numero,obs,id_empresa
                             FROM d_extrato_conta
                             WHERE 1 = 1 ";
    
    private function __construct() {
         $this->conn = knl_lib_DataBase::getDataBase();
    }
    public static function getInstance() {
       if(!isset(self::$instance)) {
           self::$instance = new self();
       }
       return self::$instance;
    }

    public function selectById($id) {
       $id = (empty($id)) ? -1 :$id;
       $stmt = $this->conn->prepare($this->SELECT_BY_ID);
       $stmt = $this->conn->execute($stmt,$id);

       if($l = $stmt->FetchRow()) {
          $objmodel = new knl_extensions_dextrato_modelExtratoConta($l['id'],$l['id_agencia'],$l['numero'],$l['obs'],$l['id_empresa']);
       } else {
            throw new Exception("Nenhum d_extrato_conta foi encontrado!");
         }
       return $objmodel;
    }
    
	public function selectAll() {
	   $query = $this->SELECT_BY_CRITERIA." AND id != -1 ORDER BY numero";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt);
       $contas = array();
       
       while($l = $stmt->FetchRow()) {
          $contas[] = new knl_extensions_dextrato_modelExtratoConta($l['id'],$l['id_agencia'],$l['numero'],$l['obs'],$l['id_empresa']);
       } 
       return $contas;
    }
    
	public function selectByNumConta($num_conta) {
	   $query = $this->SELECT_BY_CRITERIA." AND numero = ? ";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$num_conta);

       if($l = $stmt->FetchRow()) {
          $objmodel = new knl_extensions_dextrato_modelExtratoConta($l['id'],$l['id_agencia'],$l['numero'],$l['obs'],$l['id_empresa']);
       } else {
       		$objmodel = new knl_extensions_dextrato_modelExtratoConta(-1,0,0,"",1);
       }
       return $objmodel;
    }
    
    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_extensions_dextrato_modelExtratoConta $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO d_extrato_conta (id_agencia,numero,obs,id_empresa)
                    VALUES ('".$objmodel->get_id_agencia()."','".$objmodel->get_numero()."','".$objmodel->get_obs()."','".$objmodel->get_id_empresa()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE d_extrato_conta SET 
                      id_agencia='{$objmodel->get_id_agencia()}',numero='{$objmodel->get_numero()}',obs='{$objmodel->get_obs()}',id_empresa='{$objmodel->get_id_empresa()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
