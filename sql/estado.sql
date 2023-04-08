-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 10-Ago-2020 às 00:13
-- Versão do servidor: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mystore`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

CREATE TABLE `estado` (
  `esta_pk_id` int(11) NOT NULL,
  `esta_nome` varchar(45) DEFAULT NULL,
  `esta_sigla` char(2) DEFAULT NULL,
  `esta_status` tinyint(1) NOT NULL DEFAULT '1',
  `esta_fk_usuario_pk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estado`
--

INSERT INTO `estado` (`esta_pk_id`, `esta_nome`, `esta_sigla`, `esta_status`, `esta_fk_usuario_pk_id`) VALUES
(1, 'Acre', 'AC', 1, 1),
(2, 'Alagoas', 'AL', 1, 1),
(3, 'Amapá', 'AP', 1, 1),
(4, 'Amazonas', 'AM', 1, 1),
(5, 'Bahia', 'BA', 1, 1),
(6, 'Ceará', 'CE', 1, 1),
(7, 'Distrito Federal', 'DF', 1, 1),
(8, 'Espírito Santo', 'ES', 1, 1),
(9, 'Goiás', 'GO', 1, 1),
(10, 'Maranhão', 'MA', 1, 1),
(11, 'Mato Grosso', 'MT', 1, 1),
(12, 'Mato Grosso do Sul', 'MS', 1, 1),
(13, 'Minas Gerais', 'MG', 1, 1),
(14, 'Pará', 'PA', 1, 1),
(15, 'Paraíba', 'PB', 1, 1),
(16, 'Paraná', 'PR', 1, 1),
(17, 'Pernambuco', 'PE', 1, 1),
(18, 'Piauí', 'PI', 1, 1),
(19, 'Rio de Janeiro', 'RJ', 1, 1),
(20, 'Rio Grande do Norte', 'RN', 1, 1),
(21, 'Rio Grande do Sul', 'RS', 1, 1),
(22, 'Rondônia', 'RO', 1, 1),
(23, 'Roraima', 'RR', 1, 1),
(24, 'Santa Catarina', 'SC', 1, 1),
(25, 'São Paulo', 'SP', 1, 1),
(26, 'Sergipe', 'SE', 1, 1),
(27, 'Tocantins', 'TO', 1, 1);

--
-- Acionadores `estado`
--
DELIMITER $$
CREATE TRIGGER `estado_AFTER_DELETE` AFTER DELETE ON `estado` FOR EACH ROW BEGIN
	INSERT INTO log_estado	(lesta_o_que_modificou, lesta_data_operacao, lesta_operacao, lesta_fk_usuario_pk_id, lesta_id_tabela) VALUES ('Estado Apagado', now(),'DELETE', OLD.esta_fk_usuario_pk_id, OLD.esta_pk_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_estado_insert` AFTER INSERT ON `estado` FOR EACH ROW BEGIN
INSERT INTO log_estado (lesta_data_operacao, lesta_operacao, lesta_fk_usuario_pk_id, lesta_id_tabela, lesta_o_que_modificou) VALUES (now(),'INSERT', NEW.esta_fk_usuario_pk_id, NEW.esta_pk_id, 'Cadastro Realizado');
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trigger_estado_update` AFTER UPDATE ON `estado` FOR EACH ROW BEGIN
IF (OLD.esta_nome <> NEW.esta_nome or (OLD.esta_nome IS NULL and NEW.esta_nome IS NOT NULL)) THEN
			INSERT INTO log_estado (lesta_o_que_modificou, lesta_valor_antigo, lesta_valor_atual, lesta_data_operacao, lesta_operacao, lesta_fk_usuario_pk_id, lesta_id_tabela) VALUES ('Nome do Estado', OLD.esta_nome, NEW.esta_nome, now(), 'UPDATE',  NEW.esta_fk_usuario_pk_id, NEW.esta_pk_id);
END IF;

IF (OLD.esta_sigla <> NEW.esta_sigla or (OLD.esta_sigla IS NULL and NEW.esta_sigla IS NOT NULL)) THEN
			INSERT INTO log_estado (lesta_o_que_modificou, lesta_valor_antigo, lesta_valor_atual, lesta_data_operacao, lesta_operacao, lesta_fk_usuario_pk_id, lesta_id_tabela) VALUES ('Status da Permissão', OLD.esta_sigla, NEW.esta_sigla, now(), 'UPDATE', NEW.esta_fk_usuario_pk_id, NEW.esta_pk_id);
END IF;

IF (OLD.esta_status <> NEW.esta_status or (OLD.esta_status IS NULL and NEW.esta_status IS NOT NULL)) THEN
			INSERT INTO log_estado (lesta_o_que_modificou, lesta_valor_antigo, lesta_valor_atual, lesta_data_operacao, lesta_operacao, lesta_fk_usuario_pk_id, lesta_id_tabela) VALUES ('Status do Estado', OLD.esta_status, NEW.esta_status, now(), 'UPDATE', NEW.esta_fk_usuario_pk_id, NEW.esta_pk_id);
END IF;
    
IF (OLD.esta_fk_usuario_pk_id <> NEW.esta_fk_usuario_pk_id or (OLD.esta_fk_usuario_pk_id IS NULL and NEW.esta_fk_usuario_pk_id IS NOT NULL)) THEN
			INSERT INTO log_estado (lesta_o_que_modificou, lesta_valor_antigo, lesta_valor_atual, lesta_data_operacao, lesta_operacao, lesta_fk_usuario_pk_id, lesta_id_tabela) VALUES ('Usuário Modificou', OLD.esta_fk_usuario_pk_id, NEW.esta_fk_usuario_pk_id, now(), 'UPDATE', NEW.esta_fk_usuario_pk_id, NEW.esta_pk_id);
END IF;

END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`esta_pk_id`),
  ADD UNIQUE KEY `esta_nome_UNIQUE` (`esta_nome`),
  ADD UNIQUE KEY `esta_sigla_UNIQUE` (`esta_sigla`),
  ADD KEY `esta_fk_usuario_pk_id` (`esta_fk_usuario_pk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `esta_pk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `esta_fk_usuario_pk_id` FOREIGN KEY (`esta_fk_usuario_pk_id`) REFERENCES `usuario` (`usua_pk_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
