-- Extensão de cadastro de nota fiscal
-- necessário para extensões nf, pedidos e cotações

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- Estrutura da tabela `d_cad_nf`
--

CREATE TABLE IF NOT EXISTS `d_cad_nf` (
  `id` int(11) NOT NULL auto_increment,
  `cnpj` varchar(18) NOT NULL,
  `razao` varchar(100) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `ie` varchar(40) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `cnpj` (`cnpj`),
  KEY `razao` (`razao`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `d_cad_nf`
--

INSERT INTO `d_cad_nf` (`id`) VALUES
(-1);
-- --------------------------------------------------------

--
-- Estrutura da tabela `d_cotacao_cli`
--

CREATE TABLE IF NOT EXISTS `d_cotacao_cli` (
  `id` int(11) NOT NULL auto_increment,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `d_cotacao_cli`
--

INSERT INTO `d_cotacao_cli` (`id`) VALUES
(-1);

