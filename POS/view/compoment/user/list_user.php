<?php
$user = $conn->query("SELECT * FROM db_user ORDER BY db_user.id DESC");

if (isset($_POST['btn-themuser'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $role = $_POST['role'];
    $created = $_POST['created'];

    $them_user = $conn->query("INSERT INTO db_user(`fullname`,`username`,`password`,`role`,`email`,`gender`,`phone`,`address`,`created`) VALUES('$fullname','$username','$password','$role','$email','$gender','$phone','$address','$created')");

    if ($them_user) {
        echo '<script language="javascript">;
                location.replace("?quanly=user");
            </script>';
        $_SESSION['success'] = "Thành Công!";
    }
}

if (isset($_POST['btn-tim'])) {
    $txtim = $_POST['txttim'];
    $user = $conn->query("SELECT * FROM db_user WHERE (db_user.fullname LIKE '%$txtim%' OR db_user.phone LIKE '%$txtim%')");
}
?>


<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Danh sách Nhân viên</h4>
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

                    <!-- <a type="button" class="btn btn-success float-right" href="?quanly=removeproduct">
                        <i class="fa fa-trash" aria-hidden="true" style="font-size: 15px;"></i> THÙNG RÁC</a> -->
                    <?php if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == "Admin") { ?>
                        <button type="button" class="btn btn-primary float-right " data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-plus-square-o" aria-hidden="true" style="font-size: 15px;"></i> Thêm Nhân Viên Mới
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
                                    Tên nhân viên
                                </th>
                                <th>
                                    Số điện thoại
                                </th>
                                <th>
                                    Địa chỉ
                                </th>

                                <th>
                                    Quyền hệ thông
                                </th>

                                <th>
                                    Công cụ
                                </th>


                            </thead>
                            <tbody class="text">
                                <?php $stt=1; foreach($user as $value){ ?>
                                <tr>
                                    <td>
                                        <?php echo $stt ?>
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
                                        <?php echo $value['role'] ?>
                                    </td>

                                    <td>
                                        <?php if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == "Admin") { ?>
                                            <a href="?quanly=viewuser&id=<?php echo $value['id']?>"><i class="fa fa-eye" aria-hidden="true" style='font-size:26px'></i></a> <br>
                                            <a onclick="return confirm('Bạn có chắc muốn xoá tài khoản này này?')" href="?quanly=delluser&id=<?php echo $value['id']?>">
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
                <h4 class="modal-title">Thêm Nhân viên</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" method="POST">

                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Tên nhân viên</label>
                                <input type="text" class="form-control" placeholder="Tên nhân viên" value="" name="fullname">
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Giới tính</label>
                                <!-- <input type="text" class="form-control" placeholder="Giới tính" value="" name="gioitinh"> -->
                                <select class="form-control" name="gender" id="">
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Số điện thoại:</label>
                                <input type="text" class="form-control" placeholder="Số điện thoại" value="" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label> Mail:</label><span class="text-danger">*</span></label>
                                <input type="email" class="form-control" placeholder="email" value="" name="email">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Tên đăng nhập</label><span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Tên đăng nhập" value="" name="username">
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="password" value="" name="password">
                            </div>
                        </div>

                    </div>
                    <div class="row">



                        <div class="col-md-12 pr-1">
                            <div class="form-group">
                                <label>Địa chỉ:</label>
                                <input type="text" class="form-control" placeholder="Địa chỉ nhân viên" value="" name="address">
                            </div>
                        </div>
                        <!-- </div>
                        <div class="row"> -->
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Quyền hệ thống</label>
                                <!-- <input type="text" class="form-control" placeholder="Giới tính" value="" name="gioitinh"> -->
                                <select class="form-control" name="role" id="">
                                    <option value="NhanVien">Nhân Viên</option>
                                    <option value="Admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Ngày thêm</label><span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Ngày thêm" value="<?php echo $ngay_gio ?>" name="created">
                            </div>
                        </div>

                    </div>

                    <!-- 
                        <div class="form-group">
                            <label for="price_sale">Giá sau khi giảm (%):</label>
                            <input type="number" class="form-control" id="price_sale" name="price_sale" required>
                        </div> -->
                    <button type="submit" name="btn-themuser" class="btn btn-primary">Thêm Nhân viên</button>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>