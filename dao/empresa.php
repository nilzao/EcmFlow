<?php
class knl_dao_empresa {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,fantasia,cnpj
                             FROM empresa
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,fantasia,cnpj
                             FROM empresa
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
       $stmt = $this->conn->prepare($this->SELECT_BY_ID);
       $stmt = $this->conn->execute($stmt,$id);

       if($l = $stmt->FetchRow()) {
          $objmodel = new knl_model_empresa($l['id'],$l['fantasia'],$l['cnpj']);
       } else {
            throw new Exception("Nenhum empresa foi encontrado!");
         }
       return $objmodel;
    }
    
    public function selectAll() {
       $stmt = $this->conn->prepare($this->SELECT_BY_CRITERIA)." ORDER BY fantasia";
       $stmt = $this->conn->execute($stmt);
       $empresas = array();

       while($l = $stmt->FetchRow()) {
          $empresas[] = new knl_model_empresa($l['id'],$l['fantasia'],$l['cnpj']);
       }
       return $empresas;
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_model_empresa $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO empresa (fantasia,cnpj)
                    VALUES ('".$objmodel->get_fantasia()."','".$objmodel->get_cnpj()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE empresa SET 
                      fantasia='{$objmodel->get_fantasia()}',cnpj='{$objmodel->get_cnpj()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
