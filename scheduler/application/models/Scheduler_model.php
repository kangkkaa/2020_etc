<?php
class Scheduler_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
    function all(){
        $this->db->select("a.scheduler_info_id, a.server_info_id, a.channel_id, a.process_code, a.process_code_sub1, a.comment, a.period, a.file_path, a.use_yn, 
        a.warning_cnt, a.danger_cnt, b.channel_name, c.server_name, c.server_ip, c.server_comment");
        $this->db->from("scheduler_info a");
        $this->db->join("channel b","a.channel_id = b.channel_id", "LEFT OUTER");
        $this->db->join("server_info c","a.server_info_id = c.server_info_id", "LEFT OUTER");
//        $this->db->join("scheduler_history d","a.scheduler_info_id = d.scheduler_info_id", "LEFT OUTER");
        $this->db->group_by("a.scheduler_info_id");
        $this->db->order_by('a.scheduler_info_id', 'DESC');
        return  $this->db->get()->result_array();
    }
    function list_all(){
        $this->db->select("a.scheduler_info_id, a.server_info_id, a.channel_id, a.process_code, a.process_code_sub1, a.comment, a.period, a.file_path, 
        a.use_yn, a.warning_cnt, a.danger_cnt, b.channel_name, c.server_name");
        $this->db->from("scheduler_info a");
        $this->db->join("channel b","a.channel_id = b.channel_id", "LEFT OUTER");
        $this->db->join("server_info c","a.server_info_id = c.server_info_id", "LEFT OUTER");
        $this->db->group_by("a.scheduler_info_id");
        $this->db->order_by('a.scheduler_info_id', 'DESC');
        return  $this->db->get()->result_array();
    }
    function view_all($idx){
        $this->db->select("a.scheduler_info_id, a.server_info_id, a.channel_id, a.process_code, a.process_code_sub1, a.comment, a.period, a.file_path, 
        a.use_yn, a.warning_cnt, a.danger_cnt, b.channel_name, c.server_name");
        $this->db->from("scheduler_info a");
        $this->db->where('a.scheduler_info_id', $idx);
        $this->db->join("channel b","a.channel_id = b.channel_id", "LEFT OUTER");
        $this->db->join("server_info c","a.server_info_id = c.server_info_id", "LEFT OUTER");
        $this->db->group_by("a.scheduler_info_id");
        return  $this->db->get()->row_array();
    }
    function where_all($where_type, $where_value){
        $this->db->select("a.scheduler_info_id, a.server_info_id, a.channel_id, a.process_code, a.process_code_sub1, a.comment, a.period, a.file_path, 
        a.use_yn, a.warning_cnt, a.danger_cnt, b.channel_name, c.server_name");
        $this->db->from("scheduler_info a");
        $this->db->join("channel b","a.channel_id = b.channel_id", "LEFT OUTER");
        $this->db->join("server_info c","a.server_info_id = c.server_info_id", "LEFT OUTER");
        $this->db->where($where_type, $where_value);
        $this->db->group_by("a.scheduler_info_id");
        return  $this->db->get()->result_array();
    }
    function order_all($order_type, $order_value){
        $this->db->select("a.scheduler_info_id, a.server_info_id, a.channel_id, a.process_code, a.process_code_sub1, a.comment, a.period, a.file_path, 
        a.use_yn, a.warning_cnt, a.danger_cnt, b.channel_name, c.server_name");
        $this->db->from("scheduler_info a");
        $this->db->join("channel b","a.channel_id = b.channel_id", "LEFT OUTER");
        $this->db->join("server_info c","a.server_info_id = c.server_info_id", "LEFT OUTER");
        $this->db->group_by("a.scheduler_info_id");
        $this->db->order_by($order_type, $order_value);
        return  $this->db->get()->result_array();

    }
    function all_count(){ //count()값을 보내줘야함
        $this->db->select("count(a.scheduler_info_id) as cnt");
        $this->db->from("scheduler_info a");
        $this->db->join("channel b","a.channel_id = b.channel_id", "LEFT OUTER");
        $this->db->join("server_info c","a.server_info_id = c.server_info_id", "LEFT OUTER");
        $this->db->group_by("a.scheduler_info_id");

        return  $this->db->count_all_results();
    }

    function add($data){
        $this->db->insert("scheduler_info",$data);
        $result = $this->db->insert_id();
        return $result;
    }

    function update($idx, $data){
        $this->db->where('scheduler_info_id', $idx);
        $this->db->update("scheduler_info", $data);
    }
    function delete($idx){
        $this->db->where('scheduler_info_id', $idx);
        $this->db->delete("scheduler_info");
    }
    function test_all($column="a.scheduler_info_id, a.server_info_id, a.channel_id, a.process_code, a.process_code_sub1, a.comment, a.period, a.file_path, a.use_yn, 
        a.warning_cnt, a.danger_cnt, b.channel_name, c.server_name, c.server_ip, c.server_comment",$filter){
        foreach ($column as $key=>$val){
            switch ($key){
                case "channel_name" :
                    " b.".$key;
                    break;
                case "" : break;
                default:
                    " a.".$key;
                break;
            }
        }
        foreach ($filter as $key=>$val){
            switch ($key){
                case "channel_name" :
                    $this->db->like(" b.".$key, $val);
                    break;
                default:
                    $this->db->like(" a.".$key, $val);
                    break;
            }
        }
        $this->db->select($column);
        $this->db->join("channel b","a.channel_id = b.channel_id", "LEFT OUTER");
        $this->db->join("server_info c","a.server_info_id = c.server_info_id", "LEFT OUTER");
//        $this->db->join("scheduler_history d","a.scheduler_info_id = d.scheduler_info_id", "LEFT OUTER");
        $this->db->group_by("a.scheduler_info_id");
        $this->db->order_by('a.scheduler_info_id', 'DESC');
        return  $this->db->get()->result_array();

    }
    function test_add($column){
        foreach ($column as $key=>$val){
            switch ($key){
                case "create_date" :
                        $this->db->set("create_date","NOW()");
                    break;
                default:
                        $this->db->set($key,$val);
                    break;
            }
        }
        $this->db->insert("scheduler_info");
        return $this->db->insert_id();
    }
    //단일
    function row_select($coulmn, $join_from, $join_where, $where, $order){
        $this->db->query("SELECT ".$coulmn. " FROM scheduler_info a" . $join_from . " WHERE 1=1 ". $join_where . $where . $order);
        return $this->db->get()->row_array();
    }
    //복합
    function result_select($coulmn, $join_from, $join_where, $where, $order, $group, $having, $limit){
        $this->db->query("SELECT ".$coulmn. " FROM scheduler_info a" . $join_from . " WHERE 1=1 ". $join_where . $where . $group . $having . $order . $limit);
        return $this->db->get()->result_array();
    }

    function result_select_cnt($coulmn, $join_from, $join_where, $where, $order, $group, $having, $limit){
        $this->db->query("SELECT ".$coulmn. " FROM scheduler_info a" . $join_from . " WHERE 1=1 ". $join_where . $where . $group . $having . $order . $limit);
        return $this->db->count_all_results();
    }

}