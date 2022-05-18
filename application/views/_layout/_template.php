<!doctype html>
<html lang="en">

<head>
    <title>SIMGAJI</title>
    <!-- meta -->
    <?php echo @$_meta;?>

    <!-- css --> 
    <?php echo @$_css;?>
	
	<!-- icon -->
	<?php echo @$_icon;?>
</head>
<body onLoad="tampilwaktu();setInterval('tampilwaktu()', 1000);">
	<!-- WRAPPER -->
	<div id="wrapper">
		  <!-- navbar -->
		  <?php echo @$_nav; ?>
		
		  <!-- sidebar -->
		  <?php echo @$_sidebar; ?>
		
		  <!-- content -->
		  <?php echo @$_content; ?> 
		
		<div class="clearfix"></div>
		  <!-- footer -->
		  <?php echo @$_footer; ?>
	</div>
	<!-- END WRAPPER -->
		<!-- js -->
		<?php echo @$_js; ?>

		
	<!------Date Time--------->

		
</body>
<script>
		/**********FUNGSI DATE TIME*********/
function tampilwaktu(){         //fungsi ini akan dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik    
	var waktu = new Date();            //membuat object date berdasarkan waktu saat 
	var sh = waktu.getHours() + "";    //memunculkan nilai jam, //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length    //ambil nilai menit
	var sm = waktu.getMinutes() + "";  //memunculkan nilai detik    
	var ss = waktu.getSeconds() + "";  //memunculkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
	document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
	}
</script>
</html>
