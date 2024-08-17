<?php include '../controller/connectDB.php';?>
<?php
$sql = "SELECT id,name FROM song_type";
$result = mysqli_query($conn, $sql);

// Kiểm tra kết quả truy vấn
if (mysqli_num_rows($result) > 0) {
  $types = array();
  // Hiển thị thông tin học sinh
  while($row = mysqli_fetch_assoc($result)) {
    $type = array(
      "id_type" => $row["id"],
      "name_type" => $row["name"],
    );
    array_push($types, $type);
  }
} else {
    echo "Không tìm thấy dữ liệu trong bảng nhạc.";
  }
// Đóng kết nối
$json_data_2 = json_encode($types, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
echo $json_data_2;
mysqli_close($conn);
?>
