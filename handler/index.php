<?php

	include_once '../assets/php/conf.php';
	include_once '../controller/HelperController.php';
	include_once '../controller/ControllerGrupo.php';
	include_once '../dao/DAOLog.php';
	include_once '../DTO/ResponseDTO.php';
	include_once '../model/ModelLog.php';

	$endpoint = strip_tags($_GET['endpoint']);
	
	$responseDTO = new ResponseDTO();
	
	if (!empty($endpoint)){
		try {	
			switch ($endpoint)
			{
				case 'listar-permissoes-grupo':
					{
						$controllerGrupo = new ControllerGrupo();
						http_response_code(200);
						$responseDTO->permissoes = $controllerGrupo->listarPermissoesGrupo(strip_tags($_GET['id']));
						echo $responseDTO->getJSONEncode();
						break;
					}
					case 'listar-usuarios-grupo':
						{
							$controllerGrupo = new ControllerGrupo();
							http_response_code(200);
							$responseDTO->permissoes = $controllerGrupo->listarUsuariosGrupo(strip_tags($_GET['id']));
							echo $responseDTO->getJSONEncode();
							break;
						}
					case 'listar-logs':
						{
							$log = new ModelLog();
							$log->nome_tabela = strip_tags($_GET['nome_tabela']);
							$log->id_tabela = strip_tags($_GET['id_tabela']);
							$log->usuario_id = strip_tags($_GET['usuario_id']);
							$log->operacao = strip_tags($_GET['operacao']);
							$log->campo_modificado = strip_tags($_GET['campo_modificado']);
							$log->valor_antigo = strip_tags($_GET['valor_antigo']);
							$log->valor_atual = strip_tags($_GET['valor_atual']);
							$log->data_operacao = strip_tags($_GET['data_operacao']);
							if($log->nome_tabela || $log->id_tabela || $log->usuario_id || $log->operacao ||
								$log->campo_modificado || $log->valor_antigo || $log->valor_atual || $log->data_operacao ){									
									$daoLog = new DAOLog();
									http_response_code(200);
									$responseDTO->permissoes = $daoLog->selectObjectsByContainsObject($log);
								}else{
									http_response_code(400);
									$responseDTO->messege = "Informe pelo menos um campo!";
									$responseDTO->log = $log;
								}
							echo $responseDTO->getJSONEncode();
							break;
						}
					//Teste
					case 'dashboard':
						{
							while (true) {
								$controllerGrupo = new ControllerGrupo();
								date_default_timezone_set("America/Fortaleza");
								header("Cache-Control: no-store");
								header("Content-Type: text/event-stream");
								http_response_code(200);
								$responseDTO->permissoes = $controllerGrupo->listarUsuariosGrupo(strip_tags($_GET['id']));
								echo $responseDTO->getJSONEncode();
								
								if (ob_get_length()) 
									ob_end_clean();
								
								flush();
								
								if(connection_aborted())
									break;
							}
							break;
						}
				default:
					{
						http_response_code(404);
						$responseDTO->messege = "Recurso solicitado não existe!";
						echo $responseDTO->getJSONEncode();
						break;
					}
			}
		} catch (Exception $erro) {
			http_response_code(500);
			$responseDTO->messege = "Erro interno, tente novamente se o problema persistir contate o administrador do sistema!";
			$responseDTO->datails = $erro->getMessage(); 
			echo $responseDTO->getJSONEncode();
		}
	} else {
		http_response_code(200);
		$responseDTO->messege = "Bem vindo ao handler do SysSite!";
		echo $responseDTO->getJSONEncode();
	}
		// } else {
		// 	http_response_code(401);
		// 	$responseDTO->messege = "Acesso não autorizado";
		// 	echo $responseDTO->getJSONEncode();
		// }
?>