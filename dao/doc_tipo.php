<?php
class knl_dao_doc_tipo {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,descricao,classe,ordem
                             FROM doc_tipo
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,descricao,classe,ordem
                             FROM doc_tipo
                             WHERE 1 = 1 ";
    
    private $SELECT_PURE = "SELECT tb.id,tb.descricao,tb.classe,tb.ordem
                             FROM doc_tipo tb ";

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
          $objmodel = new knl_model_doc_tipo($l['id'],$l['descricao'],$l['classe'],$l['ordem']);
       } else {
            throw new Exception("Nenhum doc_tipo foi encontrado!");
         }
       return $objmodel;
    }
    
	public function selectAll() {
       $stmt = $this->conn->prepare($this->SELECT_BY_CRITERIA." ORDER BY descricao");
       $stmt = $this->conn->execute($stmt);
       $doctp = array();

       while($l = $stmt->FetchRow()) {
          $doctp[] = new knl_model_doc_tipo($l['id'],$l['descricao'],$l['classe'],$l['ordem']);
       }
       return $doctp;
    }
    
    public function selectByUserGroup($id_usuario,$id_grupo,$arrayGrupos) {
       $criteriaObj = knl_lib_Criteria::getInstance();
       $criteriaObj->montaSqlCred($id_usuario,$id_grupo,$arrayGrupos);
       $query = $this->SELECT_PURE." LEFT JOIN doc_tipo_cred cr ON (cr.id_doc_tipo = tb.id)
       								 WHERE 1=1 ".$criteriaObj->get_sql()."
       								 ORDER BY tb.descricao";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$criteriaObj->get_ArrayBind());

       $doctipo = array();

       while($l = $stmt->FetchRow()) {
          $doctipo[] = new knl_model_doc_tipo($l['id'],$l['descricao'],$l['classe'],$l['ordem']);
       }
       return $doctipo;
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_model_doc_tipo $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO doc_tipo (descricao,classe,ordem)
                    VALUES ('".$objmodel->get_descricao()."','".$objmodel->get_classe()."','".$objmodel->get_ordem()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE doc_tipo SET 
                      descricao='{$objmodel->get_descricao()}',classe='{$objmodel->get_classe()}',ordem='{$objmodel->get_ordem()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
