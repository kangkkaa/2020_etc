<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Member_model');
    }
    public function index()
    {
        $this->load->view('admin_header');
        $this->load->view('admin');
        $this->load->view('admin_footer');
    }
    public function blank()
    {
        $this->load->view('admin_header');
        $this->load->view('blank');
        $this->load->view('admin_footer');
    }
    function table(){
        var_dump($this->session->all_userdata());
        $this->load->view('admin_header');
        $member = $this->Member_model->gets();
        $this->load->view('member_list', array('member'=>$member));
        $this->load->view('admin_footer');
    }
    function table_search($id){
        $this->load->view('admin_header');
/*        $member = $this->Member_model->gets();
        $this->load->view('member_list', array('member'=>$member));*/
        $topic = $this->Member_model->get($id);
        $this->load->helper(array('url', 'HTML', 'date'));
        $this->load->view('get', array('mem_id' =>$topic));
        $this->load->view('admin_footer');
    }
    function add(){
        $this->_head();

        $this->load->libary("form_validation");

        $this->form_validation->set_rules("title","제목","required");
    }
    public function chart()
    {
        $this->load->view('admin_header');
        $this->load->view('chart');
        $this->load->view('admin_footer');
    }
}
