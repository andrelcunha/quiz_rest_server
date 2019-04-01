<?php

	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../../config/Database.php';
	include_once '../../models/Pergunta.php';
	include_once '../../models/Resposta.php';

	$database = new Database();
	$db = $database->connect();

	$data = json_decode(file_get_contents("php://input"));
	$pergunta_id = $data->pergunta_id;

	function get_resposta($db, $id_pergunta){
		$resposta = new Resposta($db);
		$resposta->pergunta_id = $id_pergunta;
		$result = $resposta->read();
		$num = $result->rowCount();

		if($num > 0){
			$respostas_arr = array();
			//$respostas_arr['data'] = array();

			while($row = $result->fetch(PDO::FETCH_ASSOC)){
				extract($row);

				$resposta_item = array(
					'id' => $resposta_id,
					'pergunta_id' => $pergunta_id,
					'texto' => $resposta_texto,
					'opcaoCorreta' => $resposta_certa == 1,
				);

				array_push($respostas_arr, $resposta_item);
			}
			return $respostas_arr;
		}
	}

	$pergunta = new Pergunta($db);

	$result = $pergunta->read();
	$num = $result->rowCount();

	if($num > 0){
		$perguntas_arr = array();
		$perguntas_arr['data'] = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);

			$pergunta_item = array(
				'id' => $pergunta_id,
				'quiz_id' => $quiz_id,
				'enunciado' => $pergunta_enunciado,
				'dificuldade' => $pergunta_peso,
				'opcoesRespostas' => get_resposta($db, $pergunta_id)
			);
			array_push($perguntas_arr['data'], $pergunta_item);
		}
		echo json_encode($perguntas_arr);
	}else{
		echo json_encode(
			array('message' => 'Sem Perguntas')
		);
	}
