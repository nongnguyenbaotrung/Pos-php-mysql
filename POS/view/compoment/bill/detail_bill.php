<?php
// Lấy order id từ URL
$orderID = $_GET['id'];
$idnv = $_SESSION['idnhanvien'];

$khachhang = "SELECT db_customer.*,  
                   db_order.orderdate, db_order.orderCode,
                   db_user.fullname AS nhanvien 
             FROM db_order
             JOIN db_customer ON db_order.customerid = db_customer.id 
             JOIN db_user ON db_order.userid = db_user.id
             WHERE db_order.id = '$orderID'";

$row_khachang = mysqli_query($conn, $khachhang);
$customer = mysqli_num_rows($row_khachang);

if ($customer > 0) {
    $row_data = mysqli_fetch_array($row_khachang);
    $fullname = $row_data['fullname'];
    $phone = $row_data['phone'];
    $address = $row_data['address'];
    $orderdate = $row_data['orderdate']; // Lấy thời gian mua hàng
    $orderCode = $row_data['orderCode']; // Lấy orderCode
    $nhanvien = $row_data['nhanvien'];
}


$orderDetailQuery = "SELECT db_product.name AS product_name, db_orderdetail.count, db_orderdetail.price
                         FROM db_orderdetail
                         JOIN db_product ON db_orderdetail.productid = db_product.id
                         WHERE db_orderdetail.orderid = '$orderID'";

$orderDetailResult = mysqli_query($conn, $orderDetailQuery);



$orderInfoQuery = "SELECT db_order.total_billding, db_order.sale, db_order.total_checkout
                       FROM db_order
                       WHERE db_order.id = '$orderID'";

$orderInfoResult = mysqli_query($conn, $orderInfoQuery);

if ($orderInfoResult) {
    $orderInfo = mysqli_fetch_assoc($orderInfoResult);

    // Lấy thông tin cần thiết
    $totalBillding = $orderInfo['total_billding'];
    $sale = $orderInfo['sale'];
    $totalCheckout = $orderInfo['total_checkout'];
}


?>

<div class="content">
    <div class="card">
        <div class="col-md-12">
            <h1 class="text-center" style="color: red;">Chi Tiết Hoá Đơn</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <tbody>
                        <tr>
                            <th>Tên khách hàng</th>
                            <td><b><?php echo $fullname ?></b></td>
                        </tr>
                        <tr>
                            <th>Điện thoại</th>
                            <td><b><?php echo $phone ?></b></td>
                        </tr>
                        <tr>
                            <th>Thời gian mua hàng</th>
                            <td><b><?php echo $orderdate ?></b></td>
                        </tr>
                        <tr>
                            <th>Địa chỉ</th>
                            <td><b><?php echo $address ?></b></td>
                        </tr>
                        <tr>
                            <th>Mã hoá đơn</th>
                            <td><b><?php echo $orderCode ?></b></td>
                        </tr>
                        <tr>
                            <th>Nhân viên</th>
                            <td><b><?php echo $nhanvien ?></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <br />
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th>Tên sản phẩm</th>
                            <th class="text-center" style="width:100px">Số lượng</th>
                            <th class="text-right" style="width:120px">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stt = 1;
                        foreach ($orderDetailResult as $value) { ?>
                            <tr>
                                <td class="text-center"><?php echo $stt; ?></td>
                                <td><?php echo $value['product_name']  ?></td>
                                <td class="text-center"><?php echo $value['count']  ?></td>
                                <td class="text-center"><?php echo $value['price']  ?></td>
                            </tr>
                        <?php $stt++;
                        } ?>
                        <tr>
                            <td colspan="6" class="text-right" style="border: none; font-size: 1.1em;">Tổng Đơn: <b><?php echo number_format($totalBillding); ?> ₫</b></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right" style="border: none; font-size: 1.1em;">Giảm Giá: <b><?php echo number_format($sale); ?> ₫</b></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="text-right" style="border: none; color: red; font-size: 1.3em;">Thành Tiền: <b><?php echo number_format($totalCheckout); ?> ₫</b></td>
                        </tr>

                        <tr>
                            <td class="text-right" colspan="6">

                                <a class="btn btn-primary btn-md" role="button" onclick="window.print()">
                                    <span class="glyphicon glyphicon-print"></span> In đơn hàng
                                </a>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <a class="btn btn-danger float-right" href="?quanly=bill">Close</a>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <ul class="pagination">
                    </ul>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>