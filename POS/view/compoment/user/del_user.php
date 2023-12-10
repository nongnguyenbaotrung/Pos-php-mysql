<?php
$id = $_GET["id"];
$user = $conn->query("DELETE FROM db_user WHERE db_user.id = '$id'");

if ($user) {
    $_SESSION['success'] = "Xoá Thành Công";
    echo '<script language="javascript">;
      location.replace("?quanly=user");
  </script>';
} else {
    $_SESSION['error'] = "Xoá Không Thành Công! Vui Lòng Kiểm Tra Lại.";
    echo '<script language="javascript">;
      location.replace("?quanly=user");
  </script>';
}
