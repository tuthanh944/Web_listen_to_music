<?php
include '../controller/connectDB.php';


    $id = $_POST['id'];
    $id =mysqli_real_escape_string($conn, $id);

    // Lấy tên tệp tin hình ảnh của bài hát muốn xóa
    $sql = "SELECT image FROM songs WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $imagePath = $row['image'];

    // Lấy tên tập tin trong cột "audio" của bài hát
    $sql = "SELECT data FROM songs WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $audio_file = $row['data'];

    // Xóa các bản ghi trong bảng singer_song liên quan đến bài hát
    $sql = "DELETE FROM singer_song WHERE song_id = '$id'";
    mysqli_query($conn, $sql);

    // Xóa các bản ghi trong bảng song_song_type liên quan đến bài hát
    $sql = "DELETE FROM song_song_type WHERE song_id = '$id'";
    mysqli_query($conn, $sql);

    $sql = "DELETE FROM songs WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        unlink('../uploads/data_song/'. $audio_file);
        unlink('../uploads/song-images/'.$imagePath);
        echo "success";
    } else {
        echo "error";
    }
    mysqli_close($conn);

?>