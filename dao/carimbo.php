<?php
class knl_dao_carimbo {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,descricao,cfop
                             FROM carimbo
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,descricao,cfop
                             FROM carimbo
                             WHERE 1 = 1 ";
    
    private $SELECT_PURE = "SELECT tb.id,tb.descricao,tb.cfop
                             FROM carimbo tb ";

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
          $objmodel = new knl_model_carimbo($l['id'],$l['descricao'],$l['cfop']);
       } else {
            throw new Exception("Nenhum carimbo foi encontrado!");
         }
       return $objmodel;
    }
    
    public function selectByUserGroup($id_usuario,$id_grupo,$arrayGrupos) {
       $criteriaObj = knl_lib_Criteria::getInstance();
       $criteriaObj->montaSqlCred($id_usuario,$id_grupo,$arrayGrupos);
       $query = $this->SELECT_PURE." LEFT JOIN carimbo_cred cr ON (cr.id_carimbo = tb.id)
       								 WHERE 1=1 ".$criteriaObj->get_sql();
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$criteriaObj->get_ArrayBind());
       $carimbo = array();

       while($l = $stmt->FetchRow()) {
          $carimbo[] = new knl_model_carimbo($l['id'],$l['descricao'],$l['cfop']);
       }
       return $carimbo;
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_model_carimbo $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO carimbo (descricao,cfop)
                    VALUES ('".$objmodel->get_descricao()."','".$objmodel->get_cfop()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE carimbo SET 
                      descricao='{$objmodel->get_descricao()}',cfop='{$objmodel->get_cfop()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
