<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of faktor
 *
 * @author Bujang Jantan
 */
class model_saran extends CI_Model {
    //put your code here
    public $table = 'saran';

    public function kode_uuid()
    {
        $uuid = $this->db->query("SELECT uuid() AS kode")->row();
        return $uuid->kode;
    }
    

    public function simpan($info)
    {
        $this->db->insert($this->table, $info);
        $affect = $this->db->affected_rows();
        if($affect > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
	
	
}