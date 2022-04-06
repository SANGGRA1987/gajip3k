<div class="row">
    <div class="col-md-12" >  
	<div class="box-header">
		<div style="padding-left: 0px !important;" class="col-md-2">
			<button  type="button" class="btn btn-default" onClick="javascript:newUser();"><span><i class="fa fa-plus"></i></span> Tambah</button>  
			<div class="help-block with-errors" id="error_custom1"></div>
		</div>		
		<div style="padding-left: 0px !important;" class="col-md-2">
			<button  type="button" class="btn btn-default" onClick="javascript:editUser();"><span><i class="fa fa-pencil"></i></span> Ubah</button>  
			<div class="help-block with-errors" id="error_custom1"></div>
		</div>	
		<div style="padding-left: 0px !important;" class="col-md-2">
			<button  type="button" class="btn btn-default" onClick="javascript:tambah();"><span><i class="fa fa-trash"></i></span> Hapus</button>  
			<div class="help-block with-errors" id="error_custom1"></div>
		</div>
         <div class="col-md-8" align="right">
			<form class="navbar-right">
					<div class="input-group">
						<input type="text" value="" class="form-control" placeholder="">
						<span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-search"></i></button></span>
					</div>
				</form>
		</div>
	</div>

	<table id="dg" title="List Data <?php echo $page;?>" class="easyui-datagrid" style="margin-left: 10px; width:1000px;height:350px;border-radius: 0 0 15px 15px;"
		toolbar="#toolbar" pagination="true" url= "<?php echo base_url(); ?>welcome/load_fungsi"
		rownumbers="true" fitColumns="true" singleSelect="false">
		<thead>
			<tr>
				<th field="kd_satuan" align="center" width="200">Kode</th>
				<th field="nm_satuan" width="400">Satuan</th>     
				<th field="ck" checkbox="true"></th>
			</tr>
		</thead>
    </table>
    
    <div id="dlg" class="easyui-dialog" style="width:500px" closed="true" buttons="#dlg-buttons">
        <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
            <div style="margin-bottom:10px">
                <input name="kd_satuan" id="kd_satuan" type="text" class="easyui-textbox" required="true" label="Kode:" style="width:50%;">
            </div>
            <div style="margin-bottom:10px">
                <input name="nm_satuan" id="nm_satuan" class="easyui-textbox" required="true" label="Satuan:" style="width:100%">
            </div>
        </form>
    </div>
	
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Batal</a>
    </div>
	
    <script type="text/javascript">
				var url;
				function newUser(){
					$('#dlg').dialog('open').dialog('center').dialog('setTitle','Input Data <?php echo $page;?>');
					$('#fm').form('clear');
					//url = 'save_user.php';
				}
				function editUser(){
					var row = $('#dg').datagrid('getSelected');
					if (row){
						$('#dlg').dialog('open').dialog('center').dialog('setTitle','Edit User');
						$('#fm').form('load',row);
						url = 'update_user.php?id='+row.id;
					}
				}
				function saveUser(){
					$('#fm').form('submit',{
						url: url,
						onSubmit: function(){
							return $(this).form('validate');
						},
						success: function(result){
						iziToast.info({
							title: 'Hello',
							message: 'Welcome!',
						});
							var result = eval('('+result+')');
							if (result.errorMsg){
								$.messager.show({
									title: 'Error',
									msg: result.errorMsg
								});
							} else {
								$('#dlg').dialog('close');        // close the dialog
								$('#dg').datagrid('reload');    // reload the user data
							}
						}
					});
				}
				function destroyUser(){
					var row = $('#dg').datagrid('getSelected');
					if (row){
						$.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
							if (r){
								$.post('destroy_user.php',{id:row.id},function(result){
									if (result.success){
										$('#dg').datagrid('reload');    // reload the user data
									} else {
										$.messager.show({    // show error message
											title: 'Error',
											msg: result.errorMsg
										});
									}
								},'json');
							}
						});
					}
				}
				
	function tambah(){
		// window.location.href = "<?php echo base_url('C_server/tcpdf') ?>";
	   window.location.href = "<?php echo base_url('C_server/mpdf') ?>";
		//window.location.href = "<?php echo base_url('C_server/dompdf') ?>";
		
	}			
			</script>
	</div>
</div>	