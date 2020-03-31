<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Channel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Channel_model');
    }

    public function index() //list
    {
        $this->load->view('/include/head');
        $data = $this->Channel_model->all();
        $count = $this->Channel_model->all_count();
        $this->load->view('channel_list',array('data'=>$data, 'count'=>$count));
        $this->load->view('/include/footer');

    }
    public function view(){
        $idx = $this->input->get("idx",TRUE);
        if(!$idx) alert("잘못된 접근입니다.","/scheduler/channel/");

        $data = $this->Channel_model->view_all($idx);
        $this->load->view('/include/head');
        $this->load->view('channel_view',array('data'=>$data));
        $this->load->view('/include/footer');

    }
    public function popup(){
        $search_word = $this->input->get("search_word",TRUE);
        $search_type= $this->input->get("search_type",TRUE);

        if(!$search_word) {
            $data = $this->Channel_model->all();
        }else{
            $data = $this->Channel_model->where_all("channel_name like", "%".$search_word."%");
        }
        $this->load->view('/popup/pop_channel.php',array('data'=>$data));
    }
    public function write() //write
    {
        $this->load->view('/include/head');
        $this->load->view('channel_write');
        $this->load->view('/include/footer');

    }

    public function write_ok()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('channel_name', '채널이름', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('account_info', 'ACCOUNT_INFO', 'trim|required|alpha_dash');

        if($this->form_validation->run() === false){

            $this->load->view('/include/head');
            $this->load->view('channel_write');
            $this->load->view('/include/footer');
        }else{
            if(!$this->input->post('channel_name', TRUE) && $this->input->post('account_info', TRUE)){
                alert("비정상적인 접근입니다.","/scheduler/channel/write");
            }
            $this->Channel_model->add(array(
                'channel_name'=>$this->input->post('channel_name', TRUE),
                'account_info'=>$this->input->post('account_info', TRUE)
            ));
            alert("채널이 등록되었습니다.","/scheduler/channel/");
        }
    }

    public function modify(){
        $idx = $this->input->get("idx",TRUE);
        if(!$idx) alert("잘못된 접근입니다.","/scheduler/channel/");

        $data = $this->Channel_model->view_all($idx);
        $this->load->view('/include/head');
        $this->load->view('channel_modify',array('data'=>$data));
        $this->load->view('/include/footer');
    }

    public function modify_ok(){
        $idx = $this->input->post("idx",TRUE);
        if(!$idx) alert("잘못된 접근입니다.","/scheduler/channel/");

        $this->load->library('form_validation');
        $this->form_validation->set_rules('channel_name', '채널이름', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('account_info', 'ACCOUNT_INFO', 'trim|alpha_dash');

        if($this->form_validation->run() === false){

            $this->load->view('/include/head');
            $this->load->view('channel_modify');
            $this->load->view('/include/footer');
        }else{
            if(!$this->input->post('channel_name', TRUE) && $this->input->post('account_info', TRUE)){
                alert("비정상적인 접근입니다.","/scheduler/channel/write");
            }
            $this->Channel_model->update($idx, array(
                'channel_name'=>$this->input->post('channel_name', TRUE),
                'account_info'=>$this->input->post('account_info', TRUE)
            ));
            alert("채널이 수정되었습니다.","/scheduler/channel/");
        }
    }

    public function delete(){
        $idx = $this->input->get("idx",TRUE);
        $this->Channel_model->delete($idx);
        $this->load->helper('url');
        redirect('/channel/');
    }
}
?>