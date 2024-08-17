<?php
include 'controller.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Danh sách bài hát | Quản trị Admin</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- or -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <!-- Font-icon css-->
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
            <p class="app-sidebar__user-name"><b>Xin chào <?php echo $_SESSION['username']; ?></b></p>
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
            <li class="breadcrumb-item active"><a href="#"><b>Danh sách bài hát</b></a></li>
        </ul>
        <div id="clock"></div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">

                    <div class="row element-button">
                        <div class="col-sm-2">

                            <a class="btn btn-add btn-sm" href="add_song.php" title="Thêm"><i class="fas fa-plus"></i>
                                Thêm bài hát</a>
                        </div>
                        <div class="col-sm-2">
                            <a class="btn btn-delete btn-sm print-file" type="button" title="In"
                               onclick="myApp.printTable()"><i
                                        class="fas fa-print"></i> In dữ liệu</a>
                        </div>

                        <div class="col-sm-2">
                            <a class="btn btn-excel btn-sm" href="" title="In"
                               onclick="event.preventDefault(); exportExcel('musicTable')"><i
                                        class="fas fa-file-excel"></i> Xuất Excel</a>
                        </div>
                        <div class="col-sm-2">
                            <a class="btn btn-delete btn-sm pdf-file" title="In"
                               onclick="event.preventDefault(); exportPdf('musicTable')"><i
                                        class="fas fa-file-pdf"></i> Xuất PDF</a>
                        </div>
                        <div class="col-sm-2">
                            <a class="btn btn-delete btn-sm" type="button" title="Xóa" onclick=""><i
                                        class="fas fa-trash-alt"></i> Xóa tất cả </a>
                        </div>
                    </div>
                    <table class="table table-hover table-bordered js-copytextarea" cellpadding="0" cellspacing="0"
                           border="0"
                           id="musicTable">
                        <thead>
                        <tr>
                            <th width="10"><input type="checkbox" id="all"></th>
                            <th>ID bài hát</th>
                            <th>Tên bài hát</th>
                            <th>Thể loại</th>
                            <th>Ca sĩ</th>
                            <th>Năm phát hành</th>
                            <th>Dữ liệu</th>
                            <th>Hình ảnh</th>
                            <th>Chức năng</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $listSongs = getSong($conn);
                        foreach ($listSongs as $song) {
                            ?>
                            <tr>
                                <td width="10"><input type="checkbox" name="check1" value="1"></td>
                                <td><?= $song['id'] ?></td>
                                <td><?= $song['name'] ?></td>
                                <td><span class="badge bg-secondary"> <?= $song['genres'] ?></span></td>
                                <td><span class="badge bg-success"><?= $song['singers'] ?></span></td>
                                <td><?= $song['year'] ?></td>
                                <td><?= $song['data'] ?></td>
                                <td width="100"><img width="100" src="<?= '../uploads/song-images/' . $song['image'] ?>"
                                                     alt=""></td>
                                <td class="table-td-center">
                                    <button class="btn btn-primary btn-sm trash" type="button"
                                            data-id="<?= $song['id'] ?>" title="Xóa"
                                            data-toggle="modal" data-target="#deleteModal"><i
                                                class="fas fa-trash-alt"></i>
                                    </button>
                                    <button class="btn btn-primary btn-sm edit-song" type="button" title="Sửa"
                                            id="show-emp"
                                            data-toggle="modal" data-target="#ModalUP" data-id="<?= $song['id'] ?>"><i
                                                class="fas fa-edit"></i>
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


<!-- Modal confirm xóa -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Xóa bài hát</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa bài hát này không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnDelete">Xóa</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
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
                <h5>Chỉnh sửa thông tin bài hát</h5>
              </span>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">ID bài hát</label>
                            <input class="form-control" type="text" required name="song_id" id="song_id" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Tên bài hát</label>
                            <input class="form-control" type="text" required name="song_name" id="song_name">
                        </div>
                        <div class="form-group  col-md-6">
                            <label class="control-label" for="geners">Thể loại</label>
                            <select class="form-control w-100" id="geners" multiple style="height: 100px;"
                                    name="song_type_ids">
                                <?php
                                $listSongTypes = getSongTypes($conn);
                                $count = 1;
                                foreach ($listSongTypes as $songType) {
                                    ?>
                                    <option value="<?= $songType['id'] ?>"><?= $count . '. ' . $songType['name'] ?></option>
                                    <?php
                                    $count++;
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label" for="singer">Ca sĩ</label>
                            <select class="form-control w-100" id="singer" multiple style="height: 100px;"
                                    name="singer_ids">
                                <?php
                                $listSingers = getSingers($conn);
                                $count = 1;
                                foreach ($listSingers as $singer) {
                                    ?>
                                    <option value="<?= $singer['id'] ?>"><?= $count . '. ' . $singer['name'] ?></option>
                                    <?php
                                    $count++;
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label" for="release_year">Năm phát hành</label>
                            <select class="form-control w-100" id="release_year"  style="height: 100px;"
                                    name="release_year">
                                <?php
                                for ($i = 1950; $i <= 2023; $i++) {
                                    ?>
                                    <option value="<?= $i ?>">- <?= $i ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">Dữ liệu</label>
                            <input class="form-control" id="data" type="file" name="data">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">Hình ảnh</label>
                            <input class="form-control" type="file" id="image" name="image">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="control-label">Review hình ảnh</label>
                            <img src="" alt="" id="preview" style="height: 100px;">
                        </div>

                    </div>
                    <BR>
                    <BR>
                    <BR>
                    <button class="btn btn-save" type="submit" id="editSong">Lưu lại</button>
                    <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
                    <BR>
            </div>
            </form>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


<!-- Essential javascripts for application to work-->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="src/jquery.table2excel.js"></script>
<script src="js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<!-- Data table plugin-->
<script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">$('#musicTable').DataTable();</script>


<script>

    // Thêm sự kiện click cho button xóa
    $(document).on('click', '.trash', function () {
        songId = $(this).data('id');
        console.log(songId);
    });

    // Bắt sự kiện nhấn vào nút "Xóa"
    $('#btnDelete').click(function () {
        // Gửi request AJAX để xóa bài hát từ database
        $.ajax({
            url: 'delete_song.php',
            method: 'POST',
            data: {id: songId},
            success: function (response) {
                // Nếu xóa bài hát thành công, hiển thị thông báo thành công
                console.log(response)
                swal({
                    title: "Xóa bài hát thành công",
                    icon: "success",
                    button: "Đóng"
                }).then(function () {
                    // Sau khi nhấn nút "Đóng", tải lại trang
                    window.location.reload();
                });
            },
            error: function (err) {
                // Nếu xóa bài hát không thành công, hiển thị thông báo lỗi
                swal({
                    title: "Xóa bài hát không thành công",
                    text: err.responseText,
                    icon: "error",
                    button: "Đóng"
                });
            }
        });
    });


</script>

<script>


    $(document).ready(function () {
        $('#editSong').click(function (event) {
            event.preventDefault();
                // Lấy thông tin bài hát từ form
                var songId = $('#song_id').val();
                var songName = $('#song_name').val();
                var songTypeIds = $('#geners').val();
                var singerIds = $('#singer').val();
                var releaseYear = $('#release_year').val();
                var data = $('#data').prop('files')[0];
                var image = $('#image').prop('files')[0];

                console.log(singerIds)

                console.log(data)

                // Tạo đối tượng FormData để gửi dữ liệu lên server
                var formData = new FormData();
                formData.append('id', songId);
                formData.append('name', songName);
                formData.append('song_type_ids', songTypeIds);
                formData.append('singer_ids', singerIds);
                formData.append('release_year', releaseYear);
                formData.append('data', data);
                formData.append('image', image);
            console.log(formData)
            $.ajax({
                type: 'POST',
                url: 'update_song.php',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    var result = JSON.parse(response);
                    if (result.success) {
                        swal({
                            title: 'Thành công',
                            text: 'Chỉnh sửa bài hát thành công!',
                            icon: 'success',
                            button: 'OK'
                        }).then(function () {
                            location.reload();
                        });
                    } else {
                        swal({
                            title: 'Thất bại',
                            text: 'Đã có lỗi xảy ra. Vui lòng thử lại!',
                            icon: 'error',
                            button: 'OK'
                        });
                    }
                },
                error: function () {
                    swal({
                        title: 'Thất bại',
                        text: 'Đã có lỗi xảy ra. Vui lòng thử lại!',
                        icon: 'error',
                        button: 'OK'
                    });
                }
            });
        });
    });


</script>


<script>

    // hển thị trên modal
    $(document).on('click', '.edit-song', function () {
        var id = $(this).data('id');
        var row = $(this).closest('tr');
        var name = row.find('td:eq(2)').text();
        var data = row.find('td:eq(6)').text();
        var preview = row.find('td:eq(7) img').attr('src');
        console.log(id);
        console.log(data);
        console.log(preview);


        $('#song_id').val(id);
        $('#song_name').val(name);
        $('#preview').attr('src', preview);

        $('#ModalUP').modal('show');
    });

    // hiển thị hình ảnh đã chọn lên thẻ <img>
    document.getElementById("image").addEventListener("change", function () {
        var reader = new FileReader();
        reader.onload = function () {
            document.getElementById("preview").src = reader.result;
        }
        reader.readAsDataURL(this.files[0]);
    });


    function deleteRow(r) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("myTable").deleteRow(i);
    }


    oTable = $('#musicTable').dataTable();
    $('#all').click(function (e) {
        $('#musicTable tbody :checkbox').prop('checked', $(this).is(':checked'));
        e.stopImmediatePropagation();
    });


    // //Modal
    // $("#show-emp").on("click", function () {
    //   $("#ModalUP").modal({ backdrop: false, keyboard: false })
    // });
</script>
</body>

</html>