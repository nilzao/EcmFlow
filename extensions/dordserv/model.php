<?php
class knl_extensions_dordserv_model {
     private $id;
     private $id_doc;
     private $id_fornecedor;
     private $malha;
     private $fio;

     public function __construct($id,$id_doc,$id_fornecedor,$malha,$fio){
        $this->id = $id;
        $this->id_doc = $id_doc;
        $this->id_fornecedor = $id_fornecedor;
        $this->malha = $malha;
        $this->fio = $fio;
     }

     //get_class_vars
     
     public function getAllVars () {
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['d_ord_serv_'.$k] = $this->$v();
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
     
	 public function get_malha() {
        return $this->malha;
     }
     
	 public function get_fio() {
        return $this->fio;
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
     
	 public function set_malha($malha) {
        $this->malha = $malha;
     }
     
	 public function set_fio($fio) {
        $this->fio = $fio;
     }

}
?>
