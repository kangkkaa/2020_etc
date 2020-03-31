<?php
class Server_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
    function all(){
        $this->db->select("server_info_id, server_name, server_ip, server_comment");
        $this->db->order_by('server_info_id', 'DESC');
        return  $this->db->get("server_info")->result_array();
    }
    function view_all($idx){
        $this->db->select("server_info_id, server_name, server_ip, server_comment");
        $this->db->where('server_info_id', $idx);
        return  $this->db->get("server_info")->row_array();
    }
    function where_all($where_type, $where_value){
        $this->db->select("server_info_id, server_name, server_ip, server_comment");
        $this->db->where($where_type, $where_value);
        return  $this->db->get("server_info")->result_array();
    }
    function order_all($order_type, $order_value){
        $this->db->select("server_info_id, server_name, server_ip, server_comment");
        $this->db->order_by($order_type, $order_value);
        return  $this->db->get("server_info")->result_array();
    }
    function all_count(){
        $this->db->select("count(server_info_id) as cnt");
        return  $this->db->get("server_info")->row_array();
    }
    function add($data){
        $this->db->insert("server_info",$data);
        $result = $this->db->insert_id();
        return $result;
    }

    function update($idx, $data){
        $this->db->where('server_info_id', $idx);
        $this->db->update("server_info", $data);
    }
    function delete($idx){
        $this->db->where('server_info_id', $idx);
        $this->db->delete("server_info");
    }
}