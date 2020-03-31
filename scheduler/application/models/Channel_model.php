<?php
class Channel_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
    /** select, insert, update, delete **/

    function all(){
        $this->db->select("channel_id, channel_name, account_info");
        $this->db->order_by('channel_id', 'DESC');
        return  $this->db->get("channel")->result_array();
    }
    function view_all($idx){
        $this->db->select("channel_id, channel_name, account_info");
        $this->db->where('channel_id', $idx);
        return  $this->db->get("channel")->row_array();
    }
    function where_all($where_type, $where_value){
        $this->db->select("channel_id, channel_name, account_info");
        $this->db->where($where_type, $where_value);
        return  $this->db->get("channel")->result_array();
    }
    function order_all($order_type, $order_value){
        $this->db->select("channel_id, channel_name, account_info");
        $this->db->order_by($order_type, $order_value);
        return  $this->db->get("channel")->result_array();
    }
    function all_count(){
        $this->db->select("count(channel_id) as cnt");
        return  $this->db->get("channel")->row_array();
    }

    function add($data){
        $this->db->set('channel_name', $data['channel_name']);
        $this->db->set('account_info', $data['account_info']);
        $this->db->insert("channel");
        $result = $this->db->insert_id();
        return $result;
    }

    function update($idx, $data){
        $this->db->where('channel_id', $idx);
        $this->db->update("channel", $data);
    }
    function delete($idx){
        $this->db->where('channel_id', $idx);
        $this->db->delete("channel");
    }
}