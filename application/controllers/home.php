<?php

class Home extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if (! $this->session->userdata('logged_in')) {
            header('location:'.base_url());
            exit;
        }
    }

    public function index(){
        $this->load->view('header');
        $this->load->view('homevista');
        $this->load->view('footer');
    }



}