<?php
class knl_extensions_dnfsaida_model extends knl_lib_daoext_Convert {
     private $id;
     private $id_doc;
     private $id_fornecedor;
     private $datasai;

     public function __construct($id,$id_doc,$id_fornecedor,$datasai){
        $this->id = $id;
        $this->id_doc = $id_doc;
        $this->id_fornecedor = $id_fornecedor;
        $this->datasai = $datasai;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_d_nf_saida);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['d_nf_saida_'.$k] = $this->$v();
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

     public function get_datasai_db() {
        return $this->datasai;
     }

     public function get_datasai() {
        $this->datasai = $this->data_mysql_to_br($this->datasai);
        return $this->datasai;
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

     public function set_datasai($datasai) {
        $this->datasai = $this->data_br_to_mysql($this->datasai);
        $this->datasai = $datasai;
     }

}
?>
