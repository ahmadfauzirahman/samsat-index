<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dashboard
 *
 * @author ade
 */
class laporan extends Office_Controller {
    //put your code here
    public $data = array(
        'title' => 'Semua Penilaian',
        'view' => 'laporan/list_penilaian',
        'link' => 'office/laporan'
    );

    public function __construct() {
        parent::__construct();
        $this->load->helper('text');
        $this->load->library('breadcrumbs');

        $this->breadcrumbs->push('<i class="glyphicon glyphicon-home"></i> Dashboard', 'office/dashboard', 9);
        $this->breadcrumbs->push('Laporan', 'office/laporan', 8);

        $this->load->model('model_penilaian', 'm_penilaian');
        $this->load->model('model_faktor', 'm_faktor');
    }

    public function grapik()
    {
        $this->data['title'] = 'Grafik Penilaian';
        $this->data['view'] = 'laporan/grap_penilaian';

        $this->breadcrumbs->push('Grafik Penilaian', 'office/laporan/grapik', 7);


        $penilaian = $this->m_penilaian->cari_semua();
        if ($penilaian) {
            $this->data['data_penilaian'] = $penilaian;
        }

        $this->load->view('template', $this->data);
    }


    public function grapikfaktor()
    {
        $this->data['title'] = 'Grafik Penilaian Per-Faktor';
        $this->data['view'] = 'laporan/grap_penilaian_faktor';

        $this->breadcrumbs->push('Grafik Penilaian Per-Faktor', 'office/laporan/grapikfaktor', 7);


        $faktor = $this->m_faktor->cari_semua();
        if ($faktor) {
            $this->data['data_faktor'] = $faktor;
        }

        $this->load->view('template', $this->data);
    }

    public function _validasi_cari()
    { 
        $this->form_validation->set_rules('tgl1', 'Tanggal', 'trim|required');
        $this->form_validation->set_rules('tgl2', 'Tanggal', 'trim|required');

        $this->form_validation->set_error_delimiters('<span class="text-danger small">* ', '</span>');
    }

    public function perperiode()
    {
        $this->load->helper('tglindo');

        $this->data['title'] = 'Grafik Penilaian Per-Periode';
        $this->data['view'] = 'laporan/penilaian_perperiode';
        $this->data['link'] = 'office/laporan/perperiode';

        $this->breadcrumbs->push('Penilaian Per-Periode', 'office/laporan/perperiode', 7);


        if ($this->input->post('submit')) {
            $this->_validasi_cari();

            if ($this->form_validation->run()) {
                $tgl1 = $this->input->post('tgl1');
                $tgl2 = $this->input->post('tgl2');

                $penilaian = $this->m_penilaian->cari_perperiode($tgl1, $tgl2);
                if ($penilaian) {
                    $this->data['penilaian_data'] = $penilaian;
                    $this->data['tgl1'] = $tgl1;
                    $this->data['tgl2'] = $tgl2;

                    $faktor = $this->m_faktor->cari_semua();
                    if ($faktor) {
                        $this->data['data_faktor'] = $faktor;
                    }

                    $this->load->view('template', $this->data);    
                } else {
                    redirect('office/laporan');
                }
            } else {
                $this->load->view('template', $this->data);    
            }
            
        } else {
            $this->load->view('template', $this->data);
        }

    }

    public function view($id = NULL)
    {
        $nilaifaktor = $this->m_penilaian->cari_nilaidet_faktor($id);
        if ($nilaifaktor) {
            $this->data['data_nilaifaktor'] = $nilaifaktor;
        }

        $this->load->view('laporan/list_view', $this->data);        
    }


    public function index()
    {
    	
    	$this->load->helper('text');
        $this->load->library('pagination');

        $config['base_url'] = site_url('office/laporan/index/');
        $config['total_rows'] = $this->m_penilaian->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;

        $config['suffix'] = (!empty($_GET)) ? '?'.http_build_query($_GET, '', "&") : '';
        $config['first_url'] = $config['base_url'] . $config['suffix'];

        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $penilaian = $this->m_penilaian->index_limit($config['per_page'], $start);
        if($penilaian) {
            $this->data['penilaian_data'] = $penilaian;
            $this->data['pagination'] = $this->pagination->create_links();
            $this->data['start'] = $start;

            $this->data['total_semua'] = $config['total_rows'];

            $this->load->view('template', $this->data);
        } else {
            $this->data['pesan_warning'] = 'Data Not Found';
            $this->load->view('template', $this->data);
        }
    }


}