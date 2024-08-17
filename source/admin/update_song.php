<?php
include '../controller/connectDB.php';

// Lấy thông tin bài hát từ request
$id = $_POST['id'];
$name = $_POST['name'];
$songTypeIds = $_POST['song_type_ids'];
$singerIds = $_POST['singer_ids'];
$releaseYear = $_POST['release_year'];

// Lưu file data vào thư mục upload
$dataPath = '';
if (isset($_FILES['data'])) {
    $data = $_FILES['data'];
    $dataName = $data['name'];
    $dataTempName = $data['tmp_name'];
    $dataPath = 'uploads/data-song' . $dataName;
    move_uploaded_file($dataTempName, '../' . $dataPath);
}

// Lưu file image vào thư mục upload
$imagePath = '';
if (isset($_FILES['image'])) {
    $image = $_FILES['image'];
    $imageName = $image['name'];
    $imageTempName = $image['tmp_name'];
    $imagePath = 'uploads/song-images/' . $imageName;
    move_uploaded_file($imageTempName, '../' . $imagePath);
}

// Cập nhật thông tin bài hát trong cơ sở dữ liệu
$sql = "UPDATE song-images SET name = '$name', year = '$releaseYear', data = '$dataName', image = '$imageName' WHERE id = '$id'";
if (mysqli_query($conn, $sql)) {
    // Xóa các bản ghi trong bảng singer_song liên quan đến bài hát
    $sql = "DELETE FROM singer_song WHERE song_id = '$id'";
    mysqli_query($conn, $sql);

    // Xóa các bản ghi trong bảng song_song_type liên quan đến bài hát
    $sql = "DELETE FROM song_song_type WHERE song_id = '$id'";
    mysqli_query($conn, $sql);
    // Chuyển chuỗi $singerIds thành mảng
        $singerIds = explode(',', $singerIds);

    // Thêm lại các bản ghi mới vào bảng singer_song
        foreach ($singerIds as $singerId) {
            $sql = "INSERT INTO singer_song (singer_id, song_id) VALUES ('$singerId', '$id')";
            mysqli_query($conn, $sql);
        }

    // Chuyển chuỗi $songTypeIds thành mảng
        $songTypeIds = explode(',', $songTypeIds);

        foreach ($songTypeIds as $songTypeId) {
            $sql = "INSERT INTO song_song_type (song_type_id, song_id) VALUES ('$songTypeId', '$id')";
            mysqli_query($conn, $sql);
        }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Có lỗi khi cập nhật bài hát.']);
}

mysqli_close($conn);
?>
