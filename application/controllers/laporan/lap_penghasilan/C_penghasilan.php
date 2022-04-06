<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_penghasilan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('laporan/lap_penghasilan/M_penghasilan');
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

	public function index()
	{	
		$data = array(
			'page'	 	=> 'Surat Keterangan Penghasilan',
			'judul'		=> 'Surat Keterangan Penghasilan',
			'deskripsi'	=> 'Surat Keterangan Penghasilan'
		);

		$this->template->views('laporan/lap_penghasilan/V_penghasilan', $data);
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

	public function getConfig()
	{
		return $this->M_penghasilan->getConfig();
	}

	public function getBulan()
	{
		echo $this->M_penghasilan->getBulan();
	}

	public function getTahun()
	{
		echo $this->M_penghasilan->getTahun();
	}

	public function getSkpd()
	{
		echo $this->M_penghasilan->getSkpd(); 
	}

	public function getPangkat()
	{
		echo $this->M_penghasilan->getPangkat(); 
	}

		public function getpenghasilan()
	{
		echo $this->M_penghasilan->getpenghasilan(); 
	}

	public function getUnitSkpd()
	{
		$param = $this->uri->segment(5);
		echo $this->M_penghasilan->getUnitSkpd($param);
	}

	public function cetakLaporan()
	{
		$config = $this->getConfig();
		$nm_daerah	= strtoupper($config['nm_daerah']);
		$kota	= $config['kota'];
		$thang	= strtoupper($config['thang']);
		$jenisCetak = $this->input->get('jenisCetak');
		$tgl_cetak = $this->tanggal_balik($this->input->get('tgl_cetak'));

		$nama = $this->input->get('nama');
		$nip = $this->input->get('nip');

		$bulan = $this->getBulanIndo($this->input->get('bulan_tglcetak'));
		$pangkat = $this->input->get('pangkat');
		$gapok = $this->input->get('gapok');
		
		$data = array(
			'nm_kab'	 	=> strtoupper($config['nm_daerah'])
		);


		$bluePrint = $this->M_penghasilan->cetakLaporan($data);
		$nippa = $bluePrint[0]['nippa'];
		$namapa = $bluePrint[0]['namapa'];
		$nipbk = $bluePrint[1]['nipbk'];
		$namabk = $bluePrint[1]['namabk'];

			  $sql_satker = "SELECT a.satkerja,b.nm_satkerja from public.pegawai a inner join satkerja b on a.satkerja=b.satkerja where a.nip='$nip'";
			        $query = $this->db->query($sql_satker);
			         foreach($query->result() as $row1){
			        $csatkerja=$row1->nm_satkerja;
			    }

		$cRet ='';
       		 $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
                    <tr><td align=\"left\" style=\"font-size:12px;border-collapse:collapse;\"><strong>DEPARTEMEN DALAM NEGERI </strong></td></tr>
                    <tr><td align=\"left\" style=\"font-size:10px;border-collapse:collapse;\"><strong>".strtoupper($csatkerja)."</strong></td></tr>
                    <tr><td align=\"center\" style=\"font-size:12px;\"><strong>SURAT KETERANGAN PENGHASILAN</strong></td></tr>                              
                    <tr><td align=\"center\" style=\"font-size:10px;border-collapse:collapse;\"><b>Bulan : $bulan $thang</b></td></tr>    
                    <tr><td align=\"left\" style=\"font-size:12px;border-collapse:collapse;\">Menerangkan bahwa pemegang surat ini :</td></tr>
                  </table>";

               $cRet .="<table style=\"font-size:10px;border-collapse:collapse;\" width=\"100%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
            
                     <tr>
						<td align=\"left\" width=\"9%\"><b>Nama</b></td>                    
						<td align=\"center\" width=\"1%\">:</td>
						<td align=\"left\" width=\"80%\"><b>$nama</b></td>
					</tr>
                    <tr>
						<td align=\"left\" width=\"3%\"><b>Nip</b></td>                    
						<td align=\"center\" width=\"1%\">:</td>
						<td align=\"left\" width=\"80%\"><b>$nip</b></td>
					</tr>
                    <tr>
						<td align=\"left\" width=\"3%\"><b>Pangkat<b></td>                    
						<td align=\"center\" width=\"1%\">:</td>
						<td align=\"left\" width=\"80%\"><b>$pangkat</b></td>
					</tr>
					<tr>
						<td align=\"left\" width=\"3%\"><b>Gaji Pokok<b></td>                    
						<td align=\"center\" width=\"1%\">:</td>
						<td align=\"left\" width=\"80%\"><b>Rp.&nbsp;&nbsp;".number_format($gapok,2,',','.')."</b></td>
					</tr>
                  </table>";
              $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
  					<tr>
						<tr><td align=\"left\" style=\"font-size:12px;\"><strong>I. Gaji : </strong></td></tr>
					</tr>
  			      </table>";

  			  $sql = "SELECT * from public.pegawai where nip='$nip'";
			        $query = $this->db->query($sql);
			        $i = 0;
			        $totalsel = 0;
			        foreach ($query->result() as $row) {
			                
							$i++;
			                $gapok         	=$row->gapok;
			                $istri       	=$row->tistri;
			                $anak         	=$row->tanak;
			                $kd_fung        =$row->kd_fung;
			                if(substr($kd_fung,0,1)=='U'){
								$tfung      =0;
			                }else{
			                	$tfung      =$row->tfung;
			            	}
			            	$umum 	 		=$row->umum;			                
			                $tstruk			=$row->tstruk;
			                $khusus 		=$row->khusus;
			                $bulat         	=$row->bulat;
			                $beras         	=$row->beras;
			                $askes         	=$row->askes;
			                $jkk         	=$row->jkk;
			                $jkm         	=$row->jkm;
			                $iwp         	=$row->iwp;
			                $tht         	=$row->tht;
			                $sewa        	=$row->sewa;
			                $tabungan       =$row->tabungan;
			                $tunggakan		=$row->tunggakan;
			                $hutang			=$row->hutang;
			                $lain           =$row->lain;
			                $pph         	=$row->pph;
			                $netto   		=$row->netto;
			                $satkerja       =$row->satkerja;
			                $bruto          =$gapok+$istri+$anak+$umum+$khusus+$tstruk+$tfung+$bulat+$beras+$jkk+$jkm+$askes;
			                $disc       	=$iwp+$tht+$askes+$pph+$jkk+$jkm+$sewa+$tabungan+$hutang+$lain;
			                $netto          =$bruto-$disc;


			              $cRet .="<table style=\"font-size:10px;border-collapse:collapse;\" width=\"50%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">			                   
			                   <tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>    
									<td align=\"left\" width=\"70%\">- Gaji Pokok </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($gapok,2,',','.')."</td>               
								</tr>
			                    <tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>                    
									<td align=\"left\" width=\"70%\">- Tunjangan Istri/Suami </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($istri,2,',','.')."</td>
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>                    
									<td align=\"left\" width=\"70%\">- Tunjangan Anak </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($anak,2,',','.')."</td>
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>                    
									<td align=\"left\" width=\"70%\">- Tunjangan Struktural </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($tstruk,2,',','.')."</td>
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>                    
									<td align=\"left\" width=\"70%\">- Tunjangan Fungsional </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($tfung,2,',','.')."</td>
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>                    
									<td align=\"left\" width=\"70%\">- Tunjangan Khusus </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($khusus,2,',','.')."</td>
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>                    
									<td align=\"left\" width=\"70%\">- Tunjangan Umum </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($umum,2,',','.')."</td>
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>                    
									<td align=\"left\" width=\"70%\">- Pembulatan </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($bulat,2,',','.')."</td>
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>                    
									<td align=\"left\" width=\"70%\">- Tunjangan Beras </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($beras,2,',','.')."</td>
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>                    
									<td align=\"left\" width=\"70%\">- Tunjangan Pajak Penghasilan </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($pph,2,',','.')."</td>
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>                    
									<td align=\"left\" width=\"70%\">- BPJS Kesehatan </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($askes,2,',','.')."</td>
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>                    
									<td align=\"left\" width=\"70%\">- Tunjangan JKK </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($jkk,2,',','.')."</td>
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>                    
									<td align=\"left\" width=\"70%\">- Tunjangan JKM </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($jkm,2,',','.')."</td>
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>                    
									<td align=\"center\" width=\"70%\"><b>- Gaji Kotor </b></td>                    
									<td align=\"left\" width=\"2%\"><b>:Rp.</b></td>
									<td align=\"right\" width=\"30%\"><b>".number_format($bruto,2,',','.')."</b></td>
								</tr>				                 

			                  </table>";

			               $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
			  					<tr>
									<tr><td align=\"left\" style=\"font-size:12px;\"><strong>II.  Potongan-Potongan : </strong></td></tr>
								</tr>
			  			      </table>";


			               $cRet .="<table style=\"font-size:10px;border-collapse:collapse;\" width=\"50%\" align=\"left\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
			                   
			                   <tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>    
									<td align=\"left\" width=\"70%\">- Potongan IWP 1%  </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($iwp,2,',','.')."</td>               
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>    
									<td align=\"left\" width=\"70%\">- Potongan JKK  </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($jkk,2,',','.')."</td>               
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>    
									<td align=\"left\" width=\"70%\">- Potongan JKM  </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($jkm,2,',','.')."</td>               
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>    
									<td align=\"left\" width=\"70%\">- THT  </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($tht,2,',','.')."</td>               
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>    
									<td align=\"left\" width=\"70%\">- Sewa Rumah  </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($sewa,2,',','.')."</td>               
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>    
									<td align=\"left\" width=\"70%\">- Tunggakan </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($tunggakan,2,',','.')."</td>               
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>    
									<td align=\"left\" width=\"70%\">- Tabungan Perumahan  </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($tabungan,2,',','.')."</td>               
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>    
									<td align=\"left\" width=\"70%\">- Hutang  </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($hutang,2,',','.')."</td>               
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>    
									<td align=\"left\" width=\"70%\">- Potongan Lain - Lain  </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($lain,2,',','.')."</td>               
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>    
									<td align=\"left\" width=\"70%\">- Potongan Pajak Penghasilan  </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($pph,2,',','.')."</td>               
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>    
									<td align=\"left\" width=\"70%\">- BPJS Kesehatan  </td>                    
									<td align=\"left\" width=\"2%\">:Rp.</td>
									<td align=\"right\" width=\"30%\">".number_format($askes,2,',','.')."</td>               
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>                    
									<td align=\"center\" width=\"70%\"><b>- Total Potongan </b></td>                    
									<td align=\"left\" width=\"2%\"><b>:Rp.</b></td>
									<td align=\"right\" width=\"30%\"><b>".number_format($disc,2,',','.')."</b></td>
								</tr>
								<tr>
									<td align=\"center\" width=\"10%\">&nbsp;</td>                    
									<td align=\"center\" width=\"70%\"><b>- Gaji Bersih </b></td>                    
									<td align=\"left\" width=\"2%\"><b>:Rp.</b></td>
									<td align=\"right\" width=\"30%\"><b>".number_format($netto,2,',','.')."</b></td>
								</tr>		
								
			                  </table>";
 				}
 			    $terbilang = $this->terbilang($netto);
               $cRet .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
  					<tr>
						<tr><td align=\"left\" style=\"font-size:10px;border-collapse:collapse;\">Dengan Huruf : # $terbilang Rupiah #</td></tr>
					</tr>
  			      </table>";



				$sql5="select * from satkerja where satkerja='$satkerja';";
								$hasil5 = $this->db->query($sql5);
								 foreach ($hasil5->result() as $row){
									$jab_atasan  =$row->jab_atasan;
									$nama_atasan  =$row->nama_atasan;
									$nip_atasan  =$row->nip_atasan;
									$nama_bend  =$row->nama_bend;
									$nip_bend  =$row->nip_bend;

								 }
		      
		      $cRet .="<table style=\"border-collapse:collapse;font-size:12px;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">
                    <tr>
						<td align=\"center\" width=\"25%\">&nbsp;</td>                    
						<td align=\"center\" width=\"25%\">&nbsp;</td>
						<td align=\"center\" width=\"25%\"><br>$kota, $tgl_cetak </br></td>
					</tr>
                    <tr>
						<td align=\"center\" width=\"25%\">$jab_atasan</td>                    
						<td align=\"center\" width=\"25%\">&nbsp;</td>
						<td align=\"center\" width=\"25%\">PEMBUAT DAFTAR GAJI</td>
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
						<td align=\"center\" width=\"25%\">$nama_atasan<br>NIP. $nip_atasan</br></td>                    
						<td align=\"center\" width=\"25%\">&nbsp;</td>
						<td align=\"center\" width=\"25%\">$nama_bend<br>NIP. $nip_bend</br></td>
					</tr>                              
                  </table>";

		        $data['prev']= $cRet;
		        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $jenisCetak);
		        $judul  = 'Surat Keterangan Penghasilan' .'-'. $test;
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
