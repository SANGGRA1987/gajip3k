
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade in active" id="tab_penghasilan" role="tabpanel" aria-labelledby="penghasilan-tab">
    <form id="form_penghasilan">
		<div class="col-sm-10" style="padding: 10px 0px 10px 0">
			<div class="col-sm-2" style="padding-top: 8px;">NIP</div>
			<div class="col-sm-4"><select id="nip" class="form-control" style="width: 100%"></select></div>
		</div>
		<div class="col-sm-10" style="padding: 10px 0px 10px 0">
			<div class="col-sm-2" style="padding-top: 8px;">NIP LAMA</div>
			<div class="col-sm-4" style="padding-top: 6px;"><span id="nip_lama"></span></div>
		</div>
		<div class="col-sm-10" style="padding: 10px 0px 10px 0">
			<div class="col-sm-2" style="padding-top: 8px;">NAMA</div>
			<div class="col-sm-8" style="padding-top: 6px;"><span id="nama"></span></div>
		</div>
		<div class="col-sm-10" style="padding: 10px 0px 10px 0">
			<div class="col-sm-2" style="padding-top: 8px;">SKPD</div>
			<div class="col-sm-2" style="padding-top: 6px;"><span id="satkerja"></span></div>
			<div class="col-sm-6" style="padding-top: 6px;"><span id="nm_satkerja"></span></div>
		</div>
		<div class="col-sm-10" style="padding: 10px 0px 10px 0">
			<div class="col-sm-2" style="padding-top: 8px;">UNIT</div>
			<div class="col-sm-2" style="padding-top: 6px;"><span id="unit"></span></div>
			<div class="col-sm-6" style="padding-top: 6px;"><span id="nm_unit"></span></div>
		</div>
		<div class="col-sm-10" style="padding: 10px 0px 10px 0">
			<div class="col-sm-2" style="padding-top: 8px;">Dari Bulan</div>
			<div class="col-sm-1"><input id="bulan" class="form-control" style="width: 100%"></div>
			<div class="col-sm-2"><input type="text" class="form-control input-sm own-radius" id="tahun" placeholder="Pilih Tahun"></div>
		</div>
		<div class="col-sm-10" style="padding: 10px 0px 10px 0">
			<div class="col-sm-2" style="padding-top: 8px;">Sampai Dengan</div>
			<div class="col-sm-1"><input id="bulan_2" class="form-control" style="width: 100%"></div>
			<div class="col-sm-2"><input type="text" class="form-control input-sm own-radius" id="tahun_2" placeholder="Pilih Tahun"></div>
		</div>

    </form>
    <div class="col-sm-10" style="padding: 10px 0px 10px 0">
      <div class="col-sm-2" style="padding-top: 8px;">Tanggal Cetak</div>
      <div class="col-sm-4">
        <input class="form-control input-sm own-radius" type="text" id="datepicker" placeholder="Masukan Tanggal Cetak" readonly>
      </div>
    </div>  
      <div class="col-sm-10">
        <div class="col-sm-2"></div>
        <div class="col-sm-7" style="padding: 10px 0 10px 5px">
		  <button type="button" class="btn btn-default" style="width: 150px" id="cetakPdf" ><i class="fa fa-file-pdf-o"></i>&nbsp;Cetak PDF</button>
          <button type="button" class="btn btn-success" style="width: 150px" id="cetakExcel" ><i class="fa fa-file-excel-o"></i>Cetak Excel</button>
         <!-- <button type="button" class="btn btn-default" style="width: 110px" id="cetakExcel" ><i class="fa fa-file-excel-o"></i> Cetak Excel</button>-->
          <!--<button type="button" class="btn btn-default" style="width: 110px" id="cetakWord" ><i class="fa fa-file-word-o"></i> Cetak Word</button>-->
        <!--  <button type="button" class="btn btn-default" style="width: 110px" ><i class="fa fa-reply"></i> Kembali</button>-->
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">  

  var jnsCetak = '';
  var urll     = "<?php echo site_url(); ?>laporan/lap_kartugaji/C_kartugaji/cetakLaporan";

  var _nip = $('#nip');
  var _nama = $('#nama');
  var _nip_lama = $('#nip_lama');
  var _satkerja = $('#satkerja');
  var _nm_satkerja = $('#nm_satkerja');
  var _unit = $('#unit');
  var _nm_unit = $('#nm_unit');
  var _bulan = $("bulan");
  var _bulan_2 = $("bulan_2");
  var _tglcetak = $('#datepicker');
  var _tahun   = $('#tahun');
  var _tahun_2   = $('#tahun_2');

  function jenisCetak(val){
    jnsCetak = val;
  }

  function errorShow() {
    iziToast.error({
      message: 'Anda belum mengisi semua field',
      position: 'topRight',
      buttons: [
          ['<button>Keluar</button>', function (instance, toast) {
              instance.hide({
                  transitionOut: 'fadeOutUp',
              }, toast, 'close', 'btn2');
          }]
      ],
    });
  }


  $(document).ready(function() { 
  
	getTahunPicker();
	   
	$('#datepicker').datepicker({
              format: 'dd-mm-yyyy',
			  autoclose: true
    });
	
	$('#datepicker').val(getToday());
		
    $("#nip").combogrid({
      panelWidth:1000,  
      idField:'nip',
      textField:'nip',
      url:'<?php echo base_url('laporan/lap_kartugaji/C_kartugaji/getpenghasilan') ?>',
      columns:[[
          {field:'nip',title:'Nip', width:'200'},
          {field:'nama',title:'Nama', width:'300'},
		  {field:'nm_satkerja',title:'SKPD', width:'500'},
      ]],
      fitColumns: true,
      onSelect: function(index, row){
        document.getElementById('nama').textContent = row.nama;
		document.getElementById('nip_lama').textContent = row.nip_lama;
		document.getElementById('satkerja').textContent = row.satkerja;
		document.getElementById('nm_satkerja').textContent = row.nm_satkerja;
		document.getElementById('unit').textContent = row.unit;
		document.getElementById('nm_unit').textContent = row.nm_unit;

      }
    }).combogrid('textbox').attr('placeholder','Pilih Nip');   

	$("#bulan").combogrid({
      panelWidth:200,  
      idField:'id',
      textField:'id',
      url:'<?php echo base_url('laporan/lap_kartugaji/C_kartugaji/getBulan') ?>',
      columns:[[
          {field:'id',title:'Kode', width:'50'},
          {field:'text',title:'Nama', width:'130'},
      ]]     
    }); 	
	
	$("#bulan_2").combogrid({
      panelWidth:200,  
      idField:'id',
      textField:'id',
      url:'<?php echo base_url('laporan/lap_kartugaji/C_kartugaji/getBulan') ?>',
      columns:[[
          {field:'id',title:'Kode', width:'50'},
          {field:'text',title:'Nama', width:'130'},
      ]]    
    }); 

    $('#cetakPdf').click(function(){		
		var tglcetak = _tglcetak.val();		
		var a= tglcetak.length;
        var bulan_tglcetak = tglcetak.substr(3,2);
		var tahun = $('#tahun').val();
		var tahun_2 = $('#tahun_2').val();
		var cbulan = $('#bulan').combogrid('getValue');
		var cbulan_2 = $('#bulan_2').combogrid('getValue');
		if (tahun > tahun_2){
			alert('Tahun Pertama Tidak Boleh Lebih Besar Dari Tahun Kedua');
			return
		}

		if ( jnsCetak == 0 ) {
			if ( _nip.combogrid('getValue') == '') {
			  errorShow();
			} else {
			lc = '?nip='+_nip.combogrid('getValue')+'&nama='+_nama.text()+'&tgl_cetak='+_tglcetak.val()+'&bulan_tglcetak='+bulan_tglcetak+'&nip_lama='+_nip_lama.text()+'&satkerja='+_satkerja.text()+'&nm_satkerja='+_nm_satkerja.text()+'&unit='+_unit.text()+'&nm_unit='+_nm_unit.text()+'&tahun='+_tahun.val()+'&tahun_2='+_tahun_2.val()+'&bulan='+cbulan+'&bulan_2='+cbulan_2+'&jenisCetak='+'0';
			  window.open(urll+lc, '_blank');
			  window.focus();
			}
		}      
    });
	
	$('#cetakExcel').click(function(){
		
		var tglcetak = _tglcetak.val();		
		var a= tglcetak.length;
        var bulan_tglcetak = tglcetak.substr(3,2);
		var tahun = $('#tahun').val();
		var tahun_2 = $('#tahun_2').val();
		var cbulan = $('#bulan').combogrid('getValue');
		var cbulan_2 = $('#bulan_2').combogrid('getValue');
		if (tahun > tahun_2){
			alert('Tahun Pertama Tidak Boleh Lebih Besar Dari Tahun Kedua');
			return
		}

		if ( jnsCetak == 0 ) {
			if ( _nip.combogrid('getValue') == '') {
			  errorShow();
			} else {
			lc = '?nip='+_nip.combogrid('getValue')+'&nama='+_nama.text()+'&tgl_cetak='+_tglcetak.val()+'&bulan_tglcetak='+bulan_tglcetak+'&nip_lama='+_nip_lama.text()+'&satkerja='+_satkerja.text()+'&nm_satkerja='+_nm_satkerja.text()+'&unit='+_unit.text()+'&nm_unit='+_nm_unit.text()+'&tahun='+_tahun.val()+'&tahun_2='+_tahun_2.val()+'&bulan='+cbulan+'&bulan_2='+cbulan_2+'&jenisCetak='+'1';
			  window.open(urll+lc, '_blank');
			  window.focus();
			}
		}      
    });

    function getTahunPicker() {

      _tahun.datepicker({
        minViewMode: 'years',
        autoclose: true,
        format: 'yyyy'
      });
	  _tahun_2.datepicker({
        minViewMode: 'years',
        autoclose: true,
        format: 'yyyy'
      });
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

  });
</script>