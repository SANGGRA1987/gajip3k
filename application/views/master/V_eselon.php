<div class="row">
    <div class="col-md-12">  
	<div class="box-header">
		<div style="padding-left: 0px !important;" class="col-md-2">
			<button id="tambah"  type="button" class="btn btn-default" onClick="javascript:newESELON();"><span><i class="fa fa-plus"></i></span> Tambah</button>  
			<div class="help-block with-errors" id="error_custom1"></div>
		</div>		
		<div style="padding-left: 0px !important;" class="col-md-2">
			<button id="ubah" type="button" class="btn btn-default" onClick="javascript:editESELON();"><span><i class="fa fa-pencil"></i></span> Ubah</button>  
			<div class="help-block with-errors" id="error_custom1"></div>
		</div>	
		<div style="padding-left: 0px !important;" class="col-md-2">
			<button id="hapus" type="button" class="btn btn-default" onClick="javascript:destroyESELON();"><span><i class="fa fa-trash"></i></span> Hapus</button>  
			<div class="help-block with-errors" id="error_custom1"></div>
		</div>
         <div class="col-md-8" align="right">
			<form class="navbar-right">
					<div class="input-group">
						<input type="text" value="" id="keyword" name="keyword" class="form-control" placeholder="">
						<span class="input-group-btn"><button type="button" class="btn btn-default" onClick="javascript:cari();"><i class="fa fa-search"></i></button></span>
					</div>
				</form>
		</div>
		
	</div>
	<div class="row">
				<div class="col-sm-12" >
  			 	 <table id="dg"></table>
				</div>
	</div>
    <div id="dlg" class="easyui-dialog" style="width:600px;display:none"  closed="true" buttons="#dlg-buttons">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
		<table align="center" width="100%" border="0" >
				<tr>
					<td width="20%"><label>Eselon</label></td>
					<td width="2%">:</td> 
					<td width="79%"><input id="eselon" type="text" name="eselon" class="easyui-textbox" style="width:12%;"></td>
				</tr>
				<tr>
					<td ><label>Nama Eselon</label></td>
					<td >:</td> 
					<td ><input id="nm_eselon" name="nm_eselon" class="easyui-textbox" style="width:100%"></td>
				</tr>
				<tr>
					<td ><label>Jumlah</label></td>
					<td >:</td> 
					<td ><input id="jumlah" name="jumlah" class="form-control" onkeypress="return(currencyFormat(this,',','.',event));"  style="width:40%;text-align: right"></td>
				</tr>
				<tr>
					<td ><label>Golongan</label></td>
					<td >:</td> 
					<td ><input id="golongan" name="golongan" class="easyui-textbox" style="width:12%"></td>
				</tr>
		</table>

        </form>
    </div>
	
    <div id="dlg-buttons" style="display:none">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveESELON()" style="width:90px">Simpan</a>
        <a  href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="exit()" style="width:90px">close</a>
    </div>
	
	<script type="text/javascript" src="<?php echo site_url('assets/easyui/numberFormat.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo site_url('assets/easyui/autoCurrency.js') ?>"></script>	
    <script type="text/javascript">
		$(document).ready(function(){
			//$("#golongan").textbox('textbox').attr('maxlength',4).textbox({disabled: true});
			//$("#eselon").textbox('textbox').attr('maxlength',4);
			//$("#nm_eselon").focus();
			$("#ubah").attr("disabled", "disabled");
			$("#hapus").attr("disabled", "disabled");
			var status = '';
			var ck = $("[type='checkbox']:checked").length;
			
				$('#dg').datagrid({
					title:'List Data <?php echo $page;?>',
					width:1525,
					height:350,
					rownumbers:true,
					remoteSort:false,
					nowrap:false,
					fitColumns:true,
					pagination:true,
					url:'<?php echo base_url(); ?>master/C_eselon/load_eselon',
					columns:[[
						{field:'eselon',title:'Eselon',width:100,align:'center',sortable:true},
						{field:'nm_eselon',title:'Nama eselon',width:200,align:'left'},
						{field:'jumlah',title:'Jumlah',width:100,align:'center'},
						{field:'golongan',title:'Golongan',width:100,align:'center'},
						{field:'ck',title:'',width:60,align:'center',checkbox:true}
					]],
					onSelect:function(rowIndex,rowData){
						lcidx 			= rowIndex;
						eselon		= rowData.eselon;
						nm_eselon		= rowData.nm_eselon;
						jumlah		= rowData.jumlah;
						golongan		= rowData.golongan;
						$("#jumlah").val(number_format(rowData.jumlah, 2,'.',','));
					},
					onCheck: function(index, row) {
						cekjumlah();
					},
					onUncheck: function(index,row) {
						cekjumlah();
					},
					onCheckAll: function(row) {
						cekjumlah();
					},
					onUncheckAll: function(row) {
						cekjumlah();
					}
				}); 
			
			
		});	
	
	$('#golongan').combogrid({
			panelWidth:500,  
	       	idField:'golongan',  
	       	textField:'golongan',  
	       	mode:'remote',
	       	url: '<?php echo base_url(); ?>master/C_golongan/load_golongan',
	       	columns:[[  
	           {field:'golongan',title:'golongan',width:100},  
	           {field:'nm_golongan',title:'nama golongan',width:400}    
	       	]],  
	       	onSelect:function(rowIndex,rowData){
			   lcstatus = 'tambah';
			   nmgolongan	= rowData.nm_golongan;         
			//  $('#nm_golongan').textbox('setValue',nmgolongan);
	       	}  
		}); 
		
		
				var url;
				function newESELON(){
					$('#dlg').dialog('open').dialog('center').dialog('setTitle','Input Data <?php echo $page;?>');
					$('#fm').form('clear');
					status = 'add';
					//max_number();
				}		
				function editESELON(){
					var row = $('#dg').datagrid('getSelected');
					status = 'edit';
					if (row){
						$('#dlg').dialog('open').dialog('setTitle','Edit Eselon');
						$('#fm').form('load',row);
					}
				}
				
				function cari(){
					var key = $('#keyword').val();
					    $(function(){
						 $('#dg').datagrid({
							url: '<?php echo base_url();?>master/C_eselon/load_eselon',
							queryParams:({key:key})
							});        
						 });
				}

				
				// function cekjumlah(){

				// 	var v = $('#dg').datagrid('getRows');
				// 	var ck = $("[type='checkbox']:checked").length;

				// 	if (v.length != 1) {
				// 		if ( ck == 0 ) {

				// 			$("#ubah").attr("disabled", "disabled");
				// 			$('#hapus').attr("disabled", "disabled");

				// 		} else if ( ck > 1 ) {

				// 			$("#ubah").attr("disabled", "disabled");
				// 			$("#hapus").removeAttr("disabled");

				// 		} else if ( ck == 1 ) {

				// 			$("#hapus").removeAttr("disabled");						
				// 			$("#ubah").removeAttr("disabled");						
				// 		}
				// 	} else {

				// 		if ( ck == 2 ) {
				// 			$("#hapus").removeAttr("disabled");						
				// 			$("#ubah").removeAttr("disabled");		
				// 		} else {
				// 			$("#ubah").attr("disabled", "disabled");
				// 			$('#hapus').attr("disabled", "disabled");
				// 		}

				// 	}
				// }
				
			/*	function max_number(){ 
					$.ajax({
						type: "POST",
						url: '<?php echo base_url(); ?>master/C_masakerja/max_number',
						data: ({table:'golongan',kolom:'golongan'}),
						dataType:"json",
						success:function(data){                                          
							$.each(data,function(i,n){                                    
								max = Number(n['no_urut'])+1; 
								nom = String('' + max).slice(-3);
								$('#golongan').textbox('setValue', nom);
								$('#tahun').textbox('setValue', '');
							});
						}
					}); 
				 }*/
				 	function exit(){
										$('#dg').datagrid('reload'); 
										$('#dlg').dialog('close');
					}
				function saveESELON(){
					var eselon = $('#eselon').val();
					var nm_eselon = $('#nm_eselon').val();
					var jumlah = $('#jumlah').val();
					var golongan = $('#golongan').val();
					if( eselon ==''){
						iziToast.warning({
						title: 'Caution',
						message: 'Eselon Tidak boleh Kosong',
						});
						return
					}
					if( nm_eselon ==''){
						iziToast.warning({
						title: 'Caution',
						message: 'Nama Eselon Tidak boleh Kosong',
						});
						return
					}
					if( jumlah ==''){
						iziToast.warning({
						title: 'Caution',
						message: 'Jumlah Tidak boleh Kosong',
						});
						return
					}
					if( golongan ==''){
						iziToast.warning({
						title: 'Caution',
						message: 'Golongan Tidak boleh Kosong',
						});
						return
					}
					
					if(status=='add'){
					  $(document).ready(function(){
						  if(eselon=='' && nm_eselon=='' && jumlah=='' && golongan=='' ){
								iziToast.warning({
									title: 'Caution',
									message: 'Mohon Lengkapi inputan anda.!',
								});
						  }else{
								$.post('<?php echo base_url(); ?>master/C_eselon/simpan',
									{eselon:eselon,nm_eselon:nm_eselon,jumlah:jumlah,golongan:golongan},function(result){
									if (result.pesan){
										iziToast.success({
											title: 'OK',
											message: 'Data Berhasil Disimpan.!!',
										});
										$('#dg').datagrid('reload'); 
										max_number();
									} else {
										iziToast.error({
											title: 'Error',
											message: 'Data Gagal Disimpan.!',
										});
									}
								},'json');
						  }
						});
					}else{
						$.post('<?php echo base_url(); ?>master/C_eselon/ubah',
									{eselon:eselon,nm_eselon:nm_eselon,jumlah:jumlah,golongan:golongan},function(result){
									if (result.pesan){
										iziToast.info({
											title: 'OK',
											message: 'Data Berhasil Dirubah.!!',
										});
										$('#dg').datagrid('reload'); 
									} else {
										iziToast.error({
											title: 'Error',
											message: 'Data Gagal Dirubah.!',
										});
									}
								},'json');
					}
				}
				
				function destroyESELON(){
					var row = $('#dg').datagrid('getSelections');
					var ids = [];
					var ids2 = [];
					for(var i=0; i<row.length; i++){ids.push(row[i].eselon);ids2.push(row[i].golongan);}
					var eselon = ids.join('#');
					var golongan = ids2.join('#');
					if (row){
						$.messager.confirm('Konfirmasi','Yakin ingin menghapus data ini?',function(r){
							if (r){
								$.post('<?php echo base_url(); ?>master/C_eselon/hapus',
									{eselon:eselon,golongan:golongan},function(result){
									if (result.pesan){
										iziToast.info({
											title: 'OK',
											message: 'Data Berhasil Dihapus.!!',
										});
										$('#dg').datagrid('reload'); 
									} else {
										iziToast.error({
											title: 'Error',
											message: 'Data Gagal Dihapus.!',
										});
									}
								},'json');
							}
						});
					}
				}
				
				
			</script>
	</div>
</div>	