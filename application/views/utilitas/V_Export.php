<div class="tab-content" id="myTabContent">
	<div style="padding-bottom: 20px;">
		<button type="button" class="btn btn-primary btn-lg btn-block" style="width: 100%" id="proses" ><b> PROSES </b></button>
	</div>
</div>
<script type="text/javascript">  

  var urll     = "<?php echo site_url(); ?>utilitas/C_Export/proses";
  
  $(document).ready(function() {
  	
    $('#proses').click(function(){
		$.messager.confirm('Konfirmasi','Yakin ingin mengexport data gaji  ???',function(r){
			if (r){
			   window.open(urll);
			   window.focus();
		   }else{
		   
		   }
	   })
    });	
  });
</script>