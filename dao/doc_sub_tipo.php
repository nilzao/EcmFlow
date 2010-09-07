<?php
class knl_dao_doc_sub_tipo {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_doc_tipo,descricao,str_shell,path
                             FROM doc_sub_tipo
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_doc_tipo,descricao,str_shell,path
                             FROM doc_sub_tipo
                             WHERE 1 = 1 ";
    
    private $SELECT_PURE = "SELECT tb.id,tb.id_doc_tipo,tb.descricao,tb.str_shell,path
                             FROM doc_sub_tipo tb ";

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
          $objmodel = new knl_model_doc_sub_tipo($l['id'],$l['id_doc_tipo'],$l['descricao'],$l['str_shell'],$l['path']);
       } else {
            throw new Exception("Nenhum doc_sub_tipo foi encontrado!");
         }
       return $objmodel;
    }
    
	public function selectAll() {
       $stmt = $this->conn->prepare($this->SELECT_BY_CRITERIA)." ORDER BY descricao";
       $stmt = $this->conn->execute($stmt);
       $docsubtp = array();

       while($l = $stmt->FetchRow()) {
          $docsubtp[] = new knl_model_doc_sub_tipo($l['id'],$l['id_doc_tipo'],$l['descricao'],$l['str_shell'],$l['path']);
       }
       return $docsubtp;
    }

    public function selectByUserGroup($id_usuario,$id_grupo,$arrayGrupos) {
       $criteriaObj = knl_lib_Criteria::getInstance();
       $criteriaObj->montaSqlCred($id_usuario,$id_grupo,$arrayGrupos);
       $query = $this->SELECT_PURE." LEFT JOIN doc_tipo_cred cr ON (cr.id_doc_tipo = tb.id_doc_tipo)
       								 WHERE 1=1 ".$criteriaObj->get_sql()."
       								 ORDER BY tb.descricao";
       $stmt = $this->conn->prepare($query);
       $arrayBind = array_merge(array($id_usuario,$id_grupo),$arrayGrupos);
       $stmt = $this->conn->execute($stmt,$criteriaObj->get_ArrayBind());
       $docSubTipo = array();
       

       while($l = $stmt->FetchRow()) {
          $docSubTipo[] = new knl_model_doc_sub_tipo($l['id'],$l['id_doc_tipo'],$l['descricao'],$l['str_shell'],$l['path']);
       }
       return $docSubTipo;
    }

    public function selectByShell($str_shell) {
       $stmt = $this->conn->prepare($this->SELECT_BY_CRITERIA." AND str_shell = ? ");
       $stmt = $this->conn->execute($stmt,$str_shell);

       if($l = $stmt->FetchRow()) {
          $objmodel = new knl_model_doc_sub_tipo($l['id'],$l['id_doc_tipo'],$l['descricao'],$l['str_shell'],$l['path']);
       } else {
            throw new Exception("Nenhum doc_sub_tipo foi encontrado!");
         }
       return $objmodel;
    }
    
	public function selectByPath($path) {
       $stmt = $this->conn->prepare($this->SELECT_BY_CRITERIA." AND path = ? ");
       $stmt = $this->conn->execute($stmt,$path);

       if($l = $stmt->FetchRow()) {
          $objmodel = new knl_model_doc_sub_tipo($l['id'],$l['id_doc_tipo'],$l['descricao'],$l['str_shell'],$l['path']);
       } else {
            throw new Exception("Nenhum doc_sub_tipo foi encontrado!");
         }
       return $objmodel;
    }
    
    
    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_model_doc_sub_tipo $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO doc_sub_tipo (id_doc_tipo,descricao,str_shell)
                    VALUES ('".$objmodel->get_id_doc_tipo()."','".$objmodel->get_descricao()."','".$objmodel->get_str_shell()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE doc_sub_tipo SET 
                      id_doc_tipo='{$objmodel->get_id_doc_tipo()}',descricao='{$objmodel->get_descricao()}',str_shell='{$objmodel->get_str_shell()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
