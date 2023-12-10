<?php

    $id = $_GET['id'];

    $category = $conn->query("SELECT * FROM db_category WHERE db_category.id  = '$id' LIMIT 1");

    if (isset($_POST['btn-update'])) {
        $name = $_POST['name'];
        $created_at = $_POST['created_at'];
    
        $update = $conn->query("UPDATE db_category SET `name`='$name', `created_at`='$created_at' WHERE id='$id'");
    
        if ($update) {
            echo '<script language="javascript">;
                    location.replace("?quanly=category");
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
                    <h5 class="card-title">Thông tin Loại Sản Phẩm</h5>
                </div>
                <div class="card-body">
                    <?php foreach($category as $value){ ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>Tên loại sản phẩm</label>
                                    <input type="text" class="form-control" placeholder="Tên loại sản phẩm" value="<?php echo $value['name'] ?>" name="name">
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>Ngày Thêm</label>
                                    <input type="text" class="form-control" placeholder="Slug" value="<?php echo $value['created_at'] ?>" name="created_at">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="update ml-auto mr-auto">
                                <button type="submit" name="btn-update" class="btn btn-success btn-round">Update</button>
                                <!-- <button onclick="return confirm('Bạn có chắc muốn xoá loại sản phẩm này?')" 
                                type="submit" name="delete" class="btn btn-danger btn-round">Delete</button> -->
                                <a class="btn btn-danger" href="?quanly=category">Close</a>
                            </div>
                        </div>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>