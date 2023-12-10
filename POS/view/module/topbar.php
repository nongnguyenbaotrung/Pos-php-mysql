<!DOCTYPE html>
<html>

<head>
  <?php
  $title = "";
  if (isset($_GET["quanly"])) {
    $active = $_GET["quanly"];

    if ($active == "dashboard") {
      $title = "Tổng Quan";
    } elseif ($active == "bill" || $active == "viewbill") {
      $title = "Quản Lý Bill";
    } elseif ($active == "product" || $active == "viewproduct") {
      $title = "Quản Lý Sản Phẩm";
    } elseif ($active == "category" || $active == "viewcategory") {
      $title = "Quản Lý Loại Sản Phẩm";
    } elseif ($active == "customer" || $active == "viewcustomer") {
      $title = "Quản Lý Khách Hàng";
    } elseif ($active == "user" || $active == "viewuser") {
      $title = "Quản Lý Tài Khoản";
    } elseif ($active == "brand" || $active == "viewbrand") {
      $title = "Quản Lý Nhà Cung Cấp";
    } elseif ($active == "pos") {
      $title = "Mơ Mơ POS";
    } else {
      $title = "Tổng Quan";
    }
  } else {
    $title = "Tổng Quan";
  }
  ?>
  <title><?php echo $title ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">



  <link rel="icon" href="img/logo2.png">

  <style>
    html,
    body,
    h1,
    h2,
    h3,
    h4,
    h5 {
      font-family: "Raleway", sans-serif
    }
  </style>
  <?php if (isset($_SESSION['tennhanvien'])) {
    $tennhanvien = $_SESSION['tennhanvien'];
  }

  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $ngay_gio = date('Y-m-d H:i:s');

  $thu = date('l');
  $ngay = date('d');
  $thang = date('m');
  $nam = date('Y');
  $gio = date('H:i:s');
  $ngaythangnam = date('Y-m-d');

  $ngayfull = $ngaythangnam;
  list($get_year, $get_month, $get_day) = explode('-', $ngayfull);


  ?>
</head>

<body class="w3-light-grey">

  <!-- Top container -->
  <div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>

    <!-- <a href="#" class="w3-bar-item w3-button w3-right"><i class="fa fa-cog"></i> <i class="text-danger">Đăng Xuất</i></a> -->

    <a href="?quanly=viewmyuser" class="w3-bar-item w3-button"><i class="fa fa-user"></i>Nhân viên <b> <?php echo $tennhanvien ?></b> </a>

  </div>