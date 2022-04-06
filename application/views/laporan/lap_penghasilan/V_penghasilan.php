
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade in active" id="tab_penghasilan" role="tabpanel" aria-labelledby="penghasilan-tab">
    <form id="form_penghasilan">
      <div class="col-sm-10" style="padding: 10px 0px 10px 0">
        <div class="col-sm-2" style="padding-top: 8px;">Nip Pegawai</div>
        <div class="col-sm-4">
          <select id="nip" class="form-control" style="width: 100%"></select>
        </div>
        <div class="col-sm-5" style="padding-top: 6px;">
          <span id="nama"></span>
        </div>
		<div class="col-sm-5" style="padding-top: 6px;">
          <span id="pangkat"></span>
        </div>
		<div class="col-sm-5" style="padding-top: 6px;">
          <span id="gapok"></span>
        </div>
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
          <button type="button" class="btn btn-default" style="width: 110px" id="cetakPdf" ><i class="fa fa-file-pdf-o"></i> Cetak PDF</button>
         <!-- <button type="button" class="btn btn-default" style="width: 110px" id="cetakExcel" ><i class="fa fa-file-excel-o"></i> Cetak Excel</button>-->
          <!--<button type="button" class="btn btn-default" style="width: 110px" id="cetakWord" ><i class="fa fa-file-word-o"></i> Cetak Word</button>-->
        <!--  <button type="button" class="btn btn-default" style="width: 110px" ><i class="fa fa-reply"></i> Kembali</button>-->
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">  

  var jnsCetak = '';
  var urll     = "<?php echo site_url(); ?>laporan/lap_penghasilan/C_penghasilan/cetakLaporan";

  var _nip = $('#nip');
  var _nama = $('#nama');
  var _pangkat = $('#pangkat');
  var _gapok = $('#gapok');
  var _bulan = $("bulan");

  var _tglcetak = $('#datepicker');
  var _tahun   = $('#tahun');

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
  
    jenisCetak(0);
	    
	$('#datepicker').datepicker({
              format: 'dd-mm-yyyy',
			  autoclose: true
    });
	
	$('#datepicker').val(getToday());
		
    $("#nip").combogrid({
      panelWidth:1000,  
      idField:'nip',
      textField:'nip',
      url:'<?php echo base_url('laporan/lap_penghasilan/C_penghasilan/getpenghasilan') ?>',
      columns:[[
          {field:'nip',title:'Nip', width:'200'},
          {field:'nama',title:'Nama', width:'400'},
		  {field:'pangkat',title:'Pangkat', width:'250'},
		  {field:'gapok',title:'Gapok', width:'150'},
      ]],
      fitColumns: true,
      onSelect: function(index, row){
        document.getElementById('nama').textContent = row.nama;
		document.getElementById('pangkat').textContent = row.pangkat;
		document.getElementById('gapok').textContent = row.gapok;

      }
    }).combogrid('textbox').attr('placeholder','Pilih Nip');    

    $('#cetakPdf').click(function(){
		
		var tglcetak = _tglcetak.val();		
		var a= tglcetak.length;
        var bulan_tglcetak = tglcetak.substr(3,2);

      if ( jnsCetak == 0 ) {
        if ( _nip.combogrid('getValue') == '') {
          errorShow();
        } else {
          lc = '?nip='+_nip.combogrid('getValue')+'&nama='+_nama.text()+'&tgl_cetak='+_tglcetak.val()+'&bulan_tglcetak='+bulan_tglcetak+'&pangkat='+_pangkat.text()+'&gapok='+_gapok.text()+'&tipeCetakan='+'0';
          window.open(urll+lc, '_blank');
          window.focus();
        }
      } 
      else if (jnsCetak == 1) 
      {
      }
 
      
    });

    function getTahunPicker() {

      _tahun.datepicker({
        minViewMode: 'years',
        autoclose: true,
        format: 'yyyy'
      });
    }

    function loadSelect2(){
	
      _bulan.select2({
        placeholder: "Pilih Bulan",
        containerCssClass: ':all',
        ajax: {
            url: "<?php echo base_url('laporan/lap_penghasilan/C_penghasilan/getBulan') ?>",
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