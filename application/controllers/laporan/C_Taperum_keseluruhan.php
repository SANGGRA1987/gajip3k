<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Taperum_keseluruhan extends CI_Controller {

    public function __construct()
    
    {
        parent::__construct();
        //$this->load->model('Laporan/M_Iwp');
        $this->load->library('pdf');
    }

    public function bulan($bln)
    {
        //$bln = date("m");
        switch ($bln) {
            case 1: 
            return "Januari";
                break;
            case 2: 
            return "Februari";
                break;
            case 3:
            return "Maret";
                break;
            case 4: 
            return "April";
                break;
            case 5: 
            return "Mei";
                break;
            case 6: 
            return "Juni";
                break;
            case 7: 
            return "Juli";
                break;
            case 8: 
            return "Agustus";
                break;
            case 9: 
            return "September";
                break;
            case 10: 
            return "Oktober";
                break;
            case 11: 
            return "November";
                break;
            case 12: 
            return "Desember";
                break;
                                                                  
        }

    }


    public function taperum_keseluruhan(){
    	
                $tanggal = date("d");
                $bln = date("m");
                $tahun = 2018;
                $c_bulan = $this->bulan($bln);
                $i = 100;
                $j = 100;
                $skpd1 = $_POST['kd_skpd1'];
                //$skpd1 = '1.03.01';
	    		$no = 0;
	    		$nip = '196005021981031020';
	        	$pdf = new FPDF('P','mm','A4');
                $pdf->AddPage(); // Membuat Halaman Baru
                $pdf->SetMargins(10,10,10);           
                $pdf->SetFont('Arial','B',12);// Setting Jenis Font Yang Akan Digunakan HEADER
                //$pdf->Cell(170,7,'',0,1,'L');
                $pdf->Cell(170,7,'ASMAT',0,0,'C');
                $pdf->Cell(-170,20,'REKAPITULASI DAFTAR PERHITUNGAN TABUNGAN PERUMAHAN',0,0,'C');
                $pdf->SetFont('ARIAL','',10);
                $sql_satker ="SELECT distinct a.nm_satkerja, a.satkerja from public.satkerja a inner join 
                              public.pegawai b ON a.satkerja=b.satkerja
                              where a.satkerja = '$skpd1'" ;
                $satuan_kerja = $this->db->query($sql_satker)->result();
                foreach ($satuan_kerja as $row) {
                        
                       //$pdf->Cell(10,6,"$no",1,0); 
                        $satkerja = $row->nm_satkerja;
                        $kd_satkerja = $row->satkerja;
                        //$pdf->Cell(35,6,"$row->nm_satkerja",1,0);
                        $pdf->Cell(10,40,"SATUAN KERJA : $kd_satkerja / $satkerja",0,0,'L');

                }
                $pdf->Cell(28,50,"BULAN                : $c_bulan $tahun",0,0,'C');
                $pdf->Cell(-44,60,"N0. SPMU           : ",0,0,'C');
                
                $pdf->Cell(15,40,'',0,1); // jarak antara header dan tabel
        
                $pdf->SetFont('Arial','B',10); // Setting jenis font yg akan digunakan dalam tabel
                $pdf->Cell(10,10,'No ',1,0,'C');
                $pdf->Cell(35,10,'GOLONGAN',1,0,'C');
                $pdf->Cell(35,10,'JUMLAH PEGAWAI',1,0,'C');
                $pdf->Cell(40,10,'JUMLAH TABUNGAN',1,0,'C');
                $pdf->Cell(35,10,'KETERANGAN',1,1,'C');
                $pdf->SetFont('Arial','',12); // font dan ukuran font

                $sql = "SELECT 'Gol I' as nmgol,count(satkerja) as jmlgol, sum(tabungan) as jml_tab from public.pegawai b where b.satkerja='1.03.01' and left(b.golongan,1) = '1' union
                        select 'Gol II' as nmgol,count(satkerja) as jmlgol, sum(tabungan) as jml_tab from public.pegawai b where b.satkerja='1.03.01' and left(b.golongan,1)= '2' union
                        select 'Gol III' as nmgol,count(satkerja) as jmlgol, sum(tabungan) as jml_tab from public.pegawai b where b.satkerja='1.03.01' and left(b.golongan,1) = '3' union
                        select 'Gol IV' as nmgol,count(satkerja) as jmlgol, sum(tabungan) as jml_tab from public.pegawai b where b.satkerja='1.03.01' and left(b.golongan,1)= '4' order by nmgol ";
                $n_jml_gol=0;
                $n_tabungan=0;
                $n_keterangan=0;

                $taperum = $this->db->query($sql)->result();
                foreach ($taperum as $row){
                        $no++;
                        $nm_gol = $row->nmgol;
                        $j_pegawai = $row->jmlgol;
                        $j_tabungan = $row->jml_tab;
                        $j_tabungan1 = number_format($j_tabungan,0,',','.');
                        $keterangan = $j_tabungan * $j_pegawai;
                        $keterangan1 = number_format($keterangan,0,',','.');

                        $n_jml_gol=$n_jml_gol+$j_pegawai;
                        $j_jml_gol = number_format($n_jml_gol,0,',','.');
                        $n_tabungan=$n_tabungan+$j_tabungan;
                        $j_tabungan_gol = number_format($n_tabungan,0,',','.');
                        $n_keterangan=$n_keterangan+$keterangan;
                        $j_keterangan = number_format($n_keterangan,0,',','.');

                        $pdf->Cell(10,6,"$no",1,0); 
                        $pdf->Cell(35,6,"$nm_gol",1,0);
                        $pdf->Cell(35,6,"$j_pegawai",1,0);
                        $pdf->Cell(40,6,"$j_tabungan1",1,0);
                        $pdf->Cell(35,6,"$keterangan1",1,1);
                                          
                        
                }
                       // $pdf->Cell(10,8,"",1,0);
                        $pdf->SetFont('Arial','B',12);
                        $pdf->Cell(45,8,"JUMLAH. . . . . ",1,0);
                        $pdf->Cell(35,8,"$j_jml_gol",1,0);
                        $pdf->Cell(40,8,"$j_tabungan_gol",1,0);
                        $pdf->Cell(35,8,"$j_keterangan",1,1);
                        $pdf->Cell(0,10,'',0,1);
                        $pdf->SetFont('Arial','',13);
                        $pdf->Cell(150,5,"AGATS, $tanggal $c_bulan $tahun",0,1,'R');
                        $pdf->Cell(143,9,'Kepala BPKAD',0,1,'R');
                        $pdf->Cell(155,9,'Bendahara Umum Daerah',0,1,'R');
                        $pdf->Cell(0,20,'',0,1);
                        $pdf->SetFont('Arial','U',13);
                        $pdf->Cell(165,9,'HALASON F SINURAT, SSTP,M.Si',0,1,'R');
                        $pdf->SetFont('Arial','',13);
                        $pdf->Cell(140,2,'PEMBINA',0,1,'R');
                        $pdf->Cell(155,11,'NIP.198108241999121001',0,1,'R');
                        $pdf->Cell(10,9,'',0,0,'L');
        				$pdf->Output();
    		

	}
}
