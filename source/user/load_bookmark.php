<?php include '../controller/connectDB.php';?>
<?php
$sql = "SELECT id_user,id_song FROM bookmark";
$result = mysqli_query($conn, $sql);

// Kiểm tra kết quả truy vấn
  $bookmarks = array();
  // Hiển thị thông tin học sinh
  while($row = mysqli_fetch_assoc($result)) {
    $bookmark = array(
      "user_id" => $row["id_user"],
      "song_id" => $row["id_song"],
    );
    array_push($bookmarks, $bookmark);
  }
// Đóng kết nối
$json_data_6 = json_encode($bookmarks, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
echo $json_data_6;
mysqli_close($conn);
?>
