<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scheduler extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Scheduler_model');
        $this->load->model('Channel_model');
        $this->load->model('Server_model');

    }
    public function main()
    {
        $this->load->view('/include/head');
        $this->load->view('main');
        $this->load->view('/include/footer');

    }
    public function index()
    {
        $data = $this->Scheduler_model->list_all();
        $count = $this->Scheduler_model->all_count();
        $this->load->view('/include/head');
        $this->load->view('scheduler_list', array('data'=>$data, 'count'=>$count));
        $this->load->view('/include/footer');

    }

    public function view(){
        $idx = $this->input->get("idx",TRUE);
        if(!$idx) alert("잘못된 접근입니다.","/scheduler/scheduler/");

        $data = $this->Scheduler_model->view_all($idx);
        $this->load->view('/include/head');
        $this->load->view('scheduler_view',array('data'=>$data));
        $this->load->view('/include/footer');

    }

    public function write() //write
    {
        $this->load->view('/include/head');
        $this->load->view('scheduler_write');
        $this->load->view('/include/footer');
    }

    public function write_ok(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('channel_id', '채널', 'required|integer');
        $this->form_validation->set_rules('server_info_id', '서버', 'required|integer');
        $this->form_validation->set_rules('process_code', 'Process_code', 'required|max_length[50]');
        $this->form_validation->set_rules('process_code_sub1', 'Process_code_sub1', 'required|max_length[50]');
        $this->form_validation->set_rules('comment', '설명', 'required|max_length[100]');
        $this->form_validation->set_rules('period', 'period', 'required|max_length[50]');
        $this->form_validation->set_rules('file_path', '파일경로', 'required');
        $this->form_validation->set_rules('use_yn', '사용여부', 'required|max_length[1]');
        $this->form_validation->set_rules('warning_cnt', 'warning_cnt', 'required|integer');
        $this->form_validation->set_rules('danger_cnt', 'danger_cnt', 'required|integer');

        if($this->form_validation->run() === false){

            $this->load->view('/include/head');
            $this->load->view('scheduler_write');
            $this->load->view('/include/footer');
        }else{
            if(!$this->input->post('channel_id', TRUE) && $this->input->post('server_info_id', TRUE) && $this->input->post('process_code', TRUE)
                && $this->input->post('process_code_sub1', TRUE) && $this->input->post('comment', TRUE) && $this->input->post('period', TRUE)
                && $this->input->post('file_path', TRUE) && $this->input->post('use_yn', TRUE) && $this->input->post('warning_cnt', TRUE)
                && $this->input->post('danger_cnt', TRUE)){
                alert("비정상적인 접근입니다.","/scheduler/scheduler/write");
            }

            //SERVER && CHANNEL에 있는 건지 확인
            $is_channel = $this->Channel_model->view_all($this->input->post('channel_id'));
            $is_server = $this->Server_model->view_all($this->input->post('server_info_id'));
            if(isset($is_channel)!=1 || isset($is_server)!=1) { alert("비정상적인 접근입니다.","/scheduler/scheduler/write"); }

            $this->Scheduler_model->add(array(
                'channel_id'=>$this->input->post('channel_id', TRUE),
                'server_info_id'=>$this->input->post('server_info_id', TRUE),
                'process_code'=>$this->input->post('process_code', TRUE),
                'process_code_sub1'=>$this->input->post('process_code_sub1', TRUE),
                'comment'=>$this->input->post('comment', TRUE),
                'period'=>$this->input->post('period', TRUE),
                'file_path'=>$this->input->post('file_path', TRUE),
                'use_yn'=>$this->input->post('use_yn', TRUE),
                'warning_cnt'=>$this->input->post('warning_cnt', TRUE),
                'danger_cnt'=>$this->input->post('danger_cnt', TRUE)
            ));
            alert("스케쥴이 등록되었습니다.","/scheduler/scheduler/");
        }
    }

    public function modify() //write
    {
        $idx = $this->input->get("idx",TRUE);
        if(!$idx) alert("잘못된 접근입니다.","/scheduler/scheduler/");

        $data = $this->Scheduler_model->view_all($idx);
        $this->load->view('/include/head');
        $this->load->view('scheduler_modify', array('data'=>$data));
        $this->load->view('/include/footer');

    }
    public function modify_ok(){

        $idx = $this->input->post("idx",TRUE);
        if(!$idx) alert("잘못된 접근입니다.","/scheduler/scheduler/");

        $this->load->library('form_validation');
        $this->form_validation->set_rules('channel_id', '채널', 'required|integer');
        $this->form_validation->set_rules('server_info_id', '서버', 'required|integer');
        $this->form_validation->set_rules('process_code', 'Process_code', 'required|max_length[50]');
        $this->form_validation->set_rules('process_code_sub1', 'Process_code_sub1', 'required|max_length[50]');
        $this->form_validation->set_rules('comment', '설명', 'required|max_length[100]');
        $this->form_validation->set_rules('period', 'period', 'required|max_length[50]');
        $this->form_validation->set_rules('file_path', '파일경로', 'required');
        $this->form_validation->set_rules('use_yn', '사용여부', 'required|max_length[1]');
        $this->form_validation->set_rules('warning_cnt', 'warning_cnt', 'required|integer');
        $this->form_validation->set_rules('danger_cnt', 'danger_cnt', 'required|integer');

        if($this->form_validation->run() === false){
            $this->load->view('/include/head');
            $this->load->view('scheduler_modify');
            $this->load->view('/include/footer');
        }else{
            if(!$this->input->post('channel_id', TRUE) && $this->input->post('server_info_id', TRUE) && $this->input->post('process_code', TRUE)
                && $this->input->post('process_code_sub1', TRUE) && $this->input->post('comment', TRUE) && $this->input->post('period', TRUE)
                && $this->input->post('file_path', TRUE) && $this->input->post('use_yn', TRUE) && $this->input->post('warning_cnt', TRUE)
                && $this->input->post('danger_cnt', TRUE)){
                alert("비정상적인 접근입니다.","/scheduler/scheduler/modify");
            }
            $this->Scheduler_model->update($idx, array(
                'channel_id'=>$this->input->post('channel_id', TRUE),
                'server_info_id'=>$this->input->post('server_info_id', TRUE),
                'process_code'=>$this->input->post('process_code', TRUE),
                'process_code_sub1'=>$this->input->post('process_code_sub1', TRUE),
                'comment'=>$this->input->post('comment', TRUE),
                'period'=>$this->input->post('period', TRUE),
                'file_path'=>$this->input->post('file_path', TRUE),
                'use_yn'=>$this->input->post('use_yn', TRUE),
                'warning_cnt'=>$this->input->post('warning_cnt', TRUE),
                'danger_cnt'=>$this->input->post('danger_cnt', TRUE)
            ));
            alert("스케쥴이 수정되었습니다.","/scheduler/scheduler/");
        }
    }

    public function delete(){
        $idx = $this->input->get("idx",TRUE);
        $this->Scheduler_model->delete($idx);
        $this->load->helper('url');
        redirect('/scheduler/');
    }

}
