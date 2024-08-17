<?php
include 'controller.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thêm bài hát</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- or -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
    <script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
    <script>

        function readURL(input, thumbimage) {
            if (input.files && input.files[0]) { //Sử dụng  cho Firefox - chrome
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("#thumbimage").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else { // Sử dụng cho IE
                $("#thumbimage").attr('src', input.value);

            }
            $("#thumbimage").show();
            $('.filename').text($("#uploadfile").val());
            $('.Choicefile').css('background', '#14142B');
            $('.Choicefile').css('cursor', 'default');
            $(".removeimg").show();
            $(".Choicefile").unbind('click');

        }

        $(document).ready(function () {
            $(".Choicefile").bind('click', function () {
                $("#uploadfile").click();

            });
            $(".removeimg").click(function () {
                $("#thumbimage").attr('src', '').hide();
                $("#myfileupload").html('<input type="file" id="uploadfile"  onchange="readURL(this);" />');
                $(".removeimg").hide();
                $(".Choicefile").bind('click', function () {
                    $("#uploadfile").click();
                });
                $('.Choicefile').css('background', '#14142B');
                $('.Choicefile').css('cursor', 'pointer');
                $(".filename").text("");
            });
        })
    </script>
</head>

<body class="app sidebar-mini rtl">
<style>
    .Choicefile {
        display: block;
        background: #14142B;
        border: 1px solid #fff;
        color: #fff;
        width: 150px;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        padding: 5px 0px;
        border-radius: 5px;
        font-weight: 500;
        align-items: center;
        justify-content: center;
    }

    .Choicefile:hover {
        text-decoration: none;
        color: white;
    }

    #uploadfile,
    .removeimg {
        display: none;
    }

    #thumbbox {
        position: relative;
        width: 100%;
        margin-bottom: 20px;
    }

    .removeimg {
        height: 25px;
        position: absolute;
        background-repeat: no-repeat;
        top: 5px;
        left: 5px;
        background-size: 25px;
        width: 25px;
        /* border: 3px solid red; */
        border-radius: 50%;

    }

    .removeimg::before {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        content: '';
        border: 1px solid red;
        background: red;
        text-align: center;
        display: block;
        margin-top: 11px;
        transform: rotate(45deg);
    }

    .removeimg::after {
        /* color: #FFF; */
        /* background-color: #DC403B; */
        content: '';
        background: red;
        border: 1px solid red;
        text-align: center;
        display: block;
        transform: rotate(-45deg);
        margin-top: -2px;
    }
</style>
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
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="../uploads/user-images/admin.png" width="50px"
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
                        class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label"> Bình luận</span></a>
        </li>
    </ul>
</aside>
<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">Danh sách bài hát</li>
            <li class="breadcrumb-item"><a href="#">Thêm bài hát</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Tạo mới bài hát</h3>
                <div class="tile-body">
                    <div class="row element-button">
                        <div class="col-sm-2">
                            <a class="btn btn-add btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><i
                                        class="fas fa-folder-plus"></i> Thêm thể loại nhạc</a>
                        </div>
                        <div class="col-sm-2">
                            <a class="btn btn-add btn-sm" data-toggle="modal" data-target="#addSinger"><i
                                        class="fas fa-folder-plus"></i> Thêm ca sĩ</a>
                        </div>
                    </div>

                    <form class="row" method="post" enctype="multipart/form-data">
                        <div class="form-group col-md-3">
                            <label class="control-label">Tên bài hát</label>
                            <input class="form-control" type="text" name="song_name">
                        </div>
                        <div class="form-group col-md-3 ">
                            <label class="control-label" for="singer">Ca sĩ</label>
                            <select class="form-control w-100" id="singer" multiple style="height: 100px;"
                                    name="singer_ids[]">
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
                        <div class="form-group col-md-3">
                            <label class="control-label" for="geners">Thể loại</label>
                            <select class="form-control w-100" id="geners" multiple style="height: 100px;"
                                    name="song_type_ids[]">
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

                        <div class="form-group col-md-3">
                            <label class="control-label">Dữ liệu</label>
                            <input class="form-control" type="file" name="data" accept="multipart/form-data">
                        </div>


                        <div class="form-group col-md-3">
                            <label class="control-label" for="release_year">Năm phát hành</label>
                            <select class="form-control w-100" id="release_year" style="height: 50px;"
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

                        <div class="form-group col-md-3">
                            <label class="control-label">Lyric</label>
                            <textarea class="form-control" name="lyric" style="width: 100%; height: 200px;"></textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label class="control-label">Ảnh</label>
                            <div id="myfileupload">
                                <input type="file" id="uploadfile" name="ImageUpload" onchange="readURL(this);"/>
                            </div>
                            <div id="thumbbox">
                                <img height="450" width="400" alt="Thumb image" id="thumbimage" style="display: none"/>
                                <a class="removeimg" href="javascript:"></a>
                            </div>
                            <div id="boxchoice">
                                <a href="javascript:" class="Choicefile"><i class="fas fa-cloud-upload-alt"></i> Chọn
                                    ảnh</a>
                                <p style="clear:both"></p>
                            </div>

                        </div>
                        <button class="btn btn-save" type="submit">Lưu lại</button>
                        <a class="btn btn-cancel" href="#">Hủy bỏ</a>
                    </form>
                </div>

            </div>



            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
            <?php unset($_SESSION['success']); ?>
                <script>
                    setTimeout(function () {
                        $('.alert-danger').fadeOut('slow');
                    }, 3000);
                </script>
            <?php endif; ?>



            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
            <?php unset($_SESSION['error']); ?>
                <script>
                    setTimeout(function () {
                        $('.alert-danger').fadeOut('slow');
                    }, 3000);
                </script>
            <?php endif; ?>



</main>


<!--

-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <form id="addTypeForm" method="post">

                <div class="modal-body">
                    <div class="row">
                        <div class="form-group  col-md-12">
              <span class="thong-tin-thanh-toan">
                <h5>Thêm mới thể loại nhạc</h5>
              </span>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label">Nhập tên thể loại</label>
                            <input class="form-control" type="text" required name="name_type">
                        </div>
                    </div>
                    <BR>
                    <button class="btn btn-save" id="addType" type="submit">Lưu lại</button>
                    <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
                    <BR>
                </div>
                <div class="modal-footer">
                </div>
            </form>

        </div>
    </div>
</div>
<!--
MODAL
-->



<div class="modal fade" id="addSinger" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="form-group  col-md-12">
              <span class="thong-tin-thanh-toan">
                <h5>Thêm mới ca sĩ </h5>
              </span>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Nhập tên ca sĩ</label>
                        <input class="form-control" type="text" name="singer_name" required>
                    </div>

                    <div class="form-group col-md-12">
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
                <button class="btn btn-save" id="btnSaveSinger" type="submit">Lưu lại</button>
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
<script src="js/main.js"></script>
<script src="js/plugins/pace.min.js"></script>

<!-- add.song.php -->

<!-- Thêm thư viện sweetalert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


<script>
    $(document).ready(function () {
        $('#addType').click(function () {
            var name = $('input[name="name_type"]').val();
            $.ajax({
                type: 'POST',
                url: 'controller.php',
                data: {
                    action: 'addType',
                    name: name
                },
                success: function (response) {
                    if (response == true) {
                        Swal.fire({
                            title: "Thành công",
                            text: "Thêm thể loại thành công!",
                            icon: "success",
                            confirmButtonText: "OK",
                        }).then(() => {
                            $('#exampleModalCenter').modal('hide');
                        });
                    } else {
                        Swal.fire({
                            title: "Lỗi",
                            text: "Có lỗi xảy ra khi thêm thể loại!",
                            icon: "error",
                            confirmButtonText: "OK",
                        });
                    }
                }
            });
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('#btnSaveSinger').on('click', function(event) {
            event.preventDefault();

            var singerName = $('input[name="singer_name"]').val();
            var country = $('select[name="country"]').val();
            console.log(singerName)

            $.ajax({
                url: 'add_singer.php',
                method: 'POST',
                data: { singerName: singerName, country: country },
                success: function(response) {
                    console.log(response)
                    Swal.fire({
                        title: 'Thành công',
                        text: 'Lưu ca sĩ thành công!',
                        icon: 'success'
                    }).then(function() {
                        $('#addSinger').modal('hide');
                        location.reload();
                    });
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Lỗi',
                        text: 'Đã có lỗi xảy ra. Vui lòng thử lại sau!',
                        icon: 'error'
                    });
                }
            });
        });
    });

</script>


<script>
    const inpFile = document.getElementById("inpFile");
    const loadFile = document.getElementById("loadFile");
    const previewContainer = document.getElementById("imagePreview");
    // const previewImage = previewContainer.querySelector(".image-preview__image");
    // const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");
    inpFile.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            previewDefaultText.style.display = "none";
            previewImage.style.display = "block";
            reader.addEventListener("load", function () {
                previewImage.setAttribute("src", this.result);
            });
            reader.readAsDataURL(file);
        }
    });

</script>


</body>

</html>