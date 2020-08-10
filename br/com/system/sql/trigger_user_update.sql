BEGIN
	IF (OLD.user_name <> NEW.user_name or (OLD.user_name IS NULL and NEW.user_name IS NOT NULL)) THEN
		INSERT INTO log_user
            (luser_campo_modificado, luser_valor_antigo, luser_valor_atual, luser_data_operacao, luser_operacao, luser_id_tabela)
        VALUES 
			('user_name', OLD.user_name, NEW.user_name, now(), 'UPDATE', OLD.user_pk_id);
	 END IF;
    
	IF (OLD.user_login <> NEW.user_login or (OLD.user_login IS NULL and NEW.user_login IS NOT NULL)) THEN
			INSERT INTO log_user
            (luser_campo_modificado, luser_valor_antigo, luser_valor_atual, luser_data_operacao, luser_operacao, luser_id_tabela)
            VALUES 
            ('user_login', OLD.user_login, NEW.user_login, now(), 'UPDATE', OLD.user_pk_id);
	END IF;
    
	IF (OLD.user_password <> NEW.user_password or (OLD.user_password IS NULL and NEW.user_password IS NOT NULL)) THEN
			INSERT INTO log_user 
            (luser_campo_modificado, luser_valor_antigo, luser_valor_atual, luser_data_operacao, luser_operacao, luser_id_tabela)
            VALUES 
            ('user_password', OLD.user_password, NEW.user_password, now(), 'UPDATE', OLD.user_pk_id);
	END IF;
    
	IF (OLD.user_status <> NEW.user_status or (OLD.user_status IS NULL and NEW.user_status IS NOT NULL)) THEN
			INSERT INTO log_user
            (luser_campo_modificado, luser_valor_antigo, luser_valor_atual, luser_data_operacao, luser_operacao, luser_id_tabela)
            VALUES
            ('user_status', OLD.user_status, NEW.user_status, now(), 'UPDATE', OLD.user_pk_id);
	END IF;

	IF (OLD.user_image <> NEW.user_image or (OLD.user_image IS NULL and NEW.user_image IS NOT NULL)) THEN
			INSERT INTO log_user 
                        (luser_campo_modificado, luser_valor_antigo, luser_valor_atual, luser_data_operacao, luser_operacao, luser_id_tabela)
            VALUES
            ('user_image', OLD.user_image, NEW.user_image, now(), 'UPDATE', OLD.user_pk_id);
	END IF;

	IF (OLD.user_last_login <> NEW.user_last_login or (OLD.user_last_login IS NULL and NEW.user_last_login IS NOT NULL)) THEN
			INSERT INTO log_user 
            (luser_campo_modificado, luser_valor_antigo, luser_valor_atual, luser_data_operacao, luser_operacao, luser_id_tabela)
            VALUES 
            ('user_last_access', OLD.user_last_login, NEW.user_last_login, now(), 'UPDATE', OLD.user_pk_id);
	END IF;
    
	IF (OLD.user_fk_authority_pk_id <> NEW.user_fk_authority_pk_id or (OLD.user_fk_authority_pk_id IS NULL and NEW.user_fk_authority_pk_id IS NOT NULL)) THEN
			INSERT INTO log_user 
            (luser_campo_modificado, luser_valor_antigo, luser_valor_atual, luser_data_operacao, luser_operacao, luser_id_tabela)
            VALUES
            ('user_fk_authority_pk_id', OLD.user_fk_authority_pk_id, NEW.user_fk_authority_pk_id, now(), 'UPDATE', OLD.user_pk_id);
	END IF;
END