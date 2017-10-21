<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dashboard
 *
 * @author ade
 */
class dashboard extends Office_Controller {
    //put your code here
    public $data = array(
        'title' => 'Dashboard',
        'view' => 'dashboard'
    );
    
    public function __construct() {
        parent::__construct();
        $this->load->model('model_penilaian', 'm_penilaian');

        $this->load->library('breadcrumbs');
        
        $this->breadcrumbs->push('<i class="glyphicon glyphicon-home"></i> Dashboard', 'office/dashboard', 9);
    }
    
    public function index()
    {
        $this->load->helper('tglindo');
        $penilaian = $this->m_penilaian->cari_penilaian();
        if($penilaian) {
            $this->data['data_penilaian'] = $penilaian;
        }

        $this->load->view('template', $this->data);
        
    }
}
