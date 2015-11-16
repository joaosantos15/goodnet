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

// Carregamento das variáveis username e pin do form HTML através do metodo POST;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
}

$file_name='result.txt';
echo 'Welcome ' .$username . '<br/>';
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

		if($info[$row]['operadora']=="NOS"){
			$cliNOS=$cliNOS+1; 	
    		$latNOS=$latNOS+$info[$row]['latencia'];
    		$bandNOS=$bandNOS+$info[$row]['bandwidth'];
    	}

    	if($info[$row]['operadora']=="MEO"){    	
    		$cliMEO=$cliMEO+1;
    		$latMEO=$latMEO+$info[$row]['latencia'];
    		$bandMEO=$bandMEO+$info[$row]['bandwidth'];
    	}
    	

    	if($info[$row]['operadora']=="VODAFONE"){    	
    		$cliOPT=$cliOPT+1;
    		$latOPT=$latOPT+$info[$row]['latencia'];
    		$bandOPT=$bandOPT+$info[$row]['bandwidth'];
    	}


		if($info[$row]['area']=="Lisboa"){
			$cliLisb=$cliLisb+1; 	
    		$latLisb=$latLisb+$info[$row]['latencia'];
    		$bandLisb=$bandLisb+$info[$row]['bandwidth'];
    	}

    	if($info[$row]['area']=="Porto"){    	
    		$cliPorto=$cliPorto+1;
    		$latPorto=$latPorto+$info[$row]['latencia'];
    		$bandPorto=$bandPorto+$info[$row]['bandwidth'];
    	}
    	

    	if($info[$row]['area']=="Faro"){    	
    		$cliFaro=$cliFaro+1;
    		$latFaro=$latFaro+$info[$row]['latencia'];
    		$bandFaro=$bandFaro+$info[$row]['bandwidth'];
    	}



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

    $_SESSION['nClients']=sizeOf($info);

    //latencia por operador
    $_SESSION['latMEO']=$latMEO/$cliMEO;
    $_SESSION['latOPT']=$latOPT/$cliOPT;
    $_SESSION['latNOS']=$latNOS/$cliNOS;

    //latencia por area
    $_SESSION['latLisb']=$latLisb/$cliLisb;
    $_SESSION['latPorto']=$latPorto/$cliPorto;
    $_SESSION['latFaro']=$latFaro/$cliFaro;

	//banda por operador
    $_SESSION['bandNOS']=$bandNOS/$cliNOS;
    $_SESSION['bandMEO']=$bandMEO/$cliMEO;
    $_SESSION['bandOPT']=$bandOPT/$cliOPT;

    //banda por area
    $_SESSION['bandLisb']=$bandLisb/$cliLisb;
    $_SESSION['bandPorto']=$bandPorto/$cliPorto;
    $_SESSION['bandFaro']=$bandFaro/$cliFaro;


    include 'lat.php';
    include 'latpp.php';
    include 'latArea.php';
    include 'band.php';
    include 'bandPP.php';
 	include 'bandArea.php';
 	include 'dispo.php';
?>




<div class="LAT">
<h2>Latency  </h2>
	<img class="pics" src="latency.png" alt="LatPerClient" style="width:304px;height:228px;">
	
	<img class="pics" src="latencyPP.png" alt="LatPerOp" style="width:304px;height:228px;">
	
	<img class="pics" src="latencyArea.png" alt="LatPerArea" style="width:304px;height:228px;">
</div>

<div class="LAT">
<h2>Bandwidth </h2>
	<img class="pics" src="band.png" alt="BandwidthPerClient" style="width:304px;height:228px;">
	
	<img  class="pics" src="bandPP.png" alt="BandwidthPerOpe" style="width:304px;height:228px;">

	<img  class="pics" src="bandArea.png" alt="BandwidthPerArea" style="width:304px;height:228px;">
</div>

<div class="LAT">
<h2>Availability </h2>
	<img class="pics" src="dispo.png" alt="Availability" style="width:504px;height:428px;">
	
</div>
</body>
</html>