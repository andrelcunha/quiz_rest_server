<?php

	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/Resposta.php';

	$database = new Database();
	$db = $database->connect();

	$data = json_decode(file_get_contents("php://input"));

	$resposta = new Resposta($db);
	$resposta->pergunta_id = $data->pergunta_id;

	$result = $resposta->read();
	$num = $result->rowCount();

	if($num > 0){
		$respostas_arr = array();
		$respostas_arr['data'] = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);

			$resposta_item = array(
				'id' => $resposta_id,
				'pergunta_id' => $pergunta_id,
				'texto' => $resposta_texto,
				'certa' => $resposta_certa,
			);

			array_push($respostas_arr['data'], $resposta_item);
		}
		echo json_encode($respostas_arr);
	}else{
		echo json_encode(
			array('message' => 'Sem resposta')
		);
	}
