<div class="row">
	<div class="col-sm-12">
		<div class="box-header">
			<div style="padding-left: 0px !important;" class="col-sm-2">
				<button id="tambah"  type="button" class="btn btn-default" onClick="javascript:newUser();"><span><i class="fa fa-plus"></i></span> Tambah</button>  
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

	$(document).ready(function() {
		$("#hapus").attr("disabled", "disabled");
		$("#detail").attr("disabled", "disabled");
		$('#dg').datagrid({
			width:1000,
			height:400,
			rownumbers:true,
			remoteSort:false,
			nowrap:false,
			fitColumns:true,
			pagination:true,
			url: '<?php echo base_url(); ?>utilitas/C_transfer/load_header',
		    loadMsg:"Tunggu Sebentar....!!",
			columns:[[
				{field:'no_kirim',title:'Nomor Transfer',width:100,align:"center"},
				{field:'tgl_kirim',title:'Tanggal Transfer',width:50,align:"center"},
				{field:'bulan',title:'Bulan Transfer',width:50,align:"center"},
				{field:'total1',title:'Total',width:50, align:"right"},
	    		{field:'ck',title:'',width:'10%',align:'center',checkbox:true}
			]],
			onSelect:function(rowIndex,rowData){
				no_kirim=rowData.no_kirim;
				tgl_kirim=rowData.tgl_kirim;
				bulan=rowData.bulan;
				total1=rowData.total1;
				total=rowData.total;		
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

	});

	function detail() {		
		localStorage.setItem('status', 'detail');
		localStorage.setItem('no_kirim',no_kirim);
		localStorage.setItem('tgl_kirim',tgl_kirim);
		localStorage.setItem('bulan',bulan);			
		window.location.href = '<?php echo site_url('utilitas/C_transfer/add'); ?>';
	}

	function newUser() {
		localStorage.setItem('status', 'tambah');
		window.location.href = '<?php echo site_url('utilitas/C_transfer/add'); ?>';
	}

	
	function hapus() {
		var row = $('#dg').datagrid('getSelections');
		var ids = [];
		for(var i=0; i<row.length; i++){ids.push(row[i].no_kirim);}
		var no_kirim = ids.join('#');
		
		if ( row ){
			$.messager.confirm('Konfirmasi','Yakin ingin menghapus NO TRANSFER  '+no_kirim+' ?',function(r){
				if (r){
					$.post('<?php echo base_url(); ?>utilitas/C_transfer/hapus',
						{no_kirim:no_kirim},function(result){
						if (result.pesan){
							iziToast.info({
								title: 'OK',
								message: 'Data Berhasil Dihapus.!!',
							});
							$('#dg').datagrid('reload'); 
							$("#ubah").attr("disabled", "disabled");
							$("#hapus").attr("disabled", "disabled");
						} else {
							iziToast.error({
								title: 'Error',
								message: 'Data Gagal Dihapus.!',
							});
							$("#ubah").attr("disabled", "disabled");
							$("#hapus").attr("disabled", "disabled");
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
				url: '<?php echo base_url();?>utilitas/C_transfer/load_header',
				queryParams:({key:key})
				});        
			 });
	}
	
	//================@Naga========================  

    </script>