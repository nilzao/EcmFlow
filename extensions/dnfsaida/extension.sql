-- Extensão de nota fiscal de saida
-- requer extensão cadastronf instalada

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- Table structure for table `d_nf_saida`
--

CREATE TABLE IF NOT EXISTS `d_nf_saida` (
  `id` int(11) NOT NULL auto_increment,
  `id_doc` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `datasai` date NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_doc` (`id_doc`),
  KEY `id_fornecedor` (`id_fornecedor`),
  KEY `datasai` (`datasai`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `doc_tipo`
--

INSERT INTO `doc_tipo` (`id`, `descricao`, `classe`) VALUES 
(2, 'Nf de Saída', 'dnfsaida');

--
-- Extraindo dados da tabela `doc_tipo_cred`
--

INSERT INTO `doc_tipo_cred` 
(`id_doc_tipo`, `id_knl_usuario`, `perm_usuario`) VALUES 
(2, 1, 1),(2, 2, 1);

--
-- Extraindo dados da tabela `doc_sub_tipo`
--

INSERT INTO `doc_sub_tipo` (`id`, `id_doc_tipo`, `descricao`, `path`) VALUES 
(2, 2, 'Nf Saída Venda', '/docinput/comercial/NfVenda');

--
-- Extraindo dados da tabela `doc_sub_tipo_regra_cred`
--

INSERT INTO `doc_sub_tipo_regra_cred` (`addrem`, `id_doc_pendencia_tipo`, `id_knl_usuario`, `id_doc_sub_tipo`, `perm_usuario`) VALUES
('A', -1, 1, 2, 511),
('A', -1, 2, 2, 287),
('A', 4, 2, 2, 224),
('R', 4, 2, 2, 8);

--
-- Extraindo dados da tabela `doc_sub_tipo_regra_pend`
--

INSERT INTO `doc_sub_tipo_regra_pend` (`id_doc_pendencia_tipo`, `id_doc_pendencia_tipo2`, `id_doc_sub_tipo`, `id_knl_usuario`) VALUES
(-1, 4, 2, 2),(4, 5, 2, 2),(4, 1, 2, 2);

