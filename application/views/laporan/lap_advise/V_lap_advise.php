
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade in active" id="tab_penghasilan" role="tabpanel" aria-labelledby="penghasilan-tab">
    <form id="form_penghasilan">
      <div class="col-sm-10" style="padding: 10px 0px 10px 0">
        <div class="col-sm-2" style="padding-top: 8px;">Nomor Advise</div>
        <div class="col-sm-4">
          <select id="no_advise" class="form-control" style="width: 100%"></select>
        </div>
		 <div class="col-sm-4" style="padding-top: 6px;">
          <span id="tgl_advise"></span>
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
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">  

  var jnsCetak = '';
  var urll     = "<?php echo site_url(); ?>laporan/lap_advise/C_lap_advise/cetakLaporan";

  var _no_advise = $('#no_advise');
  var _tglcetak = $('#datepicker');
  var _tgladvise = $('#tgl_advise');

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
  
	$('#datepicker').datepicker({
              format: 'dd-mm-yyyy',
			  autoclose: true
    });
	
	$('#datepicker').val(getToday());
		
    $("#no_advise").combogrid({
      panelWidth:800,  
      idField:'no_advise',
      textField:'no_advise',
      url:'<?php echo base_url('laporan/lap_advise/C_lap_advise/getpenghasilan') ?>',
      columns:[[
          {field:'no_advise',title:'No advise', width:'300', align:'left'},
          {field:'tgl_advise',title:'Tgl Advise', width:'100',align:'center'},
		  {field:'total1',title:'Total', width:'200',align:'right'},
      ]],
      fitColumns: true,
      onSelect: function(index, row){
        document.getElementById('no_advise').textContent = row.no_advise;
		ctgladvise =row.tgl_advise;
	  	document.getElementById('tgl_advise').textContent =row.tgl_advise;
      }
    }).combogrid('textbox').attr('placeholder','Pilih Nomor Advise');    

    $('#cetakPdf').click(function(){		
		//var tglcetak = _tglcetak.val();	
		var tgladvise= _tgladvise.text();
		var a= tgladvise.length;	
		var cno     = $('#no_advise').combogrid('getValue');
		if(cno==''){
			iziToast.error({
				title: 'PERINGATAN',
				message: 'Maaf NOMOR ADVISE belum di pilih',
			});
			return
		}
		
        lc = '?no_advise='+_no_advise.combogrid('getValue') + '&tgl_cetak='+tgladvise;
          window.open(urll+lc, '_blank');
          window.focus();        
    });

    function getTahunPicker() {

      _tahun.datepicker({
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