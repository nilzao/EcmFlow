<?php
class knl_model_doc_marca_texto {
     private $id;
     private $id_doc;
     private $x;
     private $y;
     private $width;
     private $height;
     private $pag;

     public function __construct($id,$id_doc,$x,$y,$width,$height,$pag){
        $this->id = $id;
        $this->id_doc = $id_doc;
        $this->x = $x;
        $this->y = $y;
        $this->width = $width;
        $this->height = $height;
        $this->pag = $pag;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_doc_marca_texto);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['doc_marca_texto_'.$k] = $this->$v();
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
     
	public function get_x() {
        return $this->x;
     }
     
	public function get_y() {
        return $this->y;
     }
     
	public function get_width() {
        return $this->width;
     }
     
	public function get_height() {
        return $this->height;
     }
     
	public function get_pag() {
        return $this->pag;
    }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_id_doc($id_doc) {
        $this->id_doc = $id_doc;
     }
     
     public function set_x($x) {
        $this->x = $x;
     }
     
	 public function set_y($y) {
        $this->y = $y;
     }
     
	 public function set_width($width) {
        $this->width = $width;
     }
     
	 public function set_height($height) {
        $this->height = $height;
     }
     
	 public function set_pag($pag) {
        $this->pag = $pag;
     }

}
?>
