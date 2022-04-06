<form id="fm" method="post" novalidate style="margin:0;padding:10px 10px" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
             <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-3" style="padding-top: 3px;"><label>No. ADVIS</label></div>
                    <div class="col-sm-6"><input id="no_advise" name="no_advise" type="text" class="easyui-textbox" style="width:100%;" ></div>
					<div class="col-sm-3"></div>
                </div>
            </div>						 			          
        </div>
		<div class="col-md-6">
			<div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-3" style="padding-top: 3px;"><label>Tanggal ADVIS</label></div>
                    <div class="col-sm-6">
                        <div class="input-group" style="width:80%;">
                          <input id="tanggal" name="tanggal" type="text" class="form-control" style="width:100%;" >
                           <span class="input-group-addon" > <i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>
					<div class="col-sm-3"></div>
                </div>
            </div>
		</div>
    </div>
</form>

<div style="padding-bottom: 20px;">
    <button type="button" class="btn btn-primary btn-lg btn-block" style="width:100%" onClick="javascript:tambah_sp2d();"><b>TAMBAH SP2D</b></button>
</div>

<table id="dg" name="dg"><h4></h4></table>
<div class="row" id="sum_show">
    <div class="col-md-3 text-right">
        <h4><span>Total Advis: </span></h4>
    </div>
    <div class="col-md-8 text-right">
        <h4><span id="total_s1"></span></h4>
    </div>
</div>

<div style="padding-top: 10px;" class="row">
    <div class="col-sm-2 col-sm-offset-4">
        <button type="button" class="btn btn-default btn-lg btn-block" onClick="javascript:saveData()">Simpan</button>
    </div>
    <div class="col-sm-2 col-sm-offset">
        <button type="button" class="btn btn-default btn-lg btn-block" onClick="javascript:back();">Kembali</button>
    </div>
	    <div id="progressFile" class="easyui-progressbar" style="width:50%;" hidden="true"></div>
</div>

<div id="dlg" class="easyui-dialog" style="width:1100px" closed="true" buttons="#dlg-buttons">
        <div class="row" style="width: 100%">            
            <div class="col-md-8">
                <div class="row">                    
                        <table id="dg1"></table>
                </div>
            </div>
        </div>
</div>

<div id="dlg-buttons">   
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" onclick="savedetail()" style="width:90px">Tampung</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-undo" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Kembali</a>
</div>

<script type="text/javascript" src="<?php echo site_url('assets/easyui/numberFormat.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/easyui/autoCurrency.js') ?>"></script>
<script type="text/javascript">

$(document).ready(function() {
           $('#tanggal').datepicker({
              format: 'dd-mm-yyyy',
              autoclose: true
        	});

        	//$('#tanggal').val(getToday());
		
        $('#dg').datagrid({
            idField:'id',
            width: '1150',
            height: '400',
            nowrap: true,
        pagination: true,
        rownumbers: true,
        fitColumns: true,
        singleSelect: true,
        remoteSort: true,  
        showFooter: true,           
            loadMsg: 'Tunggu Sebentar ... !',            
            columns:[[
                {field:'no_sp2d',title:'Nomor SP2D',width:80},                
				{field:'tgl_sp2d', title:'tgl_sp2d',width:50,align:"center"},
				{field:'kd_skpd',title:'Kode SKPD',	width:50,align:"center"},
				{field:'nm_skpd',title:'Nama SKPD',width:150, align:"left"},
				{field:'nospm',title:'No SPM',width:50, align:"left"},
				{field:'nmrekan',title:'Nama Rekan',width:5, align:"right",hidden:"true"},
				{field:'nilai1',title:'Nilai',width:80, align:"right"}
            ]],
            onEndEdit:function(index,row){
            var ed = $(this).datagrid('getEditor', {
                index: index,
                field: 'no_advise'
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
            }
        });		
    });
	
	function load_detail(no_advise) {
        $('#dg').datagrid({
            url:'<?php echo site_url('transaksi/C_ADVISE/load_detail') ?>',
            idField:'id',
            width: '1150',
            height: '400',
            nowrap: true,
        pagination: true,
        rownumbers: true,
        fitColumns: true,
        singleSelect: true,
        remoteSort: true,  
        queryParams:{no: no_advise},
            loadMsg: 'Tunggu Sebentar ... !',
            columns:[[
				{field:'no_sp2d',title:'Nomor SP2D',width:80},                
				{field:'tgl_sp2d', title:'TGL SP2D',width:50,align:"center"},
				{field:'kd_skpd',title:'Kode SKPD',	width:50,align:"center"},
				{field:'nm_skpd',title:'Nama SKPD',width:150, align:"left"},
				{field:'nospm',title:'No SPM',width:50, align:"left"},
				{field:'nmrekan',title:'Nama Rekan',width:5, align:"right",hidden:"true"},
				{field:'nilai1',title:'Nilai',width:80, align:"right"}
            ]],
            onEndEdit:function(index,row){
            var ed = $(this).datagrid('getEditor', {
                index: index,
                field: 'no_advise'
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
            }
        });
        
    }
	
	function get_total(no_advise){
			$.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>transaksi/C_ADVISE/ambil_total',
                    dataType:"json",
                    data:({no_advise:no_advise}),
                    success:function(data){
							$.each(data,function(i,n){ 
								ctotal_pot  = n['total_pot'];
								$("#total_s1").text(number_format(ctotal_pot,2,'.',','));							  
						  	});	
														
                    }					
                });
	}
	
		
	function tambah_sp2d(){  
		var no_advise   = $('#no_advise').val();
		var ctanggal   = $('#tanggal').val();
		if(no_advise==''){
			iziToast.error({
				title: 'Error',
				message: 'Nomor Advise Tidak boleh Kosong',
			});
			return
		}		
		$('#dlg').dialog('open').dialog('center').dialog('setTitle','Pilih SP2D');		
		$("#dg").datagrid("unselectAll");
		$("#dg").datagrid("selectAll");
		var rows   = $("#dg").datagrid("getSelections");
		var jrows  = rows.length ;
		zfnosp  = '';
		zknosp = '';
			
		for (z=0;z<jrows;z++){
		   zknosp=rows[z].no_sp2d;
		   if ( z == 0 ){
			   zfnosp  = zknosp ;
		   } else {
			   zfnosp  = zfnosp+"'"+','+"'"+zknosp ;
		   }
		}
		
		$('#dg1').datagrid({
            url:'<?php echo site_url('transaksi/C_ADVISE/ambil_sp2d_advis') ?>',
            idField:'id',
            width: '1100',
            height: '400',
			rownumbers:true,
			remoteSort:false,
			nowrap:false,
			fitColumns:true,
			pagination:true, 
        	queryParams:{no: zfnosp},
            loadMsg: 'Tunggu Sebentar ... !',
            columns:[[
				{field:'no_sp2d',title:'Nomor SP2D',width:80,align:"left"},                
				{field:'tgl_sp2d',title:'TGL SP2D',width:30,align:"center"},
				{field:'kd_skpd',title:'Kode SKPD',	width:30,align:"center"},
				{field:'nm_skpd',title:'Nama SKPD',width:100, align:"left"},
				{field:'nospm',title:'No SPM',width:50, align:"left"},
				{field:'nmrekan',title:'Nama Rekan',width:5, align:"right",hidden:"true"},
				{field:'nilai1',title:'Nilai',width:80, align:"right"},
				{field:'ck',title:'',width:5,align:'center',checkbox:true}
            ]],
			onSelect:function(rowIndex,rowData){
				no_sp2d=rowData.no_sp2d;
				tgl_sp2d=rowData.tgl_sp2d;
				kd_skpd=rowData.kd_skpd;
				nm_skpd=rowData.nm_skpd;
				nospm=rowData.nospm;
				nmrekan=rowData.nmrekan;
				nilai1=rowData.nilai1;		
				cekjumlah();
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
    } 
	
	window.onload = function(){
        var status  = localStorage.getItem('status');
        if (status == 'detail') {	
		var no_advise 	= localStorage.getItem('no_advise');		
		var tgl_advise 	= localStorage.getItem('tgl_advise');
				
		$("#no_advise").textbox('setValue',no_advise);
		$("#tanggal").val(tgl_advise);		
		
		load_detail(no_advise);
		get_total(no_advise);
				
        } else {
		}
    }

    function back() {
        localStorage.clear();
        window.location.href = "<?php echo base_url(); ?>transaksi/C_ADVISE";
    }

    function getToday() {
      var d = new Date();
      var month = d.getMonth()+1;
      var day = d.getDate();
      var output = ((''+day).length<2 ? '0' : '') + day + '-' +
                   ((''+month).length<2 ? '0' : '') + month + '-' +
                   d.getFullYear();
      return output;
    }

    function tanggal_ind(tgl){
        var tahun   =  tgl.substr(0,4);
        var bulan   = tgl.substr(5,2);
        var tanggal =  tgl.substr(8,2);
        var jadi = tanggal+'-'+bulan+'-'+tahun;
        return jadi;  
    }
	
	function saveData(){
        var no_advise   = $('#no_advise').val();
		var tanggal     = $('#tanggal').val();		
        var data1       = $('#dg').datagrid('getRows');
		var status      = localStorage.getItem('status');
		var total       = angka($('#total_s1').text());
		if(no_advise==''){
			iziToast.error({
				title: 'Error',
				message: 'No Advise Tidak boleh Kosong',
			});
			return
		}
		if(tanggal==''){
			iziToast.error({
				title: 'Error',
				message: 'Tanggal Advise Tidak boleh Kosong',
			});
			return
		}		
		
        $.post('<?php echo base_url(); ?>transaksi/C_ADVISE/saveData', {detail: JSON.stringify(data1),no_advise:no_advise,tanggal:tanggal,status:status,total:total}, 
		function(result) {
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

        if (status=='tambah'){
            kosong_isi();
        }
    }
	
	function kosong_isi(){
			$("#no_advise").textbox('setValue','');
            //$('#tanggal').val(getToday());
            $("#total_s1").text('');		
            $('#dg').datagrid('loadData', {"rows":[]});
    }
	
	function savedetail(){
			var ids  = [];  
			var total_detail=0;
			var rows = $('#dg1').datagrid('getSelections'); 
			for(var i=0; i<rows.length; i++){  
	
				var cno_sp2d  = rows[i].no_sp2d;
				var ctgl_sp2d = rows[i].tgl_sp2d;
				var ckd_skpd = rows[i].kd_skpd;
				var cnm_skpd = rows[i].nm_skpd;
				var cspm = rows[i].nospm;
				//var cnmrekan = rows[i].nmrekan;
				var cnilai = rows[i].nilai;
				var cnilai1 = number_format(rows[i].nilai,2,',','.');
				$("#dg").datagrid("unselectAll");
				$('#dg').datagrid('selectAll');
				var rows_2 = $('#dg').datagrid('getSelections') ;
					jgrid  = rows_2.length ;
				var id     = jgrid  ;
				
				$('#dg').datagrid('appendRow',{no_sp2d:cno_sp2d,tgl_sp2d:ctgl_sp2d,kd_skpd:ckd_skpd,nm_skpd:cnm_skpd,nilai:cnilai,nilai1:cnilai1,nospm:cspm});
				$("#dg").datagrid("unselectAll");
				
				var total_rinci = angka(cnilai);
				total_detail = total_detail + total_rinci;
				$("#total_s1").text(number_format(total_detail,2,'.',','));
			} 
    }
    
</script>