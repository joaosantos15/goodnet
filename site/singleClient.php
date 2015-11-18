<html>
<meta charset="UTF-8">
<head>
<LINK REL=StyleSheet HREF="style.css">
<h1> Internet Quality of Service in Portugal</h1>
</head>
<body>

<?php

// inicia sessão para passar variaveis entre ficheiros php
session_start();

// Função para limpar os dados de entrada
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


$file_name='single.txt';
$txt_file    = file_get_contents($file_name);
$rows        = explode("\n", $txt_file);

$id=0;
echo("<table border=\"1\">\n");
	echo("<tr><td>ID</td><td>Client</td><td>Gateway</td><td>IP</td><td>External</td><td>Uptime</td><td>Downtime</td><td>Latency
	(ms)</td><td>Bandwidth</td><td>Operator</td><td>Location</td></tr>\n");
	foreach($rows as $row => $data){
		//divide a informacao por ;
 		$row_data = explode(';', $data);
 		$id=$id+1;
 		$info[$row]['id'] = $id;
 		$info[$row]['name'] = $row_data[0];
    	$info[$row]['gateway'] = $row_data[1];
    	$info[$row]['ip'] = $row_data[2];
   		$info[$row]['external'] = $row_data[3];
    	$info[$row]['uptime']  = $row_data[4];
    	$info[$row]['downtime'] = $row_data[5];
    	$info[$row]['latencia'] = $row_data[6];
    	$info[$row]['bandwidth'] = $row_data[7];
    	$info[$row]['operadora'] = $row_data[8];
    	$info[$row]['area'] = $row_data[9];

		echo("<tr><td>");
		echo($info[$row]['id']); echo("</td><td>");
		echo($info[$row]['name']); echo("</td><td>");
		echo($info[$row]['gateway']); echo("</td><td>");
		echo($info[$row]['ip']); echo("</td><td>");
		echo($info[$row]['external']); echo("</td><td>");
		echo($info[$row]['uptime']); echo("</td><td>");
		echo($info[$row]['downtime']); echo("</td><td>");
		echo($info[$row]['latencia']); echo("</td><td>");
		echo($info[$row]['bandwidth']); echo("</td><td>");
		echo($info[$row]['operadora']); echo("</td><td>");
		echo($info[$row]['area']); echo("</td><td>");
	}
	echo("</table>\n");

	// passa para a session um array com os valores da largura de banda
	for ($i = 0; $i < sizeOf($info); $i++) {
		$bandArr[$i]=$info[$i]['bandwidth'];
	}
    $_SESSION['bandwidth'] = $bandArr;	

	// passa para a session um array com os valores da latencia
	for ($i = 0; $i < sizeOf($info); $i++) {
		$latArr[$i]=$info[$i]['latencia'];
	}
    $_SESSION['latency'] = $latArr;

    // passa para a session um array com os valores do downtime
	for ($i = 0; $i < sizeOf($info); $i++) {
		$downArr[$i]=$info[$i]['downtime'];
	}
    $_SESSION['downTime'] = $downArr;

    // passa para a session um array com os valores do uptime
	for ($i = 0; $i < sizeOf($info); $i++) {
		$upArr[$i]=$info[$i]['uptime'];
	}
	 $_SESSION['upTime'] = $upArr;

	// passa para a session um array com os valores do operador
	for ($i = 0; $i < sizeOf($info); $i++) {
		$opArr[$i]=$info[$i]['operadora'];
	}
    $_SESSION['operator'] = $opArr;

    //passa para a sessao os valores da localizacao
    for ($i = 0; $i < sizeOf($info); $i++) {
		$areaArr[$i]=$info[$i]['area'];
	}
    $_SESSION['area'] = $areaArr;

    $_SESSION['nTimes']=sizeOf($info);


    include 'individualLat.php';
    include 'individualBand.php';
    include 'individualDispo.php';
    include 'pieDowntime.php';
    
?>


<div class="LAT">
<h2>Latency  </h2>
	<img class="pics" src="sLat.png" alt="Latency" style="width:500px;height:300px;">
	
</div>

<div class="LAT">
<h2>Bandwidth </h2>
	<img class="pics" src="sBand.png" alt="BandwidthPerClient" style="width:500px;height:300px;">
	
</div>

<div class="LAT">
<h2>Availability over time </h2>
	<img class="pics" src="sDispo.png" alt="Availability" style="width:500px;height:300px;">
	
</div>

<div class="LAT">
<h2>Percentage Availability </h2>
    <img class="pics" src="sDowntime.png" alt="Availability" style="width:500px;height:300px;">
    
</div>
</body>
</html>
