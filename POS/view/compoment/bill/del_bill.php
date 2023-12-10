<?php
$orderID = $_GET['orderID'];

// 1. Xoá các sản phẩm tương ứng trong bảng db_orderdetail
$deleteOrderDetailsQuery = "DELETE FROM db_orderdetail WHERE orderid = '$orderID'";
$resultDeleteDetails = mysqli_query($conn, $deleteOrderDetailsQuery);

if (!$resultDeleteDetails) {
    $_SESSION['error'] = "Lỗi khi xoá sản phẩm của hoá đơn.";
    echo '<script language="javascript">;
        location.replace("?quanly=bill");
    </script>';
} else {
    // 2. Xoá hoá đơn trong bảng db_order
    $deleteOrderQuery = "DELETE FROM db_order WHERE id = '$orderID'";
    $resultDeleteOrder = mysqli_query($conn, $deleteOrderQuery);

    if (!$resultDeleteOrder) {
        $_SESSION['error'] = "Xoá Không Thành Công! Vui Lòng Kiểm Tra Lại.";
        echo '<script language="javascript">;
            location.replace("?quanly=bill");
        </script>';
    } else {
        $_SESSION['success'] = "Xoá Thành Công";
        echo '<script language="javascript">;
              location.replace("?quanly=bill");
          </script>';
    }
}
