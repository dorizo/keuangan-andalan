<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('roleuser'))
{
    function roleuser($var = '')
    {
        $ci =& get_instance();
        $ddd =  $ci->db->query("SELECT d.* FROM user a JOIN role_user b ON a.userCode=b.userCode JOIN role_permission c ON c.roleCode=b.roleCode JOIN permission d ON d.permissionCode=c.permissionCode  WHERE a.userCode=".$ci->session->userdata("userCode")." AND d.permission='$var' AND c.deleteAt IS NULL")->row();
        return $ddd;
    }   
}


if ( ! function_exists('projectmenu'))
{
    function projectmenu($var ="" , $url = '',$icon = '',$name = '')
    {
        $ci =& get_instance();
        $ddd =  $ci->db->query("SELECT d.* FROM user a JOIN role_user b ON a.userCode=b.userCode JOIN role_permission c ON c.roleCode=b.roleCode JOIN permission d ON d.permissionCode=c.permissionCode  WHERE a.userCode=".$ci->session->userdata("userCode")." AND d.permission='$var'")->row();
       
        if($ddd){
            echo '<a class="dropdown-item" href="'.$url.'"><i class="fas '.$icon.'"></i> '.$name.' </a>';

        }
    }   
}

if ( ! function_exists('projectmenublank'))
{
    function projectmenublank($var ="" , $url = '',$icon = '',$name = '')
    {
        $ci =& get_instance();
        $ddd =  $ci->db->query("SELECT d.* FROM user a JOIN role_user b ON a.userCode=b.userCode JOIN role_permission c ON c.roleCode=b.roleCode JOIN permission d ON d.permissionCode=c.permissionCode  WHERE a.userCode=".$ci->session->userdata("userCode")." AND d.permission='$var'")->row();
       
        if($ddd){
            echo '<a class="dropdown-item" href="'.$url.'" target="_BLANK"><i class="fas '.$icon.'"></i> '.$name.' </a>';

        }
    }   
}

if ( ! function_exists('kondisipermision'))
{
    function kondisipermision($var ="")
    {
        $ci =& get_instance();
        $ddd =  $ci->db->query("SELECT d.* FROM user a JOIN role_user b ON a.userCode=b.userCode JOIN role_permission c ON c.roleCode=b.roleCode JOIN permission d ON d.permissionCode=c.permissionCode  WHERE a.userCode=".$ci->session->userdata("userCode")." AND d.permission='$var'")->row();
       
        if($ddd){
          return true;
        }else{
            return false;
        }
    }   
}

if ( ! function_exists('notifikasinumber'))
{
    function notifikasinumber($var ="")
    {
        $ci =& get_instance();
        $ddd =  $ci->db->query("SELECT d.* FROM user a JOIN role_user b ON a.userCode=b.userCode JOIN role_permission c ON c.roleCode=b.roleCode JOIN permission d ON d.permissionCode=c.permissionCode  WHERE a.userCode=".$ci->session->userdata("userCode")." AND d.permission='$var'")->row();
       $number =0;
        if($ddd){
            $number = $ci->db->query("select * from akunbank_pengajuan where statusTransaksi='PENDING'")->num_rows();
        }else{
            $number = 0;
        }
        return $number;
    }   
}

