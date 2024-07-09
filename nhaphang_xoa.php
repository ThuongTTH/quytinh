<?php
    $dh=$_GET['Madh'];
    //Kết nối đến DB
    $con=mysqli_connect('localhost','root','','baitaplon')
    or die('Lỗi kết nối');
    //Tạo truy vấn xóa
    $sql="DELETE FROM nhaphang WHERE Madh='$dh'";
    $kq=mysqli_query($con,$sql);
    if($kq) echo "<script>alert('Xóa thành công!')</script>";
    else echo "<script>alert('Xóa thất bại!')</script>";
    echo "<script>window.location.href='./Nhaphang.php'</script>"
?>