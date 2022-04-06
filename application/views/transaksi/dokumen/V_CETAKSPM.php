<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade in active" id="tab_penghasilan" role="tabpanel" aria-labelledby="penghasilan-tab">
    <form id="form_penghasilan">
      <div class="col-sm-10" style="padding: 10px 0px 10px 0">
        <div class="col-sm-2" style="padding-top: 8px;">NO SPM</div>
        <div class="col-sm-4">
          <select id="no_spm" class="form-control" style="width: 100%"></select>
        </div>
		  <div class="col-sm-4" style="padding-top: 6px;">
          <span id="tgl_spm"></span>
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
       <!--   <button type="button" class="btn btn-default" style="width: 110px" id="cetakExcel" ><i class="fa fa-file-excel-o"></i> Cetak Excel</button>-->
       <!--   <button type="button" class="btn btn-default" style="width: 110px" id="cetakWord" ><i class="fa fa-file-word-o"></i> Cetak Word</button>-->
       <!--   <button type="button" class="btn btn-default" style="width: 110px" ><i class="fa fa-reply"></i> Kembali</button>-->
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">  

  var jnsCetak = '';
  var urll     = "<?php echo site_url(); ?>transaksi/C_CETAKSPM/cetakspm";

  var _nospm = $('#no_spm');
  var _tglspm = $('#tgl_spm');
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
		
    $("#no_spm").combogrid({
      panelWidth:400,  
      idField:'no_spm',
      textField:'no_spm',
      url:'<?php echo base_url('transaksi/C_CETAKSPM/getspm') ?>',
      columns:[[
          {field:'no_spm',title:'NO SPM', width:'200'},
		  {field:'tgl_spm',title:'TGL SPM', width:'200'}
      ]],
      fitColumns: true,
      onSelect: function(index, row){
	  ctglspm =row.tgl_spm;
	  document.getElementById('tgl_spm').textContent =row.tgl_spm;
      }
    }).combogrid('textbox').attr('placeholder','Pilih NO SPM');    


    $('#cetakPdf').click(function(){		
		var tglspm = _tglspm.text();	
			
		var a= tglspm.length;
        var bulan_tglcetak = tglspm.substr(3,2);
		var tahun_tglcetak = tglspm.substr(0,4);
	
		
      if ( jnsCetak == 0 ) {
        if ( _nospm.combogrid('getValue') == '') {
          errorShow();
        } else {
         // lc = '?no_spm='+_nospm.combogrid('getValue')+'&tgl_cetak='+_tglcetak.val()+'&bulan_tglcetak='+bulan_tglcetak+'&tipeCetakan='+'0';
		 lc = '?no_spm='+_nospm.combogrid('getValue')+'&tgl_spm='+_tglspm.text()+'&tahun_tglcetak='+tahun_tglcetak+'&tipeCetakan='+'0';
		
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
            url: "<?php echo base_url('transaksi/C_CETAKSPM/getBulan') ?>",
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