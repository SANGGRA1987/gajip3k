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
			width:1200,
			height:400,
			rownumbers:true,
			remoteSort:false,
			nowrap:false,
			fitColumns:true,
			pagination:true,
			url: '<?php echo base_url(); ?>transaksi/C_SPM_gaji13/load_header',
		    loadMsg:"Tunggu Sebentar....!!",
			columns:[[
				{field:'no_spp',title:'No SPP',width:'10%',align:"left",hidden:'true'},
				{field:'no_spm',title:'No SPM',width:'13%',align:"left"},
	    		{field:'tgl_spm',title:'Tanggal',width:'10%',align:"center"},
				{field:'kd_skpd',title:'Kode SKPD',width:'10%',align:"center"},
	    		{field:'keperluan',title:'Uraian',width:'50%',align:"left"},
	    		{field:'nilai1', title:'Jumlah', width:'15%', align:"right"},
	    		{field:'ck',title:'',width:'10%',align:'center',checkbox:true}
			]],
			onSelect:function(rowIndex,rowData){
				id          =rowData.id;
				no_spm    	=rowData.no_spm;
				tgl_spm     =rowData.tgl_spm;
				keperluan   =rowData.keperluan;
				nilai       =rowData.nilai;	
				no_spp      =rowData.no_spp;
				no_spd      =rowData.no_spd;
				no_rek      =rowData.no_rek;
				npwp        =rowData.npwp;				
				kd_skpd     =rowData.kd_skpd;
				nm_skpd     =rowData.nm_skpd;
				bayar_kepada =rowData.bayar_kepada;		
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
		localStorage.setItem('no_spm',no_spm);
		localStorage.setItem('tgl_spm',tgl_spm);
		localStorage.setItem('keperluan',keperluan);
		localStorage.setItem('nilai',nilai);
		localStorage.setItem('no_spp',no_spp);
		localStorage.setItem('no_spd',no_spd);
		localStorage.setItem('no_rek',no_rek);
		localStorage.setItem('npwp',npwp);	
		localStorage.setItem('kd_skpd',kd_skpd);
		localStorage.setItem('nm_skpd',nm_skpd);
		localStorage.setItem('bayar_kepada',bayar_kepada);			
		window.location.href = '<?php echo site_url('transaksi/C_SPM_gaji13/add'); ?>';
	}

	function newUser() {
		localStorage.setItem('status', 'tambah');
		window.location.href = '<?php echo site_url('transaksi/C_SPM_gaji13/add'); ?>';
	}

	
	function hapus() {
		var row = $('#dg').datagrid('getSelections');
		var ids = [];
		var idt = [];
		for(var i=0; i<row.length; i++){ids.push(row[i].no_spm);idt.push(row[i].no_spp);}
		var no_spm = ids.join('#');
		var no_spp = idt.join('#');
		
		if ( row ){
			$.messager.confirm('Konfirmasi','Yakin ingin menghapus NO SPM  '+no_spm+' ?',function(r){
				if (r){
					$.post('<?php echo base_url(); ?>transaksi/C_SPM_gaji13/hapus',
						{no_spm:no_spm,no_spp:no_spp},function(result){
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
				url: '<?php echo base_url();?>transaksi/C_SPM_gaji13/load_header',
				queryParams:({key:key})
				});        
			 });
	}
	
	//================@Naga========================  

    </script>