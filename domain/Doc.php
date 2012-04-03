<?php
class knl_domain_Doc {
  private static $instance;

  private function __construct(){}
  
  public static function getInstance(){
  	if (!isset(self::$instance)){
  		self::$instance = new self();
  	}
  	return self::$instance; 
  }

  public function handle(){
  	$request = knl_lib_Registry::getRequestObj()->getInstance();
  	$metodo = $request->getGet('action');
  	if (method_exists($this,$metodo)){
  		$this->$metodo();
  	}
  	
  }
  
  public function DocFind(){
  	$DocFind = knl_lib_doc_DocFind::getInstance(); 
  	$tipos = $DocFind->montaTipos();
  	$subTipos = $DocFind->montaSubTipos();
  	    $vl = knl_view_Loader::getInstance();
        $vl->setVar("tipos",$tipos);
        $vl->setVar("subTipos",$subTipos);
        $vl->display("DocFind");
  }
  
  public function DocList(){
  	$DocList = knl_lib_doc_DocList::getInstance();
  	$lista = $DocList->montaLista();

  	  	$vl = knl_view_Loader::getInstance();
  	  	$vl->setVar("paginacao",$lista['detalhes']);
  	  	
  	  	$tipoDocClasse = $lista['detalhes']->get_arrayFiltro();
  	  	$tipoDocClasse = $tipoDocClasse['tipoClasse'];
  	  	unset ($lista['detalhes']);
        $vl->setVar("lista",$lista);
        $vl->setVar("domainAction",array('domain'=>'Doc','action'=>'DocList'));
        if(empty($tipoDocClasse)){
        	$lista = "DocList";
        	$vl->display($lista);
        } else {
        	$lista = $tipoDocClasse."/list";
        	$vl->display($lista,true,true);
        }
  }
  
  public function DocShow() {
  	$request = knl_lib_Registry::getRequestObj()->getInstance();
  	$DocVis = knl_lib_perm_Doc::getInstance();
  	$DocVis->verificaDocVis($request->getGet('id'));
  	$DocShow = knl_lib_doc_DocShow::getInstance();
  	$doc = $DocShow->getDocumento($request->getGet('id'));
  	$cabecalho = $DocShow->getDocumentoFull($doc);
  	$actions = $DocShow->getActions($doc);
  	$obsCount = knl_dao_doc_obs::getInstance()->CountByIdDoc($request->getGet('id'));
  	
        $vl = knl_view_Loader::getInstance();
        $vl->setVar("doc",$doc);
        $vl->setVar("obsCount",$obsCount);
        $pag = ($request->getGet('pag') == "") ? 1 : $request->getGet('pag') ;
        $vl->setVar("pag",$pag);
        $vl->setVar("cabecalho",$cabecalho);
        $vl->display("DocShow");
  }
  
  public function DocEditForm(){
  	$request = knl_lib_Registry::getRequestObj();
  	$session = knl_lib_Registry::getSession();
  	$DocShow = knl_lib_doc_DocShow::getInstance();
  	$doc = $DocShow->getDocumento($request->getGet('id'));
  	$cabecalho = $DocShow->getDocumentoFull($doc);
  	$docCarimbo = $DocShow->getDocumentoCarimbo($doc);
  	$empresas = knl_dao_empresa::getInstance()->selectAll();
  	$carimbos = knl_dao_carimbo::getInstance()->selectByUserGroup($session->get_id_usuario(),$session->get_id_grupo(),$session->get_grupos());
  	    $vl = knl_view_Loader::getInstance();
        $vl->setVar("doc",$doc);
        $vl->setVar("cabecalho",$cabecalho);
        $vl->setVar("docCarimbo",$docCarimbo);
        $vl->setVar("carimbos",$carimbos);
        $vl->setVar("empresas",$empresas);
        $vl->display("formDocEdit");
  }
  
  public function DocEdit(){
  	$request = knl_lib_Registry::getRequestObj();
  	$docEdit = knl_lib_doc_DocEdit::getInstance();
  	$docEdit->gravaNoBanco();
  	$PendOk = knl_lib_doc_PendenciaOk::getInstance();
  	$PendOk->EditOk($request->getpost('id'));
  		$vl = knl_view_Loader::getInstance();
  		$vl->setVar("id",$request->getpost('id'));
  		$vl->display("DocEditOk");
  }
  
  public function DocDel(){
  	$DocDel = knl_lib_doc_DocDel::getInstance();
  	$DocDel->LimpaDoc();
  		$vl = knl_view_Loader::getInstance();
  		$vl->display("DocDelOk"); 
  }
  
  public function PendenciaFind(){
  	$DocFind = knl_lib_doc_DocFind::getInstance(); 
  	$tipos = $DocFind->montaTipos();
  	$subTipos = $DocFind->montaSubTipos();
  	    $vl = knl_view_Loader::getInstance();
        $vl->setVar("tipos",$tipos);
        $vl->setVar("subTipos",$subTipos);
        $vl->display("PendFind");
  }
  
  private function DocAprova(){
  	$request = knl_lib_Registry::getRequestObj();
  	$docAprova = knl_lib_doc_Aprova::getInstance();
  	$docAprova->Aprovado($request->getget('id'));
  	$PendOk = knl_lib_doc_PendenciaOk::getInstance();
  	$PendOk->AprovaOk($request->getget('id'));
  	//$this->DocShow();
  }
  
  private function DocReprova(){
  	$request = knl_lib_Registry::getRequestObj();
  	$docReprova = knl_lib_doc_Aprova::getInstance();
  	$docReprova->Reprovado($request->getget('id'));
  	$PendOk = knl_lib_doc_PendenciaOk::getInstance();
  	$PendOk->ReprovaOk($request->getget('id'));
  	//$this->DocShow();
  }
 
  public function PendenciaList(){
  	$session = knl_lib_Registry::getSession();
  	$DocShow = knl_lib_doc_DocShow::getInstance();
  	$PendList = knl_lib_doc_PendenciaList::getInstance();
  	$lista = $PendList->listaPendencias();
  	  	$vl = knl_view_Loader::getInstance();
        $vl->setVar("paginacao",$lista['detalhes']);
        unset ($lista['detalhes']);

        foreach ($lista as $k=>$v){
        	$lista[$k]['docPend'] = $DocShow->getDocumentoPend($v['doc']);
        }
        $vl->setVar("lista",$lista);
        $vl->setVar("domainAction",array('domain'=>'Doc','action'=>'PendenciaList'));
        $vl->display("PendenciaList");
  }
  
  public function PendenciaXml(){
  	$DocShow = knl_lib_doc_DocShow::getInstance();
  	$PendList = knl_lib_doc_PendenciaList::getInstance();
  	$lista = $PendList->listaPendencias();
  	  	$vl = knl_view_Loader::getInstance();
        unset ($lista['detalhes']);
        $total = sizeof($lista);
        $vl->setVar("total",$total);
        $vl->display("PendenciaXml");
  }
  
  public function AssinaturaAdd(){
  	$request = knl_lib_Registry::getRequestObj();
  	$docAssina = knl_lib_doc_Assina::getInstance();
  	$docAssina->gravaNoBanco($request->getget('id'),$request->getget('atp'));
  	$PendOk = knl_lib_doc_PendenciaOk::getInstance();
  	$PendOk->AssinaOk($request->getget('id'));
  	$this->AssinaturaList();
  }
  
  public function AssinaturaList(){
  	$request = knl_lib_Registry::getRequestObj();
  	$AssinaList = knl_lib_doc_AssinaturaList::getInstance();
  	$lista = $AssinaList->listaAssinaturas();
  	  	$vl = knl_view_Loader::getInstance();
        $vl->setVar("lista",$lista);
        $vl->setVar("id_doc",$request->getGet('id'));
        $vl->display("AssinaturaList");
  }
  
  public function CarimboList(){
  	$CarimboList = knl_lib_doc_CarimboList::getInstance();
  	$lista = $CarimboList->listaCarimbos();
  	  	$vl = knl_view_Loader::getInstance();
        $vl->setVar("lista",$lista);
        $vl->display("CarimboList");
  }
  
  public function ObsList(){
  	$request = knl_lib_Registry::getRequestObj();
  	$ObsList = knl_lib_doc_ObservacaoList::getInstance();
  	$pag = $request->getGet('pag');
  	$pag = empty($pag) ? 1 : $request->getGet('pag') ;
  	$lista = $ObsList->listaObservacoes();
  	  	$vl = knl_view_Loader::getInstance();
        $vl->setVar("lista",$lista);
        $vl->setVar("id_doc",$request->getGet('id'));
        $vl->setVar("pag",$pag);
        $vl->display("ObservacaoList");
  }
  
  public function ObsAddForm(){
  	$request = knl_lib_Registry::getRequestObj();
  	/*
  	$ObsList = knl_lib_doc_ObservacaoList::getInstance();
  	$lista = $ObsList->listaObservacoes();
	*/
  	  	$vl = knl_view_Loader::getInstance();
        $vl->setVar("id_doc",$request->getGet('id'));
        $vl->display("ObservacaoFormAdd");
  }
  
  public function ObsAdd(){
  	$request = knl_lib_Registry::getRequestObj();
  	knl_lib_doc_ObservacaoAdd::getInstance()->AddObs();
  	/*
  	$ObsList = knl_lib_doc_ObservacaoList::getInstance();
  	$lista = $ObsList->listaObservacoes();
  	  	$vl = knl_view_Loader::getInstance();
        $vl->setVar("lista",$lista);
        $vl->setVar("id_doc",$request->getGet('id'));
        $vl->display("ObservacaoList");*/
  	$this->ObsList();
  }
  
  public function ObsSetxy(){
  	$request = knl_lib_Registry::getRequestObj();
  	$dObs = knl_dao_doc_obs::getInstance();
  	$mObs = $dObs->selectById($request->getGet("id_marca"));
  	$x = str_replace("px","",$request->getGet("x"));
  	$y = str_replace("px","",$request->getGet("y"));
  	$pag = $request->getGet("pag");
  	$pag = (empty($pag)) ? 1 : $pag ;
  	$mObs->set_x($x-12);
  	$mObs->set_y($y-18);
  	$mObs->set_pag($pag);
  	$dObs->upsert($mObs);
  }
  
  public function MarcaTxtAdd(){
  	$request = knl_lib_Registry::getRequestObj();
  	$id_doc = $request->getGet("id_doc");
  	$x = 50;
  	$y = $request->getGet("y");
  	$width = 100;
  	$height = 20;
  	$pag = $request->getGet("pag");
  	$dMtxt = new knl_model_doc_marca_texto(0,$id_doc,$x,$y,$width,$height,$pag);
  	
  	knl_dao_doc_marca_texto::getInstance()->upsert($dMtxt);
  	
  	$vl = knl_view_Loader::getInstance();
        $vl->setVar("marcatexto",$dMtxt);
        $vl->display("MarcaTxtAddAjx");
  }
  
  public function MarcaTxtSetxywh(){
  	$request = knl_lib_Registry::getRequestObj();
  	$dMtxt = knl_dao_doc_marca_texto::getInstance();
  	$id = $request->getGet("id_marcatxt");
  	$id_doc = $request->getGet("id_doc");
  	$x = str_replace("px","",$request->getGet("x"));
  	$y = str_replace("px","",$request->getGet("y"));
  	$width = str_replace("px","",$request->getGet("width"));
  	$height = str_replace("px","",$request->getGet("height"));
  	$pag = $request->getGet("pag");
  	$pag = (empty($pag)) ? 1 : $pag ;
	$mMtxt = new knl_model_doc_marca_texto($id,$id_doc,$x,$y,$width,$height,$pag);
  	$dMtxt->upsert($mMtxt);
  }
  
  public function MarcaTxtDel(){
  	$request = knl_lib_Registry::getRequestObj();
  	$dMtxt = knl_dao_doc_marca_texto::getInstance();
  	$id = $request->getGet("id_marcatxt");
  	$dMtxt->deleteById($id);
  }
  
  public function MarcaTxtGetXml(){
  	$request = knl_lib_Registry::getRequestObj();
  	$dMtxt = knl_dao_doc_marca_texto::getInstance();
  	$id_doc = $request->getGet("id_doc");
  	$pag = $request->getGet("pag");
  	$pag = (empty($pag)) ? 1 : $pag ;
  	$array_marcas = $dMtxt->selectByIdDocPag($id_doc,$pag);
  	$vl = knl_view_Loader::getInstance();
        $vl->setVar("marcatexto",$array_marcas);
        $vl->display("MarcaTxtGetAjx");
  }

  public function AnexoDel(){
  	$AnexoDel = knl_lib_doc_AnexoDel::getInstance();
  	$AnexoDel->DelAnexo();
  	$this->AnexoList();
  }
  
  public function AnexoList(){
  	$request = knl_lib_Registry::getRequestObj();
  	$DocShow = knl_lib_doc_DocShow::getInstance();
  	$doc = $DocShow->getDocumento($request->getGet('doc_id'));
  	$cabecalho = $DocShow->getDocumentoFull($doc);
  	$actions = $DocShow->getActions($doc);
  	$pag = $request->getGet('pag');
  	$pag = empty($pag) ? 1 : $request->getGet('pag') ;
  	
  	$AnexoList = knl_lib_doc_AnexoList::getInstance();
  	$lista = $AnexoList->listaAnexos();
  	  	$vl = knl_view_Loader::getInstance();
        $vl->setVar("paginacao",$lista['detalhes']);
        $arrAnexoTop = $lista['detalhes'];
        unset ($lista['detalhes']);
        $anexoTop = array('doc_id'=>$arrAnexoTop['doc_id'],'doc_anexo'=>$arrAnexoTop['doc_anexo'],'pag'=>$pag);
		foreach ($lista as $k=>$v) {
        	$lista[$k]['Desanexa'] = array_merge(
        	                              array('docActions'=>$v['docActions']),
        	                              array('anexoTop'=>$anexoTop),
        	                              array('doc'=>$v['doc']),
        	                              array('doc_anexo'=>$v['doc_anexo']));
        }
  		foreach ($lista as $k=>$v) {
        	$lista[$k]['MarcaAnexo'] = array_merge(
        	                              array('docActions'=>$v['docActions']),
        	                              array('anexoTop'=>$anexoTop),
        	                              array('doc'=>$v['doc']),
        	                              array('doc_anexo'=>$v['doc_anexo']));
        }
        $vl->setVar("anexoTop",$anexoTop);
        $vl->setVar("lista",$lista);
        $vl->setVar("actions",$actions);
        $vl->setVar("doc",$doc);
        $vl->setVar("pag",$pag);
        $vl->setVar("urlAdd",array_merge(array('domain'=>'Doc','action'=>'AnexoList'),$anexoTop));
        $vl->display("AnexoList");
  }

  public function newAnexoFind(){
  	$request = knl_lib_Registry::getRequestObj()->getInstance();
  	$DocFind = knl_lib_doc_newAnexoFind::getInstance(); 
  	$tipos = $DocFind->montaTipos();
  	$subTipos = $DocFind->montaSubTipos();
  	    $vl = knl_view_Loader::getInstance();
        $vl->setVar("tipos",$tipos);
        $vl->setVar("subTipos",$subTipos);
        $vl->setVar("id_doc",$request->getGet('id'));
        $vl->display("newAnexoFind");
  }
  
  public function newAnexoList(){
  	$request = knl_lib_Registry::getRequestObj()->getInstance();
  	$newAnexoList = knl_lib_doc_newAnexoList::getInstance(); 
  	$lista = $newAnexoList->montaLista();
  	  	$vl = knl_view_Loader::getInstance();
  	  	$vl->setVar("id_doc",$request->getGet('id'));
  	  	$vl->setVar("doc_anexo",$request->getGet('doc_anexo'));
        $vl->setVar("paginacao",$lista['detalhes']);
        $arrAnexoTop = $lista['detalhes']->get_arrayFiltro();
        unset ($lista['detalhes']);
		foreach ($lista as $k=>$v) {
        	$lista[$k]['Anexa'] = array_merge(
        	                              array('docActions'=>$v['docActions']),
        	                              array('id'=>$request->getGet('id'),'doc_anexo'=>$request->getGet('doc_anexo')),
        	                              array('doc'=>$v['doc']));
        }
        $vl->setVar("lista",$lista);
        $vl->setVar("urlAdd",array('domain'=>'Doc','action'=>'newAnexoList','id'=>$request->getGet('id'),'doc_anexo'=>$request->getGet('doc_anexo')));
        $vl->display("newAnexoList");
  }
  
  public function AnexoAdd(){
  	$request = knl_lib_Registry::getRequestObj()->getInstance();
  	$AnexoAdd = knl_lib_doc_AnexoAdd::getInstance();
  	$DocAnexo = $AnexoAdd->AddAnexo();
  	$PendOk = knl_lib_doc_PendenciaOk::getInstance();
  	$PendOk->AnexoOk($request->getGet('doc_id'));
  	
  	$this->AnexoList();
  }
  
  public function AnexoSetxy(){
  	$request = knl_lib_Registry::getRequestObj();
  	$dAnexo = knl_dao_doc_anexo::getInstance();
  	$mAnexo = $dAnexo->selectById($request->getGet("id_marca"));
  	$x = str_replace("px","",$request->getGet("x"));
  	$y = str_replace("px","",$request->getGet("y"));
  	$pag = $request->getGet("pag");
  	$pag = (empty($pag)) ? 1 : $pag ;
  	$mAnexo->set_x($x-12);
  	$mAnexo->set_y($y-18);
  	$mAnexo->set_pag($pag);
  	$dAnexo->upsert($mAnexo);
  }
  
  public function MailForm() {
  	$request = knl_lib_Registry::getRequestObj();
  	$DocShow = knl_lib_doc_DocShow::getInstance();
  	$doc = $DocShow->getDocumento($request->getGet('doc_id'));
  	$cabecalho = $DocShow->getDocumentoFull($doc);
  		$vl = knl_view_Loader::getInstance();
  		$vl->setVar("doc",$doc);
  		$vl->setVar("cabecalho",$cabecalho);
  		$vl->display("MailForm");
  }
  
  public function MailSend() {
  	$request = knl_lib_Registry::getRequestObj();
  	$DocShow = knl_lib_doc_DocShow::getInstance();
  	$doc = $DocShow->getDocumento($request->getPost('doc_id'));
  	$cabecalho = $DocShow->getDocumentoFull($doc);
  	knl_lib_doc_DocMail::getInstance()->enviaMail($doc,$request->getPost("destinatario"),$request->getPost("corpo"));
  	
  		$vl = knl_view_Loader::getInstance();
  		$vl->setVar("doc",$doc);
  		$vl->setVar("cabecalho",$cabecalho);
  		$vl->display("MailSend");
  }
  
  public function DocAuthAprova(){
  	$request = knl_lib_Registry::getRequestObj();
  	
  	$valores = array();
	$valores['blueprint-sticky.png']=1;
	$valores['blueprint-tool.png']=2;
	$valores['blueprint.png']=4;
	
	$valores['cd.png']=8;
	$valores['cdmin.png']=16;
	$valores['cdplus.png']=32;
	
	$valores['db.png']=64;
	$valores['dbmin.png']=128;
	$valores['dbplus.png']=256;
	
	$valores['injection.png']=512;
	$valores['injectiongreen.png']=1024;
	$valores['injectionorange.png']=2048;
	
	$valores['rssblue.png']=4096;
	$valores['rssgreen.png']=8192;
	$valores['rssorange.png']=16384;
	
	$valores['tag-blue.png']=32768;
	$valores['tag-green.png']=65536;
	$valores['tag-orange.png']=131072;
	
	$silabas = array_rand($valores,18);
	shuffle($silabas);
	
  	$total_tmp = 0;
  	$sequencia = $request->getGet('sequencia');
	$opcao_1 = $request->getGet('opcao_1');
	$opcao_2 = $request->getGet('opcao_2');
	$opcao_3 = $request->getGet('opcao_3');
	settype($opcao_1,"integer");
	settype($opcao_2,"integer");
	settype($opcao_3,"integer");
	$doc_id = $request->getget('id');
	$tp_apro = $request->getget('tpApr');
	
  	if ($sequencia == 3){
		$session = knl_lib_Registry::getSession();
		$id_usu = $session->get_id_usuario();
		$dUsu = knl_dao_knl_usuario::getInstance();
		$mUsu = $dUsu->selectById($id_usu);
	
		$senhacorreta = $mUsu->get_passwdauth1();
		/*
		var_dump($opcao_1);var_dump($opcao_2);var_dump($opcao_3);var_dump($senhacorreta);
		//die();
		
		if ($opcao_1 & $senhacorreta){
			echo "contem 1";
		}
		
  		if ($opcao_2 & $senhacorreta){
			echo "contem 2";
		}
		
  		if ($opcao_3 & $senhacorreta){
			echo "contem 3";
		}
		*/

		if (($opcao_1 & $mUsu->get_passwdauth1()) AND ($opcao_2 & $mUsu->get_passwdauth2()) AND ($opcao_3 & $mUsu->get_passwdauth3())){
			if($tp_apro == "aprovar"){
				$this->DocAprova();
			} else if($tp_apro == "reprovar"){
				$this->DocReprova();
			}
			echo "autorizado";
			?>
	<script type="text/javascript">
	//alert("ok");
	parent.displayAuthResultOk();
	</script>
			<?php
			die();
		}else {
			?>
	<script type="text/javascript">
	//alert("ok");
	parent.displayAuthResultFail();
	</script>
	Falha na autenticação!<br>
	Por favor, tente novamente
			<?php
			die();
		}
	}
	
	$silaba_str = "";

	foreach($silabas as $v=>$c){
		$total_tmp = $total_tmp + $valores[$c] ;
		$silaba_str .= '<img src="./view/w3c/img/iconespasswd/'.$c.'" border="0">';
	
		if (($v+1)%3 == 0){
			
			switch($sequencia){
				case 0:
					$opcao_1 = $total_tmp;
				break;
				case 1:
					$opcao_2 = $total_tmp;
				break;
				case 2:
					$opcao_3 = $total_tmp;
				break;
			}
			
			$opcao_seq = 'opcao_1='.$opcao_1.'&';
			$opcao_seq .= 'opcao_2='.$opcao_2.'&';
			$opcao_seq .= 'opcao_3='.$opcao_3.'&';
			
			echo '<div style="font:10px Verdana;float:left;top:0px; width:150px; height:68px; background-color:#ccc; border: 1px solid;">'.
			$silaba_str.'</br><center><a href="index.php?domain=Doc&action=DocAuthAprova&tpApr='.$tp_apro.'&id='.$doc_id.'&'.$opcao_seq.'sequencia='.($sequencia+1).'">Grupo</a></center></div>';
			$total_tmp = 0;
			$silaba_str = "";
		}
	}
  }
  
}
?>
