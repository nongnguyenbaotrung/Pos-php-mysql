<?php
$id = $_GET["id"];
$category = $conn->query("DELETE FROM db_category WHERE db_category.id = '$id'");

if ($category) {
    $_SESSION['success'] = "Xoá Thành Công";
    echo '<script language="javascript">;
      location.replace("?quanly=category");
  </script>';
} else {
    $_SESSION['error'] = "Xoá Không Thành Công! Vui Lòng Kiểm Tra Lại.";
    echo '<script language="javascript">;
      location.replace("?quanly=category");
  </script>';
}
