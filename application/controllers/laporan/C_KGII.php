<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_KGII extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('laporan/M_KGII');
	}

	function _mpdf($judul='',$isi='',$lMargin=10,$rMargin=10,$font=10,$orientasi) {
        
       	ini_set("memory_limit","-1");
        $this->load->library('M_pdf');
        $mpdf = new m_pdf('', 'Letter-L');
        $pdfFilePath = "output_pdf_name.pdf";
        $mpdf->pdf->SetFooter('Printed Simgaji on @ {DATE j-m-Y H:i:s} || Page {PAGENO} of {nb}');
        $mpdf->pdf->AddPage($orientasi);
        if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
        $mpdf->pdf->WriteHTML($isi);         
        $mpdf->pdf->Output();

    }

	public function index()
	{	
		$data = array(
			'page'	 	=> 'LAPORAN KG II',
			'judul'		=> 'LAPORAN KG II',
			'deskripsi'	=> 'LAPORAN KG II'
		);

		$this->template->views('laporan/V_KGII', $data);
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

	public function getBulan()
	{
		echo $this->M_KGII->getBulan();
	}

	public function getTahun()
	{
		echo $this->M_KGII->getTahun();
	}

	public function getSkpd()
	{
		echo $this->M_KGII->getSkpd(); 
	}

	public function getUnitSkpd()
	{
		$param = $this->uri->segment(5);
		echo $this->M_KGII->getUnitSkpd($param);
	}

	public function cetakLaporan()
	{
		$jenisCetak = '2';		
		$skpd = $this->input->get('skpd');
		$nama = $this->input->get('nama');
		$tgl_cetak = $this->tanggal_balik($this->input->get('tgl_cetak'));
		$bulan = $this->getBulanIndo($this->input->get('bulan_tglcetak'));
		$tahun = $this->input->get('tahun_tglcetak');
		$nomor = $this->input->get('nomor');

		$bluePrint = $this->M_KGII->cetakLaporan($skpd);
		$nippa = $bluePrint[0]['nippa'];
		$namapa = $bluePrint[0]['namapa'];
		$nipbk = $bluePrint[1]['nipbk'];
		$namabk = $bluePrint[1]['namabk'];

		$cRet ='';
       		 $cRet .="<table style=\"border-collapse:collapse;font-size:12px;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
	                    <tr><td align=\"center\"><u><strong>REKAPITULASI GAJI PEGAWAI</strong></u></td></tr>
                  	</table>";

               $cRet .="<table style=\"font-size:10px;border-collapse:collapse;\" width=\"100%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">            
                     <tr>
						<td align=\"left\" width=\"15%\">BULAN</td>                    
						<td align=\"center\" width=\"1%\">:</td>
						<td align=\"left\" width=\"40%\">$bulan $tahun</td>
						<td align=\"left\" width=\"15%\">LAMPIRAN</td>                    
						<td align=\"center\" width=\"1%\">:</td>
						<td align=\"left\" width=\"30%\">SE. MENTERI DALAM NEGERI</td>
					</tr>
                    <tr>
						<td align=\"left\" width=\"15%\">BENDAHARAWAN GAJI</td>                    
						<td align=\"center\" width=\"1%\">:</td>
						<td align=\"left\" width=\"40%\">$nama</td>
						<td align=\"left\" width=\"15%\">TANGGAL</td>                    
						<td align=\"center\" width=\"1%\">:</td>
						<td align=\"left\" width=\"30%\">21/09/1984</td>
					</tr>
                    <tr>
						<td align=\"left\" width=\"15%\"></td>                    
						<td align=\"center\" width=\"1%\"></td>
						<td align=\"left\" width=\"40%\"></td>
						<td align=\"left\" width=\"15%\">NOMOR</td>                    
						<td align=\"center\" width=\"1%\">:</td>
						<td align=\"left\" width=\"30%\">973/3148/PUOD</td>
					</tr>
					<tr>
						<td align=\"left\" width=\"15%\">KODE SKPD/UNIT</td>                    
						<td align=\"center\" width=\"1%\">:</td>
						<td align=\"left\" width=\"40%\">$skpd</td>
						<td align=\"left\" width=\"15%\">LAPORAN</td>                    
						<td align=\"center\" width=\"1%\">:</td>
						<td align=\"left\" width=\"30%\">Model KG-II</td>
					</tr>
                  </table>";
  			  	
  			  		$sql = "SELECT * from public.satkerja where satkerja='$skpd'";
			        $query = $this->db->query($sql);
			        foreach ($query->result() as $row) {
		                $nm_satkerja        =$row->nm_satkerja;
		                $jab_atasan       	=$row->jab_atasan;
		                $nama_atasan        =$row->nama_atasan;
		                $nip_atasan         =$row->nip_atasan;
		                $jab_bend       	=$row->jab_bend;
		                $nama_bend        	=$row->nama_bend;
		                $nip_bend         	=$row->nip_bend;
		                $jab_operator       =$row->jab_operator;
		                $nama_operator      =$row->nama_operator;
		                $nip_operator       =$row->nip_operator;			                
			        
				        $sql1 = "SELECT * from public.pegawai where satkerja='$skpd'";
				        $query = $this->db->query($sql1);
				        $i=0;
				        $jpns=0;$jistri=0;$janak=0;$cgapok=0;
						$ckel=0;$ctpp=0;$ctdt=0;$cpapua=0;
						$cstruk=0;$cfung=0;$cumum=0;$cberas=0;
						$ctpph=0;$cbulat=0;$pot=0;$csewa=0;
						$ctung=0;$chut=0;$ctab=0;$clain=0;
						$cpph=0;$ckor=0;$jum1=0;$jum2=0;
						$jkotor=0;$jum4=0;$Tot=0;

				        foreach ($query->result() as $row1) {
							$i++;
			                $kdbantu         	=$row1->kdbantu;
			                $stskawin         	=$row1->stskawin;

				            if($kdbantu != 6){
								$jpns=$jpns + 1 ;
								if($kdbantu != 4){
									$janak=$janak+$row1->anak ;
									if($stskawin==1){
										$jistri=$jistri + 1 ;
									}
								}
							}
							$jum1 = ($jpns+$janak+$jistri) ;

							$cgapok = $cgapok + $row1->gapok ;
							if($kdbantu != 8){
								$ckel = $ckel + ($row1->tistri + $row1->tanak) ;
							}
							$ctpp = $ctpp + $row1->tpp ;
							$cstruk = $cstruk + $row1->tstruk ;

							if(substr($row1->kd_fung,0,1)=='U'){
								$cumum = $cumum + $row1->tfung ;
							}else{
								$cfung = $cfung + $row1->tfung ;
							}

							$cberas = $cberas+$row1->beras ; 

							$ctdt 	= $ctdt + $row1->tdt ;
							$cpapua = $cpapua + $row1->papua ;
							$ctpph 	= $ctpph +$row1->pph ;
							$cbulat = $cbulat+$row1->bulat ;

							$pot 	= $pot+$row1->iwp ;
							$csewa 	= $csewa+$row1->sewa ;
							$ctung 	= $ctung+$row1->tunggakan ;
							$chut 	= $chut+$row1->hutang ;
							$ctab 	= $ctab+$row1->tabungan ;
							$clain 	= $clain+$row1->lain ;
							$cpph 	= $cpph+$row1->pph ;

							$gol = substr($row1->golongan,0,1);
							if($gol == '1'){
								$ckor = $ckor + 0;
							}else{
								if($gol == '2'){
									$ckor = $ckor + 0;
								}else{
									if($gol == '3'){
										$ckor = $ckor + 0;
									}else{
										$ckor = $ckor + 0;
									}
								}
							}
							$jum2 	= ($cgapok+$ckel+$ctpp+$cstruk+$cfung+$cumum+$cberas+$cpapua+$ctdt) ;
							$jkotor = $jum2 + ($ctpph+$cbulat) ;
							$jum4 	= ($pot+$csewa+$cberas+$chut+$ctab+$clain+$cpph+$ckor) ;
							$tot 	= $jkotor - $jum4 ;
				        }
			        }
					
			            $cRet .="<table style=\"font-size:10px;border-collapse:collapse;\" width=\"100%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
			            	<tr>    
								<td colspan=\"3\" style=\"border-top: solid 1px black;border-bottom: solid 1px black;border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" >DAFTAR INI MEMUAT REKAPITULASI GAJI SEBANYAK DAFTAR GAJI</td>    
							</tr>
			            	<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\"><u>1. JUMLAH PEGAWAI</u></td>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"><u>MENURUT DAFTAR GAJI</u></td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"><u>HASIL PENELITIAN KPKN</u></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A). PEGAWAI</td>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\">$jpns</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B). ISTRI / SUAMI</td>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\">$jistri</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C). ANAK</td>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\">$janak</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-top: solid 1px black;border-bottom: solid 1px black;border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"60%\">I.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;JUMLAH &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( A s/d C )</td>    
								<td style=\"border-top: solid 1px black;border-bottom: solid 1px black;border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\">".number_format($jum1,0,',','.')."</td>
								<td style=\"border-top: solid 1px black;border-bottom: solid 1px black;border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\"><u>2. JUMLAH GAJI</u></td>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A). GAJI POKOK</td>     
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($cgapok,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B). TUNJ. KELUARGA (ISTRI/SUAMI/ANAK)</td>     
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($ckel,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C). TUNJ. PENGABDIAN</td>     
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($ctdt,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;D). TUNJ. IRIAN JAYA / PAPUA</td>     
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($cpapua,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;E). TUNJ. PERBAIKAN PENGHASILAN</td>     
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($ctpp,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;F). TUNJ. STRUKTURAL</td>     
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($cstruk,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;G). TUNJ. FUNGSIONAL</td>     
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($cfung,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UMUM NON JABATAN</td>     
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($cumum,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;H). TUNJ. BERAS</td>     
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($cberas,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-top: solid 1px black;border-bottom: solid 1px black;border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"60%\">II.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;JUMLAH &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( A s/d H )</td>    
								<td style=\"border-top: solid 1px black;border-bottom: solid 1px black;border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($jum2,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-top: solid 1px black;border-bottom: solid 1px black;border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I). TUNJ. PAJAK PENGHASILAN</td>     
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($ctpph,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;J). TUNJ. PEMBULATAN</td>     
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($cbulat,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-top: solid 1px black;border-bottom: solid 1px black;border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"60%\">III.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;JUMLAH GAJI KOTOR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>    
								<td style=\"border-top: solid 1px black;border-bottom: solid 1px black;border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($jkotor,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-top: solid 1px black;border-bottom: solid 1px black;border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;K). POTONGAN IURAN 10%</td>     
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($pot,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;L). SEWA RUMAH</td>     
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($csewa,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M). POTONGAN BERAS</td>     
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($cberas,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N). HUTANG KELEBIHAN</td>     
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($chut,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;O). TABUNGAN PERUMAHAN P.N.S</td>     
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($ctab,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P). LAIN - LAIN</td>     
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($clain,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Q). PAJAK PENGHASILAN</td>     
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($cpph,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"left\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R). AMAL BHAKTI KORPRI</td>     
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($ckor,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-top: solid 1px black;border-bottom: solid 1px black;border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"60%\">IV.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;JUMLAH&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( K s/d R )</td>    
								<td style=\"border-top: solid 1px black;border-bottom: solid 1px black;border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($jum4,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-top: solid 1px black;border-bottom: solid 1px black;border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>
							<tr>    
								<td style=\"border-top: solid 1px black;border-bottom: solid 1px black;border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"60%\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;JUMLAH GAJI YANG DIBAYAR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( III - IV )</td>    
								<td style=\"border-top: solid 1px black;border-bottom: solid 1px black;border-left:solid 1px black;border-right:solid 1px black;\" align=\"right\" width=\"20%\">".number_format($tot,0,',','.')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<td style=\"border-top: solid 1px black;border-bottom: solid 1px black;border-left:solid 1px black;border-right:solid 1px black;\" align=\"center\" width=\"20%\"></td>               
							</tr>			                   			                   
		                   
		                  </table>";
		      
		      $cRet .="<table style=\"border-collapse:collapse; font-size:10px;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
                    <tr>
						<td align=\"left\" width=\"25%\">S.P.M.U &nbsp;&nbsp;&nbsp;: GAJI</td> 
					</tr>
					<tr>
						<td align=\"left\" width=\"25%\">TANGGAL : $tgl_cetak</td>
					</tr>
					<tr>
						<td align=\"left\" width=\"25%\">NOMOR &nbsp;&nbsp;&nbsp;: $nomor</td>
					</tr>
                    <tr>
						<td align=\"center\" width=\"25%\">&nbsp;</td>                    
						<td align=\"center\" width=\"25%\">&nbsp;</td>
						<td align=\"left\" width=\"25%\">Agats, $tgl_cetak<br>Sesuai dengan hasil penelitian di atas,<br>maka jumlah gaji bertambah/berkurang sebesar<br>Rp. ..............................................................</td>
					</tr>
                    <tr>
						<td align=\"center\" width=\"25%\">KEPALA BPKD KAB. ASMAT<BR>BENDAHARA UMUM DAERAH</td>                    
						<td align=\"center\" width=\"25%\">Agats, $tgl_cetak<br>PEMBUAT DAFTAR GAJI</td>
						<td align=\"center\" width=\"25%\"></td>
					</tr>
                    <tr>
						<td align=\"center\" width=\"25%\">&nbsp;</td>                    
						<td align=\"center\" width=\"25%\">&nbsp;</td>
						<td align=\"center\" width=\"25%\">&nbsp;</td>
					</tr>
                    <tr>
                        <td align=\"center\" width=\"25%\">&nbsp;</td>                    
						<td align=\"center\" width=\"25%\">&nbsp;</td>
						<td align=\"center\" width=\"25%\">&nbsp;</td>
					</tr>                           
                    <tr>
						<td align=\"center\" width=\"25%\">$namapa</td>                    
						<td align=\"center\" width=\"25%\">$namabk</td>
						<td align=\"center\" width=\"25%\"></td>
					</tr>
					<tr>
						<td align=\"center\" width=\"25%\">PEMBINA</td>                    
						<td align=\"center\" width=\"25%\">PENGATUR MUDA TINGKAT I</td>
						<td align=\"center\" width=\"25%\">Kepala KPN</td>
					</tr>
					<tr>
						<td align=\"center\" width=\"25%\">NIP. $nippa</td>                    
						<td align=\"center\" width=\"25%\">NIP. $nipbk</td>
						<td align=\"center\" width=\"25%\"></td>
					</tr>                               
                  </table>";
                  

		        $data['prev']= $cRet;
		        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $jenisCetak);
		        $judul  = 'Surat Keterangan Penghasilan' .'-'. $test;
		        // echo $judul;
		        // echo $data['tipeCetakan'];
		        switch ($data['tipeCetakan']) {
		        	case 0:
		        		$this->_mpdf('',$cRet,10,10,10,'P');
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

/* End of file C_kib_b.php */
/* Location: ./application/controllers/laporan/C_kib_b.php */
