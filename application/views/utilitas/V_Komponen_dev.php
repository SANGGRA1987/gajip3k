<div class="row">
	<div class="col-sm-12">
		<div class="box-header">
			<div style="padding-left: 0px !important;" class="col-sm-2">
				<button id="detail"  type="button" class="btn btn-default" onClick="javascript:detail();"><span><i class="fa fa-info-circle"></i></span> Detail</button>  
				<div class="help-block with-errors" id="error_custom1"></div>
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

	function detail() {
		localStorage.setItem('status', 'detail');	
		localStorage.setItem('beras_kg',beras_kg);
		localStorage.setItem('beras_rp',beras_rp);
		localStorage.setItem('iwp',iwp);
		localStorage.setItem('potpens',potpens);
		localStorage.setItem('tht',tht);
		localStorage.setItem('ptkp',ptkp);
		localStorage.setItem('askes',askes);
		localStorage.setItem('ptkp2',ptkp2);
		localStorage.setItem('jkk',jkk);
		localStorage.setItem('jkm',jkm);
		localStorage.setItem('istri',istri);
		localStorage.setItem('anak',anak);
		window.location.href = '<?php echo site_url('utilitas/C_Komponen_dev/add'); ?>';
	}	

	$(document).ready(function() {
		$("#detail").attr("disabled", "disabled");
		$('#dg').datagrid({
			width:1150,
			height:400,
			rownumbers:true,
			remoteSort:false,
			nowrap:false,
			fitColumns:true,
			pagination:true,
			url: '<?php echo base_url(); ?>utilitas/C_Komponen_dev/load_header',
		    loadMsg:"Tunggu Sebentar....!!",
			columns:[[
				{field:'jkk',title:'JKK',width:'20%',align:"right"},
				{field:'jkm',title:'JKM',width:'20%',align:"right"},
	    		{field:'askes', title:'ASKES', width:'20%', align:"right"},
	    		{field:'tht', title:'THT', width:'20%', align:"right"},
				{field:'ptkp', title:'PTKP', width:'20%', align:"right"},
				{field:'ck',title:'',width:'5%',align:'center',checkbox:true}
			]],
			onSelect:function(rowIndex,rowData){
				id		    	= rowData.id ;
				beras_kg		= rowData.beras_kg;
				beras_rp		= rowData.beras_rp;
				iwp				= rowData.iwp;
				potpens			= rowData.potpens;
				tht				= rowData.tht;
				ptkp			= rowData.ptkp;
				askes			= rowData.askes;
				ptkp2			= rowData.ptkp2;
				jkk				= rowData.jkk;
				jkm				= rowData.jkm;
				istri			= rowData.istri;
				anak			= rowData.anak;				
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
	
    </script>