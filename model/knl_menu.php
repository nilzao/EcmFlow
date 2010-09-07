<?php
class knl_model_knl_menu {
     private $id;
     private $target;
     private $ordem;
     private $icfechada;
     private $icaberta;
     private $titulo;
     private $aberto;
     private $label;
     private $domain;
     private $action;

     public function __construct($id,$target,$ordem,$icfechada,$icaberta,$titulo,$aberto,$label,$domain,$action){
        $this->id = $id;
        $this->target = $target;
        $this->ordem = $ordem;
        $this->icfechada = $icfechada;
        $this->icaberta = $icaberta;
        $this->titulo = $titulo;
        $this->aberto = $aberto;
        $this->label = $label;
        $this->domain = $domain;
        $this->action = $action;
     }

     //get_class_vars
     
     public function getAllVars () {
         //$vars = get_class_vars(knl_dao_knl_menu);
         $vars = get_object_vars($this);
         foreach ($vars as $k => $v){
             $v = "get_$k";
             $varsZ['knl_menu_'.$k] = $this->$v();
         }
         return $varsZ;
     }
     
     // get functions:

     public function get_id() {
        return $this->id;
     }

     public function get_target() {
        return $this->target;
     }

     public function get_ordem() {
        return $this->ordem;
     }

     public function get_icfechada() {
        return $this->icfechada;
     }

     public function get_icaberta() {
        return $this->icaberta;
     }

     public function get_titulo() {
        return $this->titulo;
     }

     public function get_aberto() {
        return $this->aberto;
     }

     public function get_label() {
        return $this->label;
     }

     public function get_domain() {
        return $this->domain;
     }

     public function get_action() {
        return $this->action;
     }

     // set functions:

     public function set_id($id) {
        $this->id = $id;
     }

     public function set_target($target) {
        $this->target = $target;
     }

     public function set_ordem($ordem) {
        $this->ordem = $ordem;
     }

     public function set_icfechada($icfechada) {
        $this->icfechada = $icfechada;
     }

     public function set_icaberta($icaberta) {
        $this->icaberta = $icaberta;
     }

     public function set_titulo($titulo) {
        $this->titulo = $titulo;
     }

     public function set_aberto($aberto) {
        $this->aberto = $aberto;
     }

     public function set_label($label) {
        $this->label = $label;
     }

     public function set_domain($domain) {
        $this->domain = $domain;
     }

     public function set_action($action) {
        $this->action = $action;
     }

}
?>
