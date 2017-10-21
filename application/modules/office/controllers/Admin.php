<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//path : application/modules/office/models/admin

class admin extends Office_Controller {
    //put your code here
    public $data = array(
        'view' => 'admin/list_admin',
        'title' => 'Administrator',
        'link' => 'office/admin', 
        'menu' => 'admin', 
        'submenu' => 'admin'
    );

    public function __construct() {
        parent::__construct();
        $this->load->library('breadcrumbs');
        
        $this->breadcrumbs->push('<i class="glyphicon glyphicon-home"></i> Dashboard', 'office/dashboard', 9);
        $this->breadcrumbs->push('Administrator', 'office/admin', 8);
        
        $this->load->model('model_admin', 'm_admin');
	}

    public function _validasi_add()
    { 
		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		$this->form_validation->set_rules('usernm', 'usernm', 'trim|required');
		$this->form_validation->set_rules('passwd', 'passwd', 'trim|required');
		$this->form_validation->set_rules('level', 'level', 'trim|required');
		$this->form_validation->set_rules('stts_login', 'stts_login', 'trim|required');

		$this->form_validation->set_error_delimiters('<span class="text-danger small">* ', '</span>');
    }
    public function add()
    {
        $this->data['view'] = 'admin/form_admin';
        $this->data['title'] = 'Form Administrator';
        $this->data['form_action'] = 'office/admin/add';

        $this->breadcrumbs->push('Add Administrator', 'office/admin/add', 7);
        if ($this->session->userdata('level') == 1) {
             if($this->input->post('submit')) {
                $this->_validasi_add();
                if($this->form_validation->run()) {
                    $id = $this->m_admin->kode_uuid();
                    $info = array(
                        'id_admin' => $id,
						'nama' => $this->input->post('nama'),
						'usernm' => $this->input->post('usernm'),
						'passwd' => md5($this->input->post('passwd')),
						'level' => $this->input->post('level'),
						'stts_login' => $this->input->post('stts_login'),
					);

                    if($this->m_admin->simpan($info) == TRUE) {
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
            redirect('office/admin');
        }
            
    }

    public function _validasi_edit()
    {
		$this->form_validation->set_rules('nama', 'nama', 'trim|required');
		$this->form_validation->set_rules('usernm', 'usernm', 'trim|required');
		$this->form_validation->set_rules('passwd', 'passwd', 'trim');
		$this->form_validation->set_rules('level', 'level', 'trim|required');
		$this->form_validation->set_rules('stts_login', 'stts_login', 'trim|required');

		$this->form_validation->set_error_delimiters('<span class="text-danger small">* ', '</span>');
    }

    public function edit($kode = NULL)
    {
        $this->breadcrumbs->push('Edit Administrator', 'office/admin/edit/'.$kode, 8);
        
        $this->data['view'] = 'admin/form_admin';
        $this->data['form_action'] = 'office/admin/edit/'.$kode;
        if ($this->session->userdata('level') == 1) { //cek level user
            if(!empty($kode)) {
                
                if($this->input->post('submit')) {
                    $this->_validasi_edit();

                    $pass = $this->input->post('passwd');

                    if($this->form_validation->run()) {
                        if(!empty($pass)) {
                            $info = array(
                                'nama' => $this->input->post('nama'),
                                'usernm' => $this->input->post('usernm'),
                                'passwd' => md5($pass),
                                'level' => $this->input->post('level'),
                                'stts_login' => $this->input->post('stts_login'),
                            );
                        } else {
                            $info = array(
                                'nama' => $this->input->post('nama'),
                                'usernm' => $this->input->post('usernm'),
                                'level' => $this->input->post('level'),
                                'stts_login' => $this->input->post('stts_login'),
                            );
                        }
                            
                        
                        $id = $this->session->userdata('id_admin_sekarang');
                        if($this->m_admin->edit($info, $id)) {
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
                    
                    $admin = $this->m_admin->cari($kode);
                    if($admin) {
                        foreach ($admin as $key => $value)
                        {
                            $this->data['form_value'][$key] = $value;
                        }
                        $this->session->set_userdata('id_admin_sekarang', $admin->id_admin);

                        $this->load->view('template', $this->data);
                    } else {
                        redirect('office/admin');
                    }
                    
                }
                
            } else {
                redirect('office/admin');
            }
                 
        } else {
            $this->session->set_flashdata('message_error', "Don't access your level!");
            redirect('office/admin');
        }
    }

    //function hapus
    public function hapus($id = NULL)
    {
        if(!empty($id)) {
            if ($this->session->userdata('level') == 1) { //cek level user
                if($this->m_admin->hapus($id) == TRUE) {
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
                redirect('office/admin');
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

        $config['base_url'] = site_url('office/admin/index/');
        $config['total_rows'] = $this->m_admin->total_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;

        $config['suffix'] = (!empty($_GET)) ? '?'.http_build_query($_GET, '', "&") : '';
        $config['first_url'] = $config['base_url'] . $config['suffix'];

        $this->pagination->initialize($config);

        $start = $this->uri->segment(4, 0);
        $admin = $this->m_admin->index_limit($config['per_page'], $start);
        if($admin) {
            $this->data['admin_data'] = $admin;
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