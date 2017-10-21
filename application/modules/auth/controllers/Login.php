<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author ade
 */
class login extends CI_Controller {
    //put your code here
    public $data = array(
        'title' => 'Login'
    );
    
    public function __construct() {
        parent::__construct();
        
        $this->load->model('model_login', 'm_login');
    }

    public function index()
    {
        $this->load->helper('security');
        
        if($this->session->userdata('loginadmin'))
        {
            $level = $this->session->userdata('level');
            if($level == "1")
            {
                redirect('office/dashboard');
            }
        }
        else
        {
            $this->_validasi_login();

            if($this->form_validation->run())
            {
                $log = $this->m_login->cek_login();
                if($log)
                {
                    $_SESSION['KCFINDER'] = array(
                        'disabled' => FALSE,
                        'uploadURL' => base_url().'assets/gambar/',
                        'uploadDir' => ''
                    );

                    $this->session->set_flashdata('message_success', 'Berhasil login.');
                    redirect('office/dashboard');  
                    
                }
                else
                {
                    $this->data['pesan_error'] = 'Login gagal, cek kembali username dan password anda!<br>'
                            . 'Silahkan diulangi kembali';
                    $this->load->view('login', $this->data);
                }

            }
            else
            {
                $this->load->view('login', $this->data);
            }
        }
    }
    
    public function _validasi_login()
    {
        $this->form_validation->set_rules('usernm', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pass', 'Password', 'trim|required|xss_clean');
        
        $this->form_validation->set_error_delimiters("<span class=\"text-danger\">* ", "</span>");
    }
    
    public function logout()
    {
        $this->m_login->logout();
        redirect('auth');
    }
}
