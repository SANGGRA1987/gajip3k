<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Export extends CI_Controller {

	public function index()
	{	
		$data = array(
			'page'	 	=> 'Export Data Gaji P3K',
			'judul'		=> 'Export Data Gaji P3K',
			'deskripsi'	=> 'Export Data Gaji P3K'
		);

		$this->template->views('utilitas/V_Export', $data);
	}

	/*function proses(){       
		$sql = "COPY (SELECT * FROM pegawai order by nama) TO 'D:/pegawai.csv' DELIMITER ',' CSV HEADER";
        $query = $this->db->query($sql);  
        
        echo 'Proses Export Gaji P3K Berhasil. File disimpan di Drive D dengan nama pegawai.csv';	
 	}*/

 	function proses(){
 		$cRet ='';
		$cRet .="
			<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">
			<tr>
				<td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">nip_lama</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">nip</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">nama</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">nokartu</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">seks</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kota</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">agama</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">stskawin</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">anak</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">satkerja</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">unit</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">stspegawai</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">golongan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">masa_tahun</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">eselon</td>
    			<td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kdbantu</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kdguru</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">gapok</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tistri</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tanak</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tpp</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kenaikan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tstruk</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tfung</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tkespeg</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">bulat</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">beras</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">pph</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">bruto</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">iwp</td>                    
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">sewa</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tunggakan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tabungan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">hutang</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">lain</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">potongan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">netto</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">ket</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">rekening</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">pensiun</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">skorsing</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">photo_file</td>
    			<td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">notes</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">photo</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">papua</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kd_beras</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kd_fung</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tdt</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">disc</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">status</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kd_daerah</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">nip2</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">askes</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">npwp</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">lahir</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tmt_pns</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tmt_pangkat</td>                    
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tmt_berkala</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">sk_jab</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">sk_fung</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">masa_bulan</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jkk</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">jkm</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">khusus</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">tht</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kd_khusus</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">umum</td>
                <td align=\"center\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">kd_pil</td>
    		</tr>";

    		$sql="SELECT * FROM pegawai order by nama;";
			$query = $this->db->query($sql);

			foreach ($query->result() as $row) {
				$cnip_lama =$row->nip_lama ;
				$cnip =$row->nip ;
				$cnama =$row->nama ;
				$cnokartu =$row->nokartu ;
				$cseks =$row->seks ;
				$ckota =$row->kota ;
				$cagama =$row->agama ;
				$cstskawin =$row->stskawin ;
				$canak =$row->anak ;
				$csatkerja =$row->satkerja ;
				$cunit =$row->unit ;
				$cstspegawai =$row->stspegawai ;
				$cgolongan =$row->golongan ;
				$cmasa_tahun =$row->masa_tahun ;
				$ceselon =$row->eselon ;
				$ckdbantu =$row->kdbantu ;
				$ckdguru =$row->kdguru ;
				$cgapok =$row->gapok ;
				$ctistri =$row->tistri ;
				$ctanak =$row->tanak ;
				$ctpp =$row->tpp ;
				$ckenaikan =$row->kenaikan ;
				$ctstruk =$row->tstruk ;
				$ctfung =$row->tfung ;
				$ctkespeg =$row->tkespeg ;
				$cbulat =$row->bulat ;
				$cberas =$row->beras ;
				$cpph =$row->pph ;
				$cbruto =$row->bruto ;
				$ciwp =$row->iwp ;
				$csewa =$row->sewa ;
				$ctunggakan =$row->tunggakan ;
				$ctabungan =$row->tabungan ;
				$chutang =$row->hutang ;
				$clain =$row->lain ;
				$cpotongan =$row->potongan ;
				$cnetto =$row->netto ;
				$cket =$row->ket ;
				$crekening =$row->rekening ;
				$cpensiun =$row->pensiun ;
				$cskorsing =$row->skorsing ;
				$cphoto_file =$row->photo_file ;
				$cnotes =$row->notes ;
				$cphoto =$row->photo ;
				$cpapua =$row->papua ;
				$ckd_beras =$row->kd_beras ;
				$ckd_fung =$row->kd_fung ;
				$ctdt =$row->tdt ;
				$cdisc =$row->disc ;
				$cstatus =$row->status ;
				$ckd_daerah =$row->kd_daerah ;
				$cnip2 =$row->nip2 ;
				$caskes =$row->askes ;
				$cnpwp =$row->npwp ;
				$clahir =$row->lahir ;
				$ctmt_pns =$row->tmt_pns ;
				$ctmt_pangkat =$row->tmt_pangkat ;
				$ctmt_berkala =$row->tmt_berkala ;
				$csk_jab =$row->sk_jab ;
				$csk_fung =$row->sk_fung ;
				$cmasa_bulan =$row->masa_bulan ;
				$cjkk =$row->jkk ;
				$cjkm =$row->jkm ;
				$ckhusus =$row->khusus ;
				$ctht =$row->tht ;
				$ckd_khusus =$row->kd_khusus ;
				$cumum =$row->umum ;
				$ckd_pil =$row->kd_pil ;

			$cRet .="
   			         <tr>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">'$cnip_lama</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">'$cnip</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnama</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnokartu</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cseks</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckota</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cagama</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cstskawin</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$canak</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$csatkerja</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cunit</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cstspegawai</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cgolongan</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cmasa_tahun</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ceselon</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckdbantu</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckdguru</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cgapok</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctistri</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctanak</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctpp</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckenaikan</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctstruk</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctfung</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctkespeg</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cbulat</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cberas</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpph</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cbruto</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ciwp</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$csewa</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctunggakan</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctabungan</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$chutang</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$clain</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpotongan</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnetto</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cket</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$crekening</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpensiun</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cskorsing</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cphoto_file</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnotes</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cphoto</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cpapua</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckd_beras</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckd_fung</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctdt</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cdisc</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cstatus</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckd_daerah</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">'$cnip2</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$caskes</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cnpwp</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$clahir</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctmt_pns</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctmt_pangkat</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctmt_berkala</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$csk_jab</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$csk_fung</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cmasa_bulan</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjkk</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cjkm</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckhusus</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ctht</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckd_khusus</td>
                        <td align=\"right\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$cumum</td>
                        <td align=\"left\" border=\"1\" width=\"10%\" style=\"font-size:10px;\">$ckd_pil</td>		                        
                    </tr>";
            } 

    		$cRet .="</table>";
    		$data['prev']= $cRet;
			$judul  = 'ms_pegawai';
    		header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('transaksi/excel', $data);
 	}
	
	
 

}

