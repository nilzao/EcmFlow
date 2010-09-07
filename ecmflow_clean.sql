SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- Estrutura da tabela `carimbo`
--

CREATE TABLE IF NOT EXISTS `carimbo` (
  `id` int(11) NOT NULL auto_increment,
  `descricao` varchar(50) NOT NULL,
  `cfop` varchar(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `carimbo`
--

INSERT INTO `carimbo` (`id`, `descricao`, `cfop`) VALUES
(1, 'Exemplo Carimbo', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `carimbo_cred`
--

CREATE TABLE IF NOT EXISTS `carimbo_cred` (
  `id` int(11) NOT NULL auto_increment,
  `id_carimbo` int(11) NOT NULL,
  `id_knl_usuario` int(11) NOT NULL,
  `id_knl_grupo` int(11) NOT NULL,
  `perm_usuario` smallint(3) NOT NULL,
  `perm_grupo` smallint(3) NOT NULL,
  `perm_outros` smallint(3) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_usuario` (`id_knl_usuario`),
  KEY `id_grupo` (`id_knl_grupo`),
  KEY `perm_usuario` (`perm_usuario`),
  KEY `perm_grupo` (`perm_grupo`),
  KEY `id_carimbo` (`id_carimbo`),
  KEY `perm_outros` (`perm_outros`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `carimbo_cred`
--

INSERT INTO `carimbo_cred` (`id`, `id_carimbo`, `id_knl_usuario`, `id_knl_grupo`, `perm_usuario`, `perm_grupo`, `perm_outros`) VALUES
(1, 1, 1, 0, 1, 0, 0),
(2, 1, 2, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `doc`
--

CREATE TABLE IF NOT EXISTS `doc` (
  `id` int(11) NOT NULL auto_increment,
  `id_doc_tipo` int(11) NOT NULL,
  `id_doc_sub_tipo` smallint(6) NOT NULL,
  `id_empresa` smallint(6) NOT NULL,
  `numero` varchar(30) NOT NULL,
  `data_doc` date NOT NULL,
  `pag` smallint(3) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `numero` (`numero`),
  KEY `data` (`data_doc`),
  KEY `id_tipo` (`id_doc_tipo`),
  KEY `id_empresa` (`id_empresa`),
  KEY `id_doc_sub_tipo` (`id_doc_sub_tipo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 PACK_KEYS=1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `doc`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_anexo`
--

CREATE TABLE IF NOT EXISTS `doc_anexo` (
  `id` int(11) NOT NULL auto_increment,
  `id_doc1` int(11) NOT NULL,
  `id_doc2` int(11) NOT NULL,
  `data_anexo` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `x` smallint(4) NOT NULL,
  `y` smallint(4) NOT NULL,
  `pag` smallint(4) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_documento1` (`id_doc1`),
  KEY `id_documento2` (`id_doc2`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `doc_anexo`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_assinatura`
--

CREATE TABLE IF NOT EXISTS `doc_assinatura` (
  `id` int(11) NOT NULL auto_increment,
  `id_doc` int(11) NOT NULL,
  `id_doc_assinatura_tipo` smallint(2) NOT NULL,
  `id_knl_usuario` int(11) NOT NULL,
  `data_assinatura` datetime NOT NULL,
  `valida` enum('S','N') NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_documento` (`id_doc`),
  KEY `id_usuario` (`id_knl_usuario`),
  KEY `data` (`data_assinatura`),
  KEY `valida` (`valida`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `doc_assinatura`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_assinatura_tipo`
--

CREATE TABLE IF NOT EXISTS `doc_assinatura_tipo` (
  `id` smallint(2) NOT NULL auto_increment,
  `descricao` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `doc_assinatura_tipo`
--

INSERT INTO `doc_assinatura_tipo` (`id`, `descricao`) VALUES
(1, 'Visto'),
(2, 'Aprovado'),
(3, 'Reprovado'),
(4, 'Lancado'),
(5, 'Excluido'),
(6, 'Editado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_carimbo`
--

CREATE TABLE IF NOT EXISTS `doc_carimbo` (
  `id` int(11) NOT NULL auto_increment,
  `id_doc` int(11) NOT NULL,
  `id_carimbo` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_documento` (`id_doc`),
  KEY `id_carimbo` (`id_carimbo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `doc_carimbo`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_cred`
--

CREATE TABLE IF NOT EXISTS `doc_cred` (
  `id` int(11) NOT NULL auto_increment,
  `id_doc` int(11) NOT NULL,
  `id_knl_usuario` int(11) NOT NULL,
  `id_knl_grupo` int(11) NOT NULL,
  `perm_usuario` smallint(3) NOT NULL,
  `perm_grupo` smallint(3) NOT NULL,
  `perm_outros` smallint(3) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_usuario` (`id_knl_usuario`),
  KEY `id_grupo` (`id_knl_grupo`),
  KEY `perm_usuario` (`perm_usuario`),
  KEY `perm_grupo` (`perm_grupo`),
  KEY `id_documento` (`id_doc`),
  KEY `perm_outros` (`perm_outros`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `doc_cred`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_marca_texto`
--

CREATE TABLE IF NOT EXISTS `doc_marca_texto` (
  `id` int(11) NOT NULL auto_increment,
  `id_doc` int(11) NOT NULL,
  `x` smallint(4) NOT NULL,
  `y` smallint(4) NOT NULL,
  `width` smallint(4) NOT NULL,
  `height` smallint(4) NOT NULL,
  `pag` smallint(4) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_documento` (`id_doc`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `doc_marca_texto`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_obs`
--

CREATE TABLE IF NOT EXISTS `doc_obs` (
  `id` int(11) NOT NULL auto_increment,
  `id_doc` int(11) NOT NULL,
  `obs` text NOT NULL,
  `x` smallint(4) NOT NULL,
  `y` smallint(4) NOT NULL,
  `pag` smallint(4) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_documento` (`id_doc`),
  FULLTEXT KEY `obs` (`obs`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `doc_obs`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_pendencia`
--

CREATE TABLE IF NOT EXISTS `doc_pendencia` (
  `id` int(11) NOT NULL auto_increment,
  `id_doc` int(11) NOT NULL,
  `id_knl_usuario` int(11) NOT NULL,
  `id_knl_grupo` int(11) NOT NULL,
  `id_doc_pendencia_tipo` int(11) NOT NULL,
  `ativa` enum('S','N') NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_doc` (`id_doc`),
  KEY `id_knl_grupo` (`id_knl_grupo`),
  KEY `id_knl_usuario` (`id_knl_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `doc_pendencia`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_pendencia_tipo`
--

CREATE TABLE IF NOT EXISTS `doc_pendencia_tipo` (
  `id` int(11) NOT NULL auto_increment,
  `descricao` varchar(100) NOT NULL,
  `classe` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `doc_pendencia_tipo`
--

INSERT INTO `doc_pendencia_tipo` (`id`, `descricao`, `classe`) VALUES
(-1, 'Novo', ''),
(1, 'Assinar', ''),
(2, 'Anexar', ''),
(4, 'Completar', 'EditOk'),
(5, 'Aprovar', ''),
(6, 'Reprovar', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_sub_tipo`
--

CREATE TABLE IF NOT EXISTS `doc_sub_tipo` (
  `id` smallint(6) NOT NULL auto_increment,
  `id_doc_tipo` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `str_shell` varchar(100) NOT NULL,
  `path` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `path` (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `doc_sub_tipo`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_sub_tipo_cred`
--

CREATE TABLE IF NOT EXISTS `doc_sub_tipo_cred` (
  `id` int(11) NOT NULL auto_increment,
  `id_doc_sub_tipo` int(11) NOT NULL,
  `id_knl_usuario` int(11) NOT NULL,
  `id_knl_grupo` int(11) NOT NULL,
  `perm_usuario` smallint(3) NOT NULL,
  `perm_grupo` smallint(3) NOT NULL,
  `perm_outros` smallint(3) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_doc_sub_tipo` (`id_doc_sub_tipo`),
  KEY `id_knl_usuario` (`id_knl_usuario`),
  KEY `id_knl_grupo` (`id_knl_grupo`),
  KEY `perm_usuario` (`perm_usuario`),
  KEY `perm_grupo` (`perm_grupo`),
  KEY `perm_outros` (`perm_outros`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `doc_sub_tipo_cred`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_sub_tipo_regra_cred`
--

CREATE TABLE IF NOT EXISTS `doc_sub_tipo_regra_cred` (
  `id` int(11) NOT NULL auto_increment,
  `addrem` enum('A','R') NOT NULL default 'A',
  `id_doc_pendencia_tipo` smallint(6) NOT NULL,
  `id_knl_usuario` smallint(6) NOT NULL,
  `id_knl_grupo` smallint(6) NOT NULL,
  `id_doc_sub_tipo` smallint(6) NOT NULL,
  `perm_usuario` smallint(3) NOT NULL,
  `perm_grupo` smallint(3) NOT NULL,
  `perm_outros` smallint(3) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_doc_pendencia_tipo` (`id_doc_pendencia_tipo`),
  KEY `id_doc_sub_tipo` (`id_doc_sub_tipo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `doc_sub_tipo_regra_cred`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_sub_tipo_regra_pend`
--

CREATE TABLE IF NOT EXISTS `doc_sub_tipo_regra_pend` (
  `id` int(11) NOT NULL auto_increment,
  `id_doc_pendencia_tipo` smallint(6) NOT NULL,
  `id_doc_pendencia_tipo2` smallint(6) NOT NULL,
  `id_doc_sub_tipo` smallint(6) NOT NULL,
  `id_knl_usuario` int(11) NOT NULL,
  `id_knl_grupo` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_doc_pendencia_tipo` (`id_doc_pendencia_tipo`),
  KEY `id_doc_sub_tipo` (`id_doc_sub_tipo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `doc_sub_tipo_regra_pend`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_tipo`
--

CREATE TABLE IF NOT EXISTS `doc_tipo` (
  `id` smallint(6) NOT NULL auto_increment,
  `descricao` varchar(100) NOT NULL,
  `classe` varchar(100) NOT NULL,
  `ordem` smallint(3) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `ordem` (`ordem`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `doc_tipo`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `doc_tipo_cred`
--

CREATE TABLE IF NOT EXISTS `doc_tipo_cred` (
  `id` int(11) NOT NULL auto_increment,
  `id_doc_tipo` int(11) NOT NULL,
  `id_knl_usuario` int(11) NOT NULL,
  `id_knl_grupo` int(11) NOT NULL,
  `perm_usuario` smallint(3) NOT NULL,
  `perm_grupo` smallint(3) NOT NULL,
  `perm_outros` smallint(3) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_doc_tipo` (`id_doc_tipo`),
  KEY `id_knl_usuario` (`id_knl_usuario`),
  KEY `id_knl_grupo` (`id_knl_grupo`),
  KEY `perm_usuario` (`perm_usuario`),
  KEY `perm_grupo` (`perm_grupo`),
  KEY `perm_outros` (`perm_outros`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 PACK_KEYS=0 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `doc_tipo_cred`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `id` smallint(6) NOT NULL auto_increment,
  `fantasia` varchar(100) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id`, `fantasia`, `cnpj`) VALUES
(1, 'Empresa Ficticia', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `knl_depto`
--

CREATE TABLE IF NOT EXISTS `knl_depto` (
  `id` smallint(6) NOT NULL auto_increment,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `knl_depto`
--

INSERT INTO `knl_depto` (`id`, `descricao`) VALUES
(1, 'root'),
(2, 'depto teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `knl_grupo`
--

CREATE TABLE IF NOT EXISTS `knl_grupo` (
  `id` int(11) NOT NULL auto_increment,
  `id_knl_depto` smallint(6) NOT NULL,
  `id_knl_perm_bin` smallint(2) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `usuarios` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 PACK_KEYS=1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `knl_grupo`
--

INSERT INTO `knl_grupo` (`id`, `id_knl_depto`, `id_knl_perm_bin`, `nome`, `usuarios`) VALUES
(1, 1, 11, 'usuarios', ''),
(2, 2, 1, 'grupo teste', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `knl_grupo_usuario`
--

CREATE TABLE IF NOT EXISTS `knl_grupo_usuario` (
  `id` int(11) NOT NULL auto_increment,
  `id_knl_usuario` int(11) NOT NULL,
  `id_knl_grupo` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `knl_grupo_usuario`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `knl_menu`
--

CREATE TABLE IF NOT EXISTS `knl_menu` (
  `id` int(11) NOT NULL auto_increment,
  `target` varchar(50) NOT NULL default 'conteudo',
  `ordem` varchar(7) NOT NULL,
  `icfechada` varchar(200) NOT NULL,
  `icaberta` varchar(200) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `aberto` enum('S','N') NOT NULL,
  `label` varchar(100) NOT NULL,
  `domain` varchar(100) NOT NULL,
  `action` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Extraindo dados da tabela `knl_menu`
--

INSERT INTO `knl_menu` (`id`, `target`, `ordem`, `icfechada`, `icaberta`, `titulo`, `aberto`, `label`, `domain`, `action`) VALUES
(1, 'conteudo', '###:000', '', '', 'Entrar', '', 'Entrar no sistema', 'Acesso', 'formin'),
(2, '_parent', '999:000', '', '', 'Sair', '', 'Sair do sistema', 'Acesso', 'out'),
(3, 'conteudo', '005:000', '', '', 'Pesquisa', '', 'Pesquisar documentos', 'Doc', 'DocFind'),
(4, 'conteudo', '004:000', '', '', 'Pendências', '', 'Verificar pendencias em aberto', 'Doc', 'PendenciaFind'),
(5, 'conteudo', '006:000', '', '', 'Selecionar Empresa', '', 'Empresa', 'Empresa', 'list'),
(8, 'conteudo', '010:001', '', '', 'Grupos', '', 'Grupos', 'Grupos', 'lst'),
(9, 'conteudo', '010:000', '', '', 'Deptos', '', 'Departamentos', 'Deptos', 'lst'),
(10, 'conteudo', '010:000', '', '', 'Usuarios', 'N', 'Usuários', 'Users', 'lst'),
(11, 'conteudo', '011:000', '', '', 'Regra Cred', '', 'Regra de credenciais', 'RegCred', 'lst'),
(12, 'conteudo', '011:000', '', '', 'Regra Pend', '', 'Regra de pendencias', 'RegPend', 'lst'),
(13, 'conteudo', '012:000', '', '', 'Doc Tipo Cred', '', 'Credenciais tipo de documento', 'DocTpCred', 'lst');

-- --------------------------------------------------------

--
-- Estrutura da tabela `knl_menu_cred`
--

CREATE TABLE IF NOT EXISTS `knl_menu_cred` (
  `id` int(11) NOT NULL auto_increment,
  `id_knl_menu` int(11) NOT NULL,
  `id_knl_usuario` int(11) NOT NULL,
  `id_knl_grupo` int(11) NOT NULL,
  `perm_usuario` smallint(3) NOT NULL,
  `perm_grupo` smallint(3) NOT NULL,
  `perm_outros` smallint(3) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `knl_menu_cred`
--

INSERT INTO `knl_menu_cred` (`id`, `id_knl_menu`, `id_knl_usuario`, `id_knl_grupo`, `perm_usuario`, `perm_grupo`, `perm_outros`) VALUES
(1, 1, 0, 0, 0, 1, 0),
(2, 2, 0, 1, 0, 1, 0),
(3, 3, 1, 0, 1, 0, 0),
(4, 4, 1, 0, 1, 0, 0),
(6, 5, 1, 0, 1, 0, 0),
(9, 8, 1, 0, 0, 0, 0),
(10, 9, 1, 0, 0, 0, 0),
(11, 10, 1, 0, 1, 0, 0),
(12, 11, 1, 0, 1, 0, 0),
(13, 12, 1, 0, 1, 0, 0),
(14, 13, 1, 0, 1, 0, 0),
(15, 14, 1, 0, 1, 0, 0),
(16 , 3, 2, 0, 1, 0, 0),
(17 , 4, 2, 0, 1, 0, 0),
(18 , 5, 2, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `knl_perm_bin`
--

CREATE TABLE IF NOT EXISTS `knl_perm_bin` (
  `id` smallint(1) NOT NULL auto_increment,
  `permbin` smallint(3) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `knl_perm_bin`
--

INSERT INTO `knl_perm_bin` (`id`, `permbin`, `descricao`) VALUES
(1, 1, 'Listar'),
(2, 2, 'Visualizar'),
(3, 4, 'Add Observação'),
(4, 8, 'Excluir'),
(5, 16, 'Assinar'),
(6, 32, 'Desanexar'),
(7, 64, 'Anexar'),
(8, 128, 'Aprovar / Reprovar'),
(9, 256, 'Editar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `knl_usuario`
--

CREATE TABLE IF NOT EXISTS `knl_usuario` (
  `id` int(11) NOT NULL auto_increment,
  `id_knl_grupo` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(250) NOT NULL,
  `script_ini` varchar(200) NOT NULL,
  `home` varchar(200) NOT NULL,
  `passwdlimpo` varchar(20) NOT NULL,
  `passwdauth1` int(11) NOT NULL,
  `passwdauth2` int(11) NOT NULL,
  `passwdauth3` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `knl_usuario`
--

INSERT INTO `knl_usuario` (`id`, `id_knl_grupo`, `login`, `senha`, `script_ini`, `home`, `passwdlimpo`, `passwdauth1`, `passwdauth2`, `passwdauth3`) VALUES
(1, 1, 'root', '63a9f0ea7bb98050796b649e85481845', '', '', 'root', 0, 0, 0),
(2, 1, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', '', '', 'user', 512, 512, 512);
