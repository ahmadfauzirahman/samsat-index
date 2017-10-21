<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//path : application/modules/office/models/saran

class saran extends Office_Controller {
    //put your code here
    public $data = array(
        'view' => 'saran/list_saran',
        'title' => 'Saran-saran',
        'link' => 'office/saran', 
        'menu' => 'saran', 
        'submenu' => 'saran'
    );

    public function __construct() {
        parent::__construct();
        $this->load->library('breadcrumbs');
        
        $this->breadcrumbs->push('<i class="glyphicon glyphicon-home"></i> Dashboard', 'office/dashboard', 9);
        $this->breadcrumbs->push('Saran-saran', 'office/saran', 8);
        
        $this->load->model('model_saran', 'm_saran');
	}

    public function _validasi_add()
    { 
		$this->form_validation->set_rules('tgltime', 'tgltime', 'trim|required');
		$this->form_validation->set_rules('isi_saran', 'isi_saran', 'trim|required');
		$this->form_validation->set_rules('ip_com', 'ip_com', 'trim|required');

		$this->form_validation->set_error_delimiters('<span class="text-danger small">* ', '</span>');
    }
    public function add()
    {
        $this->data['view'] = 'saran/form_saran';
        $this->data['title'] = 'Form Saran-saran';
        $this->data['form_action'] = 'office/saran/add';

        $this->breadcrumbs->push('Add Saran-saran', 'office/saran/add', 7);
        if ($this->session->userdata('level') == 1) {
             if($this->input->post('submit')) {
                $this->_validasi_add();
                if($this->form_validation->run()) {
                    $id = $this->m_saran->kode_uuid();
                    $info = array(
                        'id_saran' => $id,
						'tgltime' => $this->input->post('tgltime'),
						'isi_saran' => $this->input->post('isi_saran'),
						'ip_com' => $this->input->post('ip_com'),
					);

                    if($this->m_saran->simpan($info) == TRUE) {
                        $this->session->set_flashdata('message_success', 'Berhasil menambah data');
                        echo"<script>
                            window.history.go(-2);
                        </script>";
                    } else {
                        $this->data['pesan_error'] = 'Gagal menambah data';
                        $this->load->view('template', $this->data);
                    }

                } else {
                    $this->data['pesan_warning'] = 'Terjadi kesalahan.';
                    $this->load->view('template', $this->data);
                }
            } else {
                $this->load->view('template', $this->data);
            }
        } else {
            $this->session->set_flashdata('message_error', "Don't access your level!");
            redirect('office/saran');
        }
            
    }

    public function _validasi_edit()
    {
		$this->form_validation->set_rules('tgltime', 'tgltime', 'trim|required');
		$this->form_validation->set_rules('isi_saran', 'isi_saran', 'trim|required');
		$this->form_validation->set_rules('ip_com', 'ip_com', 'trim|required');

		$this->form_validation->set_error_delimiters('<span class="text-danger small">* ', '</span>');
    }

    public function edit($kode = NULL)
    {
        $this->breadcrumbs->push('Edit Saran-saran', 'office/saran/edit/'.$kode, 8);
        
        $this->data['view'] = 'saran/form_saran';
        $this->data['form_action'] = 'office/saran/edit/'.$kode;
        if ($this->session->userdata('level') == 1) { //cek level user
            if(!empty($kode)) {
                
                if($this->input->post('submit')) {
                    $this->_validasi_edit();
                    
                    if($this->form_validation->run()) {
                        $info = array(
							'tgltime' => $this->input->post('tgltime'),
							'isi_saran' => $this->input->post('isi_saran'),
							'ip_com' => $this->input->post('ip_com'),
						);
                        
                        $id = $this->session->userdata('id_saran_sekarang');
                        if($this->m_saran->edit($info, $id)) {
                            $this->session->set_flashdata('message_success', 'Berhasil melakukan edit.');

                            echo"<script>
                                window.history.go(-2);
                            </script>";
                        } else {
                            $this->session->set_flashdata('message_error', 'Gagal melakukan perubahan/tidak ada perubahan data..');

                            redirect($this->data['form_action']);
                        }
                    } else {
                        $this->data['pesan_warning'] = 'Terjadi kesalahan';
                        $this->load->view('template', $this->data);
                    }
                    
                } else {
                    
                    $saran = $this->m_saran->cari($kode);
                    if($saran) {
                        foreach ($saran as $key => $value)
                        {
                            $this->data['form_value'][$key] = $value;
                        }
                        $this->session->set_userdata('id_saran_sekarang', $saran->id_saran);

                        $this->load->view('template', $this->data);
                    } else {
                        redirect('office/saran');
                    }
                    
                }
                
            } else {
                redirect('office/saran');
            }
                 
        } else {
            $this->session->set_flashdata('message_error', "Don't access your level!");
            redirect('office/saran');
        }
    }

    //function hapus
    public function hapus($id = NULL)
    {
        if(!empty($id)) {
            if ($this->session->userdata('level') == 1) { //cek level user
                if($this->m_saran->hapus($id) == TRUE) {
                    $this->session->set_flashdata('message_success', 'Proses hapus data berhasil.');
                    echo"<script>
                        window.history.back();
                    </script>";
                } else {
                    $this->session->set_flashdata('message_error', 'Gagal menghapus data!');
                    echo"<script>
                        window.history.back();
                    </script>";
                }
            } else {
                $this->session->set_flashdata('message_error', "Don't access your level!");
                redirect('office/saran');
            }
        } else {
            echo"<script>
                window.history.back();
            </script>";
        }
        
    }

    public function index()
    {
        $this->load->library('pagination');

        if ($this->session->userdata('level') == 1) {

            $config['base_url'] = site_url('office/saran/index/');
            $config['total_rows'] = $this->m_saran->total_rows();
            $config['per_page'] = 10;
            $config['uri_segment'] = 4;

            $config['suffix'] = (!empty($_GET)) ? '?'.http_build_query($_GET, '', "&") : '';
            $config['first_url'] = $config['base_url'] . $config['suffix'];

            $this->pagination->initialize($config);

            $start = $this->uri->segment(4, 0);
            $saran = $this->m_saran->index_limit($config['per_page'], $start);
            if($saran) {
                $this->data['saran_data'] = $saran;
                $this->data['pagination'] = $this->pagination->create_links();
                $this->data['start'] = $start;

                $this->data['total_semua'] = $config['total_rows'];

                $this->load->view('template', $this->data);
            } else {
                $this->data['pesan_warning'] = 'Data Not Found';
                $this->load->view('template', $this->data);
            }

        } else {
            $this->session->set_flashdata('message_error', "Don't access your level!");
            redirect('office/dashboard');
        }
    }
    
}

//