<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * Author Faiz Zainol
	 *
	 * 
	 */
	public function __construct() {
		parent::__construct();
	}

	public function index()
	{	
		$this->load->view('login');
	}

	public function admin()
	{
		$oto = $this->session->userdata('oto');	
		$skpd= $this->session->userdata('kd_skpd');	
		$and="";
		$where="";
			if($oto!='01'){
				$where = "WHERE a.kd_skpd= '$skpd'";
				$and   = "where a.kd_skpd=b.kd_skpd";
	}
	
	$sql = "select 
		(select count(b.nilai) from transaksi.trkib_a b $and) as kiba,
		(select count(b.nilai) from transaksi.trkib_b b $and) as kibb,
		(select count(b.nilai) from transaksi.trkib_c b $and) as kibc,
		(select count(b.nilai) from transaksi.trkib_d b $and) as kibd,
		(select count(b.nilai) from transaksi.trkib_e b $and) as kibe,
		(select count(b.nilai) from transaksi.trkib_f b $and) as kibf
		from mskpd a $where";
        $query1 = $this->db->query($sql); $row=$query1->row();
		
		$data['page'] 			= "home";
		$data['judul'] 			= "Login Simgaji";
		$data['deskripsi'] 		= "Manage Data CRUD";
		$data['kiba']			= $row->kiba;
		$data['kibb']			= $row->kibb;
		$data['kibc']			= $row->kibc;
		$data['kibd']			= $row->kibd;
		$data['kibe']			= $row->kibe;
		$data['kibf']			= $row->kibf;
		$this->template->views('home', $data);
	}
	
	public function fungsi(){
		
		$data['page'] 			= "Satuan";
		$data['judul'] 			= "Master Tabel Satuan";
		$data['deskripsi'] 		= "Satuan";
		
		$this->template->views('fungsi', $data);
	}
	
	public function toast(){
		
		$data['page'] 			= "Toast";
		$data['judul'] 			= "Master Tabel Satuan";
		$data['deskripsi'] 		= "Toast";
		
		$this->template->views('toast', $data);
	}	
	public function rekanan(){
		
		$data['page'] 			= "Toast";
		$data['judul'] 			= "Master Tabel Satuan";
		$data['deskripsi'] 		= "Toast";
		
		$this->template->views('rekanan', $data);
	}
	
	function insert_data() {
	
		$data['page'] 			= "Toast";
		$data['judul'] 			= "Master Tabel Satuan";
		$data['deskripsi'] 		= "Toast";
    $kata = $this->input->post('kata');
    if($kata == null) {
        $this->session->set_flashdata('msg', 
                '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:14px">
				        	Anda berhasil input kata</div>
					  </div>
				    </p>');    
		$this->template->views('rekanan', $data);
    } else {    
			$this->session->set_flashdata('msg', 
					'<div class="alert alert-success">
						<h4>Berhasil </h4>
						<p>Anda berhasil input kata '.$kata.'.</p>
					</div>');    
			$this->template->views('rekanan', $data);
		};
	}

	
	
	function getData() {
       /*  $result = array();
        $row = array();
      	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	    $offset = ($page-1)*$rows; */
		
		/* $sql = "SELECT count(*) as tot from msatuan" ;
        $query1 = $this->db->query($sql);
        $total = $query1->row(); */
		$skpd = $this->input->post('skpd');
        $sql = "select 
		(select sum(b.nilai) from transaksi.trkib_a b where a.kd_skpd=b.kd_skpd) as kiba,
		(select sum(b.nilai) from transaksi.trkib_b b where a.kd_skpd=b.kd_skpd) as kibb,
		(select sum(b.nilai) from transaksi.trkib_c b where a.kd_skpd=b.kd_skpd) as kibc,
		(select sum(b.nilai) from transaksi.trkib_d b where a.kd_skpd=b.kd_skpd) as kibd,
		(select sum(b.nilai) from transaksi.trkib_e b where a.kd_skpd=b.kd_skpd) as kibc,
		(select sum(b.nilai) from transaksi.trkib_f b where a.kd_skpd=b.kd_skpd) as kibf
		from mskpd a WHERE a.kd_skpd= '1.01.05.01.00'";
        $query1 = $this->db->query($sql);  
       /*  $result = array();
        $ii = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $row[] = array(
                        'id' => $ii,        
                        'kd_satuan' => $resulte['kd_satuan'],
                        'nm_satuan' => $resulte['nm_satuan']					
                        );
                        $ii++;
        }
           
        $result["total"] = $total->tot;
        $result["rows"] = $row;  */
        return json_encode($query1);
    	   
	}
	
}
