<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login System</title>
    <link rel="icon" href="img/logo2.png">

    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.2/components/logins/login-3/assets/css/login-3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php
    session_start();
    include "connect.php";

    if (isset($_POST['btn-login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        // $matkhau

        $sql = "SELECT * 
                  FROM db_user
                  WHERE username='" . $username . "' AND password='" . $password . "' LIMIT 1";

        $row = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($row);

        if ($count > 0) {
            $row_data = mysqli_fetch_array($row);
            $_SESSION['tennhanvien'] = $row_data['fullname'];
            $_SESSION['idnhanvien'] = $row_data['id'];
            $_SESSION['quyen'] = $row_data['role'];

            header('location:home.php');
        } else {
            $_SESSION['error'] = "Tên tài khoản hoặc mật khẩu không chính xác! Vui lòng kiểm tra lại";
        }
    }
    ?>
</head>



<body>
    <!-- Login 3 - Bootstrap Brain Component -->
    <section class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 bsb-tpl">
                    <div class="d-flex flex-column justify-content-between h-100 p-3 p-md-4 p-xl-5">
                        <!-- <h3 class="m-0">Welcome!</h3> -->
                        <img class="img-fluid rounded mx-auto my-4" loading="lazy" src="img/logo2.jpg" width="400" height="80" alt="BootstrapBrain Logo">
                        <!-- <p class="mb-0">Not a member yet? <a href="#!" class="link-secondary text-decoration-none">Register now</a></p> -->
                    </div>
                </div>
                <div class="col-12 col-md-6 bsb-tpl-bg-lotion">
                    <div class="p-3 p-md-4 p-xl-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-5 text-center">
                                    <h3>Đăng Nhập Quản Lý</h3>
                                </div>
                            </div>
                        </div>
                        <form action="" method="POST">
                            <div class="row gy-3 gy-md-4 overflow-hidden">
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
                                <div class="col-12">
                                    <label for="email" class="form-label">Tài Khoản <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="username" id="email" placeholder="" required value="admin">
                                </div>
                                <div class="col-12">
                                    <label for="password" class="form-label">Mật Khẩu <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" id="password" value="123" required>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn bsb-btn-xl btn-primary" name="btn-login" type="submit">Đăng Nhập</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- <div class="row">
                            <div class="col-12">
                                <hr class="mt-5 mb-4 border-secondary-subtle">
                                <div class="text-end">
                                    <a href="#!" class="link-secondary text-decoration-none">Forgot password</a>
                                </div>
                            </div>
                        </div> -->
                        <br>
                        <center>
                            <footer class="footer ">
                                <div class="">
                                    <span>Copyright © 2023. <br> By <a href="" target="_blank">Nong Nguyen Bao Trung</a> - <a href="" target="_blank"> Nguyen Huu Tin</a>
                                        .</span>
                                    <span class="r"> <i class="ti-heart text-danger ml-1"></i></span>
                                </div>
                                <div class="">
                                    <span class="">Distributed by <a href="" target="_blank">MƠ MƠ</a></span>
                                </div>
                            </footer>
                        </center>

                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>