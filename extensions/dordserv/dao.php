<?php
class knl_extensions_dordserv_dao {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_doc,id_fornecedor,malha,fio
                             FROM d_ord_serv
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_doc,id_fornecedor,malha,fio
                             FROM d_ord_serv
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
          $objmodel = new knl_extensions_dordserv_model($l['id'],$l['id_doc'],$l['id_fornecedor'],$l['malha'],$l['fio']);
       } else {
            throw new Exception("Nenhum d_ord_serv foi encontrado!");
         }
       return $objmodel;
    }
    
    public function selectByIdDoc($id_doc) {
       $query = $this->SELECT_BY_CRITERIA." AND id_doc = ?";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$id_doc);

       if($l = $stmt->FetchRow()) {
          $objmodel = new knl_extensions_dordserv_model($l['id'],$l['id_doc'],$l['id_fornecedor'],$l['malha'],$l['fio']);
       } else {
            throw new Exception("Nenhum d_ord_serv foi encontrado!");
         }
       return $objmodel;
    }

	public function getFullData($param){
    	$arrModel = array();
        $arrModel["d_ord_serv_cli"]= knl_extensions_cadastronf_cotDao::getInstance()->selectById($param->get_id_fornecedor());
        return $arrModel;
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_extensions_dordserv_model $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO d_ord_serv (id_doc,id_fornecedor,malha,fio)
                    VALUES ('".$objmodel->get_id_doc()."','".$objmodel->get_id_fornecedor()."','".$objmodel->get_malha()."','".$objmodel->get_fio()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE d_ord_serv SET 
                      id_doc='{$objmodel->get_id_doc()}',
                      id_fornecedor='{$objmodel->get_id_fornecedor()}',
                      malha='{$objmodel->get_malha()}',
                      fio='{$objmodel->get_fio()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }

}
?>
