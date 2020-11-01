<?php 
session_start();
include_once '../config/Config.php';
$con = new Config();
if($con->auth()){
    //panggil fungsi
    switch (@$_GET['mod']){
        case 'produk':
        include_once 'contoller/produk.php';
        break;
        default:
        include_once 'contoller/login.php';
    }
}else{
    //panggil cont login
    include_once 'contoller/login.php';
}
?>