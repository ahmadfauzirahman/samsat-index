<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Petunjuk
 *
 * @author ade
 */
class petunjuk extends CI_Controller {
	public $data = array(
		'view' => 'petunjuk'
	);

    public function __construct() {
        parent::__construct();
        $this->load->helper('text');
        $this->load->library('breadcrumbs');
    }
    
    public function index()
    {
        $this->load->helper('tglindo');
        
        $this->load->view('template', $this->data);
    }

}