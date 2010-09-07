<?php
class knl_extensions_dcotcompra_dao {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_doc,id_fornecedor
                             FROM d_cot_compra
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_doc,id_fornecedor
                             FROM d_cot_compra
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
          $objmodel = new knl_extensions_dcotcompra_model($l['id'],$l['id_doc'],$l['id_fornecedor']);
       } else {
            throw new Exception("Nenhum d_cot_compra foi encontrado!");
         }
       return $objmodel;
    }
    
    public function selectByIdDoc($id_doc) {
       $query = $this->SELECT_BY_CRITERIA." AND id_doc = ?";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$id_doc);

       if($l = $stmt->FetchRow()) {
          $objmodel = new knl_extensions_dcotcompra_model($l['id'],$l['id_doc'],$l['id_fornecedor']);
       } else {
            throw new Exception("Nenhum d_cot_compra foi encontrado!");
         }
       return $objmodel;
    }

	public function getFullData($param){
    	$arrModel = array();
        $arrModel["d_cotacao_forn"]= knl_extensions_cadastronf_cotDao::getInstance()->selectById($param->get_id_fornecedor());
        return $arrModel;
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_extensions_dcotcompra_model $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO d_cot_compra (id_doc,id_fornecedor)
                    VALUES ('".$objmodel->get_id_doc()."','".$objmodel->get_id_fornecedor()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE d_cot_compra SET 
                      id_doc='{$objmodel->get_id_doc()}',
                      id_fornecedor='{$objmodel->get_id_fornecedor()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }

}
?>
