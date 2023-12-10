<?php
$customer = $conn->query("SELECT * FROM db_customer WHERE db_customer.fullname != 'Khách Lẻ' ORDER BY db_customer.id DESC");

if (isset($_POST['btn-themcustomer'])) {
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $created = $_POST['created'];

    $them_customer = $conn->query("INSERT INTO db_customer(`fullname`,`address`,`phone`,`email`,`created`) 
                                        VALUES('$fullname','$address','$phone','$email','$created')");

    if ($them_customer) {
        echo '<script language="javascript">;
                location.replace("?quanly=customer");
            </script>';
        $_SESSION['success'] = "Thành Công!";
    }
}

if (isset($_POST['btn-tim'])) {
    $txtim = $_POST['txttim'];
    $customer = $conn->query("SELECT * FROM db_customer 
                                WHERE (db_customer.fullname LIKE '%$txtim%' OR db_customer.phone LIKE '%$txtim%')");
}
?>



<div class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Danh sách Khách hàng</h4>
                    <form style="width: 30%" class="float-left" action="" method="POST">
                        <div class="input-group no-border">
                            <input type="text" value="" name="txttim" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <button style="border:none;" type="submit" name="btn-tim">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- <a type="button" class="btn btn-success float-right" href="?quanly=removeproduct">
                        <i class="fa fa-trash" aria-hidden="true" style="font-size: 15px;"></i> THÙNG RÁC</a> -->
                    <?php if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == "Admin") { ?>
                        <button type="button" class="btn btn-primary float-right " data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-plus-square-o" aria-hidden="true" style="font-size: 15px;"></i> Thêm Khách Hàng Mới
                        </button>
                    <?php } else {
                        echo "";
                    } ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary text">
                                <th>
                                    STT
                                </th>
                                <th>
                                    Tên Khách hàng
                                </th>

                                <th>
                                    Số điện thoại
                                </th>

                                <th>
                                    Địa chỉ
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Ngày thêm TV
                                </th>
                                <!-- <th>
                                    Trạng thái
                                </th> -->
                                <th>
                                    Công cụ
                                </th>


                            </thead>
                            <tbody class="text">
                                <?php $stt=1; foreach ($customer as $value) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $stt; ?>
                                        </td>
                                        <td>
                                            <?php echo $value['fullname'] ?>
                                        </td>
                                        <td>
                                            <?php echo $value['phone'] ?>
                                        </td>
                                        <td>
                                            <?php echo $value['address'] ?>
                                        </td>
                                        <td>
                                            <?php echo $value['email'] ?>
                                        </td>
                                        <td>
                                            <?php echo $value['created'] ?>
                                        </td>
                                        

                                        <td>
                                            <!-- <a href="?quanly=viewcustomer"><i class="fa fa-eye" aria-hidden="true" style='font-size:26px'></i></a> <br> -->
                                            <?php if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == "Admin") { ?>
                                                <a onclick="return confirm('Bạn có chắc muốn xoá khách hàng này?')" href="?quanly=dellcustomer&id=<?php echo $value['id'] ?>">
                                                    <i class="fa fa-times" aria-hidden="true" style='font-size:26px; color: red;'></i>
                                                </a>
                                            <?php } else {
                                                echo "X";
                                            } ?>
                                        </td>

                                    </tr>
                                <?php $stt++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



<!-- Button to Open the Modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    ADD
</button> -->

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
                        <input type="text" class="form-control" id="name" name="fullname" >
                    </div>

                    <div class="form-group">
                        <label for="sdt">Số điện thoại:</label>
                        <input type="text" class="form-control" id="sdt" name="phone" >
                    </div>
                    <div class="form-group">
                        <label for="mail">Email:</label>
                        <input type="text" class="form-control" id="mail" name="email" >
                    </div>
                    <div class="form-group">
                        <label for="detail">Địa chỉ:</label>
                        <input type="text" class="form-control" id="adress" name="address" >
                    </div>
                    <div class="form-group">
                        <label for="sale">Ngày Thêm: </label>
                        <input type="text" class="form-control" id="status" name="created"  value="<?php echo $ngay_gio ?>">
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