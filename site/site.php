<html>
<meta charset="UTF-8">
<body>

<h2> Total data collected</h2>
<?php


include('lat.php');


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
array_shift($rows);

$id=0;
$latNOS;$latOPT=0;$latMEO=0;$cliMEO=0;$cliNOS=0;$cliOPT=0;
echo("<table border=\"1\">\n");
	echo("<tr><td>ID</td><td>Client</td><td>Gateway</td><td>IP</td><td>External</td><td>Uptime</td><td>Downtime</td><td>Latency
	(ms)</td><td>Bandwidth</td><td>Operator</td></tr>\n");
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

		if($info[$row]['operadora']=="NOS"){
			$cliNOS=$cliNOS+1; 	
    		$latNOS=$latNOS+$info[$row]['latencia'];
    	}

    	if($info[$row]['operadora']=="MEO"){    	
    		$cliMEO=$cliMEO+1;
    		$latMEO=$latMEO+$info[$row]['latencia'];
    	}
    	

    	if($info[$row]['operadora']=="OPTIMUS"){    	
    		$cliOPT=$cliOPT+1;
    		$latOPT=$latOPT+$info[$row]['latencia'];
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
	}
	echo("</table>\n");

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

	// passa para a session um array com os valores do operador
	for ($i = 0; $i < sizeOf($info); $i++) {
		$opArr[$i]=$info[$i]['operadora'];
	}
    $_SESSION['operator'] = $opArr;

    $_SESSION['nClients']=sizeOf($info);
    $_SESSION['latMEO']=$latMEO/$cliMEO;
    $_SESSION['latOPT']=$latOPT/$cliOPT;
    $_SESSION['latNOS']=$latNOS/$cliNOS;

    include 'latpp.php';


?>



<h2>Latency per Client </h2>

<img src="latency.png" alt="MEO" style="width:304px;height:228px;">

<h2>Latency per Operator </h2>
<img src="latencyPP.png" alt="MEO" style="width:304px;height:228px;">

<h2>Availability per Client </h2>

<h3> MEO Clients </h3>
<img src="disponibilidade.png" alt="MEO" style="width:304px;height:228px;">

<h3> NOS Clients </h3>
<img src="disponibilidade.png" alt="NOS" style="width:304px;height:228px;">

<h3> OPTIMUS Clients </h3>
<img src="disponibilidade.png" alt="OPTIMUS" style="width:304px;height:228px;">

</body>
</html>