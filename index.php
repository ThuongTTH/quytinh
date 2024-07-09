<?php
    session_start();
    ob_start();

    //ket noi den DB
    $con=mysqli_connect('localhost','root','','baitaplon')
    or die('Lỗi kết nối');

    if((isset($_POST['btnLogin']))&&($_POST['btnLogin'])){
        $tk = $_POST['txtTk'];
        $mk = $_POST['txtMk'];
        $sql = "SELECT * FROM login WHERE Taikhoan='$tk' and Matkhau='$mk'";
        $result = $con->query($sql);
        if($result->num_rows>0){
            header("location: Home.php");
        }
        else{
            $txt_error = "Tài khoản hoặc mật khẩu không đúng!!";
        }
    }
    
// ngat ket noi
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/stackpath.bootstrapcdn.com_bootstrap_4.1.1_css_bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="./assets/font/fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;700&display=swap">
</head>
<body>
    <div class="sign-in_page">
        <img src="./assets/img/d844weyq9ds71.jpg" alt="" class="background-img">
        <div class="layer" style="width: 100%; height: 100vh; position: absolute; background: rgba(0, 0, 0, .3);"></div>
        
        <form class="sign-in_form" method="post">
            <div class="logo">
                <img src="./assets/img/bear_logo.png" alt="" class="logo-img">
                <h3 class="logo-text">GOURP</h3>
            </div>
            <div class="sign-in_label">Log In</div>
            <!-- Vertical --> 
            <div class="form-group1">
               <!-- <label for="myEmail">Email</label> -->
               <input type="text" id = "myEmail" class="form-control" placeholder="Username" style="height:3.6rem;" name="txtTk" required>
               <!-- <label for="myPassword">Password</label> -->
               <input type="password" id="myPassword" class="form-control" placeholder="Password" style="margin-top:16px; height:3.6rem;" name="txtMk" required>
                 
               <div class="mess" style="color: red; font-size: 1.4rem">
                    <?php
                        if(isset($txt_error)&&($txt_error!="")){
                            echo "<font color: 'red'>".$txt_error."</font>";
                        }
                    ?>
               </div>

               <input type="submit" class="btn btn-primary login-btn" name="btnLogin" value="Login">
            </div>
            
            <div class="sign-in_suport">
                <!-- <div class="suport_pass">
                    <i class="fa-solid fa-lock"></i>
                    <a href="" class="suport-pass_label">Forgot your password?</a>
                </div> -->
                <div class="suport_account">
                    <i class="fa-solid fa-circle-user"></i>
                    <a href="./Register.php" class="suport-pass_label">Create an acount</a>
                </div>
            </div>
         </form>
    </div>
</body>
</html>