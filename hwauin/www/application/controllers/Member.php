<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Member extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Member_model');
    }
    function index(){
        $this->load->view('admin_header');
        $topics = $this->Member_model->gets();
        $this->load->view('member_list', array('member'=>$topics));
        $this->load->view('admin_footer');
    }
    function get($id){
        $this->load->view('admin_header');
        $topics = $this->Member_model->gets();
        $this->load->view('member_list', array('member'=>$topics));
        $topic = $this->Member_model->get($id);
        $this->load->helper(array('url', 'HTML', 'korean'));
        $this->load->view('get', array('Member' =>$topic));
        $this->load->view('admin_footer');
    }
}
?>