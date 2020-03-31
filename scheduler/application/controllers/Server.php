<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("Server_model");
    }

    public function index()
    {
        $data = $this->Server_model->all();
        $count = $this->Server_model->all_count();
        $this->load->view('/include/head');
        $this->load->view('server_list', array('data'=>$data, 'count'=>$count));
        $this->load->view('/include/footer');
    }

    public function view(){
        $idx = $this->input->get("idx",TRUE);
        if(!$idx) alert("잘못된 접근입니다.","/scheduler/server/");

        $data = $this->Server_model->view_all($idx);
        $this->load->view('/include/head');
        $this->load->view('server_view',array('data'=>$data));
        $this->load->view('/include/footer');

    }
    public function popup(){
        $search_word = $this->input->get("search_word",TRUE);
        if(!$search_word) {
            $data = $this->Server_model->all();
        }else{
            $data = $this->Server_model->where_all("server_name like", "%".$search_word."%");
        }
        $this->load->view('/popup/pop_server.php',array('data'=>$data));
    }
    public function write(){
        $this->load->view("/include/head");
        $this->load->view("server_write");
        $this->load->view("/include/footer");
    }

    public function write_ok(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('server_name', '서버이름', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('server_ip', '서버아이피', 'trim|required|valid_ip[ipv4]|max_length[14]');
        $this->form_validation->set_rules('server_comment', '설명', 'trim|required|max_length[100]');

        if($this->form_validation->run() === false){

            $this->load->view('/include/head');
            $this->load->view('server_write');
            $this->load->view('/include/footer');
        }else{
            if(!$this->input->post('server_name', TRUE) && $this->input->post('server_ip', TRUE) && $this->input->post('server_comment', TRUE)){
                alert("비정상적인 접근입니다.","/scheduler/server/write");
            }
            $this->Server_model->add(array(
                'server_name'=>$this->input->post('server_name', TRUE),
                'server_ip'=>$this->input->post('server_ip', TRUE),
                'server_comment'=>$this->input->post('server_comment', TRUE)
            ));
            alert("서버가 등록되었습니다.","/scheduler/server/");
        }
    }

    public function modify(){
        $idx = $this->input->get("idx",TRUE);
        if(!$idx) alert("잘못된 접근입니다.","/scheduler/server/");

        $data = $this->Server_model->view_all($idx);
        $this->load->view('/include/head');
        $this->load->view('server_modify',array('data'=>$data));
        $this->load->view('/include/footer');
    }

    public function modify_ok(){
        $idx = $this->input->post("idx",TRUE);
        if(!$idx) alert("잘못된 접근입니다.","/scheduler/server/");

        $this->load->library('form_validation');
        $this->form_validation->set_rules('server_name', '서버이름', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('server_ip', '서버아이피', 'trim|required|valid_ip[ipv4]|max_length[14]');
        $this->form_validation->set_rules('server_comment', '설명', 'trim|required|max_length[100]');

        if($this->form_validation->run() === false){

            $this->load->view('/include/head');
            $this->load->view('server_modify');
            $this->load->view('/include/footer');
        }else{
            if(!$this->input->post('server_name', TRUE) && $this->input->post('server_ip', TRUE) && $this->input->post('server_comment', TRUE)){
                alert("비정상적인 접근입니다.","/scheduler/server/");
            }
            $this->Server_model->update($idx, array(
                'server_name'=>$this->input->post('server_name', TRUE),
                'server_ip'=>$this->input->post('server_ip', TRUE),
                'server_comment'=>$this->input->post('server_comment', TRUE)
            ));
            alert("서버가 수정되었습니다.","/scheduler/server/");
        }
    }

    public function delete(){
        $idx = $this->input->get("idx",TRUE);
        $this->Server_model->delete($idx);
        $this->load->helper('url');
        redirect('/server/');
    }
}
?>