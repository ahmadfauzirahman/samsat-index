<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//path : application/modules/office/models/model_faktor

class model_faktor extends CI_Model {
    //put your code here
    public $table = 'faktor';

    public function kode_uuid()
    {
        $uuid = $this->db->query("SELECT uuid() AS kode")->row();
        return $uuid->kode;
    }
    
    public function cari($kode)
    {
        return $this->db->where('id_faktor', $kode)
                        ->get($this->table)->row();
    }

    public function cari_semua()
    {
        return $this->db->order_by('urutan', 'ASC')
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
        $this->db->where('id_faktor', $id)
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
        $this->db->where('id_faktor', $id)
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
                            ->like('id_faktor', $_GET['keyword'])
						->or_like('isi_faktor', $_GET['keyword'])
						->or_like('status', $_GET['keyword'])
						->or_like('urutan', $_GET['keyword'])->count_all_results();
        } else {
            return $this->db->from($this->table)
                        ->count_all_results();    
        }
        
    }
    
    public function index_limit($limit, $start = 0)
    {
        if(!empty($_GET['keyword'])) {
            return $this->db->order_by('urutan', 'ASC')
                        ->like('id_faktor', $_GET['keyword'])
						->or_like('isi_faktor', $_GET['keyword'])
						->or_like('status', $_GET['keyword'])
						->or_like('urutan', $_GET['keyword'])->limit($limit, $start)
                        ->get($this->table)->result();
        } else {
            return $this->db->order_by('urutan', 'ASC')
                        ->limit($limit, $start)
                        ->get($this->table)->result();    
        }

        
    }
}