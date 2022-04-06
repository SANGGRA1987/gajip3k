<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_rekap_gaji extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('laporan/lap_rekapitulasi/M_rekap_gaji');
	}

	function _mpdf($judul='',$isi='',$lMargin=10,$rMargin=10,$font=10,$orientasi) {
        ob_clean();
       	ini_set("memory_limit","-1");
        $this->load->library('M_pdf');
        $mpdf = new m_pdf('', 'Letter-L');
        $pdfFilePath = "output_pdf_name.pdf";
        $mpdf->pdf->SetFooter('Printed Simgaji on @ {DATE j-m-Y H:i:s} || Halaman {PAGENO} dari {nb}');
        $mpdf->pdf->AddPage($orientasi);
        if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
        $mpdf->pdf->WriteHTML($isi);         
        $mpdf->pdf->Output();
               
    }

	public function index()
	{	
		$data = array(
			'page'	 	=> 'LAPORAN REKAP DAFTAR GAJI PEGAWAI P3K',
			'judul'		=> 'LAPORAN REKAP DAFTAR GAJI PEGAWAI P3K',
			'deskripsi'	=> 'LAPORAN REKAP DAFTAR GAJI PEGAWAI P3K'
		);

		$this->template->views('laporan/lap_rekapitulasi/V_rekap_gaji', $data);
	}
	
	public function  tanggal_balik($tgl){
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	 
		$xtgl 	= substr($tgl, 0, 2);
		$xbulan 	= substr($tgl, 3, 2);
		$xtahun  = substr($tgl, 6, 4);
	 
		$result = $xtgl . " " . $BulanIndo[(int)$xbulan-1] . " ". $xtahun;		
		return($result);
	}
	
	function  tanggal_format_indonesia($tgl){
            
        $tanggal  = explode('-',$tgl); 
        $bulan  = $this->getBulanIndo($tanggal[1]);
        $tahun  =  $tanggal[0];
        return  $tanggal[2].' '.$bulan.' '.$tahun;

    }
	
	function  getBulanIndo($bln){
        switch  ($bln){
        case  01:
        return  "Januari";
        break;
        case  02:
        return  "Februari";
        break;
        case  03:
        return  "Maret";
        break;
        case  04:
        return  "April";
        break;
        case  05:
        return  "Mei";
        break;
        case  06:
        return  "Juni";
        break;
        case  07:
        return  "Juli";
        break;
        case  08:
        return  "Agustus";
        break;
        case  09:
        return  "September";
        break;
        case  10:
        return  "Oktober";
        break;
        case  11:
        return  "November";
        break;
        case  12:
        return  "Desember";
        break;
		}
    }

	public function getConfig()
	{
		return $this->M_rekap_gaji->getConfig();
	}

	public function getBulan()
	{
		echo $this->M_rekap_gaji->getBulan();
	}

	public function getTahun()
	{
		echo $this->M_rekap_gaji->getTahun();
	}

	public function getSkpd()
	{
		echo $this->M_rekap_gaji->getSkpd(); 
	}

	public function getUnitSkpd()
	{
		$param = $this->uri->segment(5);
		echo $this->M_rekap_gaji->getUnitSkpd($param);
	}

	public function cetakLaporan()
	{
		$config = $this->getConfig();
		$kota	= strtoupper($config['nm_daerah']);
		$thn	= strtoupper($config['thn']);
		$jenisCetak = $this->input->get('jenisCetak');
		$tgl_cetak = $this->tanggal_balik($this->input->get('tglcetak'));
		$skpd = $this->input->get('skpd');
		$nmskpd = $this->input->get('nmskpd');
		$bulan = $this->getBulanIndo($this->input->get('bulan_tglcetak'));
		
		$data = array(
			'nm_kab'	 	=> strtoupper($config['nm_daerah']),
		);

		$bluePrint = $this->M_rekap_gaji->cetakLaporan($data);
		$nippa = $bluePrint[0]['nippa'];
		$namapa = $bluePrint[0]['namapa'];
		$nipbk = $bluePrint[1]['nipbk'];
		$namabk = $bluePrint[1]['namabk'];

		$cRet ='';
        $cRet .= "
        		<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            		<tr>
                		<td></td>
                		<td align=\"center\" colspan=\"14\" style=\"font-size:14px;border: solid 1px white;\"><B>REKAPITULASI DAFTAR GAJI PEGAWAI P3K KESELURUHAN</B></td>
                	</tr>
            		<tr>
                		<td></td>
                		<td align=\"center\" colspan=\"14\" style=\"font-size:12px;border: solid 1px white;\"><B>BULAN : <b>".strtoupper($bulan)." $thn</B></td>
            		</tr><BR/>
        		</table>
        		";
        
		$cRet .="
				<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                	<thead>
                		<tr>
                    		<td align=\"left\" colspan=\"13\" style=\"font-size:10px;border: solid 1px white;border-bottom:solid 1px black;\">&ensp;</td>
        		        </tr>
                	</thead>
                		<tr>
                			<td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" style=\"font-size:10px\">NO.</br></td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width=\"250px\" rowspan=\"2\" style=\"font-size:10px\">SATUAN KERJA</td>		                    
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" colspan=\"6\" style=\"font-size:10px\">PENGHASILAN</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" colspan=\"4\" style=\"font-size:10px\">POTONGAN</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" style=\"font-size:10px\">JUMLAH BERSIH</td>
                		</tr>
                		<tr>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"1\" style=\"font-size:10px\">GAJI POKOK<br>TUNJ.ISTRI/SMI<br>TUNJ.ANAK<br>JUMLAH</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"1\" style=\"font-size:10px\">TUNJ.ESELON<br>TUNJ FUNG UMUM<br>TJ. FUNGSIONAL<br>TJ.KHUSUS</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"1\" style=\"font-size:10px\">TUNJ.TERPENCIL<br>TKD<br>TUNJ.BERAS<br>TUNJ.PAJAK</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"1\" style=\"font-size:10px\">BPJSKES 4%<br>TUNJ.JKK<br>TUNJ.JKM<br>TAPERA PK</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"1\" style=\"font-size:10px\">PEMBULATAN</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"1\" style=\"font-size:10px\">JUMLAH KOTOR</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"1\" style=\"font-size:10px\">POT.PAJAK<br>BPJSKES 4%<br>POT IWP 1%<br>IWP 3,210</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"1\" style=\"font-size:10px\">POT.TAPERUM<br>POT.JKK<br>POT.JKM<br>TAPERA PK</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"1\" style=\"font-size:10px\">TAPERA PEG<br>HUTANG/LAIN-2<br>BULOG<br>SEWA.RUMAH</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"1\" style=\"font-size:10px\">JUMLAH POTONGAN</td>
                		</tr> "; 

                		$cRet .="
                		<tr>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"3%\" style=\"font-size:10px\">1</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"11%\" style=\"font-size:10px\">2</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"7%\" style=\"font-size:10px\">3</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"7%\" style=\"font-size:10px\">4</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"7%\" style=\"font-size:10px\">5</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"7%\" style=\"font-size:10px\">6</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"7%\" style=\"font-size:10px\">7</td>
							<td bgcolor=\"#CCCCCC\" align=\"center\" width =\"10%\" style=\"font-size:10px\">8</td>
							<td bgcolor=\"#CCCCCC\" align=\"center\" width =\"7%\" style=\"font-size:10px\">9</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"7%\" style=\"font-size:10px\">10</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"7%\" style=\"font-size:10px\">11</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"10%\" style=\"font-size:10px\">12</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"10%\" style=\"font-size:10px\">13</td>
                		</tr>";

            		$sql = "SELECT satkerja, nm_satkerja from satkerja order by satkerja;";

						$query = $this->db->query($sql);
						$i = 0;
						$jum_gapok = 0;
						$jum_tistri = 0;
						$jum_tanak = 0;
						$jum_tkeluarga = 0;
						$jum_tpp = 0;
						$jum_papua = 0;
						$jum_tdt = 0;
						$jum_tstruk = 0;
						$jum_tfung = 0;
						$jum_bulat = 0;
						$jum_beras = 0;
						$jum_umum = 0;
						$jum_pph = 0;
						$jum_askes = 0;
						$jum_bruto = 0;
						$jum_iwp = 0;
						$jum_sewa = 0;
						$jum_tabungan = 0;
						$jum_hutang = 0;
						$jum_lain = 0;
						$jum_jum_pot = 0;
						$jum_netto = 0;
						$jum_jkk = 0;
						$jum_jkm = 0;
						$jum_khusus = 0;
				        foreach ($query->result() as $row) {
				        $i++;
				        $csatkerja   	= $row->satkerja; 
				        $cnm_satkerja   = $row->nm_satkerja;

							$sql2 = "SELECT satkerja, sum(gapok) as gapok,sum(tistri) as tistri,sum(tanak) as tanak,
							sum(gapok+tistri+tanak) as tkeluarga,sum(tpp) as tpp,sum(papua) as papua,sum(tdt) as tdt,sum(tstruk) as tstruk,
							sum(case when left(kd_fung,1)<>'U' then tfung else 0 end) as tfung,sum(bulat) as bulat,sum(beras) as beras,
							sum(case when left(kd_fung,1)='U' then tfung else 0 end) as umum,sum(pph) as pph,sum(askes) as askes,sum(bruto) as bruto,
							sum(iwp) as iwp,sum(sewa) as sewa,sum(tabungan) as tabungan,sum(hutang) as hutang,
							sum(lain) as lain,sum(disc) as jum_pot,sum(netto) as netto, sum(jkk) as jkk, sum(jkm) as jkm, sum(khusus) as khusus 
							from pegawai WHERE satkerja = '$csatkerja' group by satkerja order by satkerja;";

							$query2 = $this->db->query($sql2); 
					        foreach ($query2->result() as $row) {
					                $gapok         =$row->gapok;
					                $tistri        =$row->tistri;
					                $tanak         =$row->tanak;
					                $tkeluarga     =$row->tkeluarga;
					                $tpp           =$row->tpp;
					                $papua         =$row->papua;
					                $tdt           =$row->tdt;
					                $tstruk        =$row->tstruk;
					                $tfung         =$row->tfung;
					                $bulat         =$row->bulat;
					                $beras         =$row->beras;
					                $umum          =$row->umum;
					                $pph           =$row->pph;
					                $askes         =$row->askes;
					                $bruto         =$row->bruto;
					                $iwp           =$row->iwp;
					                $sewa          =$row->sewa;
					                $tabungan      =$row->tabungan;
					                $hutang        =$row->hutang;
					                $lain          =$row->lain;
					                $jum_pot       =$row->jum_pot; 
					                $netto         =$row->netto;
					                $jkk           =$row->jkk;
					                $jkm           =$row->jkm;
					                $khusus        =$row->khusus;

					                $jum_gapok 		= $jum_gapok + $gapok ;                  
									$jum_tistri 	= $jum_tistri + $tistri ;                
									$jum_tanak 		= $jum_tanak + $tanak ;                  
									$jum_tkeluarga 	= $jum_tkeluarga + $tkeluarga ;          
									$jum_tpp 		= $jum_tpp + $tpp ;                      
									$jum_papua 		= $jum_papua + $papua ;                  
									$jum_tdt 		= $jum_tdt + $tdt ;                      
									$jum_tstruk 	= $jum_tstruk + $tstruk ;                
									$jum_tfung 		= $jum_tfung + $tfung ;                  
									$jum_bulat 		= $jum_bulat + $bulat ;                  
									$jum_beras 		= $jum_beras + $beras ;                  
									$jum_umum 		= $jum_umum + $umum ;                    
									$jum_pph 		= $jum_pph + $pph ;                      
									$jum_askes 		= $jum_askes + $askes ;                  
									$jum_bruto 		= $jum_bruto + $bruto ;                  
									$jum_iwp 		= $jum_iwp + $iwp ;                      
									$jum_sewa 		= $jum_sewa + $sewa ;                    
									$jum_tabungan 	= $jum_tabungan + $tabungan ;            
									$jum_hutang 	= $jum_hutang + $hutang ;                
									$jum_lain 		= $jum_lain + $lain ;                    
									$jum_jum_pot 	= $jum_jum_pot + $jum_pot ;              
									$jum_netto 		= $jum_netto + $netto ;                  
									$jum_jkk 		= $jum_jkk + $jkk ;                      
									$jum_jkm 		= $jum_jkm + $jkm ;                      
									$jum_khusus 	= $jum_khusus + $khusus ;                
			
									$cRet .="
					   			         <tr>
					                        <td align=\"center\" style=\"font-size:11px\">$i</td>
					                        <td align=\"left\" style=\"font-size:11px\">$cnm_satkerja</td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($gapok,0,',','.')."<br>".number_format($tistri,0,',','.')."</br><br>".number_format($tanak,0,',','.')."</br><br>---------------------</br><br>".number_format($tkeluarga,0,',','.')."</br></td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($tstruk,0,',','.')."<br>".number_format($umum,0,',','.')."</br><br>".number_format($tfung,0,',','.')."</br><br>".number_format($khusus,0,',','.')."</br></td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($tdt,0,',','.')."<br>".number_format(0,0,',','.')."</br><br>".number_format($beras,0,',','.')."</br><br>".number_format($pph,0,',','.')."</br></td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($askes,0,',','.')."<br>".number_format($jkk,0,',','.')."</br><br>".number_format($jkm,0,',','.')."</br><br>".number_format(0,0,',','.')."</br></td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($bulat,0,',','.')."</br></td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($bruto,0,',','.')."</td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($iwp,0,',','.')."<br>".number_format($askes,0,',','.')."</br></td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($pph,0,',','.')."<br>".number_format($beras,0,',','.')."</br></td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($sewa,0,',','.')."<br>".number_format($tabungan,0,',','.')."</br><br>".number_format($hutang,0,',','.')."</br><br>".number_format($lain,0,',','.')."</br></td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($jum_pot,0,',','.')."</td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($netto,0,',','.')."</td>
					                    </tr>";					            
					    	}
					    }					    
					    			$cRet .="
					   			         <tr>
					                        <td align=\"center\" style=\"font-size:11px\"></td>
					                        <td align=\"left\" style=\"font-size:11px\">JUMLAH KESELURUHAN</td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($jum_gapok,0,',','.')."<br>".number_format($jum_tistri,0,',','.')."</br><br>".number_format($jum_tanak,0,',','.')."</br><br>---------------------</br><br>".number_format($jum_tkeluarga,0,',','.')."</br></td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($jum_tstruk,0,',','.')."<br>".number_format($jum_umum,0,',','.')."</br><br>".number_format($jum_tfung,0,',','.')."</br><br>".number_format($jum_khusus,0,',','.')."</br></td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($jum_tdt,0,',','.')."<br>".number_format(0,0,',','.')."</br><br>".number_format($jum_beras,0,',','.')."</br><br>".number_format($jum_pph,0,',','.')."</br></td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($jum_askes,0,',','.')."<br>".number_format($jum_jkk,0,',','.')."</br><br>".number_format($jum_jkm,0,',','.')."</br><br>".number_format(0,0,',','.')."</br></td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($jum_bulat,0,',','.')."</br></td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($jum_bruto,0,',','.')."</td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($jum_iwp,0,',','.')."<br>".number_format($jum_askes,0,',','.')."</br></td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($jum_pph,0,',','.')."<br>".number_format($jum_beras,0,',','.')."</br></td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($jum_sewa,0,',','.')."<br>".number_format($jum_tabungan,0,',','.')."</br><br>".number_format($jum_hutang,0,',','.')."</br><br>".number_format($jum_lain,0,',','.')."</br></td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($jum_jum_pot,0,',','.')."</td>
					                        <td align=\"right\" style=\"font-size:11px\">".number_format($jum_netto,0,',','.')."</td>
					                    </tr>";	
        		$cRet .="</table>"; 

                  /*$cRet .="
        		<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
            
                     <tr>
						<td align=\"left\" style=\"font-size:9px;\" width=\"30%\"></td>                    
						<td align=\"center\" style=\"font-size:9px;\" width=\"1%\"></td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"10%\"></td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"10%\"></td>
						<td align=\"center\" style=\"font-size:12px;\" width=\"40%\">AGATS,$tgl_cetak </td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"8%\"></td>
	
					</tr>
                    <tr>
						<td align=\"left\" style=\"font-size:9px;\" width=\"30%\">1. JUMLAH PEGAWAI NON GURU</td>                    
						<td align=\"center\" style=\"font-size:9px;\" width=\"1%\">:</td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"10%\">".number_format($jum_nonguru,0,',','.')."</td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"10%\"></td>
						<td align=\"center\" style=\"font-size:12px;\" width=\"40%\">PEJABAT PENGELOLA KEUANGAN DAN ASET DAERAH</td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"8%\"></td>
		
					</tr> 
					 <tr>
						<td align=\"left\" style=\"font-size:9px;\" width=\"30%\">2. JUMLAH PEGAWAI GURU</td>                    
						<td align=\"center\" style=\"font-size:9px;\" width=\"1%\">:</td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"10%\">".number_format($jum_guru,0,',','.')."</td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"10%\"></td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"40%\"></td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"8%\"></td>
		
					</tr> 
					 <tr>
						<td align=\"left\" style=\"font-size:9px;\" width=\"30%\">3. JUMLAH PEGAWAI TENAGA KESEHATAN</td>                    
						<td align=\"center\" style=\"font-size:9px;\" width=\"1%\">:</td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"10%\">".number_format($jum_kes,0,',','.')."<br>---------</br></td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"10%\"></td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"40%\"></td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"8%\"></td>
		
					</tr> 

					<tr>
						<td align=\"right\" style=\"font-size:9px;\" width=\"30%\">JUMLAH</td>                    
						<td align=\"center\" style=\"font-size:9px;\" width=\"1%\">:</td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"10%\">".number_format($jum_total_peg,0,',','.')."</td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"10%\"></td>
						<td align=\"center\" style=\"font-size:12px;\" width=\"40%\">HALASSON F SINURAT, STTP,M.SI</td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"8%\"></td>
		
					</tr> 
					<tr>
						<td align=\"right\" style=\"font-size:9px;\" width=\"30%\"></td>                    
						<td align=\"center\" style=\"font-size:9px;\" width=\"1%\"></td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"10%\"></td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"10%\"></td>
						<td align=\"center\" style=\"font-size:12px;\" width=\"40%\">PENATA TINGKAT I</td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"8%\"></td>
		
					</tr> 
					<tr>
						<td align=\"right\" style=\"font-size:9px;\" width=\"30%\"></td>                    
						<td align=\"center\" style=\"font-size:9px;\" width=\"1%\"></td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"10%\"></td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"10%\"></td>
						<td align=\"center\" style=\"font-size:12px;\" width=\"40%\">NIP. 19810824199912</td>
						<td align=\"left\" style=\"font-size:9px;\" width=\"8%\"></td>
		
					</tr> 

                  </table>";*/


		        $data['prev']= $cRet;
		        $judul  = 'LAPORAN REKAP DAFTAR GAJI PEGAWAI P3K';
		        switch ($data['tipeCetakan']) {
		        	case 0:
		        		$this->_mpdf('',$cRet,10,10,10,'L');
		        		break;
		        	case 1:
		        		header("Cache-Control: no-cache, no-store, must-revalidate");
			            header("Content-Type: application/vnd.ms-excel");
			            header("Content-Disposition: attachment; filename= $judul.xlsx");
			            $this->load->view('transaksi/excel', $data);
			            break;
	        		case 2:
	        			header("Cache-Control: no-cache, no-store, must-revalidate");
			            header("Content-Type: application/vnd.ms-word");
			            header("Content-Disposition: attachment; filename= $judul.doc");
			           	$this->load->view('transaksi/excel', $data);
	        			break;
		        	default:
		        		echo "Error";
		        		break;
		        }

	}
	
	public function cetakLaporan_lama()
	{
		$config = $this->getConfig();
		$kota	= strtoupper($config['nm_daerah']);
		$jenisCetak = $this->input->get('jenisCetak');
		$tgl_cetak = $this->input->get('tglcetak');
		$tahun_1 = $this->input->get('tahun_1');
		$tahun_2 = $this->input->get('tahun_2');
		$skpd = $this->input->get('skpd');
		$nm_skpd = $this->input->get('nmskpd');
		$bulan = $this->input->get('bulan');
		$tgl_oleh = $this->tanggal_balik($this->input->get('tgl_oleh'));
		$tgl = $this->tanggal_balik($tgl_oleh);
		$tahun = $this->input->get('tahun');
		$unit_skpd = $this->input->get('unit_skpd');
		$nm_unit_skpd = $this->input->get('nm_skpd_unit');
		
		$data = array(
			'nm_kab'	 	=> strtoupper($config['nm_daerah']),
			'kota'			=> $kota,
			'logo' 			=> $config['logo'],
			'tipeCetakan' 	=> $this->input->get('tipeCetakan'),
			'skpd' 			=> $skpd,
			'nm_skpd'		=> $nm_skpd,
			'bulan'			=> $bulan,
			'tgl_oleh'		=> $this->tanggal_balik($this->input->get('tgl_oleh')),
			'tahun' 		=> $tahun,
			'tahun_1'		=> $tahun_1,
			'tahun_2'		=> $tahun_2,
			'jenisCetak'	=> $jenisCetak,
			'tgl_cetak'		=> $tgl_cetak,

		);

		// echo $data['tipeCetakan'];

		$bluePrint = $this->M_kibb->cetakLaporan($data);
		$nippa = $bluePrint[0]['nippa'];
		$namapa = $bluePrint[0]['namapa'];
		$nipbk = $bluePrint[1]['nipbk'];
		$namabk = $bluePrint[1]['namabk'];

		$cRet ='';
        $cRet .= "
        		<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            		<tr>
                		<td></td>
						<img src=\"".FCPATH."/uploads/msm.png\" width=\"80px\" height=\"60px\" alt=\"\" />
                		<td align=\"center\" colspan=\"13\" style=\"font-size:14px;border: solid 1px white;\"><B>KARTU INVENTARIS BARANG (KIB) B<br>PERALATAN DAN MESIN</B></td>
            		</tr><BR/><BR/><BR/>
        		</table>
        		";
        $cRet .="
        		<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
          
		if ( $skpd <> '' )
		{ 
       		$cRet .="
    	    	<tr>
        	    	<td align=\"left\" style=\"font-size:13px;\" width =\"10%\" >&ensp;&ensp;SKPD</td>
            		<td align=\"left\" style=\"font-size:13px;\">:<B> $skpd  $nm_skpd</B></td>
        		</tr>";
		}	 

		if ( $jenisCetak == '1' )
		{    
    		$cRet .=" 
    			<tr>
            		<td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;UNIT</td>
            		<td align=\"left\" style=\"font-size:13px;\">:<B> $unit_skpd  $nm_unit_skpd</B></td>
				</tr>";
    	}

		$cRet .="
			<tr>
               	<td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;KOTA</td>
               	<td align=\"left\" style=\"font-size:13px;\">: $kota</td>
           	</tr>";

        if( $jenisCetak == 0 || $jenisCetak == 1 )
        {
            $cRet .="
    			<tr>
            		<td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
            		<td align=\"left\" style=\"font-size:13px;\">: Sampai Dengan ".$this->tanggal_format_indonesia($tgl_oleh)."</td>
        		</tr>";
        }
        else 
        {
           if ($tahun_1 != $tahun_2){
				$cRet .="
        		<tr>
	               <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
            		<td align=\"left\" style=\"font-size:13px;\">: Tahun $tahun_1 s/d Tahun $tahun_2</td>
        		</tr>";
			} else {
				$cRet .="
        		<tr>
	               <td align=\"left\" style=\"font-size:13px;\">&ensp;&ensp;PERIODE</td>
            		<td align=\"left\" style=\"font-size:13px;\">: Tahun $tahun_1</td>
        		</tr>";
			}
        }
		if ($jenisCetak == 0){
			$where = "WHERE a.kd_skpd = '$skpd' and tgl_reg <= '$tgl_oleh'";
		} else if ($jenisCetak == 1) {
			$where = "WHERE a.kd_skpd = '$skpd' and tgl_reg <= '$tgl_oleh' and kd_unit = '$unit_skdp'";
		} else {
			$where = "WHERE a.kd_skpd = '$skpd' and a.tahun between '$tahun_1' and '$tahun_2'";
		}
       	$cRet .="</table>";
		$cRet .="
				<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                	<thead>
                		<tr>
                    		<td align=\"left\" colspan=\"16\" style=\"font-size:12px;border: solid 1px white;border-bottom:solid 1px black;\">&ensp;</td>
        		        </tr>
                	</thead>
                		<tr>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" style=\"font-size:12px\" width=\"250px\">No</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" style=\"font-size:12px\">Kode Barang</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" style=\"font-size:12px\">Nama Barang</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" style=\"font-size:12px\">No. Register</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" style=\"font-size:12px\">Merk/Tipe</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" style=\"font-size:12px\">Ukuran/CC</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" style=\"font-size:12px\">Bahan</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" style=\"font-size:12px\">Tahun</td>
							<td bgcolor=\"#CCCCCC\" align=\"center\" colspan=\"5\" style=\"font-size:12px\">Nomor</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" style=\"font-size:12px\">Asal Usul</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" style=\"font-size:12px\">Harga</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"2\" style=\"font-size:12px\">Keterangan</td>
                		</tr>
                		<tr>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"1\" style=\"font-size:12px\">Pabrik</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"1\" style=\"font-size:12px\">Rangka</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"1\" style=\"font-size:12px\">Mesin</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"1\" style=\"font-size:12px\">Polisi</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" rowspan=\"1\" style=\"font-size:12px\">BPKB</td>
                		</tr>
                		<tr></tr>
                		<tr>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"3%\" style=\"font-size:10px\">1</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"5%\" style=\"font-size:10px\">2</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"10%\" style=\"font-size:10px\">3</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"5%\" style=\"font-size:10px\">4</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"5%\" style=\"font-size:10px\">5</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"3%\" style=\"font-size:10px\">6</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"3%\" style=\"font-size:10px\">7</td>
							<td bgcolor=\"#CCCCCC\" align=\"center\" width =\"3%\" style=\"font-size:10px\">8</td>
							<td bgcolor=\"#CCCCCC\" align=\"center\" width =\"7%\" style=\"font-size:10px\">9</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"5%\" style=\"font-size:10px\">10</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"5%\" style=\"font-size:10px\">11</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"3%\" style=\"font-size:10px\">12</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"3%\" style=\"font-size:10px\">13</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"5%\" style=\"font-size:10px\">14</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"5%\" style=\"font-size:10px\">15</td>
		                    <td bgcolor=\"#CCCCCC\" align=\"center\" width =\"10%\" style=\"font-size:10px\">16</td>
                		</tr>";
						
        			$sql = "SELECT
							a.kd_brg,
							b.uraian as nm_brg,
							a.no_reg,
							a.merek,
							a.tipe,
							d.nm_bahan,
							a.tahun_produksi,
							a.pabrik,
							a.no_rangka,
							a.no_mesin,
							a.no_polisi,
							a.no_bpkb,
							c.cara_peroleh  as asal,
							a.nilai,
							a.keterangan
							
						FROM
							transaksi.trkib_b a
						LEFT JOIN mbarang b ON a.kd_brg = b.kd_brg
						LEFT JOIN cara_peroleh c ON a.asal = c.kd_cr_oleh
						LEFT JOIN mbahan d ON a.kd_bahan = d.kd_bahan
						$where
						;";
			        $query = $this->db->query($sql);
			        $i = 0;
			        $totalsel = 0;
			        foreach ($query->result() as $row) {
			                
							$i++;
			                $kd_brg         =$row->kd_brg;
			                $nm_brg         =$row->nm_brg;
			                $no_reg         =$row->no_reg;
			                $merek     =$row->merek;
			                $tipe     =$row->tipe;
			                $nm_bahan         =$row->nm_bahan;
			                $tahun          =$row->tahun_produksi;
			                $pabrik          =$row->pabrik;
			                $no_rangka           =$row->no_rangka;
			                $no_mesin           =$row->no_mesin;
			                $no_polisi           =$row->no_polisi;
			                $no_bpkb           =$row->no_bpkb;
			                $asal           =$row->asal;
			                $nilai          =$row->nilai;
			                $keterangan     =$row->keterangan;
							$totalsel = $totalsel + $nilai;
			                $cRet .="
			                    <tr>
			                        <td align=\"center\" style=\"font-size:11px\">$i</td>
			                        <td align=\"left\" style=\"font-size:11px\">$kd_brg</td>
			                        <td align=\"left\" style=\"font-size:11px\">$nm_brg</td>
			                        <td align=\"left\" style=\"font-size:11px\">$no_reg</td>
			                        <td align=\"center\" style=\"font-size:11px\">$merek</td>
			                        <td align=\"center\" style=\"font-size:11px\">$tipe</td>
			                        <td align=\"center\" style=\"font-size:11px\">$nm_bahan</td>
			                        <td align=\"left\" style=\"font-size:11px\">$tahun</td>
			                        <td align=\"left\" style=\"font-size:11px\">$pabrik</td>
			                        <td align=\"left\" style=\"font-size:11px\">$no_rangka</td>
			                        <td align=\"left\" style=\"font-size:11px\">$no_mesin</td>
			                        <td align=\"left\" style=\"font-size:11px\">$no_polisi</td>
			                        <td align=\"left\" style=\"font-size:11px\">$no_bpkb</td>
			                        <td align=\"left\" style=\"font-size:11px\">$asal</td>
			                        <td align=\"left\" style=\"font-size:11px\">".number_format($nilai,2,',','.')."</td>
			                        <td align=\"left\" style=\"font-size:11px\">$keterangan</td>
			                    </tr>";
			            
			    	}
			    $cRet .="
						<tr>
			                <td bgcolor=\"#CCCCCC\" colspan=\"14\" align=\"center\" width =\"2%\" style=\"font-size:11px\">Jumlah</td>
			                <td bgcolor=\"#CCCCCC\" align=\"right\" width =\"5%\" style=\"font-size:11px\">".number_format($totalsel,2,',','.')."</td>
			                <td bgcolor=\"#CCCCCC\" align=\"left\" width =\"15%\" style=\"font-size:11px\"></td>
			            </tr>";

        		$cRet .="</table>"; 



		        $cRet.="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
		            <tr>
		                <td><td>
		                <td align=\"center\" colspan=\"7\" style=\"font-size:10px\"></td>
		            </tr>
		                <br/><br/>
		            <tr>
		                <td><td>
		                <td colspan=\"5\"></td>
		                <td align=\"center\" style=\"font-size:11px\">$kota, $tgl_cetak</td>
		            </tr>
		            <tr>
		                <td><td>
		                <td align=\"center\" style=\"font-size:11px\">&ensp;&ensp;&ensp;&ensp;MENGETAHUI</td>
		                <td colspan=\"2\"></td>
		                <td colspan=\"3\"></td>
		            </tr>
		                <Tr></Tr><Tr></Tr>
		            <tr>
		                <td><td>
		                <td align=\"center\" style=\"font-size:11px\">&ensp;&ensp;&ensp;&ensp;KEPALA $nm_skpd</td>
		                <td colspan=\"2\"></td>
		                <td colspan=\"2\"></td>
		                <td align=\"center\" style=\"font-size:11px\">PENGURUS BARANG</td>          
		            </tr>
		            <tr>
		                <td><td>
		                <td align=\"center\" colspan=\"7\" style=\"font-size:11px\" height=\"50\"></td>
		            </tr>
		            <tr>
		                <td><td>
		                <td align=\"center\" style=\"font-size:11px\">&ensp;&ensp;&ensp;&ensp;(<u> .$namapa </u>)</td>
		                <td colspan=\"2\"></td>
		                <td colspan=\"2\"></td>
		                <td align=\"center\" style=\"font-size:11px\">(<u> $namabk </u>)</td>
		            </tr>
		            <tr>
		                <td><td>
		                <td align=\"center\" style=\"font-size:11px\">&ensp;&ensp;&ensp;&ensp;&ensp;NIP. $nippa </td>
		                <td colspan=\"2\"></td>
		                <td colspan=\"2\"></td>
		                <td align=\"center\" style=\"font-size:11px\">&ensp;NIP. $nipbk</td>
		            </tr>";
		            
		        $cRet .=       " </table>";
		        $data['prev']= $cRet;
		        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $nm_skpd);
		        $judul  = 'Laporan KIB B' .'-'. $test;
		        // echo $judul;
		        // echo $data['tipeCetakan'];
		        switch ($data['tipeCetakan']) {
		        	case 0:
		        		$this->_mpdf('',$cRet,10,10,10,'L');
		        		break;
		        	case 1:
		        		header("Cache-Control: no-cache, no-store, must-revalidate");
			            header("Content-Type: application/vnd.ms-excel");
			            header("Content-Disposition: attachment; filename= $judul.xlsx");
			            $this->load->view('transaksi/excel', $data);
			            break;
	        		case 2:
	        			header("Cache-Control: no-cache, no-store, must-revalidate");
			            header("Content-Type: application/vnd.ms-word");
			            header("Content-Disposition: attachment; filename= $judul.doc");
			           	$this->load->view('transaksi/excel', $data);
	        			break;
		        	default:
		        		echo "Error";
		        		break;
		        }

	}

	public function cetakLaporan2()
	{
		$skpd = $this->input->get('_skpd');
		echo $skpd;
		$cRet ='';
        $cRet .= "
        		<table style=\"border-collapse:collapse;\" width=\"90%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            		<tr>
                		<td></td>
						<img src=\"".FCPATH."/data/100.jpg\" width=\"60px\" height=\"60px\" alt=\"\" />
                		<td align=\"center\" colspan=\"13\" style=\"font-size:14px;border: solid 1px white;\"><B>KARTU INVENTARIS BARANG (KIB) A<br>TANAH</B> $skpd uyyt77</td>
            		</tr><BR/><BR/><BR/>
        		</table>
        		";
        
       	$cRet .="</table>";
		
		        $data['prev']= $cRet;
		        //$test = str_replace(str_split('\\/:*?"<>|,'), ' ', $nm_skpd);
		        $judul  = 'Laporan KIB B';
		        // echo $judul;
		        // echo $data['tipeCetakan'];
				$this->_mpdf('',$cRet,10,10,10,'L');
		        switch ($data['tipeCetakan']) {
		        	case 0:
		        		$this->_mpdf('',$cRet,10,10,10,'L');
		        		break;
		        	case 1:
		        		header("Cache-Control: no-cache, no-store, must-revalidate");
			            header("Content-Type: application/vnd.ms-excel");
			            header("Content-Disposition: attachment; filename= $judul.xlsx");
			            $this->load->view('transaksi/excel', $data);
			            break;
	        		case 2:
	        			header("Cache-Control: no-cache, no-store, must-revalidate");
			            header("Content-Type: application/vnd.ms-word");
			            header("Content-Disposition: attachment; filename= $judul.doc");
			           	$this->load->view('transaksi/excel', $data);
	        			break;
		        	default:
		        		echo "Error";
		        		break;
		        }

	}



}

/* End of file C_kib_b.php */
/* Location: ./application/controllers/laporan/C_kib_b.php */
