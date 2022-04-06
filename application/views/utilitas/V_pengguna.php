<div class="row">
    <div class="col-md-12">  
	<div class="box-header">
		<div style="padding-left: 0px !important;" class="col-md-2">
			<button id="tambah"  type="button" class="btn btn-default" onClick="javascript:newUser();"><span><i class="fa fa-plus"></i></span> Tambah</button>  
			<div class="help-block with-errors" id="error_custom1"></div>
		</div>		
		<div style="padding-left: 0px !important;" class="col-md-2">
			<button id="ubah" type="button" class="btn btn-default" onClick="javascript:editUser();"><span><i class="fa fa-pencil"></i></span> Ubah</button>  
			<div class="help-block with-errors" id="error_custom1"></div>
		</div>	
		<div style="padding-left: 0px !important;" class="col-md-2">
			<button id="hapus" type="button" class="btn btn-default" onClick="javascript:destroyUser();"><span><i class="fa fa-trash"></i></span> Hapus</button>  
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

    <table id="dg"></table>
    <div id="dlg" class="easyui-dialog" style="width:600px" closed="true" buttons="#dlg-buttons">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
			<div style="margin-bottom:10px">
                <input id="kode" name="kode" required="true" class="easyui-textbox" label="Kode:" style="width:40%;readonly:true">
            </div>
            <div style="margin-bottom:10px">
                <input id="otori" name="otori" required="true" class="easyui-textbox" label="Otorisasi:" style="width:60%;">
            </div>
            <div style="margin-bottom:10px">
                <input id="username" name="username" required="true" class="easyui-textbox" label="Username:" style="width:70%;">
            </div>
            <div style="margin-bottom:10px">
                <input type="password" id="password" name="password" required="true" class="easyui-textbox" label="Password:" style="width:70%;">
            </div>
			<div class="skpd_togle" style="margin-bottom:10px">
                <input id="skpd" name="skpd" required="true" class="easyui-textbox" label="SKPD:" style="width:80%;"><br/>
				<span id="nm_skpd"></span>
            </div>
            <div class="skpd_togle" style="margin-bottom:10px">
                <input id="uskpd" name="uskpd" class="easyui-textbox" required="true" label="Unit SKPD:" style="width:80%"><br/>
				<span id="nm_uskpd"></span>
			</div>
            <div class="nama_togle" style="margin-bottom:10px">
                <input id="nm_user" name="nm_user" class="easyui-textbox" required="true" label="Nama User:" style="width:80%"><br/>
			</div>
            <div style="margin-bottom:10px">
                <input id="email" name="email" class="easyui-textbox" required="true" label="Email User:" style="width:70%">
            </div>
        </form>
    </div>
	<style>
	.textbox-label {
    display: inline-block;
    width: 100px !important;
    height: 22px;
    line-height: 22px;
    vertical-align: middle;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    margin: 0;
    padding-right: 5px;
}
	</style>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Batal</a>
    </div>
	
    <script type="text/javascript">
		$(document).ready(function(){
			$("#kode").textbox('textbox').attr('maxlength',4).readOnly=true;
			$("#ubah").attr("disabled", "disabled");
			$("#hapus").attr("disabled", "disabled");
			$('.skpd_togle').show();
			$('.nama_togle').show();
			var status = '';
				$('#dg').datagrid({
					title:'Daftar Data <?php echo $page;?>',
					width:1000,
					height:350,
					rownumbers:true,
					remoteSort:false,
					nowrap:false,
					fitColumns:true,
					pagination:true,
					url:'<?php echo base_url(); ?>utilitas/C_pengguna/load_pengguna',
					columns:[[
						{field:'kode',title:'kode',width:200,align:'center',hidden:true},
						{field:'oto',title:'Otori',width:200,align:'left',sortable:true},
						{field:'nm_user',title:'Pengguna',width:400,align:'left'},
						{field:'email_user',title:'E-mail',width:400,align:'left'},
						{field:'ck',title:'',width:60,align:'center',checkbox:true}
					]],
					onSelect:function(rowIndex,rowData){
						lcidx 			= rowIndex;
						nm_user			= rowData.nm_user;
						email_user		= rowData.email_user;
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
			
						
				$('#otori').combobox({  
					valueField:'kode',  
					textField:'nama',
					width:250,
					data:[
						{kode:'01',nama:'Administrator'},
						{kode:'02',nama:'Operator 1'},
						{kode:'03',nama:'Operator 2'}
					],
					onSelect:function(rowIndex,rowData){
					var kode = $('#otori').combobox('getValue');
						if(kode=='02'){
						$(".skpd_togle").hide();
						$(".nama_togle").show();
						}else{
						$(".skpd_togle").show();
						$(".nama_togle").show();
						}
					}
				});	
						
				$("#skpd").combogrid({
				  panelWidth:600,  
				  idField:'kd_skpd',
				  textField:'kd_skpd',
				  url:'<?php echo base_url('utilitas/C_pengguna/getSkpd') ?>',
				  columns:[[
					  {field:'kd_skpd',title:'Kode SKPD', width:'200'},
					  {field:'nm_skpd',title:'Nama SKPD', width:'400'},
				  ]],
				  fitColumns: true,
				  onSelect: function(index, row){
					skpd = row.kd_skpd; 
					document.getElementById('nm_skpd').textContent = row.nm_skpd;
						$("#uskpd").combogrid({
						  panelWidth:600,  
						  idField:'kd_skpd',
						  textField:'kd_skpd',
						  url:'<?php echo base_url('utilitas/C_pengguna/getUnitSkpd') ?>',
						  queryParams:({skpd:skpd}),
						  columns:[[
							  {field:'kd_skpd',title:'Kode SKPD', width:'200'},
							  {field:'nm_skpd',title:'Nama SKPD', width:'400'},
						  ]],
						  fitColumns: true,
						  onSelect: function(index, row){
							document.getElementById('nm_uskpd').textContent = row.nm_skpd;
						  }
						}).combogrid('textbox').attr('placeholder','Pilih SKPD'); 
					
					
				  }
				}).combogrid('textbox').attr('placeholder','Pilih SKPD'); 	
				
			
		});

				var url;
				function newUser(){
					$('#dlg').dialog('open').dialog('center').dialog('setTitle','Input Data <?php echo $page;?>');
					//.click(function(){});
					$('#fm').form('clear');
					status = 'add';
					max_number();
				}		
				function editUser(){
					var row = $('#dg').datagrid('getSelected');
					status = 'edit';
					if (row){
						$('#dlg').dialog('open').dialog('setTitle','Edit User');
						$('#fm').form('load',row);
					}
				}
				
				function cari(){
					var key = $('#keyword').val();
					    $(function(){
						 $('#dg').datagrid({
							url: '<?php echo base_url();?>utilitas/C_pengguna/load_pengguna',
							queryParams:({key:key})
							});        
						 });
				}

								 
				function saveUser(){
					var otori 		= $('#otori').val();
					var username 	= $('#username').val();
					var password 	= $('#password').val();
					var skpd 		= $('#skpd').val();
					var nm_skpd 	= $('#nm_skpd').text();
					var uskpd 		= $('#uskpd').val();
					var nm_uskpd 	= $('#nm_uskpd').text();
					var nm_user 	= $('#nm_user').val();
					var email 		= $('#email').val();
					var kode 		= $('#kode').val();
					if(status=='add'){
					  $(document).ready(function(){
						  if(otori=='' && username=='' && password==''){
								iziToast.warning({
									title: 'Caution',
									message: 'Mohon Lengkapi inputan anda.!',
								});
						  }else{
								$.post('<?php echo base_url(); ?>utilitas/C_pengguna/simpan',
									{kode:kode,otori:otori,user:username,pass:password,skpd:skpd,nmskpd:nm_skpd,uskpd:uskpd,nmuskpd:nm_uskpd,nmuser:nm_user,email:email},function(result){
									if (result.pesan){
										iziToast.success({
											title: 'OK',
											message: 'Data Berhasil Disimpan.!!',
										});
										$('#dg').datagrid('reload'); 
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
						$.post('<?php echo base_url(); ?>utilitas/C_pengguna/ubah',
									{kode:kode,otori:otori,user:username,pass:password,skpd:skpd,nmskpd:nm_skpd,uskpd:uskpd,nm_uskpd:nmuskpd,nmuser:nm_user,email:email},function(result){
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
				
				function destroyUser(){
					var row = $('#dg').datagrid('getSelections');
					var ids = [];
					for(var i=0; i<row.length; i++){ids.push(row[i].kode);}
					var kode = ids.join('#');
					if (row){
						$.messager.confirm('Konfirmasi','Yakin ingin menghapus data ini?',function(r){
							if (r){
								$.post('<?php echo base_url(); ?>utilitas/C_pengguna/hapus',
									{kode:kode},function(result){
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
				
				function max_number(){ 
					$.ajax({
						type: "POST",
						url: '<?php echo base_url(); ?>utilitas/C_Pengguna/max_number',
						data: ({table:'muser',kolom:'kode'}),
						dataType:"json",
						success:function(data){                                          
							$.each(data,function(i,n){                                    
								max = Number(n['no_urut'])+1; 
								nom = String('000' + max).slice(-2);
								$('#kode').textbox('setValue', nom);
								/* $('#nm_barang').textbox('setValue', '');
								$('#umur').textbox('setValue', ''); */
								});
						}
					}); 
				 }	
			</script>
	</div>
</div>	