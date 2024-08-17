<?php include '../controller/connectDB.php';?>
<?php
$sql = "SELECT id,name FROM singer";
$result = mysqli_query($conn, $sql);

// Kiểm tra kết quả truy vấn
if (mysqli_num_rows($result) > 0) {
  $singers = array();
  // Hiển thị thông tin học sinh
  while($row = mysqli_fetch_assoc($result)) {
    $singer = array(
      "id_singer" => $row["id"],
      "name_singer" => $row["name"],
    );
    array_push($singers, $singer);
  }
} else {
    echo "Không tìm thấy dữ liệu trong bảng nhạc.";
  }
// Đóng kết nối
$json_data_1 = json_encode($singers, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
echo $json_data_1;
mysqli_close($conn);
?>
