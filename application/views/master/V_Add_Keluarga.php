
<div class="row">
	<div class="col-md-6">
		<div style="margin-bottom:10px">
			<div class="col-sm-12" style="padding-bottom: 10px;">
				<div class="col-sm-4" style="padding-top: 3px;">
				  <label>NIK</label>
				</div>
				<div class="col-sm-8">
					<input id="nip" name="nip" type="text" class="easyui-textbox" style="width:80%;">
				</div>
			</div>
		</div> 
		<div style="margin-bottom:10px">
			<div class="col-sm-12" style="padding-bottom: 10px;">
				<div class="col-sm-4" style="padding-top: 3px;">
				  <label>Jumlah Anak</label>
				</div>
				<div class="col-sm-8">
					<input id="anak" name="anak" type="text" class="easyui-textbox" style="width:80%;" readonly="true" disabled="disabled">
				</div>
			</div>
		</div>             
	</div>
	<div class="col-md-6">
		<div style="margin-bottom:10px">
			<div class="col-sm-12" style="padding-bottom: 10px;">
				<div class="col-sm-4" style="padding-top: 3px;">
				  <label>Nama</label>
				</div>
				<div class="col-sm-8">
					<input id="nama" name="nama" type="text" class="easyui-textbox" style="width:80%;" readonly="true" disabled="disabled">
				</div>
			</div>
		</div>
	</div>
</div>
<div style="padding-bottom: 20px;">
    <button type="button" class="btn btn-default btn-lg btn-block" onClick="javascript:tambahrincian();">Tambah Keluarga</button>
</div>

<table id="trd" name="trd"></table> <!-- Table TRD Home -->

<div style="padding-top: 10px;" class="row">
    <div class="col-sm-2 col-sm-offset-4">
        <button type="text" class="btn btn-default btn-lg btn-block" onClick="javascript:saveData();">Simpan</button>
    </div>
    <div class="col-sm-2 col-sm-offset">
        <button type="button" class="btn btn-default btn-lg btn-block" onClick="javascript:back();">Kembali</button>
    </div>
</div>
<style>

.popdg {
    width: 33% !important;
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
<div id="dlg" class="easyui-dialog" style="width:1100px" closed="true" buttons="#dlg-buttons">
        <div class="row" style="width: 100%">
			<form id="popfm" method="post" novalidate style="padding: 8px;" enctype="multipart/form-data">
					<div id="hide" style="margin-bottom: 10px">
						<div class="col-sm-12" style="padding-bottom: 10px;">
							<div class="col-sm-3"><label>Nama</label></div>
							<div class="col-sm-8">
								<input id="nama_kel" name="nama_kel" class="form-control" style="width: 100%">
							</div>
						</div>
					</div>
					<div id="hide" style="margin-bottom: 10px">
						<div class="col-sm-12" style="padding-bottom: 10px;">
							<div class="col-sm-3"><label>Hubungan</label></div>
							<div class="col-sm-5">
								<input id="status_hubungan" name="status_hubungan" class="form-control" style="width: 50%">
							</div>
						</div>
					</div>
					<div id="hide" style="margin-bottom: 10px">
						<div class="col-sm-12" style="padding-bottom: 10px;">
							<div class="col-sm-3"><label>Tgl Lahir</label></div>
							<div class="col-sm-2">
								<input id="tgl_lahir" name="tgl_lahir" class="form-control" style="width: 100%">
							</div>
						</div>
					</div>
					<div id="hide" style="margin-bottom: 10px">
						<div class="col-sm-12" style="padding-bottom: 10px;">
							<div class="col-sm-3"><label>Pekerjaan</label></div>
							<div class="col-sm-8">
								<input id="pekerjaan" name="pekerjaan" class="form-control" style="width: 100%">
							</div>
						</div>
					</div>
					<div id="hide" style="margin-bottom: 10px">
						<div class="col-sm-12" style="padding-bottom: 10px;">
							<div class="col-sm-3"><label>Pendidikan</label></div>
							<div class="col-sm-8">
								<input id="pendidikan" name="pendidikan" class="form-control" style="width: 100%">
							</div>
						</div>
					</div>
					<div id="hide" style="margin-bottom: 10px">
						<div class="col-sm-12" style="padding-bottom: 10px;">
							<div class="col-sm-3"><label>Tgl Pendidikan</label></div>
							<div class="col-sm-2">
								<input id="tgl_didik" name="tgl_didik" class="form-control" style="width: 100%">
							</div>
						</div>
					</div>
					<div class="col-sm-12" style="padding-bottom: 10px;">
						<div class="col-sm-4" style="padding-top: 3px;"><label class="fancy-radio" style="padding-top: 3px;"><input id="y_tunjangan" name="pilihan" value="1" type="radio"><span><i></i><label>Dapat Tunjangan</span></label></div>
						<div class="col-sm-4"><label class="fancy-radio" style="padding-top: 3px;"><input id="n_tunjangan" name="pilihan" value="2" type="radio"><span><i></i><label>Tidak Dapat Tunjangan</span></label></div>					
					</div>
					<div id="hide" style="margin-bottom: 10px">
						<div class="col-sm-12" style="padding-bottom: 10px;">
							<div class="col-sm-3"><label>Keterangan</label></div>
							<div class="col-sm-8">
								<textarea id="keterangan" name="keterangan" class="form-control" style="width: 100%"></textarea>
							</div>
						</div>
					</div>				
				</form>            
        </div>
		<div class="row" style="width: 80%">
			<div class="col-md-10">
                <div class="row">                    
                        <table id="dg"></table>
                </div>
            </div>
		</div>
</div>

<div id="dlg-buttons">
   <!-- <a type="submit" href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Simpan</a> -->
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" onclick="savedetail()" style="width:90px">Tampung</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-undo" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Kembali</a>
</div>

<script type="text/javascript" src="<?php echo site_url('assets/easyui/numberFormat.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/easyui/autoCurrency.js') ?>"></script>
<script type="text/javascript">

    window.onload = function(){

        var status  = localStorage.getItem('status');
        if (status == 'detail') {
			var status	= status;
			localStorage.setItem('status', status);
            var nip  = localStorage.getItem('nip');
            var nama  = localStorage.getItem('nama');
            var anak  = localStorage.getItem('anak');
          	$("#nama").textbox('setValue',nama);
			$("#anak").textbox('setValue',anak);			
			$('#nip').combogrid('setValue', nip);
            load_detail();
        }else{
			var status	= status;
			localStorage.setItem('status', status);
            var nip  = localStorage.getItem('nip');
            var nama  = localStorage.getItem('nama');
            var anak  = localStorage.getItem('anak');
           $("#nama").textbox('setValue',nama);
			$("#anak").textbox('setValue',anak);
			$('#nip option:selected').combogrid('setValue', nip);
		}
    }

    function back() {
        localStorage.clear();
        window.location.href = "<?php echo base_url(); ?>master/C_Keluarga";
    }

    function tambahrincian() {
        if (nip.value == "" || 
            $('#nip').combogrid('getValue') == "") {
                iziToast.error({
                    title: 'Error',
                    message: 'Field NIK Harus Terisi.!',
                });
        } else {
            $('#dlg').dialog('open').dialog('center').dialog('setTitle','Input Data <?php echo $page;?>');
        }
    }

	function saveData(){
		var nip 	= $('#nip').val();
		var status		= localStorage.getItem('status');
		var data1 		= $('#trd').datagrid('getRows');
		$.post('<?php echo base_url(); ?>master/C_Keluarga/saveData', {detail: JSON.stringify(data1),nip:nip,status:status}, function(result) {
		if (result.notif){
				iziToast.success({
					title: 'OK',
					message: result.message,
				});
			} else {
				iziToast.error({
					title: 'Error',
					message: result.message,
				});
			}
		}, "json");
	}

    function load_detail() {
        var i = 0;
		var kode	= $('#nip').val();
		
        $.ajax({
            url: '<?php echo site_url('master/C_Keluarga/trd_keluarga') ?>',
            type: 'POST',
            dataType: 'json',
            data: {nip: kode},
            success: function(data) {
                $.each(data,function(i,n){                                                                 
					cnama_kel    = n['nama_kel'];                                                                                       
					cstatus_hubungan = n['status_hubungan'];
					ctgl_lahir   = n['tgl_lahir'];
					cpekerjaan   = n['pekerjaan'];                        
					cpendidikan  = n['pendidikan'];                         
					ctgl_didik   = n['tgl_didik'];
					cketerangan  = n['keterangan'];
					ctunjangan   = n['tunjangan'];   
					$('#trd').datagrid('appendRow',
						{
							nama_kel:cnama_kel,
							status_hubungan:cstatus_hubungan,
							tgl_lahir:ctgl_lahir,
							pekerjaan:cpekerjaan,
							pendidikan:cpendidikan,
							tgl_didik:ctgl_didik,
							keterangan:cketerangan,
							tunjangan:ctunjangan 
						}); 
					$('#dg').datagrid('appendRow',
						{
							nama_kel:cnama_kel,
							status_hubungan:cstatus_hubungan,
							tgl_lahir:ctgl_lahir,
							pekerjaan:cpekerjaan,
							pendidikan:cpendidikan,
							tgl_didik:ctgl_didik,
							keterangan:cketerangan,
							tunjangan:ctunjangan 
						});
            	});
            }
        });    
    }
	function savedetail(){
		var xnama_kel 	= $('#nama_kel').val();
		var xstatus_hubungan  	= $('#status_hubungan').val();
		var xtgl_lahir 	= $('#tgl_lahir').val();
		var xpekerjaan 	= $('#pekerjaan').val();
		var xpendidikan = $('#pendidikan').val();
		var xtgl_didik 	= $('#tgl_didik').val();
		var xketerangan = $('#keterangan').val();
		//var xtunjangan 	= $('#tunjangan').val();
		var xtunjangan	= document.querySelector('input[name="pilihan"]:checked').value;
				$('#trd').datagrid('appendRow',
                    {
                     	nama_kel:xnama_kel,
						status_hubungan:xstatus_hubungan,
						tgl_lahir:xtgl_lahir,
						pekerjaan:xpekerjaan,
						pendidikan:xpendidikan,
						tgl_didik:xtgl_didik,
						keterangan:xketerangan,
						tunjangan:xtunjangan 
					 });  
				
				$('#dg').datagrid('appendRow',
                    {
                       	nama_kel:xnama_kel,
						status_hubungan:xstatus_hubungan,
						tgl_lahir:xtgl_lahir,
						pekerjaan:xpekerjaan,
						pendidikan:xpendidikan,
						tgl_didik:xtgl_didik,
						keterangan:xketerangan,
						tunjangan:xtunjangan 
					 });
				
				$('#popfm').form('clear');
		
	}
	
	/*****edit data*****/
	function getRowIndex(target){
        var tr = $(target).closest('tr.datagrid-row'); 
        return parseInt(tr.attr('datagrid-row-index'));
    }
    function editrow(target){
        $('#trd').datagrid('beginEdit', getRowIndex(target));
    }
    function deleterow(target){
		$('#trd').datagrid('endEdit', getRowIndex(target));
        $.messager.confirm('Confirm','Yakin ingin menghapus data keluarga?',function(r){
            if (r){
                $('#trd').datagrid('deleteRow', getRowIndex(target));
            }
        });
    }
    function saverow(target){
        $('#trd').datagrid('endEdit', getRowIndex(target));
    }
    function cancelrow(target){
        $('#trd').datagrid('cancelEdit', getRowIndex(target));
    }
	
	
	/********************/
    $(document).ready(function() {
		var lastIndex;
        $('#trd').datagrid({
			idField:'nip',
            width:1150,
            height:300,
            rownumbers:true,
            singleSelect:true,
            fitColumns:false,
            pagination:true,
			nowrap:true,
			remoteSort:true,
            url: '<?php echo base_url(); ?>master/C_Keluarga/trd_keluarga',
            loadMsg:"Tunggu Sebentar....!!",    
			frozenColumns:[[
            {field:'action',title:'Aksi',width:50,align:'center',
                formatter:function(value,row,index){
                    if (row.editing){
                        var s = '<a href="javascript:void(0)" onclick="saverow(this)"><i class="fa fa-check-square" aria-hidden="true"></i></a>&nbsp;&nbsp;';
                        var c = '<a href="javascript:void(0)" onclick="cancelrow(this)"><i class="fa fa-undo" aria-hidden="true"></i></a>';
                        return s+c;
                    } else {
                        var e = '<a href="javascript:void(0)" onclick="editrow(this)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;';
                        var d = '<a href="javascript:void(0)" onclick="deleterow(this)"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                        return d;
                    }
                }
            },
			]], 
            columns:[[
				{field:'nama_kel', title:'Nama', width:200, align:"left",editor:'text'},
                {field:'status_hubungan',title:'Status',width:70,align:"left",editor:'text'},
				{field:'tgl_lahir',title:'Tgl Lahir',width:100,align:"left"},
				{field:'pekerjaan',title:'Pekerjaan',width:150,align:"left",editor:'text'},
				{field:'pendidikan',title:'Pendidikan',width:150,align:"left",editor:'text'},
				{field:'tgl_didik',title:'Tgl Pendidikan',width:100,align:"left"},
				{field:'keterangan',title:'Keterangan',width:200,align:"left",editor:'text'},
				{field:'tunjangan',title:'Tunjangan',width:100,align:"left"}
                
            ]],
         onEndEdit:function(index,row){
            var ed = $(this).datagrid('getEditor', {
                index: index,
                field: 'nip'
            });
        },
		onBeforeEdit:function(index,row){
            row.editing = true;
            $(this).datagrid('refreshRow', index);
        },
        onAfterEdit:function(index,row){
            row.editing = false;
            $(this).datagrid('refreshRow', index);
        },
        onCancelEdit:function(index,row){
            row.editing = false;
            $(this).datagrid('refreshRow', index);
        }/*, 
		onClickRow:function(rowIndex){ 
        if (lastIndex != rowIndex){
            $(this).datagrid('endEdit', lastIndex);
        }
        lastIndex = rowIndex;
		},
		onBeginEdit:function(rowIndex){      
        var editors = $('#trd').datagrid('getEditors', rowIndex);
        var v1 = $(editors[2].target);
        var v2 = $(editors[3].target);
        var v3 = $(editors[4].target);
		
        v1.add(v2.add(v3)).numberbox({
            onChange:function(){
				var jumlah = v1.numberbox('getValue');
				var harga  = v2.numberbox('getValue');
                var cost = jumlah*harga;
                v3.numberbox('setValue',cost);
            }
        })
		},onLoadSuccess:function(data) {
			  var sum = 0;
			  for (i = 0; i < data.length; i++) {
				 sum+=data[i].total;
			  }
			  total_s1.textContent=number_format(sum,2,'.',',');
		}*/
		
        });

		
        $('#dg').datagrid({
            width: '150%',
            height: '200',
            rownumbers: true,
            remoteSort: false,
            nowrap: true,
            pagination: true,
            // url: ,
            loadMsg: 'Tunggu Sebentar ... !',
            columns:[[
                {field:'nama_kel', title:'Nama', width:200, align:"left"},
                {field:'status_hubungan',title:'Status',width:70,align:"left"},
				{field:'tgl_lahir',title:'Tgl Lahir',width:100,align:"left"},
				{field:'pekerjaan',title:'Pekerjaan',width:125,align:"left"},
				{field:'pendidikan',title:'Pendidikan',width:125,align:"left"},
				{field:'tgl_didik',title:'Tgl Pendidikan',width:100,align:"left"},
                {field:'keterangan',title:'Keterangan',width:200,align:"left"},
				{field:'tunjangan',title:'Tunjangan',width:100,align:"left"},
                {field:'ck',title:'',width:1,align:'center',checkbox:true}
            ]]

        });
		  
        $('#nip').combogrid({
            panelWidth:700,  
            idField:'nip',  
            textField:'nip',  
            mode:'remote',
            url: '<?php echo base_url(); ?>master/C_Keluarga/getNIP',
            columns:[[  
               {field:'nip',title:'NIK',width:200},  
               {field:'nama',title:'NAMA',width:400},
			   {field:'anak',title:'Jml Anak',width:100}  
            ]],  
            onSelect:function(rowIndex,rowData){
               kd = rowData.nip;
               nm = rowData.nama;
			   ank = rowData.anak;
			   $("#nama").textbox('setValue',nm);
			   $("#anak").textbox('setValue',ank);
		   } 
        });

        $('#status_hubungan').combogrid({
            panelWidth:350,  
            idField:'kd_hubungan',  
            textField:'nm_hubungan',  
            mode:'remote',
            url:'<?php echo base_url(); ?>master/C_Keluarga/getHub',  
            columns:[[  
               {field:'kd_hubungan',title:'KODE',width:100},  
               {field:'nm_hubungan',title:'NAMA',width:200}    
            ]]
        });
		
		$('#tgl_lahir').datepicker({
              format: 'dd-mm-yyyy',
			  autoclose: true
        });
		
		$('#tgl_didik').datepicker({
              format: 'dd-mm-yyyy',
			  autoclose: true
        });
		

    });
</script>