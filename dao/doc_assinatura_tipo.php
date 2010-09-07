<?php
class knl_dao_doc_assinatura_tipo {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,descricao
                             FROM doc_assinatura_tipo
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,descricao
                             FROM doc_assinatura_tipo
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
          $objmodel = new knl_model_doc_assinatura_tipo($l['id'],$l['descricao']);
       } else {
            throw new Exception("Nenhum doc_assinatura_tipo foi encontrado!");
         }
       return $objmodel;
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_model_doc_assinatura_tipo $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO doc_assinatura_tipo (descricao)
                    VALUES ('".$objmodel->get_descricao()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE doc_assinatura_tipo SET 
                      descricao='{$objmodel->get_descricao()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
