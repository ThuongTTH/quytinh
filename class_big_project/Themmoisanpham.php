<?php
//ket noi den DB
$con=mysqli_connect('localhost','root','','baitaplon')
or die('Lỗi kết nối');
//Tao va thuc hien truy van
$sql="SELECT*FROM qlchitietsp";
$data=mysqli_query($con,$sql);
// xu ly button luu
$msp=''; $tsp='';$tenloai='';$nsx='';$nhh=''; $dvt='';$gianhap='';$giabanle='';$giabansi=''; $trangthai='';
if(isset($_POST['btnthemmoi']))
{
    $msp=$_POST['txtmsp'];
    $tsp=$_POST['txttsp'];
    $tenloai=$_POST['tenloai'];
    $nsx=$_POST['nsx'];
    $nhh=$_POST['nhh'];
    $dvt=$_POST['dvt'];
    $gianhap=$_POST['gianhap'];
    $giabanle=$_POST['giabanle'];
    $giabansi=$_POST['giabansi'];
    $trangthai=$_POST['trangthai'];
    //kiem tra ma loai rong
    if($msp==''|| $tsp==''||$tenloai==''||$nsx==''||$nhh==''|| $dvt==''||$gianhap==''||$giabanle==''||$giabansi==''|| $trangthai=='')
    {
        echo "<script>alert('Phải nhập đủ dữ liệu')</script>";  
    }
    else
    {
        if  ($gianhap>$giabanle)
        {
            echo "<script>alert('Giá nhập phải nhỏ hơn giá bán!')</script>";
        }
        else
        {
            $lai=$giabanle-$gianhap; 
            if($giabanle<$giabansi)
            {
                echo "<script>alert('Giá bán lẻ phải lớn hơn giá bán sỉ!')</script>";
            }
            else 
            {
                $chenhlech=$giabanle-$giabansi;
                //kiemtra trung khoa chinh(maloai)
                $sql1="SELECT * FROM qlchitietsp WHERE Masp='$msp'";
                $dt=mysqli_query($con, $sql1);
                if(mysqli_num_rows($dt)>0)
                    echo "<script>alert('Mã sản phẩm đã tồn tại')</script>";
                else
                {
                    // tao cau lenh truy van chen du lieu vao bang 
                    $sql="INSERT INTO qlchitietsp VALUE('$msp','$tsp','$tenloai','$nsx','$nhh','$dvt','$gianhap','$giabanle','$giabansi','$trangthai')";
                    $kq=mysqli_query($con,$sql);
                    if($kq) 
                    {
                        echo "<script>alert('Thêm sản phẩm thành công!')</script>";
                        echo "<script>window.location.href='./Sanpham.php'</script>";
                        exit;
                    }

                    else
                        {
                             echo "<script>alert('Thêm sản phẩm thất bại!')</script>";
                        }
                }
            }
        }
    }
}
// ngat ket noi
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm | Quản lý kho hàng</title>
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
                        <div class="right_menu-item--left">
                            <i class="fa-solid fa-database"></i>
                            Quản lý danh mục
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

                    <div class="right_menu-item menu-item active">
                        <a href="./Sanpham.php" class="right_menu-item--link">
                            <div class="right_menu-item--left small-active">
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
                        <table>
                            <tr>
                                <td>
                                    <h4 class="ttitle">THÊM MỚI SẢN PHẨM<h4>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td class="col1">Mã sản phẩm</td>
                                <td class="col2">
                                    <input class="form-control" type="text" name="txtmsp" >
                                </td>
                            </tr>
                            <tr>
                                <td class="col1">Tên sản phẩm</td>
                                <td class="col2">
                                    <input class="form-control" type="text" name="txttsp">
                                </td>
                            </tr>
                            <tr>
                                <td class="col1">Tên loại</td>
                                <td class="col2">
                                    <input class="form-control" type="text" name="tenloai">
                                </td>
                            </tr>
                            <tr>
                                <td class="col1">Ngày sản xuất</td>
                                <td class="col2">
                                    <input class="form-control" type="date" name="nsx">
                                </td>
                            </tr>
                            <tr>
                                <td class="col1">Ngày hết hạn</td>
                                <td class="col2">
                                    <input class="form-control" type="date" name="nhh">
                                </td>
                            </tr>
                            <tr>
                                <td class="col1">Đơn vị tính</td>
                                <td class="col2">
                                    <input class="form-control" type="text" name="dvt">
                                </td>
                            </tr>
                            <tr>
                                <td class="col1">Giá nhập</td>
                                <td class="col2">
                                    <input class="form-control" type="number" name="gianhap">
                                </td>
                            </tr>
                            <tr>
                                <td class="col1">Giá bán lẻ</td>
                                <td class="col2">
                                    <input class="form-control" type="number" name="giabanle">
                                </td>
                            </tr>
                            <tr>
                                <td class="col1">Giá bán sỉ</td>
                                <td class="col2">
                                    <input class="form-control" type="number" name="giabansi">
                                </td>
                            </tr>
                            <tr >
                                <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
                                <td class="col1">
                                        <label for="select1">Trạng thái</label>
                                </td>
                                <td class="col2">
                                    <select  name="trangthai" id="select1" class="combobox">
                                        <option value="Còn hàng">Còn hàng</option>
                                        <option value="Hết hàng">Hết hàng</option>
                                    </select>
                                <td class="col2">
                            </tr>
                            <tr>
                                <td class="col1"></td>
                                <td class="col2">
                                    <input class="btn btn-dark" type="submit" name="btnthemmoi" value="Lưu"> 
                                </td>
                            </tr>
                        </table>
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