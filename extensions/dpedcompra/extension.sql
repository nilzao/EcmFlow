-- Extensão de pedido de compra
-- requer extensão cadastronf instalada

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------
--
-- Table structure for table `d_ped_compra`
--

CREATE TABLE IF NOT EXISTS `d_ped_compra` (
  `id` int(11) NOT NULL auto_increment,
  `id_doc` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_fornecedor` (`id_fornecedor`),
  KEY `id_doc` (`id_doc`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `d_ped_compra_entrega`
--

CREATE TABLE IF NOT EXISTS `d_ped_compra_entrega` (
  `id` int(11) NOT NULL auto_increment,
  `id_d_ped_compra` int(11) NOT NULL,
  `dataentrega` date NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_d_ped_compra` (`id_d_ped_compra`),
  KEY `dataentrega` (`dataentrega`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `doc_tipo`
--

INSERT INTO `doc_tipo` (`id`, `descricao`, `classe`) VALUES 
(5, 'Pedido de Compra', 'dpedcompra');

--
-- Extraindo dados da tabela `doc_tipo_cred`
--

INSERT INTO `doc_tipo_cred` 
(`id_doc_tipo`, `id_knl_usuario`, `perm_usuario`) VALUES 
(5, 1, 1),(5, 2, 1);

--
-- Extraindo dados da tabela `doc_sub_tipo`
--

INSERT INTO `doc_sub_tipo` (`id`, `id_doc_tipo`, `descricao`, `path`) VALUES 
(5, 5, 'Pedido de Compra', '/docinput/compras/Pedido');

--
-- Extraindo dados da tabela `doc_sub_tipo_regra_cred`
--

INSERT INTO `doc_sub_tipo_regra_cred` (`addrem`, `id_doc_pendencia_tipo`, `id_knl_usuario`, `id_doc_sub_tipo`, `perm_usuario`) VALUES
('A', -1, 1, 5, 511),
('A', -1, 2, 5, 287),
('A', 4, 2, 5, 224),
('R', 4, 2, 5, 8);

--
-- Extraindo dados da tabela `doc_sub_tipo_regra_pend`
--

INSERT INTO `doc_sub_tipo_regra_pend` (`id_doc_pendencia_tipo`, `id_doc_pendencia_tipo2`, `id_doc_sub_tipo`, `id_knl_usuario`) VALUES
(-1, 4, 5, 2),(4, 5, 5, 2),(4, 1, 5, 2);

