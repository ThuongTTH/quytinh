<?php
    session_start();
    ob_start();

    
    if (isset($_SESSION['Taikhoan'])) {
        $currentUsername = $_SESSION['Taikhoan'];

    //ket noi den DB
    $con=mysqli_connect('localhost','root','','baitaplon')
    or die('Lỗi kết nối');
    $tk = '';
    $mk = '';

    // Truy vấn để lấy tên đăng nhập từ cơ sở dữ liệu
    $sql = "SELECT Taikhoan FROM login WHERE Taikhoan = '$currentUsername'"; // Thay đổi 'id' thành trường khóa chính của bản ghi tương ứng
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentUsername = $row['Taikhoan'];
    }

    if((isset($_POST['btnLogin']))){
        $tk = $_POST['txtTk'];
        $newmk = $_POST['txtnewMk'];
        $cnewpass = $_POST['txtCnewMk'];
        if($cnewpass==''|| $newmk==''){
            echo "<script>alert('Phải nhập đủ dữ liệu')</script>";  
        } else if ($newmk !== $cnewpass) {
            $txt_error="Mật khẩu mới không khớp";
        } else {
            // Thực hiện truy vấn để cập nhật thông tin tài khoản
            $sql = "UPDATE login SET Matkhau='$newmk' WHERE Taikhoan = '$tk'";
            if ($con->query($sql) === TRUE) {
                echo "<script>alert('Cập nhật thành công!')</script>";
                header("Location: Home.php");   
            } 
        }
    } 
    
// ngat ket noi
mysqli_close($con);

} else {
    // Người dùng chưa đăng nhập, xử lý tương ứng
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update | Admin</title>
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
            <div class="sign-in_label">UPDATE</div>
            <!-- Vertical -->
            <div class="form-group1">
               <!-- <label for="myEmail">Email</label> -->
               <input type="text" id = "myEmail" class="form-control" style="height:3.6rem;" name="txtTk" value="<?php echo $currentUsername ?>" disabled>
               <!-- <label for="myPassword">Password</label> -->
               <input type="password" id="myPassword" class="form-control" placeholder="New Password" style="margin-top:16px; height:3.6rem;" name="txtnewMk">
               
               <input type="password" id="myCPassword" class="form-control" placeholder="Confirm New Password" style="margin-top:16px; height:3.6rem;" name="txtCnewMk">
                 
               <div class="mess" style="color: red; font-size: 1.4rem">
                    <?php
                        if(isset($txt_error)&&($txt_error!="")){
                            echo "<font color: 'red'>".$txt_error."</font>";
                        }
                    ?>
               </div>

               <input type="submit" class="btn btn-primary login-btn" name="btnLogin" value="Accept">
            </div>
            
            <div class="sign-in_suport"></div>
         </form>
    </div>
</body>
</html>