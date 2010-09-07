<?php
class knl_extensions_dextrato_dao {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_doc,id_conta,data_ini,data_fim
                             FROM d_extrato
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_doc,id_conta,data_ini,data_fim
                             FROM d_extrato
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

    public function selectByIdDoc($id_doc) {
       $query = $this->SELECT_BY_CRITERIA." AND id_doc = ?";
       $stmt = $this->conn->prepare($query);   
       $stmt = $this->conn->execute($stmt,$id_doc);

       if($l = $stmt->FetchRow()) {
          $objmodel = new knl_extensions_dextrato_model($l['id'],$l['id_doc'],$l['id_conta'],$l['data_ini'],$l['data_fim']);
       } else {
            throw new Exception("Nenhum d_Extrato foi encontrado!");
         }
       return $objmodel;
    }
    
    public function getFullData($param){
    	//print_r($param);die();
    	$arrModel = array();
    	$mConta = knl_extensions_dextrato_daoExtratoConta::getInstance()->selectById($param->get_id_conta());
    	$mAgencia = knl_extensions_dextrato_daoExtratoAgencia::getInstance()->selectById($mConta->get_id_agencia());
    	$mBanco = knl_extensions_dextrato_daoExtratoBanco::getInstance()->selectById($mAgencia->get_id_banco());
    	
    	$arrModel['d_extrato_conta'] = $mConta;
    	$arrModel['d_extrato_agencia'] = $mAgencia;
    	$arrModel['d_extrato_banco'] = $mBanco;
    	/*
    	$arrModel = parent::getFullData(array('id_forn'=>$param['id_forn']));
    	$PedEntrega = knl_dao_d_ped_venda_entrega::getInstance();
    	$mPedEntrega = $PedEntrega->selectByIdDoc($param['id']);
    	$arrModel['dataentrega'] = $mPedEntrega;*/
    	return $arrModel;
    }
    
    public function selectById($id) {
       $stmt = $this->conn->prepare($this->SELECT_BY_ID);
       $stmt = $this->conn->execute($stmt,$id);

       if($l = $stmt->FetchRow()) {
          $objmodel = new knl_extensions_dextrato_model($l['id'],$l['id_doc'],$l['id_conta'],$l['data_ini'],$l['data_fim']);
       } else {
            throw new Exception("Nenhum d_extrato foi encontrado!");
         }
       return $objmodel;
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_extensions_dextrato_model $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO d_extrato (id_doc,id_conta,data_ini,data_fim)
                    VALUES ('".$objmodel->get_id_doc()."','".$objmodel->get_id_conta()."','".$objmodel->get_data_ini_db()."','".$objmodel->get_data_fim_db()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE d_extrato SET 
                      id_doc='{$objmodel->get_id_doc()}',id_conta='{$objmodel->get_id_conta()}',data_ini='{$objmodel->get_data_ini_db()}',data_fim='{$objmodel->get_data_fim_db()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
