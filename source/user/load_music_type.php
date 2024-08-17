<?php include '../controller/connectDB.php';?>
<?php
$sql = "SELECT songs.name as song_name,songs.id,image,data,lyric,singer.name as singer_name,song_song_type.song_type_id,duration FROM songs,singer_song,singer,song_song_type where songs.id=singer_song.song_id and singer_song.singer_id=singer.id and song_song_type.song_id=songs.id";
$result = $conn->query($sql);

// Kiểm tra kết quả của truy vấn
if ($result->num_rows > 0) {
  // Tạo một mảng để lưu trữ dữ liệu
  $songs = array();
  // Lặp qua kết quả truy vấn và lưu trữ vào mảng
  while($row = $result->fetch_assoc()) {
    $song = array(
      "name" => $row["song_name"],
      "id"=>$row["id"],
      "background" => "uploads/song-images/"."".$row["image"],
      "pathSong"  => "uploads/data_song/"."".$row["data"],
      "lyric" => $row["lyric"],
      "singer" => $row["singer_name"],
      "song_type_id" => $row["song_type_id"],
      "duration" => $row["duration"],
    );
    array_push($songs, $song);
  }
} else {
  echo "Không tìm thấy dữ liệu trong bảng nhạc.";
}
$json_data = json_encode($songs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
echo $json_data;
mysqli_close($conn);
?>
