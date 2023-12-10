<?php
// include "chart/select_data_chart.php";
//Tổng nhân viên
$count_nv = "SELECT COUNT(*) - 1 AS tong_so_nguoi_dung FROM db_user;";

$row_nv = mysqli_query($conn, $count_nv);
$count_nv = mysqli_num_rows($row_nv);

if ($count_nv > 0) {
  $row_data_nv = mysqli_fetch_array($row_nv);
  $sl_nv = $row_data_nv['tong_so_nguoi_dung'];
}

$ngayfull = $ngaythangnam;
list($get_year, $get_month, $get_day) = explode('-', $ngayfull);

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
              YEAR(o.orderdate) = '$post_year'
              AND MONTH(o.orderdate) = '$post_month'
              AND DAY(o.orderdate) = '$post_day'
              GROUP BY od.productid, p.name";

  $result = mysqli_query($conn, $query);

  // Chuyển dữ liệu từ PHP sang JavaScript
  $data = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
} else {
  $_SESSION['ngaythongke'] = "Thống Kê Theo Ngày: $get_day-$get_month-$get_year";
  //Tổng bill ngày
  $count_bill = "SELECT COUNT(*) AS so_luong_don_hang
          FROM db_order
          WHERE DATE(orderdate) = '$get_year-$get_month-$get_day'";

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
                        YEAR(orderdate) = '$get_year' 
                        AND MONTH(orderdate) = '$get_month'
                        AND DAY(orderdate) = '$get_day'";

  $row_total_bill = mysqli_query($conn, $count_total_bill);
  $count_total_bill = mysqli_num_rows($row_total_bill);

  if ($count_total_bill > 0) {
    $row_data_total_bill = mysqli_fetch_array($row_total_bill);
    $total_bill = $row_data_total_bill['tong_doanh_thu'];
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
            YEAR(o.orderdate) = '$get_year'
            AND MONTH(o.orderdate) = '$get_month'
            AND DAY(o.orderdate) = '$get_day'
            GROUP BY od.productid, p.name";

  $result = mysqli_query($conn, $query);

  // Chuyển dữ liệu từ PHP sang JavaScript
  $data = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
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


?>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>





<!-- !PAGE CONTENT! -->

<!-- Header -->
<header class="w3-container" style="padding-top:22px">
  <h5><b><i class="fa fa-dashboard"></i> Tổng Quan Doanh Thu</b></h5>
</header>

<div class="w3-row-padding w3-margin-bottom">
  <div class="w3-quarter">
    <div class="w3-container w3-red w3-padding-16">
      <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
      <div class="w3-right">
        <h3><?php echo $sl_bill; ?></h3>
      </div>
      <div class="w3-clear"></div>
      <h4>Đơn hôm nay</h4>
    </div>
  </div>
  <div class="w3-quarter ">
    <div class="w3-container w3-teal w3-padding-16">
      <div class="w3-left"><i class="fa fa-eye  w3-xxxlarge"></i></div>
      <div class="w3-right">
        <h3><b><?php echo number_format($total_bill) ?></b></h3>
      </div>
      <div class="w3-clear"></div>
      <h4>Doanh Thu Ngày</h4>
    </div>
  </div>
  <div class="w3-quarter">
    <div class="w3-container w3-blue w3-padding-16">
      <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
      <div class="w3-right">
        <h3><b><?php echo number_format($total_bill_month) ?></b></h3>
      </div>
      <div class="w3-clear"></div>
      <h4>Doanh Thu Tháng</h4>
    </div>
  </div>

  <div class="w3-quarter">
    <div class="w3-container w3-orange w3-text-white w3-padding-16">
      <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
      <div class="w3-right">
        <h3><?php echo number_format($sl_nv) ?></h3>
      </div>
      <div class="w3-clear"></div>
      <h4>Nhân Viên</h4>
    </div>
  </div>
</div>


<hr>
<div class="w3-container">
  <form action="" method="POST">
    <label>Xem Thống kê theo ngày cụ thể</label><br>
    <input type="text" id="datepicker" name="date" placeholder="Chọn ngày" value="">
    <button class="btn btn-primary" name="btn_thongke">Xem Thống kê</button>
  </form>
  <br>

  <!-- <div id="columnchart_material"></div> -->


  <h5>Doanh Thu</h5>
  <?php if (isset($_SESSION['ngaythongke'])) { ?>
    <h6><?php echo $_SESSION['ngaythongke']; ?><h6>
      <?php } ?>
      <div id="columnchart_material" style="height: 300px;"></div>
</div>
<hr>


<div class="w3-container">
  <h5>Số Lượng Sản Phẩm Đã Bán Trong Ngày</h5>
  <div id="charts_product_day" style="height: 400px;"></div>
</div>
<hr>

<div class="w3-container">
  <h5>Doanh Thu Tháng</h5>
  <div id="columnchart_month" style="height: 300px;"></div>
</div>
<hr>



<div class="w3-container">
  <h5>Tổng Số Lượng Tất Cả Sản Phẩm Đã Bán</h5>
  <div id="charts_product_all" style="height: 400px;"></div>
</div>
<hr>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
  $(document).ready(function() {
    // Kích hoạt Datepicker
    $("#datepicker").datepicker();
  });
</script>

<!-- ngày -->
<script type="text/javascript">
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Ngày', 'Số lượng hoá đơn', 'Doanh thu hôm nay'],
      ['Hôm nay', <?php echo $sl_bill; ?>, <?php echo $total_bill; ?>]
    ]);

    var options = {
      title: 'Thống kê theo ngày',
      bar: {
        groupWidth: '20%'
      },
      seriesType: 'bars',
      series: {
        0: {
          targetAxisIndex: 0
        },
        1: {
          targetAxisIndex: 1
        }
      },

    };

    var chart = new google.visualization.ComboChart(document.getElementById('columnchart_material'));
    chart.draw(data, options);
  }
</script>

<!-- tháng -->
<script type="text/javascript">
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Tháng', 'Số lượng hoá đơn', 'Doanh thu'],
      <?php
      foreach ($duLieu as $item) {
        echo "['$item[0]', $item[1], $item[2]],";
      }
      ?>
    ]);

    var options = {
      title: 'Thống kê theo tháng',
      bar: {
        groupWidth: '40%'
      },
      seriesType: 'bars',
      series: {
        0: {
          targetAxisIndex: 0
        },
        1: {
          targetAxisIndex: 1
        }
      },
      vAxes: {
        0: {
          title: 'Số lượng hoá đơn'
        },
        1: {
          title: 'Doanh thu mỗi tháng'
        }
      }
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_month'));
    chart.draw(data, options);
  }
</script>

<!-- sp ngày -->
<script type="text/javascript">
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Sản phẩm', 'Số lượng đã bán'],
      <?php
      foreach ($data as $row) {
        echo "['{$row['ten_san_pham']}', {$row['so_luong_da_ban']}],";
      }
      ?>
    ]);

    var options = {
      title: 'Số lượng sản phẩm đã bán trong ngày',
      hAxis: {
        title: 'Số lượng đã bán',
        minValue: 0
      },
      vAxis: {
        title: 'Sản phẩm'
      },
      legend: 'none'
    };

    var chart = new google.visualization.BarChart(document.getElementById('charts_product_day'));
    chart.draw(data, options);
  }
</script>

<!-- all sp -->
<script type="text/javascript">
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Sản phẩm', 'Số lượng đã bán'],
      <?php
      foreach ($data_all as $row_pro_all) {
        echo "['{$row_pro_all['ten_san_pham']}', {$row_pro_all['so_luong_da_ban']}],";
      }
      ?>
    ]);

    var options = {
      title: 'Số lượng tất cả sản phẩm đã bán',
      hAxis: {
        title: 'Số lượng đã bán',
        minValue: 0
      },
      vAxis: {
        title: 'Sản phẩm'
      },
      legend: 'none'
    };

    var chart = new google.visualization.BarChart(document.getElementById('charts_product_all'));
    chart.draw(data, options);
  }
</script>