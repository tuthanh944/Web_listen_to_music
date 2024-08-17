<?php
if (isset($_POST['id']) && $_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once('../controller/connectDB.php');

    $commentId = $_POST['id'];

    // Thực hiện truy vấn SQL để xóa bình luận từ cơ sở dữ liệu
    $sql = "DELETE FROM cmt WHERE id = $commentId";
    if ($conn->query($sql) === TRUE) {
        http_response_code(200);
        echo 'Bình luận đã được xóa thành công!';
    } else {
        http_response_code(500);
        echo 'Đã xảy ra lỗi khi xóa bình luận: ' . $conn->error;
    }

    $conn->close();
} else {
    // Trả về phản hồi Ajax lỗi nếu yêu cầu không hợp lệ
    echo 'Yêu cầu không hợp lệ!';
}
?>
