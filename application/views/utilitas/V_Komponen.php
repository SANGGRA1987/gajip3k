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
			localStorage.setItem('cpns1',cpns1);
			localStorage.setItem('cpns2',cpns2);
			localStorage.setItem('cpns3',cpns3);
			localStorage.setItem('cpns4',cpns4);
			localStorage.setItem('istri1',istri1);
			localStorage.setItem('istri2',istri2);
			localStorage.setItem('istri3',istri3);
			localStorage.setItem('istri4',istri4);
			localStorage.setItem('anak1',anak1);
			localStorage.setItem('anak2',anak2);
			localStorage.setItem('anak3',anak3);
			localStorage.setItem('anak4',anak4);
			localStorage.setItem('tpp1',tpp1);
			localStorage.setItem('tpp2',tpp2);
			localStorage.setItem('tpp3',tpp3);
			localStorage.setItem('tpp4',tpp4);
			localStorage.setItem('beras_kg1',beras_kg1);
			localStorage.setItem('beras_kg2',beras_kg2);
			localStorage.setItem('beras_kg3',beras_kg3);
			localStorage.setItem('beras_kg4',beras_kg4);
			localStorage.setItem('beras_rp1',beras_rp1);
			localStorage.setItem('beras_rp2',beras_rp2);
			localStorage.setItem('beras_rp3',beras_rp3);
			localStorage.setItem('beras_rp4',beras_rp4);
			localStorage.setItem('tdt1',tdt1);
			localStorage.setItem('tdt2',tdt2);
			localStorage.setItem('tdt3',tdt3);
			localStorage.setItem('tdt4',tdt4);
			localStorage.setItem('tirja1',tirja1);
			localStorage.setItem('tirja2',tirja2);
			localStorage.setItem('tirja3',tirja3);
			localStorage.setItem('tirja4',tirja4);
			localStorage.setItem('lain1',lain1);
			localStorage.setItem('lain2',lain2);
			localStorage.setItem('lain3',lain3);
			localStorage.setItem('lain4',lain4);
			localStorage.setItem('askes1',askes1);
			localStorage.setItem('askes2',askes2);
			localStorage.setItem('askes3',askes3);
			localStorage.setItem('askes4',askes4);
			localStorage.setItem('tirja11',tirja11);
			localStorage.setItem('tirja12',tirja12);
			localStorage.setItem('tirja13',tirja13);
			localStorage.setItem('tirja14',tirja14);
			localStorage.setItem('tirja21',tirja21);
			localStorage.setItem('tirja22',tirja22);
			localStorage.setItem('tirja23',tirja23);
			localStorage.setItem('tirja24',tirja24);
			localStorage.setItem('tirja31',tirja31);
			localStorage.setItem('tirja32',tirja32);
			localStorage.setItem('tirja33',tirja33);
			localStorage.setItem('tirja34',tirja34);
			localStorage.setItem('tirja41',tirja41);
			localStorage.setItem('tirja42',tirja42);
			localStorage.setItem('tirja43',tirja43);
			localStorage.setItem('tirja44',tirja44);
			localStorage.setItem('tirja45',tirja45);
			localStorage.setItem('iwp1',iwp1);
			localStorage.setItem('iwp2',iwp2);
			localStorage.setItem('iwp3',iwp3);
			localStorage.setItem('iwp4',iwp4);
			localStorage.setItem('korpri1',korpri1);
			localStorage.setItem('korpri2',korpri2);
			localStorage.setItem('korpri3',korpri3);
			localStorage.setItem('korpri4',korpri4);
			localStorage.setItem('tabrumah1',tabrumah1);
			localStorage.setItem('tabrumah2',tabrumah2);
			localStorage.setItem('tabrumah3',tabrumah3);
			localStorage.setItem('tabrumah4',tabrumah4);
			localStorage.setItem('potjab1',potjab1);
			localStorage.setItem('potjab2',potjab2);
			localStorage.setItem('potjab3',potjab3);
			localStorage.setItem('potjab4',potjab4);
			localStorage.setItem('potpens1',potpens1);
			localStorage.setItem('potpens2',potpens2);
			localStorage.setItem('potpens3',potpens3);
			localStorage.setItem('potpens4',potpens4);
			localStorage.setItem('tht1',tht1);
			localStorage.setItem('tht2',tht2);
			localStorage.setItem('tht3',tht3);
			localStorage.setItem('tht4',tht4);
			localStorage.setItem('ptkp',ptkp);
			localStorage.setItem('ptkp2',ptkp2);

			window.location.href = '<?php echo site_url('utilitas/C_Komponen/add'); ?>';
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
			url: '<?php echo base_url(); ?>utilitas/C_Komponen/load_header',
		    loadMsg:"Tunggu Sebentar....!!",
			columns:[[
				{field:'tirja1',title:'Tunj Gol I',width:'20%',align:"right"},
				{field:'tirja2',title:'Tunj Gol II',width:'20%',align:"right"},
	    		{field:'tirja3', title:'Tunj Gol III', width:'20%', align:"right"},
	    		{field:'tirja4', title:'Tunj Gol IV', width:'20%', align:"right"},
				{field:'ck',title:'',width:'5%',align:'center',checkbox:true}
			]],
			onSelect:function(rowIndex,rowData){
				id		    	= rowData.id ;
				cpns1		 	= rowData.cpns1;
				cpns2		 	= rowData.cpns2;
				cpns3		 	= rowData.cpns3;
				cpns4		 	= rowData.cpns4;
				istri1		 	= rowData.istri1;
				istri2		 	= rowData.istri2;
				istri3		 	= rowData.istri3;
				istri4		 	= rowData.istri4;
				anak1		 	= rowData.anak1;
				anak2		 	= rowData.anak2;
				anak3		 	= rowData.anak3;
				anak4		 	= rowData.anak4;
				tpp1		 	= rowData.tpp1;
				tpp2		 	= rowData.tpp2;
				tpp3		 	= rowData.tpp3;
				tpp4		 	= rowData.tpp4;
				beras_kg1		= rowData.beras_kg1;
				beras_kg2		= rowData.beras_kg2;
				beras_kg3		= rowData.beras_kg3;
				beras_kg4		= rowData.beras_kg4;
				beras_rp1		= rowData.beras_rp1;
				beras_rp2		= rowData.beras_rp2;
				beras_rp3		= rowData.beras_rp3;
				beras_rp4		= rowData.beras_rp4;
				tdt1		 	= rowData.tdt1;
				tdt2		 	= rowData.tdt2;
				tdt3		 	= rowData.tdt3;
				tdt4		 	= rowData.tdt4;
				tirja1		 	= rowData.tirja1;
				tirja2		 	= rowData.tirja2;
				tirja3		 	= rowData.tirja3;
				tirja4		 	= rowData.tirja4;
				lain1		 	= rowData.lain1;
				lain2		 	= rowData.lain2;
				lain3		 	= rowData.lain3;
				lain4		 	= rowData.lain4;
				askes1		 	= rowData.askes1;
				askes2		 	= rowData.askes2;
				askes3		 	= rowData.askes3;
				askes4		 	= rowData.askes4;
				tirja11		 	= rowData.tirja11;
				tirja12		 	= rowData.tirja12;
				tirja13		 	= rowData.tirja13;
				tirja14		 	= rowData.tirja14;
				tirja21		 	= rowData.tirja21;
				tirja22		 	= rowData.tirja22;
				tirja23		 	= rowData.tirja23;
				tirja24		 	= rowData.tirja24;
				tirja31		 	= rowData.tirja31;
				tirja32		 	= rowData.tirja32;
				tirja33		 	= rowData.tirja33;
				tirja34		 	= rowData.tirja34;
				tirja41		 	= rowData.tirja41;
				tirja42		 	= rowData.tirja42;
				tirja43		 	= rowData.tirja43;
				tirja44		 	= rowData.tirja44;
				tirja45		 	= rowData.tirja45;
				iwp1		 	= rowData.iwp1;
				iwp2		 	= rowData.iwp2;
				iwp3		 	= rowData.iwp3;
				iwp4		 	= rowData.iwp4;
				korpri1		 	= rowData.korpri1;
				korpri2		 	= rowData.korpri2;
				korpri3		 	= rowData.korpri3;
				korpri4		 	= rowData.korpri4;
				tabrumah1		= rowData.tabrumah1;
				tabrumah2		= rowData.tabrumah2;
				tabrumah3		= rowData.tabrumah3;
				tabrumah4		= rowData.tabrumah4;
				potjab1		 	= rowData.potjab1;
				potjab2		 	= rowData.potjab2;
				potjab3		 	= rowData.potjab3;
				potjab4		 	= rowData.potjab4;
				potpens1		= rowData.potpens1;
				potpens2		= rowData.potpens2;
				potpens3		= rowData.potpens3;
				potpens4		= rowData.potpens4;
				tht1		 	= rowData.tht1;
				tht2		 	= rowData.tht2;
				tht3		 	= rowData.tht3;
				tht4		 	= rowData.tht4;
				ptkp		 	= rowData.ptkp;
				ptkp2		 	= rowData.ptkp2;
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