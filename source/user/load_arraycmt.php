<?php include '../controller/connectDB.php';?>
<?php
$sql = "SELECT users.id,users.avatar,users.username,cmt.content,cmt.id_song FROM cmt,users where users.id=cmt.id_user";
$result = mysqli_query($conn, $sql);

// Kiểm tra kết quả truy vấn
if (mysqli_num_rows($result) > 0) {
  $cmts = array();
  // Hiển thị thông tin học sinh
  while($row = mysqli_fetch_assoc($result)) {
    $cmt = array(
      "id_users" => $row["id"],
      "avatar" => $row["avatar"],
      "username"=>$row["username"],
      "content"=>$row["content"],
      "id_song"=>$row["id_song"],
    );
    array_push($cmts, $cmt);
  }
} else {
    echo "Không tìm thấy dữ liệu trong bảng nhạc.";
  }
// Đóng kết nối
$json_data_4 = json_encode($cmts, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
echo $json_data_4;
$conn->close();
?>





