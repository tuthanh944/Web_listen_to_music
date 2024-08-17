<?php

include '../controller/connectDB.php';

try {
    $singerName = $_POST['singerName'];
    $country = $_POST['country'];
    $singerName = mysqli_real_escape_string($conn, $_POST['singerName']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);

    $sql = "INSERT INTO singer (name, country) VALUES ('$singerName', '$country')";
    $conn->query($sql);



    echo json_encode(array('status' => 'success'));
}
catch(PDOException $e) {
    echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
}

$conn = null;

?>
