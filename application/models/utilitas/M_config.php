<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class M_config extends CI_Model {
		
	public function load_config() {
		$this->db->select('*');
		$this->db->from('config');

		$data = $this->db->get();
		if ($data->num_rows() == 1) {
			return $data->row();
		} else {
			return false;
		}
	}
	
	function simpan_pemda($post){
		$thang 		= $post['thang'];
		$periode 	= $post['periode'];
		$spm		= $post['spm'];
		$kota		= $post['kota'];
		$ankep		= $post['ankep'];
		$jbankep	= $post['jbankep'];
		$pangkep	= $post['pangkep'];
		$nipankep	= $post['nipankep'];
		$kpkeu		= $post['kpkeu'];
		$jbkpkeu	= $post['jbkpkeu'];
		$nipkpkeu	= $post['nipkpkeu'];
		$kabkep		= $post['kabkep'];
		$jkabkep	= $post['jkabkep'];
		$nipkabkep	= $post['nipkabkep'];
		$bpangkep	= $post['bpangkep'];
		$kep		= $post['kep'];
		$jbkep		= $post['jbkep'];
		$nipkep		= $post['nipkep'];
		$pkd		= $post['pkd'];
		$jbpkd		= $post['jbpkd'];
		$nippkd		= $post['nippkd'];
		$nmsekda	= $post['nmsekda'];
		$pangsekda	= $post['pangsekda'];
		$nipsekda	= $post['nipsekda']; 
		
			$query = "UPDATE public.config SET 					 		
					thang		= '$thang',
					periode		= '$periode',
					spm			= '$spm',
					kota		= '$kota',
					ankep		= '$ankep',
					jbankep		= '$jbankep',
					pangkep		= '$pangkep',
					nipankep	= '$nipankep',
					kpkeu		= '$kpkeu',
					jbkpkeu		= '$jbkpkeu',
					nipkpkeu	= '$nipkpkeu',
					kabkep		= '$kabkep',
					jkabkep		= '$jkabkep',
					nipkabkep	= '$nipkabkep',
					bpangkep	= '$bpangkep',
					kep			= '$kep',
					jbkep		= '$jbkep',
					nipkep		= '$nipkep',
					pkd			= '$pkd',
					jbpkd		= '$jbpkd',
					nippkd		= '$nippkd',
					nmsekda		= '$nmsekda',
					pangsekda	= '$pangsekda',
					nipsekda	= '$nipsekda' "; 

		 		$sql = $this->db->query($query);
		try{
			if ($sql) {
				return 1;
				$sql->free_result();
			} else {
				return 0;
			}

		} catch (Exception $e) {
			return 0;
		}
		
	}

	public function get() { 

        $sql="select * from public.config";

        $query1 = $this->db->query($sql);

        $result = array();
        $ii     = 0;
        foreach($query1->result_array() as $resulte)
        { 
            $result[] = array(
                        'thang'     => $resulte['thang'],
                        'periode'     => $resulte['periode'],
                        'spm'	=> $resulte['spm'],
						'kota'	=> $resulte['kota'],
						'ankep'	=> $resulte['ankep'],
						'jbankep'	=> $resulte['jbankep'],
						'pangkep'	=> $resulte['pangkep'],
						'nipankep'	=> $resulte['nipankep'],
						'kpkeu'	=> $resulte['kpkeu'],
						'jbkpkeu'	=> $resulte['jbkpkeu'],
						'nipkpkeu'	=> $resulte['nipkpkeu'],
						'kabkep'	=> $resulte['kabkep'],
						'jkabkep'	=> $resulte['jkabkep'],
						'nipkabkep'	=> $resulte['nipkabkep'],
						'bpangkep'	=> $resulte['bpangkep'],
						'kep'	=> $resulte['kep'],
						'jbkep'	=> $resulte['jbkep'],
						'nipkep'	=> $resulte['nipkep'],
						'pkd'	=> $resulte['pkd'],
						'jbpkd'	=> $resulte['jbpkd'],
						'nippkd'	=> $resulte['nippkd'],
						'nmsekda'	=> $resulte['nmsekda'],
						'pangsekda'	=> $resulte['pangsekda'],
						'nipsekda'	=> $resulte['nipsekda']
                        );
                        $ii++;
        }
        return $result;
	}

	
}

?>