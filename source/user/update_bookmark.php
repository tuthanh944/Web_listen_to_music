<?php include '../controller/connectDB.php';?>
<?php
$id_song = $_POST['id_song'];
$id_user =$_POST['id_user'];
// Tạo câu lệnh SQL để chèn dữ liệu vào bảng comment
if (!empty(trim(($id_user)))) {
        // Đường dẫn đến tệp HTML
      $stm = $conn->prepare("insert into bookmark (id_user,id_song) values(?,?)");
      $stm->bind_param('ss',$id_user, $id_song);
      $stm->execute();
      if ($stm->affected_rows == 1)
          $msg = "Đã lưu";
      else 
          $msg = "Lỗi lưu: " . $conn->error;
  }
  else {
      $msg = "Chưa nhập đủ thông tin";
  }
$conn->close();
?>





