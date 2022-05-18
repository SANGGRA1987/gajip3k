<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_kartugaji extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('laporan/lap_kartugaji/M_kartugaji');
	}

	function _mpdf($judul='',$isi='',$lMargin=10,$rMargin=10,$font=10,$orientasi) {
        ob_clean();
       	ini_set("memory_limit","-1");
        $this->load->library('M_pdf');
        $mpdf = new m_pdf('', 'Letter-L');
        $pdfFilePath = "output_pdf_name.pdf";
        $mpdf->pdf->SetFooter('Printed Simgaji on @ {DATE j-m-Y H:i:s} || Hal {PAGENO} of {nb}');
        $mpdf->pdf->AddPage($orientasi);
        if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
        $mpdf->pdf->WriteHTML($isi);         
        $mpdf->pdf->Output();

    }

    function _mpdf_a($judul='',$isi='',$lMargin='',$rMargin='',$font='',$skpd='',$orientasi) {
        ob_clean();
       	ini_set("memory_limit","-1");
       	$this->load->library('M_pdf');
        $mpdf = new m_pdf('','Letter-L');
        $pdfFilePath = "output_pdf_name.pdf";
        $mpdf->pdf->AddPage('L','','','','',10,1,1,0);
        if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
        $mpdf->pdf->WriteHTML($isi);         
        $mpdf->pdf->Output();
               
    }

	public function index()
	{	
		$data = array(
			'page'	 	=> 'Kartu Gaji',
			'judul'		=> 'Kartu Gaji',
			'deskripsi'	=> 'Kartu Gaji'
		);

		$this->template->views('laporan/lap_kartugaji/V_kartugaji', $data);
	}
	
	public function  tanggal_balik($tgl){
		/*$tanggal  =  substr($tgl,0,2);
		$bulan  = substr($tgl,3,2);
		$tahun  =  substr($tgl,6,4);
		return  $tahun.'-'.$bulan.'-'.$tanggal;*/
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
		return $this->M_kartugaji->getConfig();
	}

	public function getBulan()
	{
		echo $this->M_kartugaji->getBulan();
	}

	public function getTahun()
	{
		echo $this->M_kartugaji->getTahun();
	}

	public function getSkpd()
	{
		echo $this->M_kartugaji->getSkpd(); 
	}

	public function getPangkat()
	{
		echo $this->M_kartugaji->getPangkat(); 
	}

	public function getpenghasilan()
	{
		echo $this->M_kartugaji->getpenghasilan(); 
	}

	public function getUnitSkpd()
	{
		$param = $this->uri->segment(5);
		echo $this->M_kartugaji->getUnitSkpd($param);
	}

	public function cetakLaporan()
	{
		$config = $this->getConfig();
		$nm_daerah	= strtoupper($config['nm_daerah']);
		$kota	= $config['kota'];
		//$thang	= strtoupper($config['thang']);
		$nip = $this->input->get('nip');
		$nip_lama = $this->input->get('nip_lama');
		$nama = $this->input->get('nama');
		$skpd = $this->input->get('satkerja');
		$nm_satkerja = $this->input->get('nm_satkerja');
		$unit_skpd = $this->input->get('unit');
		$nm_unit = $this->input->get('nm_unit');
		$bulan = $this->input->get('bulan');
		$bulan_2 = $this->input->get('bulan_2');
		$tahun = $this->input->get('tahun');
		$tahun_2 = $this->input->get('tahun_2');
		$jenisCetak = $this->input->get('jenisCetak');
		$tgl_cetak = $this->tanggal_balik($this->input->get('tgl_cetak'));
		//$bulan = $this->getBulanIndo($this->input->get('bulan_tglcetak'));
		
		$data = array(
			'unit'	 	=> $unit_skpd,
			'skpd'	 	=> $skpd,
			'jenisCetak' => $jenisCetak,
		);


		$bluePrint = $this->M_kartugaji->cetakLaporan($data);
		$nippa = $bluePrint[0]['nippa'];
		$namapa = $bluePrint[0]['namapa'];
		$jabatanpa = $bluePrint[0]['jabatanpa'];
		$nipbk = $bluePrint[1]['nipbk'];
		$namabk = $bluePrint[1]['namabk'];
		$jabatanbk = $bluePrint[1]['jabatanbk'];
		$nippdg = $bluePrint[2]['nippdg'];
		$namapdg = $bluePrint[2]['namapdg'];
		$jabatanpdg = $bluePrint[2]['jabatanpdg'];

		$where2 = "WHERE satkerja = '$skpd' and unit = '$unit_skpd' and nip = '$nip'";
		
		 $cRet ='';
		 $cRet .="
				<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"6\">
                	<thead>
                	    <tr>
                	    	<td align=\"center\" colspan=\"15\" style=\"font-size:12px;border-right:none;border-left:none;border-bottom:none;border-top:none\" ><br>PEMERINTAH KABUPATEN $nm_daerah</td>
                		</tr>
                		<tr>
                	    	<td align=\"left\" colspan=\"2\" style=\"font-size:10px;border-right:none;border-left:none;border-bottom:none;border-top:none\" >NIP</td>
                	    	<td align=\"center\" colspan=\"1\" style=\"font-size:10px;border-right:none;border-left:none;border-bottom:none;border-top:none\" >:</td>
                	    	<td align=\"left\" colspan=\"12\" style=\"font-size:10px;border-right:none;border-left:none;border-bottom:none;border-top:none\" >$nip</td>
                		</tr>
                		<tr>
                	    	<td align=\"left\" colspan=\"2\" style=\"font-size:10px;border-right:none;border-left:none;border-bottom:none;border-top:none\" >NAMA</td>
                	    	<td align=\"center\" colspan=\"1\" style=\"font-size:10px;border-right:none;border-left:none;border-bottom:none;border-top:none\" >:</td>
                	    	<td align=\"left\" colspan=\"12\" style=\"font-size:10px;border-right:none;border-left:none;border-bottom:none;border-top:none\" >$nama</td>
                		</tr>
                		<tr>
		                    <td align=\"left\" colspan=\"2\" style=\"font-size:10px;border-right:none;border-left:none;border-bottom:none;border-top:none\" >SATUAN KERJA</td>
                	    	<td align=\"center\" colspan=\"1\" style=\"font-size:10px;border-right:none;border-left:none;border-bottom:none;border-top:none\" >:</td>
                	    	<td align=\"left\" colspan=\"12\" style=\"font-size:10px;border-right:none;border-left:none;border-bottom:none;border-top:none\" >$nm_satkerja</td>
                		</tr>
                		<tr>
		                    <td align=\"left\" colspan=\"2\" style=\"font-size:10px;border-right:none;border-left:none;border-bottom:none;border-top:none\" >UNIT KERJA</td>
                	    	<td align=\"center\" colspan=\"1\" style=\"font-size:10px;border-right:none;border-left:none;border-bottom:none;border-top:none\" >:</td>
                	    	<td align=\"left\" colspan=\"12\" style=\"font-size:10px;border-right:none;border-left:none;border-bottom:none;border-top:none\" >$nm_unit</td>
                		</tr>
                		<tr>
		                    <td align=\"right\" colspan=\"15\" style=\"font-size:10px;border-right:none;border-left:none;border-bottom:none;border-top:none\" >KARTU GAJI</td>
                		</tr>
                		<tr>
		                    <td align=\"center\" border=\"1\" rowspan=\"2\" width=\"3%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">NO<br></br></td>
		                    <td align=\"center\" border=\"1\" rowspan=\"2\" width=\"12%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">BULAN</td>
		                    <td align=\"center\" border=\"1\" rowspan=\"2\" width=\"5%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">-STATUS<br>KAWIN</br><br>-JUMLAH</br><br>ANAK/</br><br>JIWA</br></td>
		                    <td align=\"center\" border=\"1\" colspan=\"6\" width=\"38%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">P E N G H A S I L A N</td>
		                    <td align=\"center\" border=\"1\" colspan=\"4\" width=\"26%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">P O T O N G A N</td>
		                    <td align=\"left\" border=\"1\" rowspan=\"2\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">JUMLAH <br> PENGHASILAN <br> BERSIH <br> YANG <br> DIBAYARKAN <br></td>
							<td align=\"left\" border=\"1\" rowspan=\"2\" width=\"8%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"><br>PENANDA<br>TANGAN<br></td>
                		</tr>
                		<tr><td align=\"left\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">GAJI POKOK<br>TUNJ<br>a. SUAMI/<br>ISTRI<br>b. ANAK<br>c. JUMLAH</td>
		                    <td align=\"left\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">TUNJANGAN<br>- UMUM<br>- KHUSUS</td>
		                    <td align=\"left\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">TUNJANGAN<br>- STRUK<br>- FUNG<br>- BULAT</td>
		                    <td align=\"left\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">TUNJANGAN<br>- BERAS<br>- JKK<br>- JKM</td>
		                    <td align=\"left\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">TUNJANGAN<br>- BPJS KES<br></td>
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
					$i = 0;
                	for ($j = $bulan; $j <= $bulan_2; $j++) 
                    {

	                	$sql="SELECT satkerja,nip,nama,lahir,golongan,stspegawai, 
	                		case  when stspegawai='1' then 'PNS' ELSE 'CPNS' end AS nm_stspegawai, case  when stskawin='1' then 'K11' when stskawin='2' then 'K10' when stskawin='3' then 'TK10' when stskawin='4' then 'D10' ELSE 'J10' END AS cstatus,
	                		anak, CASE when kdbantu<>'6' then '1' else '0' end as njiwa1, CASE when stskawin='1' and (kdbantu<>'4' and kdbantu<>'6') then '1' else '0' end as njiwa2, case when kdbantu<>'4' and kdbantu<>'6' then anak else '0' end as njiwa3, 
	                		gapok,tistri,tanak,(gapok+tistri+tanak) as tkeluarga,tpp,papua, tdt,tstruk,(case when left(kd_fung,1)<>'U' then tfung else 0 end) as tfung, bulat,beras,umum,
	                		pph,askes,bruto,iwp,sewa,tabungan,hutang,lain,disc as jum_pot,netto,npwp,rekening,jkk,jkm,khusus,tht from p3k_$j$tahun $where2  order by golongan desc ,masa_tahun desc;";
						$query = $this->db->query($sql);
				       		foreach ($query->result() as $row) {
					        	$i++;
					        	$nm_bln		   =$j;
					        	$nama   	   =$this->getBulanIndo2($nm_bln);
					        	$lahir   	   =$row->lahir;
					        	$nip   	   	   =$row->nip;
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
								
				        		$cRet .="
				   			         <tr>
				                        <td align=\"center\" border=\"1\" width=\"3%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$i</td>
				                        <td align=\"left\" border=\"1\" width=\"12%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\">$nama&nbsp;$tahun</td>
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
										<td align=\"left\" border=\"1\" width=\"6%\" style=\"font-size:9px;border-left:dashed 1px gray;border-right:dashed 1px gray;border-bottom:dashed 1px gray;border-top:dashed 1px gray\"></td>			                        
				                    </tr>";						
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
		        $judul  = 'Kartu Gaji' .'-'. $nama;
		        switch ($jenisCetak) {
		        	case 0:
		        		$this->_mpdf_a('',$cRet,'','','',8,0,0,0);
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

	function terbilang ($x) {
	   $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
	   if ($x < 12)
	     return " " . $abil[$x] ;
	   elseif ($x < 20)
	     return $this->terbilang($x - 10) . " Belas";
	   elseif ($x < 100)
	     return $this->terbilang($x / 10) . " Puluh" . $this->terbilang(fmod($x,10));
	   elseif ($x < 200)
	     return " Seratus" . $this->terbilang($x - 100);
	   elseif ($x < 1000)
	     return $this->terbilang($x / 100) . " Ratus" . $this->terbilang(fmod($x,100));
	   elseif ($x < 2000)
	     return " Seribu" . $this->terbilang($x - 1000);
	   elseif ($x < 1000000)
	     return $this->terbilang($x / 1000) . " Ribu" . $this->terbilang(fmod($x,1000));
	   elseif ($x < 1000000000)
	     return $this->terbilang($x / 1000000) . " Juta" . $this->terbilang(fmod($x,1000000));
	   elseif ($x < 1000000000000)
	     return $this->terbilang($x / 1000000000) . " Milyar" . $this->terbilang(fmod($x,1000000000));
	   elseif ($x < 1000000000000000)
	     return $this->terbilang($x / 1000000000000) . " Trilyun" . $this->terbilang(fmod($x,1000000000000));
	}



}
