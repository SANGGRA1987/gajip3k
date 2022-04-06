<div class="row">
    <div class="col-md-12">  
	<style>
.heading-1{
  position:relative;
  text-align: center;
  font-style: italic;
  font-family: "Lucida Handwriting";
}
.heading-1:before {
  content: "";
  display: block;
  border-top: solid 2px #bebebe;
  width: 100%;
  height: 2px;
  position: absolute;
  top: 50%;
  z-index: 0;
}
.heading-1 span {
  background: #fff;
  padding: 0 10px;
  position: relative;
  z-index: 1;
}


.textt {
    position: relative !important;
    border: 1px solid #AAAAAA !important;
        border-top-color: rgb(170, 170, 170) !important;
        border-right-color: rgb(170, 170, 170) !important;
        border-bottom-color: rgb(170, 170, 170) !important;
        border-left-color: rgb(170, 170, 170) !important;
    background-color: #fff !important;
    vertical-align: middle !important;
    display: inline-block !important;
    overflow: hidden !important;
    white-space: nowrap !important;
    margin: 0 !important;
    padding: 4 !important;
    -moz-border-radius: 4px 4px 4px 4px !important;
    -webkit-border-radius: 4px 4px 4px 4px !important;
    border-radius: 4px 4px 4px 4px !important;
	border-color: #ffa8a8 !important;
	background-color: #fff3f3 !important;
	height: 29px; !important;
	font-size: 12px !important;
}      
.pesan{
                display: none;
                position: relative;
                border: 1px solid blue;
                border-radius: 5px;
                width: 800px;
                height: 40px;
                top: 10px;
                bottom: 20px;
                left: 200px;
                padding: 5px 10px;
                background-color: #fffd52;
                text-align: left;
				margin-bottom: 20px;
}
.pic{
				margin-bottom: 50px;
}
	</style>
		<div class="form-group ">
		<h3 class="heading-1"><span>Ubah Konfigurasi Laporan Dan SPM</span></h3>
		    <div class="pesan" style="padding-bottom: 10px;">
				<div class="col-sm-10"><label><p style="color:green;font-size:20px;">Sukses dirubah.!, silahkan Logout dan login kembali.!</p></label></div>
            </div>
		<form id="fm" method="post" novalidate style="margin:0;padding:20px 50px" enctype="multipart/form-data">	
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
            		<div class="col-sm-2"><label>Tahun Anggaran</label></div>
            		<div class="col-sm-8">
                        <input id="thang" name="thang" type="text" class="textt" style="width:40%;">
					</div>
            </div>
			<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
            		<div class="col-sm-2"><label>Periode</label></div>
            		<div class="col-sm-8">
                        <input id="periode" name="periode" type="text" class="textt" style="width:5%;" maxlength="2"> 
                        *Tulis Dengan Angka
					</div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>No. SPM</label></div>
                    <div class="col-sm-8">
                        <input id="spm" name="spm" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>Kota</label></div>
                    <div class="col-sm-8">
                        <input id="kota" name="kota" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>Perbendaharaan</label></div>
                    <div class="col-sm-8">
                        <input id="ankep" name="ankep" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>Jabatan</label></div>
                    <div class="col-sm-8">
                        <input id="jbankep" name="jbankep" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>NIP</label></div>
                    <div class="col-sm-8">
                        <input id="nipankep" name="nipankep" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>Pangkat</label></div>
                    <div class="col-sm-8">
                        <input id="pangkep" name="pangkep" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>Biro Keuangan</label></div>
                    <div class="col-sm-8">
                        <input id="kpkeu" name="kpkeu" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>Jabatan</label></div>
                    <div class="col-sm-8">
                        <input id="jbkpkeu" name="jbkpkeu" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>NIP</label></div>
                    <div class="col-sm-8">
                        <input id="nipkpkeu" name="nipkpkeu" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>BUD</label></div>
                    <div class="col-sm-8">
                        <input id="kabkep" name="kabkep" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>Jabatan</label></div>
                    <div class="col-sm-8">
                        <input id="jkabkep" name="jkabkep" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>NIP</label></div>
                    <div class="col-sm-8">
                        <input id="nipkabkep" name="nipkabkep" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>Pangkat</label></div>
                    <div class="col-sm-8">
                        <input id="bpangkep" name="bpangkep" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>Kepala Daerah</label></div>
                    <div class="col-sm-8">
                        <input id="kep" name="kep" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>Jabatan</label></div>
                    <div class="col-sm-8">
                        <input id="jbkep" name="jbkep" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>NIP</label></div>
                    <div class="col-sm-8">
                        <input id="nipkep" name="nipkep" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>PKD</label></div>
                    <div class="col-sm-8">
                        <input id="pkd" name="pkd" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>Jabatan</label></div>
                    <div class="col-sm-8">
                        <input id="jbpkd" name="jbpkd" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>NIP</label></div>
                    <div class="col-sm-8">
                        <input id="nippkd" name="nippkd" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>Nama Sekda</label></div>
                    <div class="col-sm-8">
                        <input id="nmsekda" name="nmsekda" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>Pangkat Sekda</label></div>
                    <div class="col-sm-8">
                        <input id="pangsekda" name="pangsekda" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
            <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2"><label></label></div>
                    <div class="col-sm-2"><label>NIP</label></div>
                    <div class="col-sm-8">
                        <input id="nipsekda" name="nipsekda" type="text" class="textt" style="width:40%;">
                    </div>
            </div>
			<div style="padding-top: 40px;" class="row">
				<div class="col-sm-2 col-sm-offset-4">
					<button type="submit" href="javascript:void(0)" class="btn btn-default btn-lg btn-block" onClick="javascript:saveData();">Simpan</button>
				</div>
				<div class="col-sm-2 col-sm-offset">
					<button type="button" class="btn btn-default btn-lg btn-block" onClick="javascript:back();">Batal</button>
				</div>
			</div>
		</form>
	</div>
    
<script type="text/javascript">
		window.onload = function(){
    		var thang 	= localStorage.getItem('thang');
			var periode = localStorage.getItem('periode');
            var spm = localStorage.getItem('spm');
            var kota = localStorage.getItem('kota');
            var ankep = localStorage.getItem('ankep');
            var jbankep = localStorage.getItem('jbankep');
            var pangkep = localStorage.getItem('pangkep');
            var nipankep = localStorage.getItem('nipankep');
            var kpkeu = localStorage.getItem('kpkeu');
            var jbkpkeu = localStorage.getItem('jbkpkeu');
            var nipkpkeu = localStorage.getItem('nipkpkeu');
            var kabkep = localStorage.getItem('kabkep');
            var jkabkep = localStorage.getItem('jkabkep');
            var nipkabkep = localStorage.getItem('nipkabkep');
            var bpangkep = localStorage.getItem('bpangkep');
            var kep = localStorage.getItem('kep');
            var jbkep = localStorage.getItem('jbkep');
            var nipkep = localStorage.getItem('nipkep');
            var pkd = localStorage.getItem('pkd');
            var jbpkd = localStorage.getItem('jbpkd');
            var nippkd = localStorage.getItem('nippkd');
            var nmsekda = localStorage.getItem('nmsekda');
            var pangsekda = localStorage.getItem('pangsekda');
            var nipsekda = localStorage.getItem('nipsekda');

    		$("#thang").val(thang);
			$("#periode").val(periode);
            $("#spm").val(spm);
            $("#kota").val(kota);
            $("#ankep").val(ankep);
            $("#jbankep").val(jbankep);
            $("#pangkep").val(pangkep);
            $("#nipankep").val(nipankep);
            $("#kpkeu").val(kpkeu);
            $("#jbkpkeu").val(jbkpkeu);
            $("#nipkpkeu").val(nipkpkeu);
            $("#kabkep").val(kabkep);
            $("#jkabkep").val(jkabkep);
            $("#nipkabkep").val(nipkabkep);
            $("#bpangkep").val(bpangkep);
            $("#kep").val(kep);
            $("#jbkep").val(jbkep);
            $("#nipkep").val(nipkep);
            $("#pkd").val(pkd);
            $("#jbpkd").val(jbpkd);
            $("#nippkd").val(nippkd);
            $("#nmsekda").val(nmsekda);
            $("#pangsekda").val(pangsekda);
            $("#nipsekda").val(nipsekda);
		}
		
		/*function saveData(){
			$(document).ready(function() {
				$('#fm').form('submit', {
					url: '<?php echo base_url();?>utilitas/C_config/simpan_pemda',
					success: function (data) {
						alert(data);
						mes = $.parseJSON(data);
						alert(mes.pesan);
						if (mes.pesan){
							iziToast.success({
								title: 'OK',
								message: mes.message,
							});
							localStorage.clear();
							window.location.href = "<?php echo base_url(); ?>utilitas/C_config"; 
						} else {
							iziToast.error({
								title: 'Error',
								message: mes.message,
							});
						}
					}
				});
			});
		}*/
    function saveData(){
        var thang       = $('#thang').val();
		var periode     = $('#periode').val();
        var spm         = $('#spm').val();
        var kota        = $('#kota').val();
        var ankep       = $('#ankep').val();
        var jbankep     = $('#jbankep').val();
        var pangkep     = $('#pangkep').val();
        var nipankep    = $('#nipankep').val();
        var kpkeu       = $('#kpkeu').val();
        var jbkpkeu     = $('#jbkpkeu').val();
        var nipkpkeu    = $('#nipkpkeu').val();
        var kabkep      = $('#kabkep').val();
        var jkabkep     = $('#jkabkep').val();
        var nipkabkep   = $('#nipkabkep').val();
        var bpangkep    = $('#bpangkep').val();
        var kep         = $('#kep').val();
        var jbkep       = $('#jbkep').val();
        var nipkep      = $('#nipkep').val();
        var pkd         = $('#pkd').val();
        var jbpkd       = $('#jbpkd').val();
        var nippkd      = $('#nippkd').val();
        var nmsekda     = $('#nmsekda').val();
        var pangsekda   = $('#pangsekda').val();
        var nipsekda    = $('#nipsekda').val();

        $.post('<?php echo base_url(); ?>utilitas/C_config/simpan_pemda', {thang:thang,periode:periode,spm:spm,kota:kota,ankep:ankep,jbankep:jbankep,pangkep:pangkep,nipankep:nipankep,
        kpkeu:kpkeu,jbkpkeu:jbkpkeu,nipkpkeu:nipkpkeu,kabkep:kabkep,jkabkep:jkabkep,nipkabkep:nipkabkep,bpangkep:bpangkep,kep:kep,jbkep:jbkep,nipkep:nipkep,pkd:pkd,
        jbpkd:jbpkd,nippkd:nippkd,nmsekda:nmsekda,pangsekda:pangsekda,nipsekda:nipsekda},
            function(result) {
                if (result.notif){
                    iziToast.success({
                        title: 'OK',
                        message: result.message,
                    });
                } else {
                    iziToast.success({
                        title: 'OK',
                        message: result.message,
                    });
                }
            }, "json");
    }	
	 
	function back(){
		localStorage.clear();
		window.location.href = "<?php echo base_url(); ?>utilitas/C_config";
	}				
		</script>
	</div>
</div>	