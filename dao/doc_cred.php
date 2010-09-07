<?php
class knl_dao_doc_cred {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_doc,id_knl_usuario,id_knl_grupo,perm_usuario,perm_grupo,perm_outros
                             FROM doc_cred
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_doc,id_knl_usuario,id_knl_grupo,perm_usuario,perm_grupo,perm_outros
                             FROM doc_cred
                             WHERE 1 = 1 ";

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
          $objmodel = new knl_model_doc_cred($l['id'],$l['id_doc'],$l['id_knl_usuario'],$l['id_knl_grupo'],$l['perm_usuario'],$l['perm_grupo'],$l['perm_outros']);
       } else {
            throw new Exception("Nenhum doc_cred foi encontrado!");
         }
       return $objmodel;
    }

    public function selectByIdDoc($id_doc) {
       $query = $this->SELECT_BY_CRITERIA." AND id_doc = ?";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$id_doc);
       $cred = array();

       while($l = $stmt->FetchRow()) {
          $cred[] = new knl_model_doc_cred($l['id'],$l['id_doc'],$l['id_knl_usuario'],$l['id_knl_grupo'],$l['perm_usuario'],$l['perm_grupo'],$l['perm_outros']);
       }
       return $cred;
    }
    
    public function selectByIdDocUsuarioGrupo($id_doc,$id_usuario,$id_grupo,$arrayGrupos = array()) {
       $query = $this->SELECT_BY_CRITERIA." AND id_doc = ? AND (id_knl_usuario = ? OR id_knl_grupo =? ";
       foreach ($arrayGrupos as $v){
       		$query .= " OR id_knl_grupo = ? ";
       }
       $query .= ")";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,array_merge(array($id_doc,$id_usuario,$id_grupo),$arrayGrupos));
       $cred = array();

       while($l = $stmt->FetchRow()) {
          $cred[] = new knl_model_doc_cred($l['id'],$l['id_doc'],$l['id_knl_usuario'],$l['id_knl_grupo'],$l['perm_usuario'],$l['perm_grupo'],$l['perm_outros']);
       }
       return $cred;
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }
    
    public function deleteByIdDoc($id_doc) {
    	$query = "DELETE FROM doc_cred WHERE id_doc = ? ";
    	$stmt = $this->conn->prepare($query);
        $stmt = $this->conn->execute($stmt,$id_doc);
    }
    
    public function upsert(knl_model_doc_cred $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO doc_cred (id_doc,id_knl_usuario,id_knl_grupo,perm_usuario,perm_grupo,perm_outros)
                    VALUES ('".$objmodel->get_id_doc()."','".$objmodel->get_id_knl_usuario()."','".$objmodel->get_id_knl_grupo()."','".$objmodel->get_perm_usuario()."','".$objmodel->get_perm_grupo()."','".$objmodel->get_perm_outros()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE doc_cred SET 
                      id_doc='{$objmodel->get_id_doc()}',id_knl_usuario='{$objmodel->get_id_knl_usuario()}',id_knl_grupo='{$objmodel->get_id_knl_grupo()}',perm_usuario='{$objmodel->get_perm_usuario()}',perm_grupo='{$objmodel->get_perm_grupo()}',perm_outros='{$objmodel->get_perm_outros()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
