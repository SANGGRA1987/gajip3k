<div class="row">
	<div class="col-sm-12">
		<div class="box-header">
			<div style="padding-left: 0px !important;" class="col-sm-2">
				<button id="tambah"  type="button" class="btn btn-default" onClick="javascript:tambah();"><span><i class="fa fa-plus"></i></span> Tambah</button>  
				<div class="help-block with-errors" id="error_custom1"></div>
			</div>

			<div style="padding-left: 0px !important;" class="col-sm-2">
				<button id="detail"  type="button" class="btn btn-default" onClick="javascript:detail();"><span><i class="fa fa-info-circle"></i></span> Detail</button>  
				<div class="help-block with-errors" id="error_custom1"></div>
			</div>
			<div style="padding-left: 0px !important;" class="col-sm-2">
				<button id="hapus" type="button" class="btn btn-default" onClick="javascript:hapus();"><span><i class="fa fa-trash"></i></span> Hapus</button>  
				<div class="help-block with-errors" id="error_custom1"></div>
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
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<table id="dg"></table>
	</div>
</div>


<script type="text/javascript">

	function tambah() {
		localStorage.setItem('status', 'tambah');
		window.location.href = '<?php echo site_url('master/C_Keluarga/add'); ?>';
	}

	function detail() {	
		localStorage.setItem('status', 'detail');
		localStorage.setItem('nip', nip);
		localStorage.setItem('nama', nama);
		localStorage.setItem('anak', anak);
		window.location.href = '<?php echo site_url('master/C_Keluarga/add'); ?>';
	}	

	

	$(document).ready(function() {
		$("#ubah").attr("disabled", "disabled");
		$("#hapus").attr("disabled", "disabled");
		$("#detail").attr("disabled", "disabled");

		$('#dg').datagrid({
			width:1100,
			height:500,
			rownumbers:true,
			remoteSort:false,
			nowrap:false,
			fitColumns:true,
			pagination:true,
			url: '<?php echo base_url(); ?>master/C_Keluarga/load_header',
		    loadMsg:"Tunggu Sebentar....!!",
			columns:[[	    		
				{field:'nip',title:'NIK',width:'30%',align:"left"},
				{field:'nama',title:'Nama',width:'50%',align:"left"},
	    		{field:'anak',title:'Jumlah Anak',width:'15%',align:"center"},
	    		{field:'ck',title:'',width:'10%',align:'center',checkbox:true}
			]],
			onSelect:function(rowIndex,rowData){
				nip = rowData.nip;
				nama = rowData.nama;
				anak = rowData.anak;
				cekjumlah();	
			},
			onCheck:function(rowIndex,rowData){
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

	function hapus(){
		var row = $('#dg').datagrid('getSelections');
		var ids = [];
		for(var i=0; i<row.length; i++){ids.push(row[i].nip);}
		var nip = ids.join('#');
		if (row){
			$.messager.confirm('Konfirmasi','Yakin ingin menghapus data keluarga dari NIK. '+nip+' ?',function(r){
				if (r){
					$.post('<?php echo base_url(); ?>master/C_Keluarga/hapus',
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
	
	
	function cari(){
		var key = $('#keyword').val();
			$(function(){
			 $('#dg').datagrid({
				url: '<?php echo base_url();?>master/C_Keluarga/load_header',
				queryParams:({key:key})
				});        
			 });
	}
    </script>