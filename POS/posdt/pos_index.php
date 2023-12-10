<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MƠ MƠ POS</title>



</head>
<?php
include "../connect.php";

$table = $conn->query("SELECT * FROM db_table");
$db_customer = $conn->query("SELECT * FROM db_customer");



date_default_timezone_set('Asia/Ho_Chi_Minh');
$ngay_gio = date('Y-m-d H:i:s');



session_start();
if (isset($_SESSION["tennhanvien"])) { ?>
    <!-- $tennhanvien = $_SESSION["tennhanvien"]; -->

    <body>
        <!-- A grey horizontal navbar that becomes vertical on small screens -->
        <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
            <ul class="navbar-nav ml-auto"> <!-- Sử dụng ml-auto ở đây -->
                <li class="nav-item active">
                    <!-- <img src="../img/logo2.jpg" width="10px" alt="">
                    <a class="nav-link" href="#"><b>MƠ MƠ POS</b></a> -->
                    <a class="navbar-brand" href="pos_index.php">
                        <img src="../img/logo2.png" alt="Logo" style="width:50px;"><b>MƠ MƠ POS</b>
                    </a>
                </li>
            </ul>
            <div class="dropdown">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    Nhân Viên <?php echo $_SESSION['tennhanvien'] ?>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="../home.php"><b>Xem Tổng Quan</b></a>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../home.php?quanly=viewmyuser">Thông Tin Cá Nhân</a>
                    <a class="dropdown-item text-danger" href="../home.php?quanly=logout"><i>Đăng Xuất</i></a>
                    <div class="dropdown-divider"></div>
                    <!-- <a class="dropdown-item" href="#" onclick="toggleFullScreen()">F11 Để Toàn Màn Hình</a> -->
                </div>
            </div>
        </nav>



        <div class="mt-4 mr-3 ml-4">
            <div class="row">
                <!-- Danh sách sản phẩm bên trái -->
                <div class="">
                    <!-- <h3 class="text-center t-up hide">Danh sách bàn</h3> -->
                    <!-- DANH SÁCH BÀN -->
                    <?php include "controller_pos.php"; ?>
                    <center>
                        <!-- <h3 class="text-center t-up hide mt-4">Danh sách sản phẩm</h3> -->
                    </center>
                    <!-- DANH SÁCH SẢN PHẨM -->

                </div>
                <!-- Hoá đơn bên phải -->

            </div>
        </div>




        <script>
            let bill = [];

            function addProduct(name, price) {
                let productIndex = bill.findIndex(item => item.name === name);
                if (productIndex !== -1) {
                    bill[productIndex].quantity++;
                } else {
                    bill.push({
                        name: name,
                        price: price,
                        quantity: 1
                    });
                }
                updateBill();
            }

            function updateBill() {
                let billTableBody = document.getElementById('billListBody');
                billTableBody.innerHTML = '';
                let totalAmount = 0;

                bill.forEach((item, index) => {
                    totalAmount += item.price * item.quantity;

                    let row = billTableBody.insertRow(); // Thêm một dòng mới vào tbody

                    let nameCell = row.insertCell(); // Thêm ô chứa tên sản phẩm
                    nameCell.innerText = item.name;

                    let priceCell = row.insertCell(); // Thêm ô chứa giá sản phẩm
                    priceCell.innerText = item.price.toLocaleString() + ' VND'; // Sửa định dạng giá tiền

                    let quantityCell = row.insertCell(); // Thêm ô chứa số lượng sản phẩm
                    quantityCell.innerText = item.quantity;

                    let totalCell = row.insertCell(); // Thêm ô chứa thành tiền sản phẩm
                    let total = item.price * item.quantity;
                    totalCell.innerText = total.toLocaleString() + ' VND'; // Sửa định dạng thành tiền

                    let deleteCell = row.insertCell(); // Thêm ô chứa nút xoá từng sản phẩm
                    let deleteButton = document.createElement('button');
                    deleteButton.className = 'btn btn-danger btn-sm btn-delete-print';
                    deleteButton.innerText = 'Xoá';
                    deleteButton.onclick = () => removeProduct(index);
                    deleteCell.appendChild(deleteButton);
                });

                // Cập nhật tổng tiền
                document.getElementById('totalAmount').innerText = totalAmount.toLocaleString();
            }

            // Function để tạo bảng hoá đơn và điền dữ liệu vào bảng
            function updateBillTable() {
                let billTableBody = document.getElementById('billTable');
                billTableBody.innerHTML = '';
                let totalAmount = 0;
                bill.forEach((item, index) => {
                    let row = billTableBody.insertRow();
                    let nameCell = row.insertCell();
                    let priceCell = row.insertCell();
                    let quantityCell = row.insertCell();
                    let totalCell = row.insertCell();
                    let deleteCell = row.insertCell();

                    nameCell.innerText = item.name;
                    priceCell.innerText = item.price;
                    quantityCell.innerText = item.quantity;
                    let total = item.price * item.quantity;
                    totalAmount += total;
                    totalCell.innerText = total;
                });

                // Cập nhật tổng tiền
                let totalAmountElement = document.getElementById('totalAmount');
                totalAmountElement.innerText = totalAmount.toFixed(0);

                // Cập nhật số tiền giảm và tổng tiền sau giảm
                calculateTotalAmount();
            }

            // Function để tính toán tổng tiền và giá trị giảm giá
            function calculateTotalAmount() {
                let totalAmount = document.getElementById("totalAmount").textContent;
                let discountAmount = 0;
                bill.forEach((item) => {
                    totalAmount += item.price * item.quantity;
                });

                let discountValue = parseFloat(document.getElementById('discountValue').value);
                let discountType = document.getElementById('discountType').value;
                if (discountType === 'amount') {
                    discountAmount = discountValue;
                } else if (discountType === 'percent') {
                    discountAmount = (discountValue / 100) * totalAmount;
                }

                let totalAfterDiscount = totalAmount - discountAmount;

                // Cập nhật các giá trị vào giao diện
                document.getElementById('totalAmount').innerText = totalAmount;
                document.getElementById('discountAmountDisplay').innerText = discountAmount;

                document.getElementById('totalAfterDiscountDisplay').innerText = totalAfterDiscount;

                $(document).ready(function() {
                    // Lấy giá trị của thẻ <b> và gán cho giá trị của thẻ <input>
                    discountAmount = $("#discountAmountDisplay").text();
                    $("#discountAmount").val(discountAmount);
                });

                $(document).ready(function() {
                    // Lấy giá trị của thẻ <b> và gán cho giá trị của thẻ <input>
                    discountAmount = $("#totalAfterDiscountDisplay").text();
                    $("#totalAfterDiscount").val(discountAmount);
                });
            }



            function printBill() {

                // Ẩn nút "delete item" trước khi chuẩn bị nội dung cho in
                document.querySelectorAll('.btn-close').forEach(function(btn) {
                    btn.style.display = 'none';
                });

                // Lấy tất cả các hàng (tr) trong bảng
                var rows = document.querySelectorAll('#billTable tbody tr');

                // Duyệt qua từng hàng
                rows.forEach(function(row) {
                    // Lấy tất cả các ô (td) trong hàng
                    var cells = row.querySelectorAll('td');

                    // Ẩn ô ở vị trí cần ẩn (ví dụ: ẩn cột thứ 2)
                    cells[4].style.display = 'none';
                });


                var customerid = document.getElementById('customerSelect').value;
                var customerName = document.getElementById('customerSelect').options[document.getElementById('customerSelect').selectedIndex].text;

                let customerInfo = `
        <div style="text-align: center;">
        <h2>Mơ Mơ 9923 - Vĩnh Long</h2>
        <p>Địa chỉ: 27 lý tự trọng phường 2 thành phố Vĩnh long</p>
        <p>Số điện thoại: 056 505 9923</p>
        <h2 class="text-center">Hoá Đơn Bán Hàng</h2>
        <p><b>Khách hàng:</b> ${customerName}</p>
        </div>
    `;

                const currentTime = new Date();
                const formattedTime = currentTime.toLocaleString();
                customerInfo += `
        <p><b>Thời gian:</b> ${formattedTime}</p>
    `;

                var billTable = document.getElementById('billListBody').cloneNode(true);
                var totalAmount = document.getElementById('totalAmount').innerText;
                var discountAmount = document.getElementById('discountAmountDisplay').innerText;
                var totalAfterDiscount = document.getElementById('totalAfterDiscountDisplay').innerText;

                var printWindow = window.open('', '', 'height=500,width=1100');
                printWindow.document.write('<html><head><title>Hoá Đơn</title>');
                printWindow.document.write('<style>body{font-family: "Arial", sans-serif;}');
                printWindow.document.write('@page { size: 130mm 1000mm; }</style>');
                printWindow.document.write('</head><body>');
                printWindow.document.write(customerInfo);
                printWindow.document.write('<table border="1" style="width:100%;">');
                printWindow.document.write('<thead><tr><th>STT</th><th>Tên sản phẩm</th><th>Số lượng</th><th>Thành tiền</th></tr></thead>');
                printWindow.document.write('<tbody style="text-align: center;">' + billTable.innerHTML + '</tbody>');
                printWindow.document.write('</table>');
                printWindow.document.write('<p style="text-align: right;">Tổng tiền: <b>' + totalAmount.toLocaleString() + ' </b></p>');
                printWindow.document.write('<p style="text-align: right;">Số tiền giảm: <b>' + discountAmount.toLocaleString() + ' </b></p>');
                printWindow.document.write('<p style="text-align: right;">Tổng tiền sau giảm: <b>' + totalAfterDiscount.toLocaleString() + ' </b></p>');
                printWindow.document.write('<p style="text-align: center;"><b>Cảm ơn quý khách! Hẹn gặp lại!</b></p>');
                printWindow.document.write('</body></html>');
                printWindow.document.close();

                printWindow.print();
            }
        </script>

    <?php } else {
    header('Location:../');
}

    ?>

</html>