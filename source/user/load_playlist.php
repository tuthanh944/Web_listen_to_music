<?php include '../controller/connectDB.php';?>
<?php

$sql = "SELECT id_user,id_song FROM playlist";
$result = mysqli_query($conn, $sql);

// Kiểm tra kết quả truy vấn
  $playlists = array();
  // Hiển thị thông tin học sinh
  while($row = mysqli_fetch_assoc($result)) {
    $playlist = array(
      "user_id" => $row["id_user"],
      "song_id" => $row["id_song"],
    );
    array_push($playlists, $playlist);
  }

// Đóng kết nối
$json_data_5 = json_encode($playlists, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
echo $json_data_5;
mysqli_close($conn);
?>
