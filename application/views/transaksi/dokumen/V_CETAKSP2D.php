<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade in active" id="tab_penghasilan" role="tabpanel" aria-labelledby="penghasilan-tab">
    <form id="form_penghasilan">
      <div class="col-sm-10" style="padding: 10px 0px 10px 0">
        <div class="col-sm-2" style="padding-top: 8px;">NO SP2D</div>
        <div class="col-sm-4">
          <select id="no_sp2d" class="form-control" style="width: 100%"></select>
        </div>
		  <div class="col-sm-4" style="padding-top: 6px;">
          <span id="tgl_sp2d"></span>
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
  var urll     = "<?php echo site_url(); ?>transaksi/C_CETAKSP2D/cetaksp2d";

  var _nosp2d = $('#no_sp2d');
  var _tglsp2d = $('#tgl_sp2d');
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
		
    $("#no_sp2d").combogrid({
      panelWidth:600,  
      idField:'no_sp2d',
      textField:'no_sp2d',
      url:'<?php echo base_url('transaksi/C_CETAKSP2D/getsp2d') ?>',
      columns:[[
          {field:'no_sp2d',title:'NO SP2D', width:'150'},
		  {field:'tgl_sp2d',title:'TGL SP2D', width:'150'},
		  {field:'no_spm',title:'NO SPM', width:'150'},
		  {field:'tgl_spm',title:'TGL SPM', width:'150'}
      ]],
      fitColumns: true,
      onSelect: function(index, row){
	  ctglsp2d =row.tgl_sp2d;
	  document.getElementById('tgl_sp2d').textContent =row.tgl_sp2d;
      }
    }).combogrid('textbox').attr('placeholder','Pilih NO SP2D');    


    $('#cetakPdf').click(function(){		
		var tglsp2d= _tglsp2d.text();	
			
		var a= tglsp2d.length;
        var bulan_tglcetak = tglsp2d.substr(3,2);
		var tahun_tglcetak = tglsp2d.substr(0,4);
	
		
      if ( jnsCetak == 0 ) {
        if ( _nosp2d.combogrid('getValue') == '') {
          errorShow();
        } else {
         // lc = '?no_spm='+_nospm.combogrid('getValue')+'&tgl_cetak='+_tglcetak.val()+'&bulan_tglcetak='+bulan_tglcetak+'&tipeCetakan='+'0';
		 lc = '?no_sp2d='+_nosp2d.combogrid('getValue')+'&tgl_sp2d='+_tglsp2d.text()+'&tahun_tglcetak='+tahun_tglcetak+'&tipeCetakan='+'0';
		//alert(lc);
          window.open(urll+lc, '_blank');
          window.focus();
        }
      } 
      else if (jnsCetak == 1) 
      {
	  
	  //alert('1');
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