<?php

$ban = "";
if (isset($_GET["id_table"]) && $_GET["id_table"] != "") {
    // Kiểm tra nếu đã chọn id bàn mới
    if (isset($_SESSION['id_table']) && $_SESSION['id_table'] != $_GET["id_table"]) {
        // Reset mảng id sản phẩm
        $_SESSION['id_product'] = array();
    }

    $_SESSION['id_table'] = $_GET["id_table"];
}

$ban = isset($_SESSION['id_table']) ? $_SESSION['id_table'] : "";



// Kiểm tra nếu có thêm id sản phẩm
if (isset($_GET["id_product"])) {

    // Đảm bảo rằng $_SESSION['cart'] là một mảng
    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    // Lấy id sản phẩm từ query string
    $id_product = $_GET["id_product"];

    // Kiểm tra xem sản phẩm đã có trong giỏ hàng hay chưa
    if (array_key_exists($id_product, $_SESSION['cart'])) {
        // Nếu đã có, tăng số lượng lên 1
        $_SESSION['cart'][$id_product]++;
    } else {
        // Nếu chưa có, thêm id vào giỏ hàng và set số lượng là 1
        $_SESSION['cart'][$id_product] = 1;
    }


    // Xóa tham số GET id_product
    // unset($_GET['id_product']);

    echo '<script language="javascript">;
                    location.replace("?pos=sanpham");
                </script>';
}

// Kiểm tra nếu có thêm id bàn
if (isset($_GET["id_table"])) {
    // Lấy tên bàn từ query string
    $_SESSION['id_table'] = $_GET["id_table"];

    // Làm mới mảng giỏ hàng khi chọn bàn mới
    $_SESSION['cart'] = array();
}
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

// nút lưu bàn
if (isset($_POST['btn_savetable'])) {
    echo '<script language="javascript">;
                    alert("✔ Đã lưu bàn!");
                    location.replace("pos_index.php");
                </script>';
    unset($_SESSION['cart']);

    $id_tbl = $ban;
    $id_products = $_POST['id_pro'];
    $qty = $_POST['quantity_item'];

    foreach ($id_products as $key => $id_product) {
        $quantity = $qty[$key];

        // Sử dụng JOIN để lấy giá gốc từ bảng db_product
        $result = $conn->query("SELECT db_table_detail.id_product, db_product.price 
                                    FROM db_table_detail 
                                    JOIN db_product ON db_table_detail.id_product = db_product.id 
                                    WHERE db_table_detail.id_table = '$id_tbl' 
                                    AND db_table_detail.id_product = '$id_product'");

        if ($result->num_rows > 0) {
            // Sản phẩm đã tồn tại, cập nhật số lượng và giá
            $row = $result->fetch_assoc();
            $price_goc = $row['price'];
            $conn->query("UPDATE db_table_detail SET quantity = quantity + '$quantity', price = '$price_goc' * quantity 
                            WHERE id_table = '$id_tbl' AND id_product = '$id_product'");
        } else {
            // Sản phẩm chưa tồn tại, thêm mới
            $update_status = $conn->query("UPDATE db_table SET `status`= '1' WHERE id_table = '$id_tbl'");
            $conn->query("INSERT INTO db_table_detail (id_table, id_product, quantity, price) 
                            SELECT '$id_tbl', '$id_product', '$quantity', price * '$quantity' 
                            FROM db_product 
                            WHERE id = '$id_product'");
        }
    }
}
// nút xoá bàn
if (isset($_POST["btn_deltable"])) {
    $id_tbl = $ban;
    $sql_del_tbl_detail = $conn->query("DELETE FROM db_table_detail WHERE id_table = '$id_tbl'");
    $update_status = $conn->query("UPDATE db_table SET `status`= '0' WHERE id_table = '$id_tbl'");
    if ($sql_del_tbl_detail) {
        echo '<script language="javascript">
                alert("✔ Đã xoá bàn!");
                location.replace("pos_index.php");
                </script>';
    } else {
        echo '<script language="javascript">
                alert("Error!");
                location.replace("pos_index.php");
                </script>';
    }
}
// nút thanh toán bill
if (isset($_POST['btn_checkout'])) {

    $orderCode  = "HD" . substr(uniqid(), -5);
    $userid = $_SESSION['idnhanvien'];
    $customerid = $_POST['customerid'];
    $orderdate = $ngay_gio;
    $total_billding = $_POST['total_billding'];
    $sale = $_POST['sale'];


    if ($sale == "0") {
        $total_checkout = $total_billding;
    } else {
        $total_checkout = $_POST['total_checkout'];
    }
    if ($total_billding != "0") {
        // Thêm hoá đơn vào bảng db_order
        $insert_order = $conn->query("INSERT INTO db_order(orderCode,userid,customerid,orderdate,total_billding,sale,total_checkout) 
                                        VALUES('$orderCode','$userid','$customerid','$orderdate','$total_billding','$sale','$total_checkout')");

        // Lấy id của hoá đơn vừa thêm
        $orderid = $conn->insert_id;

        $id_products = $_POST['id_pro'];
        $qty = $_POST['sl'];
        $gia_array = explode(',', $_POST['gia']); // Chuyển chuỗi giá thành mảng

        foreach ($qty as $key => $sl) {
            $id_sp = $id_products[$key];
            $gia = $gia_array[$key]; // Lấy giá từ mảng $gia_array

            $insert_order_details = $conn->query("INSERT INTO db_orderdetail(orderid, productid, count, price) 
                                            VALUES('$orderid', '$id_sp', '$sl', '$gia') 
                                            ON DUPLICATE KEY UPDATE count = count + '$sl'");
        }
        if ($insert_order_details) {
            echo '<script language="javascript">
                alert("✔ Thanh toán thành công!");
                location.replace("pos_index.php");
                </script>';

            $delete_data_table_detail = $conn->query("DELETE FROM db_table_detail WHERE id_table = '$ban' ");
            $update_status = $conn->query("UPDATE db_table SET `status`= '0' WHERE id_table = '$ban'");
        }
    } else {
        // Trường hợp không tìm thấy sản phẩm
        echo '<script language="javascript">';
        echo 'alertify.error("Hãy chọn sản phẩm!");';
        echo '</script>';
    }
}
// nút cập nhật item
if (isset($_POST["btn_change_bill"])) {
    $id_table_item = $ban;
    $id_item = $_POST["id_pro"];
    $quantity_item = $_POST["quantity_item"];

    foreach ($quantity_item as $key => $value) {
        $id_item_ud = $id_item[$key];

        // Sử dụng JOIN để lấy giá gốc từ bảng db_product
        $result = $conn->query("SELECT db_table_detail.id_product, db_product.price 
                                    FROM db_table_detail 
                                    JOIN db_product ON db_table_detail.id_product = db_product.id 
                                    WHERE db_table_detail.id_table = '$id_table_item' 
                                    AND db_table_detail.id_product = '$id_item_ud'");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $price_goc = $row['price'];

            // Cập nhật số lượng và giá
            $sql_ud_quantity = $conn->query("UPDATE db_table_detail 
                                                SET quantity = '$value', price = '$price_goc' * '$value'  
                                                WHERE id_table = '$id_table_item' 
                                                    AND id_product = '$id_item_ud'");
        } else {
            // Trường hợp không tìm thấy sản phẩm
            echo '<script language="javascript">';
            echo 'alertify.error("Product not found.");';
            echo '</script>';
        }
    }

    if ($sql_ud_quantity) {
        echo '<script language="javascript">
                alert("✔ Cập nhật thành công!");
                location.replace("pos_index.php");
                </script>';
    }
}
//Thêm khách hàng
if (isset($_POST['btn-themcustomer'])) {
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $created = $_POST['created'];

    $them_customer = $conn->query("INSERT INTO db_customer(`fullname`,`address`,`phone`,`email`,`created`) 
                                            VALUES('$fullname','$address','$phone','$email','$created')");

    if ($them_customer) {
        echo '<script language="javascript">
                alert("✔ Thên mới thành công!");
                location.replace("pos_index.php");
                </script>';
    }
}

?>
<div class="col-sm-4">
    <div class="bill-section">
        <center>
            <hr>
            <h2>Hoá đơn</h2>
        </center>
        <div class="show-invoice">
            <div class="table-container" style="max-height: max-content;">
                <div class="" id="customerInfo">
                    <!-- Thông tin về khách hàng và thời gian sẽ được thêm bằng JavaScript -->
                </div>
                <?php if ($ban != "") { ?>
                    <h4 class="text-center">Hoá đơn bàn: <?php echo $ban ?></h4>
                <?php } else { ?>
                    <h4 class="text-center">Hãy Chọn Bàn!!!</h4>
                <?php } ?>


                <form action="" method="post">
                    <table id="billTable" class="table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên SP</th>
                                <th>SL</th>
                                <th>Giá</th>
                                <th></th>
                            </tr>
                        </thead>
                        <div class="scrollable-table">
                            <tbody id="billListBody">
                                <?php
                                if (isset($_GET["id_table"])) {
                                    $id_tbl = $_GET["id_table"];
                                    $select_tbl = $conn->query("SELECT 
                                                                            db_table.*, 
                                                                            db_table_detail.*, 
                                                                            db_product.id AS pro_id, 
                                                                            db_product.name AS name_pro
                                                                        FROM 
                                                                            db_table
                                                                        INNER JOIN 
                                                                            db_table_detail ON db_table_detail.id_table = db_table.id_table
                                                                        INNER JOIN 
                                                                            db_product ON db_table_detail.id_product = db_product.id
                                                                        WHERE 
                                                                            db_table.id_table = '$ban';
                                                                        ");

                                    $select_status = "SELECT db_table.status FROM db_table WHERE db_table.id_table = '$ban' LIMIT 1";
                                    $row = mysqli_query($conn, $select_status);
                                    $count = mysqli_num_rows($row);
                                    if ($count == 1) {
                                        $stt = 1;
                                        $total_bill = 0;
                                        $gia_array = array();
                                        foreach ($select_tbl as $key => $value) { ?>
                                            <input type="hidden" value="<?php echo $value['id_product'] ?>" name="id_pro[]">
                                            <tr>
                                                <td><?php echo $stt; ?></td>
                                                <td><?php echo $value['name_pro'] ?></td>
                                                <td>
                                                    <input type="text" name="quantity_item[]" value="<?php echo $value['quantity'] ?>" style="width: 35px; text-align: center;">
                                                </td>
                                                <td><?php echo $value['price'] ?></td>
                                                <td class="del_item">
                                                    <a class="del_item" href="delete_item.php?item=<?php echo $value['id_product']; ?>&table=<?php echo $ban ?>">
                                                        <button type="button" class="btn-close" aria-label="Close">

                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                            $gia_array[] = $value['price']; // Lưu giá của sản phẩm vào mảng
                                            ?>
                                            <input type="hidden" value="<?php echo $value['quantity'] ?>" name="sl[]">
                                        <?php
                                            $stt++;
                                            $total_bill += $value['price'];
                                        } ?>
                                        <input type="hidden" value="<?php echo implode(',', $gia_array); ?>" name="gia">
                                    <?php }
                                } else {
                                    $stt = 1;
                                    $total_bill = 0;
                                    $gia_array = array(); // Mảng để lưu giá của từng sản phẩm

                                    foreach ($cart as $id_product => $quantity) {
                                        $query = $conn->query("SELECT `id`, `name`, `price` FROM db_product WHERE id = '$id_product'");
                                        $row = $query->fetch_assoc();
                                        $thanhtien = $row['price'] * $quantity;
                                        $id_pro = $row['id'];
                                    ?>
                                        <input type="hidden" value="<?php echo $id_pro ?>" name="id_pro[]">
                                        <tr>
                                            <td><?php echo $stt; ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td>
                                                <input type="text" name="quantity_item[]" value="<?php echo $quantity ?>" style="width: 35px; text-align: center;">
                                            </td>
                                            <td><?php echo $thanhtien ?></td>
                                            <!--  -->
                                        </tr>
                                        <?php
                                        $gia_array[] = $thanhtien; // Lưu giá của sản phẩm vào mảng
                                        ?>
                                        <input type="hidden" value="<?php echo $quantity ?>" name="sl[]">
                                    <?php
                                        $stt++;
                                        $total_bill += $thanhtien;
                                    } ?>
                                    <input type="hidden" value="<?php echo implode(',', $gia_array); ?>" name="gia"><br>
                                <?php } ?>
                            </tbody>
                        </div>
                    </table>
            </div>
            <!-- Thêm menu dropdown (select) để chọn tên khách hàng -->
            <div class="row">
                <div class="col-md-12 mt-3">
                    <!-- // $select_statuss = "SELECT db_table.status FROM db_table WHERE db_table.id_table = '$ban' LIMIT 1";
                            // $row = mysqli_query($conn, $select_statuss);
                            // $countt = mysqli_num_rows($row); -->
                    <button type="submit" name="btn_deltable" class="btn btn-bg btn-danger float-left" style="width: 150px;">
                        <i class="fa fa-close" aria-hidden="true" style="font-size: 15px;"></i> Xoá Bàn</button>
                    <button type="submit" name="btn_savetable" class="btn btn-bg btn-success float-right" style="width: 150px;">
                        <i class="fa fa-save" aria-hidden="true" style="font-size: 15px;"></i> Lưu Bàn</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary float-right " data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-plus-square-o" aria-hidden="true" style="font-size: 15px;"></i> Thêm Khách Hàng Mới
                    </button>
                    <label for="customerSelect">Chọn khách hàng:</label>
                    <select id="customerSelect" class="form-control" name="customerid">
                        <option value="75">Khách Lẻ</option>
                        <?php foreach ($db_customer as $value) { ?>
                            <option value="<?php echo $value['id'] ?>"><?php echo $value['fullname'] ?></option>
                        <?php } ?>
                        <!-- Thêm các tên khách hàng khác vào đây -->
                    </select>
                </div>


            </div>
            <!-- Phần giảm giá -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="">
                        <label for="discountType">Loại giảm giá:</label>
                        <select id="discountType" class="form-control" onchange="calculateTotalAmount()">
                            <option value="percent">Giảm theo %</option>
                            <option value="amount">Giảm theo giá tiền</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="discountValue">Số tiền giảm giá:</label>
                        <input type="number" id="discountValue" class="form-control" placeholder="Nhập số tiền giảm giá" onchange="calculateTotalAmount()">
                    </div>
                </div>
            </div>
            <p>Tổng đơn: <b id="totalAmount"><?php echo $total_bill ?> </b>VND</p>
            <p>Số tiền giảm: <b id="discountAmountDisplay">0 </b> VND</p>
            <p>Tổng tiền sau giảm: <b id="totalAfterDiscountDisplay">0 </b> VND</p>
            <input type="hidden" id="totalAmount" name="total_billding" value="<?php echo $total_bill ?>">
            <input type="hidden" id="discountAmount" name="sale" value="0">
            <input type="hidden" id="totalAfterDiscount" name="total_checkout" value="0">
            <div class="d-flex justify-content-between">
                <button class="btn btn-warning" name="btn_checkout">
                    <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 20px;"></i> Thanh toán
                </button>
                <button class="btn btn-success" name="btn_change_bill">
                    <i class="fa fa-exchange" aria-hidden="true" style="font-size: 20px;"></i> Cập nhật hoá đơn
                </button>

                <button class="btn btn-secondary ml-2" onclick="printBill()">
                    <i class="fa fa-print" aria-hidden="true" style="font-size: 20px;"></i> In hoá đơn</button>

                <!-- <button class="btn btn-danger" onclick="clearBill()">Xoá toàn bộ</button> -->
                <!-- data-toggle="modal" data-target="#addProduct" -->
            </div>
            </form>
        </div>
    </div>
</div>
<!-- The Modal ADD -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Thêm Khách hàng</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" method="POST">

                    <div class="form-group">
                        <label for="name">Tên Khách hàng:</label>
                        <input type="text" class="form-control" id="name" name="fullname">
                    </div>

                    <div class="form-group">
                        <label for="sdt">Số điện thoại:</label>
                        <input type="text" class="form-control" id="sdt" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="mail">Email:</label>
                        <input type="text" class="form-control" id="mail" name="email">
                    </div>
                    <div class="form-group">
                        <label for="detail">Địa chỉ:</label>
                        <input type="text" class="form-control" id="adress" name="address">
                    </div>
                    <div class="form-group">
                        <label for="sale">Ngày Thêm: </label>
                        <input type="text" class="form-control" id="status" name="created" value="<?php echo $ngay_gio ?>">
                    </div>
                    <!-- 
                        <div class="form-group">
                            <label for="price_sale">Giá sau khi giảm (%):</label>
                            <input type="number" class="form-control" id="price_sale" name="price_sale" required>
                        </div> -->
                    <button type="submit" name="btn-themcustomer" name="btn-themcustomer" class="btn btn-primary">Thêm khách hàng</button>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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