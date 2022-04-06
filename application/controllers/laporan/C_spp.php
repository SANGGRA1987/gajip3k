<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_spp extends CI_Controller {

    public function __construct()
    
    {
        parent::__construct();
       
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


    public function spp(){
    	           
                $tanggal = date("d");
                $bln = date("m");
                $tahun = 2018;
                $c_bulan = $this->bulan($bln);
                $skpd1 = '1.01.01';
                $no = 0;
                $skpd1 = '1.01.01';
                $alamat = 'Komplek Perkantoran Pemda';
                $nm_skpd = 'DINAS PENDIDIKAN, PEMUDA DAN OLAHRAGA';
                $pdf = new FPDF('P','mm','LEGAL');
                $pdf->AddPage(); // Membuat Halaman Baru
                $pdf->SetMargins(19,19);           
                $pdf->SetFont('Times','B',16);// Setting Jenis Font Yang Akan Digunakan HEADER
                $pdf->Cell(170,7,'',0,1,'L');
                $pdf->Cell(0,7,'PEMERINTAH ASMAT',0,1,'C');
                $pdf->Cell(0,9,'SURAT PERMINTAAN PEMBAYARAN',0,1,'C');
                $pdf->Cell(15,20,'',0,1); // jarak antara header dan tabel

                $pdf->SetFont('Arial','',8); // Setting jenis font yg akan digunakan dalam tabel
                $pdf->Cell(40,5,'Uang Persediaan',0,0,'C');
                $pdf->Cell(45,5,'Ganti Uang Persediaan',0,0,'C');
                $pdf->Cell(50,5,'Tambahan Uang Persediaan',0,0,'C');
                $pdf->Cell(45,5,'Pembayaran Langsung',0,1,'C');
                $pdf->Cell(40,6,'[1] SPP_UP []',0,0,'C');
                $pdf->Cell(45,6,'[2] SPP_GU []',0,0,'C');
                $pdf->Cell(50,6,'[3] SPP_TU []',0,0,'C');
                $pdf->Cell(45,6,'[4] SPP_LS []',0,1,'C');

                $pdf->SetY(45);
                $pdf->Cell(180,30,'',1,1); //kotak
                $pdf->Cell(160,6,'',0,0,'C');
                $pdf->Cell(20,6,'Kode',0,1,'L');
               
                
                $pdf->SetFont('Arial','',8);
                $sql = "SELECT satkerja, nm_satkerja, alamat, urusan, nama_bend, nip_bend, rekening FROM public.satkerja
                where satkerja = '$skpd1'";
                $resulte = $this->db->query($sql)->result();
                foreach ($resulte as $row){
                        $no++;
                        $satkerja = $row->satkerja;
                        $nm_satkerja = $row->nm_satkerja;
                        $alamat = $row->alamat;
                        $urusan = $row->urusan;
                        $bendahara = $row->nama_bend;
                        $nip_bend = $row->nip_bend;
                        $rekening = $row->rekening;
                     
                }
                list($kodeurusan,$kodedinas,$kodetype) = explode('.',$satkerja);
                $kode = $kodeurusan.".".$kodedinas;
               // $pdf->Cell(10,5,"$kode",0,0,'C');

                $pdf->Cell(10,5,'1',0,0,'C');
                $pdf->Cell(20,5,'SKPD         :',0,0,'L');
                $pdf->Cell(130,5,"$nm_satkerja",0,0,'L');
                $pdf->Cell(20,5,"{$satkerja}",0,1,'L');
                $pdf->Cell(10,5,'2',0,0,'C');
                $pdf->Cell(20,5,'Unit Kerja  :',0,0,'L');
                $pdf->Cell(130,5,"$nm_satkerja",0,0,'L');
                $pdf->Cell(20,5,"{$satkerja}",0,1,'L');
                $pdf->Cell(10,5,'3',0,0,'C');
                $pdf->Cell(20,5,'Alamat :',0,0,'L');
                $pdf->Cell(130,5,"$alamat",0,1,'L');
                $pdf->Cell(10,5,'4',0,0,'C');
                $pdf->Cell(150,5,'NO.DPA.SKPD/DPPA           :',0,1,'L');
                $pdf->Cell(10,5,'',0,0,'C');
                $pdf->Cell(150,5,'SKPD/DPAL-SKPD',0,1,'L');
                $pdf->Cell(10,5,'',0,0,'C');
                $pdf->Cell(150,5,'Tanggal DPA.SKPD/DPPA    :',0,1,'L');
                $pdf->Cell(10,5,'',0,0,'C');
                $pdf->Cell(150,5,'SKPD/DPAL-SKPD',0,1,'L');
                $pdf->Cell(10,5,'5',0,0,'C');
                $pdf->Cell(150,4,'Tahun Anggaran                    :',0,1,'L');
                $pdf->Cell(10,5,'6',0,0,'C');
                $pdf->Cell(150,4,'Bulan                                     :',0,1,'L');
                $pdf->Cell(10,5,'7',0,0,'C');
                $pdf->Cell(50,5,'Urusan Pemerintahan           :',0,0,'L');
                $pdf->Cell(100,5,"$urusan",0,0,'L');
                $pdf->Cell(20,5,"{$kode}",0,1,'L');
                $pdf->Cell(10,5,'8',0,0,'C');
                $pdf->Cell(50,5,'Nama Program          :',0,0,'L');
                $pdf->Cell(100,5,"Belanja Tidak Langsung",0,0,'L');
                $pdf->Cell(20,5,"{kode urusan}",0,1,'L');
                $pdf->Cell(10,5,'9',0,0,'C');
                $pdf->Cell(50,5,'Nama Kegiatan          :',0,0,'L');
                $pdf->Cell(100,5,"Pegawai",0,0,'L');
                $pdf->Cell(20,5,"{kode urusan}",0,1,'L');
                $pdf->SetY(75);
                $pdf->Cell(180,80,'',1,1); //kotak
                //Isi 
                $pdf->SetFont('Arial','',7);
                $pdf->Cell(20,5,"",0,1,'L');//JARAK
                $pdf->Cell(90,5,"",0,0,'L');
                $pdf->Cell(20,5,"Kepada Yth",0,1,'L');
                $pdf->Cell(90,5,"",0,0,'L');
                $pdf->Cell(20,5,"Pengguna Anggaran",0,1,'L');
                $pdf->Cell(90,5,"",0,0,'L');
                $pdf->Multicell(90,5,"SKPD $nm_skpd",0,'L');
                $pdf->Cell(10,5,"",0,1,'L');//jarak
                $pdf->Cell(90,5,"",0,0,'L');
                $pdf->Cell(20,5,"di -",0,1,'L');
                $pdf->Cell(100,5,"",0,0,'L');
                $pdf->Cell(20,5,"AGATS",0,1,'L');
                $pdf->Cell(10,5,"",0,1,'L');
                $pdf->Multicell(150,4,"                 Dengan memperhatikan ketentuan tertera dalam Peraturan Bupati Kabupaten Asmat No : tentang Penjabaran APBD, bersama ini kami mengajukan Surat Permintaan Pembayaran sebagai berikut :",0,'L');
                $pdf->Cell(10,5,"a.",0,0,'L');
                $pdf->Cell(50,5,"Jumlah Pembayaran yang diminta     :",0,0,'L');
                $pdf->Cell(50,5,"{Tranksaksi}     :",0,1,'L');
                $pdf->Cell(60,5,"",0,0,'L');
                $pdf->Cell(50,5,"{Terbilang}     :",0,1,'L');
                $pdf->Cell(10,5,"b.",0,0,'L');
                $pdf->Cell(50,5,"Untuk keperluan                                 :",0,1,'L');
                $pdf->Cell(10,5,"c.",0,0,'L');
                $pdf->Cell(50,5,"Nama Bendahara Pengeluaran",0,1,'L');
                $pdf->Cell(10,5,"",0,0,'L');
                $pdf->Cell(50,5,"/ Pihak Ketiga                                     : {$bendahara}",0,1,'L');
                $pdf->Cell(10,5,"d.",0,0,'L');
                $pdf->Cell(50,5,"Alamat                                                :",0,1,'L');

                $pdf->Cell(10,5,"e.",0,0,'L');
                $pdf->Cell(50,5,"No. Rekening Bank                            : {$rekening}",0,1,'L');
                $pdf->Cell(110,15,"",0,0,'L');
                $pdf->Cell(30,15,"",0,1,'L');
                $pdf->Cell(110,5,"",0,0,'L');
                $pdf->Cell(30,5,"AGATS,     $tanggal $c_bulan $tahun",0,1,'L');
                $pdf->Cell(110,5,"",0,0,'L');
                $pdf->Cell(30,5,"Bendahara Pengeluaran",0,1,'L');
                $pdf->Cell(30,20,"",0,1,'L');//JARAK
                $pdf->Cell(100,5,"",0,0,'L');//JARAK
                $pdf->Cell(50,5,"{$bendahara}",0,1,'C');
                $pdf->Cell(100,5,"",0,0,'L');//JARAK
                $pdf->Cell(50,5,"{$nip_bend}",0,1,'C');


                $pdf->SetFont('Arial','',12); // font dan ukuran font

  
                $pdf->Output();
            
        }
	}
