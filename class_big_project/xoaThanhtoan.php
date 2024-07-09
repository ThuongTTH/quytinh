<?php
    $Tenkh = $_GET['tenkh'];
    //Kết nối đến DB
    $conn = mysqli_connect('localhost','root','','baitaplon')
    or die('Lỗi kết nối');
    //Tạo truy vấn xóa
    $sql = "DELETE FROM quanlyhoadon WHERE Tenkh='$Tenkh'";
    $kq = mysqli_query($conn, $sql);
    if($kq) echo"<script>alert('Đã xóa thành công!!')</script>";
    else echo "<script>alert('Đã xóa thất bại!!!')</script>";
    echo "<script>window.location.href='./Thanhtoan.php'</script>";
?>