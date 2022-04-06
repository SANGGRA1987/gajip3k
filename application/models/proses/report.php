<?php
//include("DummyClass.php");
//$dc = new DummyClass();
// if($dc->auth->isAuth() <> 1) die('ERR_AUTH');
// $user = $dc->auth->getDetail();
/*if (!in_array($user['kodegroup'],Array(1,2)) && isset($user['kodeorganisasi']) && $user['kodeorganisasi']!='') {
	if ($user['kodeurusan']!=$_GET['kdur'] || $user['kodesuburusan']!=$_GET['kdsubur'] || $user['kodeorganisasi']!=$_GET['kdorg']) die('ERR_AUTH');
	
}*/

set_time_limit(0);
error_reporting(0);
if ($_GET['file'] || $_POST['file']) $file = str_ireplace('.fr3','',$_REQUEST['file']);
else $file = "default";

if (strtoupper($_GET['report_type']) == 'XLS') {
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename="'.$file.'.xls"');
	$cont = 1;
} 
else if (strtoupper($_GET['report_type']) == 'PDF') {
	header('Content-Type: application/pdf');
	header('Content-Disposition: filename="'.$file.'.pdf"');
	$cont = 1;
}
else {
	if ($_GET['file'] || $_POST['file']) {
		header('Content-Type: application/pdf');
		header('Content-Disposition: filename="'.$file.'.pdf"');
		$cont = 1;
	}
}

if ($cont == 1) {
	$tmp_file = '';
	$cont = 0;
	$post_data = '';
	
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
	    $cmddir = sys_get_temp_dir();
    else
	    $cmddir = '/var/www/cmd';
	
	$i = 1;
	do {
		$tmp_file = $cmddir.'/post' . md5(date(DATE_RFC822) . $i) . '.tmp';
		$i++;
	} while (file_exists($tmp_file));
	
	foreach ($_POST as $var => $val) {
		if ($post_data != '') $post_data .= '&';
		$post_data .= urlencode($var) . '=' . urlencode(stripslashes($val));
	}
	
	foreach ($_GET as $var => $val) {
		if ($post_data != '') $post_data .= '&';
		$post_data .= urlencode($var) . '=' . urlencode(stripslashes($val));
	}
	
	$handle = fopen($tmp_file,"w");
	fwrite($handle,$post_data);
	fclose($handle);
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
	   // system('C:\\ReportServerConsole.exe "'.$tmp_file.'"');	
	   system('C:\ReportServerConsole.exe "'.$tmp_file.'"'); 
		//system (C:\xampp\htdocs\PPR\papuapuanggaran\service);
	else 
	    system('export DISPLAY=:69; LANG=id_ID wine C:\\ReportServerConsole.exe "Z:\\'.str_replace('/','\\',$tmp_file).'"');
	
	sleep(10);
	unlink($tmp_file);
}
else
	echo "Missing parameters";

?>
