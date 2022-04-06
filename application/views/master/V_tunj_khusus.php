<div class="row">
    <div class="col-md-12">  
	<div class="box-header">
		<div style="padding-left: 0px !important;" class="col-md-2">
			<button id="tambah"  type="button" class="btn btn-default" onClick="javascript:newKHUSUS();"><span><i class="fa fa-plus"></i></span> Tambah</button>  
			<div class="help-block with-errors" id="error_custom1"></div>
		</div>		
		<div style="padding-left: 0px !important;" class="col-md-2">
			<button id="ubah" type="button" class="btn btn-default" onClick="javascript:editKHUSUS();"><span><i class="fa fa-pencil"></i></span> Ubah</button>  
			<div class="help-block with-errors" id="error_custom1"></div>
		</div>	
		<div style="padding-left: 0px !important;" class="col-md-2">
			<button id="hapus" type="button" class="btn btn-default" onClick="javascript:destroyKHUSUS();"><span><i class="fa fa-trash"></i></span> Hapus</button>  
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
    <div id="dlg" class="easyui-dialog"  style="width:600px;display:none" closed="true" buttons="#dlg-buttons">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
		<table align="center" width="100%" border="0" >
				<tr>
					<td width="30%"><label>Kode</label></td>
					<td width="2%">:</td> 
					<td width="67%"><input id="kd_khusus" type="text" name="kd_khusus" class="easyui-textbox" style="width:30%;"></td>
				</tr>
				<tr>
					<td width="30%"><label>Uraian</label></td>
					<td width="2%">:</td> 
					<td width="67%"><input id="uraian" name="uraian" class="easyui-textbox" style="width:80%"></td>
				</tr>
				<tr>
					<td width="30%"><label>Jumlah</label></td>
					<td width="2%">:</td> 
					<td width="67%"><input id="tnkhusus" name="tnkhusus" class="form-control" onkeypress="return(currencyFormat(this,',','.',event));" style="width:40%;text-align: right;"></td>

				</tr>
				
		</table>


        </form>
    </div>
	
    <div id="dlg-buttons" style="display:none">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveKHUSUS()" style="width:90px">Simpan</a>
        <a  href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="exit()" style="width:90px">close</a>
    </div>

<script type="text/javascript" src="<?php echo site_url('assets/easyui/numberFormat.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/easyui/autoCurrency.js') ?>"></script>
    <script type="text/javascript">
		$(document).ready(function(){
			$("#kd_khusus").textbox('textbox').attr('maxlength',6);
			$("#uraian").focus();
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
					url:'<?php echo base_url(); ?>master/C_tunj_khusus/load_tunj_khusus',
					columns:[[
						{field:'kd_khusus',title:'Kode',width:200,align:'center',sortable:true},
						{field:'uraian',title:'Uraian',width:400,align:'left'},
						{field:'tnkhusus',title:'Jumlah',width:200,align:'center'},
						{field:'ck',title:'',width:60,align:'center',checkbox:true}
					]],
					onSelect:function(rowIndex,rowData){
						lcidx 			= rowIndex;
						kd_khusus		= rowData.kd_khusus;
						uraian		= rowData.uraian;
						tnkhusus		= rowData.tnkhusus;
						$("#tnkhusus").val(number_format(rowData.tnkhusus, 2,'.',','));
					
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
	
				var url;
				function newKHUSUS(){
					$('#dlg').dialog('open').dialog('center').dialog('setTitle','Input Data <?php echo $page;?>');
					$('#fm').form('clear');
					status = 'add';
					
					max_number();
					
				}		
				function editKHUSUS(){
					var row = $('#dg').datagrid('getSelected');
					status = 'edit';
					if (row){
						$('#dlg').dialog('open').dialog('setTitle','Edit Kode');
						$('#fm').form('load',row);
					}
				}
				
				function cari(){
					var key = $('#keyword').val();
					    $(function(){
						 $('#dg').datagrid({
							url: '<?php echo base_url();?>master/C_tunj_khusus/load_tunj_khusus',
							queryParams:({key:key})
							});        
						 });
				}
				
				function max_number(){ 
					$.ajax({
						type: "POST",
						url: '<?php echo base_url(); ?>master/C_tunj_khusus/max_number',
						data: ({table:'mtunj_khusus',kolom:'kd_khusus'}),
						dataType:"json",
						success:function(data){                                          
							$.each(data,function(i,n){                                    
								max = Number(n['no_urut'])+1; 
								nom = String('' + max).slice(-5);
								$('#kd_khusus').textbox('setValue', nom);
								$('#uraian').textbox('setValue', '');
							});
						}
					}); 
				 }
				 
				function exit(){
					$('#dg').datagrid('reload'); 
					$('#dlg').dialog('close');
					}
					
				function saveKHUSUS(){
					var kd_khusus = $('#kd_khusus').val();
					var uraian = $('#uraian').val();
					var tnkhusus = $('#tnkhusus').val();
					if( kd_khusus ==''){
						iziToast.warning({
						title: 'Caution',
						message: 'Kode Tidak boleh Kosong',
						});
						return
					}
					if( uraian ==''){
						iziToast.warning({
						title: 'Caution',
						message: 'Uraian Tidak boleh Kosong',
						});
						return
					}
					if( tnkhusus ==''){
						iziToast.warning({
						title: 'Caution',
						message: 'Jumlah Tidak boleh Kosong',
						});
						return
					}
					
					if(status=='add'){
					  $(document).ready(function(){
						  if(kd_khusus=='' && uraian=='' && tnkhusus=='' ){
								iziToast.warning({
									title: 'Caution',
									message: 'Mohon Lengkapi inputan anda.!',
								});
						  }else{
								$.post('<?php echo base_url(); ?>master/C_tunj_khusus/simpan',
									{kd_khusus:kd_khusus,uraian:uraian,tnkhusus:tnkhusus},function(result){
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
						$.post('<?php echo base_url(); ?>master/C_tunj_khusus/ubah',
									{kd_khusus:kd_khusus,uraian:uraian,tnkhusus:tnkhusus},function(result){
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
				
				function destroyKHUSUS(){
					var row = $('#dg').datagrid('getSelections');
					var ids = [];
					for(var i=0; i<row.length; i++){ids.push(row[i].kd_khusus);}
					var kd_khusus = ids.join('#');
					if (row){
						$.messager.confirm('Konfirmasi','Yakin ingin menghapus data ini?',function(r){
							if (r){
								$.post('<?php echo base_url(); ?>master/C_tunj_khusus/hapus',
									{kd_khusus:kd_khusus},function(result){
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