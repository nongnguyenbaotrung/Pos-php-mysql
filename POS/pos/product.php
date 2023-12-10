<?php
$category_list = $conn->query("SELECT * FROM db_category");

if (isset($_POST['btn_loc']) && $_POST['catid'] != "") {
    $catid = $_POST['catid'];
    $product = $conn->query("SELECT * FROM db_product WHERE catid = '$catid'");
} else {
    $product = $conn->query("SELECT * FROM db_product");
}


if (isset($_POST['btn-tim'])) {
    $txtim = $_POST['txttim'];
    $product = $conn->query("SELECT * FROM db_product WHERE db_product.name LIKE '%$txtim%'");
}

?>


<div class="row">
    <div class="col-md-6">
        <div class="dropdown dropright">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="width:50%;">
                Tìm theo loại sản phẩm
            </button>
            <div class="dropdown-menu" style="min-width: 500px;">
                <center>
                    <div class="row">
                        <form action="" method="post">
                            <div class="col-sm-6">
                                <input type="hidden" name="catid" value="">
                                <button name="btn_loc" style="width: 200px; margin-bottom: 20px;" class="btn btn-primary b-4 mr-4">
                                    Tất cả sản phẩm
                                </button>
                            </div>
                        </form>
                        <?php foreach ($category_list as $value) { ?>
                            <form action="" method="post">
                                <div class="col-sm-6">
                                    <input type="hidden" name="catid" value="<?php echo $value['id'] ?>">
                                    <button name="btn_loc" style="width: 200px; margin-bottom: 10px;" class="btn btn-success b-4 mr-4">
                                        <?php echo $value['name'] ?>
                                    </button>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                </center>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <form action="" method="post" class="pull-right mr-2" style="width:80%;">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search..." name="txttim" style="min-width: 100px;">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" name="btn-tim">
                        <i class="fa fa-search" style="width: 50px;"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row mr-1 show-product product-container">
    <?php
    foreach ($product as $key => $value) {
    ?>
        <div class="col-md-3 mt-2">
            <a href="?pos=sanpham&id_product=<?php echo $value['id'] ?>" class="text-dark" style="text-decoration: none;;">
                <div class="row mb-3 show-product mr-2" style="min-width: min-content; margin-left: 1px;">
                    <div class="col-md-6">
                        <img height="50" src="../<?php echo $value['images'] ?>" class="card-img-top img-product" alt="">
                        <p style="font-weight: bold;;text-align:left; color: red;" class="card-text"><?php echo number_format($value['price']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="card-text mt-1" style="clear:both;max-height:150px;min-width: min-content;"><?php echo $value['name'] ?></h6>
                    </div>
                </div>
            </a>
        </div>
    <?php
    }
    ?>
</div>

<!-- <div class="row mt-4 mr-2 show-product product-container">
<?php
foreach ($product as $key => $value) {
?>
    <div class="col-3 mt-2">
        <a href="okla" class="text-dark" style="text-decoration: none;;">
            <div class="card mb-2 card-product">
                <div class="card card-user img-product">
                    <div class="col-md-10 mt-1 mb-1">
                        <img src="../uploads/<?php echo $value['images'] ?>" height="100px" class="img-product" alt="">
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $value['name'] ?></h5>
                    <p class="card-text"><?php echo $value['price'] ?></p>
                </div>
            </div>
        </a>
    </div>
<?php
}
?>
</div> -->