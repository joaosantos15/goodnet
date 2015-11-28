<!DOCTYPE html>
<html>
<head>
	 <style> 
body {
    background: url("fundo.jpg");
    background-size: 130%;
    background-repeat: no-repeat;
}


div {
    width: 200px;
    height: 100px;
    text-align: center;
    position: absolute;
    top:100px;
    bottom: 0;
    left: 0;
    right: 0;

    margin: auto;
}
div2 {
    width: 200px;
    height: 100px;
    text-align: center;
    position: absolute;
    top:200px;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
}
</style>
</head>

<body>
<h1> emrmwerm </h1>

<!-- <h1>My First Heading</h1> -->



<?php
// Import server's phpCAS library.
//require_once 'CAS.php';
// Initialize phpCAS
//phpCAS::client(CAS_VERSION_3_0,'id.tecnico.ulisboa.pt',443,'/cas');
// Set CAS server certificate
//phpCAS::setCasServerCACert('/etc/ssl/certs/AddTrust_External_Root.pem');
// Set logout handler
//phpCAS::handleLogoutRequests(true, array('id.tecnico.ulisboa.pt'));
// Force CAS authentication
//phpCAS::forceAuthentication();
// If the code reaches this step, the user has already been authenticated by the CAS server
// and the user's IST ID can be read with phpCAS::getUser().
?>



<?php
//$user = phpCas::getUser();

function db_connect() {

    // Define connection as a static variable, to avoid connecting more than once 
    static $connection;

    // Try and connect to the database, if a connection has not been established yet
    if(!isset($connection)) {
         // Load configuration as an array. Use the actual location of your configuration file
        $config = parse_ini_file('../config.ini');
        echo $config['username'];
        echo $config['password'];
        echo $config['dbname'];
        $connection = mysqli_connect('db.ist.utl.pt',$config['username'],$config['password'],$config['dbname']);
    }

    // If connection was not successful, handle the error
    if($connection === false) {
        // Handle error - notify administrator, log to a file, show an error screen, etc.

        $msg="merda";
        return mysqli_connect_error(); 
    }
    echo("NOOOOO");
    return $connection;
}

function db_query($query) {
    // Connect to the database
    $connection = db_connect();

    // Query the database
    $result = mysqli_query($connection,$query);

    return $result;
}

function db_select($query) {
    $rows = array();
    $result = db_query($query);

    // If query failed, return `false`
    if($result === false) {
        return false;
    }

    // If query was successful, retrieve all the rows into an array
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


// $result[0][idPi]


//$user=phpCas::getUser();
$connection=db_connect();
//$result =  db_query("SELECT * FROM ist174008.USERS;");
$rows = db_select("SELECT * FROM ist174008.USERS;");
echo $result;    
      $rows = array();
      $table = array();
      $table['cols'] = array(

        // Labels for your chart, these represent the column titles.
        /* 
            note that one column is in "string" format and another one is in "number" format 
            as pie chart only required "numbers" for calculating percentage 
            and string will be used for Slice title
        */

        array('label' => 'idPI', 'type' => 'number'),
        array('label' => 'Nome', 'type' => 'string')
        array('label' => 'ISP', 'type' => 'string'),
        array('label' => 'Distrito', 'type' => 'string')
        array('label' => 'Localidade', 'type' => 'string'),
        array('label' => 'Rua', 'type' => 'string')
        array('label' => 'Predio', 'type' => 'number'),
        array('label' => 'Porta', 'type' => 'number')

    );
      echo $table;
        /* Extract the information from $result */
        foreach($result as $r) {

          $temp = array();

          // the following line will be used to slice the Pie chart

          $temp[] = array('v' => (string) $r['weekly_task']); 

          // Values of each slice

          $temp[] = array('v' => (int) $r['percentage']); 
          $rows[] = array('c' => $temp);
        }

    $table['rows'] = $rows;
    echo $table;

    // convert data into JSON format
    $jsonTable = json_encode($table);
    //echo $jsonTable;
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }


?>



<div2 >
        <div2 style="font-family: calibri;color: white;font-size: 2em;line-height: 140%;">BDo -  <?= $result ?></div2>
        
</div2>


</body>
</html>
