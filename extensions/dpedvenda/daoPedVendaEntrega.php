<?php
class knl_extensions_dpedvenda_daoPedVendaEntrega {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_d_ped_venda,dataentrega
                             FROM d_ped_venda_entrega
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_d_ped_venda,dataentrega
                             FROM d_ped_venda_entrega
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
          $objmodel = new knl_extensions_dpedvenda_modelPedVendaEntrega($l['id'],$l['id_d_ped_venda'],$l['dataentrega']);
       } else {
            throw new Exception("Nenhum d_ped_venda_entrega foi encontrado!");
         }
       return $objmodel;
    }
    
    public function selectByIdDoc($id_doc) {
       $query = $this->SELECT_BY_CRITERIA." AND id_d_ped_venda = ? ORDER BY dataentrega ";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$id_doc);
       $objmodel = array();

       while($l = $stmt->FetchRow()) {
          $objmodel[] = new knl_extensions_dpedvenda_modelPedVendaEntrega($l['id'],$l['id_d_ped_venda'],$l['dataentrega']);
       }
       return $objmodel;
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }
    
    public function deleteByIdPedVenda($id_d_ped_venda){
    	$query = "DELETE FROM d_ped_venda_entrega WHERE id_d_ped_venda = ?";
    	$stmt = $this->conn->prepare($query);
    	$stmt = $this->conn->execute($stmt,$id_d_ped_venda);
    }

    public function upsert(knl_extensions_dpedvenda_modelPedVendaEntrega $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO d_ped_venda_entrega (id_d_ped_venda,dataentrega)
                    VALUES ('".$objmodel->get_id_d_ped_venda()."','".$objmodel->get_dataentrega_db()."')";
          $stmt = $this->conn->prepare($query);
          //echo $query;die();
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE d_ped_venda_entrega SET 
                      id_d_ped_venda='{$objmodel->get_id_d_ped_venda()}',dataentrega='{$objmodel->get_dataentrega_db()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
