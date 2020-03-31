<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("History_model");
    }

    public function index()
    {
        $data = $this->History_model->list_all();
        $count = $this->History_model->all_count();
        $this->load->view('/include/head');
        $this->load->view('history_list', array('data'=>$data, 'count'=>$count));
        $this->load->view('/include/footer');
    }

    public function view(){
        $idx = $this->input->get("idx",TRUE);
        if(!$idx) alert("잘못된 접근입니다.","/scheduler/history/");

        $data = $this->History_model->view_all($idx);
        $this->load->view('/include/head');
        $this->load->view('history_view',array('data'=>$data));
        $this->load->view('/include/footer');

    }

    public function delete(){
        $idx = $this->input->get("idx",TRUE);
        $this->History_model->delete($idx);
        $this->load->helper('url');
        redirect('/history/');
    }
}
?>