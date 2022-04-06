
			<!-- MAIN CONTENT -->
			<style>
			.fontt{
			  position:relative;
			  text-align: center;
			  font-style: italic;
			  font-family: "Lucida Handwriting" !important;
			}
			ul.activity-timeline > li {
				margin-bottom: 60px !important;
				position: relative;
				z-index: 0;
			}

			hr {
				margin-top: 10px !important;
				margin-bottom: 10px !important;
				border: 0;
					border-top-width: 0px;
					border-top-style: none;
					border-top-color: currentcolor;
				border-top: 1px solid #eee;
			}
			</style>
			<div class="main-content">
				<div class="container-fluid">
					<div class="panel panel-profile">
						<div class="clearfix">
							<h4 class="heading fontt" style="text-align:left"><b>KONFIGURASI LAPORAN DAN SPM</b></h4>
							<div class="profile-center">
								<div class="profile-detail">
									<div class="profile-info">										
										<ul class="list-unstyled list-justify">
											<li><b>Tahun Anggaran</b> &nbsp;: <?php echo $thang;?> </li>
											<li><b>Bulan</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $periode;?> </li>
											<li><b>No. SPM</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $spm;?></li>
											<li><b>Kota</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $kota;?></li><hr/>
											<li><b>Perbendaharaan</b> &nbsp;: <?php echo $ankep;?></li>
											<li><b>Jabatan</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $jbankep;?></li>
											<li><b>NIP</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $nipankep;?></li>
											<li><b>Jabatan</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $pangkep;?></li><hr/>
											<li><b>Biro Keuangan</b> &nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $kpkeu;?></li>
											<li><b>Jabatan</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $jbkpkeu;?></li>
											<li><b>NIP</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $nipkpkeu;?></li><hr/>
											<li><b>BUD</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $kabkep;?></li>
											<li><b>Jabatan</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $jkabkep;?> </li>
											<li><b>NIP</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $nipkabkep;?></li>
											<li><b>Pangkat</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $bpangkep;?></li><hr/>
											<li><b>Kepala Daerah</b> &nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $kep;?></li>
											<li><b>Jabatan</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $jbkep;?></li>
											<li><b>NIP</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $nipkep;?></li><hr/>
											<li><b>PKD</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $pkd;?></li>
											<li><b>Jabatan</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $jbpkd;?></li>
											<li><b>NIP</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $nippkd;?></li><hr/>
											<li><b>Nama Sekda</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $nmsekda;?></li>
											<li><b>Pangkat Sekda</b> &nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $pangsekda;?></li>
											<li><b>NIP</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $nipsekda;?></li><hr/>
										</ul>
									</div>
								</div>
							</div>				
						</div>
					</div>
				</div>
			</div>
			<div class="text-center pemda" style="width:100%"><a  onClick="javascript:ubah_pemda();"class="btn btn-primary"><b>Ubah Konfigurasi Laporan Dan SPM</b></a></div>
			<script>
			
			$(document).ready(function(){
				$.ajax({
                    type: "POST",
                    url: '<?php echo base_url(); ?>utilitas/C_config/get',
                    dataType:"json",
                    success:function(data){
							$.each(data,function(i,n){ 	
								thang  		= n['thang'];
								periode  	= n['periode'];
								spm			= n['spm'];
								kota		= n['kota'];
								ankep		= n['ankep'];
								jbankep		= n['jbankep'];
								pangkep		= n['pangkep'];
								nipankep	= n['nipankep'];
								kpkeu		= n['kpkeu'];
								jbkpkeu		= n['jbkpkeu'];
								nipkpkeu	= n['nipkpkeu'];
								kabkep		= n['kabkep'];
								jkabkep		= n['jkabkep'];
								nipkabkep	= n['nipkabkep'];
								bpangkep	= n['bpangkep'];
								kep			= n['kep'];
								jbkep		= n['jbkep'];
								nipkep		= n['nipkep'];
								pkd			= n['pkd'];
								jbpkd		= n['jbpkd'];
								nippkd		= n['nippkd'];
								nmsekda		= n['nmsekda'];
								pangsekda	= n['pangsekda'];
								nipsekda	= n['nipsekda'];
						  	});	
														
                    }
                });
				
				var oto = '<?php echo $this->session->userdata('oto');?>';
				if(oto=='01'){
					$('.pemda').show();
					$('.adm').hide();
				}else{
					$('.pemda').hide();
					$('.adm').show();
				}
				
			});
				
				function ubah_pemda(){
					localStorage.setItem('thang',thang);
					localStorage.setItem('periode',periode);
					localStorage.setItem('spm',spm);
					localStorage.setItem('kota',kota);
					localStorage.setItem('ankep',ankep);
					localStorage.setItem('jbankep',jbankep);
					localStorage.setItem('pangkep',pangkep);
					localStorage.setItem('nipankep',nipankep);
					localStorage.setItem('kpkeu',kpkeu);
					localStorage.setItem('jbkpkeu',jbkpkeu);
					localStorage.setItem('nipkpkeu',nipkpkeu);
					localStorage.setItem('kabkep',kabkep);
					localStorage.setItem('jkabkep',jkabkep);
					localStorage.setItem('nipkabkep',nipkabkep);
					localStorage.setItem('bpangkep',bpangkep);
					localStorage.setItem('kep',kep);
					localStorage.setItem('jbkep',jbkep);
					localStorage.setItem('nipkep',nipkep);
					localStorage.setItem('pkd',pkd);
					localStorage.setItem('jbpkd',jbpkd);
					localStorage.setItem('nippkd',nippkd);
					localStorage.setItem('nmsekda',nmsekda);
					localStorage.setItem('pangsekda',pangsekda);
					localStorage.setItem('nipsekda',nipsekda);
					window.location.href = '<?php echo site_url('utilitas/C_config/ubah_pemda'); ?>';
				}
			</script>