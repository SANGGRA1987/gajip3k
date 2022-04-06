<form id="fm" method="post" novalidate style="margin:0;padding:10px 10px" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6">
            <div style="margin-bottom:10px">
                <div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-5" style="padding-top: 3px;"><label>NIK/Nama/No. Kartu</label></div>
                    <div class="col-sm-7"><input id="no_nip" name="no_nip" type="text" class="easyui-textbox" style="width:100%;" ></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-3" style="padding-top: 3px;"><label>NIP/NPWP</label></div>
                    <div class="col-sm-4"><input id="no_nip_lama" name="no_nip_lama" type="text" class="easyui-textbox" style="width:100%;" ></div>
					<div class="col-sm-5"><input id="npwp" name="npwp" type="text" class="easyui-textbox" style="width:100%;" ></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
					<div class="col-sm-3" style="padding-top: 3px;"><label>Jenis Kelamin</label></div>			
					<div class="col-sm-5"><label class="fancy-radio" style="padding-top: 3px;"><input id="jk1" name="jenis_kelamin" value="1" type="radio"><span><i></i><label>Laki-Laki</span></label></div>
					<div class="col-sm-4"><label class="fancy-radio" style="padding-top: 3px;"><input id="jk2" name="jenis_kelamin" value="2" type="radio"><span><i></i><label>Perempuan</span></label></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-3" style="padding-top: 3px;"><label>TTL</label></div>
                    <div class="col-sm-4"><input id="tempat" name="tempat" type="text" class="easyui-textbox" style="width:100%;" ></div>
					<div class="col-sm-5">
                        <div class="input-group" style="width:100%;">
                          <input id="tgl_lahir" name="tgl_lahir" type="text" class="form-control" style="width:100%;" >
                           <span class="input-group-addon" > <i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>					
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-3" style="padding-top: 3px;"><label>Agama</label></div>
                    <div class="col-sm-9"><span id="agama" name="agama" type="text" class="easyui-textbox" style="width:100%;"><span></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-3" style="padding-top: 3px;"><label>Status Kawin</label></div>
                    <div class="col-sm-9"><span id="status_kawin" name="status_kawin" type="text" class="easyui-textbox" style="width:100%;"><span></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-3" style="padding-top: 3px;"><label>Jml. Anak</label></div>
                    <div class="col-sm-3" ><input id="j_anak" name="j_anak" type="text" class="easyui-textbox" style="width:100%; text-align: center;"  ></div>
					<div class="col-sm-6" style="padding-top: 3px;"><label>Orang</label></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-3" style="padding-top: 3px;">
                      <label>Satuan Kerja</label>
                    </div>
					<div class="col-sm-3"><span id="satuan_kerja" name="satuan_kerja" type="text" class="easyui-textbox" style="width:100%; text-align: center;"><span></div>
					<div class="col-sm-6"><input id="nm_satkerja" name="nm_satkerja" type="text" class="easyui-textbox" style="width:100%;" readonly="true"></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-3" style="padding-top: 3px;"><label>Unit Kerja</label></div>
                    <div class="col-sm-3"><span id="unit_kerja" name="unit_kerja" type="text" class="easyui-textbox" style="width:100%; text-align: center;"><span></div>
					<div class="col-sm-6"><input id="nm_unitkerja" name="nm_unitkerja" type="text" class="easyui-textbox" style="width:100%;" readonly="true"></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-3" style="padding-top: 3px;"><label>Golongan</label></div>
                    <div class="col-sm-3"><span id="gol" name="gol" type="text" class="easyui-textbox" style="width:100%; text-align: center;"><span></div>
					<div class="col-sm-6"><input id="nm_gol" name="nm_gol" type="text" class="easyui-textbox" style="width:100%;" readonly="true"></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-3" style="padding-top: 3px;"><label>Masa Kerja</label></div>
                    <div class="col-sm-3"><input id="masa_kerja1" name="masa_kerja1" type="text" class="easyui-textbox" style="width:100%; text-align: center;" ></div>
					<div class="col-sm-2"><label>Tahun</label></div>
					<div class="col-sm-3"><input id="masa_kerja2" name="masa_kerja2" type="text" class="easyui-textbox" style="width:100%;" ></div>
					<div class="col-sm-1"><label>Bulan</label></div>
                </div>	
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-3" style="padding-top: 3px;"><label>Gaji Pokok</label></div>
                    <div class="col-sm-8"><input id="gapok" name="gapok" type="text" class="form-control" style="width:100%; text-align: right;" readonly="true" disabled="disabled"></div>
		    		<div hidden class="col-sm-1"><input id="gapok1" name="gapok1" type="text" class="form-control" style="width:100%; text-align: right;" readonly="true" disabled="disabled"></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-3" style="padding-top: 3px;"><label>Tunj. Khusus</label></div>
                    <div class="col-sm-3"><input id="t_khusus" name="t_khusus" type="text" class="easyui-textbox" style="width:100%; text-align: center;" ></div>
		    		<div class="col-sm-5"><input id="n_khusus" name="n_khusus" type="text" class="form-control" style="width:100%; text-align: right;" readonly="true" disabled="disabled"></div>
					<div hidden class="col-sm-1"><input id="n_khusus1" name="n_khusus1" type="text" class="form-control" style="width:100%; text-align: right;" readonly="true" disabled="disabled"></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-12" style="padding-top: 3px;"><u><label>Tunjangan (Pilih Salah Satu)</label></u></div>
                    <div class="col-sm-0"></div>
		    		<div class="col-sm-0"></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
					<div class="col-sm-3" style="padding-top: 3px;"><label class="fancy-radio" style="padding-top: 3px;"><input id="pil_struktural" name="pilihan" value="1" onclick="opt(this.value)" type="radio"><span><i></i><label>Struktural</span></label></div>
					<div class="col-sm-3"><label class="fancy-radio" style="padding-top: 3px;"><input id="pil_fungsional" name="pilihan" value="2" onclick="opt(this.value)" type="radio"><span><i></i><label>Fungsional</span></label></div>
					<div class="col-sm-3"><label class="fancy-radio" style="padding-top: 3px;"><input id="pil_umum" name="pilihan" value="3" onclick="opt(this.value)" type="radio"><span><i></i><label>Umum</span></label></div>
					<div class="col-sm-3"><label class="fancy-radio" style="padding-top: 3px;"><input id="pil_tidak" name="pilihan" value="4" onclick="opt(this.value)" type="radio"><span><i></i><label>Tidak</span></label></div>
					
				</div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-3" style="padding-top: 3px;"><label>Tunj. Struktural</label></div>
                    <div class="col-sm-3"><input id="t_struktural" name="t_struktural" type="text" class="easyui-textbox" style="width:100%; text-align: center;" disabled="disabled"></div>
		    		<div class="col-sm-5"><input id="n_struktural" name="n_struktural" type="text" class="form-control" style="width:100%; text-align: right;" readonly="true" disabled="disabled"></div>
					<div hidden class="col-sm-1"><input id="n_struktural1" name="n_struktural1" type="text" class="form-control" style="width:100%; text-align: right;" readonly="true" disabled="disabled"></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-3" style="padding-top: 3px;"><label>Kode. Fungsional</label></div>
                    <div class="col-sm-3"><input id="t_fungsional" name="t_fungsional" type="text" class="easyui-textbox" style="width:100%; text-align: center;" disabled="disabled"></div>
		    		<div class="col-sm-5"><input id="n_fungsional" name="n_fungsional" type="text" class="form-control" style="width:100%; text-align: right;" readonly="true" disabled="disabled"></div>
					<div hidden class="col-sm-1"><input id="n_fungsional1" name="n_fungsional1" type="text" class="form-control" style="width:100%; text-align: right;" readonly="true" disabled="disabled"></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-3" style="padding-top: 3px;"><label>Umum</label></div>
                    <div class="col-sm-3"></div>
		    		<div class="col-sm-5"><input id="umum" name="umum" type="text" class="form-control" onkeypress="return(currencyFormat(this,',','.',event));" style="width:100%; text-align: right;" readonly="true" disabled="disabled"></div>
					<div hidden class="col-sm-1"><input id="umum1" name="umum1" type="text" class="form-control" style="width:100%; text-align: right;" readonly="true" disabled="disabled"></div>
                </div>
				<div class="col-sm-12" class="panel-heading" style="padding-bottom: 10px;">
                    <div class="col-sm-3" style="padding-top: 3px;"><label>Status Pegawai </label></div>
                    <div class="col-sm-3"><label class="fancy-radio" style="padding-top: 3px;"><input id="pns" name="s_pegawai1" value="1" type="radio"><span><i></i><label>P3K</span></label></div>
					<!-- <div class="col-sm-3"><label class="fancy-radio" style="padding-top: 3px;"><input id="cpns" name="s_pegawai1" value="2" type="radio"><span><i></i><label>CPNS</span></label></div>
					<div class="col-sm-3"><label class="fancy-radio" style="padding-top: 3px;"><input id="pensiun" name="s_pegawai1" value="3" type="radio"><span><i></i><label>Pensiun</span></label></div> -->
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
					<div class="col-sm-3" style="padding-top: 3px;"><label>Status Guru</label></div>
					<div class="col-sm-3"><label class="fancy-radio" style="padding-top: 3px;"><input id="non_guru" name="s_pegawai2" value="1" type="radio"><span><i></i><label>Non Guru</span></label></div>
					<div class="col-sm-3"><label class="fancy-radio" style="padding-top: 3px;"><input id="bidan" name="s_pegawai2" value="2" type="radio"><span><i></i><label>Bidan</span></label></div>
					<div class="col-sm-3"><label class="fancy-radio" style="padding-top: 3px;"><input id="perawat" name="s_pegawai2" value="3" type="radio"><span><i></i><label>Perawat</span></label></div>
					
				</div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
				<div class="col-sm-3" style="padding-top: 3px;"><label></label></div>
				<div class="col-sm-3"><label class="fancy-radio" style="padding-top: 3px;"><input id="guru" name="s_pegawai2" value="4" type="radio"><span><i></i><label>Guru</span></label></div>
				<div class="col-sm-3"><label class="fancy-radio" style="padding-top: 3px;"><input id="kesehatan" name="s_pegawai2" value="5" type="radio"><span><i></i><label>Kesehatan</span></label></div>
				</div>								
            </div>            
        </div>
		<div class="col-md-6">
            <div style="margin-bottom:10px">
					<div class="col-sm-12" style="padding-bottom: 10px;">
                    	<div class="col-sm-9"><input id="nama" name="nama" type="text" class="easyui-textbox" style="width:100%;" ></div>
                    	<div class="col-sm-2"><input id="kartu" name="kartu" type="text" class="easyui-textbox" style="width:100%; text-align: center;" ></div>
                	</div>
					<div class="col-sm-12" style="padding-bottom: 10px;">
						<div class="col-sm-5" style="padding-top: 3px;"><label>T.M.T. Fungsional</label></div>
						<div class="col-sm-6">
							<div class="input-group" style="width:80%;">
							  <input id="tgl_fungsional" name="tgl_fungsional" type="text" class="form-control" style="width:100%;" >
							   <span class="input-group-addon" > <i class="glyphicon glyphicon-calendar"></i></span>
							</div>
                    	</div>
             		</div>
					<div class="col-sm-12" style="padding-bottom: 10px;" hidden>
						<div class="col-sm-5" style="padding-top: 3px;"><label>Tunj. Terpencil</label></div>
						<div class="col-sm-4"><input id="t_terpencil" name="t_terpencil" type="text" class="form-control" onkeypress="return(currencyFormat(this,',','.',event));" style="width:100%; text-align: right;"></div>
						<div class="col-sm-0"></div>
             		</div>
					<div class="col-sm-12" style="padding-bottom: 10px;">
						<div class="col-sm-5" style="padding-top: 3px;"><label>Kode Bantu</label></div>
						<div class="col-sm-7"><span id="k_bantu" name="k_bantu" type="text" class="easyui-textbox" style="width:100%;"><span></div>
             		</div>
					<div class="col-sm-12" style="padding-bottom: 10px;">
						<div class="col-sm-5" style="padding-top: 3px;"><label>Ket. Perubahan</label></div>
						<div class="col-sm-7"><input id="k_perubahan" name="k_perubahan" type="text" class="easyui-textbox" style="width:100%;" ></div>
						<div class="col-sm-0"></div>
             		</div>
					<div class="col-sm-12" style="padding-bottom: 10px;">
						<div class="col-sm-5" style="padding-top: 3px;"><label>No. Rek. Bank</label></div>
						<div class="col-sm-7"><input id="norek_bank" name="norek_bank" type="text" class="easyui-textbox" style="width:100%;" ></div>
						<div class="col-sm-0"></div>
             		</div>
					<div class="col-sm-12" style="padding-bottom: 10px;">
					<div class="col-sm-5" style="padding-top: 3px;"><label>Tunj. Beras</label></div>			
					<div class="col-sm-3"><label class="fancy-radio" style="padding-top: 3px;"><input id="innatura" name="tunj_beras" value="1" type="radio"><span><i></i><label>InNatura</span></label></div>
					<div class="col-sm-3"><label class="fancy-radio" style="padding-top: 3px;"><input id="natura" name="tunj_beras" value="2" type="radio"><span><i></i><label>Natura</span></label></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-5" style="padding-top: 3px;"><label>T.M.T. Jabatan</label></div>
                    <div class="col-sm-6">
							<div class="input-group" style="width:80%;">
							  <input id="tgl_jabatan" name="tgl_jabatan" type="text" class="form-control" style="width:100%;" >
							   <span class="input-group-addon" > <i class="glyphicon glyphicon-calendar"></i></span>
							</div>
                    </div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-5" style="padding-top: 3px;"><label>T.M.T. P3K</label></div>
                    <div class="col-sm-6">
							<div class="input-group" style="width:80%;">
							  <input id="tgl_pns" name="tgl_pns" type="text" class="form-control" style="width:100%;" >
							   <span class="input-group-addon" > <i class="glyphicon glyphicon-calendar"></i></span>
							</div>
                    </div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-5" style="padding-top: 3px;"><label>T.M.T. Kepangkatan</label></div>
                    <div class="col-sm-6">
							<div class="input-group" style="width:80%;">
							  <input id="tgl_kepangkatan" name="tgl_kepangkatan" type="text" class="form-control" style="width:100%;" >
							   <span class="input-group-addon" > <i class="glyphicon glyphicon-calendar"></i></span>
							</div>
                    </div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-5" style="padding-top: 3px;"><label>T.M.T. Berkala</label></div>
                    <div class="col-sm-6">
							<div class="input-group" style="width:80%;">
							  <input id="tgl_berkala" name="tgl_berkala" type="text" class="form-control" style="width:100%;" >
							   <span class="input-group-addon" > <i class="glyphicon glyphicon-calendar"></i></span>
							</div>
                    </div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-5" style="padding-top: 3px;"><label>Sewa Rumah</label></div>
                    <div class="col-sm-4"><input id="sewa_rumah" name="sewa_rumah" type="text" class="form-control" onkeypress="return(currencyFormat(this,',','.',event));" style="width:100%; text-align: right;" ></div>
		    		<div class="col-sm-0"></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-5" style="padding-top: 3px;"><label>PBB</label></div>
                    <div class="col-sm-4"><input id="pbb" name="pbb" type="text" class="form-control" onkeypress="return(currencyFormat(this,',','.',event));" style="width:100%; text-align: right;" ></div>
		    		<div class="col-sm-0"></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-5" style="padding-top: 3px;"><label>Tab. Perumahan</label></div>
                    <div class="col-sm-4"><input id="taperum" name="taperum" type="text" class="form-control" onkeypress="return(currencyFormat(this,',','.',event));" style="width:100%; text-align: right;" ></div>
		    		<div class="col-sm-0"></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-5" style="padding-top: 3px;"><label>Hutang Kel. Pembayaran</label></div>
                    <div class="col-sm-4"><input id="h_pembayaran" name="h_pembayaran" type="text" class="form-control" onkeypress="return(currencyFormat(this,',','.',event));" style="width:100%; text-align: right;" ></div>
		    		<div class="col-sm-0"></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-5" style="padding-top: 3px;"><label>Pot Lain-Lain</label></div>
                    <div class="col-sm-4"><input id="pot_lain" name="pot_lain" type="text" class="form-control" onkeypress="return(currencyFormat(this,',','.',event));" style="width:100%; text-align: right;" ></div>
		    		<div class="col-sm-0"></div>
                </div>				
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-5" style="padding-top: 3px;"><label>Batas Pensiun</label></div>
                    <div class="col-sm-4"><input id="batas_pensiun" name="batas_pensiun" type="text" class="easyui-textbox" style="width:100%; text-align: center;" ></div>
		    		<div class="col-sm-3"><label>Tahun</label></div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-5" style="padding-top: 3px;"><label>Skorsing</label></div>
                    <div class="col-sm-2"><input id="skorsing" name="skorsing" type="text" class="easyui-textbox" style="width:100%; text-align: center;" ></div>
		    		<div class="col-sm-2">%</div>
                </div>
				<div class="col-sm-12" style="padding-bottom: 10px;">
                    <div class="col-sm-2" style="padding-top: 3px;"><label>Status :</label></div>
                    <div class="col-sm-3"><label class="fancy-radio" style="padding-top: 3px;"><input id="dpb" name="s_pegawai3" value="1" type="radio"><span><i></i><label>Peg DPB</span></label></div>
					<div class="col-sm-3"><label class="fancy-radio" style="padding-top: 3px;"><input id="dpk" name="s_pegawai3" value="2" type="radio"><span><i></i><label>Peg DPK</span></label></div>
					<div class="col-sm-4"><label class="fancy-radio" style="padding-top: 3px;"><input id="daerah" name="s_pegawai3" value="3" type="radio"><span><i></i><label>Peg Daerah</span></label></div>
                </div>
			</div>
		</div>		
    </div>
</form>
<div style="padding-top: 10px;" class="row">
    <div class="col-sm-2 col-sm-offset-4">
        <button type="button" class="btn btn-default btn-lg btn-block" onClick="javascript:simpan()">Simpan</button>
    </div>
    <div class="col-sm-2 col-sm-offset">
        <button type="button" class="btn btn-default btn-lg btn-block" onClick="javascript:back();">Kembali</button>
    </div>
	    <div id="progressFile" class="easyui-progressbar" style="width:50%;" hidden="true"></div>
</div>

<style>
.col-sm-4{
	padding-right: 10px !important;
    padding-left: 10px !important;
}
#map {
 height: 400px;
 width: 500px;
}
</style>

<script type="text/javascript" src="<?php echo site_url('assets/easyui/numberFormat.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/easyui/autoCurrency.js') ?>"></script>
<script type="text/javascript">

	window.onload = function(){
        var status  = localStorage.getItem('status');
        if (status == 'detail') {
			var nip 		= localStorage.getItem('nip');
			var nip_lama 	= localStorage.getItem('nip_lama');
			var nama 		= localStorage.getItem('nama');			
			var nokartu 	= localStorage.getItem('nokartu');
			var seks 		= localStorage.getItem('seks');	
			var npwp 		= localStorage.getItem('npwp');
			var kota 		= localStorage.getItem('kota');
			var lahir 		= localStorage.getItem('lahir');
			var agama 		= localStorage.getItem('agama');
			var stskawin 	= localStorage.getItem('stskawin');
			var anak 		= localStorage.getItem('anak');
			var satkerja 	= localStorage.getItem('satkerja');
			var nm_satkerja = localStorage.getItem('nm_satkerja');
			var unit 		= localStorage.getItem('unit');
			var nm_unit 	= localStorage.getItem('nm_unit');
			var golongan 	= localStorage.getItem('golongan');
			var nama_golongan = localStorage.getItem('nama_golongan');
			var masa_tahun 	= localStorage.getItem('masa_tahun');
			var masa_bulan 	= localStorage.getItem('masa_bulan');
			var gapok 		= localStorage.getItem('gapok');
			var gapok1 		= localStorage.getItem('gapok1');
			var eselon 		= localStorage.getItem('eselon');
			var tstruk 		= localStorage.getItem('tstruk');
			var tstruk1 	= localStorage.getItem('tstruk1');
			var kd_fung 	= localStorage.getItem('kd_fung');
			var tfung 		= localStorage.getItem('tfung');
			var tfung1 		= localStorage.getItem('tfung1');
			var kd_khusus 	= localStorage.getItem('kd_khusus');
			var khusus 		= localStorage.getItem('khusus');
			var khusus1 	= localStorage.getItem('khusus1');
			var umum 		= localStorage.getItem('umum');
			var umum1 		= localStorage.getItem('umum1');
			var pensiun 	= localStorage.getItem('pensiun');
			var stspegawai 	= localStorage.getItem('stspegawai');
			var kdguru 		= localStorage.getItem('kdguru');
			var sk_fung 	= localStorage.getItem('sk_fung');
			var tdt			= localStorage.getItem('tdt');
			var kdbantu 	= localStorage.getItem('kdbantu');
			var ket 		= localStorage.getItem('ket');
			var rekening 	= localStorage.getItem('rekening');
			var kd_beras 	= localStorage.getItem('kd_beras');
			var sk_jab 		= localStorage.getItem('sk_jab');
			var tmt_pns 	= localStorage.getItem('tmt_pns');
			var tmt_pangkat = localStorage.getItem('tmt_pangkat');
			var tmt_berkala = localStorage.getItem('tmt_berkala');
			var sewa 		= localStorage.getItem('sewa');
			var tunggakan 	= localStorage.getItem('tunggakan');
			var tabungan 	= localStorage.getItem('tabungan');
			var hutang 		= localStorage.getItem('hutang');
			var lain 		= localStorage.getItem('lain');
			var skorsing 	= localStorage.getItem('skorsing'); 
			var kd_daerah 	= localStorage.getItem('kd_daerah');
			var kd_pil 		= localStorage.getItem('kd_pil');			
			//var photo 	= localStorage.getItem('photo');
			$("#no_nip").textbox('setValue',nip);
			$("#no_nip_lama").textbox('setValue',nip_lama);
			$("#npwp").textbox('setValue',npwp);
			$("#tempat").textbox('setValue',kota);
			$("#tgl_lahir").datepicker("setDate", lahir);
			$("#agama").textbox('setValue',agama);
			$("#status_kawin").textbox('setValue',stskawin);
			$("#j_anak").textbox('setValue',anak);
			$("#satuan_kerja").textbox('setValue',satkerja);
			$("#nm_satkerja").textbox('setValue',nm_satkerja);
			$("#unit_kerja").textbox('setValue',unit);
			$("#nm_unitkerja").textbox('setValue',nm_unit);
			$("#gol").textbox('setValue',golongan);
			$("#nm_gol").textbox('setValue',nama_golongan);
			$("#masa_kerja1").textbox('setValue',masa_tahun);
			$("#masa_kerja2").textbox('setValue',masa_bulan);
			$('#gapok').val(gapok);
			$('#gapok1').val(gapok1);
			$("#t_struktural").textbox('setValue',eselon);
			$('#n_struktural').val(tstruk);
			$('#n_struktural1').val(tstruk1);
			$("#t_fungsional").textbox('setValue',kd_fung);
			$('#n_fungsional').val(tfung);
			$('#n_fungsional1').val(tfung1);
			$("#t_khusus").textbox('setValue',kd_khusus);
			$('#n_khusus').val(khusus);
			$('#n_khusus1').val(khusus1);
			$('#umum').val(umum);
			$('#umum1').val(umum1);
			$("#batas_pensiun").textbox('setValue',pensiun);
			$("#nama").textbox('setValue',nama);
			$("#kartu").textbox('setValue',nokartu);			
			$("#tgl_fungsional").datepicker("setDate", sk_fung);
			//$("#t_terpencil").val(tdt);
			$("#k_bantu").textbox('setValue',kdbantu);
			$("#k_perubahan").textbox('setValue',ket);
			$("#norek_bank").textbox('setValue',rekening);		
			$("#tgl_jabatan").datepicker("setDate", sk_jab);
			$("#tgl_pns").datepicker("setDate", tmt_pns);
			$("#tgl_kepangkatan").datepicker("setDate", tmt_pangkat);
			$("#tgl_berkala").datepicker("setDate", tmt_berkala);
			$("#sewa_rumah").val(sewa);
			$("#pbb").val(tunggakan);
			$("#taperum").val(tabungan);
			$("#h_pembayaran").val(hutang);
			$("#pot_lain").val(lain);
			$("#skorsing").textbox('setValue',skorsing);
			
			
			if(seks==1){
				document.getElementById("jk1").checked = true;
			}else if(seks==2){
				document.getElementById("jk2").checked = true;
			}else{				
			}

			if(stspegawai==1){
				document.getElementById("pns").checked = true;
			}else if(stspegawai==2){
				document.getElementById("cpns").checked = true;
			}else if(stspegawai==3){
				document.getElementById("pensiun").checked = true;
			}else{				
			}
			
			if(kdguru==1){
				document.getElementById("non_guru").checked = true;
			}else if(kdguru==2){
				document.getElementById("bidan").checked = true;
			}else if(kdguru==3){
				document.getElementById("perawat").checked = true;
			}else if(kdguru==4){
				document.getElementById("guru").checked = true;
			}else if(kdguru==5){
				document.getElementById("kesehatan").checked = true;
			}else{				
			}
			
			if(kd_beras==1){
				document.getElementById("innatura").checked = true;
			}else if(kd_beras==2){
				document.getElementById("natura").checked = true;
			}else{				
			}
			
			if(kd_daerah==1){
				document.getElementById("dpb").checked = true;
			}else if(kd_daerah==2){
				document.getElementById("dpk").checked = true;
			}else if(kd_daerah==3){
				document.getElementById("daerah").checked = true;
			}else{				
			}
			
			if(kd_pil==1){
				document.getElementById("pil_struktural").checked = true;
			}else if(kd_pil==2){
				document.getElementById("pil_fungsional").checked = true;
			}else if(kd_pil==3){
				document.getElementById("pil_umum").checked = true;
			}else if(kd_pil==4){
				document.getElementById("pil_tidak").checked = true;
			}else{				
			}
			
        } else {
		$("#sewa_rumah").val(0);
		$("#taperum").val(0);
		$("#h_pembayaran").val(0);
		$("#pot_lain").val(0);
		$("#pbb").val(0);	
		$("#skorsing").textbox('setValue',0);
		$("#n_khusus").val(0);
		$("#n_khusus1").val(0);
		$("#kartu").textbox('setValue',0);
		$("#j_anak").textbox('setValue',0);
		}
    }

	function back() {
        localStorage.clear();
        window.location.href = "<?php echo base_url(); ?>master/C_Pegawai";
    }
	
	function opt(val){        
        ctk = val; 
        if (ctk=='1'){
			$("#t_struktural").combogrid("enable","enable");
			$("#t_fungsional").combogrid("disable","disable");
			$("#n_fungsional").val(0);
			$("#n_fungsional1").val(0);
			$("#n_struktural").val(0);
			$("#n_struktural1").val(0);
			$("#umum").val(0);
			$("#umum1").val(0);
			$("#t_fungsional").combogrid("setValue",'');
        } else if (ctk=='2'){
            $("#t_fungsional").combogrid("enable","enable");
			$("#t_struktural").combogrid("disable","disable");
			$("#n_struktural").val(0);
			$("#n_struktural1").val(0);
			$("#n_fungsional").val(0);
			$("#n_fungsional1").val(0);
			$("#umum").val(0);
			$("#umum1").val(0);
			$("#t_struktural").combogrid("setValue",'');
        }else if (ctk=='3'){
            $("#t_fungsional").combogrid("disable","disable");
			$("#t_struktural").combogrid("disable","disable");
			$("#n_struktural").val(0);
			$("#n_struktural1").val(0);
			$("#n_fungsional").val(0);
			$("#n_fungsional1").val(0);
			$("#t_struktural").combogrid("setValue",'');
			$("#t_fungsional").combogrid("setValue",'');
        } else {
            $("#t_fungsional").combogrid("disable","disable");
			$("#t_struktural").combogrid("disable","disable");
			$("#n_struktural").val(0);
			$("#n_struktural1").val(0);
			$("#n_fungsional").val(0);
			$("#n_fungsional1").val(0);
			$("#umum").val(0);
			$("#umum1").val(0);
			$("#t_struktural").combogrid("setValue",'');
			$("#t_fungsional").combogrid("setValue",'');
        }                 
    } 
	
	function simpan(){			
		var cnama = document.getElementById('nama').value;		
		if(cnama==''){
			iziToast.error({
				title: 'Error',
				message: 'Nama Tidak boleh Kosong',
			});
			return
		}
		
		var clahir = $('#lahir').val();
		if(clahir==''){
			iziToast.error({
				title: 'Error',
				message: 'Tanggal Lahir Tidak boleh Kosong',
			});
			return
		}
		
		var cstatus_kawin     = $('#status_kawin').combogrid('getValue');
		if(cstatus_kawin==''){
			iziToast.error({
				title: 'Error',
				message: 'Status Kawin Tidak boleh Kosong',
			});
			return
		}
		
		var csatuan_kerja     = $('#satuan_kerja').combogrid('getValue');
		if(csatuan_kerja==''){
			iziToast.error({
				title: 'Error',
				message: 'Satuan Kerja Tidak boleh Kosong',
			});
			return
		}
		
		var cunit_kerja     = $('#unit_kerja').combogrid('getValue');
		if(cunit_kerja==''){
			iziToast.error({
				title: 'Error',
				message: 'Unit Kerja Tidak boleh Kosong',
			});
			return
		}
		
		var cgol     = $('#gol').combogrid('getValue');
		if(cgol==''){
			iziToast.error({
				title: 'Error',
				message: 'Golongan Tidak boleh Kosong',
			});
			return
		}
		
		var cmasa_kerja1     = $('#masa_kerja1').combogrid('getValue');
		if(cmasa_kerja1==''){
			iziToast.error({
				title: 'Error',
				message: 'Masa Kerja Tidak boleh Kosong',
			});
			return
		}
		
		var cbatas_pensiun     = $('#batas_pensiun').combogrid('getValue');
		if(cbatas_pensiun==''){
			iziToast.error({
				title: 'Error',
				message: 'Batas Pensiun Tidak boleh Kosong',
			});
			return
		}
		
		var ck_bantu     = $('#k_bantu').combogrid('getValue');
		if(ck_bantu==''){
			iziToast.error({
				title: 'Error',
				message: 'Kode Bantu Tidak boleh Kosong',
			});
			return
		}
		var status      	= localStorage.getItem('status');
		var no_nip_lama     = $('#no_nip_lama').val();
		var no_nip     		= $('#no_nip').val();		
		var nama     		= $('#nama').val();
		var kartu     		= $('#kartu').val();
		var tempat     		= $('#tempat').val();
		var agama     		= $('#agama').val();
		var status_kawin    = $('#status_kawin').val();
		var j_anak     		= $('#j_anak').val();
		var satuan_kerja	= $('#satuan_kerja').val();
		var unit_kerja 		= $('#unit_kerja').val();
		var gol     		= $('#gol').val();
		var masa_kerja1 	= $('#masa_kerja1').val();
		var masa_kerja2     = $('#masa_kerja2').val();
		var t_struktural    = $('#t_struktural').val();
		var k_bantu     	= $('#k_bantu').val();
		var gapok		 	= $('#gapok').val();
		var gapok1		 	= $('#gapok1').val();
		var n_struktural    = $('#n_struktural').val();
		var n_struktural1    = $('#n_struktural1').val();
		var n_fungsional    = $('#n_fungsional').val();
		var n_fungsional1    = $('#n_fungsional1').val();
		var n_khusus	    = $('#n_khusus').val();
		var n_khusus1	    = $('#n_khusus1').val();
		var umum		    = $('#umum').val();
		var umum1		    = $('#umum1').val();
		var sewa_rumah     	= $('#sewa_rumah').val();
		var taperum     	= $('#taperum').val();
		var h_pembayaran    = $('#h_pembayaran').val();
		var pot_lain     	= $('#pot_lain').val();
		var k_perubahan     = $('#k_perubahan').val();
		var norek_bank     	= $('#norek_bank').val();
		var batas_pensiun   = $('#batas_pensiun').val();
		var skorsing     	= $('#skorsing').val();
		var t_fungsional    = $('#t_fungsional').val();
		var t_khusus	    = $('#t_khusus').val();
		var cnpwp     		= $('#npwp').val();
		var tgl_lahir     	= $('#tgl_lahir').val();
		var tgl_pns     	= $('#tgl_pns').val();
		var tgl_kepangkatan = $('#tgl_kepangkatan').val();
		var tgl_berkala     = $('#tgl_berkala').val();
		var tgl_jabatan     = $('#tgl_jabatan').val();
		var tgl_fungsional  = $('#tgl_fungsional').val();
		var jenis_kelamin 	= document.querySelector('input[name="jenis_kelamin"]:checked').value;
		var s_pegawai1 		= document.querySelector('input[name="s_pegawai1"]:checked').value;
		var s_pegawai2 		= document.querySelector('input[name="s_pegawai2"]:checked').value;
		var tunj_beras 		= document.querySelector('input[name="tunj_beras"]:checked').value;
		var s_pegawai3 		= document.querySelector('input[name="s_pegawai3"]:checked').value;	
		var pilihan	 		= document.querySelector('input[name="pilihan"]:checked').value;		
		var pbb		 		= $('#pbb').val();
		
		if (j_anak > 3){
			nAnk = 3 ;
		}else{
			nAnk = j_anak ;
		}
		
		if (status_kawin == 1){
			cstatus='K1' ;
		} else if(status_kawin == 2){
			cstatus='K2' ;
			nAnk = 0 ;
		} else if(status_kawin == 3){
			cstatus='TK' ;
			nAnk = 0 ;
		} else if(status_kawin == 4){
			cstatus='D ' ;
		} else if(status_kawin == 5){
			cstatus='J ' ;
		}		

		if(cstatus.substr(0,1)=='K'){
			cStatus2a = 'K ';
		}else{
			cStatus2a = cstatus;
		}
		if(cstatus=='K2'){
			cStatus2b = '1';
		}else{
			cStatus2b = '1';
		}
		if(cstatus=='K1'){
			cStatus2c = '1';
		}else{
			cStatus2c = '0';
		}
		if(cstatus=='K2'){
			cStatus2d = '00';
		}else{
			cStatus2d = '0'+nAnk;
		}
		var cStatus2 = cStatus2a + cStatus2b + cStatus2c + cStatus2d;
				
		if (k_bantu==4 || k_bantu==6){		
				if(cstatus.substr(0,1)=='K'){
					cStatus2 = 'K ' + '0000';
				}else{
					cStatus2 = cstatus+'0000';
				}			
		} else if(k_bantu==2){
			var papua = 0;
		}
		
		//tunjangan istri 
		var ncStatus2 = cStatus2.substr(3,1);
		var tistri 	  = ((10/100) * gapok1 * ncStatus2);
		
		//tunjangan anak
		var tanak   = ((2/100) * gapok1 * nAnk);
		var askes   = (Number(gapok1) + Number(tistri) + Number(tanak) + Number(n_struktural1) + Number(n_fungsional1) + Number(n_khusus1)+ Number(umum1)) * (4/100) ;
		
		//jkk 0.24%
		var jkk   = (Number(gapok1)) * (0.24/100) ;
		//jkm 0.72%
		var jkm   = (Number(gapok1)) * (0.72/100) ;
		
		//tunjangan beras		
		var ncStatus3 = cStatus2.substr(2,1);
		var jml_jiwa = Number(ncStatus2) + Number(nAnk) + Number(ncStatus3);
		var beras = (10 * 7242 * (jml_jiwa)) ;
		
		
		var xgol = gol.substr(0,1);
		if(xgol=='1'){
			var tdt = 0 ;
			var taperum_ = 3000 ; 
		}else if(xgol=='2'){
			var tdt = 0 ;
			var taperum_ = 5000 ; 
		}else if(xgol=='3'){
			var tdt = 0 ;
			var taperum_ = 7000 ; 
		}else if(xgol=='4'){
			var tdt = 0 ;
			var taperum_ = 10000 ; 
		}else{
			var tdt = 0 ;
			var taperum_ = 0 ;
		}
		//tdt
		//if(angka(t_terpencil) > 0){
		//	var t_terpencil_tdt = tdt ;
		//}
		
		if(satuan_kerja=='1.20.02'){
			var taperum_ = 0 ;
		}else{
			var taperum_ = Number(taperum_) ;
		}
		
		
		//iwp 1%
		var nHIT = (Number(gapok1) + Number(tistri) + Number(tanak)+ Number(n_struktural1) + Number(n_fungsional1) + Number(n_khusus1)+ Number(umum1)) * 1;
		//conversi number to char
		var notochar_nHIT = nHIT.toString();
		//panjang char
		var p_nHIT = notochar_nHIT.length;
		
		if(p_nHIT=='8'){
			var nMod = notochar_nHIT.substr(6,2); 
		}else if(p_nHIT=='7'){
			var nMod = notochar_nHIT.substr(5,2); 
		}else if(p_nHIT=='6'){
			var nMod = notochar_nHIT.substr(4,2); 
		}else if(p_nHIT=='9'){
			var nMod = notochar_nHIT.substr(7,2); 
		}
		
		if(nMod>'49'){
			var xdigit = '1' ;
		}else{
			var xdigit = '0' ;
		}
		var iwp = ((1/100) * (Number(gapok1) + Number(tistri) + Number(tanak)+ Number(n_struktural1) + Number(n_fungsional1) + Number(n_khusus1)+ Number(umum1))) + (Number(xdigit));
		if(s_pegawai1=='3' && iwp!=0){
			var iwp = 0 * (Number(gapok1) + Number(tistri) + Number(tanak)) ;
		}
		
		//tht 3,25%	
		var tht = (0.0325 * (Number(gapok1) + Number(tistri) + Number(tanak)));
		if(s_pegawai1=='3' && tht!=0){
			var tht = 0 * (Number(gapok1) + Number(tistri) + Number(tanak)) ;
		}
		
		//tunj papua
		var tunj_papua = 0;
		
		if(s_pegawai1=='2'){
			var papua = Number(tunj_papua) * 0.8 ;
		}else{
			var papua = Number(tunj_papua) ;
		}
						
		//awal pph
		var nHITUNG = Number(gapok1) + Number(tistri) + Number(tanak) ;		
		var notochar_nHITUNG = nHITUNG.toString();
		var p_nHITUNG = notochar_nHITUNG.length;
		
		if(p_nHITUNG=='8'){
			var nMod_pph = notochar_nHITUNG.substr(6,2); 
		}else if(p_nHITUNG=='7'){
			var nMod_pph = notochar_nHITUNG.substr(5,2); 
		}else if(p_nHITUNG=='6'){
			var nMod_pph = notochar_nHITUNG.substr(4,2); 
		}
		
		var nBULAT_pph  = 100 - Number(nMod_pph) ;
		if(Number(nBULAT_pph) > 99.49){
			var nBULAT_pph = 0 ;
		}else{
			var nBULAT_pph = Number(nBULAT_pph) ;
		}
		
		var nBRUTO_pph  = Number(nHITUNG) + angka(n_struktural1) + angka(n_fungsional1) + angka(n_khusus1) + angka(umum1) + Number(beras) + angka(pot_lain) + Number(papua) + Number(nBULAT_pph) + Number(askes) + Number(jkk) + Number(jkm) ;
		var xBRUTO_pph  = Number(nHITUNG) + angka(n_struktural1) + angka(n_fungsional1) + angka(n_khusus1) + angka(umum1) + Number(beras) + angka(pot_lain) + Number(papua) + Number(askes) + Number(jkk) + Number(jkm) ;
						
		if((Number(nHITUNG) * 0.0475) <= 200000){
			var nIpens = Number(nHITUNG) * 0.0475 ;
		}else{
			var nIpens = 200000 ;
		}
		
		if(Number(xBRUTO_pph) * 0.05 < 0){
			var nBJabat = 0 ;
		}else if(Number(xBRUTO_pph) * 0.05 > 500000){
			var nBJabat = 500000 ;
		}else{
			var nBJabat = Number(xBRUTO_pph) * 0.05 ;
		}		 
				
		var nNETTO_pph  = Number(nBRUTO_pph) - (Number(nBJabat) + Number(nIpens)) ;
		
		var nNETTO_hasil  = (Number(nNETTO_pph) * 12) ;
		
		
		if(cstatus=='K1'){
			var nil_cstatus = 2025000 ;
		}else{
			var nil_cstatus = 0 ;
		}
		var nPTKP = (54000000 + Number(nil_cstatus)) + (2025000 * nAnk) ;
		
		if(Number(nNETTO_hasil) - Number(nPTKP) > 0){
			var nPKP    = Number(nNETTO_hasil) - Number(nPTKP) ;
			if(nPKP > 0){
				var nPKP    = Number(nPKP) ;
			}else{
				var nPKP    = 0 ;
			}
			
			if(Number(nPKP) <= 50000000){
				var nTPajak = Number(nPKP) * 0.05 ;
			}else{
				if(Number(nPKP) > 50000000 && Number(nPKP) <= 250000000){
					var nTPajak = ((50000000*0.05)+((Number(nPKP)-50000000)*0.15)) ;
				}else{
					if(Number(nPKP)>250000000 && Number(nPKP)<=500000000){
						var nTPajak = ((50000000*0.05)+(50000000*0.15)+((Number(nPKP)-50000000)*0.25)) ;
					}else{
						var nTPajak = ((50000000*0.05)+(50000000*0.15)+(50000000*0.25)+((Number(nPKP)-100000000)*0.3)) ;
						var nTPajak = 0 ;
					}
				}
			}			
		}else{
			var nTPajak = 0 ;
		}

		var pph = Number(nTPajak) / 12;
		
		if(npwp = ''){
			var pph = Number(pph) + (Number(pph) * 0.20) ;
		}
		
		if(gapok1==0){
			var pph = 0 ;
		}
		// end pph
		
		//disc	
		var NHUT = 0;	
		if(tunj_beras==1){
			var ndisc   = Number(iwp) + Number(tht) + angka(sewa_rumah) + Number(taperum_) + NHUT + angka(pot_lain) + Number(pph) + Number(askes) + Number(jkk) + Number(jkm) + angka(pbb);
		}else{
			var ndisc   = Number(beras) + Number(iwp) + Number(tht) + angka(sewa_rumah) + Number(taperum_) + NHUT + angka(pot_lain) + Number(pph) + Number(askes) + Number(jkk) + Number(jkm) + angka(pbb);
		}	
		//bulat
		var xpph  = Number(pph).toFixed(0) ;
		var xaskes= Number(askes).toFixed(0) ;
		var xndisc= Number(ndisc).toFixed(0) ;
		var xjkk= Number(jkk).toFixed(0) ;
		var xjkm= Number(jkm).toFixed(0) ;
		
		//var nBUL = (Number(gapok1) + Number(tistri) + Number(tanak) +  angka(n_struktural) + angka(n_fungsional) + angka(n_khusus) + Number(xpph) + Number(beras) +  angka(pot_lain) + Number(papua) + Number(t_terpencil_tdt) + Number(xaskes)) - Number(xndisc) ;
		//pph di 0 kan di penghasilan
		var nBUL = (Number(gapok1) + Number(tistri) + Number(tanak) +  angka(n_struktural1) + angka(n_fungsional1) + angka(n_khusus1) + angka(umum1) + Number(beras) +  angka(pot_lain) + Number(papua) + Number(xaskes) + Number(xjkk) + Number(xjkm)) - Number(xndisc) ;
		
			
		var notochar_nBul = nBUL.toString();
		var p_nBUL = notochar_nBul.length;		
		if(p_nBUL=='8'){
			var nMod_bulat = notochar_nBul.substr(6,2); 
		}else if(p_nBUL=='7'){
			var nMod_bulat = notochar_nBul.substr(5,2); 
		}else if(p_nBUL=='6'){
			var nMod_bulat = notochar_nBul.substr(4,2); 
		}
		
		var nBULAT_bulat  = 100 - Number(nMod_bulat) ;
		if(Number(nBULAT_bulat) > 99.49){
			var bulat = 0 ;
		}else{
			var bulat = Number(nBULAT_bulat) ;
		}
		
		//bruto
		//var bruto = (Number(gapok1) + Number(tistri) + Number(tanak) +  angka(n_struktural) + angka(n_fungsional) + angka(n_khusus) + Number(xpph) + Number(beras) +  angka(pot_lain) + Number(papua) + Number(t_terpencil_tdt) + Number(xaskes) + Number(bulat)) ;
		//pph di 0 kan di penghasilan
		var bruto = (Number(gapok1) + Number(tistri) + Number(tanak) +  angka(n_struktural1) + angka(n_fungsional1) + angka(n_khusus1) + angka(umum1) + Number(beras) +  angka(pot_lain) + Number(papua) + Number(xaskes) + Number(xjkk) + Number(xjkm) + Number(bulat)) ;
		
		//netto
		var netto  = Number(bruto) - Number(xndisc) ;
		
				       
		$.post('<?php echo base_url(); ?>master/C_Pegawai/simpan', {no_nip_lama:no_nip_lama, no_nip:no_nip,	nama:nama, kartu:kartu, tempat:tempat, agama:agama, status_kawin:status_kawin, j_anak:j_anak, satuan_kerja:satuan_kerja, unit_kerja:unit_kerja, gol:gol, masa_kerja1:masa_kerja1, masa_kerja2:masa_kerja2, t_struktural:t_struktural, k_bantu:k_bantu, gapok:gapok, n_struktural:n_struktural, n_fungsional:n_fungsional, n_khusus:n_khusus, umum:umum, sewa_rumah:sewa_rumah, taperum:taperum_, h_pembayaran:h_pembayaran, pot_lain:pot_lain, k_perubahan:k_perubahan,
 norek_bank:norek_bank, batas_pensiun:batas_pensiun, skorsing:skorsing, t_fungsional:t_fungsional, t_khusus:t_khusus, npwp:cnpwp, tgl_lahir:tgl_lahir, tgl_pns:tgl_pns,
 tgl_kepangkatan:tgl_kepangkatan, tgl_berkala:tgl_berkala, tgl_jabatan:tgl_jabatan,tgl_fungsional:tgl_fungsional,jenis_kelamin:jenis_kelamin,s_pegawai1:s_pegawai1,
 s_pegawai2:s_pegawai2,tunj_beras:tunj_beras,s_pegawai3:s_pegawai3,pilihan:pilihan,tistri:tistri,tanak:tanak,askes:askes,jkk:jkk,jkm:jkm,status:cStatus2,tunggakan:pbb,beras:beras,iwp:iwp,tht:tht,papua:papua,pph:pph,disc:ndisc,bulat:bulat,bruto:bruto,netto:netto}, 
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

    $(document).ready(function() {
		
		$('#tgl_lahir').datepicker({
              format: 'dd-mm-yyyy',
        autoclose:true
        });
		$('#tgl_fungsional').datepicker({
              format: 'dd-mm-yyyy',
        autoclose:true
        });
		$('#tgl_jabatan').datepicker({
              format: 'dd-mm-yyyy',
        autoclose:true
        });
		$('#tgl_pns').datepicker({
              format: 'dd-mm-yyyy',
        autoclose:true
        });
		$('#tgl_kepangkatan').datepicker({
              format: 'dd-mm-yyyy',
        autoclose:true
        });
		$('#tgl_berkala').datepicker({
              format: 'dd-mm-yyyy',
        autoclose:true
        });
				
		$('#status_kawin').combogrid({
            panelWidth:400,  
            idField:'kode',  
            textField:'nama_statuskawin',  
            url:'<?php echo base_url(); ?>master/C_Pegawai/get_statuskawin', 
            mode:'remote',
            columns:[[  
               {field:'kode',title:'Kode',width:70,align:'center'},  
               {field:'nama_statuskawin',title:'Uraian',width:300}    
            ]],
			onSelect:function(rowIndex,rowData){
			kode = rowData.kode;
				if (kode=='2' || kode=='3'){
				$("#j_anak").textbox("disable","disable");
				$("#j_anak").textbox('setValue',0);
				}else{
				$("#j_anak").textbox("enable","enable");
				}
			}
        });
		
		$('#k_bantu').combogrid({
            panelWidth:500,  
            idField:'kode',  
            textField:'nama_bantu',  
            url:'<?php echo base_url(); ?>master/C_Pegawai/get_kodebantu', 
            mode:'remote',
            columns:[[  
               {field:'kode',title:'Kode',width:70,align:'center'},  
               {field:'nama_bantu',title:'Uraian',width:400}    
            ]],
			onSelect:function(rowIndex,rowData){
			kode = rowData.kode;
			
				if (kode=='4'){
					$("#skorsing").textbox('setValue',0);
					$("#skorsing").textbox("enable","enable");					
				}else{
					$("#skorsing").textbox('setValue',0);
					$("#skorsing").textbox("disable","disable");
				}
				
				if (kode=='6'){
					$("#sewa_rumah").val(0);
					$("#taperum").val(0);
					$("#h_pembayaran").val(0);
					$("#pot_lain").val(0);
					//$("#sewa_rumah").attr("disabled","disabled");
					//$("#h_pembayaran").attr("disabled","disabled");
					//$("#pot_lain").attr("disabled","disabled");					
				}
				//else{
					//$("#sewa_rumah").attr("enable","enable");
					//$("#taperum").attr("enable","enable");
					//$("#h_pembayaran").attr("enable","enable");
					//$("#pot_lain").attr("enable","enable");
				//}
			}
        });
		
		$('#agama').combogrid({
            panelWidth:500,  
            idField:'kode',  
            textField:'nama_agama',  
            url:'<?php echo base_url(); ?>master/C_Pegawai/get_agama', 
            mode:'remote',
            columns:[[  
               {field:'kode',title:'Kode',width:70,align:'center'},  
               {field:'nama_agama',title:'Uraian',width:400}    
            ]],
			onSelect:function(rowIndex,rowData){
			}
        });
		
		$('#satuan_kerja').combogrid({
            panelWidth:700,  
            idField:'satkerja',  
            textField:'satkerja',  
            url:'<?php echo base_url(); ?>master/C_Pegawai/get_satker', 
            mode:'remote',
            columns:[[  
               {field:'satkerja',title:'Kode',width:100,align:'center'},  
               {field:'nm_satkerja',title:'Nama Satker',width:600}    
            ]],
			onSelect:function(rowIndex,rowData){
               satkerja = rowData.satkerja;
			   nm_satkerja = rowData.nm_satkerja;
			   $("#nm_satkerja").textbox('setValue',nm_satkerja);
			   $('#unit_kerja').combogrid({url:'<?php echo base_url(); ?>master/C_Pegawai/getUnit',
			   queryParams:({satkerja:satkerja})
			   });
			}
        });
		
		$('#unit_kerja').combogrid({
            panelWidth:700,  
            idField:'unit',  
            textField:'unit',  
            mode:'remote',
            columns:[[  
               {field:'unit',title:'Kode',width:100},  
               {field:'nm_unit',title:'Nama Unit',width:700}    
            ]],  
            onSelect:function(rowIndex,rowData){
			nm_unit = rowData.nm_unit;
			$("#nm_unitkerja").textbox('setValue',nm_unit);
            }  
        });

		$('#gol').combogrid({
            panelWidth:700,  
            idField:'golongan',  
            textField:'golongan',  
            url:'<?php echo base_url(); ?>master/C_Pegawai/get_gol', 
            mode:'remote',
            columns:[[  
               {field:'golongan',title:'Kode',width:100,align:'center'},  
               {field:'nm_golongan',title:'Nama Golongan',width:400,align:'left'}, 
			   {field:'umum',title:'Tunj Umum',width:100,align:'right'}   
            ]],
			onSelect:function(rowIndex,rowData){
			   var golongan = rowData.golongan;
               var nm_golongan = rowData.nm_golongan;
			   tumum = rowData.umum;
			   ntumum= number_format(tumum, 0,'.',',');
			   $('#umum').val(ntumum);
			   $('#umum1').val(tumum);
			   $("#nm_gol").textbox('setValue',nm_golongan);  
			   document.getElementById("pil_umum").checked = true;	
			   $("#t_fungsional").combogrid("disable","disable");
			   $("#n_fungsional").val(0);
				$("#t_struktural").combogrid("disable","disable");
				$("#n_struktural").val(0);				
				$("#t_struktural").combogrid("setValue",'');
				$("#t_fungsional").combogrid("setValue",''); 
			   $('#masa_kerja1').combogrid({url:'<?php echo base_url(); ?>master/C_Pegawai/get_masakerja',
			   queryParams:({golongan:golongan}),			   
			   });
			   $('#t_fungsional').combogrid({url:'<?php echo base_url(); ?>master/C_Pegawai/get_fungsional',
			   queryParams:({golongan:golongan}),			   
			   });
			}
        });
		
		$('#masa_kerja1').combogrid({
            panelWidth:200,  
            idField:'tahun',  
            textField:'tahun',  
            mode:'remote',
            columns:[[  
               {field:'tahun',title:'Tahun',width:80},  
               {field:'gapok',title:'Gapok',width:100}    
            ]],  
            onSelect:function(rowIndex,rowData){
			tahun = rowData.tahun;
			gapok = rowData.gapok;
			ngapok= number_format(gapok, 0,'.',',');
			$('#masa_kerja1').val(tahun);	
			$('#gapok').val(ngapok);	
			$('#gapok1').val(gapok);
			$("#masa_kerja2").textbox('setValue',0);
            }  
        });
		
		$('#t_struktural').combogrid({
            panelWidth:400,  
            idField:'eselon',  
            textField:'eselon',  
            url:'<?php echo base_url(); ?>master/C_Pegawai/get_eselon', 
            mode:'remote',
            columns:[[  
               {field:'eselon',title:'Kode',width:80,align:'center'},  
               {field:'nm_eselon',title:'Nama Eselon',width:200},
			   {field:'jumlah',title:'Nilai',width:100}     
            ]],
			onSelect:function(rowIndex,rowData){
               eselon = rowData.eselon;
			   nm_eselon = rowData.nm_eselon;
			   jumlah = rowData.jumlah;
			   njumlah= number_format(jumlah, 0,'.',',');
			   $('#n_struktural').val(njumlah);
			   $('#n_struktural1').val(jumlah);
			}
        });
		
		$('#t_fungsional').combogrid({
            panelWidth:200,  
            idField:'kd_fung',  
            textField:'kd_fung',  
            url:'<?php echo base_url(); ?>master/C_Pegawai/get_fungsional', 
            mode:'remote',
            columns:[[  
               {field:'kd_fung',title:'Kode',width:80,align:'center'}, 
			   {field:'jumlah',title:'Nilai',width:100}     
            ]],
			onSelect:function(rowIndex,rowData){
               kd_fung = rowData.kd_fung;
			   jumlah = rowData.jumlah;
			   njumlah= number_format(jumlah, 0,'.',',');
			   $('#n_fungsional').val(njumlah);
			   $('#n_fungsional1').val(jumlah);
			}
        });
		
		$('#t_khusus').combogrid({
            panelWidth:500,  
            idField:'kd_khusus',  
            textField:'kd_khusus',  
            url:'<?php echo base_url(); ?>master/C_Pegawai/get_khusus', 
            mode:'remote',
            columns:[[  
               {field:'kd_khusus',title:'Kode',width:80,align:'center'}, 
			   {field:'uraian',title:'Kode',width:300,align:'left'},
			   {field:'tnkhusus',title:'Nilai',width:100,align:'right'}     
            ]],
			onSelect:function(rowIndex,rowData){
               kd_khusus = rowData.kd_khusus;
			   tnkhusus = rowData.tnkhusus;
			   ntnkhusus= number_format(tnkhusus, 0,'.',',');
			   $('#n_khusus').val(ntnkhusus);
			   $('#n_khusus1').val(tnkhusus);
			}
        });
		
		$('#batas_pensiun').combogrid({
            panelWidth:110,  
            idField:'umur',  
            textField:'umur',  
            url:'<?php echo base_url(); ?>master/C_Pegawai/get_pensiun', 
            mode:'remote',
            columns:[[  
               {field:'umur',title:'Umur',width:80,align:'center'}
            ]],
			onSelect:function(rowIndex,rowData){
               umur = rowData.umur;
			}
        });
		
		$('#masa_kerja2').combogrid({
            panelWidth:300,  
            idField:'n_bulan',  
            textField:'n_bulan',  
            url:'<?php echo base_url(); ?>master/C_Pegawai/get_bulan', 
            mode:'remote',
            columns:[[  
               {field:'n_bulan',title:'Bulan',width:70,align:'center'},
			   {field:'nama_bulan',title:'Nama Bulan',width:200,align:'left'}
            ]],
			onSelect:function(rowIndex,rowData){
               n_bulan = rowData.n_bulan;
			}
        });		
    });
	
</script>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAP5P2jPNd49MKMeOphABZ2PgiYdBeS6qk&callback=initMap">
</script>

<div id="dlg" class="easyui-dialog" closed="true" buttons="#dlg-buttons">
    <div class="row" style="width: 100%">
		<div class="col-md-12">
		<div id="map" style="width:650px;height: 500px;"></div>     
		</div>
	</div>
</div>