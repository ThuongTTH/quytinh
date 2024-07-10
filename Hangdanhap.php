<?php
    //Kết nối đến DB
    $con=mysqli_connect('localhost','root','','baitaplon')
    or die('Lỗi kết nối');
    //Tạo và thực hiện truy vấn
    $sql="SELECT*FROM nhaphang";
    $data=mysqli_query($con,$sql);
    //Xử lí button tìm kiếm
    if(isset($_POST['btntimkiem']))
    {
        $dh=$_POST['txttimkiem'];
        $sqltk="SELECT * FROM nhaphang WHERE Madh like'%$dh%' ";
        $data=mysqli_query($con,$sqltk);
    }
    
    $dh=''; $nd=''; $gc=''; $nt='';
if(isset($_POST['btnNhaphang']))
{
   
    $dh=$_POST['txtMadh'];
    $nd=$_POST['txtNoidung'];
    $gc=$_POST['txtGhichu'];
    $nt=$_POST['dtNgaytao'];
    //kiem tra ma loai rong
    if($dh=='')
        echo "<script>alert('Phai nhap ma don hang')</script>";  
    
    else{
        //kiemtra trung khoa chinh(maloai)
        $sql1="SELECT * FROM nhaphang WHERE Madh='$dh'";
        $dt=mysqli_query($con, $sql1);
        if(mysqli_num_rows($dt)>0)
            echo "<script>alert('Trung ma loai')</script>";
        
        else{
            // tao cau lenh truy van chen du lieu vao bang loaisach
            $sql="INSERT INTO nhaphang VALUE('$dh','$nd','$gc','$nt')";
            $kq=mysqli_query($con,$sql);
            if($kq) echo "<script>alert('Tao don hang moi thanh cong!')</script>";
            else echo "<script>alert('Tao don hang moi that bai!')</script>";
            }
        }
    }
   
  
    //Ngắt kết nối
    mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hàng đã nhập | Quản lý kho hàng</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/stackpath.bootstrapcdn.com_bootstrap_4.1.1_css_bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/maxcdn.bootstrapcdn.com_bootstrap_4.0.0_css_bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="./assets/font/fontawesome-free-6.4.0-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;700&display=swap">
</head>
<style>
    .menu-item{
        display: flow-root;
    }

    .submenu {
        display: none;
        z-index: 1;
    }

    .submenu.show {
        display: block;
    }
    i{
        margin-right: 4px;
    }
</style>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="#">
            <div class="logo_dashboard">
                <img src="./assets/img/bear_logo.png" alt="" class="logo-img_dashboard">
                <h3 class="logo-text">GOURP</h3>
            </div>
        </a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item nav-item1">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input class="nav-item__text" type="text" placeholder="Search">
                </li>
            </ul>
        </div>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item nav-item1">
                <img src="https://kynguyenlamdep.com/wp-content/uploads/2022/06/avatar-cute-meo-con-than-chet-700x695.jpg" alt="avatar-cute-meo-con-than-chet" class="header__navbar-user-img">
                <div class="nav-link nav-name menu-item" style="padding-right: 32px;">
                    Nguyễn Anh Quân
                    <i class="fa-solid fa-sort-down"></i>
                    <ul class="header__navbar-user-menu submenu">
                        <li class="header__navbar-user-item">
                            <a href="">Tài khoản của tôi</a>
                        </li>
                        <li class="header__navbar-user-item">
                            <a href="">Địa chỉ của tôi</a>
                        </li>
                        <li class="header__navbar-user-item">
                            <a href="">Đơn mua</a>
                        </li>
                        <li class="header__navbar-user-item header__navbar-user-item--separate">
                            <a href="./index.php">Đăng xuất</a>
                        </li>
                    </ul>
                </div>

            </li> 
         </ul>
    </nav>

    <div class="grid">
        <div class="grid__column-1_5">
            <div class="right_menu">
                <div class="right_menu-list">
                    <h3 class="right_menu-text">Menu</h3>
                    <div class="right_menu-item">
                        <a href="./Home.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
                                <i class="fa-solid fa-newspaper"></i>
                                Trang chủ
                            </div>
                            <!-- <span class="dash_board-notice">3</span> -->
                        </a>
                    </div>

                    <div class="right_menu-item--label">Thiết lập dữ liệu</div>

                    <div class="right_menu-item menu-item">
                        <div class="right_menu-item--left">
                            <i class="fa-solid fa-database"></i>
                            Dữ liệu sản phẩm
                        </div>
                        <div class="submenu">
                            <a href="./Loaihang.php" class="right_menu-item--link">
                                <div class="right_menu-item--container">
                                    <div class="right_menu-item--right">
                                        <i class="fa-solid fa-circle-notch"></i>
                                        Loại hàng
                                    </div>
                                </div>
                            </a>
                            <a href="./Donvi.php" class="right_menu-item--link">
                                <div class="right_menu-item--container">
                                    <div class="right_menu-item--right">
                                        <i class="fa-solid fa-circle-notch"></i>
                                        Đơn vị tính
                                    </div>
                                </div>
                            </a>
                            <a href="./Sanpham.php" class="right_menu-item--link">
                                <div class="right_menu-item--container">
                                    <div class="right_menu-item--right">
                                        <i class="fa-solid fa-circle-notch"></i>
                                        Sản phẩm
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="right_menu-item menu-item">
                        <a href="./Nhacungcap.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
                                <i class="fa-solid fa-cubes"></i>
                                Nhà cung cấp
                            </div>
                        </a>
                    </div>

                    <div class="right_menu-item--label">Dữ liệu nhập xuất</div>

                    <div class="right_menu-item menu-item">
                        <div class="right_menu-item--left small-active">
                            <i class="fa-solid fa-download"></i>
                            Dữ liệu nhập hàng
                        </div>
                        <div class="submenu" style="display: block">
                            <a href="./Nhaphang.php" class="right_menu-item--link">
                                <div class="right_menu-item--container">
                                    <div class="right_menu-item--right">
                                        <i class="fa-solid fa-circle-notch"></i>
                                        Nhập hàng
                                    </div>
                                </div>
                            </a>
                            <a href="./Hangdanhap.php" class="right_menu-item--link">
                                <div class="right_menu-item--container active">
                                    <div class="right_menu-item--right small-active">
                                        <i class="fa-solid fa-circle-notch"></i>
                                        Sản phẩm đã nhập
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="right_menu-item menu-item">
                        <div class="right_menu-item--left">
                            <i class="fa-solid fa-file-export"></i>
                            Dữ liệu xuất hàng
                        </div>
                        <div class="submenu">
                            <a href="./Xuathang.php" class="right_menu-item--link">
                                <div class="right_menu-item--container">
                                    <div class="right_menu-item--right">
                                        <i class="fa-solid fa-circle-notch"></i>
                                        Xuất hàng
                                    </div>
                                </div>
                            </a>
                            <a href="./Hangdaxuat.php" class="right_menu-item--link">
                                <div class="right_menu-item--container">
                                    <div class="right_menu-item--right">
                                        <i class="fa-solid fa-circle-notch"></i>
                                        Sản phẩm đã xuất
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="right_menu-item menu-item">
                        <a href="./Dulieukhohang.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
                                <i class="fa-solid fa-warehouse"></i>
                                Dữ liệu kho hàng
                            </div>
                        </a>
                    </div>

                    <div class="right_menu-item--label">Báo cáo thống kê</div>

                    <div class="right_menu-item menu-item">
                        <a href="./TKnhapxuat.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
                                <i class="fa-solid fa-chart-pie"></i>
                                Thống kê nhập xuất tồn đầu
                            </div>
                        </a>
                    </div>

                    <div class="right_menu-item menu-item">
                        <a href="./TKdoanhthu.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
                                <i class="fa-solid fa-chart-area"></i>
                                Thống kê doanh thu
                            </div>
                        </a>
                    </div>

                    <div class="right_menu-item menu-item">
                        <a href="./Tksoluong.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
                                <i class="fa-solid fa-chart-area"></i>
                                Thống kê hàng tồn
                            </div>
                        </a>
                    </div>

                    <div class="right_menu-item--label">Thanh toán</div>
                    
                    <div class="right_menu-item menu-item">
                        <a href="./Phuongthuc.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
                                <i class="fa-solid fa-cash-register"></i>
                                Phương thức
                            </div>
                        </a>
                    </div>

                    <div class="right_menu-item menu-item">
                        <a href="./Thanhtoan.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
                                <i class="fa-solid fa-receipt"></i>
                                Quá trình thanh toán 
                            </div>
                        </a>
                    </div>

                    <div class="right_menu-item--label">Vận chuyển</div>

                    <div class="right_menu-item menu-item">
                        <a href="./Vanchuyen.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
                                <i class="fa-solid fa-truck"></i>
                                Quá trình vận chuyển
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="grid__column-10_5">
            <div class="content">
            
        <form method="post" action="">
            <table>
                        <tr>
                            <td colspan="2">
                                <h4 class="ttitle">DANH SÁCH HÀNG NHẬP</h4>
                            </td>
                        </tr>
            <table >
                    <td >
                    <div class="search-add-filter">
                            <div class="area-search">

                                    <input type="text" class="area-search__text" name ="txttimkiem" placeholder="Nhập thông tin tìm kiếm" style="width: 300px; padding: 10px; font-size: 16px;">
                                    <button name="btntimkiem" type="submit"class="area-search__btn" style="padding: 10px; font-size: 16px; background-color: gray; color: white;"  >
                                     <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                    </td>
                </tr>
            </table>
            <table border="1" cellspacing="0" class="table table-bordered table-striped">
                <tr style="background:grey; text-align:center">
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Nội dung</th>
                    <th>Ghi chú</th>
                    <th>Ngày tạo</th>
                <th></th>

                </tr>
                <?php
                    //Xử lí kết quả truy vấn(hiển thị mảng $data lên bảng)
                    if(isset($data)&&$data!=null)
                    {
                        $i=0;
                        while($row=mysqli_fetch_array($data)){
                    ?>
                        <tr style="text-align:center" >
                            <td><?php echo++ $i ?></td>
                            <td><?php echo $row['Madh'] ?></td>
                            <td><?php echo $row['Noidung1'] ?></td>
                            <td><?php echo $row['Ghichu1'] ?></td>
                            <td><?php echo $row['Ngaytao1'] ?></td>
                            
                            <td>
                            <a  href="./nhaphang_sua.php?Madh=<?php echo $row['Madh']?>"><font color="red">Sửa</a> &nbsp;&nbsp;
                                <a href="./nhaphang_xoa.php?Madh=<?php echo $row['Madh']?>"><font color="red">Xoá</a>

                            </td>
                        </tr>
                    <?php        
                        }
                    }
                    //Kết thúc bước 3
                ?>
            </table>
            
        </form>
    </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p class="footer-text">© 2023 - Bản quyền thuộc về Công ty QNA</p>
    </div>

    <script>
        // Lấy danh sách tất cả các menu cấp 1
        var menuItems = document.getElementsByClassName('menu-item');

        // Duyệt qua từng menu cấp 1 và thiết lập sự kiện click
        for (var i = 0; i < menuItems.length; i++) {
        var menuItem = menuItems[i];
        menuItem.addEventListener('click', function() {
            // Tìm submenu tương ứng với menu cấp 1 được nhấn
            var submenu = this.querySelector('.submenu');

            // Kiểm tra nếu submenu đã được hiển thị, thì ẩn đi, ngược lại thì hiển thị
            if (submenu.classList.contains('show')) {
            submenu.classList.remove('show');
            } else {
            submenu.classList.add('show');
            }
        });
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>