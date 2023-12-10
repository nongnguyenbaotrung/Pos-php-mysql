<?php
if ($_GET['id']) {
    $id = $_GET['id'];

    $select = $conn->query("SELECT db_product.*, db_category.name AS category_name, db_category.id AS category_id
                                FROM db_product
                                JOIN db_category ON db_product.catid = db_category.id
                                WHERE db_product.id = '$id' LIMIT 1;
                                ");

    $category = $conn->query("SELECT * FROM db_category");
}

if (isset($_POST['update'])) {
    $name_product = $_POST['name'];
    $detail = $_POST['detail'];
    $catid = $_POST['catid'];
    $price = $_POST['price'];
    $created_after = $ngay_gio;

    // Kiểm tra xem có tập tin hình ảnh mới được tải lên không
    if (isset($_FILES['images']) && $_FILES['images']['error'] == UPLOAD_ERR_OK) {
        $path = "uploads/";
        $tmp_name = $_FILES['images']['tmp_name'];
        $name = $_FILES['images']['name'];
        move_uploaded_file($tmp_name, $path . $name);
        $image_url = $path . $name;

        // Sử dụng lệnh UPDATE với hình ảnh mới
        $sqlupdate = $conn->query("UPDATE `db_product` 
                                   SET `catid`='$catid', `name`='$name_product', `images`='$image_url', `detail`='$detail', `price`='$price', `created_after`='$created_after' 
                                   WHERE `id` = '$id'");
    } else {
        // Nếu không có hình ảnh mới, sử dụng lệnh UPDATE mà không bao gồm cột `images`
        $sqlupdate = $conn->query("UPDATE `db_product` 
                                   SET `catid`='$catid', `name`='$name_product', `detail`='$detail', `price`='$price', `created_after`='$created_after' 
                                   WHERE `id` = '$id'");
    }

    if ($sqlupdate) {
        echo '<script language="javascript">;
                location.replace("?quanly=product");
            </script>';
        $_SESSION['success'] = "Cập Nhật Thành Công";
    }
}


?>


<div class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Thông tin Sản Phẩm</h5>
                </div>
                <div class="card-body">
                    <?php foreach ($select as $value) { ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Tên sản phẩm</label>
                                        <input type="text" class="form-control" placeholder="Tên sản phẩm" value="<?php echo $value['name'] ?>" name="name">
                                    </div>
                                </div>
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Giá</label>
                                        <input type="text" class="form-control" placeholder="Giá" value="<?php echo $value['price'] ?>" name="price">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ảnh</label>
                                        <input class="form-control" type="file" name="images" id="">
                                        <img width="150" src="<?php echo $value['images'] ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Loại sản phẩm</label>
                                        <!-- <input type="text" class="form-control" placeholder="Username" value="" name="catid"> -->
                                        <select class="form-control" name="catid" id="">
                                            <option value="<?php echo $value['category_id'] ?>"><?php echo $value['category_name'] ?></option>
                                            <?php foreach ($category as $row) { ?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row">

                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Ngày thêm</label>
                                        <input readonly type="text" class="form-control" placeholder="Ngày thêm" value="<?php echo $value['created'] ?>" name="created">
                                    </div>
                                </div>
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Ngày sửa gần nhất</label>
                                        <input readonly type="text" class="form-control" placeholder="Ngày thêm" value="<?php echo $value['created_after'] ?>" name="created_after">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Mô tả sản phẩm</label>
                                        <textarea class="form-control textarea" name="detail"><?php echo $value['detail'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="update ml-auto mr-auto">
                                    <button type="submit" name="update" class="btn btn-success btn-round">Update</button>
                                    <a class="btn btn-danger" href="?quanly=product">Close</a>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>