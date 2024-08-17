<?php

include '../controller/connectDB.php';
session_start();

$name = $_POST['username'];
$role = $_POST['role1'];
$vip = $_POST['vip1'];
$pass = $_POST['password'];
$encrypted_password = password_hash($pass, PASSWORD_DEFAULT);

$sql = "INSERT INTO users ( username, roles, vip,password,avatar) VALUES ( '$name', '$role', '$vip','$encrypted_password','defaut.png')";
if ($conn->query($sql) === TRUE) {
    $_SESSION['success'] = "Thêm người dùng thành công";
    echo "success";
} else {
    $_SESSION['error'] = "Thêm người dùng thất bại: " . $conn->error;
    echo "error";
}

$conn->close();
?>
