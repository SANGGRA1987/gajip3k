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
					<td width="20%"><label>NIK </label></td>
					<td width="2%">:</td> 
					<td width="67%"><input id="nip" name="nip" class="easyui-textbox"  style="width:30%"></td> 
				  </tr>
				  
				   <tr>
					<td width="20%"><label>Nama </label></td>
					<td width="2%">:</td> 
					<td width="67%"><input id="nama" name="nama" class="easyui-textbox"  style="width:70%"></td> 
	
				  </tr>
				  
				  <tr>
					<td width="20%"><label>Jabatan </label> </td>
					<td width="2%">:</td>
					<td  width="67%"><input id="jabatan" name="jabatan" class="easyui-textbox"  style="width:70%"></td> 
	
				  </tr>	
				 <tr>
					<td width="20%"><label>Satuan Kerja</label></td>
					<td width="2%">:</td>
					<td width="79%" colspan="4"><input id="skpd" name="skpd" class="easyui-textbox" style="width:15%"><input id="nm_skpd" name="nm_skpd" class="easyui-textbox"  style="width:85%"></td>
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
					<td width="20%"><label>Kode</label></td>
					<td width="2%">:</td>
					<td width="79%" colspan="4"><input id="ckey" name="ckey" class="easyui-textbox" style="width:40%"></td>
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
			$("#skpd").textbox('textbox').attr('maxlength',10);
			$("#nip").textbox('textbox').attr('maxlength',18);
			$("#unit").textbox('textbox').attr('maxlength',3);
			$("#ubah").attr("disabled", "disabled");
			$("#hapus").attr("disabled", "disabled");
			var status = '';
				$('#dg').datagrid({
					title:'List Data <?php echo $page;?>',
					width:1300,
					height:350,
					rownumbers:true,
					remoteSort:false,
					nowrap:false,
					fitColumns:true,
					pagination:true,
					url:'<?php echo base_url(); ?>master/C_ttd/load_unit',
					columns:[[
						{field:'nip',title:'NIK',width:150,align:'left',sortable:true},
						{field:'nama',title:'Nama',width:250,align:'left'},
						{field:'jabatan',title:'Jabatan',width:200,align:'left'},
						{field:'ck',title:'',width:60,align:'center',checkbox:true}
					]],
					onSelect:function(rowIndex,rowData){
						lcidx 		= rowIndex;
						skpd		= rowData.skpd;	
						nm_skpd		= rowData.nm_skpd;			
						unit		= rowData.unit;
						nm_unit		= rowData.nm_unit;
						jabatan		= rowData.jabatan;
						nama		= rowData.nama;
						nip			= rowData.nip;
						ckey		= rowData.ckey;
	
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
				
		$('#ckey').combogrid({
            panelWidth:500,  
            idField:'ckey',  
            textField:'nama_ckey',  
            url:'<?php echo base_url(); ?>master/C_ttd/get_kode', 
            mode:'remote',
            columns:[[  
               {field:'ckey',title:'Kode',width:70,align:'center'},  
               {field:'nama_ckey',title:'Nama',width:400,align:'left'}    
            ]],
			onSelect:function(rowIndex,rowData){
				ckey = rowData.ckey;
			}
        });	
							
 		$('#skpd').combogrid({
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
			   satkerja	= rowData.satkerja;
			   nmsatkerja	= rowData.nm_satkerja;         
			  $('#nm_skpd').textbox('setValue',nmsatkerja);
			  $('#unit').combogrid({url:'<?php echo base_url(); ?>master/C_Pegawai/getUnit',
			   queryParams:({satkerja:satkerja})
	       	});
			}  
		});
		
		$('#unit').combogrid({
            panelWidth:700,  
            idField:'unit',  
            textField:'unit',  
            mode:'remote',
            columns:[[  
               {field:'unit',title:'Kode',width:100},  
               {field:'nm_unit',title:'Nama Unit',width:700}    
            ]],  
            onSelect:function(rowIndex,rowData){
			nm_unit = rowData.nm_unit;
			$("#nm_unit").textbox('setValue',nm_unit);
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
					$('#nip').val("disabled");
					var row = $('#dg').datagrid('getSelected');

					status = 'edit';
					if (row){
						$('#dlg').dialog('open').dialog('setTitle','Edit Data Penandatangan');
						
						$('#fm').form('load',row);
					}
				}
				
				function cari(){
					var key = $('#keyword').val();
					
					    $(function(){
						 $('#dg').datagrid({
							url: '<?php echo base_url();?>master/C_ttd/load_unit',
							queryParams:({key:key})
							});        
						 });
				}

					function exit(){
										$('#dg').datagrid('reload'); 
										$('#dlg').dialog('close');
					} 
				function saveUNITSKPD(){
					var skpd = $('#skpd').val();
					var nm_skpd = $('#nm_skpd').val();
					var unit = $('#unit').val();
					var nm_unit = $('#nm_unit').val();
					var jabatan = $('#jabatan').val();
					var nama = $('#nama').val();
					var nip = $('#nip').val();
					var ckey = $('#ckey').val();
					
					  if( jabatan==''){
							iziToast.warning({
								title: 'Caution',
								message: 'Jabatan Tidak boleh Kosong',
							});
							return
					  }
					  if( nama ==''){
							iziToast.warning({
								title: 'Caution',
								message: 'Nama Tidak boleh Kosong',
							});
							return
					  }
					  if( nip ==''){
							iziToast.warning({
								title: 'Caution',
								message: 'NIP Tidak boleh Kosong',
							});
							return
					  }
					   if( ckey ==''){
							iziToast.warning({
								title: 'Caution',
								message: 'Kode Tidak boleh Kosong',
							});
							return
					  }

					if(status=='add'){
					  $(document).ready(function(){
						  if( nip==''){
								iziToast.warning({
									title: 'Caution',
									message: 'Mohon diisi NIK.!',
								});
						  }else{
								$.post('<?php echo base_url(); ?>master/C_ttd/simpan',
									{skpd:skpd,nm_skpd:nm_skpd,unit:unit,nm_unit:nm_unit,
									jabatan:jabatan,nama:nama,nip:nip,ckey:ckey},function(result){
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
						$.post('<?php echo base_url(); ?>master/C_ttd/ubah',
									{skpd:skpd,nm_skpd:nm_skpd,unit:unit,nm_unit:nm_unit,
									jabatan:jabatan,nama:nama,nip:nip,ckey:ckey},function(result){
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
					for(var i=0; i<row.length; i++){ids.push(row[i].nip);}
					var nip = ids.join('#');
					//var unit = ids.join('#');
					if (row){
						$.messager.confirm('Konfirmasi','Yakin ingin menghapus data ini?',function(r){
							if (r){
								$.post('<?php echo base_url(); ?>master/C_ttd/hapus',
									{nip:nip},function(result){
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