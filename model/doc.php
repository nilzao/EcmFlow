<?php
class knl_model_doc extends knl_lib_daoext_Convert {
     private $id;
     private $id_doc_tipo;
     private $id_doc_sub_tipo;
     private $id_empresa;
     private $numero;
     private $data_doc;
     private $pag;

     public function __construct($id,$id_doc_tipo,$id_doc_sub_tipo,$id_empresa,$numero,$data_doc,$pag){
        $this->id = $id;
        $this->id_doc_tipo = $id_doc_tipo;
        $this->id_doc_sub_tipo = $id_doc_sub_tipo;
        $this->id_empresa = $id_empresa;
        $this->numero = $numero;
        $this->data_doc = $data_doc;
        $this->pag = $pag;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_doc);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['doc_'.$k] = $this->$v();
         }
         return $varsZ;
     }
     
     // get functions:

     public function get_id() {
        return $this->id;
     }

     public function get_id_doc_tipo() {
        return $this->id_doc_tipo;
     }

     public function get_id_doc_sub_tipo() {
        return $this->id_doc_sub_tipo;
     }

     public function get_id_empresa() {
        return $this->id_empresa;
     }

     public function get_numero() {
        return $this->numero;
     }

     public function get_data_doc_db() {
        return $this->data_doc;
     }

     public function get_data_doc() {
        $this->data_doc = $this->data_mysql_to_br($this->data_doc);
        return $this->data_doc;
     }

     public function get_pag() {
        return $this->pag;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_id_doc_tipo($id_doc_tipo) {
        $this->id_doc_tipo = $id_doc_tipo;
     }

     public function set_id_doc_sub_tipo($id_doc_sub_tipo) {
        $this->id_doc_sub_tipo = $id_doc_sub_tipo;
     }

     public function set_id_empresa($id_empresa) {
        $this->id_empresa = $id_empresa;
     }

     public function set_numero($numero) {
        $this->numero = $numero;
     }

     public function set_data_doc($data_doc) {
        $this->data_doc = $this->data_br_to_mysql($this->data_doc);
        $this->data_doc = $data_doc;
     }

     public function set_pag($pag) {
        $this->pag = $pag;
     }

}
?>
