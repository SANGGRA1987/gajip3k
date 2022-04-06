<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade in active" id="tab_spp_gaji" role="tabpanel" aria-labelledby="spp_gaji-tab">
    <form id="form_spp_gaji">
      <div class="col-sm-10" style="padding: 10px 0px 10px 0">
        <div class="col-sm-2" style="padding-top: 8px;">KD SKPD </div>
        <div class="col-sm-4">
          <select id="skpd" class="form-control" style="width: 50%"></select> <span id="nmskpd"  class="form-control"  style="width: 300%"></span>
        </div>

		<div class="col-sm-4" style="padding-top: 6px;">
          <span id="tgl_cetak"></span>
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
        <!--  <button type="button" class="btn btn-default" style="width: 110px" id="cetakExcel" ><i class="fa fa-file-excel-o"></i> Cetak Excel</button>-->
        <!--  <button type="button" class="btn btn-default" style="width: 110px" id="cetakWord" ><i class="fa fa-file-word-o"></i> Cetak Word</button>-->
        <!--   <button type="button" class="btn btn-default" style="width: 110px" ><i class="fa fa-reply"></i> Kembali</button>-->
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">  

  var jnsCetak = '';
  var urll     = "<?php echo site_url(); ?>laporan/lap_spp/C_spp_gaji/cetakspp";

  var _kdskpd = $('#skpd');
  var _nmskpd = $('#nmskpd');
  var _tglcetak = $('#datepicker');

  
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
  
   // jenisCetak(0);
	    
	$('#datepicker').datepicker({
              format: 'dd-mm-yyyy',
			  autoclose: true
    });
	$('#datepicker').val(getToday());
    //_tglcetak.val(getToday());
	_tglcetak.val(getToday());
    jenisCetak(0);
	
	
//	  getTahunPicker();
	// _tglcetak.val(getToday());

    $("#skpd").combogrid({
      panelWidth:900,  
      idField:'kd_skpd',
      textField:'kd_skpd',
      url:'<?php echo base_url('laporan/lap_spp/C_spp_gaji/getskpd') ?>',
      columns:[[
          {field:'kd_skpd',title:'KODE SKPD', width:'150'},
		  {field:'nm_skpd',title:'NAMA SKPD', width:'750'}
      ]],
      fitColumns: true,
      onSelect: function(index, row){
	  document.getElementById('nmskpd').textContent = row.nm_skpd;
      }
    }).combogrid('textbox').attr('placeholder','Pilih KD SKPD');    

    $('#cetakPdf').click(function(){		
		var kdskpd= _kdskpd.combogrid('getValue')
		var nmskpd =_nmskpd.text()
		var tglcetak = _tglcetak.val();
		//alert(tglcetak);
		var a= tglcetak.length;
        var bulan_tglcetak = tglcetak.substr(3,2);
		var tahun_tglcetak = tglcetak.substr(6,4);

		
      if ( jnsCetak == 0 ) {
        if ( _kdskpd.combogrid('getValue') == '') {
          errorShow();
        } else {
		 lc = '?skpd='+_kdskpd.combogrid('getValue')+'&nmskpd='+_nmskpd.text()+'&tglcetak='+tglcetak+'&tahun_tglcetak='+tahun_tglcetak+'&tipeCetakan='+'0';

          window.open(urll+lc, '_blank');
          window.focus();
        }
      } 
      else if (jnsCetak == 1) 
      {
	  
	  alert('1');
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
            url: "<?php echo base_url('laporan/lap_spp/C_spp_gaji/getBulan') ?>",
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