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


    public function cari_semua()
    {
        return $this->db->get($this->table)->result();
    }

    public function cari_nilai_perfaktor($id_faktor)
    {
        return $this->db->select('a.*, b.*')
                        ->from('penilaian_det a')
                        ->join('penilaian b', 'a.id_penilaian = b.id_penilaian')
                        ->where('a.id_faktor', $id_faktor)
                        ->get()->result();
    }

    public function cari_nilai_perfaktor_periode($id_faktor, $tgl1, $tgl2)
    {
        return $this->db->select('a.*, b.*')
                        ->from('penilaian_det a')
                        ->join('penilaian b', 'a.id_penilaian = b.id_penilaian')
                        ->where('a.id_faktor', $id_faktor)
                        ->where('date(tgltime) >=', $tgl1)
                        ->where('date(tgltime) <=', $tgl2)
                        ->get()->result();
    }

    public function cari_nilaidet_faktor($id)
    {
        return $this->db->from('penilaian_det a')
                        ->join('faktor b', 'a.id_faktor = b.id_faktor', 'inner')
                        ->where('a.id_penilaian', $id)
                        ->order_by('b.urutan', 'ASC')
                        ->get()->result();
    }

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


    public function cari_penilaian()
    {
        $m = date('m');

        $query = "SELECT DATE(tgltime) AS tgl, COUNT(tgltime) AS total 
                    FROM penilaian 
                    WHERE MONTH(tgltime) = '$m' 
                    GROUP BY DATE(tgltime) LIMIT 10";

        return $this->db->query($query)->result();
    }

    public function cari_perperiode($tgl1, $tgl2)
    {
        return $this->db->order_by('tgltime', 'ASC')
                        ->where('date(tgltime) >=', $tgl1)
                        ->where('date(tgltime) <=', $tgl2)
                        ->get($this->table)->result(); 
    }

    public function total_rows()
    {
        if(!empty($_GET['keyword'])) {
            return $this->db->from($this->table)
                            ->like('ip_com', $_GET['keyword'])->count_all_results();
        } else {
            return $this->db->from($this->table)
                        ->count_all_results();    
        }
        
    }
    
    public function index_limit($limit, $start = 0)
    {
        if(!empty($_GET['keyword'])) {
            return $this->db->order_by('tgltime', 'DESC')
                        ->like('ip_com', $_GET['keyword'])->limit($limit, $start)
                        ->get($this->table)->result();
        } else {
            return $this->db->order_by('tgltime', 'DESC')
                        ->limit($limit, $start)
                        ->get($this->table)->result();    
        }

        
    }
    
}
