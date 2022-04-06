<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_formb_rekap extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('laporan/lap_formb/M_formb_rekap');
	}



	function _mpdf_a($judul='',$isi='',$lMargin='',$rMargin='',$font='',$skpd='',$orientasi) {
        ob_clean();
       	ini_set("memory_limit","-1");
        $this->load->library('M_pdf');
        //$mpdf = new m_pdf('utf-8', array(792,1071));
        //$mpdf = new m_pdf('','Letter-L');
        //$mpdf->pdf->SetDisplayMode('fullpage');
        $mpdf = new m_pdf('','Letter-L');
        $pdfFilePath = "output_pdf_name.pdf";
        //$mpdf->pdf->SetHeader('Halaman {PAGENO} of {nb}');
        //$mpdf->pdf->SetFooter('Page {PAGENO} of {nb}');
        //left right top bottom
       // $mpdf->pdf->AddPage('P','','','','',8,1,1,0);
		 //$mpdf->pdf->AddPage($orientasi);

        $mpdf->pdf->AddPage('L','','','','',10,1,1,0);
        if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
        $mpdf->pdf->WriteHTML($isi);         
        $mpdf->pdf->Output();
               
    }

	public function index()
	{	
		$data = array(
			'page'	 	=> 'REKAP FORMB',
			'judul'		=> 'REKAP FORMB',
			'deskripsi'	=> 'REKAP FORMB'
		);

		$this->template->views('laporan/lap_formb/V_formb_rekap', $data);
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
		return $this->M_formb_rekap->getConfig();
	}

	public function getBulan()
	{
		echo $this->M_formb_rekap->getBulan();
	}

	public function getTahun()
	{
		echo $this->M_formb_rekap->getTahun();
	}

	public function getSkpd()
	{
		echo $this->M_formb_rekap->getSkpd(); 
	}

	public function getUnitSkpd()
	{
		$param = $this->uri->segment(5);
		echo $this->M_formb_rekap->getUnitSkpd($param);
	}

	public function cetakLaporan()
	{
		$config = $this->getConfig();
		$nm_daerah	= strtoupper($config['nm_daerah']);
		$kota	= $config['kota'];
		$thn	= strtoupper($config['thn']);
		$periode	= $config['periode'];
		$bulan	= $this->getBulanIndo2($periode);
		$jenisCetak = $this->input->get('jenisCetak');
		$tgl_cetak = $this->tanggal_balik($this->input->get('tglcetak'));
		$skpd = $this->input->get('skpd');
		$nmskpd = $this->input->get('nmskpd');
		$unit_skpd = $this->input->get('unit_skpd');
		$nm_skpd_unit = $this->input->get('nm_skpd_unit');
		//$bulan = $this->getBulanIndo($this->input->get('bulan_tglcetak'));
		$printer = $this->input->get('printer');

		$data = array(
			'unit'	 	=> $unit_skpd,
			'skpd'	 	=> $skpd,
			'jenisCetak' => $jenisCetak,
		);
		
		$bluePrint = $this->M_formb_rekap->cetakLaporan($data);
		$nippa = $bluePrint[0]['nippa'];
		$namapa = $bluePrint[0]['namapa'];
		$jabatanpa = $bluePrint[0]['jabatanpa'];
		$nipbk = $bluePrint[1]['nipbk'];
		$namabk = $bluePrint[1]['namabk'];
		$jabatanbk = $bluePrint[1]['jabatanbk'];
		$nippdg = $bluePrint[2]['nippdg'];
		$namapdg = $bluePrint[2]['namapdg'];
		$jabatanpdg = $bluePrint[2]['jabatanpdg'];


	    if ($jenisCetak == 0){
		$where = "WHERE satkerja = '$skpd' and unit = '$unit_skpd' and ";
		$where2 = "WHERE satkerja = '$skpd' and unit = '$unit_skpd' ";
		}else{
		$where = "WHERE satkerja = '$skpd' and unit = '$unit_skpd' and ";
		$where2 = "WHERE satkerja = '$skpd' and unit = '$unit_skpd' ";
		} /*else if ($jenisCetak == 1) {
		$where = "WHERE satkerja = '$skpd'";
		$where2 = "WHERE satkerja = '$skpd' ";
		} else {
		$where = "WHERE satkerja = '$skpd'";
		$where2 = "WHERE satkerja = '$skpd' ";
		}*/
		echo $where;

		 $cRet ='';
		 $cRet .="
				<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"6\">
                	<thead>
                	    <tr>
                	    	<td align=\"center\" colspan=\"15\" style=\"font-size:12px;border-right:none;border-left:none;border-bottom:none;border-top:none\" ><br><b>PEMERINTAH KABUPATEN $nm_daerah</b></td>
                		</tr>
                		<tr>
                	    	<td align=\"center\" colspan=\"15\" style=\"font-size:10px;border-right:none;border-left:none;border-bottom:none;border-top:none\" ><b>DAFTAR PEMBAYARAN GAJI INDUK P3K</b></td>
                		</tr>
                		<tr>
		                    <td align=\"center\" colspan=\"15\" style=\"font-size:10px;border-right:none;border-left:none;border-bottom:none;border-top:none\" ><b>[ $nmskpd | $nm_skpd_unit ]</b></td>
                		</tr>
                		<tr>
		                    <td align=\"center\" colspan=\"15\" style=\"font-size:10px;border-right:none;border-left:none;border-bottom:none;border-top:none\" ><b>BULAN : ".strtoupper($bulan)." $thn</b></td>
                		</tr>
                		<tr>
		                    <td align=\"center\" colspan=\"15\" style=\"font-size:10px;border-right:none;border-left:none;border-bottom:none;border-top:none\" ></td>
                		</tr>
                		<tr>
		                    <td align=\"center\" border=\"1\" rowspan=\"2\" width=\"3%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">NO<br></br></td>
		                    <td align=\"center\" border=\"1\" rowspan=\"2\" width=\"12%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">NAMA PEGAWAI<br>TANGGAL LAHIR</br><br>N I K</br><br>STATUS PEGAWAI/GOLONGAN</br></td>
		                    <td align=\"center\" border=\"1\" rowspan=\"2\" width=\"5%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">-STATUS<br>KAWIN</br><br>-JUMLAH</br><br>ANAK/</br><br>JIWA</br></td>
		                    <td align=\"center\" border=\"1\" colspan=\"6\" width=\"38%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">P E N G H A S I L A N</td>
		                    <td align=\"center\" border=\"1\" colspan=\"4\" width=\"26%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">P O T O N G A N</td>
		                    <td align=\"left\" border=\"1\" rowspan=\"2\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH <br> PENGHASILAN <br> BERSIH <br> YANG <br> DIBAYARKAN <br></td>
							<td align=\"left\" border=\"1\" rowspan=\"2\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">- PENANDA<br>&nbsp;&nbsp;TANGAN<br><br>- NO. REK<br><br>- NPWP<br></td>
                		</tr>
                		<tr><td align=\"left\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">GAJI POKOK<br>TUNJ<br>a. SUAMI/<br>ISTRI<br>b. ANAK<br>c. JUMLAH</td>
		                    <td align=\"left\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">TUNJANGAN<br>- UMUM<br>- KHUSUS</td>
		                    <td align=\"left\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">TUNJANGAN<br>- STRUK<br>- FUNG<br>- BULAT</td>
		                    <td align=\"left\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">TUNJANGAN<br>- BERAS<br>- JKK<br>- JKM</td>
		                    <td align=\"left\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">TUNJANGAN<br>- PAJAK PENGHASILAN<br>- BPJS KES<br></td>
		                    <td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH<br>PENGHASILAN<br>KOTOR</td>
		                    <td align=\"left\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">- IWP 1%<br>- JHT<br>- BPJS KES</td>
		                    <td align=\"left\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">- PAJAK<br>PENGHASILAN<br>- JKK<br>- JKM</td>
		                    <td align=\"left\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">- SEWA<br>&nbsp;&nbsp;RMH<br>- TAPERUM<br>- HUT.LBH<br>- LAIN</td>
		                    <td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH<br>POTONGAN</td>
                		</tr>
                		<tr><td align=\"center\" border=\"1\" width=\"3%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">1</td>
		                    <td align=\"center\" border=\"1\" width=\"12%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">2</td>
		                    <td align=\"center\" border=\"1\" width=\"5%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">3</td>
		                    <td align=\"center\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">4</td>
		                    <td align=\"center\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">5</td>
		                    <td align=\"center\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">6</td>
		                    <td align=\"center\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">7</td>
		                    <td align=\"center\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">8</td>
		                    <td align=\"center\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">9</td>
		                    <td align=\"center\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">10</td>
		                    <td align=\"center\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">11</td>
		                    <td align=\"center\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">12</td>
		                    <td align=\"center\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">13</td>
		                    <td align=\"center\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">14</td>
		                    <td align=\"center\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">15</td>
                		</tr>
                	</thead>";

                	$sql="SELECT satkerja,nip,nama,lahir,golongan,
	                	case when golongan='1' then 'I' 
						when golongan='2' then 'II'
						when golongan='3' then 'III'
						when golongan='4' then 'IV'
						when golongan='5' then 'V'
						when golongan='6' then 'VI'
						when golongan='7' then 'VII'
						when golongan='8' then 'VIII'
						when golongan='9' then 'IX'
						when golongan='10' then 'X'
						when golongan='11' then 'XI'
						when golongan='12' then 'XII'
						when golongan='13' then 'XIII'
						when golongan='14' then 'XIV'
						when golongan='15' then 'XV'
						when golongan='16' then 'XVI'
						when golongan='17' then 'XVII'
						ELSE 'TIDAK ADA GOLONGAN' END AS NM_GOLONGAN,stspegawai, 
                		case  when stspegawai='1' then 'P3K' ELSE 'CPNS' end AS nm_stspegawai, case  when stskawin='1' then 'K11' when stskawin='2' then 'K10' when stskawin='3' then 'TK10' when stskawin='4' then 'D10' ELSE 'J10' END AS cstatus,
                		anak, CASE when kdbantu<>'6' then '1' else '0' end as njiwa1, CASE when stskawin='1' and (kdbantu<>'4' and kdbantu<>'6') then '1' else '0' end as njiwa2, case when kdbantu<>'4' and kdbantu<>'6' then anak else '0' end as njiwa3, 
                		gapok,tistri,tanak,(gapok+tistri+tanak) as tkeluarga,tpp,papua, tdt,tstruk,(case when left(kd_fung,1)<>'U' then tfung else 0 end) as tfung, bulat,beras,umum,
                		pph,askes,bruto,iwp,sewa,tabungan,hutang,lain,disc as jum_pot,netto,npwp,rekening,jkk,jkm,khusus,tht from pegawai $where2  order by golongan desc ,masa_tahun desc;";
					$query = $this->db->query($sql);

						$cnjiwa1   		=0;
			        	$cnjiwa2   		=0;
			        	$cnjiwa3   		=0;
			        	$ctotjiwa  		=0;
						$cgapok			=0;
						$ctistri		=0;
						$ctanak			=0;
						$ctkeluarga		=0;
						$ctpp           =0;
		                $cpapua         =0;
		                $ctdt           =0;
		                $ctstruk        =0;
		                $ctfung         =0;
		                $cbulat         =0;
		                $cberas         =0;
		                $cumum          =0;
		                $cpph           =0;
		                $caskes         =0;
		                $cbruto         =0;
		                $ciwp           =0;
		                $csewa          =0;
		                $ctabungan      =0;
		                $chutang        =0;
		                $clain       	=0;
		                $cnetto         =0;
		                $cjum_pot       =0;
		                $cjkk           =0;
		                $cjkm           =0;
		                $ckhusus        =0;
		                $ctht        	=0;
		                $xz=1;
						$i = 0;
						$xy=0;
			       		
			       		foreach ($query->result() as $row) {
				        	$i++;
				        	$nama   	   =$row->nama;
				        	$lahir   	   =$row->lahir;
				        	$nip   	   	   =$row->nip;
				        	$nm_golongan   =$row->nm_golongan;
				        	$nm_stspegawai =$row->nm_stspegawai;
				        	$cstatus   	   =$row->cstatus;
				        	$anak   	   =$row->anak;
				        	$njiwa1   	   =$row->njiwa1;
				        	$njiwa2   	   =$row->njiwa2;
				        	$njiwa3   	   =$row->njiwa3;
				        	$totjiwa  	   =$njiwa1+$njiwa2+$njiwa3;
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
			                $iwp           =$row->iwp;
			                $sewa          =$row->sewa;
			                $tabungan      =$row->tabungan;
			                $hutang        =$row->hutang;
			                $lain          =$row->lain;
			                $npwp          =$row->npwp;
			                $rekening      =$row->rekening;	
			                $jkk           =$row->jkk;
			                $jkm           =$row->jkm;
			                $khusus        =$row->khusus;
			                $tht        	=$row->tht;	
			                $bruto         =$gapok+$tistri+$tanak+$umum+$khusus+$tstruk+$tfung+$bulat+$beras+$jkk+$jkm+$askes;
							$jum_pot       =$iwp+$tht+$askes+$pph+$jkk+$jkm+$sewa+$tabungan+$hutang+$lain;
							$netto         =$bruto-$jum_pot;
							$z			   =$i%7;

							$cnjiwa1   		=$njiwa1+$cnjiwa1;
				        	$cnjiwa2   		=$njiwa2+$cnjiwa2;
				        	$cnjiwa3   		=$njiwa3+$cnjiwa3;
				        	$ctotjiwa  		=$totjiwa +$ctotjiwa;
							$cgapok			=$gapok+$cgapok;
							$ctistri		=$tistri+$ctistri;
							$ctanak			=$tanak+$ctanak;
							$ctkeluarga		=$tkeluarga+$ctkeluarga;
							$ctpp           =$tpp+$ctpp ;
			                $cpapua         =$papua+$cpapua;
			                $ctdt           =$tdt+$ctdt;
			                $ctstruk        =$tstruk+$ctstruk;
			                $ctfung         =$tfung+$ctfung ;
			                $cbulat         =$bulat+$cbulat;
			                $cberas         =$beras+$cberas;
			                $cumum          =$umum+$cumum;
			                $cpph           =$pph+$cpph ;
			                $caskes         =$askes+$caskes ;
			                $cbruto         =$bruto+$cbruto ;
			                $ciwp           =$iwp+$ciwp;
			                $csewa          =$sewa+$csewa;
			                $ctabungan      =$tabungan+$ctabungan ;
			                $chutang        =$hutang+$chutang ;
			                $clain          =$lain+$clain ;
			                $cjum_pot       =$jum_pot+$cjum_pot; 
			                $cnetto         =$netto+$cnetto ;
			                $cjkk         	=$jkk+$cjkk ;
			                $cjkm           =$jkm+$cjkm ;
			                $ckhusus        =$khusus+$ckhusus ;
			                $ctht        	=$tht+$ctht ;

			        	/*$cRet .="
			   			         <tr>
			                        <td align=\"center\" border=\"1\" width=\"3%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"><br></br>$i<br></br><br></br><br></br><br></br><br></br></td>
			                        <td align=\"left\" border=\"1\" width=\"12%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$nama<br>Tgl Lahir. $lahir</br><br>NIK. $nip</br><br>GOL. $nm_golongan       $nm_stspegawai</br></td>
			                        <td align=\"center\" border=\"1\" width=\"5%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"><br></br>$cstatus$anak<br>---------</br><br>$totjiwa</br></td>
			                        <td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($gapok,2,',','.')."<br>".number_format($tistri,2,',','.')."</br><br>".number_format($tanak,2,',','.')."</br><br>-----------------</br><br>".number_format($tkeluarga,2,',','.')."</br></td>
									<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($umum,2,',','.')."<br>".number_format($khusus,2,',','.')."</br></td>									
									<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($tstruk,2,',','.')."<br>".number_format($tfung,2,',','.')."</br><br>".number_format($bulat,2,',','.')."</br></td>
									<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($beras,2,',','.')."<br>".number_format($jkk,2,',','.')."</br><br>".number_format($jkm,2,',','.')."</br></td>
									<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($askes,2,',','.')."</br></td>
									<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($bruto,2,',','.')."</td>
									<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($iwp,2,',','.')."<br>".number_format($tht,2,',','.')."</br><br>".number_format($askes,2,',','.')."</br></td>
									<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($pph,2,',','.')."<br>".number_format($jkk,2,',','.')."</br><br>".number_format($jkm,2,',','.')."</br></td>
									<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($sewa,2,',','.')."<br>".number_format($tabungan,2,',','.')."</br><br>".number_format($hutang,2,',','.')."</br><br>".number_format($lain,2,',','.')."</br></td>
									<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pot,2,',','.')."</td>
									<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($netto,2,',','.')."</td>
									<td align=\"left\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$i  . . . . . . . . . .<br><br>$rekening<br><br>$npwp</br></td>			                        
			                    </tr>";*/
			             
			             	if ($z==0) {			             		
			             		
								$cRet .="
								 <tr>
			                        <td align=\"center\" border=\"1\" width=\"3%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"><br></br><br></br><br></br><br></br><br></br><br></br></td>
			                        <td align=\"left\" border=\"1\" width=\"12%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH LEMBAR KE $xz</td>
			                        <td align=\"center\" border=\"1\" width=\"5%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$cnjiwa1<br>$cnjiwa2</br><br>$cnjiwa3</br><br>--------</br><br>$ctotjiwa</br></td>
									<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cgapok,2,',','.')."<br>".number_format($ctistri,2,',','.')."</br><br>".number_format($ctanak,2,',','.')."</br><br>-----------------</br><br>".number_format($ctkeluarga,2,',','.')."</br></td>
									<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cumum,2,',','.')."<br>".number_format($ckhusus,2,',','.')."</br></td>									
									<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($ctstruk,2,',','.')."<br>".number_format($ctfung,2,',','.')."</br><br>".number_format($cbulat,2,',','.')."</br></td>
									<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cberas,2,',','.')."<br>".number_format($cjkk,2,',','.')."</br><br>".number_format($cjkm,2,',','.')."</br></td>
									<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cpph,2,',','.')."<br>".number_format($caskes,2,',','.')."</br></td>
									<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cbruto,2,',','.')."</td>
									<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($ciwp,2,',','.')."<br>".number_format($ctht,2,',','.')."</br><br>".number_format($caskes,2,',','.')."</br></td>
									<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cpph,2,',','.')."<br>".number_format($cjkk,2,',','.')."</br><br>".number_format($cjkm,2,',','.')."</br></td>
									<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($csewa,2,',','.')."<br>".number_format($ctabungan,2,',','.')."</br><br>".number_format($chutang,2,',','.')."</br><br>".number_format($clain,2,',','.')."</br></td>
									<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cjum_pot,2,',','.')."</td>
									<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cnetto,2,',','.')."</td>
									<td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"></td>
			                    	</tr>";

			                    	$xz=$xz+1;
			 					
									$cnjiwa1   		=0;
			        				$cnjiwa2   		=0;
			        				$cnjiwa3   		=0;
			        				$ctotjiwa  		=0;
			                    	$cgapok			=0;
			                    	$ctistri		=0;
			                    	$ctanak			=0;
			                    	$ctkeluarga		=0;
			                    	$ctpp           =0;
					                $cpapua         =0;
					                $ctdt           =0;
					                $ctstruk        =0;
					                $ctfung         =0;
					                $cbulat         =0;
					                $cberas         =0;
					                $cumum          =0;
					                $cpph           =0;
					                $caskes         =0;
					                $cbruto         =0;
					                $ciwp           =0;
					                $csewa          =0;
					                $ctabungan      =0;
					                $chutang        =0;
					                $clain       	=0;
					                $cnetto         =0;
					                $cjkk           =0;
					                $cjkm           =0;
					                $ckhusus        =0;
					                $ctht	        =0;
			                }
						
						}

					$sql2="select 'JUMLAH TOTAL' AS jumlah,
							(select count(*) from pegawai $where kdbantu<>'6') AS jum_peg,
							(select count(*) from pegawai $where stskawin=1 and (kdbantu<>'6' and kdbantu<>'4')) AS jum_istri,
							(select sum(anak) from pegawai $where (kdbantu<>'6' and kdbantu<>'4')) as jum_anak,
							(select count(*) from pegawai $where (kdbantu<>'6' and kdguru<>'4' and kdguru<>'5')) as jum_nonguru,
							(select count(*) from pegawai $where (kdbantu<>'6' and kdguru='4')) as jum_guru,
							(select count(*) from pegawai $where (kdbantu<>'6' and kdguru='5')) as jum_kes,
							sum(gapok) as gapok,sum(tistri) as tistri,sum(tanak) as tanak,
							sum(gapok+tistri+tanak) as tkeluarga,sum(tpp) as tpp,sum(papua) as papua,sum(tdt) as tdt,sum(tstruk) as tstruk,
							sum(case when left(kd_fung,1)<>'U' then tfung else 0 end) as tfung,sum(bulat) as bulat,sum(beras) as beras,
							sum(umum) umum,sum(pph) as pph,sum(askes) as askes,
							sum(bruto) as bruto,sum(iwp) as iwp,sum(sewa) as sewa,
							sum(tabungan) as tabungan,sum(hutang) as hutang,sum(lain) as lain,sum(disc) as jum_pot,
							sum(netto) as netto,sum(jkk) as jkk,sum(jkm) as jkm,sum(khusus) as khusus,sum(tht) as tht from pegawai $where2;";
							$query3 = $this->db->query($sql2); 

					foreach ($query3->result() as $row) {
							$xy++;
							$kesel=$row->jumlah;
							$jum_peg=$row->jum_peg;
							$jum_istri=$row->jum_istri;
							$jum_anak=$row->jum_anak;
							$jum_keluarga=$jum_peg+$jum_istri+$jum_anak;
							$jum_gapok=$row->gapok;
							$jum_tistri=$row->tistri;
							$jum_tanak=$row->tanak;
							$jum_tkeluarga=$row->tkeluarga;
							$jum_tpp=$row->tpp;
							$jum_papua=$row->papua;
							$jum_tdt=$row->tdt;
							$jum_tstruk=$row->tstruk;
							$jum_tfung=$row->tfung;
							$jum_bulat=$row->bulat;
							$jum_beras=$row->beras;
							$jum_umum=$row->umum;
							$jum_pph=$row->pph;
							$jum_askes=$row->askes;
							//$jum_bruto=$row->bruto;
							$jum_iwp=$row->iwp;
							$jum_sewa=$row->sewa;
							$jum_tabungan=$row->tabungan;
							$jum_hutang=$row->hutang;
							$jum_lain=$row->lain;
							//$jum_jum_pot=$row->jum_pot;
							//$jum_netto=$row->netto;
							$jum_jkk=$row->jkk;
							$jum_jkm=$row->jkm;
							$jum_khusus=$row->khusus;
							$jum_tht=$row->tht;
							$jum_bruto         =$jum_gapok+$jum_tistri+$jum_tanak+$jum_umum+$jum_khusus+$jum_tstruk+$jum_tfung+$jum_bulat+$jum_beras+$jum_jkk+$jum_jkm+$jum_askes;
							$jum_jum_pot       =$jum_iwp+$jum_tht+$jum_askes+$jum_pph+$jum_jkk+$jum_jkm+$jum_sewa+$jum_tabungan+$jum_hutang+$jum_lain;
							$jum_netto         =$jum_bruto-$jum_jum_pot;


 					$sql1="select count(*) as jum from pegawai $where2 ;";
						$query2 = $this->db->query($sql1); 

						foreach ($query2->result() as $row) {
							$cjumrecord =$row->jum;
							$csisa = $cjumrecord % 7;
			              
			            	if ($csisa==0) {
			            	 
								$cRet .="
									<tr>
				                       	<td align=\"center\" border=\"1\" width=\"3%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"><br></br><br></br><br></br><br></br><br></br><br></br></td>
				                       	<td align=\"center\" border=\"1\" width=\"12%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH TOTAL</td>
				                        <td align=\"center\" border=\"1\" width=\"5%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$jum_peg<br></br>$jum_istri<br>$jum_anak</br><br>------</br><br>$jum_keluarga</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_gapok,2,',','.')."<br>".number_format($jum_tistri,2,',','.')."</br><br>".number_format($jum_tanak,2,',','.')."</br><br>-----------------</br><br>".number_format($jum_tkeluarga,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_umum,2,',','.')."<br>".number_format($jum_khusus,2,',','.')."</br></td>									
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_tstruk,2,',','.')."<br>".number_format($jum_tfung,2,',','.')."</br><br>".number_format($jum_bulat,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_beras,2,',','.')."<br>".number_format($jum_jkk,2,',','.')."</br><br>".number_format($jum_jkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pph,2,',','.')."<br>".number_format($jum_askes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_bruto,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_iwp,2,',','.')."<br>".number_format($jum_tht,2,',','.')."</br><br>".number_format($jum_askes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pph,2,',','.')."<br>".number_format($jum_jkk,2,',','.')."</br><br>".number_format($jum_jkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_sewa,2,',','.')."<br>".number_format($jum_tabungan,2,',','.')."</br><br>".number_format($jum_hutang,2,',','.')."</br><br>".number_format($jum_lain,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_jum_pot,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_netto,2,',','.')."</td>
										<td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"></td>				                        
				                    </tr>";


			            	}else if ($csisa!=0) {
			            	 	
			            	 	if ($csisa<=1) {
			            	 	$cRet .="
			            	 		<tr>
				                       	<td align=\"center\" border=\"1\" width=\"3%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"><br></br><br></br><br></br><br></br><br></br><br></br></td>
				                        <td align=\"left\" border=\"1\" width=\"12%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH LEMBAR KE $xz</td>
				                        <td align=\"center\" border=\"1\" width=\"5%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$cnjiwa1<br>$cnjiwa2</br><br>$cnjiwa3</br><br>--------</br><br>$ctotjiwa</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cgapok,2,',','.')."<br>".number_format($ctistri,2,',','.')."</br><br>".number_format($ctanak,2,',','.')."</br><br>-----------------</br><br>".number_format($ctkeluarga,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cumum,2,',','.')."<br>".number_format($ckhusus,2,',','.')."</br></td>									
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($ctstruk,2,',','.')."<br>".number_format($ctfung,2,',','.')."</br><br>".number_format($cbulat,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cberas,2,',','.')."<br>".number_format($cjkk,2,',','.')."</br><br>".number_format($cjkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pph,2,',','.')."<br>".number_format($caskes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cbruto,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($ciwp,2,',','.')."<br>".number_format($ctht,2,',','.')."</br><br>".number_format($caskes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cpph,2,',','.')."<br>".number_format($cjkk,2,',','.')."</br><br>".number_format($cjkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($csewa,2,',','.')."<br>".number_format($ctabungan,2,',','.')."</br><br>".number_format($chutang,2,',','.')."</br><br>".number_format($clain,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cjum_pot,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cnetto,2,',','.')."</td>
										<td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"></td>
				                    	
			               			</tr>
									<tr>
				                       	<td align=\"center\" border=\"1\" width=\"3%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"><br></br><br></br><br></br><br></br><br></br><br></br></td>
				                       	<td align=\"center\" border=\"1\" width=\"12%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH TOTAL</td>
				                        <td align=\"center\" border=\"1\" width=\"5%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$jum_peg<br></br>$jum_istri<br>$jum_anak</br><br>------</br><br>$jum_keluarga</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_gapok,2,',','.')."<br>".number_format($jum_tistri,2,',','.')."</br><br>".number_format($jum_tanak,2,',','.')."</br><br>-----------------</br><br>".number_format($jum_tkeluarga,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_umum,2,',','.')."<br>".number_format($jum_khusus,2,',','.')."</br></td>									
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_tstruk,2,',','.')."<br>".number_format($jum_tfung,2,',','.')."</br><br>".number_format($jum_bulat,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_beras,2,',','.')."<br>".number_format($jum_jkk,2,',','.')."</br><br>".number_format($jum_jkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pph,2,',','.')."<br>".number_format($jum_askes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_bruto,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_iwp,2,',','.')."<br>".number_format($jum_tht,2,',','.')."</br><br>".number_format($jum_askes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pph,2,',','.')."<br>".number_format($jum_jkk,2,',','.')."</br><br>".number_format($jum_jkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_sewa,2,',','.')."<br>".number_format($jum_tabungan,2,',','.')."</br><br>".number_format($jum_hutang,2,',','.')."</br><br>".number_format($jum_lain,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_jum_pot,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_netto,2,',','.')."</td>
										<td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"></td>
			               			</tr>";

			            	 	}else if($csisa<=2){
								$cRet .="
									
			            	 		<tr>
				                       <td align=\"center\" border=\"1\" width=\"3%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"><br></br><br></br><br></br><br></br><br></br><br></br></td>
				                        <td align=\"left\" border=\"1\" width=\"12%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH LEMBAR KE $xz</td>
				                        <td align=\"center\" border=\"1\" width=\"5%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$cnjiwa1<br>$cnjiwa2</br><br>$cnjiwa3</br><br>--------</br><br>$ctotjiwa</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cgapok,2,',','.')."<br>".number_format($ctistri,2,',','.')."</br><br>".number_format($ctanak,2,',','.')."</br><br>-----------------</br><br>".number_format($ctkeluarga,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cumum,2,',','.')."<br>".number_format($ckhusus,2,',','.')."</br></td>									
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($ctstruk,2,',','.')."<br>".number_format($ctfung,2,',','.')."</br><br>".number_format($cbulat,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cberas,2,',','.')."<br>".number_format($cjkk,2,',','.')."</br><br>".number_format($cjkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pph,2,',','.')."<br>".number_format($caskes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cbruto,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($ciwp,2,',','.')."<br>".number_format($ctht,2,',','.')."</br><br>".number_format($caskes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cpph,2,',','.')."<br>".number_format($cjkk,2,',','.')."</br><br>".number_format($cjkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($csewa,2,',','.')."<br>".number_format($ctabungan,2,',','.')."</br><br>".number_format($chutang,2,',','.')."</br><br>".number_format($clain,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cjum_pot,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cnetto,2,',','.')."</td>
										<td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"></td>
			               			</tr>
									<tr>
				                       <td align=\"center\" border=\"1\" width=\"3%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"><br></br><br></br><br></br><br></br><br></br><br></br></td>
										<td align=\"center\" border=\"1\" width=\"12%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH TOTAL</td>
										<td align=\"center\" border=\"1\" width=\"5%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$jum_peg<br></br>$jum_istri<br>$jum_anak</br><br>------</br><br>$jum_keluarga</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_gapok,2,',','.')."<br>".number_format($jum_tistri,2,',','.')."</br><br>".number_format($jum_tanak,2,',','.')."</br><br>-----------------</br><br>".number_format($jum_tkeluarga,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_umum,2,',','.')."<br>".number_format($jum_khusus,2,',','.')."</br></td>									
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_tstruk,2,',','.')."<br>".number_format($jum_tfung,2,',','.')."</br><br>".number_format($jum_bulat,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_beras,2,',','.')."<br>".number_format($jum_jkk,2,',','.')."</br><br>".number_format($jum_jkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pph,2,',','.')."<br>".number_format($jum_askes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_bruto,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_iwp,2,',','.')."<br>".number_format($jum_tht,2,',','.')."</br><br>".number_format($jum_askes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pph,2,',','.')."<br>".number_format($jum_jkk,2,',','.')."</br><br>".number_format($jum_jkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_sewa,2,',','.')."<br>".number_format($jum_tabungan,2,',','.')."</br><br>".number_format($jum_hutang,2,',','.')."</br><br>".number_format($jum_lain,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_jum_pot,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_netto,2,',','.')."</td>
										<td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"></td>

			               			</tr>";
			               	
			            	 	}else if($csisa<=3){
								$cRet .="									
			            	 		<tr>
				                       	<td align=\"center\" border=\"1\" width=\"3%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"><br></br><br></br><br></br><br></br><br></br><br></br></td>
				                        <td align=\"left\" border=\"1\" width=\"12%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH LEMBAR KE $xz</td>
				                        <td align=\"center\" border=\"1\" width=\"5%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$cnjiwa1<br>$cnjiwa2</br><br>$cnjiwa3</br><br>--------</br><br>$ctotjiwa</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cgapok,2,',','.')."<br>".number_format($ctistri,2,',','.')."</br><br>".number_format($ctanak,2,',','.')."</br><br>-----------------</br><br>".number_format($ctkeluarga,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cumum,2,',','.')."<br>".number_format($ckhusus,2,',','.')."</br></td>									
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($ctstruk,2,',','.')."<br>".number_format($ctfung,2,',','.')."</br><br>".number_format($cbulat,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cberas,2,',','.')."<br>".number_format($cjkk,2,',','.')."</br><br>".number_format($cjkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pph,2,',','.')."<br>".number_format($caskes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cbruto,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($ciwp,2,',','.')."<br>".number_format($ctht,2,',','.')."</br><br>".number_format($caskes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cpph,2,',','.')."<br>".number_format($cjkk,2,',','.')."</br><br>".number_format($cjkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($csewa,2,',','.')."<br>".number_format($ctabungan,2,',','.')."</br><br>".number_format($chutang,2,',','.')."</br><br>".number_format($clain,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cjum_pot,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cnetto,2,',','.')."</td>
										<td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"></td>
			               			</tr>
									<tr>
				                       	<td align=\"center\" border=\"1\" width=\"3%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"><br></br><br></br><br></br><br></br><br></br><br></br></td>
										<td align=\"center\" border=\"1\" width=\"12%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH TOTAL</td>
										<td align=\"center\" border=\"1\" width=\"5%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$jum_peg<br></br>$jum_istri<br>$jum_anak</br><br>------</br><br>$jum_keluarga</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_gapok,2,',','.')."<br>".number_format($jum_tistri,2,',','.')."</br><br>".number_format($jum_tanak,2,',','.')."</br><br>-----------------</br><br>".number_format($jum_tkeluarga,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_umum,2,',','.')."<br>".number_format($jum_khusus,2,',','.')."</br></td>									
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_tstruk,2,',','.')."<br>".number_format($jum_tfung,2,',','.')."</br><br>".number_format($jum_bulat,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_beras,2,',','.')."<br>".number_format($jum_jkk,2,',','.')."</br><br>".number_format($jum_jkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pph,2,',','.')."<br>".number_format($jum_askes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_bruto,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_iwp,2,',','.')."<br>".number_format($jum_tht,2,',','.')."</br><br>".number_format($jum_askes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pph,2,',','.')."<br>".number_format($jum_jkk,2,',','.')."</br><br>".number_format($jum_jkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_sewa,2,',','.')."<br>".number_format($jum_tabungan,2,',','.')."</br><br>".number_format($jum_hutang,2,',','.')."</br><br>".number_format($jum_lain,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_jum_pot,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_netto,2,',','.')."</td>
										<td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"></td>

			               			</tr>";

			            	 	}else if($csisa<=4){
								$cRet .="									
			            	 		<tr>
				                       	<td align=\"center\" border=\"1\" width=\"3%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"><br></br><br></br><br></br><br></br><br></br><br></br></td>
				                        <td align=\"left\" border=\"1\" width=\"12%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH LEMBAR KE $xz</td>
				                        <td align=\"center\" border=\"1\" width=\"5%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$cnjiwa1<br>$cnjiwa2</br><br>$cnjiwa3</br><br>--------</br><br>$ctotjiwa</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cgapok,2,',','.')."<br>".number_format($ctistri,2,',','.')."</br><br>".number_format($ctanak,2,',','.')."</br><br>-----------------</br><br>".number_format($ctkeluarga,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cumum,2,',','.')."<br>".number_format($ckhusus,2,',','.')."</br></td>									
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($ctstruk,2,',','.')."<br>".number_format($ctfung,2,',','.')."</br><br>".number_format($cbulat,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cberas,2,',','.')."<br>".number_format($cjkk,2,',','.')."</br><br>".number_format($cjkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pph,2,',','.')."<br>".number_format($caskes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cbruto,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($ciwp,2,',','.')."<br>".number_format($ctht,2,',','.')."</br><br>".number_format($caskes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cpph,2,',','.')."<br>".number_format($cjkk,2,',','.')."</br><br>".number_format($cjkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($csewa,2,',','.')."<br>".number_format($ctabungan,2,',','.')."</br><br>".number_format($chutang,2,',','.')."</br><br>".number_format($clain,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cjum_pot,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cnetto,2,',','.')."</td>
										<td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"></td>
			               			</tr>
									<tr>
				                       	<td align=\"center\" border=\"1\" width=\"3%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"><br></br><br></br><br></br><br></br><br></br><br></br></td>
										<td align=\"center\" border=\"1\" width=\"12%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH TOTAL</td>
										<td align=\"center\" border=\"1\" width=\"5%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$jum_peg<br></br>$jum_istri<br>$jum_anak</br><br>------</br><br>$jum_keluarga</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_gapok,2,',','.')."<br>".number_format($jum_tistri,2,',','.')."</br><br>".number_format($jum_tanak,2,',','.')."</br><br>-----------------</br><br>".number_format($jum_tkeluarga,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_umum,2,',','.')."<br>".number_format($jum_khusus,2,',','.')."</br></td>									
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_tstruk,2,',','.')."<br>".number_format($jum_tfung,2,',','.')."</br><br>".number_format($jum_bulat,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_beras,2,',','.')."<br>".number_format($jum_jkk,2,',','.')."</br><br>".number_format($jum_jkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pph,2,',','.')."<br>".number_format($jum_askes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_bruto,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_iwp,2,',','.')."<br>".number_format($jum_tht,2,',','.')."</br><br>".number_format($jum_askes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pph,2,',','.')."<br>".number_format($jum_jkk,2,',','.')."</br><br>".number_format($jum_jkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_sewa,2,',','.')."<br>".number_format($jum_tabungan,2,',','.')."</br><br>".number_format($jum_hutang,2,',','.')."</br><br>".number_format($jum_lain,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_jum_pot,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_netto,2,',','.')."</td>
										<td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"></td>

			               			</tr>";

			            	 	}else if($csisa<=5){
								$cRet .="
			            	 		<tr>
				                       	<td align=\"center\" border=\"1\" width=\"3%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"><br></br><br></br><br></br><br></br><br></br><br></br></td>
				                        <td align=\"left\" border=\"1\" width=\"12%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH LEMBAR KE $xz</td>
				                        <td align=\"center\" border=\"1\" width=\"5%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$cnjiwa1<br>$cnjiwa2</br><br>$cnjiwa3</br><br>--------</br><br>$ctotjiwa</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cgapok,2,',','.')."<br>".number_format($ctistri,2,',','.')."</br><br>".number_format($ctanak,2,',','.')."</br><br>-----------------</br><br>".number_format($ctkeluarga,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cumum,2,',','.')."<br>".number_format($ckhusus,2,',','.')."</br></td>									
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($ctstruk,2,',','.')."<br>".number_format($ctfung,2,',','.')."</br><br>".number_format($cbulat,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cberas,2,',','.')."<br>".number_format($cjkk,2,',','.')."</br><br>".number_format($cjkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pph,2,',','.')."<br>".number_format($caskes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cbruto,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($ciwp,2,',','.')."<br>".number_format($ctht,2,',','.')."</br><br>".number_format($caskes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cpph,2,',','.')."<br>".number_format($cjkk,2,',','.')."</br><br>".number_format($cjkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($csewa,2,',','.')."<br>".number_format($ctabungan,2,',','.')."</br><br>".number_format($chutang,2,',','.')."</br><br>".number_format($clain,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cjum_pot,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cnetto,2,',','.')."</td>
										<td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"></td>
			               			</tr>
									<tr>
				                       	<td align=\"center\" border=\"1\" width=\"3%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"><br></br><br></br><br></br><br></br><br></br><br></br></td>
										<td align=\"center\" border=\"1\" width=\"12%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH TOTAL</td>
										<td align=\"center\" border=\"1\" width=\"5%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$jum_peg<br></br>$jum_istri<br>$jum_anak</br><br>------</br><br>$jum_keluarga</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_gapok,2,',','.')."<br>".number_format($jum_tistri,2,',','.')."</br><br>".number_format($jum_tanak,2,',','.')."</br><br>-----------------</br><br>".number_format($jum_tkeluarga,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_umum,2,',','.')."<br>".number_format($jum_khusus,2,',','.')."</br></td>									
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_tstruk,2,',','.')."<br>".number_format($jum_tfung,2,',','.')."</br><br>".number_format($jum_bulat,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_beras,2,',','.')."<br>".number_format($jum_jkk,2,',','.')."</br><br>".number_format($jum_jkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pph,2,',','.')."<br>".number_format($jum_askes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_bruto,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_iwp,2,',','.')."<br>".number_format($jum_tht,2,',','.')."</br><br>".number_format($jum_askes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pph,2,',','.')."<br>".number_format($jum_jkk,2,',','.')."</br><br>".number_format($jum_jkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_sewa,2,',','.')."<br>".number_format($jum_tabungan,2,',','.')."</br><br>".number_format($jum_hutang,2,',','.')."</br><br>".number_format($jum_lain,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_jum_pot,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_netto,2,',','.')."</td>
										<td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"></td>

			               			</tr>";

			            	 	}else if($csisa<=6){
								$cRet .="								
			            	 		<tr>
				                       	<td align=\"center\" border=\"1\" width=\"3%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"><br></br><br></br><br></br><br></br><br></br><br></br></td>
				                        <td align=\"left\" border=\"1\" width=\"12%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH LEMBAR KE $xz</td>
				                        <td align=\"center\" border=\"1\" width=\"5%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$cnjiwa1<br>$cnjiwa2</br><br>$cnjiwa3</br><br>--------</br><br>$ctotjiwa</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cgapok,2,',','.')."<br>".number_format($ctistri,2,',','.')."</br><br>".number_format($ctanak,2,',','.')."</br><br>-----------------</br><br>".number_format($ctkeluarga,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cumum,2,',','.')."<br>".number_format($ckhusus,2,',','.')."</br></td>									
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($ctstruk,2,',','.')."<br>".number_format($ctfung,2,',','.')."</br><br>".number_format($cbulat,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cberas,2,',','.')."<br>".number_format($cjkk,2,',','.')."</br><br>".number_format($cjkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pph,2,',','.')."<br>".number_format($caskes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cbruto,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($ciwp,2,',','.')."<br>".number_format($ctht,2,',','.')."</br><br>".number_format($caskes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cpph,2,',','.')."<br>".number_format($cjkk,2,',','.')."</br><br>".number_format($cjkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($csewa,2,',','.')."<br>".number_format($ctabungan,2,',','.')."</br><br>".number_format($chutang,2,',','.')."</br><br>".number_format($clain,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cjum_pot,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($cnetto,2,',','.')."</td>
										<td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"></td>
			               			</tr>
									<tr>
				                       	<td align=\"center\" border=\"1\" width=\"3%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"><br></br><br></br><br></br><br></br><br></br><br></br></td>
										<td align=\"center\" border=\"1\" width=\"12%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH TOTAL</td>
										<td align=\"center\" border=\"1\" width=\"5%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$jum_peg<br></br>$jum_istri<br>$jum_anak</br><br>------</br><br>$jum_keluarga</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_gapok,2,',','.')."<br>".number_format($jum_tistri,2,',','.')."</br><br>".number_format($jum_tanak,2,',','.')."</br><br>-----------------</br><br>".number_format($jum_tkeluarga,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_umum,2,',','.')."<br>".number_format($jum_khusus,2,',','.')."</br></td>									
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_tstruk,2,',','.')."<br>".number_format($jum_tfung,2,',','.')."</br><br>".number_format($jum_bulat,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_beras,2,',','.')."<br>".number_format($jum_jkk,2,',','.')."</br><br>".number_format($jum_jkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pph,2,',','.')."<br>".number_format($jum_askes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_bruto,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_iwp,2,',','.')."<br>".number_format($jum_tht,2,',','.')."</br><br>".number_format($jum_askes,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_pph,2,',','.')."<br>".number_format($jum_jkk,2,',','.')."</br><br>".number_format($jum_jkm,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_sewa,2,',','.')."<br>".number_format($jum_tabungan,2,',','.')."</br><br>".number_format($jum_hutang,2,',','.')."</br><br>".number_format($jum_lain,2,',','.')."</br></td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_jum_pot,2,',','.')."</td>
										<td align=\"right\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">".number_format($jum_netto,2,',','.')."</td>
										<td align=\"left\" border=\"1\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"></td>

			               			</tr>";

			            	 	}		
						   	}
						}
			        }						
					
        		$cRet .="</table>";

        		$cRet .="
        		<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
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
						<td align=\"center\" style=\"font-size:10px;\" width=\"40%\">&nbsp;</td>                    
						<td align=\"center\" style=\"font-size:10px;\" width=\"30%\">&nbsp;</td>
						<td align=\"center\" style=\"font-size:10px;\" width=\"30%\">&nbsp;</td>	
					</tr>
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
						<td align=\"center\" style=\"font-size:10px;\" width=\"40%\">&nbsp;</td>                    
						<td align=\"center\" style=\"font-size:10px;\" width=\"30%\">&nbsp;</td>
						<td align=\"center\" style=\"font-size:10px;\" width=\"30%\">&nbsp;</td>		
					</tr> 
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

		        $data['prev']= $cRet;
		        $judul  = 'Laporan Rekap FormB';
		        switch ($jenisCetak) {
		        	case 0:
		        		$this->_mpdf_a('',$cRet,'','','',8,0,0,0);
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
