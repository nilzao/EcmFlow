<?php
// comentario 3, testando denovo
class knl_controller_FrontController {
  public function dispatch($shellArray)
  {
      	//knl_lib_Perm::verificaDomain(isset($_REQUEST['domain'])?$_REQUEST['domain']:'');
      	$shell = knl_lib_Registry::getShellArgs();
      	$shell->setShellArgs($shellArray);
      	
      	$shellArg1 = $shell->getShellArg(1);
      	$request = knl_lib_Registry::getRequest()->getInstance();

      	$domain = !empty($shellArg1) ? $domain = $shell->getShellArg(1) : $request->getRequest('domain');
      	$extdm = $request->getRequest('extdm');
        switch($domain) {
            case "Doc":
                knl_domain_Doc::getInstance()->handle();
            break;
            case "Deptos":
                knl_domain_Deptos::getInstance()->handle();
            break;
            case "RegCred":
                knl_domain_RegraCred::getInstance()->handle();
            break;
            case "RegPend":
                knl_domain_RegraPend::getInstance()->handle();
            break;
            case "DocTpCred":
                knl_domain_DocTipoCred::getInstance()->handle();
            break;
            case "Users":
                knl_domain_Usuarios::getInstance()->handle();
            break;
            case "Grupos":
                knl_domain_Grupos::getInstance()->handle();
            break;
            case "Acesso":
                knl_domain_Acesso::getInstance()->handle();
            break;
            case "Empresa":
                knl_domain_Empresa::getInstance()->handle();
            break;
            case "Shell":
            	if (empty($shellArg1)){throw new Exception("Domain Shell somente acessivel no console do host");}
                knl_domain_Shell::getInstance()->handle();
            break;
            case "Entrada":
                require("view/entrada.php");
            break;
            default:
            	if(empty($extdm)){
            		knl_domain_Index::getInstance()->handle();
            	} else{
            		$chamada = 'knl_extensions_'.$extdm.'_Domain::getInstance';
            		$objdm =  call_user_func($chamada);
            		$objdm->handle();
            	}
            	
                //require("view/index.php");
            break;
        }
  }
}
?>
