<?php
$category = $conn->query("SELECT * FROM db_category ORDER BY db_category.id DESC");

if (isset($_POST['btn-themcategory'])) {
    $name = $_POST['name'];
    $created_at = $_POST['created_at'];

    $them_loai = $conn->query("INSERT INTO db_category(`name`,`created_at`) VALUES('$name','$created_at')");

    if ($them_loai) {
        echo '<script language="javascript">;
                location.replace("?quanly=category");
            </script>';
        $_SESSION['success'] = "Thành Công!";
    }
}

if (isset($_POST['btn-tim'])) {
    $txtim = $_POST['txttim'];
    $category = $conn->query("SELECT * FROM db_category WHERE db_category.name LIKE '%$txtim%'");
}
?>

<div class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Danh sách Loại Sản phẩm</h4>


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
                            <i class="fa fa-plus-square-o" aria-hidden="true" style="font-size: 15px;"></i> Thêm Loại Mới
                        </button>
                    <?php } else {
                        echo "";
                    } ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                    STT
                                </th>
                                <th>
                                    Tên loại sản phẩm
                                </th>

                                <th>
                                    Ngày Thêm
                                </th>
                                <th>
                                    Công cụ
                                </th>
                            </thead>
                            <tbody class="">
                                <?php $stt = 1;
                                foreach ($category as $value) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $stt ?>
                                        </td>
                                        <td>
                                            <?php echo $value['name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $value['created_at'] ?>
                                        </td>
                                        <td>
                                            <?php if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == "Admin") { ?>
                                                <a href="?quanly=viewcategory&id=<?php echo $value['id'] ?>"><i class="fa fa-eye" aria-hidden="true" style='font-size:26px'></i></a> <br>
                                                <a onclick="return confirm('Bạn có chắc muốn xoá loại sản phẩm này?')" href="?quanly=dellcategory&id=<?php echo $value['id'] ?>">
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
                <h4 class="modal-title">Thêm Loại Sản Phẩm</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" method="POST">

                    <div class="form-group">
                        <label for="name">Tên Loại sản phẩm:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="price_sale">Ngày Thêm:</label>
                        <input type="text" class="form-control" id="price_sale" name="created_at" required value="<?php echo $ngay_gio; ?>">
                    </div>

                    <button type="submit" name="btn-themcategory" class="btn btn-primary">Thêm loại sản phẩm</button>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>