<?php
class Member_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
    function gets(){
        return $this->db->query("SELECT * FROM m_member")->result();
    }
    function get($member_id){
        $this->db->select('idx');
        $this->db->select('mem_id');
        $this->db->select('mem_name');
        $this->db->select('join_date');
        return $this->db->get_where('m_member', array('mem_id'=>$member_id))->row();
    }
}