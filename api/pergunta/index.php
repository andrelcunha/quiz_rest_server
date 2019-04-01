<?php
	include_once '../../config/Database.php';
	include_once '../../models/Pergunta.php';

	$database = new Database();
	$db = $database->connect();

	$pergunta = new Pergunta($db);

	$result = $pergunta->read();
	print_r($result);
	$num = $result->rowCount();

	if($num > 0){
		$perguntas_arr = array();
		//$perguntas_arr['data'] = array();

		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);

			$pergunta_item = array(
				'id' => $pergunta_id,
				'quiz_id' => $quiz_id,
				'enunciado' => $pergunta_enunciado,
				'peso' => $pergunta_peso,
			);

			array_push($perguntas_arr, $pergunta_item);
		}
	}
?>

<html>
 <head>
 	<h1 style="text-align: center;">PERGUNTAS</h1>
 </head>
 <body>

 	<table style="width:100%">
 	 <tr>
		 <th>RANK</th>
	    <th>ENUNCIADO</th>
	    <th>PESO</th>
	  </tr>

	<?php
		$i = 1;
		foreach($perguntas_arr as $p){?>
		<tr>
			<th><?=$i?></th>
			<th><?=$p['enunciado']?></th>
			<th><?=$p['peso']?></th>
		</tr>
	<?php
	$i++;
	}?>

	</table>

 </body>
</html>
