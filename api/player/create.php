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

	//echo json_encode($player->check_if_exists($player->name));
	if($player->check_if_exists($player->name)){
		echo json_encode(array('message' => 'Player Already Exists'));

	}else{
		if($player->create()){
			echo json_encode(array('message' => 'Player Created'));
		}else{
			echo json_encode(array('message' => 'Player Not Created'));
		}
	}
