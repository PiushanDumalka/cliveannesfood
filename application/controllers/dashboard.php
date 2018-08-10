<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
         if (!isset($_SESSION)) {
            session_start();
        }
    }

    public function index() {
        $this->load->view('system/dashboard');
    }

}
