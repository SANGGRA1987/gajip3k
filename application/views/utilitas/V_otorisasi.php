<div class="row">
    <div class="col-md-12">  
		<div class="box-header">
	        <div class="col-sm-3" align="right">
				<label class="panel-title">Koneksi Simakda:</label>
			</div>
			<div class="col-sm-2">
				 	<label class="switch">
					  <input type="checkbox" id="isSelected" name="isSelected">
					  <span class="slider round"></span>
					</label>
			</div>
	        <div class="col-sm-4 col-sm-offset-2" align="right">
				<form class="navbar-right">
					<div class="input-group">
						<input type="text" value="" id="keyword" name="keyword" class="form-control" placeholder="">
						<span class="input-group-btn"><button type="button" class="btn btn-default" onClick="javascript:cari();"><i class="fa fa-search"></i></button></span>
					</div>
				</form>
			</div>		 
		</div>

    <table id="dg"></table>
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
	.fa {
		display: inline-block;
		font-family: FontAwesome;
		font-feature-settings: normal;
		font-kerning: auto;
		font-language-override: normal;
		font-size: 20px !important;
		font-size-adjust: none;
		font-stretch: normal;
		font-style: normal;
		font-variant: normal;
		font-weight: normal;
		line-height: 1;
		text-rendering: auto;
	}
	</style>
    <script type="text/javascript">
		var mode = '<?php echo $mode;?>';
		$(document).ready(function(){
					
			if (mode==1){
				document.getElementById("isSelected").checked = true;	
				}else{
				document.getElementById("isSelected").checked = false;	
			}
			
			$('#isSelected').click(function(){
				if($(this).is(':checked')){
				var r = confirm("Apakah anda yakin aktifkan koneksi dgn Simakda,??");
					if (r == true) {
					$(document).ready(function(){
						$.ajax({
							type: "POST",
							url: '<?php echo base_url(); ?>utilitas/C_otorisasi/conn_smkd',
							data: ({id:1}),
							dataType:"json"
						});
					});
					
					}else{
						document.getElementById("isSelected").checked = false;	
						return true;
					}
				} else {
				var r = confirm("Apakah anda yakin non aktifkan koneksi dgn Simakda,??");
					if (r == true) {
					$(document).ready(function(){
						$.ajax({
							type: "POST",
							url: '<?php echo base_url(); ?>utilitas/C_otorisasi/conn_smkd',
							data: ({id:0}),
							dataType:"json"
						});
					});
					}else{
						document.getElementById("isSelected").checked = true;	
						return true;
					}
				}
			});
			
			
			var status = '';
			var lastIndex;
				$('#dg').datagrid({
					title:'List Data <?php echo $page;?>',
					idField:'idmenu',
					width:1000,
					height:350,        
					singleSelect:true,
					rownumbers:true,
					fitColumns:false,
					pagination:true,
					idField:'itemid',                
					rowStyler: function(index,row){
                    if (row.is_parent == 0){
							return 'background-color:#006600;color:#fff;font-weight:bold;';
						}
					},
					url:'<?php echo base_url(); ?>utilitas/C_otorisasi/load_otorisasi',			
					frozenColumns:[[
					
						{field:'idmenu',title:'ID',width:100,align:'center'},
						{field:'judul',title:'MENU',width:350,align:'left',sortable:true},
					]],
					columns:[[
						{field:'m01',title:'ADMIN',width:150,align:'center',
							formatter:function(value,row){
								return row.m01 || value;
							},
							editor:{
								type:'combobox',
								options:{
									valueField:'nama',
									textField:'nama',
									data:[{kode:'1',nama:'YA'},{kode:'0',nama:'TIDAK'}],
									required:true
								}
							}
						},
						{field:'m02',title:'OPR 1',width:150,align:'center',
						formatter:function(value,row){
								return row.m02 || value;
							},
							editor:{
								type:'combobox',
								options:{
									valueField:'nama',
									textField:'nama',
									data:[{kode:'1',nama:'YA'},{kode:'0',nama:'TIDAK'}],
									required:true
								}
							}
						},
						{field:'m03',title:'OPR 2',width:150,align:'center',
								formatter:function(value,row){
								return row.m03 || value;
							},
							editor:{
								type:'combobox',
								options:{
									valueField:'nama',
									textField:'nama',
									data:[{kode:'1',nama:'YA'},{kode:'0',nama:'TIDAK'}],
									required:true
								}
							}
						},
					{field:'action',title:'Aksi',width:60,align:'center',
						formatter:function(value,row,index){
							if (row.editing){
								var s = '<a href="javascript:void(0)" onclick="saverow(this)"><i class="fa fa-check-square" aria-hidden="true"></i></a>&nbsp;&nbsp;';
								var c = '<a href="javascript:void(0)" onclick="cancelrow(this)"><i class="fa fa-undo" aria-hidden="true"></i></a>';
								return s+c;
							} else {
								var e = '<a href="javascript:void(0)" onclick="editrow(this)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;';
								//var d = '<a href="javascript:void(0)" onclick="deleterow(this)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
								return e;
							}
						}
					}
					]],
				 onEndEdit:function(index,row){
					var ed = $(this).datagrid('getEditor', {
						index: index,
						field: 'idmenu'
					});
				},
				onBeforeEdit:function(index,row){
					row.editing = true;
					$(this).datagrid('refreshRow', index);
				},
				onAfterEdit:function(index,row){
					simpan(row.idmenu,row.m01,row.m02,row.m03);
					row.editing = false;
					$(this).datagrid('refreshRow', index);
				},
				onCancelEdit:function(index,row){
					row.editing = false;
					$(this).datagrid('refreshRow', index);
				}, 
				onClickRow:function(rowIndex){ 
				if (lastIndex != rowIndex){
					$(this).datagrid('endEdit', lastIndex);
				}
				lastIndex = rowIndex;
				},
				onBeginEdit:function(rowIndex){ 

				}  
							
			}); 
			
		});

		var url;
		function cari(){
			var key = $('#keyword').val();
				$(function(){
				 $('#dg').datagrid({
					url: '<?php echo base_url();?>utilitas/C_otorisasi/load_otorisasi',
					queryParams:({key:key})
					});        
				 });
		}
		
		function simpan(cid,cadm,cope1,cope2){
			$(document).ready(function(){
				$.ajax({
					type: "POST",
					url: '<?php echo base_url(); ?>utilitas/C_otorisasi/simpan',
					data: ({id:cid,adm:cadm,oper1:cope1,oper2:cope2}),
					dataType:"json"
				});
			});                               
			$('#dg').datagrid('reload');        
		   

		}
								
		/*****edit data*****/
	function getRowIndex(target){
        var tr = $(target).closest('tr.datagrid-row'); 
        return parseInt(tr.attr('datagrid-row-index'));
    }
    function editrow(target){
        $('#dg').datagrid('beginEdit', getRowIndex(target));
    }
    function deleterow(target){
		$('#dg').datagrid('endEdit', getRowIndex(target));
        $.messager.confirm('Confirm','Are you sure?',function(r){
            if (r){
                $('#dg').datagrid('deleteRow', getRowIndex(target));
            }
        });
    }
    function saverow(target){
        $('#dg').datagrid('endEdit', getRowIndex(target));
    }
    function cancelrow(target){
        $('#dg').datagrid('cancelEdit', getRowIndex(target));
    }
	/********************/			
			</script>
	</div>
</div>	