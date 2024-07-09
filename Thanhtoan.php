<?php
    include_once'./Classes/PHPExcel.php';
    include_once'./Classes/PHPExcel/IOFactory.php';
    // B1: Kết nối đến DB
    $conn = mysqli_connect('localhost','root','','baitaplon')
    or die('Lỗi kết nối');

    // B2: Tạo và thực hiện truy vấn
    $sql = "SELECT * FROM ql_thongke_xuat";
    $data = mysqli_query($conn,$sql);

    //Xử lý button tìm kiếm
    $tenkh = '';
    $tensp = '';
    if(isset($_POST['btnTim'])){
        $tenkh = $_POST['txtTenkh'];
        $tensp = $_POST['txtTensp'];
        $sqltk = "SELECT * from ql_thongke_xuat where Tenkh like '%$tenkh%' and Tensp like '%$tensp%'";
        $data = mysqli_query($conn, $sqltk);
    }

    if(isset($_POST['btnXuat'])){
        //code xuất excel
    $objExcel = new PHPExcel();
    $objExcel->setActiveSheetIndex(0);
    $sheet=$objExcel->getActiveSheet()->setTitle('DSLS');
    $rowCount=2;
    //Tạo tiêu đề cho cột trong excel
    $sheet->setCellValue('C1', 'HÓA ĐƠN');
    $sheet->setCellValue('A'.$rowCount,'Mã khách hàng');
    $sheet->setCellValue('B'.$rowCount,'Tên khách hàng');
    $sheet->setCellValue('C'.$rowCount,'Địa chỉ khách hàng');
    $sheet->setCellValue('D'.$rowCount,'Số điện thoại khách hàng');
    $sheet->setCellValue('E'.$rowCount,'Tên sản phẩm');
    $sheet->setCellValue('F'.$rowCount,'Số lượng');
    $sheet->setCellValue('G'.$rowCount,'Đơn giá');
    $sheet->setCellValue('H'.$rowCount,'Tổng giá');
   
    //định dạng cột tiêu đề
    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getColumnDimension('F')->setAutoSize(true);
    $sheet->getColumnDimension('G')->setAutoSize(true);
    $sheet->getColumnDimension('H')->setAutoSize(true);
    //gán màu nền
    $sheet->getStyle('A'.$rowCount.':H'.$rowCount)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
    //căn giữa
    $sheet->getStyle('A'.$rowCount.':H'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
    // $makh = $_POST['txtMakh'];
    $tenkh = $_POST['txtTenkh'];
    // $dc = $_POST['txtDiachi'] ;
    // $sdtkh = $_POST['txtSdTkh'];
    $tensp = $_POST['txtTensp'];
    // $sl = $_POST['txtSoluong'];
    // $dg = $_POST['txtDongia'];
    // $tg = $_POST['txtTonggia'];
    $sqltk = "SELECT * from ql_thongke_xuat where Tenkh like '%$tenkh%' and Tensp like '%$tensp%'";
    $data = mysqli_query($conn, $sqltk);
    while($row=mysqli_fetch_array($data)){
        $rowCount++;
        $sheet->setCellValue('A'.$rowCount,$row['Makh']);
        $sheet->setCellValue('B'.$rowCount,$row['Tenkh']);
        $sheet->setCellValue('C'.$rowCount,$row['Diachikh']);
        $sheet->setCellValue('D'.$rowCount,$row['Sdtkh']);
        $sheet->setCellValue('E'.$rowCount,$row['Tensp']);
        $sheet->setCellValue('F'.$rowCount,$row['Soluong']);
        $sheet->setCellValue('G'.$rowCount,$row['Dongia']);
        $sheet->setCellValue('H'.$rowCount,$row['Tonggia']);
    }
    //Kẻ bảng 
    $styleAray=array(
        'borders'=>array(
            'allborders'=>array(
                'style'=>PHPExcel_Style_Border::BORDER_THIN
            )
        )
        );
    $sheet->getStyle('A1:'.'H'.($rowCount))->applyFromArray($styleAray);
    $objWriter=new PHPExcel_Writer_Excel2007($objExcel);
    $fileName='ExportExcel.xlsx';
    $objWriter->save($fileName);
    header('Content-Disposition: attachment; filename="'.$fileName.'"');
    header('Content-Type: application/vnd.openxlmformatsofficedocument.speadsheetml.sheet');
    header('Content-Length: '.filesize($fileName));
    header('Content-Transfer-Encoding:binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: no-cache');
    readfile($fileName);
    }

    if(isset($_POST['btnUpload']))
{
    $file=$_FILES['txtFile']['tmp_name'];
    $objReader=PHPExcel_IOFactory::createReaderForFile($file);
    $objExcel=$objReader->load($file);
    //Lấy sheet hiện tại
    $sheet=$objExcel->getSheet(0);
    $sheetData=$sheet->toArray(null,true,true,true,true,true,true,true);
    for($i=2;$i<=count($sheetData);$i++){
        $makh=$sheetData[$i]["A"];
        $tenkh=$sheetData[$i]["B"];
        $dc=$sheetData[$i]["C"];
        $sdt=$sheetData[$i]["D"];
        $tensp=$sheetData[$i]["E"];
        $sl=$sheetData[$i]["F"];
        $dg=$sheetData[$i]["G"];
        $tg=$sheetData[$i]["H"];

        $sql111="INSERT INTO ql_thongke_xuat VALUES('$makh','$tenkh','$dc','$sdt','$tensp','$sl','$dg','$tg')";
        $conn->query($sql111);
    }
    echo "<script>alert('Thêm mới thành công!')</script>";
}
  
    //Ngắt kết nối
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thống kê xuất hàng | Quản lý kho hàng</title>
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
                        <a href="./phieunhap.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
                                <i class="fa-solid fa-download"></i>
                                Phiếu nhập
                            </div>
                        </a>
                    </div>

                    <div class="right_menu-item menu-item">
                        <a href="./chitietphieunhap.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
                                <i class="fa-solid fa-file-export"></i>
                                Chi tiết phiếu nhập
                            </div>
                        </a>
                    </div>

                    <div class="right_menu-item menu-item">
                        <a href="./phieuxuat.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
                                <i class="fa-solid fa-chart-pie"></i>
                                Phiếu xuất
                            </div>
                        </a>
                    </div>

                    <div class="right_menu-item menu-item">
                        <a href="./chitietphieuxuat.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
                                <i class="fa-solid fa-receipt"></i>
                                Chi tiết phiếu xuất
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
                        <a href="./TKdoanhthu.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
                                <i class="fa-solid fa-chart-area"></i>
                                Thống kê doanh thu
                            </div>
                        </a>
                    </div>

                    <div class="right_menu-item menu-item active">
                        <a href="./Thanhtoan.php" class="right_menu-item--link">
                            <div class="right_menu-item--left small-active">
                                <i class="fa-solid fa-rectangle-list"></i>
                                Hóa đơn
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="grid__column-10_5">
            <div class="content">
                <form action=""enctype="multipart/form-data" method="post">
                    <table>
                        <tr>
                            <td colspan="2">
                                <h4 class="ttitle">Danh sách hóa đơn</h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">Tên khách hàng</td>
                            <td class="col2">
                                <input class="form-control" type="text" name="txtTenkh">
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">Tên sản phẩm</td>
                            <td class="col2">
                                <input class="form-control" type="text" name="txtTensp">
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                            <input type="file" class="form-control-file" id="myFile2" name="txtFile">
                            </td>
                            <td class="col2">
                                <input class="btn btn-dark" type="submit" name="btnTim" value="Tìm kiếm">&nbsp;&nbsp;
                                <a class="btn btn-dark" href="./capnhatthanhtoan.php" style="color: #fff; text-decoration: none; padding: 4px 13px; position: relative; top: -4px; left: 432px;">Thêm mới</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="submit" class="btn btn-dark" name="btnXuat" value="Xuất Excel" style="margin-left: 13px">
                                <input class="btn btn-dark" type="submit" name="btnUpload" value="Upload file">

                            </td>
                        </tr>
                    </table>
                    <table border="1" cellspacing="0" class="table table-bordered table-striped">
                        <tr class="bheader">
                            <th>STT</th>
                            <th>Tên khách hàng</th>
                            <th>Địa chỉ khách hàng</th>
                            <th>Số điện thoại khách hàng</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Tổng giá</th>
                            <th>Tác vụ</th>
                        </tr>
                        <?php
                            //B3: Xử lí kết quả truy vấn (Hiển thị mảng data lên bảng)
                            if(isset($data)&&$data!=null){
                                $i = 0;
                                while($row = mysqli_fetch_array($data)){
                        ?>
                            <tr class="bbody">
                                <td><?php echo ++$i ?></td>
                                <td><?php echo $row['Tenkh'] ?></td>
                                <td><?php echo $row['Diachikh'] ?></td>
                                <td><?php echo $row['Sdtkh'] ?></td>
                                <td><?php echo $row['Tensp'] ?></td>
                                <td><?php echo $row['Soluong'] ?></td>
                                <td><?php echo $row['Dongia'] ?></td>
                                <td><?php echo $row['Tonggia'] ?></td>
                                <td>
                                    <!-- <a href="" style="color:#000">Sửa</a>&nbsp;&nbsp; -->
                                    <a href="./xoaThanhtoan.php?tenkh=<?php echo $row['Tenkh'] ?>" style="color:#000">Xóa</a>  
                                </td>
                            </tr>
                        <?php
                                }
                            }
                            //Kết thúc B3
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