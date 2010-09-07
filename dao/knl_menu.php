<?php
class knl_dao_knl_menu {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,target,ordem,icfechada,icaberta,titulo,aberto,label,domain,action
                             FROM knl_menu
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,target,ordem,icfechada,icaberta,titulo,aberto,label,domain,action
                             FROM knl_menu
                             WHERE 1 = 1 ";
    
    private $SELECT_PURE = "SELECT tb.id,tb.target,tb.ordem,tb.icfechada,tb.icaberta,tb.titulo,tb.aberto,tb.label,tb.domain,tb.action
                             FROM knl_menu tb";

    private function __construct() {
         $this->conn = knl_lib_DataBase::getDataBase();
    }
    public static function getInstance() {
       if(!isset(self::$instance)) {
           self::$instance = new self();
       }
       return self::$instance;
    }

    public function selectById($id) {
       $stmt = $this->conn->prepare($this->SELECT_BY_ID);
       $stmt = $this->conn->execute($stmt,$id);

       if($l = $stmt->FetchRow()) {
          $objmodel = new knl_model_knl_menu($l['id'],$l['target'],$l['ordem'],$l['icfechada'],$l['icaberta'],$l['titulo'],$l['aberto'],$l['label'],$l['domain'],$l['action']);
       } else {
            throw new Exception("Nenhum knl_menu foi encontrado!");
         }
       return $objmodel;
    }

    public function selectByUserGroup($id_usuario,$id_grupo,$arrayGrupos) {
       $criteriaObj = knl_lib_Criteria::getInstance();
       $criteriaObj->montaSqlCred($id_usuario,$id_grupo,$arrayGrupos);
       $query = $this->SELECT_PURE." LEFT JOIN knl_menu_cred cr ON (cr.id_knl_menu = tb.id)
       								 WHERE 1=1 ".$criteriaObj->get_sql()."
       								 ORDER BY tb.ordem";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$criteriaObj->get_ArrayBind());
       $menu = array();

       while($l = $stmt->FetchRow()) {
          $menu[] = new knl_model_knl_menu($l['id'],$l['target'],$l['ordem'],$l['icfechada'],$l['icaberta'],$l['titulo'],$l['aberto'],$l['label'],$l['domain'],$l['action']);
       }
       return $menu;
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_model_knl_menu $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO knl_menu (target,ordem,icfechada,icaberta,titulo,aberto,label,domain,action)
                    VALUES ('".$objmodel->get_target()."','".$objmodel->get_ordem()."','".$objmodel->get_icfechada()."','".$objmodel->get_icaberta()."','".$objmodel->get_titulo()."','".$objmodel->get_aberto()."','".$objmodel->get_label()."','".$objmodel->get_domain()."','".$objmodel->get_action()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE knl_menu SET 
                      target='{$objmodel->get_target()}',ordem='{$objmodel->get_ordem()}',icfechada='{$objmodel->get_icfechada()}',icaberta='{$objmodel->get_icaberta()}',titulo='{$objmodel->get_titulo()}',aberto='{$objmodel->get_aberto()}',label='{$objmodel->get_label()}',domain='{$objmodel->get_domain()}',action='{$objmodel->get_action()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
