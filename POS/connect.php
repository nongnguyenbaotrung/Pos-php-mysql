<?php 

// $conn= new mysqli("localhost","1205427","nnbtrung211001","1205427db2");
// $conn= new mysqli("sql213.byethost8.com","b8_35536800","momo9923","b8_35536800_quanlybanhang");

$conn= new mysqli("localhost","root","","pos_banhang");
$conn->set_charset("utf8");
if (!$conn) {
    echo "Connect Database Fail!!!";
}
?>