<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author ade
 */
class penilaian extends CI_Controller {
	public $data = array(
		'view' => 'penilaian'
	);

    public function __construct() {
        parent::__construct();
        $this->load->helper('text');
        $this->load->library('breadcrumbs');
		
		$this->load->model('model_faktor', 'm_faktor');
		$this->load->model('model_penilaian', 'm_penilaian');
    }

    public function sukses()
    {
        $this->data['view'] = 'sukses';

        $this->load->view('template', $this->data); 
    }
	
    public function index()
    {
        $this->load->helper('tglindo');
		$this->data['form_action'] = 'penilaian';
		
		if($this->input->post('submit')) {
			$kode = $this->m_penilaian->kode_uuid();
			$tgltime = date('Y-m-d H:i:s');
			
			$puas = 0;
			$tidak_puas = 0;
			
			$info2 = array();
			foreach($this->input->post('rowNum') as $i) {
				if($this->input->post('puas_'.$i) == '1') {
					$puas += 50;
				} else {
					$tidak_puas += 50;
				}
				
				$info2[] = array(
					'id_penilaian' => $kode,
					'id_faktor' => $this->input->post('kode_'.$i),
					'nilai' => $this->input->post('puas_'.$i)
				);
	
			}
			
			$info = array(
				'id_penilaian' => $kode,
				'ip_com' => $this->input->ip_address(),
				'tgltime' => $tgltime,
				'puas' => $puas,
				'tidak_puas' => $tidak_puas
			);
			
			if($this->m_penilaian->simpan($info, $info2) == TRUE) {
				redirect('penilaian/sukses');
			} else {
				redirect('penilaian');
			}

		} else {
			$faktor = $this->m_faktor->cari_semua();
			if($faktor) {
				$this->data['data_faktor'] = $faktor;
			}
			
			$this->load->view('template', $this->data);
		}
		
    }

}