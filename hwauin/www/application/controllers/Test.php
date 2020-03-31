<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function index()
    {
        $this->load->view('admin_header');
        $this->load->view('test');
        $this->load->view('admin_footer');

    }
}
