-- Extensão de pedido de venda
-- requer extensão cadastronf instalada

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- Table structure for table `d_ped_venda`
--

CREATE TABLE IF NOT EXISTS `d_ped_venda` (
  `id` int(11) NOT NULL auto_increment,
  `id_doc` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_doc` (`id_doc`),
  KEY `id_fornecedor` (`id_fornecedor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `d_ped_venda_entrega`
--

CREATE TABLE IF NOT EXISTS `d_ped_venda_entrega` (
  `id` int(11) NOT NULL auto_increment,
  `id_d_ped_venda` int(11) NOT NULL,
  `dataentrega` date NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_d_ped_compra` (`id_d_ped_venda`),
  KEY `dataentrega` (`dataentrega`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `doc_tipo`
--

INSERT INTO `doc_tipo` (`id`, `descricao`, `classe`) VALUES 
(6, 'Pedido de Venda', 'dpedvenda');

--
-- Extraindo dados da tabela `doc_tipo_cred`
--

INSERT INTO `doc_tipo_cred` 
(`id_doc_tipo`, `id_knl_usuario`, `perm_usuario`) VALUES 
(6, 1, 1),(6, 2, 1);

--
-- Extraindo dados da tabela `doc_sub_tipo`
--

INSERT INTO `doc_sub_tipo` (`id`, `id_doc_tipo`, `descricao`, `path`) VALUES 
(6, 6, 'Pedido de Venda', '/docinput/comercial/Pedido');

--
-- Extraindo dados da tabela `doc_sub_tipo_regra_cred`
--

INSERT INTO `doc_sub_tipo_regra_cred` (`addrem`, `id_doc_pendencia_tipo`, `id_knl_usuario`, `id_doc_sub_tipo`, `perm_usuario`) VALUES
('A', -1, 1, 6, 511),
('A', -1, 2, 6, 287),
('A', 4, 2, 6, 224),
('R', 4, 2, 6, 8);

--
-- Extraindo dados da tabela `doc_sub_tipo_regra_pend`
--

INSERT INTO `doc_sub_tipo_regra_pend` (`id_doc_pendencia_tipo`, `id_doc_pendencia_tipo2`, `id_doc_sub_tipo`, `id_knl_usuario`) VALUES
(-1, 4, 6, 2),(4, 5, 6, 2),(4, 1, 6, 2);

