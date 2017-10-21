<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Yayasan_Controller
 *
 * @author ade
 */
class Office_Controller extends MX_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;
        
        $loginadmin = $this->session->userdata('loginadmin');
        
        if($loginadmin == FALSE)
        {
            redirect('auth');
        }
    }
}
