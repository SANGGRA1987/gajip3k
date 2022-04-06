<form action="<?php echo base_url()."laporan/C_do_beras/do_beras";?>" target="_blank" id="fm" method="post" novalidate style="margin:0;padding:10px 10px" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <div style="margin-bottom:20px">

                <div class="col-sm-12" style="padding-bottom: 20px;" id="satkerja">
                    <div class="col-sm-2" style="padding-top: 3px;"><label>Satuan Kerja</label></div>
                    <div class="col-sm-4"><input id="kdskpd1" name="kd_skpd1" type="text" class="easyui-textbox" style="width:110%;" ></div>
                    <div class="col-sm-6"><input id="nmskpd1" name="nm_skpd1" readonly="" class="easyui-textbox" style="width:300%;" ></div>
                    
                </div>

                <div class="col-sm-12" style="padding-bottom: 20px;">
                    <div class="col-sm-2" style="padding-top: 3px;"><label></label></div>
                    <div class="col-sm-4" ><button type="submit" id="cetak" value="cetak" name="cetak" class="btn btn-success" style="width:120%;" ><i class="fa fa-desktop" ></i> CETAK</button></div>
                
                

                </div>                              
            </div>            
        </div>
        
    </div>
</form>
<script type="text/javascript">
		

			$('#kdskpd1').combogrid({
            panelWidth:1200,  
            idField:'satkerja',  
            textField:'satkerja',  
            url:'<?php echo base_url(); ?>laporan/C_Lap_Pegawai/get_skpd', 
            mode:'remote',
            columns:[[  
               {field:'satkerja',title:'Satkerja',width:200},  
               {field:'nm_satkerja',title:'Nama Satkerja',width:1000}

            ]],
            onSelect:function(rowIndex,rowData){
               satkerja = rowData.satkerja;
               nm_satkerja = rowData.nm_satkerja;
               $("#nmskpd1").textbox('setValue',nm_satkerja);
               //$('#L_nm_satuan_kerja').val(nm_satkerja);
               $('#kdskpd1').combogrid({url:'<?php echo base_url(); ?>laporan/C_Lap_Pegawai/get_skpd',

               queryParams:({satkerja:satkerja})
               });
               $('#L_kdskpd_sampai').combogrid("enable","enable");
            }
        });

</script>