<?php 
	header('Access-Control-Allow-Origin: *'); 
    header("Access-Control-Allow-Credentials: true");
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Max-Age: 10');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
	header('Content-Type: application/json');
	
	$server = "192.168.3.25";
	$username = "tamu";
	$paswd  = "tamu";
	$database = "simakda_sleman_2017";

$koneksi = mysql_connect($server,$username,$paswd) or die("Tidak Bisa Konek : " . mysql_error());
mysql_select_db($database);

ini_set("memory_limit","-1");
ini_set("max_execution_time","-1");
		
$skpd = $_REQUEST['skpd'];

//http://192.168.3.25/simbakda_akrual/smbkd_api.php?skpd="1.01.05.01.00"

		$izql = "CALL sp_sp2d('$skpd')";
		$result = mysql_query($izql) or die("Query Bermasalah" . mysql_error());
		$records = array();
		while($row = mysql_fetch_assoc($result)){
			$records[] = $row;
		}
		mysql_close($koneksi);
		$data = json_encode($records);
		echo $data;
	

?>