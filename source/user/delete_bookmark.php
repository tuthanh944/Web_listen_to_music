<?php include '../controller/connectDB.php';?>
<?php
$id_song = $_POST['id_song'];
$id_user =$_POST['id_user'];
// Chuẩn bị câu truy vấn
$sql = "DELETE FROM bookmark WHERE id_user = $id_user AND id_song = $id_song";

// Thực hiện truy vấn
if (mysqli_query($conn, $sql)) {
    echo "Xóa hàng thành công!";
} else {
    echo "Lỗi: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
