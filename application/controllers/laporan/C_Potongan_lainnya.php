<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Potongan_lainnya extends CI_Controller {

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


        public function potongan_lainnya(){
	
	        $tanggal = date("d");
            $bln = date("m");
            $tahun = 2018;
            $c_bulan = $this->bulan($bln);
            $skpd1 = $_POST['kd_skpd1'];
            //$skpd1 = '1.20.03';
    		$no = 0;
    		$nip = '196005021981031020';
        	$pdf = new FPDF('L','mm','LEGAL');
            $pdf->AddPage(); // Membuat Halaman Baru
            $pdf->SetMargins(19,19);           
            $pdf->SetFont('Arial','B',12);// Setting Jenis Font Yang Akan Digunakan HEADER
            $pdf->Cell(170,7,'',0,1,'L');
            $pdf->Cell(10,7,'DAFTAR REKAPITULASI',0,0,'L');
            $pdf->Cell(270,5,'Lapiran III : S.E MENTERI DALAM NEGERI',0,1,'R');
            $pdf->Cell(10,9,'TUNJANGAN ASKES',0,0,'L');
            $pdf->Cell(238,7,'376/65a/PUOD',0,1,'R');
            $pdf->Cell(10,9,'PEGAWAI NEGERI SIPIL DAERAH',0,0,'L');
            $pdf->Cell(230,7,'21/02/1995',0,1,'R');
            $pdf->Cell(10,9,'KABUPATEN ASMAT',0,0,'L');
            $pdf->Cell(15,25,"Bulan : $c_bulan $tahun",0,0,'L');
            $pdf->Cell(15,20,'',0,1); // jarak antara header dan tabel
    
            $pdf->SetFont('Arial','B',10); // Setting jenis font yg akan digunakan dalam tabel
            $pdf->Cell(10,10,'No ',1,0,'C');
            $pdf->Cell(120,10,'NIP / NAMA',1,0,'C');
            $pdf->Cell(30,10,'JML POTONGAN',1,0,'C');
            $pdf->Cell(150,10,'SATKERJA / UNIT',1,1,'C');
            $pdf->SetFont('Arial','',12); // font dan ukuran font

            $sql = "SELECT a.nip, a.nama, a.potongan, b.nm_satkerja, b.satkerja from public.pegawai a inner join 
                    public.satkerja b ON a.satkerja=b.satkerja
                    where a.satkerja = '$skpd1'" ;
            $askes = $this->db->query($sql)->result();
            foreach ($askes as $row){
                    $no++;
                    $nnama = $row->nama;
                    $nnip = $row->nip;
                    $potongan = $row->potongan;
                    $potongan1 = number_format($potongan ,0,',','.');
                    $satkerja = $row->satkerja;
                    $nm_satkerja = $row->nm_satkerja;

                    $pdf->SetFont('Arial','B',10);
                    $pdf->Cell(10,6,"$no",1,0,'R');  
                    $pdf->Cell(120,6,"$nnip / $nnama",1,0,'L');
                    $pdf->Cell(30,6,"$potongan1",1,0,'R');  
                    $pdf->Cell(150,6,"$satkerja / $nm_satkerja",1,1,'L');  
                }
    			
                    $pdf->Cell(0,10,'',0,1);
                    $pdf->SetFont('Arial','',13);
                    $pdf->Cell(220,5,"AGATS, $tanggal $c_bulan $tahun",0,1,'R');
                    $pdf->Cell(213,9,'Kepala BPKAD',0,1,'R');
                    $pdf->Cell(225,9,'Bendahara Umum Daerah',0,1,'R');
                    $pdf->Cell(0,20,'',0,1);
                    $pdf->SetFont('Arial','U',13);
                    $pdf->Cell(235,9,'HALASON F SINURAT, SSTP,M.Si',0,1,'R');
                    $pdf->SetFont('Arial','',13);
                    $pdf->Cell(210,2,'PEMBINA',0,1,'R');
                    $pdf->Cell(227,11,'NIP.198108241999121001',0,1,'R');
                    $pdf->Cell(10,9,'',0,0,'L');
    				$pdf->Output();
        }
}
