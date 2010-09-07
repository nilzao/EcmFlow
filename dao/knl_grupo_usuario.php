<?php
class knl_dao_knl_grupo_usuario {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_knl_usuario,id_knl_grupo
                             FROM knl_grupo_usuario
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_knl_usuario,id_knl_grupo
                             FROM knl_grupo_usuario
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
          $objmodel = new knl_model_knl_grupo_usuario($l['id'],$l['id_knl_usuario'],$l['id_knl_grupo']);
       } else {
            throw new Exception("Nenhum knl_grupo_usuario foi encontrado!");
         }
       return $objmodel;
    }

    public function selectByUser($id_usuario) {
       $query = $this->SELECT_BY_CRITERIA." AND id_knl_usuario = ?"; 
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$id_usuario);
       $grupos = array();

       while($l = $stmt->FetchRow()) {
          $grupos[] = new knl_model_knl_grupo_usuario($l['id'],$l['id_knl_usuario'],$l['id_knl_grupo']);
       } 
       return $grupos;
    }
    
	public function clearByIdUsr($id_usu) {
       $query = "DELETE FROM knl_grupo_usuario WHERE id_knl_usuario = ?"; 
	   $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$id_usu);
    }
    
    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_model_knl_grupo_usuario $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO knl_grupo_usuario (id_knl_usuario,id_knl_grupo)
                    VALUES ('".$objmodel->get_id_knl_usuario()."','".$objmodel->get_id_knl_grupo()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE knl_grupo_usuario SET 
                      id_knl_usuario='{$objmodel->get_id_knl_usuario()}',id_knl_grupo='{$objmodel->get_id_knl_grupo()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
