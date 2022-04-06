<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_spp_gaji extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('laporan/lap_spp/M_spp_gaji');
	}

	function _mpdf($judul='',$isi='',$lMargin=2,$rMargin=2,$font=2,$orientasi) {
        ob_clean();
         ini_set("memory_limit","-1");
        $this->load->library('M_pdf');
        $mpdf = new m_pdf('', 'Letter-L');
        $pdfFilePath = "output_pdf_name.pdf";
       // $mpdf->pdf->SetFooter('Printed Simgaji on @ {DATE j-m-Y H:i:s} || Page {PAGENO} of {nb}');
         $mpdf->pdf->AddPage('P','','','','',2,2,2,2);
        if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
        $mpdf->pdf->WriteHTML($isi);         
        $mpdf->pdf->Output();

    }

	public function index()
	{	
		$data = array(
			'page'	 	=> 'SURAT PERMINTAAN PEMBAYARAN GAJI',
			'judul'		=> 'CETAK SPP GAJI',
			'deskripsi'	=> 'SURAT PERMINTAAN PEMBAYARAN GAJI'
		);

		$this->template->views('laporan/lap_spp/V_spp_gaji', $data);
	}
	
	public function  tanggal_balik($tgl){
		/*$tanggal  =  substr($tgl,0,2);
		$bulan  = substr($tgl,3,2);
		$tahun  =  substr($tgl,6,4);
		return  $tahun.'-'.$bulan.'-'.$tanggal;*/
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	 
		$xtgl 	= substr($tgl, 0, 2);
		$xbulan 	= substr($tgl, 4, 2);
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
		return $this->M_spp_gaji->getConfig();
	}

	public function getBulan()
	{
		echo $this->M_spp_gaji->getBulan();
	}

	public function getTahun()
	{
		echo $this->M_spp_gaji->getTahun();
	}

	public function getSkpd()
	{
		echo $this->M_spp_gaji->getSkpd(); 
	}

	public function getPangkat()
	{
		echo $this->M_spp_gaji->getPangkat(); 
	}

	/*public function getsp2d()
	{
		echo $this->M_spp_gaji->getsp2d(); 
	}*/

	public function getUnitSkpd()
	{
		$param = $this->uri->segment(5);
		echo $this->M_spp_gaji>getUnitSkpd($param);
	}


	public function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		
		if ($nilai < 12) {
			return " " . $huruf[$nilai];
		} else if ($nilai <20) {
			return $this->penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			return $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
		} else if ($nilai < 200) {
			return  " seratus". $this->penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			return $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			return " seribu". $this-> penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			return $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			return $this-> penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
		
		}     
		
	}

public function cetakspp()
	{
		$config = $this->getConfig();
		$kota	= strtoupper($config['nm_daerah']);
		$jenisCetak = $this->input->get('jenisCetak');
		$tgl_cetak = $this->tanggal_balik($this->input->get('tglcetak'));
		//$tgl_sp2d = $this->tanggal_balik($this->input->get('tgl_sp2d'));
		//$nmskpd = $this->input->get('nm_skpd');
		$skpd = $this->input->get('skpd');
		$nmskpd = $this->input->get('nmskpd');
		//$printer = $this->input->get('printer');
		$tahun = $this->input->get('tahun_tglcetak');
	
		$data = array(
			'nm_kab'	 	=> strtoupper($config['nm_daerah'])
		);

			$cRet = '';
    		$cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"-1\" cellpadding=\"-1\">";

    		 $cRet .="
   					 	<tr>
   						 	<td align=\"center\" width=\"100%\"><b>PEMDA TK II $kota</b></td>	
   						</tr>

   						<tr>
   						 	 	<td align=\"center\" width=\"100%\"><b>SURAT PERMINTAAN PEMBAYARAN GAJI</b></td>
   						</tr>

   						<tr>
   						 	 	<td align=\"center\" width=\"100%\">Nomor :</td>
   						</tr>

   						<tr>
   						 	 	<td align=\"center\" width=\"100%\">$nmskpd</td>	
						</tr>	

   						<tr>
	
			  						    <td align=\"left\" width=\"100%\">&nbsp;</td>
				    	</tr>

				    	<tr>
	
			  						    <td align=\"left\" width=\"100%\">&nbsp;</td>
				    	</tr>

				    	<tr>
	
			  						   <td align=\"left\" width=\"100%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kami ajukan permintaan gaji bulan : </td>
				    	</tr>
	
						<tr> 
									   <td align=\"left\" width=\"100%\">Dengan rincian Sebagai Berikut :</td>
					
			 			</tr>

			 			<tr>
                			 <td colspan=\"2\">
               				    <table style=\"border-collapse:collapse;\" width=\"800\" align=\"left\" border=\"1\" cellspacing=\"4\" cellpadding=\"2\">
		                			 <tr>
						                 <td width=\"100\" align=\"center\"></td>
						                 <td colspan=\"5\" width=\"240\" align=\"center\">PEGAWAI NEGERI SIPIL PUSAT DPB/DPK</td>
						                 <td colspan=\"5\" width=\"240\" align=\"center\">PEGAWAI NEGERI SIPIL DAERAH</td>
						                 <td rowspan=\"3\" width=\"280\" align=\"center\" height=\"20\">JUMLAH SEMUA PEGAWAI NEGERI SIPIL PUSAT DPB/DPK DAN DAERAH</td>
					                 </tr>
					                  <tr>
						                 <td width=\"100\" align=\"center\"></td>
						                 <td colspan=\"4\" width=\"200\" align=\"center\">Golongan</td>
						                 <td width=\"40\" align=\"center\">JIWA</td>

						                 <td colspan=\"4\" width=\"200\" align=\"center\">Golongan</td>
						                 <td width=\"40\" align=\"center\">JIWA</td>
					
					                 </tr>

					                  <tr>
						                 <td width=\"100\" align=\"center\"></td>
						                 <td width=\"50\" align=\"center\">GOL.I</td>
						                 <td width=\"50\" align=\"center\">GOL.II</td>
						                 <td width=\"50\" align=\"center\">GOL.III</td>
						                 <td width=\"50\" align=\"center\">GOL.IV</td>
						                 <td width=\"40\" align=\"center\"></td>

						                 <td width=\"50\" align=\"center\">GOL.I</td>
						                 <td width=\"50\" align=\"center\">GOL.II</td>
						                 <td width=\"50\" align=\"center\">GOL.III</td>
						                 <td width=\"50\" align=\"center\">GOL.IV</td>
						                 <td width=\"40\" align=\"center\"></td>
					
					                 </tr>";
							
									$k=0;
					                $sql1=" select satkerja, (select count(*) from pegawai where satkerja='$skpd' and  left(golongan,1)='1' and kdbantu<>'6' AND (kd_daerah='1' or kd_daerah='2')) as GOLI_PUSAT,(select count(*) from pegawai  where satkerja='$skpd' and left(golongan,1)='2' and kdbantu<>'6' AND (kd_daerah='1' or kd_daerah='2') ) AS GOLII_PUSAT,(select count(*) from pegawai where satkerja='$skpd' and left(golongan,1)='3' and kdbantu<>'6' AND (kd_daerah='1' or kd_daerah='2') ) AS GOLIII_PUSAT,(select count(*) from pegawai where satkerja='$skpd' and left(golongan,1)='4' and kdbantu<>'6' AND (kd_daerah='1' or kd_daerah='2') ) AS GOLIV_PUSAT, (select count(*) from pegawai where satkerja='$skpd' and  left(golongan,1)='1' and kdbantu<>'6' AND kd_daerah='3' ) as GOLI_DAERAH,(select count(*) from pegawai  where satkerja='$skpd' and left(golongan,1)='2' and kdbantu<>'6' AND kd_daerah='3' ) AS GOLII_DAERAH,(select count(*) from pegawai where satkerja='$skpd' and left(golongan,1)='3' and kdbantu<>'6' AND kd_daerah='3' ) AS GOLIII_DAERAH,(select count(*) from pegawai where satkerja='$skpd' and left(golongan,1)='4' and kdbantu<>'6' AND kd_daerah='3' ) AS GOLIV_DAERAH from pegawai where satkerja='$skpd' and  (kd_daerah='1' or kd_daerah='2') group by satkerja;";
		 							$hasil = $this->db->query($sql1);
		 							foreach ($hasil->result() as $row)
                									 {
                									 	$k++;
                									 	$gol1_pusat=$row->goli_pusat;
                									 	$gol2_pusat=$row->golii_pusat;
                									 	$gol3_pusat=$row->goliii_pusat;
                									 	$gol4_pusat=$row->goliv_pusat;
                									 	$gol_jumlah_pusat=$gol1_pusat+$gol2_pusat+$gol3_pusat+$gol4_pusat;
                									 	$gol1_daerah=$row->goli_daerah;
                									 	$gol2_daerah=$row->golii_daerah;
                									 	$gol3_daerah=$row->goliii_daerah;
                									 	$gol4_daerah=$row->goliv_daerah;
                									 	$gol_jumlah_daerah=$gol1_daerah+$gol2_daerah+$gol3_daerah+$gol4_daerah;
                									 	$jumlah_gol=$gol_jumlah_pusat+$gol_jumlah_daerah;


 									$cRet .="<tr>
 												<td width=\"100\" align=\"center\">1. PEGAWAI</td>
 												<td width=\"50\" align=\"center\">$gol1_pusat</td>
 												<td width=\"50\" align=\"center\">$gol2_pusat</td>
 												<td width=\"50\" align=\"center\">$gol3_pusat</td>
 												<td width=\"50\" align=\"center\">$gol4_pusat</td>
 												<td width=\"40\" align=\"center\">$gol_jumlah_pusat</td>
 												<td width=\"50\" align=\"center\">$gol1_daerah</td>
 												<td width=\"50\" align=\"center\">$gol2_daerah</td>
 												<td width=\"50\" align=\"center\">$gol3_daerah</td>
 												<td width=\"50\" align=\"center\">$gol4_daerah</td>
 												<td width=\"40\" align=\"center\">$gol_jumlah_daerah</td>
 												<td width=\"280\" align=\"center\" >$jumlah_gol</td>
				                     		 
				                     		 </tr>";

                							 }

                					$l=0;
					                $sql2=" select satkerja, (select count(*) from pegawai where satkerja='$skpd' and  left(golongan,1)='1' and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4') AND (kd_daerah='1' or kd_daerah='2')) as GOLI_PUSAT,(select count(*) from pegawai  where satkerja='$skpd' and left(golongan,1)='2' and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4') AND (kd_daerah='1' or kd_daerah='2') ) AS GOLII_PUSAT,(select count(*) from pegawai where satkerja='$skpd' and left(golongan,1)='3' and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4') AND (kd_daerah='1' or kd_daerah='2') ) AS GOLIII_PUSAT,(select count(*) from pegawai where satkerja='$skpd' and left(golongan,1)='4' and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4') AND (kd_daerah='1' or kd_daerah='2') ) AS GOLIV_PUSAT, (select count(*) from pegawai where satkerja='$skpd' and  left(golongan,1)='1' and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4') AND kd_daerah='3' ) as GOLI_DAERAH,(select count(*) from pegawai  where satkerja='$skpd' and left(golongan,1)='2' and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4') AND kd_daerah='3' ) AS GOLII_DAERAH,(select count(*) from pegawai where satkerja='$skpd' and left(golongan,1)='3' and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4') AND kd_daerah='3' ) AS GOLIII_DAERAH,(select count(*) from pegawai where satkerja='$skpd' and left(golongan,1)='4' and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4') AND kd_daerah='3' ) AS GOLIV_DAERAH from pegawai where satkerja='$skpd' and  (kd_daerah='1' or kd_daerah='2') group by satkerja;";
					                $hasil2 = $this->db->query($sql2);
		 							foreach ($hasil2->result() as $row)
                									 {
                									 	$l++;
                									 	$gol1_pusat2=$row->goli_pusat;
                									 	$gol2_pusat2=$row->golii_pusat;
                									 	$gol3_pusat2=$row->goliii_pusat;
                									 	$gol4_pusat2=$row->goliv_pusat;
                									 	$gol_jumlah_pusat2=$gol1_pusat2+$gol2_pusat2+$gol3_pusat2+$gol4_pusat2;
                									 	$gol1_daerah2=$row->goli_daerah;
                									 	$gol2_daerah2=$row->golii_daerah;
                									 	$gol3_daerah2=$row->goliii_daerah;
                									 	$gol4_daerah2=$row->goliv_daerah;
                									 	$gol_jumlah_daerah2=$gol1_daerah2+$gol2_daerah2+$gol3_daerah2+$gol4_daerah2;
                									 	$jumlah_gol2=$gol_jumlah_pusat2+$gol_jumlah_daerah2;


                				$cRet .="<tr>
 												<td width=\"100\" align=\"center\">2. ISTRI/SUAMI</td>
 												<td width=\"50\" align=\"center\">$gol1_pusat2</td>
 												<td width=\"50\" align=\"center\">$gol2_pusat2</td>
 												<td width=\"50\" align=\"center\">$gol3_pusat2</td>
 												<td width=\"50\" align=\"center\">$gol4_pusat2</td>
 												<td width=\"40\" align=\"center\">$gol_jumlah_pusat2</td>
 												<td width=\"50\" align=\"center\">$gol1_daerah2</td>
 												<td width=\"50\" align=\"center\">$gol2_daerah2</td>
 												<td width=\"50\" align=\"center\">$gol3_daerah2</td>
 												<td width=\"50\" align=\"center\">$gol4_daerah2</td>
 												<td width=\"40\" align=\"center\">$gol_jumlah_daerah2</td>
 												<td width=\"280\" align=\"center\" >$jumlah_gol2</td>
				                     		 
				                     		 </tr>";
				                     		}

									$m=0;
					                $sql3=" select satkerja, (select sum(anak) from pegawai where satkerja='$skpd' and  left(golongan,1)='1' and (kdbantu<>'6' and kdbantu<>'4') AND (kd_daerah='1' or kd_daerah='2')) as GOLI_PUSAT,(select sum(anak) from pegawai  where satkerja='$skpd' and left(golongan,1)='2' and (kdbantu<>'6' and kdbantu<>'4') AND (kd_daerah='1' or kd_daerah='2') ) AS GOLII_PUSAT,(select sum(anak) from pegawai where satkerja='$skpd' and left(golongan,1)='3' and (kdbantu<>'6' and kdbantu<>'4') AND (kd_daerah='1' or kd_daerah='2') ) AS GOLIII_PUSAT,(select sum(anak) from pegawai where satkerja='$skpd' and left(golongan,1)='4' and (kdbantu<>'6' and kdbantu<>'4') AND (kd_daerah='1' or kd_daerah='2') ) AS GOLIV_PUSAT, (select sum(anak) from pegawai where satkerja='$skpd' and  left(golongan,1)='1' and (kdbantu<>'6' and kdbantu<>'4') AND kd_daerah='3' ) as GOLI_DAERAH,(select sum(anak) from pegawai  where satkerja='$skpd' and left(golongan,1)='2' and (kdbantu<>'6' and kdbantu<>'4') AND kd_daerah='3' ) AS GOLII_DAERAH,(select sum(anak) from pegawai where satkerja='$skpd' and left(golongan,1)='3' and (kdbantu<>'6' and kdbantu<>'4') AND kd_daerah='3' ) AS GOLIII_DAERAH,(select sum(anak) from pegawai where satkerja='$skpd' and left(golongan,1)='4' and (kdbantu<>'6' and kdbantu<>'4') AND kd_daerah='3' ) AS GOLIV_DAERAH from pegawai where satkerja='$skpd' and  (kd_daerah='1' or kd_daerah='2') group by satkerja;";
					                $hasil3 = $this->db->query($sql3);
		 							foreach ($hasil3->result() as $row)
                									 {
                									 	$l++;
                									 	$gol1_pusat3=$row->goli_pusat;
                									 	$gol2_pusat3=$row->golii_pusat;
                									 	$gol3_pusat3=$row->goliii_pusat;
                									 	$gol4_pusat3=$row->goliv_pusat;
                									 	$gol_jumlah_pusat3=$gol1_pusat3+$gol2_pusat3+$gol3_pusat3+$gol4_pusat3;
                									 	$gol1_daerah3=$row->goli_daerah;
                									 	$gol2_daerah3=$row->golii_daerah;
                									 	$gol3_daerah3=$row->goliii_daerah;
                									 	$gol4_daerah3=$row->goliv_daerah;
                									 	$gol_jumlah_daerah3=$gol1_daerah3+$gol2_daerah3+$gol3_daerah3+$gol4_daerah3;
                									 	$jumlah_gol3=$gol_jumlah_pusat3+$gol_jumlah_daerah3;


                				$cRet .="<tr>
 												<td width=\"100\" align=\"center\">3. ANAK</td>
 												<td width=\"50\" align=\"center\">$gol1_pusat3</td>
 												<td width=\"50\" align=\"center\">$gol2_pusat3</td>
 												<td width=\"50\" align=\"center\">$gol3_pusat3</td>
 												<td width=\"50\" align=\"center\">$gol4_pusat3</td>
 												<td width=\"40\" align=\"center\">$gol_jumlah_pusat3</td>
 												<td width=\"50\" align=\"center\">$gol1_daerah3</td>
 												<td width=\"50\" align=\"center\">$gol2_daerah3</td>
 												<td width=\"50\" align=\"center\">$gol3_daerah3</td>
 												<td width=\"50\" align=\"center\">$gol4_daerah3</td>
 												<td width=\"40\" align=\"center\">$gol_jumlah_daerah3</td>
 												<td width=\"280\" align=\"center\" >$jumlah_gol3</td>
				                     		 
				                     		 </tr>";
				                     		}
 						$cRet .="<tr>
									
 								</tr>


								</table>
							</td>
    					</tr>   ";


    					$cRet .="
    							<tr>
    								<td align=\"left\" width=\"100%\">&nbsp;</td>
    							</tr>
    							<tr>
									<td align=\"center\" width=\"100%\">REKAPITULASI GAJI PNS PUSAT DPB DAN PNS DAERAH</td>
 								</tr>
 								<tr>
    								<td align=\"left\" width=\"100%\">&nbsp;</td>
    							</tr>";
						$n=0;
						$sql4="select satkerja,sum(gapok) as gapok,sum(tistri) as tistri,sum(tanak) tanak,sum(gapok+tistri+tanak) as tkeluarga,
						sum(tpp) as tpp,sum(papua) as papua, sum(tdt) as tdt,sum(tstruk) as tstruk,
						sum(case when left(kd_fung,1)<>'U' then tfung else 0 end) as tfung,
						sum(case when left(kd_fung,1)='U' then tfung else 0 end) as umum,
						sum(bulat) as bulat,sum(beras) as beras,
						sum(pph) as pph,sum(askes) as askes,sum(bruto) as bruto,sum(iwp) as iwp,
						sum(sewa) as sewa,sum(tabungan) as tabungan,sum(hutang) as hutang,sum(lain) as lain,sum(disc) as jumpot,
						sum(netto) as netto from pegawai 
						where satkerja='$skpd' group by satkerja;";

 						$hasil4 = $this->db->query($sql4);
		 							foreach ($hasil4->result() as $row)
														$n++;
														$gapok=$row->gapok;
														$tistri=$row->tistri;
														$tanak=$row->tanak;
														$tpp=$row->tpp;
														$papua=$row->papua;
														$tdt=$row->tdt;
														$tstruk=$row->tstruk;
														$tfung=$row->tfung;
														$umum=$row->umum;
														$bulat=$row->bulat;
														$beras=$row->beras;
														$pph=$row->pph;
														$askes=$row->askes;
														$bruto=$row->bruto;
														$iwp=$row->iwp;
														$sewa=$row->sewa;
														$tabungan=$row->tabungan;
														$hutang=$row->hutang;
														$lain=$row->lain;
														$jumpot=$row->jumpot;
														$netto=$row->netto;


                									 {

    					$cRet .="<tr>
    								<td>
               				    		<table style=\"border-collapse:collapse;\" width=\"800\" align=\"left\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">

               				    			<tr>
						                		 <td colspan=\"4\" width=\"400\" align=\"center\">I. PENGHASILAN</td>
						               			 <td colspan=\"4\" width=\"400\" align=\"center\">II. POTONGAN</td>
						                 
					               			 </tr>

					               			 <tr>
													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">1.</td>
													<td width=\"170\" align=\"left\">Gaji Pokok</td>
													<td width=\"100\" align=\"right\">".number_format($gapok,0,',','.')."</td>
													
													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">1.</td>
													<td width=\"170\" align=\"left\">PFK Potongan Beras</td>
													<td width=\"100\" align=\"right\">".number_format($beras,0,',','.')."</td>
					               			 </tr>

					               			 <tr>
													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">2.</td>
													<td width=\"170\" align=\"left\">Tunj. Istri/Suami</td>
													<td width=\"100\" align=\"right\">".number_format($tistri,0,',','.')."</td>

													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">2.</td>
													<td width=\"170\" align=\"left\">PFK 10% (IWP)</td>
													<td width=\"100\" align=\"right\">".number_format($iwp,0,',','.')."</td>
					               			 </tr>

					               			 <tr>
													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">3.</td>
													<td width=\"170\" align=\"left\">Tunj. Anak</td>
													<td width=\"100\" align=\"right\">".number_format($tanak,0,',','.')."</td>

													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">3.</td>
													<td width=\"170\" align=\"left\">PPH</td>
													<td width=\"100\" align=\"right\">".number_format($pph,0,',','.')."</td>
					               			 </tr>

					               			 <tr>
													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">4.</td>
													<td width=\"170\" align=\"left\">Tunj. Perbaikan Penghasilan</td>
													<td width=\"100\" align=\"right\">".number_format(0,0,',','.')."</td>

													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">4.</td>
													<td width=\"170\" align=\"left\">TAPERUM PNS</td>
													<td width=\"100\" align=\"right\">".number_format($tabungan,0,',','.')."</td>
					               			 </tr>

					               			 <tr>
													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">5.</td>
													<td width=\"170\" align=\"left\">Tunj. Jabatan Struktural</td>
													<td width=\"100\" align=\"right\">".number_format($tstruk,0,',','.')."</td>

													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">5.</td>
													<td width=\"170\" align=\"left\">Sewa Rumah</td>
													<td width=\"100\" align=\"right\">".number_format($sewa,0,',','.')."</td>
					               			 </tr>

					               			 <tr>
													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">6.</td>
													<td width=\"170\" align=\"left\">Tunj. Jabatan Fungsional</td>
													<td width=\"100\" align=\"right\">".number_format($tfung,0,',','.')."</td>

													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">6.</td>
													<td width=\"170\" align=\"left\">Lain-Lain</td>
													<td width=\"100\" align=\"right\">".number_format($lain,0,',','.')."</td>
					               			 </tr>

					               			 <tr>
													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">7.</td>
													<td width=\"170\" align=\"left\">Tunj. Umum Non Jabatan</td>
													<td width=\"100\" align=\"right\">".number_format($umum,0,',','.')."</td>

													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">7.</td>
													<td width=\"170\" align=\"left\">Amal Bhakti KORPRI</td>
													<td width=\"100\" align=\"right\">".number_format(0,0,',','.')."</td>
					               			 </tr>

					               			 <tr>
													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">8.</td>
													<td width=\"170\" align=\"left\">Tunj. Khusus IRJA/TIMTIM</td>
													<td width=\"100\" align=\"right\">".number_format($papua,0,',','.')."</td>

													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\"></td>
													<td width=\"170\" align=\"left\">a.Amal A (Muslim)</td>
													<td width=\"100\" align=\"right\">".number_format(0,0,',','.')."</td>
					               			 </tr>

					               			 <tr>
													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">9.</td>
													<td width=\"170\" align=\"left\">Tunj. Pengab. Wil. Terpencil</td>
													<td width=\"100\" align=\"right\">".number_format($tdt,0,',','.')."</td>

													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\"></td>
													<td width=\"170\" align=\"left\">b.Amal B (Non Muslim)</td>
													<td width=\"100\" align=\"right\">".number_format(0,0,',','.')."</td>
					               			 </tr>

					               			 <tr>
													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">10.</td>
													<td width=\"170\" align=\"left\">Tunj. Khusus Pajak</td>
													<td width=\"100\" align=\"right\">".number_format($pph,0,',','.')."</td>

													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">8.</td>
													<td width=\"170\" align=\"left\">Askes</td>
													<td width=\"100\" align=\"right\">".number_format($askes,0,',','.')."</td>


					               			 </tr>

					               			 <tr>
													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">11.</td>
													<td width=\"170\" align=\"left\">Pembulatan</td>
													<td width=\"100\" align=\"right\">".number_format($bulat,0,',','.')."</td>

													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\"></td>
													<td width=\"170\" align=\"left\"></td>
													<td width=\"100\" align=\"right\">".number_format($jumpot,0,',','.')."</td>
					               			 </tr>

					               			 <tr>
													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">12.</td>
													<td width=\"170\" align=\"left\">Tunj. Beras</td>
													<td width=\"100\" align=\"right\">".number_format($beras,0,',','.')."</td>
					               			 </tr>

					               			 <tr>
													<td width=\"10\" align=\"center\"></td>
													<td width=\"20\" align=\"center\">12.</td>
													<td width=\"170\" align=\"left\">Tunj. Askes</td>
													<td width=\"100\" align=\"right\">".number_format($askes,0,',','.')."</td>
					               			 </tr>


					               			 <tr>
						                		 <td colspan=\"4\" width=\"400\" align=\"center\"></td>
						               			 <td colspan=\"4\" width=\"400\" align=\"center\"></td>
						                 
					               			 </tr>

					               			 <tr>
						                		 <td colspan=\"4\" width=\"400\" align=\"center\"></td>
						               			 <td colspan=\"4\" width=\"400\" align=\"center\"></td>
						                 
					               			 </tr>

					               			 <tr>
					               				 <td colspan=\"2\" width=\"30\" align=\"left\"></td>
						                		 <td colspan=\"1\" width=\"150\" align=\"left\">Jumlah Penghasilan Kotor</td>
						                		 <td colspan=\"1\" width=\"20\" align=\"right\">".number_format($bruto,0,',','.')."</td>
						               	
						               			 <td colspan=\"2\" width=\"30\" align=\"left\"></td>
						                		 <td colspan=\"1\" width=\"150\" align=\"left\">III. Jumlah yang dibayarkan</td>
						                		 <td colspan=\"1\" width=\"20\" align=\"right\">".number_format($netto,0,',','.')."</td>
						                 
					               			 </tr>

					               			  <tr>
						                		 <td colspan=\"4\" width=\"400\" align=\"center\"></td>
						               			 <td colspan=\"4\" width=\"400\" align=\"center\"></td>
						                 
					               			 </tr>

					               			  <tr>
						                		 <td colspan=\"4\" width=\"400\" align=\"center\"></td>
						               			 <td colspan=\"4\" width=\"400\" align=\"center\"></td>
						                 
					               			 </tr>

					               		 </table>
					                </td>
					             </tr>";
								}


								$sql5="select * from satkerja where satkerja='$skpd';";
								$hasil5 = $this->db->query($sql5);
								 foreach ($hasil5->result() as $row){
									$jab_atasan  =$row->jab_atasan;
									$nama_atasan  =$row->nama_atasan;
									$nip_atasan  =$row->nip_atasan;
									$nama_bend  =$row->nama_bend;
									$nip_bend  =$row->nip_bend;

								 }
								


						$cRet .="<tr>
    								<td>
               				    		<table style=\"border-collapse:collapse;\" width=\"800\" align=\"left\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">

               				    			<tr>
						                		 <td colspan=\"1\" width=\"250\" align=\"center\">BENDAHARAWAN<br></br><br></br><br></br><br></br><br></br>$nama_bend<br></br>NIP. $nip_bend</td>
						               			 <td colspan=\"1\" width=\"300\" align=\"center\"></td>
						               			 <td colspan=\"1\" width=\"250\" align=\"center\">AGATS,$tgl_cetak<br>PEMBUAT DAFTAR GAJI</br><br></br><br></br><br></br><br></br>$nama_bend<br></br>NIP. $nip_bend</td>
						                 
					               			 </tr>

					               			 	<tr>
						                		 <td colspan=\"1\" width=\"250\" align=\"center\"></td>
						               			 <td colspan=\"1\" width=\"300\" align=\"center\">MENGETAHUI / MENYETUJUI<br>AN. KABUPATEN ASMAT</br><br>$jab_atasan</br><br></br><br></br><br></br><br></br><br>$nama_atasan</br><br>NIP. $nip_atasan</br></td>
						               			 <td colspan=\"1\" width=\"250\" align=\"center\"></td>
						                 
					               			 </tr>

               				   			</table>
					                </td>
					             </tr>";

					$cRet .="
               	   				</table>
               	   			</td>
               	   		</tr>
               	   		
				</table>";

		       
		        $data['prev']= $cRet;
		        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $jenisCetak);
		        $judul  = 'Surat Permintaan Pembayaran gaji' .'-'. $test;
		        // echo $judul;
		        // echo $data['tipeCetakan'];
		        switch ($data['tipeCetakan']) {
		        	case 0:
		        		
		        	$this->_mpdf('',$cRet,2,2,2,'P');
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

/*

	public function cetaksp2d()
	{
		$config = $this->getConfig();
		$kota	= strtoupper($config['nm_daerah']);
		$jenisCetak = $this->input->get('jenisCetak');
		//$tgl_cetak = $this->tanggal_balik($this->input->get('tgl_cetak'));
		$tgl_sp2d = $this->tanggal_balik($this->input->get('tgl_sp2d'));
		$nosp2d = $this->input->get('no_sp2d');
		$printer = $this->input->get('printer');
		$tahun = $this->input->get('tahun_tglcetak');
	
		
		$data = array(
			'nm_kab'	 	=> strtoupper($config['nm_daerah'])
		);


		$bluePrint = $this->M_spp_gaji->cetaksp2d($data);
		$where = "where a.no_sp2d='$nosp2d'";

		$sqlc="select * from public.config;";
		 $con = $this->db->query($sqlc);
        	$conf = $con->row();
			        			$nm_kaban  =$conf->ankep;
			        			$nip_kaban  =$conf->nipankep;
			        			$jab_kaban  =$conf->jbankep;


		$sql="select a.no_sp2d,a.tgl_sp2d,a.no_spm,a.tgl_spm,c.no_spp,a.kd_skpd,d.nm_satkerja,c.keperluan ,(select sum(nilai) from transaksi.trdspp where no_spp=c.no_spp) as nilai from transaksi.trhsp2d a inner join transaksi.trhspm b on a.no_spm=b.no_spm inner join transaksi.trhspp c on b.no_spp=c.no_spp  inner join public.satkerja d on left(a.kd_skpd,7)=d.satkerja  $where ;";

		  $hasil = $this->db->query($sql);
        	$trh = $hasil->row();
								
			        			$kd_skpd  =$trh->kd_skpd;
			        			$nm_satkerja  =$trh->nm_satkerja;
			        			$no_spm =$trh->no_spm;
			        			$tgl_spm =$trh->tgl_spm;
			        			$no_sp2d =$trh->no_sp2d;
			        			$keperluan=$trh->keperluan;
			        			$nilai_sp2d =$trh->nilai;
			        			$nilai =$trh->nilai;
			        			$terbilang_sp2d= $this->penyebut($nilai);


		$i=0;
		$j=0;
		$k=0;

          	

 			$cRet = '';
    		$cRet = "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"-1\" cellpadding=\"-1\">";
   			 $cRet .="
   					 	<tr>
   						 	<td align=\"center\" width=\"50%\"><b>PEMERINTAH DAERAH ASMAT</b>
   						 	</td>
   						 	
   						 	<td align=\"center\" width=\"50%\" height=\"40\">
		    					 <table style=\"border-collapse:collapse;\" width=\"400\" align=\"center\" border=\"0\" cellspacing=\"4\" cellpadding=\"0\">
	
				    					 <tr>
				    					 	<td align=\"center\"><b>SURAT PERINTAH PENCAIRAN DANA<br>(SP2D)</b></td>
				    					</tr>
		    					
		    					</table>
    						</td>
    					</tr>   
   						
   						<tr>
    						<td>
   								 <table style=\"border-collapse:collapse;\" width=\"420\" align=\"left\" border=\"0\" cellspacing=\"4\" cellpadding=\"0\">
    								<tr>
			    						<td width=\"20%\" align=\"left\">&nbsp;Nomor SPM</td>
			   							<td width=\"1\">:&nbsp;</td>
			    						<td width=\"60%\">$no_spm</td>
    								</tr>

    								<tr>
									    <td width=\"20%\"  align=\"left\">&nbsp;Tanggal</td>
									    <td width=\"1\">:&nbsp;</td>
									    <td width=\"60%\">$tgl_spm</td>
   									 </tr>

								    <tr>
									    <td valign =\"top\" width=\"25%\" align=\"left\">&nbsp;SKPD</td>
									    <td valign =\"top\" width=\"1\">:&nbsp;</td>
									    <td  width=\"60%\">$nm_satkerja</td>
								    </tr>
    							</table>
    						</td>
   							
   							<td>
   								<table style=\"border-collapse:collapse;\" width=\"400\" align=\"center\" border=\"0\" cellspacing=\"4\" cellpadding=\"0\">
    								<tr>
									    <td width=\"50%\">&nbsp;Nomor SP2D</td>
									    <td width=\"50%\">:&nbsp;$no_sp2d</td>

								    </tr>
   									
   									<tr>
									    <td>&nbsp;Dari</td>
									    <td>:&nbsp;KUASA BUD</td>
								    </tr>
    								<tr>
								    	<td>&nbsp;Tahun Anggaran</td>
									    <td>:&nbsp;2018";
							   $cRet .="</td>
                 					</tr>
                 				</table>
							</td>
						</tr>   

						<tr>
							<td colspan=\"2\"  height=\"60\"> &nbsp;Bank/Pos : BANK PAPUA<br>&nbsp;Hendaklah mencairkan / memindahbukukan dari bank Rekening Nomor ..............<br>&nbsp;Uang sebesar Rp  ".number_format($nilai_sp2d,'2',',','.')."  <br><i>&nbsp;Terbilang :$terbilang_sp2d</i><br>
							</td>
						</tr>    
						<tr>
                 			<td colspan=\"2\">
               				  <table style=\"border-collapse:collapse;\" width=\"800\" align=\"left\" border=\"0\" cellspacing=\"4\" cellpadding=\"-1\">
					                 <tr>
						                 <td width=\"20%\" height=\"20\">&nbsp;Kepada</td>
						                 <td>:&nbsp;Harap Membayar Kepada Para Pegawai $nm_satkerja se-Kabupaten Asmat yang mempunyai rekening pada Bank PAPUA Cabang</td>
					                 </tr>
					                 <tr>
						                 <td height=\"20\">&nbsp;NPWP</td>
						                 <td>:&nbsp;</td>
					                 </tr>
					                 <tr>
						                 <td height=\"20\">&nbsp;No.Rekening Bank</td>
						                 <td>:&nbsp;</td>
					                 </tr>
					                 <tr>
						                 <td height=\"20\">&nbsp;Bank/Pos</td>
						                 <td>:&nbsp;BANK PAPUA CABANG AGATS</td>
					                 </tr>
					                 <tr>
						                 <td height=\"20\" valign=\"top\">&nbsp;Keperluan Untuk</td>
						                 <td>:&nbsp;$keperluan</td>
					                 </tr>
                			  </table>   
               			    </td>
               		  </tr>
              		  <tr>
                			 <td colspan=\"2\">
               				    <table style=\"border-collapse:collapse;\" width=\"800\" align=\"left\" border=\"1\" cellspacing=\"4\" cellpadding=\"2\">
		                			 <tr>
						                 <td width=\"45\" align=\"center\"><b>NO</b></td>
						                 <td width=\"118\" align=\"center\"><b>KODE REKENING</b></td>
						                 <td width=\"370\" align=\"center\"><b>URAIAN</b></td>
						                 <td width=\"150\" align=\"center\" height=\"20\"><b>JUMLAH(Rp)</b></td>
					                 </tr>";

					                 $k=0;
									$sql2="select a.no_sp2d,a.tgl_sp2d,c.kd_kegiatan,d.kd_rek5,d.nm_rek5,d.nilai from transaksi.trhsp2d a inner join transaksi.trhspm b on a.no_spm=b.no_spm
									inner join transaksi.trhspp c on b.no_spp=c.no_spp inner join transaksi.trdspp d on c.no_spp=d.no_spp 
									inner join public.satkerja e on left(a.kd_skpd,7)=e.satkerja order by d.kd_rek5;";
		 							$hasil = $this->db->query($sql2);
		 							foreach ($hasil->result() as $row)
                									 {
                									 	$k++;
							  $cRet .="<tr>
				                      <td align=\"center\" height=\"20\">&nbsp;$k</td>
				                      <td>&nbsp;$row->kd_kegiatan.$row->kd_rek5&nbsp;</td>
				                      <td>$row->nm_rek5</td>
				                      <td align=\"right\">".number_format($row->nilai,'2',',','.')."&nbsp;</td>
				                      </tr>";

				                  }

				              $cRet .="<tr>
							            <td align=\"center\" height=\"20\">&nbsp;</td>
							            <td>&nbsp;</td>
							            	<td align=\"right\">&nbsp;<b>Jumlah</b>&nbsp;</td>
							            	<td align=\"right\"><b>".number_format($nilai_sp2d,'2',',','.')."</b>&nbsp;</td>
							            </tr>
							            <tr>
							            	<td colspan=\"4\" height=\"20\">&nbsp;<b>Potongan-Potongan</b></td>
							            </tr>
							    </table>  
							 </td>
						</tr>
						<tr>
							<td colspan=\"2\">
							    <table style=\"border-collapse:collapse;\" width=\"800\" align=\"center\" border=\"1\" cellspacing=\"-1\" cellpadding=\"-1\">
							            <tr>
								            <td width=\"35\" align=\"center\"><b>NO</b></td>
								            <td width=\"376\" align=\"center\"><b>Uraian (No.Rekening)</b></td>
								            <td width=\"227\" align=\"center\"><b>Jumlah (Rp)</b></td>
								            <td width=\"150\" align=\"center\" height=\"20\"><b>Keterangan</b></td>
							            </tr>";
					$totalpot=0;
						$sql3 = "select a.no_sp2d,a.tgl_sp2d,c.kd_kegiatan,d.kd_rek5,d.nm_rek5,d.nilai from transaksi.trhsp2d a inner join transaksi.trhspm b on a.no_spm=b.no_spm inner join transaksi.trhspp c on b.no_spp=c.no_spp inner join transaksi.trspmpot d on b.no_spm=d.no_spm inner join public.satkerja e on left(a.kd_skpd,7)=e.satkerja $where order  by d.kd_rek5;";
          				  $hasil = $this->db->query($sql3);
          
           				 foreach ($hasil->result() as $row)
							            {
							            	$l++;
							            	$totalpot = $totalpot + $row->nilai;
									    $cRet .="<tr>
										             <td align=\"center\" height=\"20\">&nbsp;$l</td>
										             <td>&nbsp;$row->nm_rek5</td>
										             <td align=\"right\">".number_format($row->nilai,'2',',','.')."&nbsp;</td>
										             <td>&nbsp;</td>
									             </tr>";  				               
        								 }
        								 $cRet .="
										         <tr>
											         <td height=\"20\">&nbsp;</td>
											         <td align=\"right\">Jumlah&nbsp;</td>
											         <td align=\"right\">".number_format($totalpot,'2',',','.')."&nbsp;</td>
											         <td></td>
										         </tr>
										         <tr>
										         <td colspan=\"4\" height=\"20\">&nbsp;Informasi:<i>(tidak mengurangi jumlah pembayaran SP2D)</i></td>
										         </tr>
         						</table>  
        					 </td>
        				 </tr>
        				 <tr>
        					 <td colspan=\"2\">
         							<table style=\"border-collapse:collapse;\" width=\"800\" align=\"center\" border=\"1\" cellspacing=\"-1\" cellpadding=\"-1\">
								         <tr>
									         <td width=\"35\" align=\"center\"><b>NO</b></td>
									         <td width=\"376\" align=\"center\"><b>Uraian</b></td>
									         <td width=\"227\" align=\"center\"><b>Jumlah(Rp)</b></td>
									         <td width=\"150\" align=\"center\" height=\"20\"><b>Keterangan</b></td>
								         </tr>";


						$sql4 = "select a.no_sp2d,a.tgl_sp2d,c.kd_kegiatan,d.kd_rek5,d.nm_rek5,d.nilai from transaksi.trhsp2d a 
								inner join transaksi.trhspm b on a.no_spm=b.no_spm inner join transaksi.trhspp c on b.no_spp=c.no_spp inner join transaksi.trspmpot d on b.no_spm=d.no_spm 
									inner join public.satkerja e on left(a.kd_skpd,7)=e.satkerja $where and d.kd_rek5='2130101' order  by d.kd_rek5;";
							         $hasil = $this->db->query($sql4);
							         $lcno = 0;
							         $totalpott = 0;
							         foreach ($hasil->result() as $row)
							         {
							             $lcno = $lcno + 1;
							             $totalpott = $totalpott + $row->nilai;
							             $cRet .="<tr>
										             <td align=\"center\" height=\"20\">&nbsp;$lcno</td>
										             <td>&nbsp;$row->nm_rek5</td>
										             <td align=\"right\">".number_format($row->nilai,'2',',','.')."&nbsp;</td>
										             <td>&nbsp;</td>
							           				 </tr>";    
         							   }
         								 $cRet .="
								         <tr>
									         <td height=\"20\">&nbsp;</td>
									         <td align=\"right\"><b>Jumlah</b>&nbsp;</td>
									         <td align=\"right\"><b>".number_format($totalpott,'2',',','.')."</b>&nbsp;</td>
									         <td></td>
								        	 </tr>
									         <tr>
									         <td colspan=\"4\" height=\"20\" valign=\"bottom\">&nbsp;<b>SP2D yang Dibayarkan</b></td>
									         </tr>
								    </table>  
								</td>
							</tr>
							<tr>
        						 <td colspan=\"2\">
         							<table style=\"border-collapse:collapse;\" width=\"800\" align=\"center\" border=\"1\" cellspacing=\"-1\" cellpadding=\"-1\">
								         <tr>
									         <td width=\"305\" align=\"left\" height=\"20\">&nbsp;Jumlah yang Diminta</td>
									         <td width=\"20\" align=\"left\" style=\"border-left:none;border-right:none;\">&nbsp;Rp.".number_format($nilai_sp2d,'2',',','.')."</td>
									         <td width=\"120\" align=\"right\" style=\"border-left:none;border-right:none;\">&nbsp;</td>
									         <td width=\"400\" align=\"left\" style=\"border-left:none;border-right:none;\">&nbsp;</td>
								         </tr>


								         <tr>
									         <td align=\"left\" height=\"20\">&nbsp;Jumlah Potongan</td>
									         <td width=\"20\" align=\"left\" style=\"border-left:none;border-right:none;\">&nbsp;Rp.".number_format($totalpot,'2',',','.')."</td>
									         <td align=\"right\" style=\"border-left:none;border-right:none;\">&nbsp;</td>
									         <td width=\"400\" align=\"left\" style=\"border-left:none;border-right:none;\">&nbsp;</td>
								         </tr>
								         <tr>
									         <td align=\"left\" height=\"20\">&nbsp;Jumlah yang Dibayarkan</td>
									         <td width=\"20\" align=\"left\" style=\"border-left:none;border-right:none;\">&nbsp;Rp.".number_format($nilai_sp2d-$totalpot,'2',',','.')."</td>
									         <td align=\"right\" style=\"border-left:none;border-right:none;\">&nbsp;</td>
									         <td width=\"400\" align=\"left\" style=\"border-left:none;border-right:none;\">&nbsp;</td>
								
								         </tr>";
										$nilai=$nilai_sp2d-$totalpot;
								         $terbilang_total= $this->penyebut($nilai);
								        
									$cRet .="
								          <tr>
								        	 <td colspan=\"4\" align=\"left\" height=\"20\">&nbsp;Uang Sejumlah : 
								         	<i>$terbilang_total rupiah</i></td>
								        	</tr>
								    </table>  
								</td>
						</tr>

 						<tr>
        					 <td colspan=\"2\">
        						 <table style=\"border-collapse:collapse;\" width=\"800\" align=\"center\" border=\"1\" cellspacing=\"-1\" cellpadding=\"-1\">
        							 <tr>
								         <td width=\"60%\" align=\"left\" style=\"font-size:12px\" valign=\"top\">
							
								         <td width=\"40%\" align=\"center\">AGATS,$tgl_sp2d<br>$jab_kaban</br><br></br><br></br><br></br><br></br><br></br><br></br>
								         <b><u>$nm_kaban</u></b><br>
								         <b>NIP.$nip_kaban</b>                
								         </td>
								         </tr>";
								        

					$cRet .="
               	   				</table>
               	   			</td>
               	   		</tr>
               	   		
				</table>";
			
		        $data['prev']= $cRet;
		        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $jenisCetak);
		        $judul  = 'Surat Perintah Pencairan Dana' .'-'. $test;
		        // echo $judul;
		        // echo $data['tipeCetakan'];
		        switch ($data['tipeCetakan']) {
		        	case 0:
		        		
		        	$this->_mpdf('',$cRet,2,2,2,'P');
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

	

*/
	


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
