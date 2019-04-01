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

	$name = '"'.$data->name .'"';
	$password = '"'. $data->password. '"';

	$ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, "https://api.expresso.pr.gov.br/celepar/Login");
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_WHATEVER);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE); // --data-binary
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Accept: application/json"));
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'id=1&params={"user":' . $name . ',"password":' . $password . '}' );

    $result = curl_exec($ch);
    echo $result;