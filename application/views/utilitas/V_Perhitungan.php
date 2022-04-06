<div class="tab-content" id="myTabContent">
	<div style="padding-bottom: 20px;">
		<button type="button" class="btn btn-primary btn-lg btn-block" style="width: 100%" id="proses" ><b> PROSES </b></button>
	</div>
</div>
<!--<tr height="70%" >
<td align="center" style="visibility:hidden" >	<DIV id="load" > <IMG SRC="<?php echo base_url(); ?>assets/img/mapping.gif" WIDTH="100%" HEIGHT="40" BORDER="0" ALT=""></DIV></td>
</tr> -->
<script type="text/javascript">  

  var urll     = "<?php echo site_url(); ?>utilitas/C_Perhitungan/proses_hitung";
  
  $(document).ready(function() {
  	
    $('#proses').click(function(){
		$.messager.confirm('Konfirmasi','Yakin ingin menghitung ulang gaji semua pegawai ???',function(r){
			if (r){
			   window.open(urll);
			   window.focus();
		   }else{
		   
		   }
	   })
    });	
  });
</script>