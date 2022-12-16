<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('rupiah'))
{
    function rupiah($var = '')
    {
    return 'Rp ' . number_format($var);
    }   
}