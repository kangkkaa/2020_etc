<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('kdate')){
    function kdate($stamp){
        return date('Y년 m월 d일, H시 i분 s초', strtotime($stamp));
    }
}