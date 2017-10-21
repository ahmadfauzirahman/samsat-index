<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//path : application/modules/office/models/faktor

class faktor extends Office_Controller {
    //put your code here
    public $data = array(
        'view' => 'faktor/list_faktor',
        'title' => 'Faktor',
        'link' => 'office/faktor'
    );

    public function __construct() {
        parent::__construct();
        $this->load->library('breadcrumbs');
        
        $this->breadcrumbs->push('<i class="glyphicon glyphicon-home"></i> Dashboard', 'office/dashboard', 9);
        $this->breadcrumbs->push('Faktor', 'office/faktor', 8);
        
        $this->load->model('model_faktor', 'm_faktor');
	}

    public function _validasi_add()
    { 
		$this->form_validation->set_rules('isi_faktor', 'isi_faktor', 'trim|required');
		$this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim');
		$this->form_validation->set_rules('urutan', 'urutan', 'trim|required|numeric');

		$this->form_validation->set_error_delimiters('<span class="text-danger small">* ', '</span>');
    }
    
    public function add()
    {
        $this->data['view'] = 'faktor/form_faktor';
        $this->data['title'] = 'Form Faktor';
        $this->data['form_action'] = 'office/faktor/add';

        $this->breadcrumbs->push('Add Faktor', 'office/faktor/add', 7);
        if ($this->session->userdata('level') == 1) {
             if($this->input->post('submit')) {
                $this->_validasi_add();
                if($this->form_validation->run()) {
                    $id = $this->m_faktor->kode_uuid();
                    $info = array(
                        'id_faktor' => $id,
						'isi_faktor' => $this->input->post('isi_faktor'),
						'status' => $this->input->post('status'),
                        'keterangan' => $this->input->post('keterangan'),
						'urutan' => $this->input->post('urutan'),
					);

                    if($this->m_faktor->simpan($info) == TRUE) {
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
            redirect('office/faktor');
        }
            
    }

    public function _validasi_edit()
    {
		$this->form_validation->set_rules('isi_faktor', 'isi_faktor', 'trim|required');
		$this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim');
		$this->form_validation->set_rules('urutan', 'urutan', 'trim|required|numeric');

		$this->form_validation->set_error_delimiters('<span class="text-danger small">* ', '</span>');
    }

    public function edit($kode = NULL)
    {
        $this->breadcrumbs->push('Edit Faktor', 'office/faktor/edit/'.$kode, 8);
        
        $this->data['view'] = 'faktor/form_faktor';
        $this->data['form_action'] = 'office/faktor/edit/'.$kode;
        if ($this->session->userdata('level') == 1) { //cek level user
            if(!empty($kode)) {
                
                if($this->input->post('submit')) {
                    $this->_validasi_edit();
                    
                    if($this->form_validation->run()) {
                        $info = array(
							'isi_faktor' => $this->input->post('isi_faktor'),
							'status' => $this->input->post('status'),
                            'keterangan' => $this->input->post('keterangan'),
							'urutan' => $this->input->post('urutan'),
						);
                        
                        $id = $this->session->userdata('id_faktor_sekarang');
                        if($this->m_faktor->edit($info, $id)) {
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
                    
                    $faktor = $this->m_faktor->cari($kode);
                    if($faktor) {
                        foreach ($faktor as $key => $value)
                        {
                            $this->data['form_value'][$key] = $value;
                        }
                        $this->session->set_userdata('id_faktor_sekarang', $faktor->id_faktor);

                        $this->load->view('template', $this->data);
                    } else {
                        redirect('office/faktor');
                    }
                    
                }
                
            } else {
                redirect('office/faktor');
            }
                 
        } else {
            $this->session->set_flashdata('message_error', "Don't access your level!");
            redirect('office/faktor');
        }
    }

    //function hapus
    public function hapus($id = NULL)
    {
        if(!empty($id)) {
            if ($this->session->userdata('level') == 1) { //cek level user
                if($this->m_faktor->hapus($id) == TRUE) {
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
                redirect('office/faktor');
            }
        } else {
            echo"<script>
                window.history.back();
            </script>";
        }
        
    }

    public function index()
    {
		$this->load->helper('text');
        $this->load->library('pagination');

        $config['base_url'] = site_url('office/faktor/index/');
        $config['total_rows'] = $this->m_faktor->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;

        $config['suffix'] = (!empty($_GET)) ? '?'.http_build_query($_GET, '', "&") : '';
        $config['first_url'] = $config['base_url'] . $config['suffix'];

        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $faktor = $this->m_faktor->index_limit($config['per_page'], $start);
        if($faktor) {
            $this->data['faktor_data'] = $faktor;
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

//