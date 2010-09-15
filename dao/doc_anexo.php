<?php
class knl_dao_doc_anexo {
    private $conn;
    private static $instance;
    
    private $SELECT_BY_ID = "SELECT id,id_doc1,id_doc2,data_anexo,id_usuario,x,y,pag as anexo_pag
                             FROM doc_anexo
                             WHERE id = ?";

    private $SELECT_BY_CRITERIA = "SELECT id,id_doc1,id_doc2,data_anexo,id_usuario,x,y,pag as anexo_pag
                             FROM doc_anexo
                             WHERE 1 = 1 ";

    private $SELECT_PURE_DOC = "SELECT tb.id,tb.id_doc_tipo,tb.id_doc_sub_tipo,tb.id_empresa,tb.numero,tb.data_doc,tb.pag
                             FROM doc tb ";
    
    private $SELECT_ANEXO1 = "SELECT tb.id,tb.id_doc_tipo,tb.id_doc_sub_tipo,tb.id_empresa,tb.numero,tb.data_doc,tb.pag,
    						 da.id as anexo_id,da.id_doc1,da.id_doc2,da.data_anexo,da.id_usuario,da.x,da.y,da.pag as anexo_pag 
                             FROM doc tb 
                             LEFT JOIN doc_anexo da ON (tb.id = da.id_doc2) ";
    
    private $SELECT_ANEXO2 = "SELECT tb.id,tb.id_doc_tipo,tb.id_doc_sub_tipo,tb.id_empresa,tb.numero,tb.data_doc,tb.pag,
    						 da.id as anexo_id,da.id_doc1,da.id_doc2,da.data_anexo,da.id_usuario,da.x,da.y, da.pag as anexo_pag 
                             FROM doc tb 
                             LEFT JOIN doc_anexo da ON (tb.id = da.id_doc1) ";
        /*
         * SELECT da.id_doc2 as id, tb.id_doc_tipo, tb.id_doc_sub_tipo, tb.id_empresa, tb.numero, tb.data_doc, tb.pag FROM doc tb 
         * LEFT JOIN doc_anexo da ON (da.id_doc1 = tb.id)
         * WHERE 1=1 AND data_doc >= 0 and tb.id =2  ORDER BY data_doc,id_doc_tipo,numero
         */
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
          $objmodel = new knl_model_doc_anexo($l['id'],$l['id_doc1'],$l['id_doc2'],$l['data_anexo'],$l['id_usuario'],$l['x'],$l['y'],$l['anexo_pag']);
       } else {
            throw new Exception("Nenhum doc_anexo foi encontrado!");
         }
       return $objmodel;
    }

    public function selectListagem($id_usuario,$id_grupo,$arrayGrupos,$arrayFiltro) {
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
       $query = ($arrayFiltro['doc_anexo'] == 0) ? $this->SELECT_ANEXO2 : $this->SELECT_ANEXO1;
       
       $criteriaObj = knl_lib_Criteria::getInstance();
       $criteriaObj->montaSqlListaDoc($id_usuario,$id_grupo,$arrayGrupos,$arrayFiltro);       
       $query .= $criteriaObj->get_innerJoin()." WHERE 1 = 1 ".  
       $criteriaObj->get_sql().$criteriaObj->get_orderBy();
       
       //echo $query;print_r($criteriaObj->get_ArrayBind());die();
       
       //$regpag = 999;
       //$offset = $criteriaObj->get_pagina()*$regpag;
       $stmt = $this->conn->SelectLimit($query,-1,-1,$criteriaObj->get_ArrayBind());
       //$stmtFull = $this->conn->SelectLimit($query,-1,-1,$criteriaObj->get_ArrayBind()); //adodb porco ridiculo performance zero!
       //$pagObj = knl_lib_Paginacao::getInstance($stmtFull->RecordCount(),$stmt->RecordCount(),$arrayFiltro,$regpag);
       $lista = array();

       while($l = $stmt->FetchRow()) {
          //$lista[] = new knl_model_doc($l['id'],$l['id_doc_tipo'],$l['id_doc_sub_tipo'],$l['id_empresa'],$l['numero'],$l['data_doc'],$l['pag']);
          $lista[] = new knl_model_doc_anexo($l['anexo_id'],$l['id_doc1'],$l['id_doc2'],$l['data_anexo'],$l['id_usuario'],$l['x'],$l['y'],$l['anexo_pag']);
       }
       $lista['detalhes'] = $arrayFiltro;
       return $lista;
    }

    public function selectByCriteria(knl_lib_criteria $objcriteria) {
       $this->SELECT_BY_CRITERIA .= "$objcriteria->get_sql()";
    }
    
    public function deleteById1Id2($id1,$id2){
       $query = "DELETE FROM doc_anexo WHERE id_doc1 = ? AND id_doc2 = ? LIMIT 1";
       $ArrayBind = array($id1,$id2);
       $stmt = $this->conn->prepare($query);
       $stmt = $this->conn->execute($stmt,$ArrayBind);
    }

    public function upsert(knl_model_doc_anexo $objmodel){
       if ($objmodel->get_id() == 0){
          $query = "INSERT INTO doc_anexo (id_doc1,id_doc2,data_anexo,id_usuario,x,y,pag)
                    VALUES ('".$objmodel->get_id_doc1()."','".$objmodel->get_id_doc2()."','".$objmodel->get_data_anexo_db()."','".$objmodel->get_id_usuario()."','".$objmodel->get_x()."','".$objmodel->get_y()."','".$objmodel->get_pag()."')";
          $stmt = $this->conn->prepare($query);
          $stmt = $this->conn->execute($stmt);
          $objmodel->set_id($this->conn->Insert_ID());
       } else {
            $query = "UPDATE doc_anexo SET 
                      id_doc1='{$objmodel->get_id_doc1()}',id_doc2='{$objmodel->get_id_doc2()}',"
            		  ."data_anexo='{$objmodel->get_data_anexo_db()}',"
            		  ."id_usuario='{$objmodel->get_id_usuario()}'"
            		  .",x='{$objmodel->get_x()}',y='{$objmodel->get_y()}',pag='{$objmodel->get_pag()}'
                      WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt = $this->conn->execute($stmt,$objmodel->get_id());
         }
       return $objmodel;
    }
}
?>
