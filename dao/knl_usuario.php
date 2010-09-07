<?php
class knl_dao_knl_usuario {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_knl_grupo,login,senha,script_ini,home,passwdauth1,passwdauth2,passwdauth3
                             FROM knl_usuario
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_knl_grupo,login,senha,script_ini,home,passwdauth1,passwdauth2,passwdauth3
                             FROM knl_usuario
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
          $objmodel = new knl_model_knl_usuario($l['id'],$l['id_knl_grupo'],$l['login'],$l['senha'],$l['script_ini'],$l['home'],$l['passwdauth1'],$l['passwdauth2'],$l['passwdauth3']);
       } else {
            throw new Exception("Nenhum knl_usuario foi encontrado!");
         }
       return $objmodel;
    }

    public function selectAll() {
       $stmt = $this->conn->prepare($this->SELECT_BY_CRITERIA)." AND ID <> 1 ORDER BY login";
       $stmt = $this->conn->execute($stmt);
       $usuarios = array();

       while($l = $stmt->FetchRow()) {
          $usuarios[] = new knl_model_knl_usuario($l['id'],$l['id_knl_grupo'],$l['login'],$l['senha'],$l['script_ini'],$l['home'],$l['passwdauth1'],$l['passwdauth2'],$l['passwdauth3']);
       }
       return $usuarios;
    }
    

    public function selectByUserPass($usuario,$passwdmd5) {
       $query = $this->SELECT_BY_CRITERIA." AND login = ? AND senha = ?";
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,array($usuario,$passwdmd5));

       if($l = $stmt->FetchRow()) {
          $objmodel = new knl_model_knl_usuario($l['id'],$l['id_knl_grupo'],$l['login'],$l['senha'],$l['script_ini'],$l['home'],$l['passwdauth1'],$l['passwdauth2'],$l['passwdauth3']);
       } else {
            $objmodel = new knl_model_knl_usuario(0,0,$usuario,'','','',0,0,0);
         }
       return $objmodel;
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_model_knl_usuario $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO knl_usuario (id_knl_grupo,login,senha,script_ini,home)
                    VALUES ('".$objmodel->get_id_knl_grupo()."','".$objmodel->get_login()."','".$objmodel->get_senha()."','".$objmodel->get_script_ini()."','".$objmodel->get_home()."','".$objmodel->get_passwdauth1()."','".$objmodel->get_passwdauth2()."','".$objmodel->get_passwdauth3()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE knl_usuario SET 
                      id_knl_grupo='{$objmodel->get_id_knl_grupo()}',login='{$objmodel->get_login()}',senha='{$objmodel->get_senha()}',script_ini='{$objmodel->get_script_ini()}',home='{$objmodel->get_home()}',passwdauth1='{$objmodel->get_passwdauth1()}',passwdauth2='{$objmodel->get_passwdauth2()}',passwdauth3='{$objmodel->get_passwdauth3()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
