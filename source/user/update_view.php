<?php include '../controller/connectDB.php';?>
<?php
// Cập nhật giá trị trường "lượt nghe" của bài hát có ID là 1
$id_song=$_POST['id_song'];
$sql = "UPDATE songs SET luotnghe = luotnghe + 1 WHERE id = $id_song";
if (mysqli_query($conn, $sql)) {
    echo "Cập nhật thành công";
} else {
    echo "Lỗi cập nhật: " . mysqli_error($conn);
}

// Đóng kết nối
mysqli_close($conn);
?>
