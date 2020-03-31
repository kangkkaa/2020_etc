<?php
class History_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
    function all(){
        $this->db->select("a.scheduler_history_id, a.process_date, a.scheduler_info_id, b.scheduler_info_id, b.server_info_id, b.channel_id, 
        b.process_code, b.process_code_sub1, b.comment, b.period, b.file_path, b.use_yn, b.warning_cnt, b.danger_cnt");
        $this->db->from("scheduler_history a");
        $this->db->join("scheduler_info b","a.scheduler_info_id = b.scheduler_info_id");
        $this->db->group_by("a.scheduler_history_id");
        $this->db->order_by('a.scheduler_history_id', 'DESC');
        return $this->db->get("scheduler_history")->result_array();
    }
    function list_all(){
        $this->db->select("a.scheduler_history_id, a.process_date, a.scheduler_info_id");
        $this->db->from("scheduler_history a");
        $this->db->join("scheduler_info b","a.scheduler_info_id = b.scheduler_info_id");
        $this->db->group_by("a.scheduler_history_id");
        $this->db->order_by('a.scheduler_history_id', 'DESC');
        return $this->db->get("scheduler_history")->result_array();
    }
    function view_all($idx){
        $this->db->select("a.scheduler_history_id, a.process_date, a.scheduler_info_id");
        $this->db->from("scheduler_history a");
        $this->db->join("scheduler_info b","a.scheduler_info_id = b.scheduler_info_id");
        $this->db->where('a.scheduler_history_id', $idx);

        return  $this->db->get("scheduler_history")->row_array();
    }
    function where_all($where_type, $where_value){
        $this->db->select("a.scheduler_history_id, a.process_date, a.scheduler_info_id");
        $this->db->from("scheduler_history a");
        $this->db->join("scheduler_info b","a.scheduler_info_id = b.scheduler_info_id");
        $this->db->group_by("a.scheduler_history_id");
        $this->db->where($where_type, $where_value);
        return  $this->db->get("scheduler_history")->result_array();
    }
    function order_all($order_type, $order_value){
        $this->db->select("a.scheduler_history_id, a.process_date, a.scheduler_info_id");
        $this->db->from("scheduler_history a");
        $this->db->join("scheduler_info b","a.scheduler_info_id = b.scheduler_info_id");
        $this->db->group_by("a.scheduler_history_id");
        $this->db->order_by($order_type, $order_value);
        return  $this->db->get("scheduler_history")->result_array();
    }
    function all_count(){
        $this->db->select("count(scheduler_history_id) as cnt");
        return $this->db->get("scheduler_history")->row_array();
    }

    function delete($idx){
        $this->db->where('scheduler_history_id', $idx);
        $this->db->delete("scheduler_history");
    }
}