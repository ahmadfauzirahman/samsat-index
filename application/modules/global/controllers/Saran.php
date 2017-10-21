<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Saran
 *
 * @author ade
 */
class saran extends CI_Controller {
	public $data = array(
		'view' => 'form_saran',
        'form_action' => 'saran'
	);

    public function __construct() {
        parent::__construct();
        $this->load->helper('text');
        $this->load->library('breadcrumbs');

        $this->load->model('model_saran', 'm_saran');
    }


    public function _validasi_saran()
    {
        $this->form_validation->set_rules('isi_saran', 'Saran-saran', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="text-danger small">* ', '</span>');
    }

    public function sukses()
    {
        $this->data['view'] = 'sukses';

        $this->load->view('template', $this->data); 
    }
    
    public function index()
    {
        $this->load->helper('tglindo');

        if ($this->input->post('submit')) {
            $this->_validasi_saran();

            if ($this->form_validation->run()) {
                $id = $this->m_saran->kode_uuid();

                $info = array(
                    'id_saran' => $id,
                    'tgltime' => date('Y-m-d H:i:s'),
                    'isi_saran' => $this->input->post('isi_saran'), 
                    'ip_com' => $this->input->ip_address()
                );

                if ($this->m_saran->simpan($info) === TRUE) {
                    redirect('saran/sukses');
                } else {
                    $this->load->view('template', $this->data);
                }

            } else {
                $this->load->view('template', $this->data);    
            }

            
        } else {
            $this->load->view('template', $this->data);    
        }
        
        
    }

}