<?php
// Pengecekan apakah sudah login
function cek_yeslogin(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('username');
    if ($user_session) {
        redirect ('Dashboard');
    }
}

function cek_nologin(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('username');
    if (!$user_session) {
        redirect ('Auth');
    }
}

function cek_admin(){
    $ci =& get_instance();
    $ci->load->library('fungsi');
    if($ci->fungsi->user_login()->userlevel != "A1"){
        redirect('Dashboard');
    }
}

function cek_admin_2(){
    $ci =& get_instance();
    $ci->load->library('fungsi');
    if($ci->fungsi->user_login()->userlevel == "A3"){
        redirect('Dashboard');
    }
}