<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_rekap_kulit extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('laporan/lap_rekapitulasi/M_rekap_kulit');
	}

	function _mpdf($judul='',$isi='',$lMargin=10,$rMargin=10,$font=10,$orientasi) {
        ob_clean();
       	ini_set("memory_limit","-1");
        $this->load->library('M_pdf');
        $mpdf = new m_pdf('', 'Letter-L');
        $pdfFilePath = "output_pdf_name.pdf";
        $mpdf->pdf->SetFooter('Printed Gaji P3K on @ {DATE j-m-Y H:i:s} || Halaman {PAGENO} dari {nb}');
        $mpdf->pdf->AddPage($orientasi);
        if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
        $mpdf->pdf->WriteHTML($isi);         
        $mpdf->pdf->Output();
               
    }

	public function index()
	{	
		$data = array(
			'page'	 	=> 'LAPORAN REKAP KULIT',
			'judul'		=> 'LAPORAN REKAP KULIT',
			'deskripsi'	=> 'LAPORAN REKAP KULIT'
		);

		$this->template->views('laporan/lap_rekapitulasi/V_rekap_kulit', $data);
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

    function  getBulanIndo2($bln){
        switch  ($bln){
        case  '1':
        return  "Januari";
        break;
        case  '2':
        return  "Februari";
        break;
        case  '3':
        return  "Maret";
        break;
        case  '4':
        return  "April";
        break;
        case  '5':
        return  "Mei";
        break;
        case  '6':
        return  "Juni";
        break;
        case  '7':
        return  "Juli";
        break;
        case  '8':
        return  "Agustus";
        break;
        case  '9':
        return  "September";
        break;
        case  '10':
        return  "Oktober";
        break;
        case  '11':
        return  "November";
        break;
        case  '12':
        return  "Desember";
        break;
		}
    }

	public function getConfig()
	{
		return $this->M_rekap_kulit->getConfig();
	}

	public function getBulan()
	{
		echo $this->M_rekap_kulit->getBulan();
	}

	public function getTahun()
	{
		echo $this->M_rekap_kulit->getTahun();
	}

	public function getSkpd()
	{
		echo $this->M_rekap_kulit->getSkpd(); 
	}

	public function getUnitSkpd()
	{
		$param = $this->uri->segment(5);
		echo $this->M_rekap_kulit->getUnitSkpd($param);
	}

	public function cetakLaporan()
	{
		$config = $this->getConfig();
		$nm_daerah	= strtoupper($config['nm_daerah']);
		$kota	= $config['kota'];
		$thn	= strtoupper($config['thn']);
		$periode    = $config['periode'];
        $bulan  = $this->getBulanIndo2($periode);
		$jenisCetak = $this->input->get('jenisCetak');
		$tgl_cetak = $this->tanggal_balik($this->input->get('tglcetak'));
		if ($this->input->get('skpd')!='') {
			$skpd = $this->input->get('skpd');
			$nmskpd = $this->input->get('nmskpd');
		}else{
			$skpd = '';
			$nmskpd = 'KESELURUHAN';
		}
		//$bulan = $this->getBulanIndo($this->input->get('bulan_tglcetak'));
		
		$data = array(
			'nm_kab'	 	=> strtoupper($config['nm_daerah']),
			'skpd'	 	=> $skpd,
			'jenisCetak' => $jenisCetak,
		);

		$bluePrint = $this->M_rekap_kulit->cetakLaporan($data);
		$nippa = $bluePrint[0]['nippa'];
		$namapa = $bluePrint[0]['namapa'];
		$jabatanpa = $bluePrint[0]['jabatanpa'];
		$nipbk = $bluePrint[1]['nipbk'];
		$namabk = $bluePrint[1]['namabk'];
		$jabatanbk = $bluePrint[1]['jabatanbk'];
		$nippdg = $bluePrint[2]['nippdg'];
		$namapdg = $bluePrint[2]['namapdg'];
		$jabatanpdg = $bluePrint[2]['jabatanpdg'];

		if ($this->input->get('skpd')!='') {
			if ($jenisCetak == 0){
				$where = "WHERE satkerja = '$skpd' and ";
				$where2 = "WHERE satkerja = '$skpd' ";
			}else{
				$where = "WHERE satkerja = '$skpd' and ";
				$where2 = "WHERE satkerja = '$skpd' ";
			}
		}else{
			if ($jenisCetak == 0){
				$where = "WHERE ";
				$where2 = "";
			}else{
				$where = "WHERE ";
				$where2 = "";
			}
		}
		//echo $where;

			$cRet ='';
			$cRet .= "
	        		<table style=\"border-collapse:collapse; font-size:10px\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
	            		<tr>
	                		<td align=\"left\" width=\"30%\" style=\"border-left:dashed 1px gray;border-top:dashed 1px gray;\">DEPARTEMEN DALAM NEGERI RI</td>
	                		<td align=\"center\" width=\"40%\" style=\"border-left:dashed 1px gray;border-top:dashed 1px gray;\">DAFTAR</td>
	                		<td align=\"center\" width=\"30%\" style=\"border-left:dashed 1px gray;border-top:dashed 1px gray;border-right:dashed 1px gray\">NO DAFTAR GAJI</td>
	            		</tr>
	            		<tr>
	                		<td align=\"left\" width=\"30%\" style=\"border-left:dashed 1px gray;border-right:dashed 1px gray;\"><b>$nmskpd</b></td>
	                		<td align=\"center\" width=\"40%\" style=\"border-left:dashed 1px gray;border-right:dashed 1px gray;\">GAJI P3K UNTUK PARA PEGAWAI</td>
	                		<td align=\"center\" width=\"30%\" style=\"border-left:dashed 1px gray;border-right:dashed 1px gray;\">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </td>
	            		</tr>
	            		<tr>
	                		<td align=\"left\" width=\"30%\" style=\"border-left:dashed 1px gray;border-right:dashed 1px gray;\"><b>KABUPATEN $nm_daerah</b></td>
	                		<td align=\"center\" width=\"40%\" style=\"border-left:dashed 1px gray;border-right:dashed 1px gray;\">GOLONGAN I s/d XVII</td>
	                		<td align=\"center\" width=\"30%\" style=\"border-left:dashed 1px gray;border-right:dashed 1px gray;\">. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . </td>
	            		</tr>
	            		<tr>
	                		<td align=\"left\" width=\"30%\" style=\"border-left:dashed 1px gray;border-right:dashed 1px gray;\"></td>
	                		<td align=\"center\" width=\"40%\" style=\"border-left:dashed 1px gray;border-right:dashed 1px gray;\">PADA SATUAN KERJA <br> <b>$nmskpd <br> KABUPATEN $nm_daerah</b></td>
	                		<td align=\"center\" width=\"30%\" style=\"border-left:dashed 1px gray;border-right:dashed 1px gray;\">TEMPAT PEMBAYARAN SP2D</td>
	            		</tr>
	            		<tr>
	                		<td align=\"left\" width=\"30%\" style=\"border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;\"></td>
	                		<td align=\"center\" width=\"40%\" style=\"border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;\">BULAN : ".strtoupper($bulan)." $thn</td>
	                		<td align=\"center\" width=\"30%\" style=\"border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;\">KAS DAERAH / KANTOR POS (PEMBANTU)</td>
	            		</tr>
	        		</table>
	        		";
	        		$sqljiwa = "SELECT distinct
							case when golongan='1' then (select count(*) from pegawai $where kdbantu<>'6')
							when golongan='2' then (select count(*) from pegawai $where kdbantu<>'6')
							when golongan='3' then (select count(*) from pegawai $where kdbantu<>'6')
							when golongan='4' then (select count(*) from pegawai $where kdbantu<>'6') 
							when golongan='5' then (select count(*) from pegawai $where kdbantu<>'6')
							when golongan='6' then (select count(*) from pegawai $where kdbantu<>'6')
							when golongan='7' then (select count(*) from pegawai $where kdbantu<>'6')
							when golongan='8' then (select count(*) from pegawai $where kdbantu<>'6')
							when golongan='9' then (select count(*) from pegawai $where kdbantu<>'6')
							when golongan='10' then (select count(*) from pegawai $where kdbantu<>'6')
							when golongan='11' then (select count(*) from pegawai $where kdbantu<>'6')
							when golongan='12' then (select count(*) from pegawai $where kdbantu<>'6')
							when golongan='13' then (select count(*) from pegawai $where kdbantu<>'6')
							when golongan='14' then (select count(*) from pegawai $where kdbantu<>'6')
							when golongan='15' then (select count(*) from pegawai $where kdbantu<>'6')
							when golongan='16' then (select count(*) from pegawai $where kdbantu<>'6')
							when golongan='17' then (select count(*) from pegawai $where kdbantu<>'6') else 0 END AS jum_peg_jiwa,
							case when golongan='1' then (select count(*) from pegawai $where stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='2' then (select count(*) from pegawai $where stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='3' then (select count(*) from pegawai $where stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='4' then (select count(*) from pegawai $where stskawin=1 and (kdbantu<>'6' and kdbantu<>'4')) 
							when golongan='5' then (select count(*) from pegawai $where stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='6' then (select count(*) from pegawai $where stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='7' then (select count(*) from pegawai $where stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='8' then (select count(*) from pegawai $where stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='9' then (select count(*) from pegawai $where stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='10' then (select count(*) from pegawai $where stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='11' then (select count(*) from pegawai $where stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='12' then (select count(*) from pegawai $where stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='13' then (select count(*) from pegawai $where stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='14' then (select count(*) from pegawai $where stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='15' then (select count(*) from pegawai $where stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='16' then (select count(*) from pegawai $where stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='17' then (select count(*) from pegawai $where stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
							else 0 END AS jum_istri_jiwa,
							case when golongan='1' then (select sum(anak) from pegawai $where (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='2' then (select sum(anak) from pegawai $where (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='3' then (select sum(anak) from pegawai $where (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='4' then (select sum(anak) from pegawai $where (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='5' then (select sum(anak) from pegawai $where (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='6' then (select sum(anak) from pegawai $where (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='7' then (select sum(anak) from pegawai $where (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='8' then (select sum(anak) from pegawai $where (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='9' then (select sum(anak) from pegawai $where (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='10' then (select sum(anak) from pegawai $where (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='11' then (select sum(anak) from pegawai $where (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='12' then (select sum(anak) from pegawai $where (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='13' then (select sum(anak) from pegawai $where (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='14' then (select sum(anak) from pegawai $where (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='15' then (select sum(anak) from pegawai $where (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='16' then (select sum(anak) from pegawai $where (kdbantu<>'6' and kdbantu<>'4'))
							when golongan='17' then (select sum(anak) from pegawai $where (kdbantu<>'6' and kdbantu<>'4'))
							else 0 END AS jum_anak_jiwa from pegawai $where2;";

							$queryjiwa = $this->db->query($sqljiwa); 
							$jumlah_tot_jiwa = 0;
					        foreach ($queryjiwa->result() as $rowjiwa) {
					                $jum_peg_jiwa 	    =$rowjiwa->jum_peg_jiwa;
					                $jum_istri_jiwa 	=$rowjiwa->jum_istri_jiwa;
					                $jum_anak_jiwa 	    =$rowjiwa->jum_anak_jiwa;
					                $jum_tot_jiwa 	    =$jum_peg_jiwa+$jum_istri_jiwa+$jum_anak_jiwa;
					                $jumlah_tot_jiwa 	=$jumlah_tot_jiwa + $jum_tot_jiwa;
					        }

	        $cRet .= "
	        		<table style=\"border-collapse:collapse; font-size:10px\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
	            		<tr>
	                		<td align=\"left\" width=\"50%\" style=\"border-left:dashed 1px gray;border-bottom:dashed 1px gray;\"><br>Catatan - catatan pembuat daftar gaji </br><br>&nbsp;</br><br>&nbsp;</br></td>
	                		<td align=\"left\" width=\"50%\" style=\"border-left:dashed 1px gray;border-right:dashed 1px gray;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Jumlah P3K dan keluarga : $jumlah_tot_jiwa Jiwa</td>
	            		</tr>
	            		<tr>
	                		<td width=\"50%\" valign=\"top\" align=\"left\" style=\"border-right:dashed 1px gray;;\">
	                			<table style=\"border-collapse:collapse;border-bottom:dashed 1px gray;font-family: Times New Roman; font-size:10px\" width=\"500\" align=\"left\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">
	                                <tr>
	                                    <td width=\"50%\" colspan=\"6\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"left\"><u>PENGHASILAN :</u></td>
	                                </tr>";

	                                if ($this->input->get('skpd')!='') {
	                                	$sql = "SELECT satkerja,sum(gapok) as gapok,sum(tistri) as tistri,sum(tanak) as tanak,
										sum(gapok+tistri+tanak) as tkeluarga,sum(tpp) as tpp,sum(tstruk) as tstruk,
										sum(case when left(kd_fung,1)<>'U' then tfung else 0 end) as tfung,sum(bulat) as bulat,sum(beras) as beras,
										sum(umum) as umum,sum(pph) as pph,sum(askes) as askes,sum(bruto) as bruto,
										sum(iwp) as iwp,sum(sewa) as sewa,sum(tabungan) as tabungan,sum(hutang) as hutang,sum(tunggakan) as tunggakan,
										sum(lain) as lain,sum(disc) as jum_pot,sum(netto) as netto,sum(jkk) as jkk,sum(jkm) as jkm,sum(khusus) as khusus,sum(tht) as tht 
										from pegawai $where2 group by satkerja;";
									}else{
										$sql = "SELECT sum(gapok) as gapok,sum(tistri) as tistri,sum(tanak) as tanak,
										sum(gapok+tistri+tanak) as tkeluarga,sum(tpp) as tpp,sum(tstruk) as tstruk,
										sum(case when left(kd_fung,1)<>'U' then tfung else 0 end) as tfung,sum(bulat) as bulat,sum(beras) as beras,
										sum(umum) as umum,sum(pph) as pph,sum(askes) as askes,sum(bruto) as bruto,
										sum(iwp) as iwp,sum(sewa) as sewa,sum(tabungan) as tabungan,sum(hutang) as hutang,sum(tunggakan) as tunggakan,
										sum(lain) as lain,sum(disc) as jum_pot,sum(netto) as netto,sum(jkk) as jkk,sum(jkm) as jkm,sum(khusus) as khusus,sum(tht) as tht 
										from pegawai $where2;";
									}

										$query = $this->db->query($sql); 
										$i = 0;
								        foreach ($query->result() as $row) {								                
												$i++;
								                $gapok         =$row->gapok;
								                $tistri        =$row->tistri;
								                $tanak         =$row->tanak;
								                $tkeluarga     =$row->tkeluarga;
								                $tpp           =$row->tpp;
								                $tstruk        =$row->tstruk;
								                $tfung         =$row->tfung;
								                $bulat         =$row->bulat;
								                $beras         =$row->beras;
								                $umum          =$row->umum;
								                $pph           =$row->pph;
								                $askes         =$row->askes;
								                $iwp           =$row->iwp;
								                $sewa          =$row->sewa;
								                $tabungan      =$row->tabungan;
								                $hutang        =$row->hutang;
								                $lain          =$row->lain;
								                //$netto         =$row->netto;
								                $jkk           =$row->jkk;
								                $jkm           =$row->jkm;
								                $khusus        =$row->khusus;
								                $tht           =$row->tht;
								                $tunggakan     =$row->tunggakan;
								                $bruto         =$gapok+$tistri+$tanak+$umum+$khusus+$tstruk+$tfung+$bulat+$beras+$jkk+$jkm+$askes;
												$jum_pot       =$iwp+$tht+$askes+$pph+$jkk+$jkm+$sewa+$tabungan+$hutang+$lain;
												$netto         =$bruto-$jum_pot;
												$cnetto 	   =$this->penyebut($netto);

		                                $cRet .="<tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">1.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">GAJI POKOK</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($gapok,2,',','.')."</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                </tr>
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">2.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">TUNJANGAN SUAMI/ISTRI</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($tistri,2,',','.')."</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                </tr>
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">3.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">TUNJANGAN ANAK</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($tanak,2,',','.')."</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($tkeluarga,2,',','.')."</td>
		                                </tr>
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">4.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">TUNJANGAN STRUKTURAL</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($tstruk,2,',','.')."</td>
		                                </tr>
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">5.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">TUNJANGAN FUNGSIONAL UMUM</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($umum,2,',','.')."</td>
		                                </tr>
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">6.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">TUNJANGAN FUNGSIONAL</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($tfung,2,',','.')."</td>
		                                </tr>
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">7.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">TUNJANGAN KHUSUS</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($khusus,2,',','.')."</td>
		                                </tr>		                                
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">8.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">PEMBULATAN</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($bulat,2,',','.')."</td>
		                                </tr>
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">9.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">TUNJANGAN BERAS</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($beras,2,',','.')."</td>
		                                </tr> 
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">10.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">TUNJANGAN PAJAK PENGHASILAN</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($pph,2,',','.')."</td>
		                                </tr>
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">11.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">BPJSKES 4%</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($askes,2,',','.')."</td>
		                                </tr>
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">12.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">TUNJANGAN JKK</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($jkk,2,',','.')."</td>
		                                </tr>
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">13.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">TUNJANGAN JKM</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($jkm,2,',','.')."</td>
		                                </tr>
		                                <tr>
		                                    <td width=\"31%\" colspan=\"4\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">JUMLAH PENGHASILAN KOTOR</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($bruto,2,',','.')."</td>
		                                </tr>
		                                <tr>
		                                    <td width=\"31%\" colspan=\"4\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">&nbsp;</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">&nbsp;</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                    <td width=\"50%\" colspan=\"6\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"left\"><u>POTONGAN :</u></td>
		                                </tr>		                                
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">1.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">POTONGAN IWP 1%</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($iwp,2,',','.')."</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                </tr>		                                
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">2.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">JHT</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($tht,2,',','.')."</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                </tr>
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">3.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">POTONGAN PAJAK</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($pph,2,',','.')."</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                </tr>
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">4.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">BPJS KES </td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($askes,2,',','.')."</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                </tr>
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">5.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">POTONGAN JKK</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($jkk,2,',','.')."</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                </tr>
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">6.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">POTONGAN JKM</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($jkm,2,',','.')."</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                </tr>
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">7.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">POTONGAN TAPERUM</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($tabungan,2,',','.')."</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                </tr>
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">8.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">SEWA RUMAH</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($sewa,2,',','.')."</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                </tr>		                                
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">9.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">TUNGGAKAN</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($tunggakan,2,',','.')."</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                </tr>
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">10.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">HUTANG</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($hutang,2,',','.')."</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                </tr>
		                                <tr>
		                                    <td width=\"3%\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">11.</td>
		                                    <td width=\"10%\" style=\"font-size:10px\" align=\"left\">HUTANG/LAIN-LAIN</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\">".number_format($lain,2,',','.')."</td>
		                                    <td width=\"3%\" style=\"font-size:10px\" align=\"center\"></td>
		                                    <td width=\"15%\" style=\"font-size:10px\" align=\"right\"></td>
		                                </tr> 
		                                <tr>
		                                    <td width=\"31%\" colspan=\"4\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">JUMLAH POTONGAN</td>
		                                    <td width=\"3%\" style=\"font-size:10px;\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px;\" align=\"right\">".number_format($jum_pot,2,',','.')."</td>
		                                </tr>
		                                <tr>
		                                   <td width=\"31%\" colspan=\"4\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">JUMLAH PENGHASILAN BERSIH</td>
		                                    <td width=\"3%\" style=\"font-size:10px;\" align=\"center\">Rp.</td>
		                                    <td width=\"15%\" style=\"font-size:10px;\" align=\"right\">".number_format($netto,2,',','.')."</td>
		                                </tr>
		                                <tr>
		                                   <td width=\"31%\" colspan=\"4\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">&nbsp;</td>
		                                    <td width=\"3%\" style=\"font-size:10px;\" align=\"center\">&nbsp;</td>
		                                    <td width=\"15%\" style=\"font-size:10px;\" align=\"right\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                   <td width=\"50%\" colspan=\"6\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"left\"><i>Terbilang : $cnetto</i></td>
		                                </tr>
		                                <tr>
		                                   	<td width=\"31%\" colspan=\"4\" style=\"font-size:10px;border-left:dashed 1px gray;\" align=\"center\">&nbsp;</td>
		                                    <td width=\"3%\" style=\"font-size:10px;\" align=\"center\">&nbsp;</td>
		                                    <td width=\"15%\" style=\"font-size:10px;\" align=\"right\">&nbsp;</td>
		                                </tr>";
		                            }
                                $cRet .="</table>
	                		</td>
	                		<td width=\"50%\" valign=\"top\" align=\"left\">
	                			<table style=\"border-collapse:collapse;border-right:dashed 1px gray;font-family: Times New Roman; font-size:10px\" width=\"600\" align=\"left\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">
	                                <tr><thead>
	                                    <td width=\"5%\" valign=\"center\" align=\"center\" valign=\"top\"></td>
	                                    <td width=\"8%\" style=\"border-bottom: dashed 1px gray; border-top: dashed 1px gray; border-right: dashed 1px gray; border-left: dashed 1px gray;\" valign=\"center\" align=\"center\" valign=\"top\">Golongan</td>
	                                    <td width=\"8%\" style=\"border-bottom: dashed 1px gray; border-top: dashed 1px gray; border-right: dashed 1px gray; border-left: dashed 1px gray;\" valign=\"center\" align=\"center\" valign=\"top\">Jumlah P3K</td>
	                                    <td width=\"8%\" style=\"border-bottom: dashed 1px gray; border-top: dashed 1px gray; border-right: dashed 1px gray; border-left: dashed 1px gray;\" valign=\"center\" align=\"center\" valign=\"top\">Istri/Suami</td>
	                                    <td width=\"8%\" style=\"border-bottom: dashed 1px gray; border-top: dashed 1px gray; border-right: dashed 1px gray; border-left: dashed 1px gray;\" valign=\"center\" align=\"center\" valign=\"top\">Anak</td>
	                                    <td width=\"8%\" style=\"border-bottom: dashed 1px gray; border-top: dashed 1px gray; border-right: dashed 1px gray;\" valign=\"center\" align=\"center\" valign=\"top\">Jumlah</td>
	                                    <td width=\"5%\" valign=\"center\" align=\"center\" valign=\"top\"></td>
	                                    </thead>
	                                </tr>";

	                                $sql = "SELECT x.golongan,substr(x.nm_golongan,10,5) as nm_golongan,
										(select count(*) from pegawai $where golongan=x.golongan and kdbantu<>'6') as jum_peg,
										(select count(*) from pegawai $where golongan=x.golongan and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4')) as jum_istri,
										(select sum(anak) from pegawai $where golongan=x.golongan and (kdbantu<>'6' and kdbantu<>'4')) as jum_anak
										from golongan x ORDER BY x.nm_golongan;";

										$query = $this->db->query($sql); 
										$i = 0;
										$jumlah_peg = 0;$jumlah_istri = 0;$jumlah_anak = 0;$jumlah_tot = 0;
								        foreach ($query->result() as $row) {			                
												$i++;
								                $nm_golongan   =$row->nm_golongan;
								                $jum_peg 	   =$row->jum_peg;
								                $jum_istri 	   =$row->jum_istri;
								                $jum_anak 	   =$row->jum_anak;
								                $jum_tot 	   =$jum_peg+$jum_istri+$jum_anak;
								                $jumlah_peg 	= $jumlah_peg + $jum_peg;
								                $jumlah_istri 	= $jumlah_istri + $jum_istri;
								                $jumlah_anak 	= $jumlah_anak + $jum_anak;
								                $jumlah_tot 	= $jumlah_tot + $jum_tot;
								                if($jum_tot > 0){
								                $cRet .="<tr>
				                                    <td width=\"5%\" align=\"center\"></td>
				                                    <td width=\"8%\" style=\"border-right: dashed 1px gray; border-left: dashed 1px gray;\" align=\"center\">$nm_golongan &nbsp;</td>
				                                    <td width=\"8%\" style=\"border-right: dashed 1px gray; border-left: dashed 1px gray;\" align=\"right\">$jum_peg &nbsp;</td>
				                                    <td width=\"8%\" style=\"border-right: dashed 1px gray; border-left: dashed 1px gray;\" align=\"right\">$jum_istri &nbsp;</td>
				                                    <td width=\"8%\" style=\"border-right: dashed 1px gray; border-left: dashed 1px gray;\" align=\"right\">$jum_anak &nbsp;</td>
				                                    <td width=\"8%\" style=\"border-right: dashed 1px gray; border-left: dashed 1px gray;\"align=\"right\">$jum_tot &nbsp;</td>
				                                    <td width=\"5%\" align=\"center\"></td>
				                                </tr>";	
				                                }							            
								    	}
	                                $cRet .="<tr>
	                                    <td width=\"5%\" align=\"center\"></td>
	                                    <td width=\"8%\" style=\"border-bottom: dashed 1px gray; border-top: dashed 1px gray; border-right: dashed 1px gray; border-left: dashed 1px gray;\" align=\"center\">JUMLAH &nbsp;</td>
	                                    <td width=\"8%\" style=\"border-bottom: dashed 1px gray; border-top: dashed 1px gray; border-right: dashed 1px gray; border-left: dashed 1px gray;\" align=\"right\">$jumlah_peg &nbsp;</td>
	                                    <td width=\"8%\" style=\"border-bottom: dashed 1px gray; border-top: dashed 1px gray; border-right: dashed 1px gray; border-left: dashed 1px gray;\" align=\"right\">$jumlah_istri &nbsp;</td>
	                                    <td width=\"8%\" style=\"border-bottom: dashed 1px gray; border-top: dashed 1px gray; border-right: dashed 1px gray; border-left: dashed 1px gray;\" align=\"right\">$jumlah_anak &nbsp;</td>
	                                    <td width=\"8%\" style=\"border-bottom: dashed 1px gray; border-top: dashed 1px gray; border-right: dashed 1px gray;\" align=\"right\">$jumlah_tot&nbsp;&nbsp;</td>
	                                    <td width=\"5%\" align=\"center\"></td>
	                                </tr>
	                                 <tr>
	                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
	                                </tr>
	                                <tr>
	                                	<td width=\"5%\"  valign=\"center\" align=\"center\" valign=\"top\"></td>
	                                	<td width=\"40%\" colspan =\"5\"  valign=\"center\" align=\"left\" valign=\"top\">LAMPIRAN : . . . . . . . . .</td>
	                                	<td width=\"5%\"  valign=\"center\" align=\"center\" valign=\"top\"></td>
	                                </tr>
	                                <tr>
	                                	<td width=\"5%\"  valign=\"center\" align=\"center\" valign=\"top\"></td>
	                                	<td width=\"40%\" colspan =\"5\"  valign=\"center\" align=\"left\" valign=\"top\">HARAP SPM DITERBITKAN ATAS NAMA</td>
	                                	<td width=\"5%\"  valign=\"center\" align=\"center\" valign=\"top\"></td>
	                                </tr>
	                                <tr>
	                                	<td width=\"5%\"  valign=\"center\" align=\"center\" valign=\"top\"></td>
	                                	<td width=\"40%\" colspan =\"5\"  valign=\"center\" align=\"center\" valign=\"top\">BENDAHARA PENGELUARAN<br>$nmskpd<br>KABUPATEN $nm_daerah</b></td>
	                                	<td width=\"5%\"  valign=\"center\" align=\"center\" valign=\"top\"></td>
	                                </tr>
	                                <tr>
	                                	<td width=\"5%\"  valign=\"center\" align=\"center\" valign=\"top\"></td>
	                                	<td width=\"40%\" colspan =\"5\"  valign=\"center\" align=\"center\" valign=\"top\">DEPARTEMEN DALAM NEGERI RI</b></td>
	                                	<td width=\"5%\"  valign=\"center\" align=\"center\" valign=\"top\"></td>
	                                </tr>
	                                <tr>
	                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">Dibuat untuk lembar asli/kedua/ketiga/keempat/kelima/keenam.</td>
	                                </tr>";
	                                if ($this->input->get('skpd')!='') {
		                                $cRet .= "		                                
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">$kota, $tgl_cetak</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">$jabatanpdg</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\"><u>$namapdg</u></td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">NIP. $nippdg</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">$jabatanbk</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\"><u>$namabk</u></td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">NIP. $nipbk</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">MENGETAHUI/MENYETUJUI,</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">$jabatanpa</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\"><u>$namapa</u></td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">NIP. $nippa</td>
		                                </tr>";
	                                }else{
	                                	$sqlttd1="SELECT nama,nip,jabatan FROM ttd where ckey='BID'";
								        $sqlttd=$this->db->query($sqlttd1);
								        foreach ($sqlttd->result() as $rowttd)
								        {
								            $nipbid=$rowttd->nip;                    
								            $namabid= $rowttd->nama;
								            $jabatanbid  = $rowttd->jabatan;
								        }

								        $sqlttd2="SELECT nama,nip,jabatan FROM ttd where ckey='BUD'";
								        $sqlttd2=$this->db->query($sqlttd2);
								        foreach ($sqlttd2->result() as $rowttd2)
								        {
								            $nipbud=$rowttd2->nip;                    
								            $namabud= $rowttd2->nama;
								            $jabatanbud  = $rowttd2->jabatan;
								        }
										$cRet .= "
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">$kota, $tgl_cetak</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">$jabatanbid</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\"><u>$namabid</u></td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">NIP. $nipbid</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">MENGETAHUI/MENYETUJUI,</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">$jabatanbud</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\"><u>$namabud</u></td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">NIP. $nipbud</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>
		                                <tr>
		                                	<td width=\"50%\" colspan =\"7\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
		                                </tr>";
	        						}
	                                $cRet .= "<tr>
	                                    <td width=\"50%\" style=\"border-bottom: dashed 1px gray; border-right: dashed 1px gray; \" colspan=\"7\"  align=\"center\">&nbsp;</td>
	                                </tr>
                                </table>                                
	                		</td>
	            		</tr>
	        		</table>
	        		";
	    

        $data['prev']= $cRet;
        $judul  = 'Laporan Rekap Kulit Gaji Per Golongan';
        switch ($jenisCetak) {
        	case 0:
        		$this->_mpdf('',$cRet,10,10,10,'L');
        		break;
        	case 1:
        		header("Cache-Control: no-cache, no-store, must-revalidate");
	            header("Content-Type: application/vnd.ms-excel");
	            header("Content-Disposition: attachment; filename= $judul.xls");
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



}

/* End of file C_kib_b.php */
/* Location: ./application/controllers/laporan/C_kib_b.php */
