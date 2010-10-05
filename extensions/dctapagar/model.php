<?php
class knl_extensions_dctapagar_model extends knl_lib_daoext_Convert {
     private $id;
     private $id_doc;
     private $id_fornecedor;
     private $data_vencimento;

     public function __construct($id,$id_doc,$id_fornecedor,$data_vencimento){
        $this->id = $id;
        $this->id_doc = $id_doc;
        $this->id_fornecedor = $id_fornecedor;
        $this->data_vencimento = $data_vencimento;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_d_nf_entrada);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['d_cta_pagar'.$k] = $this->$v();
         }
         return $varsZ;
     }
     
     // get functions:

     public function get_id() {
        return $this->id;
     }

     public function get_id_doc() {
        return $this->id_doc;
     }

     public function get_id_fornecedor() {
        return $this->id_fornecedor;
     }

     public function get_data_vencimento_db() {
        return $this->dataent;
     }

     public function get_data_vencimento() {
        $this->dataent = $this->data_mysql_to_br($this->dataent);
        return $this->dataent;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_id_doc($id_doc) {
        $this->id_doc = $id_doc;
     }

     public function set_id_fornecedor($id_fornecedor) {
        $this->id_fornecedor = $id_fornecedor;
     }

     public function set_data_vencimento($data_vencimento) {
        $this->data_vencimento = $data_vencimento;
     }

}
?>
