<?php 
    include "../connect.php";
    if(isset($_POST['addProduct'])){
        $name_product = $_POST['name'];
        $detail = $_POST['detail'];
        $price_in = $_POST['price_in'];
        $price_out = $_POST['price_out'];

        $path = "../uploads/"; // Ảnh sẽ lưu vào thư mục images
        $tmp_name = $_FILES['images']['tmp_name'];
        $name = $_FILES['images']['name'];
        // Upload ảnh vào thư mục images
        move_uploaded_file($tmp_name, $path . $name);
        $image_url = $path . $name;
        $sqlinsert = $conn->query("INSERT INTO `db_product`(`catid`, `name`, `images`, `detail`, `number_buy`, `price`, `created`) 
        VALUES ('1','$name_product','$image_url','$detail','$price_in','$price_out','20/11/2023')");
        if($sqlinsert){ 
            header("Location:pos.php");

            echo '<script language="javascript">';
            echo 'alert(Thanh cong)';  //not showing an alert box.
            echo '</script>';
            exit;
            
        }
        
    }
?>