<!-- <?php
if (isset($_GET["quanly"])) {
    $active = $_GET["quanly"];
    // echo $active;
}

$title = "";
if (isset($active)) {
    if ($active == "dashboard") {
        $title = "Dashboard";
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
    } else {
        $title = "Dashboard";
    }
}else {
    $title = "Dashboard";
}


?>


<Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="img/logo2.png" class="w3-circle w3-margin-right" style="width:270px; padding-top:2px">
    </div>
    <!-- <div class="w3-col s8 w3-bar">
      <span>Welcome, <strong>Admin</strong></span><br>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
        
    </div> -->
  </div>
  <hr>
  <div class="w3-container">
    <h5></h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <!-- <a style="font-size: 20px;" href="pos/pos.php" class="w3-bar-item w3-button w3-padding w3-teal"><b><i class="fa fa-diamond fa-fw"></i> POS Bán Hàng</b></a><hr> -->
    <div class="dropdown">
                <button style="font-size: 20px;" type="button" class="w3-bar-item w3-teal btn btn-success dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-diamond fa-fw"></i> <b>POS BÁN HÀNG</b>
                </button>
                <div class="dropdown-menu">
                    <b><a style="font-size: 23px;" class="dropdown-item" href="posdt/pos_index.php">Bán Trên Điện Thoại</a></b>
                    <hr>
                    <b><a style="font-size: 23px;" class="dropdown-item" href="pos/pos.php">Bán Trên Máy Tính</a></b>
                </div>
            </div>
    <hr>
    <a style="font-size: 20px;" href="?quanly=dashboard" class="w3-bar-item w3-button w3-padding <?php
            if ($active == "dashboard") {
                echo "w3-blue";
            } else {
                echo "";
            }
            ?>"><i class="fa fa-eye fa-fw"></i> Tổng Quan</a><hr>

    <a style="font-size: 20px;" href="?quanly=bill" class="w3-bar-item w3-button w3-padding <?php
            if ($active == "bill" || $active == "viewbill") {
                echo "w3-blue";
            } else {
                echo "";
            }
            ?>"><i class="fa fa-bullseye fa-fw"></i> QL Hoá Đơn</a><hr>

    <?php if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == "Admin") { ?>  
        
        <a style="font-size: 20px;" href="?quanly=product" class="w3-bar-item w3-button w3-padding <?php
                if ($active == "product" || $active == "viewproduct") {
                    echo "w3-blue";
                } else {
                    echo "";
                }
                ?>"><i class="fa fa-cog fa-fw"></i> QL Sản Phẩm</a><hr>

        <a style="font-size: 20px;" href="?quanly=category" class="w3-bar-item w3-button w3-padding <?php
                if ($active == "category" || $active == "viewcategory") {
                    echo "w3-blue";
                } else {
                    echo "";
                }
                ?>"><i class="fa fa-bank fa-fw"></i> QL Loại Sản Phẩm</a><hr>

        <a style="font-size: 20px;" href="?quanly=customer" class="w3-bar-item w3-button w3-padding <?php
                if ($active == "customer" || $active == "viewcustomer") {
                    echo "w3-blue";
                } else {
                    echo "";
                }
                ?>"><i class="fa fa-users fa-fw"></i> QL Khách Hàng</a><hr>

        <a style="font-size: 20px;" href="?quanly=user" class="w3-bar-item w3-button w3-padding <?php
                if ($active == "user" || $active == "viewuser") {
                    echo "w3-blue";
                } else {
                    echo "";
                }
                ?>"><i class="fa fa-bell fa-fw"></i> QL Nhân Viên</a><hr>
    <?php } ?>
    <a style="font-size: 20px; color: red; height: 100px" href="?quanly=logout" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i> <i class="text-danger"><b>Đăng Xuất</b></i></a><hr>
    <!-- <a href="?quanly=" class="w3-bar-item w3-button w3-padding"><i class="fa fa-diamond fa-fw"></i>  News</a>
    <a href="?quanly=" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bank fa-fw"></i>  General</a>
    <a href="?quanly=" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i>  History</a>
    <a href="?quanly=" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Settings</a><br><br> -->
  </div>
</nav>

<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
