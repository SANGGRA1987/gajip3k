<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_CETAKSPM extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('transaksi/M_CETAKSPM');
	}

	function _mpdf($judul='',$isi='',$lMargin=10,$rMargin=10,$font=10,$orientasi) {
        
       	ini_set("memory_limit","-1");
        $this->load->library('M_pdf');
        $mpdf = new m_pdf('', 'Letter-L');
        $pdfFilePath = "output_pdf_name.pdf";
       // $mpdf->pdf->SetFooter('Printed Simgaji on @ {DATE j-m-Y H:i:s} || Page {PAGENO} of {nb}');
        //$mpdf->pdf->AddPage($orientasi);
        $mpdf->pdf->AddPage('L','','','','',2,2,2,2);
        if (!empty($judul)) $mpdf->pdf->writeHTML($judul);
        $mpdf->pdf->WriteHTML($isi);         
        $mpdf->pdf->Output();

    }

	public function index()
	{	
		$data = array(
			'page'	 	=> 'SURAT PERINTAH MEMBAYAR',
			'judul'		=> 'CETAK SPM GAJI',
			'deskripsi'	=> 'SURAT PERINTAH MEMBAYAR'
		);

		$this->template->views('transaksi/dokumen/V_CETAKSPM', $data);
	}
	
	public function  tanggal_balik($tgl){
		/*$tanggal  =  substr($tgl,0,2);
		$bulan  = substr($tgl,3,2);
		$tahun  =  substr($tgl,6,4);
		return  $tahun.'-'.$bulan.'-'.$tanggal;*/
		$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	 
		$xtgl 	= substr($tgl, 6, 2);
		$xbulan 	= substr($tgl, 9, 2);
		$xtahun  = substr($tgl, 0, 4);
	 
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
		return $this->M_CETAKSPM->getConfig();
	}

	public function getBulan()
	{
		echo $this->M_CETAKSPM->getBulan();
	}

	public function getTahun()
	{
		echo $this->M_CETAKSPM->getTahun();
	}

	public function getSkpd()
	{
		echo $this->M_CETAKSPM->getSkpd(); 
	}

	public function getPangkat()
	{
		echo $this->M_CETAKSPM->getPangkat(); 
	}

		public function getspm()
	{
		echo $this->M_CETAKSPM->getspm(); 
	}

	public function getUnitSkpd()
	{
		$param = $this->uri->segment(5);
		echo $this->M_CETAKSPM->getUnitSkpd($param);
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

	public function cetakspm()
	{
		$config = $this->getConfig();
		//$kota	= strtoupper($config['nm_daerah']);
		$kota	= strtoupper($config['nm_daerah']);
		$jenisCetak = $this->input->get('jenisCetak');
		//$tgl_cetak = $this->tanggal_balik($this->input->get('tgl_cetak'));
		$tgl_spm = $this->tanggal_balik($this->input->get('tgl_spm'));
		$nospm = $this->input->get('no_spm');
		$printer = $this->input->get('printer');
		$tahun = $this->input->get('tahun_tglcetak');
		//$nilai=1234456;
		//$terbilang= $this->penyebut($nilai);

		
		//$terbilang = $this->getTerbilang($number);
    // $angka = 1530093;
	// $bilangan = $this->terbilang($angka);

		//echo "<script> alert('$number')</script>";
		//$nama = $this->input->get('nama');
		//$nip = $this->input->get('nip');

		//$bulan = $this->getBulanIndo($this->input->get('bulan_tglcetak'));

		
		$data = array(
			'nm_kab'	 	=> strtoupper($config['nm_daerah'])
		);

		$bluePrint = $this->M_CETAKSPM->cetakspm($data);
		$where = "where a.no_spm='$nospm'";
		//$nippa = $bluePrint[0]['nippa'];
		//$namapa = $bluePrint[0]['namapa'];
		//$nipbk = $bluePrint[1]['nipbk'];
		//$namabk = $bluePrint[1]['namabk'];


		$i=0;
		$j=0;
		$k=0;

			$cRet ='';
       		$cRet .="
       			  <table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
       			 	 
	                    <tr><td width=\"100%\" align=\"center\" style=\"font-size:18px;border-collapse:collapse;\"><strong>KABUPATEN ASMAT</strong></td></tr>
	                    <tr><td width=\"100%\" align=\"center\" style=\"font-size:18px;border-collapse:collapse;\"><strong>SURAT PERINTAH MEMBAYAR</strong></td></tr>
	                    <tr><td width=\"100%\" align=\"center\"><strong>TAHUN ANGGARAN :$tahun</strong></td></tr>   
	                    <tr><td width=\"100%\" align=\"right\" style=\"font-size:12px;border-collapse:collapse;\">UP/GU/TU/(LS)</td></tr> 
	                    <tr><td width=\"100%\" align=\"right\" style=\"font-size:12px;border-collapse:collapse;\">Nomor SPM :$nospm</td>
	                    </tr>
	                    </table> ";


	        $cRet .="
					<table   width=\"100%\" style=\"border-collapse:collapse;\"  align=\"left\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\">

							<tr>
			                    <td width=\"100%\" colspan=\"6\" align=\"center\"  style=\"font-size:10px\">Diisi Oleh PPK-SKPD</td>
	                		</tr>";


	        $cRet .="
	                		<tr>
			                    <td  width=\"50%\" colspan=\"1\" align=\"left\"  style=\"font-size:10px\"><b>KUASA BENDAHARA UMUM DAERAH<br>KABUPATEN ASMAT</br></b><br>Supaya Menerbitkan SP2D Kepada :</br></td>            
			                    <td   width=\"50%\" colspan=\"5\" align=\"left\"  style=\"font-size:10px\"><b>POTONGAN :</b></td>
	                		</tr>";

					$sql="select a.no_spm,a.kd_skpd,d.nm_satkerja,d.nama_bend,d.jab_bend,d.nip_bend,d.nama_atasan,d.nip_atasan,d.jab_atasan,b.no_spd,b.keperluan from transaksi.trhspm a inner join transaksi.trhspp b on a.no_spp=b.no_spp inner join public.satkerja d on left(a.kd_skpd,7)=d.satkerja $where ;";

					 $query = $this->db->query($sql); 
           			 foreach ($query->result() as $row) {
								$i++;
			        			$kd_skpd  =$row->kd_skpd;
			        			$nm_satkerja=$row->nm_satkerja;
			        			$nama_bend=$row->nama_bend;
			        			$keperluan=$row->keperluan;
			        			$nama_atasan=$row->nama_atasan;
			        			$nip_atasan=$row->nip_atasan;
			        			$jab_atasan=$row->jab_atasan;


	        $cRet .="
	                		<tr>
			                    <td  width=\"50%\" rowspan=\"7\" align=\"left\"  style=\"font-size:10px\">SKPD :$nm_satkerja<br>Bendahara Pengeluaran :$nama_bend</br><br></br><br>No. Rekening Bank :</br><br>Cabang : BANK PAPUA CAB. ASMAT DI AGATS</br><br></br><br>NPWP :</br><br>Dasar Pembayaran/No. dan Tanggal SPD :</br></td>

			                     "; 
						}

			$cRet .="	  
			                      
			                    <td  width=\"5%\" rowspan=\"1\" align=\"center\"  style=\"font-size:10px\"><b>No.</b></td>
			                	<td  width=\"23%\" rowspan=\"1\" align=\"center\"  style=\"font-size:10px\"><b>Uraian (No. Rekening)</b></td>
			                	<td  width=\"3%\" rowspan=\"1\" align=\"center\"  style=\"font-size:10px\"><b></b></td>
			                	<td  width=\"10%\" rowspan=\"1\" align=\"center\"  style=\"font-size:10px\"><b>Jumlah</b></td> 
			                	<td  width=\"8%\" rowspan=\"1\" align=\"center\"  style=\"font-size:10px\"><b>Keterangan</b></td> 


	                		</tr>";

					$sql2="select a.no_spm,c.kd_rek5,c.nm_rek5,c.nilai from transaksi.trhspm a inner join transaksi.trhspp b on a.no_spp=b.no_spp 
					inner join transaksi.trspmpot c on a.no_spm=c.no_spm $where order by c.kd_rek5;";

					$query2 = $this->db->query($sql2); 

					 foreach ($query2->result() as $row) {
								$j++;
			        			$kd_rek5  =$row->kd_rek5;
			        			$nm_rek5=$row->nm_rek5;
			        			$nilai=$row->nilai;
			        $cRet .="			
			                  <tr>

			                	<td width=\"5%\"  rowspan=\"1\" align=\"center\"  style=\"font-size:10px\">$j.</td>
			                	<td  width=\"23%\" rowspan=\"1\" align=\"left\"  style=\"font-size:10px\">$nm_rek5</td>
			                	<td  width=\"3%\"  rowspan=\"1\" align=\"center\"  style=\"font-size:10px\">Rp.</td>
			                	<td  width=\"10%\"  rowspan=\"1\" align=\"right\"  style=\"font-size:10px\">".number_format($nilai,0,',','.')."</td>
			                	<td  width=\"8%\"  rowspan=\"1\" align=\"left\"  style=\"font-size:10px\"></td>


			                  </tr>";
					
					}		



	

					$sql3="select a.no_spm,sum(c.nilai) as total from transaksi.trhspm a inner join transaksi.trhspp b on a.no_spp=b.no_spp inner join transaksi.trspmpot c on a.no_spm=c.no_spm $where group by a.no_spm;";

					$query3 = $this->db->query($sql3); 

 					foreach ($query3->result() as $row) {
		
			        			$total  =$row->total;
		
			        $cRet .="			
			                  <tr>
	

			                	<td  width=\"50%\"  rowspan=\"7\" align=\"left\"  style=\"font-size:10px\">Untuk Keperluan :$keperluan<br></br><br></br><br>(1).Belanja Tidak Langsung</br><br>&ensp;2.&ensp;Belanja Langsung</br></td>
			                	<td  rowspan=\"1\" align=\"center\"  style=\"font-size:10px\"></td>
			                	<td  rowspan=\"1\" align=\"left\"  style=\"font-size:10px\"><b>Jumlah</b></td>
			                	<td  rowspan=\"1\" align=\"right\"  style=\"font-size:10px\"></td>
			                	<td  rowspan=\"1\" align=\"right\"  style=\"font-size:10px\">".number_format($total,0,',','.')."</td>
			                	<td  rowspan=\"1\" align=\"left\"  style=\"font-size:10px\"></td>



			                  </tr>";

					}

					  $cRet .="			
			                  <tr>
	

			                	
			                	<td  width=\"50%\" colspan=\"5\" align=\"left\"  style=\"font-size:10px\"><b><b>Informasi :</b>(Tidak mengurangi jumlah pembayaran SPM)</td>
			 
			                  </tr>";

					  $cRet .="			
			                  <tr>
	

			                	
			                	<td  rowspan=\"1\" align=\"center\"  style=\"font-size:10px\"><b>No.</b></td>
			                	<td  rowspan=\"1\" align=\"center\"  style=\"font-size:10px\"><b>Uraian</b></td>
			                	<td  rowspan=\"1\" align=\"center\"  style=\"font-size:10px\"><b></b></td>
			                	<td  rowspan=\"1\" align=\"center\"  style=\"font-size:10px\"><b>Jumlah</b></td>
			                	<td  rowspan=\"1\" align=\"center\"  style=\"font-size:10px\"><b>Keterangan</b></td>

			                  </tr>";

					$sql7="select a.no_spm,c.kd_rek5,c.nm_rek5,c.nilai from transaksi.trhspm a inner join transaksi.trhspp b on a.no_spp=b.no_spp 
					inner join transaksi.trspmpot c on a.no_spm=c.no_spm $where and c.kd_rek5='2130101' order by c.kd_rek5;";

					$query7 = $this->db->query($sql7); 

					 foreach ($query7->result() as $row) {
								$l++;
			        			$kd_rek5  =$row->kd_rek5;
			        			$nm_rek5=$row->nm_rek5;
			        			$nilai_pot=$row->nilai;

			        $cRet .="			
			                  <tr>
	
			                	<td  rowspan=\"1\" align=\"center\"  style=\"font-size:10px\">$l.</td>
			                	<td  rowspan=\"1\" align=\"left\"  style=\"font-size:10px\">$nm_rek5</td>
			                	<td  rowspan=\"1\" align=\"center\"  style=\"font-size:10px\">Rp.</td>
			                	<td  rowspan=\"1\" align=\"right\"  style=\"font-size:10px\">".number_format($nilai_pot,0,',','.')."</td>
			                	<td  rowspan=\"1\" align=\"left\"  style=\"font-size:10px\"></td>

			                  </tr>";
			    }
		
			
			        $cRet .="			
			                  <tr>
	

			                	
			                	<td  rowspan=\"1\" align=\"center\"  style=\"font-size:10px\"></td>
			                	<td  rowspan=\"1\" align=\"right\"  style=\"font-size:10px\"><b>Jumlah</b></td>
			                	<td  rowspan=\"1\" align=\"center\"  style=\"font-size:10px\">Rp.</td>
			                	<td  rowspan=\"1\" align=\"right\"  style=\"font-size:10px\">".number_format($nilai_pot,0,',','.')."</td>
			                	<td  rowspan=\"1\" align=\"left\"  style=\"font-size:10px\"></td>



			                  </tr>";

				$sql4="select a.no_spm,sum(c.nilai) as jum_spm from transaksi.trhspm a inner join transaksi.trhspp b on a.no_spp=b.no_spp inner join transaksi.trdspp c on b.no_spp=c.no_spp $where group by a.no_spm;";

					$query4 = $this->db->query($sql4); 

 					foreach ($query4->result() as $row) {
		
			        			$jum_spm  =$row->jum_spm;
			        			$jum_bersih = $jum_spm-$total;
			        			//$nilai = $jum_bersih;

			        $cRet .="			
			                  <tr>
	

			                	
			                	<td  colspan=\"2\" align=\"right\"  style=\"font-size:10px\"><b>Jumlah SPM</b></td>
			        
			                	<td  rowspan=\"1\" align=\"center\"  style=\"font-size:10px\">Rp.</td>
			                	<td  rowspan=\"1\" align=\"right\"  style=\"font-size:10px\"><b>".number_format($jum_bersih,0,',','.')."</b></td>
			                	<td  rowspan=\"1\" align=\"left\"  style=\"font-size:10px\"></td>


			                  </tr>";

						
							}
							$nilai=$jum_spm-$total;
							$terbilang_bersih= $this->penyebut($nilai);
 					$cRet .="			
		

			                	 <tr>

			            
			                	<td  colspan=\"5\" align=\"left\"  style=\"font-size:10px\"><b>Uang Sejumlah:</b>$terbilang_bersih</td>
			                	

			                	</tr>";
			                	 					$cRet .="			
			                	 <tr>

			                	<td  colspan=\"1\" align=\"left\"  style=\"font-size:10px\"></td>";
			        $cRet .="
					<table   width=\"100%\" style=\"border-collapse:collapse;\"  align=\"left\" border=\"1\" cellspacing=\"1\" cellpadding=\"3\">";

				$sql5="select a.no_spm,c.kd_rek5,c.nm_rek5,c.nilai from transaksi.trhspm a inner join transaksi.trhspp b on a.no_spp=b.no_spp inner join transaksi.trdspp c on b.no_spp=c.no_spp $where order by c.kd_rek5;";

					$query5 = $this->db->query($sql5); 
					foreach ($query5->result() as $row) {
						$k++;
		
			        			$no_spm  =$row->no_spm;
			        			$kd_rek5  =$row->kd_rek5;
			        			$nm_rek5  =$row->nm_rek5;
			        			$nilai  =$row->nilai;	
			        			
					$cRet .="
	                		<tr>
			                    <td  colspan=\"3\" align=\"left\"  style=\"font-size:10px\">$kd_rek5-$nm_rek5</td>  

			                    <td  width=\"5%\" rowspan=\"1\" align=\"center\"  style=\"font-size:10px\">Rp.</td> 
			                    <td  width=\"30%\" rowspan=\"1\" align=\"right\"  style=\"font-size:10px\">".number_format($nilai,0,',','.')."</td> 
			                  
	
	
	                		</tr>";
						}
			$sql6="select a.no_spm,sum(c.nilai) as total from transaksi.trhspm a inner join transaksi.trhspp b on a.no_spp=b.no_spp inner join transaksi.trdspp c on b.no_spp=c.no_spp $where group by a.no_spm;";

					$query6 = $this->db->query($sql6); 

 					foreach ($query6->result() as $row) {
		
			        			$totalx  =$row->total;
			        			$nilai = $totalx;

					$cRet .="
	                		<tr>
			                    <td  colspan=\"3\" align=\"left\"  style=\"font-size:10px\"><b>Jumlah SPP yang Diminta</b></td>  
			                    <td  rowspan=\"1\" align=\"center\"  style=\"font-size:10px\">Rp.</td> 
			                    <td  rowspan=\"1\" align=\"right\"  style=\"font-size:10px\"><b>".number_format($totalx,0,',','.')."</b></td> 
			                  
	                		</tr>";
	                	}


	                	$terbilang_total= $this->penyebut($nilai);

					$cRet .="
	                		<tr>
			                    <td  colspan=\"5\" align=\"left\"  style=\"font-size:10px\"><b>Terbilang :</b>$terbilang_total</td>  
			                    
			                  
	                		</tr>
	                		<tr>
			                    <td  colspan=\"5\" align=\"left\"  style=\"font-size:10px\"><b>Nomor dan Tanggal SPP :$nospm-$tgl_spm</b></td>  
			                    
			                  
	                		</tr>
	                		<tr>
			                    <td  colspan=\"5\" align=\"left\"  style=\"font-size:10px\">*)Coret yang tidak Perlu<br>**)Pilih yang sesuai</br></td>  
			                    
			                  
	                		</tr>


	                		</table> ";

	                $cRet .="
			                	<td  colspan=\"2\" align=\"center\"  style=\"font-size:10px\">AGATS,$tgl_spm<br>$jab_atasan</br><br></br><br></br><br></br><br></br><br></br><br></br><br></br><br></br>$nama_atasan<br>NIP.$nip_atasan</br></td>
			                	<td  colspan=\"3\" align=\"center\"  style=\"font-size:10px\">(..................................................)<br>Nip.</br></td>
			                	

			                	</tr>";
			                	

			      
			    	        $cRet .="			
		

			                	 <tr>
	

			                	
			                	<td  colspan=\"6\" align=\"center\"  style=\"font-size:10px\">SPM ini sah apabila telah ditandatangi dan distempel oleh Kepala SKPD</td>
			                	

			                	</tr>


 					</table> ";




			
			
			
		        $data['prev']= $cRet;
		        $test = str_replace(str_split('\\/:*?"<>|,'), ' ', $jenisCetak);
		        $judul  = 'Surat Perintah Membayar' .'-'. $test;
		        // echo $judul;
		        // echo $data['tipeCetakan'];
		        switch ($data['tipeCetakan']) {
		        	case 0:
		        		//$this->_mpdf('',$cRet,5,5,5,'L');
		        	$this->_mpdf('',$cRet,'','','',2,2,2,2);
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
