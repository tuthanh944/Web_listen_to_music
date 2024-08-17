<?php
include '../controller/connectDB.php';

$id = $_POST['id'];
$name = $_POST['name'];
$role = $_POST['role'];
$vip = $_POST['vip'];

$sql = "UPDATE users SET username='$name', roles='$role', vip='$vip' WHERE id=$id";
if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "error";
}
mysqli_close($conn);
?>
