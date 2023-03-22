select * from parameter where para_key like '%email%';
UPDATE `system`.`parameter` SET `para_value` = 'email' WHERE (`para_key` = 'notificacao@tecsist.com');
UPDATE `system`.`parameter` SET `para_value` = 'servidor_email_smtp' WHERE (`para_key` = 'mail.tecsist.com');
UPDATE `system`.`parameter` SET `para_value` = 'senha' WHERE (`para_key` = '085663558a2f9a5baec71351ff26cd3d');