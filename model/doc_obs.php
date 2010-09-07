<?php
class knl_model_doc_obs {
     private $id;
     private $id_doc;
     private $obs;
     private $x;
     private $y;
     private $pag;

     public function __construct($id,$id_doc,$obs,$x,$y,$pag){
        $this->id = $id;
        $this->id_doc = $id_doc;
        $this->obs = $obs;
        $this->x = $x;
        $this->y = $y;
        $this->pag = $pag;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_doc_obs);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['doc_obs_'.$k] = $this->$v();
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

     public function get_obs() {
        return $this->obs;
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

     public function set_id_doc($id_doc) {
        $this->id_doc = $id_doc;
     }

     public function set_obs($obs) {
        $this->obs = $obs;
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
