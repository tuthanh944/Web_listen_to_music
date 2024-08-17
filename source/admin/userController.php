<?php
include '../controller/connectDB.php';


/*----------------------------------------------Sử dụng trong file user_data----------------------------------------------*/
function getUsers($conn) {
    $sql = 'SELECT * FROM users';
    $result = mysqli_query($conn, $sql);
    $listUsers = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if($row['vip']==1){
                $row['vip']="Vip Member";
                $vipClass = "badge bg-success";
            }else{
                $row['vip']="Member";
                $vipClass= "badge bg-secondary";
            }

            if($row['roles']==1){
                $row['roles']="Admin";
            }else{
                $row['roles']="User";
            }
            $user = array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password'],
                'email' => $row['email'],
                'avatar' => $row['avatar'],
                'vip' => $row['vip'],
                'roles' => $row['roles'],
                'vipClass' => $vipClass
            );
            $listUsers[] = $user;
        }
    }
    return $listUsers;
}


/*--------------------------------------------------------------------------------------------------------*/



?>
