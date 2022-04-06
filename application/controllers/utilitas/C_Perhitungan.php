<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Perhitungan extends CI_Controller {

	public function index()
	{	
		$data = array(
			'page'	 	=> 'Perhitungan Ulang Gaji Pegawai',
			'judul'		=> 'Perhitungan Ulang Gaji Pegawai',
			'deskripsi'	=> 'Perhitungan Ulang Gaji Pegawai'
		);

		$this->template->views('utilitas/V_Perhitungan', $data);
	}

	function proses_hitung(){                        
		$sql = "select * from public.pegawai";
        $query = $this->db->query($sql);  
        
        foreach($query->result_array() as $resulte){
	        $nip_lama     		= $resulte['nip_lama'];
			$nip     			= $resulte['nip'];		
			$nama     			= $resulte['nama'];
			$nama1				= str_replace(array("'",""), array("",""), $nama);
			$nokartu     		= $resulte['nokartu'];
			$kota     			= $resulte['kota'];
			$kota1				= str_replace(array("'",""), array("",""), $kota);
			$agama     			= $resulte['agama'];
			$status_kawin    	= $resulte['stskawin'];
			$j_anak     		= $resulte['anak'];
			$satuan_kerja		= $resulte['satkerja'];
			$unit_kerja 		= $resulte['unit'];
			$gol     			= $resulte['golongan'];
			$masa_kerja1 		= $resulte['masa_tahun'];
			$masa_kerja2     	= $resulte['masa_bulan'];
			$t_struktural    	= $resulte['eselon'];
			$k_bantu     		= $resulte['kdbantu'];
			$gapok		 		= $resulte['gapok'];
			$gapok1		 		= $resulte['gapok'];
			$n_struktural    	= $resulte['tstruk'];
			$n_fungsional    	= $resulte['tfung'];
			$vn_khusus    		= $resulte['khusus'];
			$t_khusus    		= $resulte['kd_khusus'];
			$umum    			= $resulte['umum'];
			$sewa_rumah     	= $resulte['sewa'];
			$taperum     		= $resulte['tabungan'];
			$h_pembayaran    	= $resulte['hutang'];
			$pot_lain     		= $resulte['lain'];
			$k_perubahan     	= $resulte['ket'];
			$norek_bank     	= $resulte['rekening'];
			$norek_bank1     	= str_replace(array("'",""), array("",""), $norek_bank);
			$batas_pensiun   	= $resulte['pensiun'];
			$skorsing     		= $resulte['skorsing'];
			$t_fungsional    	= $resulte['kd_fung'];
			$t_terpencil     	= $resulte['tdt'];
			$npwp     			= $resulte['npwp'];			
			$tgl_lahir     		= $resulte['lahir'];
			$tgl_pns     		= $resulte['tmt_pns'];
			$tgl_kepangkatan 	= $resulte['tmt_pangkat'];
			$tgl_berkala     	= $resulte['tmt_berkala'];
			$tgl_jabatan     	= $resulte['sk_jab'];
			$tgl_fungsional  	= $resulte['sk_fung'];
			$jenis_kelamin 		= $resulte['seks'];
			$s_pegawai1 		= $resulte['stspegawai'];
			$s_pegawai2 		= $resulte['kdguru'];
			$tunj_beras 		= $resulte['kd_beras'];
			$s_pegawai3 		= $resulte['kd_daerah'];
			$kd_pil    			= $resulte['kd_pil'];	
			$pbb		 		= $resulte['tunggakan'];

			if($vn_khusus == ''){
				$n_khusus = 0;
			}else{
				$n_khusus = $vn_khusus;
			}
		
			if ($j_anak > 3){
				$nAnk = 3 ;
			}else{
				$nAnk = $j_anak ;
			}
			
			if ($status_kawin == 1){
				$cstatus='K1' ;
			} else if($status_kawin == 2){
				$cstatus='K2' ;
				$nAnk = 0 ;
			} else if($status_kawin == 3){
				$cstatus='TK' ;
				$nAnk = 0 ;
			} else if($status_kawin == 4){
				$cstatus='D ' ;
			} else if($status_kawin == 5){
				$cstatus='J ' ;
			}		

			if(substr($cstatus,0,1)=='K'){
				$cStatus2a = 'K ';
			}else{
				$cStatus2a = $cstatus;
			}
			if($cstatus=='K2'){
				$cStatus2b = '1';
			}else{
				$cStatus2b = '1';
			}
			if($cstatus=='K1'){
				$cStatus2c = '1';
			}else{
				$cStatus2c = '0';
			}
			if($cstatus=='K2'){
				$cStatus2d = '00';
			}else{
				$cStatus2d = '0'.$nAnk;
			}
			//$cStatus2 = $cStatus2a + $cStatus2b + $cStatus2c + $cStatus2d;
			$cStatus2 = $cStatus2a.$cStatus2b.$cStatus2c.$cStatus2d ;	
			
			if ($k_bantu==4 || $k_bantu==6){		
					if(substr($cstatus,0,1)=='K'){
						$cStatus2 = 'K '.'0000';
					}else{
						$cStatus2 = $cstatus.'0000';
					}			
			} else if($k_bantu==2){
				$papua = 0;
			}
			
			//tunjangan istri 
			$ncStatus2 = substr($cStatus2,3,1);
			$tistri 	  = ((10/100) * $gapok1 * $ncStatus2);
			
			//tunjangan anak
			$tanak   = ((2/100) * $gapok1 * $nAnk);
			$askes   = ((($gapok1) + ($tistri) + ($tanak) + ($n_struktural) + ($n_fungsional) + ($n_khusus) + ($umum)) * (4/100)) ;
			//jkk 0.24%
			$jkk_   = (($gapok1) * (0.24/100)) ;
			$jkk   = round($jkk_,0) ;
			//jkm 0.72%
			$jkm_   = (($gapok1) * (0.72/100));
			$jkm   = round($jkm_,0) ;
			
			//tunjangan beras		
			$ncStatus3 = substr($cStatus2,2,1);
			$jml_jiwa = ($ncStatus2) + ($nAnk) + ($ncStatus3);
			$beras = (10 * 7242 * ($jml_jiwa)) ;
			
			$xgol = substr($gol,0,1);
			if($xgol=='1'){
				$tdt = 0 ;
				$taperum_ = 3000 ; 
			}else if($xgol=='2'){
				$tdt = 0 ;
				$taperum_ = 5000 ; 
			}else if($xgol=='3'){
				$tdt = 0 ;
				$taperum_ = 7000 ; 
			}else if($xgol=='4'){
				$tdt = 0 ;
				$taperum_ = 10000 ; 
			}else{
				$tdt = 0 ;
				$taperum_ = 0 ;
			}
			//tdt
			//if(($t_terpencil) > 0){
			//	$t_terpencil_tdt = $tdt ;
			//}else{
				$t_terpencil_tdt = 0 ;
			//}
			
			if($satuan_kerja=='1.20.02'){
				$taperum_ = 0 ;
			}else{
				$taperum_ = ($taperum_) ;
			}
			
			
			//iwp
			$nHIT = (($gapok1) + ($tistri) + ($tanak)) * 1;
			$notochar_nHIT = $nHIT;
			$p_nHIT = strlen($notochar_nHIT);
			
			if($p_nHIT=='8'){
				$nMod = substr($notochar_nHIT,6,2); 
			}else if($p_nHIT=='7'){
				$nMod = substr($notochar_nHIT,5,2); 
			}else if($p_nHIT=='6'){
				$nMod = substr($notochar_nHIT,4,2); 
			}else if($p_nHIT=='9'){
				$nMod = substr($notochar_nHIT,7,2); 
			}else{

			}
			
			if($nMod>'49'){
				$xdigit = '1' ;
			}else{
				$xdigit = '0' ;
			}
			
			$iwp = ((1/100) * (($gapok1) + ($tistri) + ($tanak) + ($n_struktural) + ($n_fungsional) + ($n_khusus) + ($umum))) + (($xdigit));
			if($s_pegawai1=='3' && $iwp!=0){
				$iwp = 0 * (($gapok1) + ($tistri) + ($tanak)) ;
			}	

			//tht 3,25%
			/*$nHIT_tht = intval((($gapok1) + ($tistri) + ($tanak)) * 3.25);
			$notochar_nHIT_tht = $nHIT_tht;
			$p_nHIT_tht = strlen($notochar_nHIT_tht);
			
			if($p_nHIT_tht=='8'){
				$nMod_tht = substr($notochar_nHIT_tht,6,2); 
			}else if($p_nHIT_tht=='7'){
				$nMod_tht = substr($notochar_nHIT_tht,5,2); 
			}else if($p_nHIT_tht=='6'){
				$nMod_tht = substr($notochar_nHIT_tht,4,2); 
			}else{
				$nMod_tht = substr($notochar_nHIT_tht,6,2); 
			}
			
			if($nMod_tht>'49'){
				$xdigit_tht = '1' ;
			}else{
				$xdigit_tht = '0' ;
			}*/	
			$tht = ((3.25/100) * (($gapok1) + ($tistri) + ($tanak)));

			//tunj papua
			$tunj_papua = 0;
			
			if($s_pegawai1=='2'){
				$papua = ($tunj_papua) * 0.8 ;
			}else{
				$papua = ($tunj_papua) ;
			}
							
			//awal pph
			$nHITUNG = ($gapok1) + ($tistri) + ($tanak) ;
			$notochar_nHITUNG = $nHITUNG;
			$p_nHITUNG = strlen($notochar_nHITUNG);
			
			if($p_nHITUNG=='8'){
				$nMod_pph = substr($notochar_nHITUNG,6,2); 
			}else if($p_nHITUNG=='7'){
				$nMod_pph = substr($notochar_nHITUNG,5,2); 
			}else if($p_nHITUNG=='6'){
				$nMod_pph = substr($notochar_nHITUNG,4,2); 
			}else{
				
			}
			
			$nBULAT_pph  = 100 - ($nMod_pph) ;
			if(($nBULAT_pph) > 99.49){
				$nBULAT_pph = 0 ;
			}else{
				$nBULAT_pph = ($nBULAT_pph) ;
			}
			
			$nBRUTO_pph  = ($nHITUNG) + ($n_struktural) + ($n_fungsional) + ($n_khusus) + ($umum) + ($beras) + ($pot_lain) + ($papua) + ($nBULAT_pph) + ($askes)+ ($jkk)+ ($jkm) ;
			$xBRUTO_pph  = ($nHITUNG) + ($n_struktural) + ($n_fungsional) + ($n_khusus) + ($umum) + ($beras) + ($pot_lain) + ($papua) + ($askes) + ($jkk)+ ($jkm);
					
			if((($nHITUNG) * 0.0475) <= 200000){
				$nIpens = ($nHITUNG) * 0.0475 ;
			}else{
				$nIpens = 200000 ;
			}
			
			if(($xBRUTO_pph) * 0.05 < 0){
				$nBJabat = 0 ;
			}else if(($xBRUTO_pph) * 0.05 > 500000){
				$nBJabat = 500000 ;
			}else{
				$nBJabat = ($xBRUTO_pph) * 0.05 ;
			}		 
					
			$nNETTO_pph  = ($nBRUTO_pph) - (($nBJabat) + ($nIpens)) ;
			
			$nNETTO_hasil  = (($nNETTO_pph) * 12) ;
			
			
			if($cstatus=='K1'){
				$nil_cstatus = 2025000 ;
			}else{
				$nil_cstatus = 0 ;
			}
			$nPTKP = (54000000 + ($nil_cstatus)) + (2025000 * $nAnk) ;
					
			if(($nNETTO_hasil) - ($nPTKP) > 0){
				$nPKP    = ($nNETTO_hasil) - ($nPTKP) ;
				if($nPKP > 0){
					$nPKP    = ($nPKP) ;
				}else{
					$nPKP    = 0 ;
				}
				//echo($nPKP);				
				
				if(($nPKP) <= 50000000){
					$nTPajak = ($nPKP) * 0.05 ;
					//echo('100');
				}else{
					if(($nPKP) > 50000000 && ($nPKP) <= 250000000){
						$nTPajak = ((50000000*0.05)+((($nPKP)-50000000)*0.15)) ;
						//echo('2');
					}else{
						if(($nPKP)>250000000 && ($nPKP)<=500000000){
							$nTPajak = ((50000000*0.05)+(50000000*0.15)+((($nPKP)-50000000)*0.25)) ;
							//echo('3');
						}else{
							$nTPajak = ((50000000*0.05)+(50000000*0.15)+(50000000*0.25)+((($nPKP)-100000000)*0.3)) ;
							$nTPajak = 0;
							//echo('4');
						}
					}
				}
			}else{
				$nTPajak = 0 ;
			}
			$pph = $nTPajak / 12;
			
			if($npwp == ''){
				$pph = ($pph) + (($pph) * 0.20) ;
			}

			
			if($gapok1==0){
				$pph = 0 ;
			}
			// end pph
			
			//disc	
			$NHUT = 0;	
			if($tunj_beras==1){
				$ndisc   = ($iwp) + ($tht) + ($sewa_rumah) + ($taperum_) + $NHUT + ($pot_lain) + ($pph) + ($askes) + ($jkk)+ ($jkm)+ ($pbb);
			}else{
				$ndisc   = ($beras) + ($iwp) + ($tht) + ($sewa_rumah) + ($taperum_) + $NHUT + ($pot_lain) + ($pph) + ($askes) + ($jkk) + ($jkm) + ($pbb);
			}

			$xpph  = $pph ;
			$xaskes= $askes ;
			$xndisc= $ndisc ;
			$xjkk= $jkk;
			$xjkm= $jkm;
			
			$nBUL = (($gapok1) + ($tistri) + ($tanak) +  ($n_struktural) + ($n_fungsional) + ($n_khusus) + ($umum) + ($beras) +  ($pot_lain) + ($papua) + ($xaskes)+ ($xjkk)+ ($xjkm)) - ($xndisc) ;
			
			$notochar_nBul = round($nBUL,0);
			$p_nBUL = strlen($notochar_nBul);
			if($p_nBUL=='8'){
				$nMod_bulat = substr($notochar_nBul,6,2); 
			}else if($p_nBUL=='7'){
				$nMod_bulat = substr($notochar_nBul,5,2); 
			}else if($p_nBUL=='6'){
				$nMod_bulat = substr($notochar_nBul,4,2); 
			}
			
			$nBULAT_bulat  = 100 - ($nMod_bulat) ;

			if(($nBULAT_bulat) > 99.49){
				$bulat = 0 ;
			}else{
				$bulat = ($nBULAT_bulat) ;
			}
			
			//bruto
			$bruto = (($gapok1) + ($tistri) + ($tanak) +  ($n_struktural) + ($n_fungsional) + ($n_khusus) + ($umum) + ($beras) +  ($pot_lain) + ($papua) + ($xaskes)  + ($xjkk) + ($xjkm) + ($bulat)) ;
			
			//netto
			$netto  = ($bruto) - ($xndisc) ;

			$this->db->query("delete from public.pegawai where nip='$nip'");		
			$this->db->query(" insert into public.pegawai(nip_lama,nip,nama,nokartu,kota,agama,stskawin,anak,satkerja,unit,golongan,masa_tahun,masa_bulan,eselon,kdbantu,gapok,tstruk,tfung,
				sewa,tabungan,hutang,lain,ket,rekening,pensiun,skorsing,kd_fung,nip2,npwp,lahir,tmt_pns,tmt_pangkat,tmt_berkala,sk_jab,sk_fung,
				seks,stspegawai,kdguru,kd_beras,kd_daerah,tistri,tanak,tpp,kenaikan,tkespeg,askes,status,tunggakan,potongan,beras,iwp,papua,pph,disc,bulat,bruto,netto,khusus,kd_khusus,tht,jkk,jkm,umum,kd_pil)
			values('$nip_lama','$nip','$nama1','$nokartu','$kota1','$agama','$status_kawin','$j_anak','$satuan_kerja','$unit_kerja','$gol','$masa_kerja1','$masa_kerja2',
				'$t_struktural','$k_bantu','$gapok','$n_struktural','$n_fungsional','$sewa_rumah','$taperum','$h_pembayaran','$pot_lain','$k_perubahan','$norek_bank1','$batas_pensiun',
				'$skorsing','$t_fungsional','$nip','$npwp','$tgl_lahir','$tgl_pns','$tgl_kepangkatan','$tgl_berkala','$tgl_jabatan','$tgl_fungsional',
				'$jenis_kelamin','$s_pegawai1','$s_pegawai2','$tunj_beras','$s_pegawai3','$tistri','$tanak','0','0','0','$askes','$cStatus2','$pbb','$pot_lain','$beras',
				'$iwp','$papua','$pph','$ndisc','$bulat','$bruto','$netto','$n_khusus','$t_khusus','$tht','$jkk','$jkm','$umum','$kd_pil') ");
						  
		}
        echo 'Proses Perhitungan Ulang Gaji P3K Berhasil';	
 	}
	
	
 

}

