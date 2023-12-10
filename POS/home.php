<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include('connect.php');
$ngaythangnam = date('Y-m-d');
if (isset($_SESSION['tennhanvien'])) {
        include "view/module/topbar.php";
        include "view/module/menu.php";
?>
        <div class="w3-main" style="margin-left:300px;margin-top:43px;">
                <?php if (isset($_SESSION['success'])) { ?>
                        <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>
                                        <center><?php echo $_SESSION['success'] ?></center>
                                </strong>
                        </div>
                <?php unset($_SESSION['success']);
                } else {
                        echo "";
                } ?>
                <?php
                include "view/module/controller.php";
                include "view/module/footer.php";
                ?>
        </div>
<?php
        
} else {
        header("Location: index.php");
}
?>