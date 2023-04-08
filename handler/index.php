<?php

	include_once '../assets/php/conf.php';
	include_once '../controller/HelperController.php';
	include_once '../controller/ControllerGrupo.php';
	include_once '../DTO/ResponseDTO.php';

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