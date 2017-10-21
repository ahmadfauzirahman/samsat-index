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
class model_faktor extends CI_Model {
    //put your code here
    public $table = 'faktor';

    public function cari_semua()
    {
        return $this->db->order_by('urutan', 'ASC')
                        ->where('status', 'Y')
                        ->get($this->table)->result();
    }
	
	
}