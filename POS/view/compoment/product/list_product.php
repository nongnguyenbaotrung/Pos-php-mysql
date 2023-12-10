<?php
$category = $conn->query("SELECT * FROM db_category");
$product = $conn->query("SELECT db_product.*, db_category.name as tenloaisp
                            FROM db_product, db_category
                            WHERE db_product.catid = db_category.id ORDER BY db_product.id DESC");

if (isset($_POST['btn-tim'])) {
    $txtim = $_POST['txttim'];
    $product = $conn->query("SELECT db_product.*, db_category.name as tenloaisp
                                FROM db_product, db_category
                                WHERE db_product.catid = db_category.id 
                                AND (db_product.name LIKE '%$txtim%' OR db_category.name LIKE '%$txtim%')");
}

if (isset($_POST['addProduct'])) {
    $name_product = $_POST['name'];
    $detail = $_POST['detail'];
    $catid = $_POST['catid'];
    $price = $_POST['price'];
    $created = $_POST['created'];

    $path = "uploads/"; // Ảnh sẽ lưu vào thư mục images
    $tmp_name = $_FILES['images']['tmp_name'];
    $name = $_FILES['images']['name'];
    // Upload ảnh vào thư mục images
    move_uploaded_file($tmp_name, $path . $name);
    $image_url = $path . $name;
    $sqlinsert = $conn->query("INSERT INTO `db_product`(`catid`, `name`, `images`, `detail`, `price`, `created`) 
    VALUES ('$catid','$name_product','$image_url','$detail','$price','$created')");
    if ($sqlinsert) {
        echo '<script language="javascript">;
                location.replace("?quanly=product");
            </script>';
        $_SESSION['success'] = "Thêm Thành Công";

        // echo '<script language="javascript">';
        // echo 'alert(Thanh cong)';  //not showing an alert box.
        // echo '</script>';
        // exit;

    }
}
?>



<div class="content">
    <!-- Button to Open the Modal -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Danh sách Sản phẩm</h4>
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
                            <i class="fa fa-plus-square-o" aria-hidden="true" style="font-size: 15px;"></i> Thêm Sản Phẩm Mới
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
                                    Tên sản phẩm
                                </th>

                                <th>
                                    Giá tiền
                                </th>

                                <th>
                                    Ảnh
                                </th>
                                <th>
                                    Loại sản phẩm
                                </th>
                                <!-- <th>
                                    Trạng thái
                                </th> -->
                                <th>
                                    Công cụ
                                </th>


                            </thead>
                            <tbody class="">
                                <?php $stt = 1;
                                foreach ($product as $key => $vlaue) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $stt++ ?>
                                        </td>
                                        <td>
                                            <?php echo $vlaue['name']; ?>
                                        </td>
                                        <td>
                                            <?php echo number_format($vlaue['price']); ?>
                                        </td>

                                        <!-- anh sp -->
                                        <td>
                                            <img src="<?php echo $vlaue['images']; ?>" width="80px" alt="">
                                        </td>
                                        <td>
                                            <?php echo $vlaue['tenloaisp']; ?>
                                        </td>

                                        <td>
                                            <?php if (isset($_SESSION['quyen']) && $_SESSION['quyen'] == "Admin") { ?>
                                                <a href="?quanly=viewproduct&id=<?php echo $vlaue['id'] ?>"><i class="fa fa-eye" aria-hidden="true" style='font-size:26px'></i></a> <br>
                                                <a onclick="return confirm('Bạn có chắc muốn xoá sản phẩm này?')" href="?quanly=dellproduct&id=<?php echo $vlaue['id'] ?>">
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



<!-- The Modal ADD -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Thêm Sản Phẩm</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" class="form-control" placeholder="Tên sản phẩm" value="" name="name">
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Giá</label>
                                <input type="text" class="form-control" placeholder="Giá" value="" name="price">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ảnh</label>
                                <input class="form-control" type="file" name="images" id="">
                                <img height="200" src="" alt="">
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Loại sản phẩm</label>
                                <!-- <input type="text" class="form-control" placeholder="Username" value="" name="catid"> -->
                                <select class="form-control" name="catid" id="">
                                    <?php foreach ($category as $row) { ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <!-- <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Số lượng đã bán</label>
                                        <input type="text" class="form-control" placeholder="Ngày thêm" value="" name="created">
                                    </div>
                                </div> -->
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Ngày thêm</label>
                                <input type="text" class="form-control" placeholder="Ngày thêm" value="<?php echo $ngay_gio ?>" name="created">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Mô tả sản phẩm</label>
                                <textarea class="form-control textarea" name="detail"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="update ml-auto mr-auto">
                            <button type="submit" name="addProduct" class="btn btn-success btn-round">Thêm Mới</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>