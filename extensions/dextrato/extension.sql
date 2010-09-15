-- Extensão de extrato de bancos

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- Table structure for table `d_extrato`
--

CREATE TABLE IF NOT EXISTS `d_extrato` (
  `id` int(11) NOT NULL auto_increment,
  `id_doc` int(11) NOT NULL,
  `id_conta` smallint(6) NOT NULL,
  `data_ini` date NOT NULL,
  `data_fim` date NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_doc` (`id_doc`),
  KEY `id_agencia` (`id_conta`),
  KEY `data_ini` (`data_ini`),
  KEY `data_fim` (`data_fim`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


--
-- Table structure for table `d_extrato_agencia`
--

CREATE TABLE IF NOT EXISTS `d_extrato_agencia` (
  `id` smallint(6) NOT NULL auto_increment,
  `id_banco` smallint(6) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `numero` (`numero`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `d_extrato_agencia` (`id`) VALUES 
(-1);

INSERT INTO `d_extrato_agencia` (`id`,`id_banco`,`numero`,`descricao`) VALUES
(1,1,'1234-5','Agência de Itaquaquecetuba do Norte');

-- --------------------------------------------------------

--
-- Table structure for table `d_extrato_banco`
--

CREATE TABLE IF NOT EXISTS `d_extrato_banco` (
  `id` smallint(6) NOT NULL auto_increment,
  `numero` varchar(10) NOT NULL,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `d_extrato_banco` (`id`) VALUES 
(-1);

INSERT INTO `d_extrato_banco` (`id`,`numero`,`nome`) VALUES 
(1,'839','Banqueiros S.A.');

-- --------------------------------------------------------

--
-- Table structure for table `d_extrato_conta`
--

CREATE TABLE IF NOT EXISTS `d_extrato_conta` (
  `id` smallint(6) NOT NULL auto_increment,
  `id_agencia` smallint(6) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `obs` varchar(50) NOT NULL,
  `id_empresa` smallint(6) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_agencia` (`id_agencia`),
  KEY `id_empresa` (`id_empresa`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `d_extrato_conta` (`id`) VALUES 
(-1);

INSERT INTO `d_extrato_conta` (`id`,`id_agencia`,`numero`,`obs`,`id_empresa`) VALUES 
(1,1,'123456-X','Conta Oficial da Empresa Ficticia',1);

--
-- Extraindo dados da tabela `doc_tipo`
--

INSERT INTO `doc_tipo` (`id`, `descricao`, `classe`) VALUES 
(8, 'Extrato', 'dextrato');

--
-- Extraindo dados da tabela `doc_tipo_cred`
--

INSERT INTO `doc_tipo_cred` 
(`id_doc_tipo`, `id_knl_usuario`, `perm_usuario`) VALUES 
(8, 1, 1),(8, 2, 1);

--
-- Extraindo dados da tabela `doc_sub_tipo`
--

INSERT INTO `doc_sub_tipo` (`id`, `id_doc_tipo`, `descricao`, `path`) VALUES 
(8, 8, 'Extrato', '/docinput/financeiro/Extrato');

--
-- Extraindo dados da tabela `doc_sub_tipo_regra_cred`
--

INSERT INTO `doc_sub_tipo_regra_cred` (`addrem`, `id_doc_pendencia_tipo`, `id_knl_usuario`, `id_doc_sub_tipo`, `perm_usuario`) VALUES
('A', -1, 1, 8, 511),
('A', -1, 2, 8, 287),
('A', 4, 2, 8, 224),
('R', 4, 2, 8, 8);

--
-- Extraindo dados da tabela `doc_sub_tipo_regra_pend`
--

INSERT INTO `doc_sub_tipo_regra_pend` (`id_doc_pendencia_tipo`, `id_doc_pendencia_tipo2`, `id_doc_sub_tipo`, `id_knl_usuario`) VALUES
(-1, 4, 8, 2),(4, 5, 8, 2),(4, 1, 8, 2);

