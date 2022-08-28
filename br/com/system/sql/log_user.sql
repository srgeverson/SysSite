CREATE TABLE `log_user` (
  `luser_id_tabela` int(11) DEFAULT NULL,
  `luser_fk_usuario_pk_id` int(11) DEFAULT NULL,
  `luser_operacao` varchar(6) DEFAULT NULL,
  `luser_campo_modificado` varchar(45) DEFAULT NULL,  
  `luser_valor_antigo` text,
  `luser_valor_atual` text,
  `luser_data_operacao` datetime DEFAULT NULL
);
