<?php include '../controller/connectDB.php';?>
<?php
$sql = "SELECT songs.name as song_name,songs.id, image,data,lyric,singer.name as singer_name,duration,luotnghe FROM songs,singer_song,singer where songs.id=singer_song.song_id and singer_song.singer_id=singer.id ORDER BY luotnghe DESC LIMIT 10";
$result = $conn->query($sql);

// Kiểm tra kết quả của truy vấn
if ($result->num_rows > 0) {
  // Tạo một mảng để lưu trữ dữ liệu
  $songs = array();
  // Lặp qua kết quả truy vấn và lưu trữ vào mảng
  while($row = $result->fetch_assoc()) {
    $song = array(
      "name" => $row["song_name"],
      "id" => $row["id"],
      "background" => "uploads/song-images/"."".$row["image"],
      "pathSong"  => "uploads/data_song/"."".$row["data"],
      "lyric" => $row["lyric"],
      "singer" => $row["singer_name"],
      "duration" => $row["duration"],
      "luotnghe" => $row["luotnghe"],
    );
    array_push($songs, $song);
  }
} else {
  echo "Không tìm thấy dữ liệu trong bảng nhạc.";
}
$json_data_6 = json_encode($songs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
echo $json_data_6;
mysqli_close($conn);
?>
