



<div class="tab-content" id="myTabContent">

  <!-- TABS SKPD -->
  <div class="tab-pane fade in active" id="tab_skpd" role="tabpanel" aria-labelledby="skpd-tab">
    <form id="form_skpd">
      <!-- SKPD -->
      <div class="col-sm-10" style="padding: 10px 0px 10px 0">
        <div class="col-sm-2" style="padding-top: 8px;">SATKERJA</div>
        <div class="col-sm-4">
          <select id="skpd" class="form-control" style="width: 50%"></select>
        </div>
        <div class="col-sm-4" style="padding-top: 6px;">
          <span id="nm_skpd"></span>
        </div>
      </div>
	   <!-- SKPD2 
	   <div class="col-sm-10" style="padding: 10px 0px 10px 0">
        <div class="col-sm-2" style="padding-top: 8px;">Sampai SATKERJA</div>
        <div class="col-sm-4">
          <select id="skpd2" class="form-control" style="width: 50%"></select>
        </div>
        <div class="col-sm-4" style="padding-top: 6px;">
          <span id="nm_skpd2" ></span>
        </div>
      </div>-->

      <!-- Unit -->
      <div class="col-sm-10 unit" style="padding: 10px 0px 10px 0">
        <div class="col-sm-2" style="padding-top: 8px;">UNIT</div>
        <div class="col-sm-4">        
          <select id="unit_skpd" class="form-control input-sm own-radius" style="width: 50%"></select>
        </div>
        <div class="col-sm-4" style="padding-top: 6px;">
          <span id="nm_skpd_unit"></span>
        </div>
      </div>

      <!-- Bulan
      <div class="col-sm-10" style="padding: 10px 0px 10px 0">
        <div class="col-sm-2" style="padding-top: 8px;">BULAN</div>
        <div class="col-sm-4">
          <select id="bulan_skpd" class="form-control bulan" data-width="100%"></select>
        </div>
      </div> -->

      <!-- Tahun -->
      <div class="col-sm-10 thn_" style="padding: 10px 0px 10px 0">
        <div class="col-sm-2" style="padding-top: 8px;">Pilih Cetak</div>
        <div class="col-sm-2">
          <select id="printer" class="easyui-combobox" style="width: 200%">
			<option value="1">DAFTAR GAJI 13 </option>
			<!--<option value="2">DAFTAR GAJI PRE PRINTED</option>-->
		  </select>
        </div>
      </div>

      <!-- Tahun Keseluruhan -->
      <div class="col-sm-10 thn_ksl" style="padding: 10px 0px 10px 0">
        <div class="col-sm-2" style="padding-top: 8px;">Tahun</div>
        <div class="col-sm-9">
          <div class="col-sm-4" style="padding-left: 0">
            <!-- <select class="form-control tahun" data-width="100%"></select> -->
            <input id="_tahun_1" type="text" class="form-control input-sm own-radius" placeholder="Pilih Tahun Awal">
          </div>
          <div class="col-sm-1" style="padding-top: 8px;">
            S/D
          </div>
          <div class="col-sm-4" style="padding-right: 0">
            <!-- <select class="form-control tahun" data-width="100%"></select> -->
            <input id="_tahun_2" type="text" class="form-control input-sm own-radius" placeholder="Pilih Tahun Berakhir">
          </div>
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
        <div class="col-sm-8" style="padding: 10px 0 10px 5px">
          <button type="button" class="btn btn-default" style="width: 150px" id="cetakPdf" ><i class="fa fa-file-pdf-o"></i>&nbsp;Cetak PDF</button>
          <button type="button" class="btn btn-success" style="width: 150px" id="cetakExcel" ><i class="fa fa-file-excel-o"></i>&nbsp;Cetak Excel</button>
          <!--  <button type="button" class="btn btn-default" style="width: 100px" id="cetakWord" ><i class="fa fa-file-word-o"></i>Cetak Word</button>-->
         <!-- <button type="button" class="btn btn-default" style="width: 100px" ><i class="fa fa-reply"></i>Kembali</button>-->
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">  

/** Jenis Cetak   => SKPD, Unit, Keseluruhan
  * Tipe Cetak    => PDF, Excel, Word
  * 
  * 
  **/

  var jnsCetak = '';
  var urll     = "<?php echo site_url(); ?>laporan/lap_formb/C_formb_gaji13/cetakLaporan";

  var _bulan = $(".bulan");
  var _skpd = $('#skpd');
  var _printer = $('#printer');
  var _unit = '';
  var _nmskpd = $('#nm_skpd');
 // var _nmskpd2 = $('#nm_skpd2');
  var _tglcetak = $('#datepicker');
  var _tahun_1  = $('#_tahun_1');
  var _tahun_2  = $('#_tahun_2');
  var _tahun   = $('#tahun');
  var _unit_skpd = $('#unit_skpd');
  var _nm_skpd_unit = $('#nm_skpd_unit');

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

    // Deklarasi Select2
    _bulan.select2();

    $('.unit').show();
    $('.thn_ksl').hide();
	$('#datepicker').datepicker({
              format: 'dd-mm-yyyy',
			  autoclose:true
        });

    loadSelect2();   
    getTahunPicker();
    _tglcetak.val(getToday());
    //jenisCetak(0);


    $("#skpd").combogrid({
      panelWidth:900,  
      idField:'satkerja',
      textField:'satkerja',
      url:'<?php echo base_url('laporan/lap_formb/C_formb_gaji13/getSkpd') ?>',
      columns:[[
          {field:'satkerja',title:'Kode Satker', width:'150'},
          {field:'nm_satkerja',title:'Nama Satker', width:'700'},
      ]],
      fitColumns: true,
      onSelect: function(index, row){
        document.getElementById('nm_skpd').textContent = row.nm_satkerja;
		var kdskpd = row.satkerja;
		
            if (kdskpd != '') {
              $('#unit_skpd').combogrid({
                panelWidth:1000,  
                idField:'kd_uskpd',
                textField:'kd_uskpd',
                url:'<?php echo base_url('laporan/lap_formb/C_formb_gaji13/getUnitSkpd/') ?>' + kdskpd,
                columns:[[
                  {field:'kd_uskpd',title:'Kode Unit', width:'150'},
                  {field:'nm_uskpd',title:'Nama Unit', width:'800'},
                ]],
                fitColumns: true,
                onSelect: function(index, row) {
                  document.getElementById('nm_skpd_unit').textContent = row.nm_uskpd;
                }
              }).combogrid('textbox').attr('placeholder','Pilih Unit Kerja');
			  document.getElementById('nm_skpd_unit').textContent = '';
            }
      }
    }).combogrid('textbox').attr('placeholder','Pilih Satker');
	
	/*  $("#skpd2").combogrid({
      panelWidth:600,  
      idField:'satkerja',
      textField:'satkerja',
      url:'<?php echo base_url('laporan/lap_formb/C_formb_gaji13/getSkpd') ?>',
      columns:[[
          {field:'satkerja',title:'Kode SATKERJA', width:'100'},
          {field:'nm_satkerja',title:'Nama SATKERJA', width:'500'},
      ]],
      fitColumns: true,
      onSelect: function(index, row){
        document.getElementById('nm_skpd2').textContent = row.nm_satkerja;
      }
    }).combogrid('textbox').attr('placeholder','Sampai dengan SATKERJA'); */      


    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){

      $('#skpd').combogrid('clear');
      _bulan.val("").trigger("change");
      document.getElementById('nm_satkerja').textContent = '';
      _tahun_1.val('');
      _tahun_2.val('');
      _tahun.val('');
      if ( $('.unit').show() == true ) {
        $('#unit_skpd').combogrid('clear');
      }

      currentTab = $(e.target).closest('li').index();
      if ( currentTab == 2 ) { // Tabs Keseluruhan

        $('.unit').hide();
        $('.thn_').hide();
        $('.thn_ksl').show();
		$('.tgl').hide();

      } else if ( currentTab == 1 ) { // Tabs Unit

        $("#skpd").combogrid({
          panelWidth:1000,  
          idField:'kd_skpd',
          textField:'kd_skpd',
          url:'<?php echo base_url('laporan/lap_formb/C_formb_gaji13/getSkpd') ?>',
          columns:[[
              {field:'kd_skpd',title:'Kode SKPD', width:'150'},
              {field:'nm_skpd',title:'Nama SKPD', width:'800'},
          ]],
          fitColumns: true,
          onSelect: function(index, row){
            var kdskpd = row.kd_satkerja;
            document.getElementById('nm_skpd').textContent = row.nm_satkerja;
		
            if (kdskpd != '') {
              $('#unit_skpd').combogrid({
                panelWidth:1000,  
                idField:'kd_uskpd',
                textField:'kd_uskpd',
                url:'<?php echo base_url('laporan/lap_formb/C_formb_gaji13/getUnitSkpd/') ?>' + kdskpd,
                columns:[[
                  {field:'kd_uskpd',title:'Kode SKPD', width:'150'},
                  {field:'nm_uskpd',title:'Nama SKPD', width:'800'},
                ]],
                fitColumns: true,
                onSelect: function(index, row) {
                  document.getElementById('nm_skpd_unit').textContent = row.nm_uskpd;
                }
              }).combogrid('textbox').attr('placeholder','Pilih SATKERJA');
            }
          }

        }).combogrid('textbox').attr('placeholder','Pilih SATKERJA');
        $('.unit').show();
        $('.thn_ksl').hide();
		$('.tgl').show();

      } else if ( currentTab != 1 && currentTab == 0) { // Tabs SKPD

        $('.thn_').show();
        $('.thn_ksl').hide();
        $('.unit').hide();
		$('.tgl').show();

      }
    });

    $('#cetakPdf').click(function(){
		if (_skpd.combogrid('getValue') == '' ) {
		  errorShow();
		} else {
			var tglcetak = _tglcetak.val();
			var a= tglcetak.length;
			var bulan_tglcetak = tglcetak.substr(3,2);					

			lc = '?skpd='+_skpd.combogrid('getValue')+'&nmskpd='+_nmskpd.text()+'&tglcetak='+_tglcetak.val()+'&bulan_tglcetak='+bulan_tglcetak+'&jenisCetak=0&printer='+_printer.combobox('getValue')+'&nm_skpd_unit='+_nm_skpd_unit.text()+'&unit_skpd='+_unit_skpd.combogrid('getValue');
			window.open(urll+lc, '_blank');
			window.focus();
		}	
		/*if ( jnsCetak == 2 ) {
			if ( _skpd.combogrid('getValue') == '' || _tahun_1.val() == '' || _tahun_2.val() == '' ) {
			  errorShow();
			} else {
			  lc = '?skpd='+_skpd.combogrid('getValue')+'&nmskpd='+_nmskpd.text()+'&tglcetak='+_tglcetak.val()+'&jenisCetak='+jnsCetak+'&tahun_1='+_tahun_1.val()+'&tahun_2='+_tahun_2.val()+'&tipeCetakan='+'0';
			  window.open(urll+lc, '_blank');
			  window.focus();
			}
		}else if (jnsCetak == 0){
			if (_skpd.combogrid('getValue') == '' ) {
			  errorShow();
			} else {
				var tglcetak = _tglcetak.val();
				var a= tglcetak.length;
				var bulan_tglcetak = tglcetak.substr(3,2);					

				lc = '?skpd='+_skpd.combogrid('getValue')+'&nmskpd='+_nmskpd.text()+'&tglcetak='+_tglcetak.val()+'&bulan_tglcetak='+bulan_tglcetak+'&jenisCetak='+jnsCetak+'&printer='+_printer.combobox('getValue')+'&nm_skpd_unit='+_nm_skpd_unit.text()+'&unit_skpd='+_unit_skpd.combogrid('getValue');
				window.open(urll+lc, '_blank');
				window.focus();
			}
		}else{
			if (_skpd.combogrid('getValue') == '' || _tahun.val() == '' || _tanggal.val() == '') {
			  errorShow();
			} else {
			  lc = '?skpd='+_skpd.combogrid('getValue')+'&nmskpd='+_nmskpd.text()+'&tgl_oleh='+_tanggal.val()+'&tahun='+_tahun.val()+'&tglcetak='+_tglcetak.val()+'&jenisCetak='+jnsCetak+'&tahun_1='+_tahun_1.val()+'&tahun_2='+_tahun_2.val()+'&tipeCetakan='+'0'+'&nm_skpd_unit='+_nm_skpd_unit.text()+'&unit_skpd='+_unit_skpd.combogrid('getValue');
			  // console.log(lc);
			  window.open(urll+lc, '_blank');
			  window.focus();
			}
		}*/
      
    });
	
	$('#cetakExcel').click(function(){	
		if (_skpd.combogrid('getValue') == '' ) {
		  errorShow();
		} else {
			var tglcetak = _tglcetak.val();
			var a= tglcetak.length;
			var bulan_tglcetak = tglcetak.substr(3,2);					

			lc = '?skpd='+_skpd.combogrid('getValue')+'&nmskpd='+_nmskpd.text()+'&tglcetak='+_tglcetak.val()+'&bulan_tglcetak='+bulan_tglcetak+'&jenisCetak=1&printer='+_printer.combobox('getValue')+'&nm_skpd_unit='+_nm_skpd_unit.text()+'&unit_skpd='+_unit_skpd.combogrid('getValue');
			window.open(urll+lc, '_blank');
			window.focus();
		}
      
    });
	
    /*$('#cetakExcel').click(function(){
      if (_skpd.combogrid('getValue') == '' || _tahun.val() == '' || _bulan.val() == '') {
        errorShow();
      } else {
        lc = '?skpd='+_skpd.combogrid('getValue')+'&nmskpd='+_nmskpd.text()+'&bulan='+_bulan.text()+'&tahun='+_tahun.val()+'&tglcetak='+_tglcetak.val()+'&jenisCetak='+jnsCetak+'&tahun_1='+_tahun_1.val()+'&tahun_2='+_tahun_2.val()+'&tipeCetakan='+'1';
        window.open(urll+lc, '_blank');
        window.focus();
      }
    });*/

    $('#cetakWord').click(function(){
      if (_skpd.combogrid('getValue') == '' || _tahun.val() == '' || _bulan.val() == '') {
        errorShow();
      } else {
        lc = '?skpd='+_skpd.combogrid('getValue')+'&nmskpd='+_nmskpd.text()+'&bulan='+_bulan.text()+'&tahun='+_tahun.val()+'&tglcetak='+_tglcetak.val()+'&jenisCetak='+jnsCetak+'&tahun_1='+_tahun_1.val()+'&tahun_2='+_tahun_2.val()+'&tipeCetakan='+'2';
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

      _tahun_1.datepicker({
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

    function loadSelect2(){

      _bulan.select2({
        placeholder: "Pilih Bulan",
        containerCssClass: ':all',
        ajax: {
            url: "<?php echo base_url('laporan/lap_formb/C_formb_gaji13/getBulan') ?>",
            dataType: 'json',
            data: function (params) {
                return {
                    q: params.term // search term
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