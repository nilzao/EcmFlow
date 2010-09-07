<?php
class knl_model_doc_anexo extends knl_lib_daoext_Convert {
     private $id;
     private $id_doc1;
     private $id_doc2;
     private $data_anexo;
     private $id_usuario;
     private $x;
     private $y;
     private $pag;

     public function __construct($id,$id_doc1,$id_doc2,$data_anexo,$id_usuario,$x,$y,$pag){
        $this->id = $id;
        $this->id_doc1 = $id_doc1;
        $this->id_doc2 = $id_doc2;
        $this->data_anexo = $data_anexo;
        $this->id_usuario = $id_usuario;
        $this->x = $x;
        $this->y = $y;
        $this->pag = $pag;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_doc_anexo);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['doc_anexo_'.$k] = $this->$v();
         }
         return $varsZ;
     }
     
     // get functions:

     public function get_id() {
        return $this->id;
     }

     public function get_id_doc1() {
        return $this->id_doc1;
     }

     public function get_id_doc2() {
        return $this->id_doc2;
     }

     public function get_data_anexo_db() {
        return $this->data_anexo;
     }

     public function get_data_anexo() {
        $this->data_anexo = $this->datatime_mysql_to_br($this->data_anexo);
        return $this->data_anexo;
     }

     public function get_id_usuario() {
        return $this->id_usuario;
     }
     
	public function get_x() {
        return $this->x;
     }
     
	public function get_y() {
        return $this->y;
     }
     
	public function get_pag() {
        return $this->pag;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_id_doc1($id_doc1) {
        $this->id_doc1 = $id_doc1;
     }

     public function set_id_doc2($id_doc2) {
        $this->id_doc2 = $id_doc2;
     }

     public function set_data_anexo($data_anexo) {
        $this->data_anexo = $this->datatime_br_to_mysql($this->data_anexo);
        $this->data_anexo = $data_anexo;
     }

     public function set_id_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
     }
	
     public function set_x($x) {
        $this->x = $x;
     }
     
	 public function set_y($y) {
        $this->y = $y;
     }
     
	public function set_pag($pag) {
        $this->pag = $pag;
     }

}
?>
