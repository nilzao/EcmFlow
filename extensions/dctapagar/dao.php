<?php
class knl_extensions_dctapagar_dao extends knl_extensions_cadastronf_CadParent {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_doc,id_fornecedor,data_vencimento
                             FROM d_cta_pagar
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_doc,id_fornecedor,data_vencimento
                             FROM d_cta_pagar
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
          $objmodel = new knl_extensions_dctapagar_model($l['id'],$l['id_doc'],$l['id_fornecedor'],$l['data_vencimento']);
       } else {
            throw new Exception("Nenhum d_cta_pagar foi encontrado!");
         }
       return $objmodel;
    }
    
	public function getFullData($mDocH){
    	$arrModel = array();
    	$arrModel = parent::getFullData($mDocH);
    	/*
    	$Carimbo = knl_dao_doc_carimbo::getInstance();
    	$mCarimbos = $Carimbo->selectByIdDoc($mDocH->get_id_doc());
    	$CarimboTipo = knl_dao_carimbo::getInstance();
    	foreach($mCarimbos as $k=>$v) {
			if($v->get_id_carimbo() != 0){
		  		$mCarimboTipo = $CarimboTipo->selectById($v->get_id_carimbo());
		  		$arrModel['carimbos'][] = array('doc_carimbo'=>$mCarimbos[$k],'carimbo'=>$mCarimboTipo);
			}
		}*/
    	return $arrModel;
    }

    public function selectByIdDoc($id_doc) {
       $query = $this->SELECT_BY_CRITERIA." AND id_doc = ?";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$id_doc);

       if($l = $stmt->FetchRow()) {
          $objmodel = new knl_extensions_dctapagar_model($l['id'],$l['id_doc'],$l['id_fornecedor'],$l['data_vencimento']);
       } else {
            throw new Exception("Nenhum d_cta_pagar foi encontrado!");
         }
       return $objmodel;
    }
    
    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_extensions_dctapagar_model $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO d_cta_pagar (id_doc,id_fornecedor,data_vencimento)
                    VALUES ('".$objmodel->get_id_doc()."','".$objmodel->get_id_fornecedor()."','".$objmodel->get_data_vencimento_db()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE d_cta_pagar SET 
                      id_doc='{$objmodel->get_id_doc()}',id_fornecedor='{$objmodel->get_id_fornecedor()}',data_vencimento='{$objmodel->get_data_vencimento_db()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
