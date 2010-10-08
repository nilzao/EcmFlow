<?php
class knl_domain_Shell {
	private static $instance;

    private function __construct(){}
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function handle(){
    	
    	
    	$shell = knl_lib_Registry::getShellArgs();
    	switch($shell->getShellArg(2)){
    		case "newDoc" :
    			$this->newDoc();
    		break;
    		case "updDoc" :
    			$this->updateDoc();
    		break;
    		case "addPag" :
    			$this->addPagDoc();
    		break;
    		default :
    			echo "\n Uso do domain: Shell [newDoc ou updDoc] \n";    		
    		break; 
    	}
    	// shell arg2 fornecido: ".$shell->getShellArg(2)
    	/*
    	 * shell arg2: newDoc ou upDoc ou addPag
    	 * shell arg3: empresa
    	 * shell arg4: caminho completo path/nome_arquivo (contém o numero do documento e path para saber qual doc_tipo trabalhar)
    	 * shell arg5: qtd paginas
    	 *  
    	 *  exemplo: php index.php Shell newDoc PedCompra   1    112233   1 
    	 *                          arg1  arg2    arg3     arg4   arg5   arg6
    	 * 
    	 */
    	/*
    	 *
    	 * procurar no campo 'str_shell' do dao subtipo a string do arg 3. exemplo 'NfAlmox'
    	 * agora com o model do dao completo,
    	 *
    	 * instanciar model_doc com dados basicos,
    	 * colocar model_doc em dao_doc e chamar o metodo upsert
    	 * pegar o id de retorno
    	 *
    	 * instanciar a classe model correspondente de id_doc_tipo (exemplo model_d_nf_entrada)
    	 * colocar o model no dao correspondente e chamar upsert
    	 *
    	 * pegar os daos com as regras de pendencias e credenciais
    	 * (where id_doc_pendencia_tipo = -1 AND id_doc_sub_tipo = \$model->get_id())
    	 * detalhe para o doc_pendencia_tipo = -1 (Novo) -2 Preencher
    	 * instanciar models doc_cred, doc_pendencia,
    	 * colocar eles nos respectivos daos, chamar o metodo upsert dos daos.
    	 * isso vai fazer com que as regras definidas em regra_cred e regra_pend
    	 * sejam criadas para o novo documento em questão.
    	 * 
         */
    	//print_r($shell->getShellArgArray());
    }
    
    public function newDoc(){
    	$session = knl_lib_Registry::getSession();
    	$shell = knl_lib_Registry::getShellArgs();
    	$onde_ini = strrpos($shell->getShellArg(4), '/')+1;
		$onde_fim = strpos($shell->getShellArg(4), ".")-$onde_ini;
		
		$num_doc = substr($shell->getShellArg(4), $onde_ini, $onde_fim);
    	$path = substr($shell->getShellArg(4),0,$onde_ini-1);
    	
        $DocSubTipo = knl_dao_doc_sub_tipo::getInstance();
    	$mDocSubTipo = $DocSubTipo->selectByPath($path);
    	
    	$DocTipo = knl_dao_doc_tipo::getInstance();
    	$mDocTipo = $DocTipo->selectById($mDocSubTipo->get_id_doc_tipo());
    	
    	
    	//$mDocSubTipo->get_id_doc_tipo();
    	$newmDoc = new knl_model_doc(0,
    	                            $mDocSubTipo->get_id_doc_tipo(),
    	                            $mDocSubTipo->get_id(),
    	                            $shell->getShellArg(3),
    	                            $num_doc,
    	                            date("Y-m-d"),
    	                            $shell->getShellArg(5));

    	$newDoc = knl_dao_doc::getInstance()->upsert($newmDoc);
    	
    	$valores = array("id_doc"=>$newDoc->get_id(),"data"=>date("Y-m-d"),"classe"=>$mDocTipo->get_classe(),"num_doc"=>$num_doc);

    	$classe = str_replace("_","",$mDocTipo->get_classe());
    	$DocH = call_user_func("knl_extensions_".$classe."_shell::getInstance");
    	$DocH->gravaNoBanco($valores);
    	
    	$doc_assinatura = knl_dao_doc_assinatura::getInstance();
    	$m_doc_assinatura = 
    		new knl_model_doc_assinatura(0,$newDoc->get_id(),7,1,date("Y-m-d H:i:s"),'S');
    	$doc_assinatura->upsert($m_doc_assinatura);
    	
    	echo $newDoc->get_id();
    	
    	$Regras = knl_lib_Regras::getInstance();
    	$Regras->regraCred($newDoc->get_id(),-1);
    	$Regras->regraPend($newDoc->get_id(),-1);
    }
    
    public function updateDoc(){
    	
    }
    
    public function addPagDoc() {
    	/*
    	 * arg 3: id_doc
    	 * arg 4: /path_completo/nome_do_arquivo.jpg gerado pelo imagemagick
    	 * arg 5: vazio, 1 se for jpg direto sem numero de paginas
    	 */
    	$path_sistema = str_replace("index.php","",$_SERVER["SCRIPT_FILENAME"])."img/doc/";
    	//echo $path_sistema;
    	$shell = knl_lib_Registry::getShellArgs();
    	$onde_ini = strrpos($shell->getShellArg(4), '-')+1;
		$onde_fim = strpos($shell->getShellArg(4), ".")-$onde_ini;
		$num_pag=1;
		if ($shell->getShellArg(5) == ""){
    		$num_pag = substr($shell->getShellArg(4),$onde_ini,$onde_fim)+1;	
    	}
    	copy($shell->getShellArg(4),$path_sistema.$shell->getShellArg(3)."_".$num_pag.".jpg");

    	/* adaptação para pedVendas que vem do fs... implementar outra solução que venha do banco com angulo do subtipo*/
    	//$Doc = knl_dao_doc::getinstance();
    	//$mDoc= $Doc->selectById($shell->getShellArg(3));
    	//if ($mDoc->get_id_doc_sub_tipo() == 8){
    	//	shell_exec("convert -rotate 90 -geometry 1000x9000 ".$path_sistema.$shell->getShellArg(3)."_".$num_pag.".jpg ".$path_sistema.$shell->getShellArg(3)."_".$num_pag.".jpg");
    	//}
    	
    }
}
?>
