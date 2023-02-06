<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('rupiah'))
{
    function rupiah($var = '')
    {
    return 'Rp ' . number_format($var);
    }   
}


if ( ! function_exists('thousandsCurrencyFormat'))
{
function thousandsCurrencyFormat($num) {

    // if($num>1000) {
  
    //       $x = round($num);
    //       $x_number_format = number_format($x);
    //       $x_array = explode(',', $x_number_format);
    //       $x_parts = array('k', 'm', 'b', 't');
    //       $x_count_parts = count($x_array) - 1;
    //       $x_display = $x;
    //       $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
    //       $x_display .= $x_parts[$x_count_parts - 1];
    //     print_r($x_count_parts-1);
    //       return $x_display;
  
    // }
  
    return number_format(round($num/1000))." k";
  }
}

if ( ! function_exists('tanggal'))
{
    function tanggal($var = '')
    {
    return $var;
    }   
}

if ( ! function_exists('countday'))
{
    function countday($var = "0000-00-00" , $param2 = "0000-00-00")
    {
        if($param2==NULL){
            $param2 = time();
        }else{
            $param2 = strtotime($param2);
        }
        // $datediff = $var - $var2;
        return floor(($param2 - strtotime($var))/ (60 * 60 * 24)); 
    }   
}

if ( ! function_exists('hitungbunga'))
{
    function hitungbunga($var = "0000-00-00" , $param2 =  "0000-00-00" , $nilairup = 0)
    {
        if($param2==NULL){
            $param2 = time();
        }else{
            $param2 = strtotime($param2);
        }
        // $datediff = $var - $var2;
        $persen = ($nilairup/100*0.8);
        $total_hari= floor(($param2 - strtotime($var)) / (60 * 60 * 24));
        $bunga = (($total_hari * ($persen))/30); 
        return $bunga;
        // return $bunga ;
    }   
}

if ( ! function_exists('tanggalindo'))
{
    function tanggalindo($var = "0000-00-00" )
    {
       
        return date("d M Y", strtotime($var));
    }   
}



if ( ! function_exists('isValidMd5'))
{
    function isValidMd5($md5 ='')
    {
        return preg_match('/^[a-f0-9]{32}$/', $md5);
    }  
}