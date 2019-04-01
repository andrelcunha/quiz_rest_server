<?php
	include_once '../../config/Database.php';
	include_once '../../models/Resposta.php';

	$database = new Database();
	$db = $database->connect();

	$resposta = new Resposta($db);

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
				'certa' => $resposta_certa,
			);

			array_push($respostas_arr, $resposta_item);
		}
	}
?>

<html>
 <head>
 	<h1 style="text-align: center;">RESPOSTAS</h1>
 </head>
 <body>

 	<table style="width:100%">
 	 <tr>
	    <th>RANK</th>
	    <th>TEXTO</th>
	    <th>CERTA</th>
	  </tr>

	<?php
		$i = 1;
		foreach($respostas_arr as $p){?>
		<tr>
			<th><?=$i?></th>
			<th><?=$p['texto']?></th>
			<th><?=$p['certa']?></th>
		</tr>
	<?php
	$i++;
	}?>

	</table>

 </body>
</html>
