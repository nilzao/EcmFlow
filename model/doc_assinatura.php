<?php
class knl_model_doc_assinatura extends knl_lib_daoext_Convert {
     private $id;
     private $id_doc;
     private $id_doc_assinatura_tipo;
     private $id_knl_usuario;
     private $data_assinatura;
     private $valida;

     public function __construct($id,$id_doc,$id_doc_assinatura_tipo,$id_knl_usuario,$data_assinatura,$valida){
        $this->id = $id;
        $this->id_doc = $id_doc;
        $this->id_doc_assinatura_tipo = $id_doc_assinatura_tipo;
        $this->id_knl_usuario = $id_knl_usuario;
        $this->data_assinatura = $data_assinatura;
        $this->valida = $valida;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_doc_assinatura);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['doc_assinatura_'.$k] = $this->$v();
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

     public function get_id_doc_assinatura_tipo() {
        return $this->id_doc_assinatura_tipo;
     }

     public function get_id_knl_usuario() {
        return $this->id_knl_usuario;
     }

     public function get_data_assinatura_db() {
        return $this->data_assinatura;
     }

     public function get_data_assinatura() {
        $this->data_assinatura = $this->datatime_mysql_to_br($this->data_assinatura);
        return $this->data_assinatura;
     }

     public function get_valida() {
        return $this->valida;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_id_doc($id_doc) {
        $this->id_doc = $id_doc;
     }

     public function set_id_doc_assinatura_tipo($id_doc_assinatura_tipo) {
        $this->id_doc_assinatura_tipo = $id_doc_assinatura_tipo;
     }

     public function set_id_knl_usuario($id_knl_usuario) {
        $this->id_knl_usuario = $id_knl_usuario;
     }

     public function set_data_assinatura($data_assinatura) {
        $this->data_assinatura = $this->datatime_br_to_mysql($this->data_assinatura);
        $this->data_assinatura = $data_assinatura;
     }

     public function set_valida($valida) {
        $this->valida = $valida;
     }

}
?>
