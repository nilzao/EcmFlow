<?php
class knl_extensions_cadastronf_caddao extends knl_lib_daoext_Convert {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,cnpj,razao,estado,ie
                             FROM d_cad_nf
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,cnpj,razao,estado,ie
                             FROM d_cad_nf
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
       $id = (empty($id)) ? -1 :$id;
       $stmt = $this->conn->prepare($this->SELECT_BY_ID);
       $stmt = $this->conn->execute($stmt,$id);

       if($l = $stmt->FetchRow()) {
       	  $l['cnpj'] = $this->pontuacnpj($l['cnpj']);
          $objmodel = new knl_extensions_cadastronf_cadmodel($l['id'],$l['cnpj'],$l['razao'],$l['estado'],$l['ie']);
       } else {
            throw new Exception("Nenhum d_cad_nf foi encontrado! $id");
         }
       return $objmodel;
    }
    
    public function selectByCnpj($cnpj) {
       $query = $this->SELECT_BY_CRITERIA." AND cnpj = ? ";
	   //echo $query;echo $cnpj;die();
	   if (empty($cnpj)) {$cnpj = "XX";}
	   $stmt = $this->conn->prepare($query);
	   $cnpj = $this->limpacnpj($cnpj);
       $stmt = $this->conn->execute($stmt,$cnpj);

       if($l = $stmt->FetchRow()) {
       	  $l['cnpj'] = $this->pontuacnpj($l['cnpj']);
          $objmodel = new knl_extensions_cadastronf_cadmodel($l['id'],$l['cnpj'],$l['razao'],$l['estado'],$l['ie']);
       } else {
            $objmodel = new knl_extensions_cadastronf_cadmodel(0,$cnpj,"!! NOVO !!","SP"," ");
         }
       return $objmodel;
    }
    
    public function selectListagemByRazao($razao) {
       $query = $this->SELECT_BY_CRITERIA." AND razao LIKE '%{$razao}%' ";
       $stmt = $this->conn->query($query);
       
       $regpag = $stmt->RecordCount()+1; //gato por causa da merda do adodb q não aceita string no bind com LIKE '%?%'
       $pagObj = knl_lib_Paginacao::getInstance($stmt->RecordCount(),$stmt->RecordCount(),array('pag'=>0),$regpag);
       $forn = array();

       while($l = $stmt->FetchRow()) {
       	  $l['cnpj'] = $this->pontuacnpj($l['cnpj']);
          $forn[]['d_cad_nf'] = new knl_extensions_cadastronf_cadmodel($l['id'],$l['cnpj'],$l['razao'],$l['estado'],$l['ie']);
       }
       $forn['detalhes'] = $pagObj;
       return $forn;
    }
    

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_extensions_cadastronf_cadmodel $objmodel){
       if ($objmodel->get_id() == 0){
       	  $cnpj = $this->limpacnpj($objmodel->get_cnpj());
          $query = "INSERT INTO d_cad_nf (cnpj,razao,estado,ie)
                    VALUES ('".$cnpj."','".$objmodel->get_razao()."','".$objmodel->get_estado()."','".$objmodel->get_ie()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE d_cad_nf SET 
                      cnpj='{$cnpj}',razao='{$objmodel->get_razao()}',estado='{$objmodel->get_estado()}',ie='{$objmodel->get_ie()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
