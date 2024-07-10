<?php
include_once './Classes/PHPExcel.php';
include_once './Classes/PHPExcel/IOFactory.php';
    //Kết nối đến DB
    $con=mysqli_connect('localhost','root','','baitaplon')
    or die('Lỗi kết nối');
    //Tạo và thực hiện truy vấn
    $sql="SELECT*FROM chitietphieunhap";
    $data=mysqli_query($con,$sql);
    //Xử lí button tìm kiếm
    if(isset($_POST['btntimkiem']))
    {
        $lsp=$_POST['txtLoaisp'];
        $tsp=$_POST['txtTensp'];
        $sqltk="SELECT * FROM chitietphieunhap WHERE Loaisp like'%$lsp%' and Tensp like '%$tsp%'";
        $data=mysqli_query($con,$sqltk);
    }
    
    $lsp=''; $tsp=''; $nsx='';$sl='';$dgn='';$dgb='';
if(isset($_POST['btnPhieunhap']))
{
   
    $lsp=$_POST['txtLoaisp'];
    $tsp=$_POST['txtTensp'];
    $nsx=$_POST['txtNhasx'];
    $sl=$_POST['txtSoluong'];
    $dgn=$_POST['txtDongianhap'];
    $dgb=$_POST['txtDongiaban'];
    //kiem tra ma loai rong
    if($lsp==''|| $tsp==''|| $nsx==''||$sl==''||$dgn==''||$dgb=='')
        echo "<script>alert('Phải nhập đủ thông tin')</script>";  
    
    else{
        //kiemtra trung khoa chinh
        $sql1="SELECT * FROM chitietphieunhap WHERE loaisp='$lsp'";
        $dt=mysqli_query($con, $sql1);
        if(mysqli_num_rows($dt)>0)
            echo "<script>alert('Trùng số phiếu')</script>";
        
        else{
            // tao cau lenh truy van chen du lieu vao bang 
            $sql="INSERT INTO chitietphieunhap VALUE('$lsp','$tsp','$nsx','$sl','$dgn','$dgb')";
            $kq=mysqli_query($con,$sql);
            if($kq) echo "<script>alert('Nhập phiếu thành công!')</script>";
            else echo "<script>alert('Nhập phiếu thất bại!')</script>";
            }
        }
    }
   //xu ly xuat excel
if(isset($_POST['btnxuatexcel']))
{
    $objExcel=new PHPExcel();
    $objExcel->setActiveSheetIndex(0);
    $sheet=$objExcel->getActiveSheet()->setTitle('DSLS');
    $rowCount=2;
    //Tạo tiêu đề cho cột trong excel
    $sheet->setCellValue('C1', 'CHI TIẾT PHIẾU NHẬP');
    $sheet->setCellValue('A'.$rowCount,'Loại sản phẩm');
    $sheet->setCellValue('B'.$rowCount,'Tên sản phẩm');
    $sheet->setCellValue('C'.$rowCount,'Nhà sản xuất');
    $sheet->setCellValue('D'.$rowCount,'Số lượng');
    $sheet->setCellValue('E'.$rowCount,'Đơn giá nhập');
    $sheet->setCellValue('F'.$rowCount,'Đơn giá bán');
   
    //định dạng cột tiêu đề
    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getColumnDimension('F')->setAutoSize(true);
    //gán màu nền
    $sheet->getStyle('A'.$rowCount.':F'.$rowCount)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('00FF00');
    //căn giữa
    $sheet->getStyle('A'.$rowCount.':F'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //Điền dữ liệu vào các dòng. Dữ liệu lấy từ DB
    $lsp=$_POST['txtLoaisp'];
    $tsp=$_POST['txtTensp'];
    $nsx=$_POST['txtNhasx'];
    $sl=$_POST['txtSoluong'];
    $dgn=$_POST['txtDongianhap'];
    $dgb=$_POST['txtDongiaban'];
    $sqltk="SELECT * FROM chitietphieunhap WHERE Loaisp like'%$lsp%' and Tensp like '%$tsp%' and Nhasx like '%$nsx%' and Soluong like '%$sl%'and Dongianhap like '%$dgn%'and Dongiaban like '%$dgb%'";
    $data=mysqli_query($con,$sqltk);
    while($row=mysqli_fetch_array($data)){
        $rowCount++;
        $sheet->setCellValue('A'.$rowCount,$row['Loaisp']);
        $sheet->setCellValue('B'.$rowCount,$row['Tensp']);
        $sheet->setCellValue('C'.$rowCount,$row['Nhasx']);
        $sheet->setCellValue('D'.$rowCount,$row['Soluong']);
        $sheet->setCellValue('E'.$rowCount,$row['Dongianhap']);
        $sheet->setCellValue('F'.$rowCount,$row['Dongiaban']);
    }
    //Kẻ bảng 
    $styleAray=array(
        'borders'=>array(
            'allborders'=>array(
                'style'=>PHPExcel_Style_Border::BORDER_THIN
            )
        )
        );
    $sheet->getStyle('A1:'.'F'.($rowCount))->applyFromArray($styleAray);
    $objWriter=new PHPExcel_Writer_Excel2007($objExcel);
    $fileName='Export.xlsx';
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
        $id=$sheetData[$i]["A"];
        $lsp=$sheetData[$i]["B"];
        $tsp=$sheetData[$i]["C"];
        $nsx=$sheetData[$i]["D"];
        $sl=$sheetData[$i]["E"];
        $dgn=$sheetData[$i]["F"];
        $dgb=$sheetData[$i]["G"];

        $sql111="INSERT INTO chitietphieunhap VALUES('$id','$lsp','$tsp','$nsx','$sl','$dgn','$dgb')";
        $con->query($sql111);
    }
    echo "<script>alert('Thêm mới thành công!')</script>";
}

    //Ngắt kết nối
    mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết phiếu nhập | Quản lý kho hàng</title>
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

                    <div class="right_menu-item menu-item active">
                        <a href="./chitietphieunhap.php" class="right_menu-item--link">
                            <div class="right_menu-item--left small-active">
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
                    
                    <div class="right_menu-item menu-item">
                        <a href="./Thanhtoan.php" class="right_menu-item--link">
                            <div class="right_menu-item--left">
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
                <form method="post" enctype="multipart/form-data" action="">
                <table>
                    <tr>
                        <td class="ttitle">CHI TIẾT PHIẾU NHẬP</td>
                    </tr>
                </table>
                <table >
                    <tr>
                        <td class="col1">Loại sản phẩm</td>
                        <td class="col2">   
                            <input class="form-control" type="text" name="txtLoaisp">
                        </td>
                    </tr>
                    <tr>
                        <td class="col1">Tên sản phẩm</td>
                        <td class="col2">   
                            <input class="form-control" type="text" name="txtTensp">
                        </td>
                    </tr>
                    <tr>
                        <td class="col1" >
                        <input type="file" class="form-control-file" id="myFile2" name="txtFile">
                        </td>
                        <td class="col2">   
                            <input class="btn btn-dark" type="submit" name="btntimkiem" value='Tìm kiếm'>&nbsp;&nbsp;
                            <a href="./cnchitietphieu.php" class="btn btn-dark" style="color: #fff; text-decoration: none; padding: 4px 13px; position: relative; top: -4px; left: 432px;">Thêm mới</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input class="btn btn-dark" type="submit" name="btnxuatexcel" value="Xuất hàng">
                            <input class="btn btn-dark" type="submit" name="btnUpload" value="Upload file">
                        </td>
                    </tr>
                </table>
                <table border="1" cellspacing="0" class="table table-bordered table-striped">
                    <tr class="bheader">
                        <th>STT</th>
                        <th>Loại sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Nhà sản xuất</th>
                        <th>Số lượng</th>
                        <th>Đơn giá nhập</th>
                        <th>Đơn giá bán</th>
                        <th>Tác vụ</th>
                    </tr>
                    <?php
                        //Xử lí kết quả truy vấn(hiển thị mảng $data lên bảng)
                        if(isset($data)&&$data!=null)
                        {
                            $i=0;
                            while($row=mysqli_fetch_array($data)){
                        ?>
                            <tr class="bbody">
                                <td><?php echo++ $i ?></td>
                                <td><?php echo $row['Loaisp'] ?></td>
                                <td><?php echo $row['Tensp'] ?></td>
                                <td><?php echo $row['Nhasx'] ?></td>
                                <td><?php echo $row['Soluong'] ?></td>
                                <td><?php echo $row['Dongianhap'] ?></td>
                                <td><?php echo $row['Dongiaban'] ?></td>
                                
                                <td>
                                    <a style="color: #000;" href="./chitietphieu_sua.php?id=<?php echo $row['id']?>">Sửa</a> &nbsp;&nbsp;
                                    <a style="color: #000;" href="./chitietphieu_xoa.php?id=<?php echo $row['id']?>">Xoá</a>
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