<?php
class knl_dao_knl_grupo {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_knl_depto,id_knl_perm_bin,nome,usuarios
                             FROM knl_grupo
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_knl_depto,id_knl_perm_bin,nome,usuarios
                             FROM knl_grupo
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
          $objmodel = new knl_model_knl_grupo($l['id'],$l['id_knl_depto'],$l['id_knl_perm_bin'],$l['nome'],$l['usuarios']);
       } else {
            throw new Exception("Nenhum knl_grupo foi encontrado!");
         }
       return $objmodel;
    }

    public function selectAll() {
       $stmt = $this->conn->prepare($this->SELECT_BY_CRITERIA)." ORDER BY nome";
       $stmt = $this->conn->execute($stmt);
       $grupos = array();

       while($l = $stmt->FetchRow()) {
          $grupos[] = new knl_model_knl_grupo($l['id'],$l['id_knl_depto'],$l['id_knl_perm_bin'],$l['nome'],$l['usuarios']);
       }
       return $grupos;
    }

    public function selectByIdDepto($id_knl_depto) {
       $stmt = $this->conn->prepare($this->SELECT_BY_CRITERIA)." AND id_knl_depto = ?";
       $stmt = $this->conn->execute($stmt,$id_knl_depto);
       $grupos = array();

       while($l = $stmt->FetchRow()) {
          $grupos[] = new knl_model_knl_grupo($l['id'],$l['id_knl_depto'],$l['id_knl_perm_bin'],$l['nome'],$l['usuarios']);
       }
       return $grupos;
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_model_knl_grupo $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO knl_grupo (nome,usuarios)
                    VALUES ('".$objmodel->get_nome()."','".$objmodel->get_usuarios()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE knl_grupo SET 
                      nome='{$objmodel->get_nome()}',usuarios='{$objmodel->get_usuarios()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
