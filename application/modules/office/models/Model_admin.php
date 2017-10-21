<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//path : application/modules/office/models/model_admin

class model_admin extends CI_Model {
    //put your code here
    public $table = 'admin';

    public function kode_uuid()
    {
        $uuid = $this->db->query("SELECT uuid() AS kode")->row();
        return $uuid->kode;
    }
    
    public function cari($kode)
    {
        return $this->db->where('id_admin', $kode)
                        ->get($this->table)->row();
    }

    public function cari_semua()
    {
        return $this->db->order_by('id_admin', 'ASC')
                        ->get($this->table)->result();
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
    
    public function edit($info, $id)
    {
        $this->db->where('id_admin', $id)
                 ->update($this->table, $info);
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

    public function hapus($id)
    {
        $this->db->where('id_admin', $id)
                 ->delete($this->table);

        if($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function total_rows()
    {
        if(!empty($_GET['keyword'])) {
            return $this->db->from($this->table)
                            ->like('id_admin', $_GET['keyword'])
						->or_like('nama', $_GET['keyword'])
						->or_like('usernm', $_GET['keyword'])
						->or_like('passwd', $_GET['keyword'])
						->or_like('level', $_GET['keyword'])
						->or_like('stts_login', $_GET['keyword'])->count_all_results();
        } else {
            return $this->db->from($this->table)
                        ->count_all_results();    
        }
        
    }
    
    public function index_limit($limit, $start = 0)
    {
        if(!empty($_GET['keyword'])) {
            return $this->db->order_by('id_admin', 'ASC')
                        ->like('id_admin', $_GET['keyword'])
						->or_like('nama', $_GET['keyword'])
						->or_like('usernm', $_GET['keyword'])
						->or_like('passwd', $_GET['keyword'])
						->or_like('level', $_GET['keyword'])
						->or_like('stts_login', $_GET['keyword'])->limit($limit, $start)
                        ->get($this->table)->result();
        } else {
            return $this->db->order_by('id_admin', 'ASC')
                        ->limit($limit, $start)
                        ->get($this->table)->result();    
        }

        
    }
}