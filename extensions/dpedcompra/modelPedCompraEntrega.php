<?php
class knl_extensions_dpedcompra_modelPedCompraEntrega extends knl_lib_daoext_Convert {
     private $id;
     private $id_d_ped_compra;
     private $dataentrega;

     public function __construct($id,$id_d_ped_compra,$dataentrega){
        $this->id = $id;
        $this->id_d_ped_compra = $id_d_ped_compra;
        $this->dataentrega = $dataentrega;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_d_ped_compra_entrega);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['d_ped_compra_entrega_'.$k] = $this->$v();
         }
         return $varsZ;
     }
     
     // get functions:

     public function get_id() {
        return $this->id;
     }

     public function get_id_d_ped_compra() {
        return $this->id_d_ped_compra;
     }

     public function get_dataentrega_db() {
        return $this->dataentrega;
     }

     public function get_dataentrega() {
        $this->dataentrega = $this->data_mysql_to_br($this->dataentrega);
        return $this->dataentrega;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_id_d_ped_compra($id_d_ped_compra) {
        $this->id_d_ped_compra = $id_d_ped_compra;
     }

     public function set_dataentrega($dataentrega) {
        $this->dataentrega = $this->data_br_to_mysql($this->dataentrega);
        $this->dataentrega = $dataentrega;
     }

}
?>
