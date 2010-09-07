<?php
class knl_extensions_dcaixa_model extends knl_lib_daoext_Convert {
     private $id;
     private $id_doc;
     private $data_ini;
     private $data_fim;

     public function __construct($id,$id_doc,$data_ini,$data_fim){
        $this->id = $id;
        $this->id_doc = $id_doc;
        $this->data_ini = $data_ini;
        $this->data_fim = $data_fim;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_d_caixa);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['d_caixa_'.$k] = $this->$v();
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

     public function get_data_ini_db() {
        return $this->data_ini;
     }

     public function get_data_ini() {
        $this->data_ini = $this->data_mysql_to_br($this->data_ini);
        return $this->data_ini;
     }

     public function get_data_fim_db() {
        return $this->data_fim;
     }

     public function get_data_fim() {
        $this->data_fim = $this->data_mysql_to_br($this->data_fim);
        return $this->data_fim;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_id_doc($id_doc) {
        $this->id_doc = $id_doc;
     }

     public function set_data_ini($data_ini) {
        $this->data_ini = $this->data_br_to_mysql($this->data_ini);
        $this->data_ini = $data_ini;
     }

     public function set_data_fim($data_fim) {
        $this->data_fim = $this->data_br_to_mysql($this->data_fim);
        $this->data_fim = $data_fim;
     }

}
?>
