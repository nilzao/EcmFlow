<?php
class knl_extensions_dcaixa_dao {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_doc,data_ini,data_fim
                             FROM d_caixa
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_doc,data_ini,data_fim
                             FROM d_caixa
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
          $objmodel = new knl_extensions_dcaixa_model($l['id'],$l['id_doc'],$l['data_ini'],$l['data_fim']);
       } else {
            throw new Exception("Nenhum d_caixa foi encontrado!");
         }
       return $objmodel;
    }
    
    public function selectByIdDoc($id_doc) {
       $query = $this->SELECT_BY_CRITERIA." AND id_doc = ?";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$id_doc);

       if($l = $stmt->FetchRow()) {
          $objmodel = new knl_extensions_dcaixa_model($l['id'],$l['id_doc'],$l['data_ini'],$l['data_fim']);
       } else {
            throw new Exception("Nenhum d_caixa foi encontrado!");
         }
       return $objmodel;
    }
    
    public function getFullData($param){
    	//print_r($param);
    	$arrModel = array();
    	/*
    	$arrModel = parent::getFullData(array('id_forn'=>$param['id_forn']));
    	$PedEntrega = knl_dao_d_ped_venda_entrega::getInstance();
    	$mPedEntrega = $PedEntrega->selectByIdDoc($param['id']);
    	$arrModel['dataentrega'] = $mPedEntrega;*/
    	return $arrModel;
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_extensions_dcaixa_model $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO d_caixa (id_doc,data_ini,data_fim)
                    VALUES ('".$objmodel->get_id_doc()."','".$objmodel->get_data_ini_db()."','".$objmodel->get_data_fim_db()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE d_caixa SET 
                      id_doc='{$objmodel->get_id_doc()}',data_ini='{$objmodel->get_data_ini_db()}',data_fim='{$objmodel->get_data_fim_db()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
