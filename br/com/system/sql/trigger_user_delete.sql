BEGIN
	INSERT INTO log_user 
		(luser_id_tabela, luser_operacao, luser_campo_modificado, luser_valor_antigo, luser_data_operacao)
    VALUES (
		(OLD.user_pk_id, 'DELETE', 'user_pk_id', OLD.user_pk_id, now()),
        (OLD.user_pk_id, 'DELETE','user_name', OLD.user_name, now()),
        (OLD.user_pk_id, 'DELETE','user_login', OLD.user_login, now()),
        (OLD.user_pk_id, 'DELETE','user_password', OLD.user_password, now()),
        (OLD.user_pk_id, 'DELETE','user_last_login', OLD.user_last_login, now()),
        (OLD.user_pk_id, 'DELETE','user_image', OLD.user_image, now()),
        (OLD.user_pk_id, 'DELETE','user_status', OLD.user_status, now()),
        (OLD.user_pk_id, 'DELETE','user_fk_authority_pk_id', OLD.user_fk_authority_pk_id, now())
        );
END