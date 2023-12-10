<?php
include "../connect.php";
if (isset($_GET["item"]) && isset($_GET["table"])) {
    $id_pro = $_GET["item"];
    $id_table = $_GET["table"];
    $sql_deletepro_bill = $conn->query("DELETE FROM db_table_detail WHERE id_table = '$id_table' and id_product = '$id_pro'");
    if ($sql_deletepro_bill) {
        $sql_count_pro = "SELECT COUNT(*) AS total FROM db_table_detail WHERE id_table = '$id_table'";
        $result = $conn->query($sql_count_pro);
        $row = $result->fetch_assoc();

        $total_products = $row['total'];
        if ($total_products == 0) {
            $ud_status_table = $conn->query("UPDATE db_table SET `status` = 0 WHERE id_table = '$id_table'");
        }
        header("Location: pos.php");
        echo '<script language="javascript">';
        echo 'alert("Xoá sản phẩm thành công")';
        echo '</script>';
    }
}
