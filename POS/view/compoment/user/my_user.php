<?php

$id = $_SESSION['idnhanvien'];

$user = $conn->query("SELECT * FROM db_user WHERE db_user.id  = '$id' LIMIT 1");

if (isset($_POST['btn-update'])) {
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $created_after = $ngay_gio;

    $update = $conn->query("UPDATE db_user SET `fullname`='$fullname', `password`='$password', `email`='$email', 
                            `gender`='$gender', `phone`='$phone', `address`='$address', `created_after`='$created_after' WHERE id='$id'");

    if ($update) {
        echo '<script language="javascript">;
                    location.replace("?quanly=viewmyuser");
                </script>';
        $_SESSION['success'] = "Thành Công!";
    }
}

?>


<div class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Thông tin của bạn</h5>
                </div>
                <div class="card-body">
                    <?php foreach ($user as $value) { ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Tên nhân viên</label>
                                        <input type="text" class="form-control" placeholder="Tên nhân viên" value="<?php echo $value['fullname'] ?>" name="fullname">
                                    </div>
                                </div>
                                <div class="col-md-3 pr-1">
                                    <div class="form-group">
                                        <label>Số điện thoại:</label>
                                        <input type="text" class="form-control" placeholder="Số điện thoại" value="<?php echo $value['phone'] ?>" name="phone">
                                    </div>
                                </div>
                                <div class="col-md-3 pr-1">
                                    <div class="form-group">
                                        <label>Giới tính</label>
                                        <!-- <input type="text" class="form-control" placeholder="Giới tính" value="" name="gioitinh"> -->
                                        <select class="form-control" name="gender" id="">
                                            <option value="<?php echo $value['gender'] ?>"><?php echo $value['gender'] ?></option>
                                            <option value="Nam">Nam</option>
                                            <option value="Nữ">Nữ</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3 pr-1">
                                    <div class="form-group">
                                        <label>Tên đăng nhập</label><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Tên đăng nhập" value="<?php echo $value['username'] ?>" name="username" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 pr-1">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="password" value="<?php echo $value['password'] ?>" name="password">
                                    </div>
                                </div>
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Quyền hệ thống</label>
                                        <input type="text" class="form-control" placeholder="Tên nhân viên" value="<?php echo $value['role'] ?>" name="fullname" readonly>
                                    </div>
                                </div>
                                

                            </div>
                            <div class="row">


                                <div class="col-md-3 pr-1">
                                    <div class="form-group">
                                        <label> Mail:</label><span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" placeholder="email" value="<?php echo $value['email'] ?>" name="email">
                                    </div>
                                </div>
                                <div class="col-md-3 pr-1">
                                    <div class="form-group">
                                        <label>Địa chỉ:</label>
                                        <input type="text" class="form-control" placeholder="Địa chỉ nhân viên" value="<?php echo $value['address'] ?>" name="address">
                                    </div>
                                </div>
                                <!-- </div>
                        <div class="row"> -->
                                <div class="col-md-3 pr-1">
                                    <div class="form-group">
                                        <label>Ngày thêm</label><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Ngày thêm" value="<?php echo $value['created'] ?>" name="created" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 pr-1">
                                    <div class="form-group">
                                        <label>Ngày chỉnh sửa gần đây</label><span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="" value="<?php echo $value['created_after'] ?>" name="created_after" readonly>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="update ml-auto mr-auto">
                                    <button type="submit" name="btn-update" class="btn btn-success btn-round">Update</button>
                                    <a class="btn btn-danger" href="?quanly=dashboard">Close</a>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>