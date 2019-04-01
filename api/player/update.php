<?php

	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

	include_once '../../config/Database.php';
	include_once '../../models/Player.php';

	$database = new Database();
	$db = $database->connect();

	$data = json_decode(file_get_contents("php://input"));

	$player = new Player($db);

	$player->name = $data->name;
	if(isset($data->score)){
		$player->score = $data->score;
	}


	if($player->update($player->name, $player->score)){
		echo json_encode(array('message' => 'Player Updated'));
	}else{
		echo json_encode(array('message' => 'Player Not Updated'));
	}
