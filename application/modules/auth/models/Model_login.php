<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_login
 *
 * @author ade
 */
class model_login extends CI_Model {
    //put your code here
    public $table = "admin";
    
    public function cek_login()
    {
        $usernm = $this->input->post('usernm');
        $pass = md5($this->input->post('pass'));
        
        $login = $this->db->where('usernm', $usernm)
                          ->where('passwd', $pass)
                          ->where('stts_login', 'Y')
                          ->limit(1)
                          ->get($this->table);
        
        if($login->num_rows() > 0)
        {
            $data = array(
                'loginadmin' => TRUE,
                'usernm' => $usernm,
                'idadmin' => $login->row()->id_admin,
                'level' => $login->row()->level
            );
            $this->session->set_userdata($data);
            return TRUE;
        }
        else
        {
            return FALSE;
        }
                           
    }
    
    public function logout()
    {
        $data = array(
            'loginadmin' => FALSE,
            'usernm' => '',
            'idadmin' => '',
            'level' => ''
        );
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
    }
}
