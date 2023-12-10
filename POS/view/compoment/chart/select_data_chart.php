<?php
//Tổng nhân viên
$count_nv = "SELECT COUNT(*) - 1 AS tong_so_nguoi_dung FROM db_user;";

$row_nv = mysqli_query($conn, $count_nv);
$count_nv = mysqli_num_rows($row_nv);

if ($count_nv > 0) {
  $row_data_nv = mysqli_fetch_array($row_nv);
  $sl_nv = $row_data_nv['tong_so_nguoi_dung'];
}



if (isset($_POST['btn_thongke']) && $_POST['date'] != "") {

  $post_date = $_POST['date'];

  // Tách ngày, tháng, năm bằng dấu '/'
  list($post_month, $post_day, $post_year) = explode('/', $post_date);
  $_SESSION['ngaythongke'] = "Thống Kê Theo Ngày: $post_day - $post_month - $post_year";


  //Tổng bill ngày
  $count_bill = "SELECT COUNT(*) AS so_luong_don_hang
          FROM db_order
          WHERE DATE(orderdate) = '$post_year-$post_month-$post_day'";

  $row_count_bill = mysqli_query($conn, $count_bill);
  $count_bill = mysqli_num_rows($row_count_bill);

  if ($count_bill > 0) {
    $row_data = mysqli_fetch_array($row_count_bill);
    $sl_bill = $row_data['so_luong_don_hang'];
  }

  //Tổng doanh thu ngày
  $count_total_bill = "SELECT SUM(total_checkout) AS tong_doanh_thu
                      FROM db_order
                      WHERE 
                        YEAR(orderdate) = '$post_year'
                        AND MONTH(orderdate) = '$post_month'
                        AND DAY(orderdate) = '$post_day'";

  $row_total_bill = mysqli_query($conn, $count_total_bill);
  $count_total_bill = mysqli_num_rows($row_total_bill);

  if ($count_total_bill > 0) {
    $row_data_total_bill = mysqli_fetch_array($row_total_bill);
    $total_bill = $row_data_total_bill['tong_doanh_thu'];
  }
} else {
  $_SESSION['ngaythongke'] = "Thống Kê Theo Ngày: $ngaythangnam";
  //Tổng bill ngày
  $count_bill = "SELECT COUNT(*) AS so_luong_don_hang
          FROM db_order
          WHERE DATE(orderdate) = DATE(NOW());";

  $row_count_bill = mysqli_query($conn, $count_bill);
  $count_bill = mysqli_num_rows($row_count_bill);

  if ($count_bill > 0) {
    $row_data = mysqli_fetch_array($row_count_bill);
    $sl_bill = $row_data['so_luong_don_hang'];
  }

  //Tổng doanh thu ngày
  $count_total_bill = "SELECT SUM(total_checkout) AS tong_doanh_thu
                      FROM db_order
                      WHERE 
                        YEAR(orderdate) = YEAR(CURRENT_DATE()) 
                        AND MONTH(orderdate) = MONTH(CURRENT_DATE())
                        AND DAY(orderdate) = DAY(CURRENT_DATE());";

  $row_total_bill = mysqli_query($conn, $count_total_bill);
  $count_total_bill = mysqli_num_rows($row_total_bill);

  if ($count_total_bill > 0) {
    $row_data_total_bill = mysqli_fetch_array($row_total_bill);
    $total_bill = $row_data_total_bill['tong_doanh_thu'];
  }
}



//Tổng doanh thu tháng
$count_total_bill_month = "SELECT SUM(total_checkout) AS tong_doanh_thu_thang  
                            FROM db_order
                            WHERE
                              YEAR(orderdate) = YEAR(CURRENT_DATE())
                              AND MONTH(orderdate) = MONTH(CURRENT_DATE());";

$row_total_bill_month = mysqli_query($conn, $count_total_bill_month);
$count_total_bill_month = mysqli_num_rows($row_total_bill_month);

if ($count_total_bill_month > 0) {
  $row_data_total_bill_month = mysqli_fetch_array($row_total_bill_month);
  $total_bill_month = $row_data_total_bill_month['tong_doanh_thu_thang'];
}



//Tổng doanh thu tất cả tháng thống kê
$bill_month = "SELECT MONTH(orderdate) AS thang,
                             COUNT(*) AS so_luong_don_hang,
                             SUM(total_checkout) AS tong_doanh_thu
                           FROM db_order
                           WHERE YEAR(orderdate) = YEAR(CURDATE())
                           GROUP BY MONTH(orderdate)
                           ORDER BY MONTH(orderdate)";

$row_bill_month = mysqli_query($conn, $bill_month);
$count_bill_month = mysqli_num_rows($row_bill_month);

$duLieu = array(); // Khởi tạo mảng để lưu trữ dữ liệu từ SQL

if ($count_bill_month > 0) {
  while ($row_data_bill_month = mysqli_fetch_array($row_bill_month)) {
    $thang = $row_data_bill_month['thang'];
    $so_luong_don_hang = $row_data_bill_month['so_luong_don_hang'];
    $doanh_thu = $row_data_bill_month['tong_doanh_thu'];

    // Thêm dữ liệu từ SQL vào mảng $duLieu
    $duLieu[] = ["Tháng $thang", $so_luong_don_hang, $doanh_thu];
  }
}

// Thống kê sản phẩm bán trong ngày
$query = " SELECT 
        od.productid,
        p.name AS ten_san_pham,
        SUM(od.count) AS so_luong_da_ban
    FROM 
        db_orderdetail od
    JOIN 
        db_product p ON od.productid = p.id
    JOIN
        db_order o ON od.orderid = o.id
    WHERE 
        YEAR(o.orderdate) = YEAR(CURRENT_DATE())
        AND MONTH(o.orderdate) = MONTH(CURRENT_DATE())
        AND DAY(o.orderdate) = DAY(CURRENT_DATE())
    GROUP BY 
        od.productid, p.name";

$result = mysqli_query($conn, $query);

// Chuyển dữ liệu từ PHP sang JavaScript
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}


//Thống kê tất cả sản phẩm đã bán được
$query = " SELECT 
        od.productid,
        p.name AS ten_san_pham,
        SUM(od.count) AS so_luong_da_ban
    FROM 
        db_orderdetail od
    JOIN 
        db_product p ON od.productid = p.id
    GROUP BY 
        od.productid, p.name
  ";

$result_all = mysqli_query($conn, $query);

// Chuyển dữ liệu từ PHP sang JavaScript
$data_all = array();
while ($row_all = mysqli_fetch_assoc($result_all)) {
  $data_all[] = $row_all;
}
