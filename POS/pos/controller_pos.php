<?php 
    if(isset($_GET["pos"])){
        $temp = $_GET["pos"];
    } else{
        $temp = "";
    } 
    
    
    
    
    
    if ($temp=="id_product") {
      include "pos.php";
    } elseif ($temp=="loc_sanpham") {
      include "pos.php";
    }
       
    else{
      
      include "bill.php";
    }
