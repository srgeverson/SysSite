  INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
  VALUES
      ('enderecos', NULL, 'INSERT','id', NEW.id, now(), NEW.usuario_id),
      ('enderecos', NULL, 'INSERT','logradouro', NEW.logradouro, now(), NEW.usuario_id),
      ('enderecos', NULL, 'INSERT','numero', NEW.numero, now(), NEW.usuario_id),
      ('enderecos', NULL, 'INSERT','bairro', NEW.bairro, now(), NEW.usuario_id),
      ('enderecos', NULL, 'INSERT','cep', NEW.cep, now(), NEW.usuario_id),
      ('enderecos', NULL, 'INSERT','status', NEW.status, now(), NEW.usuario_id),
      ('enderecos', NULL, 'INSERT','cidade_id', NEW.cidade_id, now(), NEW.usuario_id),
      ('enderecos', NULL, 'INSERT','estado_id', NEW.estado_id, now(), NEW.usuario_id),
      ('enderecos', NULL, 'INSERT','usuario_id', NEW.usuario_id, now(), NEW.usuario_id);
 
    IF (OLD.logradouro <> NEW.logradouro or (OLD.logradouro IS NULL and NEW.logradouro IS NOT NULL)) THEN
		INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
        VALUES 
			('enderecos', 'logradouro', OLD.logradouro, NEW.logradouro, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	 END IF;
    
	IF (OLD.numero <> NEW.numero or (OLD.numero IS NULL and NEW.numero IS NOT NULL)) THEN
			INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('enderecos', 'numero', OLD.numero, NEW.numero, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;
    
	IF (OLD.bairro <> NEW.bairro or (OLD.bairro IS NULL and NEW.bairro IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('enderecos', 'bairro', OLD.bairro, NEW.bairro, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;

	IF (OLD.cep <> NEW.cep or (OLD.cep IS NULL and NEW.cep IS NOT NULL)) THEN
			INSERT INTO logs 
                        (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES
            ('enderecos', 'cep', OLD.cep, NEW.cep, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;
    
	IF (OLD.status <> NEW.status or (OLD.status IS NULL and NEW.status IS NOT NULL)) THEN
			INSERT INTO logs
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES
            ('enderecos', 'status', OLD.status, NEW.status, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;

	IF (OLD.cidade_id <> NEW.cidade_id or (OLD.cidade_id IS NULL and NEW.cidade_id IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('enderecos', 'cidade_id', OLD.cidade_id, NEW.cidade_id, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;

	IF (OLD.estado_id <> NEW.estado_id or (OLD.estado_id IS NULL and NEW.estado_id IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('enderecos', 'estado_id', OLD.estado_id, NEW.estado_id, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;

	IF (OLD.usuario_id <> NEW.usuario_id or (OLD.usuario_id IS NULL and NEW.usuario_id IS NOT NULL)) THEN
			INSERT INTO logs 
            (nome_tabela, campo_modificado, valor_antigo, valor_atual, data_operacao, operacao, id_tabela, usuario_id)
            VALUES 
            ('enderecos', 'usuario_id', OLD.usuario_id, NEW.usuario_id, now(), 'UPDATE', OLD.id, NEW.usuario_id);
	END IF;

      ('enderecos', NULL, 'INSERT','', NEW.estado_id, now(), NEW.usuario_id),
      ('enderecos', NULL, 'INSERT','', NEW.usuario_id, now(), NEW.usuario_id);

    	INSERT INTO logs 
		(nome_tabela, id_tabela, operacao, campo_modificado, valor_antigo, data_operacao, usuario_id)
    VALUES
		('enderecos', OLD.id, 'DELETE', 'id', OLD.id, now(), OLD.usuario_id),
        ('enderecos', OLD.id, 'DELETE','logradouro', OLD.logradouro, now(), OLD.usuario_id),
        ('enderecos', OLD.id, 'DELETE','numero', OLD.numero, now(), OLD.usuario_id),
        ('enderecos', OLD.id, 'DELETE','bairro', OLD.bairro, now(), OLD.usuario_id),
        ('enderecos', OLD.id, 'DELETE','cep', OLD.cep, now(), OLD.usuario_id),
        ('enderecos', OLD.id, 'DELETE','status', OLD.status, now(), OLD.usuario_id),
        ('enderecos', OLD.id, 'DELETE','cidade_id', OLD.cidade_id, now(), OLD.usuario_id),
        ('enderecos', OLD.id, 'DELETE','estado_id', OLD.estado_id, now(), OLD.usuario_id),
        ('enderecos', OLD.id, 'DELETE','usuario_id', OLD.usuario_id, now(), OLD.usuario_id);