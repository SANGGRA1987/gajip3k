<form action="<?php echo base_url()."proses/C_Laporan/form_b";?>" id="fm" method="post" novalidate style="margin:0;padding:10px 10px" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-5" style="padding-top: 3px;"><label>Satuan Kerja</label></div>
                    <div class="col-sm-2"><input id="L_satuan_kerja" name="kd_satker" type="text" class="easyui-textbox" style="width:100%;"  ></div>
                    <div class="col-sm-5"><input id="L_nm_satuan_kerja" name="nm_satker" readonly="" class="easyui-textbox" style="width:200%;" required="required" ></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-5" style="padding-top: 3px;"><label>Unit Kerja</label></div>
                    <div class="col-sm-2"><input id="L_dari" name="kd_unit" type="text" class="easyui-textbox" style="width:100%;" ></div>
					<div class="col-sm-5"><input id="L_nm_dari" name="nm_unit" readonly="" class="easyui-textbox" style="width:200%;" required="required"></div>
                </div>
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-5" style="padding-top: 3px;"><label></label></div>
                    <div class="col-sm-2"><input id="L_sampai" name="kd_unit2" type="text" class="easyui-textbox" style="width:100%;" ></div>
                    <div class="col-sm-5"><input id="L_nm_sampai" name="nm_unit2" readonly="" class="easyui-textbox" style="width:200%;" required="required"  ></div>
                </div>
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-5" style="padding-top: 3px;"><label>Golongan</label></div>
                    <div class="col-sm-2"><input id="L_gol" name="kd_golongan" type="text" class="easyui-textbox" style="width:100%;"  ></div>
                    <div class="col-sm-5"><input id="L_nm_gol" name="nm_golongan" readonly="" class="easyui-textbox" style="width:200%;" required="required" ></div>
                </div>
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-5" style="padding-top: 3px;"><label></label></div>
                    <div class="col-sm-3">
                        <button type="submit" id="cetak" name="coba" class="btn btn-success" style="width:100%;" ><i class="fa fa-desktop" ></i> CETAK BERGARIS</button>

                    </div>
                    <div class="col-sm-4">
                        <button type="submit" id="cetak" name="coba" class="btn btn-success" style="width:100%;" ><i class="fa fa-desktop" ></i> CETAK TIDAK BERGARIS</button>
                    </div>

                </div>

				<div class="col-sm-12" style="padding-bottom: 10px;">
				<div class="col-sm-3" style="padding-top: 3px;"><label></label></div>
				</div>								
            </div>            
        </div>
		
    </div>
</form>

<script type="text/javascript">
		
            
			$('#L_satuan_kerja').combogrid({
            panelWidth:700,  
            idField:'satkerja',  
            textField:'satkerja',  
            url:'<?php echo base_url(); ?>laporan/C_Lap_Pegawai/get_satker', 
            mode:'remote',
            columns:[[  
               {field:'satkerja',title:'Kode',width:100,align:'center'},  
               {field:'nm_satkerja',title:'Nama Satker',width:600}

            ]],
			onSelect:function(rowIndex,rowData){
               satkerja = rowData.satkerja;
			   nm_satkerja = rowData.nm_satkerja;
			   $("#L_nm_satuan_kerja").textbox('setValue',nm_satkerja);
			   //$('#L_nm_satuan_kerja').val(nm_satkerja);
			   $('#L_dari').combogrid({url:'<?php echo base_url(); ?>laporan/C_Lap_Pegawai/getUnit',

			   queryParams:({satkerja:satkerja})
			   });
               $('#L_dari').combogrid("enable","enable");
               $('#L_nm_dari').textbox("enable","enable");
			}
        });


			$('#L_dari').combogrid({
            panelWidth:400,  
            idField:'unit',  
            textField:'unit',  
            url:'<?php echo base_url(); ?>laporan/C_Lap_Pegawai/getUnit',
            mode:'remote',
            columns:[[  
                {field:'unit',title:'Kode Unit Kerja',width:100} ,    
               {field:'nm_unit',title:'Nama Unit Kerja',width:300}    
            ]],  
            onSelect:function(rowIndex,rowData){
			nm_unit = rowData.nm_unit;
			$('#L_nm_dari').textbox('setValue',nm_unit);	
			satkerja = satkerja;
			$('#L_sampai').combogrid({url:'<?php echo base_url(); ?>laporan/C_Lap_Pegawai/getUnit',	

			queryParams:({satkerja:satkerja})
			   });
            $('#L_sampai').combogrid("enable","enable");
            $('#L_nm_sampai').textbox("enable","enable");

            }  
        });


			$('#L_sampai').combogrid({
            panelWidth:400,  
            idField:'unit',  
            textField:'unit',
            url:'<?php echo base_url(); ?>laporan/C_Lap_Pegawai/getUnit',
            mode:'remote',
            columns:[[  
               {field:'unit',title:'Kode Unit Kerja',width:100},   
               {field:'nm_unit',title:'Nama Unit Kerja',width:300}    
            ]],  
            onSelect:function(rowIndex,rowData){
			nm_unit = rowData.nm_unit;
            $('#L_nm_sampai').textbox('setValue',nm_unit);
			satkerja = satkerja;
            $('#L_sampai').combogrid({url:'<?php echo base_url(); ?>laporan/C_Lap_Pegawai/getUnit', 
                 });
            $('#L_gol').combogrid("enable","enable");
               $('#L_nm_gol').textbox("enable","enable");
            }  
        });		

			$('#L_gol').combogrid({
            panelWidth:100,  
            idField:'id',  
            textField:'id',  
            url:'<?php echo base_url(); ?>laporan/C_Lap_Pegawai/get_golongan', 
            mode:'remote',
            columns:[[  
               {field:'id',title:'Kode Golongan',width:100}    
            ]],
            onSelect:function(rowIndex,rowData){
               id = rowData.id;
               nama_golongan = rowData.nama_golongan;
               $("#L_nm_gol").textbox('setValue',nama_golongan);
               //$('#L_nm_satuan_kerja').val(nm_satkerja);
               $('#L_gol').combogrid({url:'<?php echo base_url(); ?>laporan/C_Lap_Pegawai/get_golongan',

               queryParams:({golongan:golongan})
               });

            }

        });

            $('#L_dari').combogrid("disable","disable");
            $('#L_sampai').combogrid("disable","disable");
            $('#L_gol').combogrid("disable","disable");
            

</script>