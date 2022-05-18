<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_rekap_golongan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('laporan/lap_rekapitulasi/M_rekap_golongan');
	}

	function _mpdf($judul='',$isi='',$lMargin=10,$rMargin=10,$font=10,$orientasi) {
        ob_clean();
       	ini_set("memory_limit","-1");
        $this->load->library('M_pdf');
        $mpdf = new m_pdf('', 'Letter-L');
        $pdfFilePath = "output_pdf_name.pdf";
        $mpdf->pdf->SetFooter('Printed Gaji  on @ {DATE j-m-Y H:i:s} || Halaman {PAGENO} dari {nb}');
        $mpdf->pdf->AddPage($orientasi);
        if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
        $mpdf->pdf->WriteHTML($isi);         
        $mpdf->pdf->Output();
               
    }

	public function index()
	{	
		$data = array(
			'page'	 	=> 'LAPORAN GAJI PER GOLONGAN',
			'judul'		=> 'LAPORAN GAJI PER GOLONGAN',
			'deskripsi'	=> 'LAPORAN GAJI PER GOLONGAN'
		);

		$this->template->views('laporan/lap_rekapitulasi/V_rekap_golongan', $data);
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
		return $this->M_rekap_golongan->getConfig();
	}

	public function getBulan()
	{
		echo $this->M_rekap_golongan->getBulan();
	}

	public function getTahun()
	{
		echo $this->M_rekap_golongan->getTahun();
	}

	public function getSkpd()
	{
		echo $this->M_rekap_golongan->getSkpd(); 
	}

	public function getUnitSkpd()
	{
		$param = $this->uri->segment(5);
		echo $this->M_rekap_golongan->getUnitSkpd($param);
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
			if ($jenisCetak == 0){
				$where = "WHERE satkerja = '$skpd' and ";
				$where2 = "WHERE satkerja = '$skpd' ";
			}else{
				$where = "WHERE satkerja = '$skpd' and ";
				$where2 = "WHERE satkerja = '$skpd' ";
			}
		}else{
			$skpd = '';
			$nmskpd = 'KESELURUHAN';
			if ($jenisCetak == 0){
				$where = "WHERE";
				$where2 = "";
			}else{
				$where = "WHERE";
				$where2 = "";
			}
		}
		//$bulan = $this->getBulanIndo($this->input->get('bulan_tglcetak'));
		
		$data = array(
			'nm_kab'	 	=> strtoupper($config['nm_daerah']),
			'skpd'	 	=> $skpd,
			'jenisCetak' => $jenisCetak,
		);

		$bluePrint = $this->M_rekap_golongan->cetakLaporan($data);
		$nippa = $bluePrint[0]['nippa'];
		$namapa = $bluePrint[0]['namapa'];
		$jabatanpa = $bluePrint[0]['jabatanpa'];
		$nipbk = $bluePrint[1]['nipbk'];
		$namabk = $bluePrint[1]['namabk'];
		$jabatanbk = $bluePrint[1]['jabatanbk'];
		$nippdg = $bluePrint[2]['nippdg'];
		$namapdg = $bluePrint[2]['namapdg'];
		$jabatanpdg = $bluePrint[2]['jabatanpdg'];

	    /*if ($jenisCetak == 0){
		$where = "WHERE satkerja = '$skpd' and ";
		$where2 = "WHERE satkerja = '$skpd' ";
		} else if ($jenisCetak == 1) {
		$where = "WHERE satkerja = '$skpd'";
		$where2 = "WHERE satkerja = '$skpd' ";
		} else {
		$where = "WHERE satkerja = '$skpd'";
		$where2 = "WHERE satkerja = '$skpd' ";
		}*/
		echo $where;

		$cRet ='';
        $cRet .= "
        		<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
            		<tr>
                		<td></td>
                		<td align=\"center\" colspan=\"13\" style=\"font-size:14px;border: solid 1px white;\"><B>REKAPITULASI DAFTAR GAJI PEGAWAI PER GOLONGAN</B></td>
            		</tr><BR/><BR/>
        		</table>
        		";

        $cRet .="
        		<table style=\"font-size:12px;border-collapse:collapse;\" width=\"100%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
            
                     <tr>
						<td align=\"left\" width=\"10%\"><b>NAMA SATKERJA</b></td>                    
						<td align=\"center\" width=\"1%\">:</td>
						<td align=\"left\" width=\"80%\"><b>$skpd $nmskpd</b></td>
	
					</tr>
                    <tr>
						<td align=\"left\" width=\"10%\"><b>GAJI BULAN</b></td>                    
						<td align=\"center\" width=\"1%\">:</td>
						<td align=\"left\" width=\"80%\"><b>".strtoupper($bulan)." $thn</b></td>		
					</tr> 

                  </table>";
        
		$cRet .="
				<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
                	<thead>
                	</thead>
                		<tr>
		                    <td align=\"center\" rowspan=\"2\" width=\"10%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">GOLONGAN</td>
		                    <td align=\"center\" border=\"1\" rowspan=\"2\" width=\"5%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">-PEGAWAI<br></br>- ISTRI<br></br>- ANAK<br>- JIWA</br></td>
		                    <td align=\"center\" border=\"1\" colspan=\"6\" width=\"64%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">P E N G H A S I L A N</td>
		                    <td align=\"center\" border=\"1\" colspan=\"4\" width=\"29%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">P O T O N G A N</td>
		                    <td align=\"left\" border=\"1\" rowspan=\"2\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH <br> PENGHASILAN <br> BERSIH <br> YANG <br> DIBAYARKAN <br></td>
                		</tr>
                		<tr>
		                    <td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">GAJI POKOK<br>TUNJ<br>- SUAMI/<br>ISTRI<br>- ANAK<br>- JUMLAH</td>
		                    <td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">TUNJANGAN<br>- UMUM<br>- KHUSUS</td>
		                    <td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">TUNJANGAN<br>- STRUK<br>- FUNG<br>- BULAT</td>
		                    <td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">TUNJANGAN<br>- BERAS<br>- JKK<br>- JKM</td>
		                    <td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">TUNJANGAN<br>- PAJAK PENGHASILAN<br>- BPJS KES<br></td>
		                    <td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH<br>PENGHASILAN<br>KOTOR</td>
		                    <td align=\"left\" border=\"1\" width=\"7%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">- IWP 1%<br>- JHT<br>- BPJS KES</td>
		                    <td align=\"left\" border=\"1\" width=\"7%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">- PAJAK<br>PENGHASILAN<br>- JKK<br>- JKM</td>
		                    <td align=\"left\" border=\"1\" width=\"7%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">- SEWA<br>&nbsp;&nbsp;RMH<br>- TAPERUM<br>- HUT.LBH<br>- LAIN</td>
		                    <td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH<br>POTONGAN</td>
                		</tr> "; 

                		$cRet .="
                		<tr><td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">1</td>
		                    <td align=\"center\" border=\"1\" width=\"5%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">2</td>
		                    <td align=\"center\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">3</td>
		                    <td align=\"center\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">4</td>
		                    <td align=\"center\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">5</td>
		                    <td align=\"center\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">6</td>
		                    <td align=\"center\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">7</td>
		                    <td align=\"center\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">8</td>
		                    <td align=\"center\" border=\"1\" width=\"7%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">9</td>
		                    <td align=\"center\" border=\"1\" width=\"7%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">10</td>
		                    <td align=\"center\" border=\"1\" width=\"7%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">11</td>
		                    <td align=\"center\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">12</td>
		                    <td align=\"center\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">13</td>
                		</tr>";
                		$sql = "SELECT DISTINCT golongan,
								case 
								when golongan in ('1') then 'I' 
								when golongan in ('2') then 'II' 
								when golongan in ('3') then 'III' 
								when golongan in ('4') then 'IV'
								when golongan in ('5') then 'V'
								when golongan in ('6') then 'VI'
								when golongan in ('7') then 'VII'
								when golongan in ('8') then 'VIII'
								when golongan in ('9') then 'IX'
								when golongan in ('10') then 'X'
								when golongan in ('11') then 'XI'
								when golongan in ('12') then 'XII'
								when golongan in ('13') then 'XIII'
								when golongan in ('14') then 'XIV'
								when golongan in ('15') then 'XV'
								when golongan in ('16') then 'XVI'
								when golongan in ('17') then 'XVII' 
								else 'TIDAK ADA NAMA GOLONGAN' END AS nm_golongan,
								case 
								when golongan in ('1') then (select count(*) from pegawai $where golongan in ('1') and kdbantu<>'6')
								when golongan in ('2') then (select count(*) from pegawai $where golongan in ('2') and kdbantu<>'6')
								when golongan in ('3') then (select count(*) from pegawai $where golongan in ('3') and kdbantu<>'6')
								when golongan in ('4') then (select count(*) from pegawai $where golongan in ('4') and kdbantu<>'6')
								when golongan in ('5') then (select count(*) from pegawai $where golongan in ('5') and kdbantu<>'6')
								when golongan in ('6') then (select count(*) from pegawai $where golongan in ('6') and kdbantu<>'6')
								when golongan in ('7') then (select count(*) from pegawai $where golongan in ('7') and kdbantu<>'6')
								when golongan in ('8') then (select count(*) from pegawai $where golongan in ('8') and kdbantu<>'6')
								when golongan in ('9') then (select count(*) from pegawai $where golongan in ('9') and kdbantu<>'6')
								when golongan in ('10') then (select count(*) from pegawai $where golongan in ('10') and kdbantu<>'6')
								when golongan in ('11') then (select count(*) from pegawai $where golongan in ('11') and kdbantu<>'6')
								when golongan in ('12') then (select count(*) from pegawai $where golongan in ('12') and kdbantu<>'6')
								when golongan in ('13') then (select count(*) from pegawai $where golongan in ('13') and kdbantu<>'6')
								when golongan in ('14') then (select count(*) from pegawai $where golongan in ('14') and kdbantu<>'6')
								when golongan in ('15') then (select count(*) from pegawai $where golongan in ('15') and kdbantu<>'6')
								when golongan in ('16') then (select count(*) from pegawai $where golongan in ('16') and kdbantu<>'6')
								when golongan in ('17') then (select count(*) from pegawai $where golongan in ('17') and kdbantu<>'6')
								else 0 END AS jum_peg,
								case 
								when golongan in ('1') then (select count(*) from pegawai $where golongan in ('1') and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('2') then (select count(*) from pegawai $where golongan in ('2') and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('3') then (select count(*) from pegawai $where golongan in ('3') and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('4') then (select count(*) from pegawai $where golongan in ('4') and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('5') then (select count(*) from pegawai $where golongan in ('5') and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('6') then (select count(*) from pegawai $where golongan in ('6') and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('7') then (select count(*) from pegawai $where golongan in ('7') and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('8') then (select count(*) from pegawai $where golongan in ('8') and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('9') then (select count(*) from pegawai $where golongan in ('9') and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('10') then (select count(*) from pegawai $where golongan in ('10') and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('11') then (select count(*) from pegawai $where golongan in ('11') and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('12') then (select count(*) from pegawai $where golongan in ('12') and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('13') then (select count(*) from pegawai $where golongan in ('13') and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('14') then (select count(*) from pegawai $where golongan in ('14') and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('15') then (select count(*) from pegawai $where golongan in ('15') and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('16') then (select count(*) from pegawai $where golongan in ('16') and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('17') then (select count(*) from pegawai $where golongan in ('17') and stskawin=1 and (kdbantu<>'6' and kdbantu<>'4'))								
								else 0 END AS jum_istri,
								case 
								when golongan in ('1') then (select sum(anak) from pegawai $where golongan in ('1') and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('2') then (select sum(anak) from pegawai $where golongan in ('2') and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('3') then (select sum(anak) from pegawai $where golongan in ('3') and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('4') then (select sum(anak) from pegawai $where golongan in ('4') and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('5') then (select sum(anak) from pegawai $where golongan in ('5') and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('6') then (select sum(anak) from pegawai $where golongan in ('6') and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('7') then (select sum(anak) from pegawai $where golongan in ('7') and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('8') then (select sum(anak) from pegawai $where golongan in ('8') and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('9') then (select sum(anak) from pegawai $where golongan in ('9') and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('10') then (select sum(anak) from pegawai $where golongan in ('10') and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('11') then (select sum(anak) from pegawai $where golongan in ('11') and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('12') then (select sum(anak) from pegawai $where golongan in ('12') and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('13') then (select sum(anak) from pegawai $where golongan in ('13') and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('14') then (select sum(anak) from pegawai $where golongan in ('14') and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('15') then (select sum(anak) from pegawai $where golongan in ('15') and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('16') then (select sum(anak) from pegawai $where golongan in ('16') and (kdbantu<>'6' and kdbantu<>'4'))
								when golongan in ('17') then (select sum(anak) from pegawai $where golongan in ('17') and (kdbantu<>'6' and kdbantu<>'4'))
								else 0 END AS jum_anak from pegawai $where2 ORDER BY golongan;";

								$query = $this->db->query($sql); 
								$i = 0;
						        foreach ($query->result() as $row) {			                
										$i++;
						                $nm_golongan   = $row->nm_golongan;
						                if($nm_golongan == 'I'){
						                	$cgolongan = "('1')";	
						                }else if($nm_golongan == 'II'){
						                	$cgolongan = "('2')";
						                }else if($nm_golongan == 'III'){
						                	$cgolongan = "('3')";
						                }else if($nm_golongan == 'IV') {
						                	$cgolongan = "('4')";						                	
						                }else if($nm_golongan == 'V') {
						                	$cgolongan = "('5')";						                	
						                }else if($nm_golongan == 'VI') {
						                	$cgolongan = "('6')";						                	
						                }else if($nm_golongan == 'VII') {
						                	$cgolongan = "('7')";						                	
						                }else if($nm_golongan == 'VIII') {
						                	$cgolongan = "('8')";						                	
						                }else if($nm_golongan == 'IX') {
						                	$cgolongan = "('9')";						                	
						                }else if($nm_golongan == 'X') {
						                	$cgolongan = "('10')";						                	
						                }else if($nm_golongan == 'XI') {
						                	$cgolongan = "('11')";						                	
						                }else if($nm_golongan == 'XII') {
						                	$cgolongan = "('12')";						                	
						                }else if($nm_golongan == 'XIII') {
						                	$cgolongan = "('13')";						                	
						                }else if($nm_golongan == 'XIV') {
						                	$cgolongan = "('14')";						                	
						                }else if($nm_golongan == 'XV') {
						                	$cgolongan = "('15')";						                	
						                }else if($nm_golongan == 'XVI') {
						                	$cgolongan = "('16')";						                	
						                }else if($nm_golongan == 'XVII') {
						                	$cgolongan = "('17')";						                	
						                }else{
						                	$cgolongan = "('')";
						                }
						                $jum_peg 	   =$row->jum_peg;
						                $jum_istri 	   =$row->jum_istri;
						                $jum_anak 	   =$row->jum_anak;
						                $jum_tot 	   =$jum_peg+$jum_istri+$jum_anak;

										if ($this->input->get('skpd')!='') {
											$sql1 = "SELECT 
											sum(gapok) as gapok,sum(tistri) as tistri,sum(tanak) as tanak,
											sum(gapok+tistri+tanak) as tkeluarga,sum(tpp) as tpp,sum(papua) as papua,sum(tdt) as tdt,sum(tstruk) as tstruk,
											sum(case when left(kd_fung,1)<>'U' then tfung else 0 end) as tfung,sum(bulat) as bulat,sum(beras) as beras,
											sum(umum) as umum,sum(pph) as pph,sum(askes) as askes,sum(bruto) as bruto,
											sum(iwp) as iwp,sum(sewa) as sewa,sum(tabungan) as tabungan,sum(hutang) as hutang,
											sum(lain) as lain,sum(disc) as jum_pot,sum(netto) as netto, sum(jkk) as jkk, sum(jkm) as jkm, sum(khusus) as khusus,
											sum(tht) as tht from pegawai WHERE satkerja = '$skpd' and golongan in $cgolongan;";
										}else{
											$sql1 = "SELECT 
											sum(gapok) as gapok,sum(tistri) as tistri,sum(tanak) as tanak,
											sum(gapok+tistri+tanak) as tkeluarga,sum(tpp) as tpp,sum(papua) as papua,sum(tdt) as tdt,sum(tstruk) as tstruk,
											sum(case when left(kd_fung,1)<>'U' then tfung else 0 end) as tfung,sum(bulat) as bulat,sum(beras) as beras,
											sum(umum) as umum,sum(pph) as pph,sum(askes) as askes,sum(bruto) as bruto,
											sum(iwp) as iwp,sum(sewa) as sewa,sum(tabungan) as tabungan,sum(hutang) as hutang,
											sum(lain) as lain,sum(disc) as jum_pot,sum(netto) as netto, sum(jkk) as jkk, sum(jkm) as jkm, sum(khusus) as khusus,
											sum(tht) as tht from pegawai WHERE golongan in $cgolongan;";
										}

									$query1 = $this->db->query($sql1); 
									$i = 0;
							        $totalsel = 0;
							        foreach ($query1->result() as $row3) {						                
										$i++;
						                $gapok         =$row3->gapok;
						                $tistri        =$row3->tistri;
						                $tanak         =$row3->tanak;
						                $tkeluarga     =$row3->tkeluarga;
						                $tpp           =$row3->tpp;
						                $tstruk        =$row3->tstruk;
						                $tfung         =$row3->tfung;
						                $bulat         =$row3->bulat;
						                $beras         =$row3->beras;
						                $umum          =$row3->umum;
						                $pph           =$row3->pph;
						                $askes         =$row3->askes;
						                //$bruto         =$row3->bruto;
						                $iwp           =$row3->iwp;
						                $sewa          =$row3->sewa;
						                $tabungan      =$row3->tabungan;
						                $hutang        =$row3->hutang;
						                $lain          =$row3->lain;
						                //$jum_pot       =$row3->jum_pot; 
						                //$netto         =$row3->netto;
						                $jkk           =$row3->jkk;
						                $jkm           =$row3->jkm;
						                $khusus        =$row3->khusus;
						                $tht           =$row3->tht;
						                $bruto         =$gapok+$tistri+$tanak+$umum+$khusus+$tstruk+$tfung+$bulat+$beras+$jkk+$jkm+$askes;
										$jum_pot       =$iwp+$tht+$askes+$pph+$jkk+$jkm+$sewa+$tabungan+$hutang+$lain;
										$netto         =$bruto-$jum_pot;

										$cRet .="
						   			         <tr>
						                        <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$nm_golongan</td>
						                        <td align=\"right\" border=\"1\" width=\"5%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$jum_peg<br>$jum_istri</br><br>$jum_anak</br><br>----------</br><br>$jum_tot</br></td>			                        
						                        <td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($gapok,2,',','.')."<br>".number_format($tistri,2,',','.')."</br><br>".number_format($tanak,2,',','.')."</br><br>-----------------</br><br>".number_format($tkeluarga,2,',','.')."</br></td>
												<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($umum,2,',','.')."<br>".number_format($khusus,2,',','.')."</br></td>									
												<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($tstruk,2,',','.')."<br>".number_format($tfung,2,',','.')."</br><br>".number_format($bulat,2,',','.')."</br></td>
												<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($beras,2,',','.')."<br>".number_format($jkk,2,',','.')."</br><br>".number_format($jkm,2,',','.')."</br></td>
												<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($pph,2,',','.')."<br>".number_format($askes,2,',','.')."</br></td>
												<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($bruto,2,',','.')."</td>
												<td align=\"right\" border=\"1\" width=\"7%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($iwp,2,',','.')."<br>".number_format($tht,2,',','.')."</br><br>".number_format($askes,2,',','.')."</br></td>
												<td align=\"right\" border=\"1\" width=\"7%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($pph,2,',','.')."<br>".number_format($jkk,2,',','.')."</br><br>".number_format($jkm,2,',','.')."</br></td>
												<td align=\"right\" border=\"1\" width=\"7%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($sewa,2,',','.')."<br>".number_format($tabungan,2,',','.')."</br><br>".number_format($hutang,2,',','.')."</br><br>".number_format($lain,2,',','.')."</br></td>
												<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pot,2,',','.')."</td>
												<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($netto,2,',','.')."</td>
						                    </tr>";
							            
							    	}
					    }


			    	$sql2="SELECT 'JUMLAH' AS jumlah,
							(select count(*) from pegawai $where kdbantu<>'6') AS jum_peg,
							(select count(*) from pegawai $where stskawin=1 and (kdbantu<>'6' and kdbantu<>'4')) AS jum_istri,
							(select sum(anak) from pegawai $where (kdbantu<>'6' and kdbantu<>'4')) as jum_anak,
							(select count(*) from pegawai $where (kdbantu<>'6' and kdguru<>'4' and kdguru<>'5')) as jum_nonguru,
							(select count(*) from pegawai $where (kdbantu<>'6' and kdguru='4')) as jum_guru,
							(select count(*) from pegawai $where (kdbantu<>'6' and kdguru='5')) as jum_kes,
							sum(gapok) as gapok,sum(tistri) as tistri,sum(tanak) as tanak,
							sum(gapok+tistri+tanak) as tkeluarga,sum(tpp) as tpp,sum(papua) as papua,sum(tdt) as tdt,sum(tstruk) as tstruk,
							sum(case when left(kd_fung,1)<>'U' then tfung else 0 end) as tfung,sum(bulat) as bulat,sum(beras) as beras,
							sum(umum) as umum,sum(pph) as pph,sum(askes) as askes,
							sum(bruto) as bruto,sum(iwp) as iwp,sum(sewa) as sewa,
							sum(tabungan) as tabungan,sum(hutang) as hutang,sum(lain) as lain,sum(disc) as jum_pot,
							sum(netto) as netto,sum(jkk) as jkk, sum(jkm) as jkm, sum(khusus) as khusus, sum(tht) as tht from pegawai $where2;";
							
							$query2 = $this->db->query($sql2); 							
							$i = 0;
							foreach ($query2->result() as $row1) {
								$i++;
							 	$jumlah   		=$row1->jumlah;
							 	$jum_peg2 	   	=$row1->jum_peg;
				                $jum_istri2 	=$row1->jum_istri;
				                $jum_anak2 	   	=$row1->jum_anak;
				                $jum_tot2	   	=$jum_peg2+$jum_istri2+$jum_anak2;
				                $gapok2         =$row1->gapok;
				                $tistri2        =$row1->tistri;
				                $tanak2         =$row1->tanak;
				                $tkeluarga2     =$row1->tkeluarga;
				                $tpp2           =$row1->tpp;
				                $papua2         =$row1->papua;
				                $tdt2           =$row1->tdt;
				                $tstruk2        =$row1->tstruk;
				                $tfung2         =$row1->tfung;
				                $bulat2         =$row1->bulat;
				                $beras2         =$row1->beras;
				                $umum2          =$row1->umum;
				                $pph2          	=$row1->pph;
				                $askes2         =$row1->askes;
				                //$bruto2         =$row1->bruto;
				                $iwp2          	=$row1->iwp;
				                $sewa2          =$row1->sewa;
				                $tabungan2      =$row1->tabungan;
				                $hutang2        =$row1->hutang;
				                $lain2          =$row1->lain;
				                //$jum_pot2       =$row1->jum_pot; 
				                //$netto2       	=$row1->netto;
				                $jkk2       	=$row1->jkk;
				                $jkm2	       	=$row1->jkm;
				                $khusus2       	=$row1->khusus;
				                $tht2       	=$row1->tht;
				                $jum_nonguru  	=$row1->jum_nonguru;
				                $jum_guru  		=$row1->jum_guru;
				                $jum_kes  		=$row1->jum_kes;
				                $jum_total_peg  =$jum_nonguru+$jum_guru+$jum_kes;
				                $bruto2         =$gapok2+$tistri2+$tanak2+$umum2+$khusus2+$tstruk2+$tfung2+$bulat2+$beras2+$jkk2+$jkm2+$askes2;
								$jum_pot2       =$iwp2+$tht2+$askes2+$pph2+$jkk2+$jkm2+$sewa2+$tabungan2+$hutang2+$lain2;
								$netto2         =$bruto2-$jum_pot2;

								$cRet .="
					   			         <tr>
					                        <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$jumlah</td>
					                        <td align=\"right\" border=\"1\" width=\"5%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_peg2,2,',','.')."<br>".number_format($jum_istri2,2,',','.')."</br><br>".number_format($jum_anak2,2,',','.')."</br><br>----------</br><br>".number_format($jum_tot2,2,',','.')."</br></td>						                        			                        
					                        <td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($gapok2,2,',','.')."<br>".number_format($tistri2,2,',','.')."</br><br>".number_format($tanak2,2,',','.')."</br><br>-----------------</br><br>".number_format($tkeluarga2,2,',','.')."</br></td>
											<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($umum2,2,',','.')."<br>".number_format($khusus2,2,',','.')."</br></td>									
											<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($tstruk2,2,',','.')."<br>".number_format($tfung2,2,',','.')."</br><br>".number_format($bulat2,2,',','.')."</br></td>
											<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($beras2,2,',','.')."<br>".number_format($jkk2,2,',','.')."</br><br>".number_format($jkm2,2,',','.')."</br></td>
											<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($pph2,2,',','.')."<br>".number_format($askes2,2,',','.')."</br></td>
											<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($bruto2,2,',','.')."</td>
											<td align=\"right\" border=\"1\" width=\"7%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($iwp2,2,',','.')."<br>".number_format($tht2,2,',','.')."</br><br>".number_format($askes2,2,',','.')."</br></td>
											<td align=\"right\" border=\"1\" width=\"7%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($pph2,2,',','.')."<br>".number_format($jkk2,2,',','.')."</br><br>".number_format($jkm2,2,',','.')."</br></td>
											<td align=\"right\" border=\"1\" width=\"7%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($sewa2,2,',','.')."<br>".number_format($tabungan2,2,',','.')."</br><br>".number_format($hutang2,2,',','.')."</br><br>".number_format($lain2,2,',','.')."</br></td>
											<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pot2,2,',','.')."</td>
											<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:10px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($netto2,2,',','.')."</td>
					                    </tr>";

			                }
        		$cRet .="</table>"; 	

        		$cRet .="
        		<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
            
                     <tr>
						<td align=\"left\" style=\"font-size:10px;\" width=\"25%\">JUMLAH PEGAWAI DAN TUNJANGAN KELUARGA</td>                    
						<td align=\"center\" style=\"font-size:10px;\" width=\"1%\">:</td>
						<td align=\"left\" style=\"font-size:10px;\" width=\"10%\">".number_format($jum_tot2,2,',','.')." &nbsp; Jiwa</td>
						<td align=\"left\" style=\"font-size:10px;\" width=\"63%\"></td>
	
					</tr>
                    <tr>
						<td align=\"left\" style=\"font-size:10px;\" width=\"25%\">*) Jumlah yang mendapat Tunjangan Beras</td>                    
						<td align=\"center\" style=\"font-size:10px;\" width=\"1%\">:</td>
						<td align=\"left\" style=\"font-size:10px;\" width=\"10%\">".number_format($jum_tot2,2,',','.')." &nbsp; Jiwa</td>
						<td align=\"left\" style=\"font-size:10px;\" width=\"63%\"></td>
		
					</tr> 
					<tr>
						<td align=\"left\" style=\"font-size:10px;\" width=\"25%\">&nbsp;</td>                    
						<td align=\"center\" style=\"font-size:10px;\" width=\"1%\">&nbsp;</td>
						<td align=\"left\" style=\"font-size:10px;\" width=\"10%\">&nbsp;</td>
						<td align=\"left\" style=\"font-size:10px;\" width=\"63%\">&nbsp;</td>
		
					</tr>

                  </table>";

                if ($this->input->get('skpd')!='') {
                  $cRet .="
        		<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
            
                     <tr>
						<td align=\"center\" style=\"font-size:10px;\" width=\"40%\">MENGETAHUI/MENYETUJUI</td>                    
						<td align=\"center\" style=\"font-size:10px;\" width=\"30%\"></td>
						<td align=\"center\" style=\"font-size:10px;\" width=\"30%\">$kota, $tgl_cetak </td>
	
					</tr>
                    <tr>
						<td align=\"center\" style=\"font-size:10px;\" width=\"40%\">$jabatanpa</td> 
						<td align=\"center\" style=\"font-size:10px;\" width=\"30%\">$jabatanbk</td>
						<td align=\"center\" style=\"font-size:10px;\" width=\"30%\">$jabatanpdg</td>
		
					</tr> 
					 <tr>
						<td align=\"center\" style=\"font-size:10px;\" width=\"40%\">&nbsp;</td>                    
						<td align=\"center\" style=\"font-size:10px;\" width=\"30%\">&nbsp;</td>
						<td align=\"center\" style=\"font-size:10px;\" width=\"30%\">&nbsp;</td>		
					</tr> 
					 <tr>
						<td align=\"center\" style=\"font-size:10px;\" width=\"40%\">&nbsp;</td>                    
						<td align=\"center\" style=\"font-size:10px;\" width=\"30%\">&nbsp;</td>
						<td align=\"center\" style=\"font-size:10px;\" width=\"30%\">&nbsp;</td>		
					</tr> 
					<tr>
					<tr>
						<td align=\"center\" style=\"font-size:10px;\" width=\"40%\"><u>$namapa</u></td>                    
						<td align=\"center\" style=\"font-size:10px;\" width=\"30%\"><u>$namabk</u></td>
						<td align=\"center\" style=\"font-size:10px;\" width=\"30%\"><u>$namapdg</u></td>		
					</tr> 
					<tr>
						<td align=\"center\" style=\"font-size:10px;\" width=\"40%\">NIP. $nippa</td>                    
						<td align=\"center\" style=\"font-size:10px;\" width=\"30%\">NIP. $nipbk</td>
						<td align=\"center\" style=\"font-size:10px;\" width=\"30%\">NIP. $nippdg</td>		
					</tr> 

                  </table>";
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
	        	$cRet .= "<table style=\"border-collapse:collapse; font-size:10px\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">
	                	<tr>
	                        <td width=\"50%\"  valign=\"center\" align=\"center\" valign=\"top\"></td>
	                        <td width=\"50%\"  valign=\"center\" align=\"center\" valign=\"top\">$kota, $tgl_cetak</td>
	                    </tr>
	                    <tr>
	                        <td width=\"50%\"  valign=\"center\" align=\"center\" valign=\"top\">$jabatanbud</td>
	                        <td width=\"50%\"  valign=\"center\" align=\"center\" valign=\"top\">$jabatanbid</td>
	                    </tr>
	                    <tr>
	                        <td width=\"50%\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
	                        <td width=\"50%\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
	                    </tr>
	                    <tr>
	                        <td width=\"50%\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
	                        <td width=\"50%\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
	                    </tr>
	                    <tr>
	                        <td width=\"50%\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
	                        <td width=\"50%\"  valign=\"center\" align=\"center\" valign=\"top\">&nbsp;</td>
	                    </tr>
	                    <tr>
	                        <td width=\"50%\"  valign=\"center\" align=\"center\" valign=\"top\"><u>$namabud</u></td>
	                        <td width=\"50%\"  valign=\"center\" align=\"center\" valign=\"top\"><u>$namabid</u></td>
	                    </tr>
	                    <tr>
	                        <td width=\"50%\"  valign=\"center\" align=\"center\" valign=\"top\">NIP. $nipbud</td>
	                        <td width=\"50%\"  valign=\"center\" align=\"center\" valign=\"top\">NIP. $nipbid</td>
	                    </tr>
	                </table>
	                ";
                }


		        $data['prev']= $cRet;
		        $judul  = 'Laporan Rekap Gaji Per Golongan';
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



}

/* End of file C_kib_b.php */
/* Location: ./application/controllers/laporan/C_kib_b.php */
