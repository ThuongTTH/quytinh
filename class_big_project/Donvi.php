<?php
//ket noi den DB
$con=mysqli_connect('localhost','root','','baitaplon')
or die('Lỗi kết nối');
//Tao va thuc hien truy van
$sql="SELECT*FROM qldonvitinh";
$data=mysqli_query($con,$sql);
//Xử lí button tìm kiếm
if(isset($_POST['btntimkiem']))
{ 
    $madv=$_POST['txtmadv'];
    $dvt=$_POST['dvt'];
    $sqltk="SELECT * FROM qldonvitinh
    WHERE Madv like'%$madv%' and Dvt like '%$dvt%'";
    $data=mysqli_query($con,$sqltk);
}
// ngat ket noi
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn vị | Quản lý kho hàng</title>
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
        <img src="./assets/img/pastel-leaves-aesthetic-pattern-gjtnfutk6zibt3d5.jpg" alt="" class="nav-img">
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

        <ul class="navbar-nav ml-auto navbar-nav1">
            <li class="nav-item nav-item1">
                <img src="https://kynguyenlamdep.com/wp-content/uploads/2022/06/avatar-cute-meo-con-than-chet-700x695.jpg" alt="avatar-cute-meo-con-than-chet" class="header__navbar-user-img">
                <div class="nav-link nav-name menu-item" style="padding-right: 32px;">
                    Admin
                    <i class="fa-solid fa-sort-down"></i>
                    <ul class="header__navbar-user-menu submenu">
                        <li class="header__navbar-user-item">
                            <a href="./Suataikhoan.php">Tài khoản của tôi</a>
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
                        <div class="right_menu-item--left small-active">
                            <i class="fa-solid fa-database"></i>
                            Quản lý danh mục
                        </div>
                        <div class="submenu" style="display: block">
                            <a href="./Loaihang.php" class="right_menu-item--link">
                                <div class="right_menu-item--container">
                                    <div class="right_menu-item--right">
                                        <i class="fa-solid fa-circle-notch"></i>
                                        Loại hàng
                                    </div>
                                </div>
                            </a>
                            <a href="./Donvi.php" class="right_menu-item--link">
                                <div class="right_menu-item--container active">
                                    <div class="right_menu-item--right">
                                        <i class="fa-solid fa-circle-notch"></i>
                                        Đơn vị tính
                                    </div>
                                </div>
                            </a>
                            <a href="./Nhacungcap.php" class="right_menu-item--link">
                                <div class="right_menu-item--container">
                                    <div class="right_menu-item--right">
                                        <i class="fa-solid fa-circle-notch"></i>
                                        Nhà cung cấp
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="right_menu-item menu-item">
                        <a href="./Sanpham.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
                                <i class="fa-solid fa-cubes"></i>
                                Sản phẩm
                            </div>
                        </a>
                    </div>

                    <div class="right_menu-item menu-item">
                        <a href="./Khachhang.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
                                <i class="fa-solid fa-users"></i>
                                Khách hàng
                            </div>
                        </a>
                    </div>

                    <div class="right_menu-item menu-item">
                        <a href="./Nhanvien.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
                                <i class="fa-solid fa-user-tie"></i>
                                Nhân viên
                            </div>
                        </a>
                    </div>

                    <div class="right_menu-item--label">Dữ liệu nhập xuất</div>

                    <div class="right_menu-item menu-item">
                        <a href="./Nhaphang.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
                                <i class="fa-solid fa-download"></i>
                                Dữ liệu nhập hàng
                            </div>
                        </a>
                    </div>

                    <div class="right_menu-item menu-item">
                        <a href="./Xuathang.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
                                <i class="fa-solid fa-file-export"></i>
                                Dữ liệu xuất hàng
                            </div>
                        </a>
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
                                Thống kê nhập
                            </div>
                        </a>
                    </div>

                    <div class="right_menu-item menu-item">
                        <a href="./Thanhtoan.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
                                <i class="fa-solid fa-receipt"></i>
                                Thống kê xuất
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
                </div>
            </div>
        </div>
    
        <div class="grid__column-10_5">
            <div class="content">
                <form method="post" action="">
                    <table>
                        <td> 
                            <h4 class="ttitle">DANH SÁCH ĐƠN VỊ TÍNH</h4>
                        </td>
                        <tr>
                            <table>
                                <tr>
                                    <td class="col1">Mã đơn vị tính</td>
                                    <td class="col2">   
                                        <input class="form-control" type="text" name="txtmadv">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col1">Tên đơn vị tính</td>
                                    <td class="col2">   
                                        <input class="form-control" type="text" name="dvt">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col1"></td>
                                    <td class="col2">
                                        <input class="btn btn-dark" type="submit" name="btntimkiem" value='Tìm kiếm'> 
                                        <a class="btn btn-dark" href="./Themmoidonvitinh.php" style="color: #fff; text-decoration: none; padding: 4px 13px; position: relative; top: -4.5px; left: 432px;">Thêm mới</a>
                                    </td>
                                </tr>
                            </table>
                        </tr>
                    </table>
                    <table border = "1" cellspacing = "0" class="table table-bordered table-striped">
                        <tr class="bheader">
                            <th>STT</th>
                            <th>Mã đơn vị</th>
                            <th>Đơn vị tính</th>
                            <th>Tác vụ</th>
                            <?php
                            // xu ly ket qua truy van (hien thi mang $data len bang)
                            if(isset($data)&&($data)!=null)
                            {
                                $i=0;
                                while($row=mysqli_fetch_array($data))
                                {
                            ?>
                                <tr class="bbody">
                                    <td><?php echo++$i ?></td>
                                    <td><?php echo $row['Madv'] ?></td>
                                    <td><?php echo $row['Dvt'] ?></td>
                                    <td>
                                        <a href="./Dsdvt_sua.php?Madv=<?php echo $row['Madv'] ?>" style="color: #000;">Sửa</a>  &nbsp;&nbsp;
                                        <a href="./Dsdvt_xoa.php?Madv=<?php echo $row['Madv'] ?>" style="color: #000;">Xoá</a>
                                    </td>
                                </tr>
                            <?php
                                }
                            }
                            ?>
                    </table>
                </form>
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