<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_bank
 *
 * @author Bujang Jantan
 */
class model_penilaian extends CI_Model {
    //put your code here
    public $table = 'penilaian';

    public function kode_uuid()
    {
        $uuid = $this->db->query("SELECT uuid() AS kode")->row();
        return $uuid->kode;
    }

    public function simpan($info, $info2)
    {
        $this->db->trans_begin();

        $this->db->insert($this->table, $info);
        $this->db->insert_batch('penilaian_det', $info2);

        if($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;            
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
       
    }
    
}
