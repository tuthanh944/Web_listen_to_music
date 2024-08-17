<?php include '../controller/connectDB.php';?>
<?php
$id_song = $_POST['id_song'];
$id_user =$_POST['id_user'];
$comment = $_POST['nd_cmt'];
// Tạo câu lệnh SQL để chèn dữ liệu vào bảng comment
if (!empty(trim(($comment)))) {
        // Đường dẫn đến tệp HTML
      $stm = $conn->prepare("insert into cmt (id_user,id_song,content) values(?,?,?)");
      $stm->bind_param('sss',$id_user, $id_song, $comment);
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





