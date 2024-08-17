<?php
include 'controller.php';
include 'userController.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Danh sách tài khoản | Quản trị Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- or -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.8/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="js/main.js"></script>


</head>

<body onload="time()" class="app sidebar-mini rtl">
<!-- Navbar-->
<header class="app-header">
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar"
                                    aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">


        <!-- User Menu-->
        <li><a class="app-nav__item" href="../login.php"><i class='bx bx-log-out bx-rotate-180'></i> </a>

        </li>
    </ul>
</header>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?=  '../uploads/user-images/' .  $_SESSION['avatar']; ?>" width="50px"
                                        alt="User Image">
        <div>
            <p class="app-sidebar__user-name"><b>Xin chào <?= $_SESSION['username']; ?></b></p>
            <p class="app-sidebar__user-designation">Quản lý hệ thống</p>
        </div>
    </div>
    <hr>
    <ul class="app-menu">
        <li><a class="app-menu__item haha" href="index.php"><i class='app-menu__icon bx bx-tachometer'></i><span
                    class="app-menu__label">Tổng quan</span></a></li>
        <li><a class="app-menu__item " href="users_data.php"><i class='app-menu__icon bx bx-id-card'></i> <span
                    class="app-menu__label">Quản lý tài khoản</span></a></li>
        <li><a class="app-menu__item " href="songs_data.php"><i class='app-menu__icon bx bx bxs-music'></i> <span
                    class="app-menu__label">Quản lý bài hát</span></a></li>
        <li><a class="app-menu__item" href="singer.php"><i class='app-menu__icon bx bx-user-voice'></i><span
                    class="app-menu__label">Quản lý ca sĩ</span></a></li>
        <li><a class="app-menu__item" href="comment.php"><i
                    class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Bình luận</span></a>
        </li>
    </ul>
</aside>
<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active"><a href="#"><b>Danh sách tài khoản</b></a></li>
        </ul>
        <div id="clock"></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">

                    <div class="row element-button">
         
                        <div class="col-sm-2">
                            <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i
                                    class="fas fa-print"></i> In dữ liệu</a>
                        </div>


                        <div class="col-sm-2">
                            <a class="btn btn-excel btn-sm" href="" title="In" onclick="event.preventDefault(); exportExcel('userTable')"><i class="fas fa-file-excel" ></i> Xuất Excel</a>
                        </div>


                    </div>
                    <table class="table table-hover table-bordered js-copytextarea" cellpadding="0" cellspacing="0" border="0"
                           id="userTable">
                        <thead>
                        <tr>
                            <th width="10"><input type="checkbox" id="all"></th>
                            <th>ID</th>
                            <th>Bình luận</th>
                            <th>Tên người dùng</th>
                            <th>Bài hát</th>
                            <th>Chức năng</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $listComments = getComments($conn);
                        foreach ($listComments as $cmt) {
                            ?>
                            <tr>
                                <td width="10"><input type="checkbox" name="check1" value="1"></td>
                                <td><?= $cmt['id'] ?></td>
                                <td><?= $cmt['content'] ?></td>
                                <td><?= $cmt['username'] ?></td>
                                <td><?= $cmt['song_name'] ?></td>

                                <td class="table-td-center">
                                    <button class="btn btn-primary btn-sm trash" type="button"
                                            data-id="<?= $cmt['id'] ?>" title="Xóa"
                                            data-toggle="modal" data-target="#deleteModal"><i
                                                class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>


<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Xóa bình buận</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa bình luận này không?
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" data-dismiss="modal" id="btnDelete">Xóa</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
            </div>
        </div>
    </div>
</div>




<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="src/jquery.table2excel.js"></script>
<script src="js/main.js"></script>
<script src="js/plugins/pace.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">$('#userTable').DataTable();</script>






</body>

<script>

    $(document).on('click', '.trash', function () {
        commentId = $(this).data('id');
    });


    $(document).ready(function() {
        $('#btnDelete').on('click', function() {
            console.log(commentId)
                $.ajax({
                    url: 'delete_comment.php',
                    type: 'POST',
                    data: {
                        id: commentId
                    },
                    success: function(response) {
                        // Hiển thị thông báo thành công
                        console.log(response)
                        Swal.fire({
                            icon: 'success',
                            title: 'Thông báo',
                            text: 'Xóa bình luận thành công!',
                            confirmButtonText: "OK",
                        }).then(() => {
                            // Cập nhật trang web của mình để phản ánh thay đổi
                            location.reload();
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Lỗi: ' + textStatus + ' - ' + errorThrown);
                    }
                });
        });
    });

</script>

</html>