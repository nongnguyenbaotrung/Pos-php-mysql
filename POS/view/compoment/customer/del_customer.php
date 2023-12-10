<?php
$id = $_GET["id"];
$customer = $conn->query("DELETE FROM db_customer WHERE db_customer.id = '$id'");

if ($customer) {
    $_SESSION['success'] = "Xoá Thành Công";
    echo '<script language="javascript">;
      location.replace("?quanly=customer");
  </script>';
} else {
    $_SESSION['error'] = "Xoá Không Thành Công! Vui Lòng Kiểm Tra Lại.";
    echo '<script language="javascript">;
      location.replace("?quanly=customer");
  </script>';
}
