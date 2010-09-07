<?php
class knl_dao_knl_perm_bin {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,permbin,descricao
                             FROM knl_perm_bin
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,permbin,descricao
                             FROM knl_perm_bin
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
          $objmodel = new knl_model_knl_perm_bin($l['id'],$l['permbin'],$l['descricao']);
       } else {
            throw new Exception("Nenhum knl_perm_bin foi encontrado!");
         }
       return $objmodel;
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_model_knl_perm_bin $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO knl_perm_bin (permbin='{$objmodel->get_permbin()}',descricao='{$objmodel->get_descricao()}')
                    VALUES ('".$objmodel->get_permbin()."','".$objmodel->get_descricao()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE knl_perm_bin SET 
                      permbin='{$objmodel->get_permbin()}',descricao='{$objmodel->get_descricao()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
