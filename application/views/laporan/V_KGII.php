<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item active">
    <a class="nav-link" data-toggle="tab" href="#tab_penghasilan" role="tab" aria-controls="keseluruhan" onclick="jenisCetak(2)">Keseluruhan</a>
  </li>
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade in active" id="tab_penghasilan" role="tabpanel" aria-labelledby="penghasilan-tab">
    <form id="form_penghasilan">
      <div class="col-sm-12" style="padding: 10px 0px 10px 0">
        <div class="col-sm-2" style="padding-top: 8px;">SKPD</div>
        <div class="col-sm-3"><select id="skpd" class="form-control" style="width: 50%"></select></div>
        <div class="col-sm-6"><span id="nama"></span></div>
      </div>
    </form>
    <div class="col-sm-12" style="padding: 10px 0px 10px 0">
      <div class="col-sm-2" style="padding-top: 8px;">Tanggal Cetak</div>
      <div class="col-sm-3"><input class="form-control input-sm own-radius" style="width: 50%" type="text" id="datepicker" placeholder="Masukan Tanggal Cetak" readonly></div>
    </div> 
	<div class="col-sm-12" style="padding: 10px 0px 10px 0">
      <div class="col-sm-2" style="padding-top: 8px;">Nomor</div>
      <div class="col-sm-9"><input id="nomor" name="nomor" type="text" class="easyui-textbox" style="width:20%;text-align:left;"></div>
    </div> 
    <div class="col-sm-12">
        <div class="col-sm-2"></div>
        <div class="col-sm-7" style="padding: 10px 0 10px 5px">
          <button type="button" class="btn btn-default" style="width: 110px" id="cetakPdf" ><i class="fa fa-file-pdf-o"></i> Cetak PDF</button>
          <!--<button type="button" class="btn btn-default" style="width: 110px" id="cetakExcel" ><i class="fa fa-file-excel-o"></i> Cetak Excel</button>
          <button type="button" class="btn btn-default" style="width: 110px" id="cetakWord" ><i class="fa fa-file-word-o"></i> Cetak Word</button>
          <button type="button" class="btn btn-default" style="width: 110px" ><i class="fa fa-reply"></i> Kembali</button>-->
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">  

  var jnsCetak = '';
  var urll     = "<?php echo site_url(); ?>laporan/C_KGII/cetakLaporan";

  var _skpd = $('#skpd');
  var _nama = $('#nama');

  var _tglcetak = $('#datepicker');
  var _tahun   = $('#tahun');

  function jenisCetak(val){
    jnsCetak = val;
  }

  function errorShow() {
    iziToast.error({
      message: 'Anda belum mengisi kode SKPD',
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
	$('#datepicker').datepicker({
              format: 'dd-mm-yyyy',
			  autoclose: true
    });
	
	$('#datepicker').val(getToday());
		
    $("#skpd").combogrid({
      panelWidth:800,  
      idField:'satkerja',
      textField:'satkerja',
      url:'<?php echo base_url('laporan/C_KGII/getSkpd') ?>',
      columns:[[
          {field:'satkerja',title:'Kode', align:'center', width:'100'},
          {field:'nm_satkerja',title:'Nama', align:'left', width:'700'}
      ]],
      fitColumns: true,
      onSelect: function(index, row){
        document.getElementById('nama').textContent = row.nm_satkerja;

      }
    }).combogrid('textbox').attr('placeholder','Pilih Kode SKPD');    

    $('#cetakPdf').click(function(){		
		var tglcetak = _tglcetak.val();
		var a= tglcetak.length;
        var bulan_tglcetak = tglcetak.substr(3,2);
		var tahun_tglcetak = tglcetak.substr(6,4);
		var nomor = $('#nomor').val();
		
        if ( _skpd.combogrid('getValue') == '') {
          errorShow();
        } else {
          lc = '?skpd='+_skpd.combogrid('getValue')+'&nama='+_nama.text()+'&tgl_cetak='+_tglcetak.val()+'&bulan_tglcetak='+bulan_tglcetak+'&tahun_tglcetak='+tahun_tglcetak+'&nomor='+nomor;
          window.open(urll+lc, '_blank');
          window.focus();
        }
    });

    function getTahunPicker() {
      _tahun.datepicker({
        minViewMode: 'years',
        autoclose: true,
        format: 'yyyy'
      });
    }

    /*function loadSelect2(){	
      _bulan.select2({
        placeholder: "Pilih Bulan",
        containerCssClass: ':all',
        ajax: {
            url: "<?php echo base_url('laporan/C_KGII/getBulan') ?>",
            dataType: 'json',
            data: function (params) {
                return {
                    q: params.term 
					
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
        }
      });
    }*/

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