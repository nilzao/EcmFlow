<?php
class knl_dao_doc_pendencia_tipo {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,descricao,classe
                             FROM doc_pendencia_tipo
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,descricao,classe
                             FROM doc_pendencia_tipo
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
          $objmodel = new knl_model_doc_pendencia_tipo($l['id'],$l['descricao'],$l['classe']);
       } else {
            throw new Exception("Nenhum doc_pendencia_tipo foi encontrado!");
         }
       return $objmodel;
    }
    
	public function selectAll() {
       $stmt = $this->conn->prepare($this->SELECT_BY_CRITERIA)." ORDER BY descricao";
       $stmt = $this->conn->execute($stmt);
       $pendtipos = array();

       while($l = $stmt->FetchRow()) {
          $pendtipos[] = new knl_model_doc_pendencia_tipo($l['id'],$l['descricao'],$l['classe']);
       }
       return $pendtipos;
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_model_doc_pendencia_tipo $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO doc_pendencia_tipo (descricao,classe)
                    VALUES ('".$objmodel->get_descricao()."','".$objmodel->get_classe()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE doc_pendencia_tipo SET 
                      descricao='{$objmodel->get_descricao()}',classe='{$objmodel->get_classe()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
