<td>
    <center><a href="?quanly=unlockpro"><i class="fa fa-unlock-alt" aria-hidden="true" style='font-size:26px'></i></a></center>
    <center><a href="?quanly=lockpro"><i class="fa fa-lock" aria-hidden="true" style='font-size:26px; color: red;'></i></a></center>
</td>

<?php
echo '<script language="javascript">;
                location.replace("dashboard.php");
            </script>';
?>


<?php if (isset($_SESSION['error'])) { ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>
            <center><?php echo $_SESSION['error'] ?></center>
        </strong>
    </div>
<?php unset($_SESSION['error']);
} else {
    echo "";
} ?>


<a class="btn btn-danger" href="?quanly=category">Close</a>


<div class="d-flex justify-content-between">
    <button class="btn btn-primary" onclick="selectCustomer()">Chọn khách hàng</button>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-plus-square-o" aria-hidden="true" style="font-size: 15px;"></i> Thêm khách hàng mới
    </button>
    <form action="#" method="post">
        <!-- <input class="btn btn-danger" type="submit" value="Reset khách hàng"> -->
        <button class="btn btn-danger" onclick="">Reset khách hàng</button>
    </form>
</div>