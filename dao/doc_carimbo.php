<?php
class knl_dao_doc_carimbo {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_doc,id_carimbo
                             FROM doc_carimbo
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_doc,id_carimbo
                             FROM doc_carimbo
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
          $objmodel = new knl_model_doc_carimbo($l['id'],$l['id_doc'],$l['id_carimbo']);
       } else {
            throw new Exception("Nenhum doc_carimbo foi encontrado!");
         }
       return $objmodel;
    }

    public function selectByIdDoc($id_doc) {
       $query = $this->SELECT_BY_CRITERIA." AND id_doc = ?";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$id_doc);
       $carimbos = array();

       while($l = $stmt->FetchRow()) {
          $carimbos[] = new knl_model_doc_carimbo($l['id'],$l['id_doc'],$l['id_carimbo']);
       }
       return $carimbos;
    }
    
    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }
    
    public function deleteByIdDoc($id_doc){
    	$query = "DELETE FROM doc_carimbo WHERE id_doc = ?";
    	$stmt = $this->conn->prepare($query);
    	$stmt = $this->conn->execute($stmt,$id_doc);
    }

    public function upsert(knl_model_doc_carimbo $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO doc_carimbo (id_doc,id_carimbo)
                    VALUES ('".$objmodel->get_id_doc()."','".$objmodel->get_id_carimbo()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE doc_carimbo SET 
                      id_doc='{$objmodel->get_id_doc()}',id_carimbo='{$objmodel->get_id_carimbo()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
