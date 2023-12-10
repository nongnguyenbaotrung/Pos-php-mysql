<?php 
    if(isset($_GET["quanly"])){
        $temp = $_GET["quanly"];
    } else{
        $temp = "";
    }

    if ($temp=="dashboard") {
      include "view/compoment/dashboard.php";
    }

    elseif($temp=="bill"){
      include "view/compoment/bill/list_bill.php";
    }
    elseif($temp=="viewbill"){
      include "view/compoment/bill/detail_bill.php";
    }
    elseif($temp=="dellbill" && $_SESSION['quyen'] == "Admin"){
      include "view/compoment/bill/del_bill.php";
    }
    elseif($temp=="removebill" && $_SESSION['quyen'] == "Admin"){
      include "view/compoment/bill/remove_bill.php";
    }

    
    elseif($temp=="product"){
      include "view/compoment/product/list_product.php";
    }
    elseif($temp=="viewproduct" && $_SESSION['quyen'] == "Admin"){
      include "view/compoment/product/detail_product.php";
    }
    elseif($temp=="dellproduct" && $_SESSION['quyen'] == "Admin"){
      include "view/compoment/product/del_product.php";
    }
    elseif($temp=="removeproduct" && $_SESSION['quyen'] == "Admin"){
      include "view/compoment/product/remove_product.php";
    }
    elseif($temp=="lockpro" && $_SESSION['quyen'] == "Admin"){
      include "view/compoment/product/lock_product.php";
    }
    elseif($temp=="unlockpro" && $_SESSION['quyen'] == "Admin"){
      include "view/compoment/product/lock_product.php";
    }


    elseif($temp=="category"){
      include "view/compoment/category/list_category.php";
    }
    elseif($temp=="viewcategory" && $_SESSION['quyen'] == "Admin"){
      include "view/compoment/category/detail_category.php";
    }
    elseif($temp=="dellcategory" && $_SESSION['quyen'] == "Admin"){
      include "view/compoment/category/del_category.php";
    }
    
    
    
    
    // elseif($temp=="pos"){
    //   // include "pos/pos.php"; 
    //   header('location:http://localhost:8080/Job/thuctapne/pos/pos.php') ;
    // }
    

    
    
    elseif($temp=="customer" && $_SESSION['quyen'] == "Admin"){
      include "view/compoment/customer/list_customer.php";
    }
    elseif($temp=="viewcustomer" && $_SESSION['quyen'] == "Admin"){
      include "view/compoment/customer/detail_customer.php";
    }
    elseif($temp=="dellcustomer" && $_SESSION['quyen'] == "Admin"){
      include "view/compoment/customer/del_customer.php";
    }
    
    
    elseif($temp=="user" && $_SESSION['quyen'] == "Admin"){
      include "view/compoment/user/list_user.php";
    }
    elseif($temp=="viewuser" && $_SESSION['quyen'] == "Admin"){
      include "view/compoment/user/detail_user.php";
    }
    elseif($temp=="viewmyuser"){
      include "view/compoment/user/my_user.php";
    }
    elseif($temp=="delluser" && $_SESSION['quyen'] == "Admin"){
      include "view/compoment/user/del_user.php";
    } 
    elseif($temp=="logout"){
      session_destroy();
        echo '<script language="javascript">;
                location.replace("index.php");
            </script>';
    }
    
    
    else{
      
      include "view/compoment/dashboard.php";
    }
