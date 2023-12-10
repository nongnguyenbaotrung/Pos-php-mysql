<?php
$billQuery = "SELECT db_order.*, db_customer.fullname as customer_name
                FROM db_order
                JOIN db_customer ON db_order.customerid = db_customer.id ORDER BY db_order.id DESC";

$billResult = $conn->query($billQuery);


if (isset($_POST['btn-tim'])) {
    $txtim = $_POST['txttim'];
    $billResult = $conn->query("SELECT db_order.*, db_customer.fullname as customer_name
                                FROM db_order
                                JOIN db_customer ON db_order.customerid = db_customer.id
                                AND (db_customer.fullname LIKE '%$txtim%' OR db_order.total_checkout LIKE '%$txtim%'
                                OR db_order.orderdate LIKE '%$txtim%')");
}

if (isset($_POST['btn-loc'])) {
    $billQuery = "SELECT db_order.*, db_customer.fullname as customer_name
    FROM db_order
    JOIN db_customer ON db_order.customerid = db_customer.id  
    WHERE DATE(orderdate) = '$get_year-$get_month-$get_day'
    ORDER BY db_order.id DESC";

    $billResult = $conn->query($billQuery);
}
?>

<div class="content">

    <!-- bang -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Danh sách Hóa đơn</h4>
                    <form style="width: 30%" class="float-left" method="POST" action="">
                        <div class="input-group no-border">
                            <input type="text" value="" name="txttim" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <button style="border:none" type="submit" name="btn-tim">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="" method="post">
                        <input class="btn btn-primary" type="submit" name="btn-loc" value="Hoá đơn hôm nay">
                    </form>

                    <!-- <a type="button" class="btn btn-success float-right" href="?quanly=removeproduct">
                        <i class="fa fa-trash" aria-hidden="true" style="font-size: 15px;"></i> THÙNG RÁC</a> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary text-center">
                                <th>
                                    STT
                                </th>

                                <th>
                                    Mã Hoá Đơn
                                </th>
                                <th>
                                    Tên Khách Hàng
                                </th>
                                <th>
                                    Ngày Lập
                                </th>

                                <th>
                                    Tổng tiền
                                </th>
                                <th>
                                    Tool
                                </th>

                            </thead>
                            <tbody class=" text-center">
                                <?php
                                $stt = 1;
                                foreach ($billResult as $key => $value) { ?>

                                    <tr>
                                        <td>
                                            <?php echo $stt ?>
                                        </td>
                                        <td>
                                            <?php echo $value['orderCode'] ?>
                                        </td>
                                        <td>
                                            <?php echo $value['customer_name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $value['orderdate'] ?>
                                        </td>
                                        <td>
                                            <?php echo number_format($value['total_checkout']) ?>
                                        </td>
                                        <td>

                                            <a href="?quanly=viewbill&id=<?php echo $value['id'] ?>"><i class="fa fa-eye" aria-hidden="true" style='font-size:26px'></i></a> <br>
                                            <?php if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == "Admin") { ?>
                                                <a onclick="return confirm('Bạn có chắc muốn xoá hóa đơn này?')" href="?quanly=dellbill&orderID=<?php echo $value['id'] ?>">
                                                    <i class="fa fa-times" aria-hidden="true" style='font-size:26px; color: red;'></i>
                                                </a>
                                            <?php } else {
                                                echo "X";
                                            } ?>
                                        </td>

                                    </tr>
                                <?php $stt++;
                                } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <style>
        .container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .row {
            flex-grow: 1;
            margin-bottom: 20px;
        }

        .bill-section {
            position: sticky;
            top: 0;
            align-self: flex-start;
        }

        /* Các luật CSS hiển thị nút xoá trên từng sản phẩm mặc định */
        .btn-delete {
            display: block;
        }

        /* Ẩn nút xoá trên từng sản phẩm khi in */
        @media print {
            .btn-delete-print {
                display: none;
            }
        }

        .table-container {
            max-height: 300px;
            /* Điều chỉnh chiều cao tối đa của khung cuộn */
            overflow-y: auto;
            /* Hiển thị thanh cuộn dọc khi nội dung vượt quá chiều cao tối đa */
        }

        .scrollable-table {
            /* Thêm padding phía trên và phía dưới để tạo khoảng trống giữa khung cuộn và bảng */
            padding-top: 10px;
            padding-bottom: 10px;
        }
    </style>




</div>