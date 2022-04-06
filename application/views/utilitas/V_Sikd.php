<div class="tab-content" id="myTabContent">
	<div class="col-sm-12" style="padding-bottom: 10px;">
		<div class="col-sm-2"><label>Bulan</label></div>
		<div class="col-sm-3"><input id="bulan" name="bulan" class="form-control" style="width: 50%"></div>
		<div class="col-sm-3">
			<button type="button" class="btn btn-success" style="width: 150px" id="proses2" ><b> PROSES </b></button>
		</div>
	</div>
</div>
<script type="text/javascript">  
  var urll2    = "<?php echo site_url(); ?>utilitas/C_Sikd/proses2";
  var _bulan = $('#bulan');
  
  $(document).ready(function() {
  
  $('#bulan').combogrid({
            panelWidth:250,  
            idField:'n_bulan',  
            textField:'nama_bulan',  
            mode:'remote',
            url:'<?php echo base_url(); ?>utilitas/C_Sikd/getBulan',  
            columns:[[  
               {field:'n_bulan',title:'KODE',width:60},  
               {field:'nama_bulan',title:'NAMA BULAN',width:150}    
            ]]
        });
	
	$('#proses2').click(function(){
		var xbulan  	= $('#bulan').val();
		$.messager.confirm('Konfirmasi','Yakin ingin melakukan proses data UPLOAD SIPD???',function(r){
			if (r){
			lc = '?bulan='+_bulan.combogrid('getValue');
			   window.open(urll2+lc, '_blank');
			   window.focus();
		   }else{
		   
		   }
	   })
    });
	
	
  });
</script>