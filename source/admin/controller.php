<?php
    include '../controller/connectDB.php';
    session_start();



/*----------------------------------------------Sử dụng trong file index----------------------------------------------*/
    // Tổng số tài khoản
    $sql_total_user = "SELECT COUNT(*) as total FROM users";
    $result = mysqli_query($conn, $sql_total_user);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $total_user = $row['total'];
    }


    // Tổng số bài hát
    $sql_total_song = "SELECT COUNT(*) as total FROM songs";
    $result = mysqli_query($conn, $sql_total_song);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $total_song = $row['total'];
    }


/*----------------------------------------------Sử dụng trong file song_data----------------------------------------------*/
    // Xuất danh sách bài hát
    function getSongGenres($songId, $conn) {
        $sql = "SELECT st.name 
                                FROM song_song_type sst 
                                JOIN song_type st ON sst.song_type_id = st.id 
                                WHERE sst.song_id = '$songId'";

        $result = mysqli_query($conn, $sql);
        $genres = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $genres[] = $row["name"];
        }
        mysqli_free_result($result);
        return implode(", ", $genres);
    }

    function getSongSingers($songId, $conn) {
        $sql = "SELECT sg.name
                            FROM singer_song ss
                            JOIN singer sg ON ss.singer_id = sg.id
                            WHERE ss.song_id = '$songId'";

        $result = mysqli_query($conn, $sql);
        $singers = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $singers[] = $row["name"];
        }
        mysqli_free_result($result);
        return implode(", ", $singers);
    }

    function getSong($conn){
        $sql_read_song = 'SELECT * FROM songs';
        $result = mysqli_query($conn, $sql_read_song);
        if (mysqli_num_rows($result) > 0) {
            $listSongs = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $singers = getSongSingers($row['id'],$conn);
                $genres =   getSongGenres($row['id'],$conn);
                $song = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'genres' => $genres,
                    'singers' => $singers,
                    'year' => $row['year'],
                    'data' => $row['data'],
                    'image' => $row['image']
                );
                $listSongs[] = $song;

            }
            return $listSongs;
        }
    }

    function getSongTypes($conn){
        $sql= 'SELECT * FROM song_type';
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $listSongTypes = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $songTypes = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                );
                $listSongTypes[] = $songTypes;

            }
            return $listSongTypes;
        }
    }

    function getSingers($conn){
        $sql= 'SELECT * FROM singer';
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $listSingers = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $singers = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'country' => $row['country']
                );
                $listSingers[] = $singers;

            }
            return $listSingers;
        }
    }

function getComments($conn){
    $query = "SELECT cmt.id, cmt.content, users.username, songs.name
              FROM cmt 
              JOIN users ON cmt.id_user = users.id 
              JOIN songs ON cmt.id_song = songs.id";
    $result = mysqli_query($conn, $query);
    $listComments = array();
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $comment = array(
                'id' => $row['id'],
                'content' => $row['content'],
                'username' => $row['username'],
                'song_name' => $row['name']
            );
            array_push($listComments, $comment);
        }
    }
    return $listComments;
}






/*--------------------------------------------------------------------------------------------------------*/



/*----------------------------------------------Sử dụng trong file add_song----------------------------------------------*/
    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        if (empty($_POST['song_name'])) {
            $_SESSION['error'] = "Vui lòng nhập tên bài hát!";
        } elseif (empty($_POST['singer_ids'])) {
            $_SESSION['error'] = "Vui lòng chọn ít nhất một ca sĩ!";
        } elseif (empty($_POST['song_type_ids'])) {
            $_SESSION['error'] = "Vui lòng chọn ít nhất một thể loại!";
        } else if (empty($_FILES['data']['name'])) {
            $_SESSION['error'] = "Vui lòng chọn file dữ liệu!";
        } else {
            // Lấy dữ liệu từ form
            $song_name = $_POST["song_name"];
            $singer_ids = $_POST["singer_ids"];
            $song_type_ids = $_POST["song_type_ids"];
            $release_year = $_POST["release_year"];
            $lyric = $_POST["lyric"];

            // Lưu hình ảnh vào thư mục trên máy chủ
            $target_dir = "../uploads/song-images/";
            $name_file = basename($_FILES["ImageUpload"]["name"]);
            $target_file = $target_dir . $name_file;
            move_uploaded_file($_FILES["ImageUpload"]["tmp_name"], $target_file);

            // Lưu file mp3 vào thư mục trên máy chủ
            $target_dir = "../uploads/data_song/";
            $name_file = basename($_FILES["data"]["name"]);
            $target_file = $target_dir . $name_file;
            move_uploaded_file($_FILES["data"]["tmp_name"], $target_file);

            $uploadOk = 1;
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Kiểm tra định dạng file
            if ($fileType != "mp3") {
                $_SESSION['error'] = "Chỉ chấp nhận file MP3";
                $uploadOk = 0;
            }
            // Kiểm tra kích thước file (giới hạn 5MB)
            else if ($_FILES["data"]["size"] > 7000000) {
                $_SESSION['error'] = "File quá lớn";
                $uploadOk = 0;
            }else{

                // Thêm dữ liệu vào cơ sở dữ liệu
                $sql = "INSERT INTO song-images (name, year, image,lyric,data) VALUES ('$song_name', '$release_year', '$name_file','$lyric', '$name_file')";

                if (mysqli_query($conn, $sql)) {
                    $song_id = mysqli_insert_id($conn);
                    // Thêm các bản ghi vào bảng liên kết singer_song
                    foreach ($singer_ids as $singer_id) {
                        $sql = "INSERT INTO singer_song (singer_id, song_id) VALUES ('$singer_id', '$song_id')";
                        mysqli_query($conn, $sql);
                    }

                    // Thêm các bản ghi vào bảng liên kết song_type_song
                    foreach ($song_type_ids as $song_type_id) {
                        $sql = "INSERT INTO song_song_type (song_type_id, song_id) VALUES ('$song_type_id', '$song_id')";
                        mysqli_query($conn, $sql);
                    }

                    $_SESSION['success'] = 'Thêm bài hát thành công';

                    header("Refresh: 3; URL=songs_data.php");
                } else {
                    $_SESSION['error'] = "Có lỗi xảy ra khi thêm bài hát";
                }

                if (isset($_SESSION['error'])) {
                    header("Location: add_song.php");
                    exit;
                }
            }


        }

}



    function addType($name, $conn)
    {
        // Kiểm tra xem tên thể loại đã tồn tại trong cơ sở dữ liệu chưa
        $sql_check = "SELECT COUNT(*) AS count FROM `song_type` WHERE `name` = '$name'";
        $result_check = mysqli_query($conn, $sql_check);
        $count = mysqli_fetch_assoc($result_check)['count'];

        if ($count > 0) {
            return false;
        } else {

            $sql = "INSERT INTO `song_type` (`name`) VALUES ('$name')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }

    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'addType') {
            $name = $_POST['name'];
            $result = addType($name, $conn);
            echo $result;
        }
    }




/*--------------------------------------------------------------------------------------------------------*/

?>