-- Extensão de nota fiscal de serviços prestados
-- requer extensão cadastronf instalada

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- Table structure for table `d_nf_servprest`
--


CREATE TABLE IF NOT EXISTS `d_nf_servprest` (
  `id` int(11) NOT NULL auto_increment,
  `id_doc` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `datasai` date NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_fornecedor` (`id_fornecedor`),
  KEY `id_doc` (`id_doc`),
  KEY `datasai` (`datasai`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `doc_tipo`
--

INSERT INTO `doc_tipo` (`id`, `descricao`, `classe`) VALUES 
(3, 'Nf de Serv Prestado', 'dnfservprest');

--
-- Extraindo dados da tabela `doc_tipo_cred`
--

INSERT INTO `doc_tipo_cred` 
(`id_doc_tipo`, `id_knl_usuario`, `perm_usuario`) VALUES 
(3, 1, 1),(3, 2, 1);

--
-- Extraindo dados da tabela `doc_sub_tipo`
--

INSERT INTO `doc_sub_tipo` (`id`, `id_doc_tipo`, `descricao`, `path`) VALUES 
(3, 3, 'Nf Serv Prestado', '/docinput/comercial/NfServPrest');

--
-- Extraindo dados da tabela `doc_sub_tipo_regra_cred`
--

INSERT INTO `doc_sub_tipo_regra_cred` (`addrem`, `id_doc_pendencia_tipo`, `id_knl_usuario`, `id_doc_sub_tipo`, `perm_usuario`) VALUES
('A', -1, 1, 3, 511),
('A', -1, 2, 3, 287),
('A', 4, 2, 3, 224),
('R', 4, 2, 3, 8);

--
-- Extraindo dados da tabela `doc_sub_tipo_regra_pend`
--

INSERT INTO `doc_sub_tipo_regra_pend` (`id_doc_pendencia_tipo`, `id_doc_pendencia_tipo2`, `id_doc_sub_tipo`, `id_knl_usuario`) VALUES
(-1, 4, 3, 2),(4, 5, 3, 2),(4, 1, 3, 2);

