<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function RandStr($num){
   $arr = array_merge(range("A", "Z"), range("a", "z"), range("0", "9"));
   $str = "";
   for($i=1; $i<=$num; $i++){
      $str .= $arr[rand(0, count($arr)-1)];
   }
   return $str;
}

function Replace($data) {
   $data = str_replace("'", "", $data);
    $data = str_replace("!", "", $data);
    $data = str_replace("@", "", $data);
    $data = str_replace("#", "", $data);
    $data = str_replace("$", "", $data);
    $data = str_replace("%", "", $data);
    $data = str_replace("^", "", $data);
    $data = str_replace("&", "", $data);
    $data = str_replace("*", "", $data);
    $data = str_replace("(", "", $data);
    $data = str_replace(")", "", $data);
    $data = str_replace("+", "", $data);
    $data = str_replace("=", "", $data);
    $data = str_replace(",", "", $data);
    $data = str_replace(":", "", $data);
    $data = str_replace(";", "", $data);
    $data = str_replace("|", "", $data);
    $data = str_replace("'", "", $data);
    $data = str_replace('"', "", $data);
    $data = str_replace("?", "", $data);
    $data = str_replace("  ", "-", $data);
    $data = str_replace("'", "", $data);
    $data = str_replace(".", "-", $data);
    $data = strtolower(str_replace("  ", "-", $data));
    $data = strtolower(str_replace(" ", "-", $data));
    $data = strtolower(str_replace(" ", "-", $data));
    $data = strtolower(str_replace("__", "-", $data));
    $data = strtolower(str_replace("--", "-", $data));
    return str_replace("_", "-", $data);
}


function Calculation($price, $vat, $dis){
   $price = $price - ($price*$dis)/100;
   $price = $price + ($price*$vat)/100;
   return $price;
}