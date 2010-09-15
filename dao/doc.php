<?php
class knl_dao_doc {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_doc_tipo,id_doc_sub_tipo,id_empresa,numero,data_doc,pag
                             FROM doc
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_doc_tipo,id_doc_sub_tipo,id_empresa,numero,data_doc,pag
                             FROM doc
                             WHERE 1 = 1 ";
    
    private $SELECT_PURE = "SELECT tb.id,tb.id_doc_tipo,tb.id_doc_sub_tipo,tb.id_empresa,tb.numero,tb.data_doc,tb.pag
                             FROM doc tb ";

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
          $objmodel = new knl_model_doc($l['id'],$l['id_doc_tipo'],$l['id_doc_sub_tipo'],$l['id_empresa'],$l['numero'],$l['data_doc'],$l['pag']);
       } else {
            throw new Exception("Nenhum doc foi encontrado!");
         }
       return $objmodel;
    }
    
    public function selectListagem($id_usuario,$id_grupo,$arrayGrupos,$arrayFiltro) {
    	//$this->conn->debug = true;
    	/* mandar $id_usuario, $id_grupo, $arrayGrupos e $arrayFiltro
    	 *  para o criteria
    	 * criteria deve aplicar permissoes na montagem da query
    	 * criteria deve voltar com os atributos: $stringSQL, $ArrayBind, $pagina
    	 * usar o $pagina para montar offset do adodb
    	 * retornar dentro da chave do array $lista['detalhes']
    	 *  um objeto knl_lib_Listagem com os atributos contendo:
    	 *  -pagina atual, limite de paginas, total de registros,
    	 *   regitro de, registro até,
    	 *   array com parametros usados na pesquisa fornecidos pelo usuario, com chave do $_REQUEST e valor.  
         */
       //$listagem = knl_lib_Listagem::getInstance(50);
       $criteriaObj = knl_lib_Criteria::getInstance();
       $criteriaObj->montaSqlListaDoc($id_usuario,$id_grupo,$arrayGrupos,$arrayFiltro);
       $query = $this->SELECT_PURE.$criteriaObj->get_innerJoin().
                " WHERE 1=1 ".
                $criteriaObj->get_sql().
                $criteriaObj->get_groupBy().
                $criteriaObj->get_orderBy();
                //" ORDER BY data_doc,id_doc_tipo,numero ";
 
       //echo $query;print_r($criteriaObj->get_arrayBind());die();
       
       $regpag = 20;
       $offset = $criteriaObj->get_pagina()*$regpag;
       $stmt = $this->conn->SelectLimit($query,$regpag,$offset,$criteriaObj->get_ArrayBind());
       $stmtFull = $this->conn->SelectLimit($query,-1,-1,$criteriaObj->get_ArrayBind()); //adodb porco ridiculo performance zero!
       $pagObj = knl_lib_Paginacao::getInstance($stmtFull->RecordCount(),$stmt->RecordCount(),$criteriaObj->get_arrayFiltro(),$regpag);
       $lista = array();

       while($l = $stmt->FetchRow()) {
          $lista[] = new knl_model_doc($l['id'],$l['id_doc_tipo'],$l['id_doc_sub_tipo'],$l['id_empresa'],$l['numero'],$l['data_doc'],$l['pag']);
       }
       $lista['detalhes'] = $pagObj;
       return $lista;
    }
    

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }

    public function upsert(knl_model_doc $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO doc (id_doc_tipo,id_doc_sub_tipo,id_empresa,numero,data_doc,pag)
                    VALUES ('".$objmodel->get_id_doc_tipo()."','".$objmodel->get_id_doc_sub_tipo()."','".$objmodel->get_id_empresa()."','".$objmodel->get_numero()."','".$objmodel->get_data_doc_db()."','".$objmodel->get_pag()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE doc SET 
                      id_doc_tipo='{$objmodel->get_id_doc_tipo()}',id_doc_sub_tipo='{$objmodel->get_id_doc_sub_tipo()}',id_empresa='{$objmodel->get_id_empresa()}',numero='{$objmodel->get_numero()}',data_doc='{$objmodel->get_data_doc_db()}',pag='{$objmodel->get_pag()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>