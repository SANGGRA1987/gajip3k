<div class="row">
    <div class="col-md-12">  
	<div class="box-header">
		<div style="padding-left: 0px !important;" class="col-md-2">
			<button id="tambah"  type="button" class="btn btn-default" onClick="javascript:newUNITSKPD();"><span><i class="fa fa-plus"></i></span> Tambah</button>  
			<div class="help-block with-errors" id="error_custom1"></div>
		</div>		
		<div style="padding-left: 0px !important;" class="col-md-2">
			<button id="ubah" type="button" class="btn btn-default" onClick="javascript:editUNITSKPD();"><span><i class="fa fa-pencil"></i></span> Ubah</button>  
			<div class="help-block with-errors" id="error_custom1"></div>
		</div>	
		<div style="padding-left: 0px !important;" class="col-md-2">
			<button id="hapus" type="button" class="btn btn-default" onClick="javascript:destroyUNITSKPD();"><span><i class="fa fa-trash"></i></span> Hapus</button>  
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
	<!--style="width:500px"-->
    <div id="dlg" class="easyui-dialog" style="width:900px;display:none" closed="true" buttons="#dlg-buttons">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 20px">
			 <table align="center" width="100%" border="0" >
				 <tr>
					<td width="20%"><label>Satuan Kerja</label></td>
					<td width="2%">:</td>
					<td width="79%" colspan="4"><input id="satkerja" name="satkerja" class="easyui-textbox" style="width:15%"><input id="nm_satkerja" name="nm_satkerja" class="easyui-textbox"  style="width:85%"></td>
				</tr>
				<tr>
					<td width="20%"><label>Unitkerja</label></td>
					<td width="2%">:</td> 
					<td width="67%" colspan="4"><input id="unit" name="unit" class="easyui-textbox" style="width:10%"></td>
				</tr>
				<tr>
					<td width="20%"><label>Nama UnitKerja</label></td>
					<td width="2%">:</td> 
					<td width="67%" colspan="4"><input id="nm_unit" name="nm_unit" class="easyui-textbox" style="width:80%"></td> 
			   </tr>
			   <tr>
					<td width="20%"><label>Kota</label></td>
					<td width="2%">:</td> 
					<td width="67%" colspan="4"><input id="kota" name="kota" class="easyui-textbox" style="width:40%"></td> 
			   </tr>
			   <tr>
					<td width="20%"><label>Nama Bendahara I</label></td>
					<td width="2%">:</td> 
					<td width="67%"><input id="nama_bend" name="nama_bend" class="easyui-textbox"  style="width:80%"></td> 
			  </tr>
			  <tr>
					<td width="20%"><label>Jabatan Bendahara I</label></td>
					<td width="2%">:</td> 
					<td width="67%"><input id="jab_bend" name="jab_bend" class="easyui-textbox"  style="width:90%"></td> 
			  </tr>
			  <tr>
				<td width="20%"><label>Nip Atasan</label></td>
				<td width="2%">:</td> 
				<td width="67%"><input id="nip_atasan" name="nip_atasan" class="easyui-textbox"  style="width:25%"></td> 
		 	  </tr>
			  
			   <tr>
				<td width="20%"><label>Nama Atasan :</label></td>
				<td width="2%">:</td> 
				<td width="67%"><input id="nama_atasan" name="nama_atasan" class="easyui-textbox"  style="width:70%"></td> 

		 	  </tr>
			  
			  <tr>
				<td width="20%"><label>Jabatan Atasan Langsung</label> </td>
				<td width="2%">:</td>
				<td  width="67%"><input id="jab_atasan" name="jab_atasan" class="easyui-textbox"  style="width:70%"></td> 

			  </tr>
			  
			  <tr>
				<td width="20%"><label>An. Atasan Langsung</label></td>
				<td width="2%">:</td>
				<td width="67%"><input id="jab_atasan2" name="jab_atasan2" class="easyui-textbox" style="width:80%"></td> 
			  </tr>
			  
			  <tr>
				<td width="20%"><label>Nip Operator</label></td>
				<td width="2%">:</td>
				<td width="67%"><input id="nip_operator" name="nip_operator" class="easyui-textbox"  style="width:25%"></td> 
			  </tr>
			  <tr>
				<td width="20%"><label>Nama Operator</label></td>
				<td width="2%">:</td>
				<td width="67%"><input id="nama_operator" name="nama_operator" class="easyui-textbox"  style="width:80%"></td> 
			  </tr>
			  <tr>
				<td width="20%"><label>Jabatan Operator</label></td>
				<td width="2%">:</td>
				<td width="67%"><input id="jab_operator" name="jab_operator" class="easyui-textbox"  style="width:60%"></td> 
			  </tr>
			  

			 </table>
			 

        </form>
    </div>

    <div id="dlg-buttons" style="display:none">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUNITSKPD()" style="width:90px">Simpan</a>
        <a  href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="exit()" style="width:90px">close</a>
    </div>
  </div>
</div>
	
    <script type="text/javascript">
		$(document).ready(function(){
			$("#satkerja").textbox('textbox').attr('maxlength',10);
			$("#ubah").attr("disabled", "disabled");
			$("#hapus").attr("disabled", "disabled");
			var status = '';
				$('#dg').datagrid({
					title:'List Data <?php echo $page;?>',
					width:1525,
					height:350,
					rownumbers:true,
					remoteSort:false,
					nowrap:false,
					fitColumns:true,
					pagination:true,
					url:'<?php echo base_url(); ?>master/C_unitskpd/load_unit',
					columns:[[
						{field:'satkerja',title:'Satuan Kerja',width:100,align:'center',sortable:true},
						{field:'unit',title:'Unit Kerja',width:80,align:'center'},
						{field:'nm_unit',title:'Nama UnitKerja',width:400,align:'left'},
						{field:'ck',title:'',width:60,align:'center',checkbox:true}
					]],
					onSelect:function(rowIndex,rowData){
						lcidx 		= rowIndex;
						satkerja		= rowData.satkerja;				
						unit		= rowData.unit;
						nm_unit		= rowData.nm_unit;
						kota	= rowData.kota;
						jab_atasan	= rowData.jab_atasan;
						jab_atasan2	= rowData.jab_atasan2;
						nama_atasan	= rowData.nama_atasan;
						nip_atasan	= rowData.nip_atasan;
						jab_bend	= rowData.jab_bend;
						nama_bend	= rowData.nama_bend;
						nip_bend	= rowData.nip_bend;
						jab_operator	= rowData.jab_operator;
						nama_operator	= rowData.nama_operator;
						nip_operator	= rowData.nip_operator;
	
						cekjumlah();
						
					},
					onUncheck: function(index,row) {
						cekjumlah();
						
					},
					onCheck: function(index,row) {
					cekjumlah();
						
					},
					onUncheckAll:function(index,row){
						cekjumlah();
					},
					onCheckAll:function(index,row){
						cekjumlah();
					}
				}); 
			
							
 		$('#satkerja').combogrid({
			panelWidth:500,  
	       	idField:'satkerja',  
	       	textField:'satkerja',  
	       	mode:'remote',
	       	url: '<?php echo base_url(); ?>master/C_skpd/load_skpd',
	       	columns:[[  
	           {field:'satkerja',title:'satkerja',width:100},  
	           {field:'nm_satkerja',title:'nama satkerja',width:400}    
	       	]],  
	       	onSelect:function(rowIndex,rowData){
			   lcstatus = 'tambah';
			   nmsatkerja	= rowData.nm_satkerja;         
			  $('#nm_satkerja').textbox('setValue',nmsatkerja);
	       	}  
		}); 
		
		});
	
				var url;
				function newUNITSKPD(){
					$('#dlg').dialog('open').dialog('center').dialog('setTitle','Input Data <?php echo $page;?>');
					$('#fm').form('clear');
					status = 'add';
				}		

	
				function editUNITSKPD(){
					$('#nm_satkerja').val("disabled");
					var row = $('#dg').datagrid('getSelected');

					status = 'edit';
					if (row){
						$('#dlg').dialog('open').dialog('setTitle','Edit Data UnitKerja');
						
						$('#fm').form('load',row);
					}
				}
				
				function cari(){
					var key = $('#keyword').val();
					
					    $(function(){
						 $('#dg').datagrid({
							url: '<?php echo base_url();?>master/C_unitskpd/load_unit',
							queryParams:({key:key})
							});        
						 });
				}

					function exit(){
										$('#dg').datagrid('reload'); 
										$('#dlg').dialog('close');
					} 
				function saveUNITSKPD(){
					var satkerja = $('#satkerja').val();
					var unit = $('#unit').val();
					var nm_unit = $('#nm_unit').val();
					var kota = $('#kota').val();
					var jab_atasan = $('#jab_atasan').val();
					var jab_atasan2 = $('#jab_atasan2').val();
					var nama_atasan = $('#nama_atasan').val();
					var nip_atasan = $('#nip_atasan').val();
					var jab_bend = $('#jab_bend').val();
					var nama_bend = $('#nama_bend').val();
					var nip_bend = $('#nip_bend').val();
					var jab_operator = $('#jab_operator').val();
					var nama_operator = $('#nama_operator').val();
					var nip_operator = $('#nip_operator').val();
					
					 if( satkerja==''){
							iziToast.warning({
								title: 'Caution',
								message: 'Satuan Kerja Tidak boleh Kosong',
							});
							return
					  }
					  if( unit==''){
							iziToast.warning({
								title: 'Caution',
								message: 'Unit Tidak boleh Kosong',
							});
							return
					  }
					  if( nm_unit ==''){
							iziToast.warning({
								title: 'Caution',
								message: 'Nama Unit Tidak boleh Kosong',
							});
							return
					  }
					  if( kota ==''){
							iziToast.warning({
								title: 'Caution',
								message: 'Kota Tidak boleh Kosong',
							});
							return
					  }
					  if( jab_atasan==''){
							iziToast.warning({
								title: 'Caution',
								message: 'Jabatan Atasan Tidak boleh Kosong',
							});
							return
					  }
					  if( jab_atasan2==''){
							iziToast.warning({
								title: 'Caution',
								message: 'Atasan Langsung Tidak boleh Kosong',
							});
							return
					  }
					  if( nama_atasan ==''){
							iziToast.warning({
								title: 'Caution',
								message: 'Nama Atasan Tidak boleh Kosong',
							});
							return
					  }
					  if( nip_atasan ==''){
							iziToast.warning({
								title: 'Caution',
								message: 'NIP Atasan Tidak boleh Kosong',
							});
							return
					  }
					  if( jab_bend ==''){
							iziToast.warning({
								title: 'Caution',
								message: 'Jabatan Bendahara1  Tidak boleh Kosong',
							});
							return
					  }
					  if( nama_bend ==''){
							iziToast.warning({
								title: 'Caution',
								message: 'Nama Bendahara1 Tidak boleh Kosong',
							});
							return
					  }
					  if( nip_bend ==''){
							iziToast.warning({
								title: 'Caution',
								message: 'NIP Bendahara1 Tidak boleh Kosong',
							});
							return
					  }
					  if( jab_operator ==''){
							iziToast.warning({
								title: 'Caution',
								message: 'Jabatan Operator Tidak boleh Kosong',
							});
							return
					  }
					  if( nama_operator ==''){
							iziToast.warning({
								title: 'Caution',
								message: 'Nama Operator Tidak boleh Kosong',
							});
							return
					  }
					  if( nip_operator ==''){
							iziToast.warning({
								title: 'Caution',
								message: 'NIP Operator Tidak boleh Kosong',
							});
							return
					  }

					if(status=='add'){
					  $(document).ready(function(){
						  if( satkerja==''){
								iziToast.warning({
									title: 'Caution',
									message: 'Mohon Lengkapi inputan anda.!',
								});
						  }else{
								$.post('<?php echo base_url(); ?>master/C_unitskpd/simpan',
									{satkerja:satkerja,unit:unit,nm_unit:nm_unit,kota:kota,
									jab_atasan:jab_atasan,jab_atasan2:jab_atasan2,nama_atasan:nama_atasan,
									nip_atasan:nip_atasan,jab_bend:jab_bend,nama_bend:nama_bend,
									nip_bend:nip_bend,jab_operator:jab_operator,nama_operator:nama_operator,
									nip_operator:nip_operator},function(result){
									if (result.pesan){
										iziToast.success({
											title: 'OK',
											message: 'Data Berhasil Disimpan.!!',
										});
										$('#dg').datagrid('reload'); 
										$('#dlg').dialog('close');
										$("#ubah").attr("disabled", "disabled");
										$("#hapus").attr("disabled", "disabled");
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
						$.post('<?php echo base_url(); ?>master/C_unitskpd/ubah',
									{satkerja:satkerja,unit:unit,nm_unit:nm_unit,kota:kota,
									jab_atasan:jab_atasan,jab_atasan2:jab_atasan2,nama_atasan:nama_atasan,
									nip_atasan:nip_atasan,jab_bend:jab_bend,nama_bend:nama_bend,
									nip_bend:nip_bend,jab_operator:jab_operator,nama_operator:nama_operator,
									nip_operator:nip_operator},function(result){
									if (result.pesan){
										iziToast.info({
											title: 'OK',
											message: 'Data Berhasil Dirubah.!!',
										});
										$('#dg').datagrid('reload');
										$('#dlg').dialog('close');	
										$("#ubah").attr("disabled", "disabled");
										$("#hapus").attr("disabled", "disabled");								
									} else {
										iziToast.error({
											title: 'Error',
											message: 'Data Gagal Dirubah.!',
										});
									}
								},'json');
					}
				}
				
				function destroyUNITSKPD(){
					var row = $('#dg').datagrid('getSelections');
					var ida = [];
					var ids = [];
					for(var i=0; i<row.length; i++){ids.push(row[i].satkerja);}
					var satkerja = ids.join('#');
					//var unit = ids.join('#');
					if (row){
						$.messager.confirm('Konfirmasi','Yakin ingin menghapus data ini?',function(r){
							if (r){
								$.post('<?php echo base_url(); ?>master/C_unitskpd/hapus',
									{satkerja:satkerja,unit:unit},function(result){
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