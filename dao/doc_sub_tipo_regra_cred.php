<?php
class knl_dao_doc_sub_tipo_regra_cred {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,addrem,id_doc_pendencia_tipo,id_knl_usuario,id_knl_grupo,id_doc_sub_tipo,perm_usuario,perm_grupo,perm_outros
                             FROM doc_sub_tipo_regra_cred
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,addrem,id_doc_pendencia_tipo,id_knl_usuario,id_knl_grupo,id_doc_sub_tipo,perm_usuario,perm_grupo,perm_outros
                             FROM doc_sub_tipo_regra_cred
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
          $objmodel = new knl_model_doc_sub_tipo_regra_cred($l['id'],$l['addrem'],$l['id_doc_pendencia_tipo'],$l['id_knl_usuario'],$l['id_knl_grupo'],$l['id_doc_sub_tipo'],$l['perm_usuario'],$l['perm_grupo'],$l['perm_outros']);
       } else {
            throw new Exception("Nenhum doc_sub_tipo_regra_cred foi encontrado!");
         }
       return $objmodel;
    }
    
	public function deleteById($id) {
       $query = "DELETE FROM doc_sub_tipo_regra_cred WHERE id = ?";
	   $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$id);
    }
    
	public function selectAll() {
       $stmt = $this->conn->prepare($this->SELECT_BY_CRITERIA." order by id_doc_sub_tipo,id_doc_pendencia_tipo,id_knl_grupo");
       $stmt = $this->conn->execute($stmt);
       $regrascred = array();

       while($l = $stmt->FetchRow()) {
          $regrascred[] = new knl_model_doc_sub_tipo_regra_cred($l['id'],$l['addrem'],$l['id_doc_pendencia_tipo'],$l['id_knl_usuario'],$l['id_knl_grupo'],$l['id_doc_sub_tipo'],$l['perm_usuario'],$l['perm_grupo'],$l['perm_outros']);
       }
       return $regrascred;
    }
        
    public function selectBySubTipoPendTipo($id_doc_sub_tipo,$id_doc_pendencia_tipo) {
       $stmt = $this->conn->prepare($this->SELECT_BY_CRITERIA." AND id_doc_sub_tipo = ? AND id_doc_pendencia_tipo = ? ");
       $stmt = $this->conn->execute($stmt,array($id_doc_sub_tipo,$id_doc_pendencia_tipo));
       $regras = array();

       while($l = $stmt->FetchRow()) {
          $regras[] = new knl_model_doc_sub_tipo_regra_cred($l['id'],$l['addrem'],$l['id_doc_pendencia_tipo'],$l['id_knl_usuario'],$l['id_knl_grupo'],$l['id_doc_sub_tipo'],$l['perm_usuario'],$l['perm_grupo'],$l['perm_outros']);
       }
       return $regras;
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_model_doc_sub_tipo_regra_cred $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO doc_sub_tipo_regra_cred (addrem,id_doc_pendencia_tipo,id_knl_usuario,id_knl_grupo,id_doc_sub_tipo,perm_usuario,perm_grupo,perm_outros)
                    VALUES ('".$objmodel->get_addrem()."','".$objmodel->get_id_doc_pendencia_tipo()."','".$objmodel->get_id_knl_usuario()."','".$objmodel->get_id_knl_grupo()."','".$objmodel->get_id_doc_sub_tipo()."','".$objmodel->get_perm_usuario()."','".$objmodel->get_perm_grupo()."','".$objmodel->get_perm_outros()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE doc_sub_tipo_regra_cred SET 
                      addrem='{$objmodel->get_addrem()}', id_doc_pendencia_tipo='{$objmodel->get_id_doc_pendencia_tipo()}',id_knl_usuario='{$objmodel->get_id_knl_usuario()}',id_knl_grupo='{$objmodel->get_id_knl_grupo()}',id_doc_sub_tipo='{$objmodel->get_id_doc_sub_tipo()}',perm_usuario='{$objmodel->get_perm_usuario()}',perm_grupo='{$objmodel->get_perm_grupo()}',perm_outros='{$objmodel->get_perm_outros()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
