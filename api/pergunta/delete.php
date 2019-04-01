<?php

	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

	include_once '../../config/Database.php';
	include_once '../../models/Pergunta.php';

	$database = new Database();
	$db = $database->connect();

	$data = json_decode(file_get_contents("php://input"));

	$pergunta = new Pergunta($db);

	$pergunta->quiz_id = $data->quiz_id;

	if($pergunta->delete()){
		echo json_encode(array('message' => 'Pergunta Deletada'));
	}else{
		echo json_encode(array('message' => 'Pergunta Nao Deletada'));
	}
