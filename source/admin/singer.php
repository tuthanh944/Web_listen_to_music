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

                            <a class="btn btn-add btn-sm" data-toggle="modal" data-target="#addSinger" title="Thêm"><i class="fas fa-plus"></i>
                                Thêm ca sĩ</a>
                        </div>


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
                            <th>Tên ca sĩ</th>
                            <th>Quốc tịch</th>
                            <th>Chức năng</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $listSinger = getSingers($conn);
                        foreach ($listSinger as $singer) {
                            ?>
                            <tr>
                                <td width="10"><input type="checkbox" name="check1" value="1"></td>
                                <td><?= $singer['id'] ?></td>
                                <td><?= $singer['name'] ?></td>
                                <td><span class="badge badge-success"><?= $singer['country'] ?></span></td>
                                <td class="table-td-center">
                                    <button class="btn btn-primary btn-sm edit-singer" type="button" title="Sửa" id="show-emp"
                                            data-toggle="modal" data-target="#ModalUP" data-id="<?=$singer['id']?>"><i class="fas fa-edit"></i>
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



<div class="modal fade" id="addSinger" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"
     data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="form-group  col-md-12">
              <span class="thong-tin-thanh-toan">
                <h5>Chỉnh sửa thông tin ca sĩ</h5>
              </span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="control-label">Tên ca sĩ</label>
                        <input class="form-control" type="text"  id="singer_name1"  name="singer_name1">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Quốc gia</label>
                        <select class="form-control" name="country1">
                            <option value="Việt Nam">Việt Nam</option>
                            <option value="Mỹ">Mỹ</option>
                            <option value="Anh">Anh</option>
                            <option value="Pháp">Pháp</option>
                            <option value="Đức">Đức</option>
                            <option value="Hàn Quốc">Hàn Quốc</option>
                            <option value="Nhật Bản">Nhật Bản</option>
                            <option value="Trung Quốc">Trung Quốc</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Singapore">Singapore</option>
                        </select>
                    </div>

                </div>
                <BR>
                <BR>
                <BR>
                <button class="btn btn-save"  id="add_singer" type="submit">Lưu lại</button>
                <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
                <BR>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="ModalUP" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"
     data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="form-group  col-md-12">
              <span class="thong-tin-thanh-toan">
                <h5>Chỉnh sửa thông tin ca sĩ</h5>
              </span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="control-label">ID </label>
                        <input class="form-control" type="text" required id="singer_id" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Tên ca sĩ</label>
                        <input class="form-control" type="text" required id="singer_name">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Quốc gia</label>
                        <select class="form-control" name="country">
                            <option value="Việt Nam">Việt Nam</option>
                            <option value="Mỹ">Mỹ</option>
                            <option value="Anh">Anh</option>
                            <option value="Pháp">Pháp</option>
                            <option value="Đức">Đức</option>
                            <option value="Hàn Quốc">Hàn Quốc</option>
                            <option value="Nhật Bản">Nhật Bản</option>
                            <option value="Trung Quốc">Trung Quốc</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Singapore">Singapore</option>
                        </select>
                    </div>


                </div>
                <BR>
                <BR>
                <BR>
                <button class="btn btn-save"  id="edit_user" type="submit">Lưu lại</button>
                <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
                <BR>
            </div>
            <div class="modal-footer">
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





<script>
    $(document).ready(function() {
        $('#add_singer').on('click', function() {
            var singer_name = $('#singer_name1').val();
            var country = $('select[name="country1"]').val();
            console.log(country);
            console.log(singer_name)

            $.ajax({
                url: 'add_singer.php',
                type: 'POST',
                data: {
                    singer_name: singer_name,
                    country: country
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thông báo',
                        text: 'Lưu thông tin ca sĩ thành công!',
                        confirmButtonText: "OK",
                    }).then(() => {
                        $('#addSinger').modal('toggle');
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


<script>

    $(document).on('click', '.edit-singer', function() {
        var id = $(this).data('id');
        var row = $(this).closest('tr');
        var name = row.find('td:eq(2)').text();
        var country = row.find('td:eq(3)').text();

        $('#singer_id').val(id);
        $('#singer_name').val(name);
        $('#country').val(country);

        $('#ModalUP').modal('show');
    });



    //Modal

</script>

</body>

</html>