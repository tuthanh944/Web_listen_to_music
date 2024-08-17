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
                          class='app-menu__icon bx bx-purchase-tag-alt'></i><span class="app-menu__label">Bình luận </span></a>
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

                <a class="btn btn-add btn-sm" data-toggle="modal" data-target="#ModalADD" title="Thêm"><i class="fas fa-plus"></i>
                  Thêm tài khoản</a>
              </div>


              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm print-file" type="button" title="In" onclick="myApp.printTable()"><i
                    class="fas fa-print"></i> In dữ liệu</a>
              </div>


              <div class="col-sm-2">
                <a class="btn btn-excel btn-sm" href="" title="In" onclick="event.preventDefault(); exportExcel('userTable')"><i class="fas fa-file-excel" ></i> Xuất Excel</a>
              </div>
              <div class="col-sm-2">
                <a class="btn btn-delete btn-sm pdf-file" type="button" title="In" onclick="myFunction(this)"><i
                    class="fas fa-file-pdf"></i> Xuất PDF</a>
              </div>

            </div>
            <table class="table table-hover table-bordered js-copytextarea" cellpadding="0" cellspacing="0" border="0"
              id="userTable">
              <thead>
                <tr>
                  <th width="10"><input type="checkbox" id="all"></th>
                  <th>ID tài khoản</th>
                  <th>Hình ảnh</th>
                  <th>Tên tài khoản</th>
                  <th>Email</th>
                  <th>Vip</th>
                  <th>Phân quyền</th>
                  <th>Chức năng</th>
                </tr>
              </thead>
              <tbody>
                 <?php
                 $listUsers = getUsers($conn);
                    foreach ($listUsers as $user) {
                        ?>
                            <tr>
                                <td width="10"><input type="checkbox" name="check1" value="1"></td>
                                <td><?= $user['id'] ?></td>
                                <td width="100"><img src="<?= '../uploads/user-images/' . $user['avatar'] ?>" width="100"></td>
                                <td><?= $user['username'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><span class="<?= $user['vipClass'] ?>"><?= $user['vip'] ?></span></td>
                                <td><?= $user['roles'] ?></td>
                                <td class="table-td-center">
                                    <button class="btn btn-primary btn-sm edit-user" type="button" title="Sửa" id="show-emp"
                                            data-toggle="modal" data-target="#ModalUP" data-id="<?=$user['id']?>"><i class="fas fa-edit"></i>
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





  <div class="modal fade" id="ModalUP" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"
       data-keyboard="false">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">

              <div class="modal-body">
                  <div class="row">
                      <div class="form-group  col-md-12">
              <span class="thong-tin-thanh-toan">
                <h5>Chỉnh sửa thông tin người dùng cơ bản</h5>
              </span>
                      </div>
                  </div>
                  <div class="row">
                      <div class="form-group col-md-6">
                          <label class="control-label">ID </label>
                          <input class="form-control" type="text" required id="user_id" disabled>
                      </div>
                      <div class="form-group col-md-6">
                          <label class="control-label">Họ và tên</label>
                          <input class="form-control" type="text" required id="user_name">
                      </div>
                      <div class="form-group  col-md-6">
                          <label class="control-label">Email</label>
                          <input class="form-control" type="email"  id="email" disabled>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="control-label" class="control-label">Chức vụ</label>
                          <select class="form-control" id="role">
                              <option value="1">Admin</option>
                              <option value="0">User</option>
                          </select>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="control-label" class="control-label">VIP</label>
                          <select class="form-control" id="vip">
                              <option value="1">VIP Member</option>
                              <option value="0">Member</option>
                          </select>
                      </div>

                  </div>
                  <BR>
                  <BR>
                  <BR>
                  <button class="btn btn-save" type="submit">Lưu lại</button>
                  <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
                  <BR>
              </div>
              <div class="modal-footer">
              </div>
          </div>
      </div>
  </div>



<!--  <div class="modal fade" id="ModalADD" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static"-->
<!--    data-keyboard="false">-->
<!--    <div class="modal-dialog modal-dialog-centered" role="document">-->
<!--      <div class="modal-content">-->
<!---->
<!--        <div class="modal-body">-->
<!--          <div class="row">-->
<!--            <div class="form-group  col-md-12">-->
<!--              <span class="thong-tin-thanh-toan">-->
<!--                <h5>Thêm người dùng</h5>-->
<!--              </span>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="row">-->
<!--            <div class="form-group col-md-6">-->
<!--              <label class="control-label">Họ và tên</label>-->
<!--              <input class="form-control" type="text" required id="username">-->
<!--            </div>-->
<!--            <div class="form-group  col-md-6">-->
<!--              <label class="control-label">Email</label>-->
<!--              <input class="form-control" type="email"  id="email1" required >-->
<!--            </div>-->
<!--              <div class="form-group  col-md-6">-->
<!--                  <label class="control-label">Password</label>-->
<!--                  <input class="form-control" type="password"  id="password" >-->
<!--              </div>-->
<!--            <div class="form-group col-md-6">-->
<!--                <label for="control-label" class="control-label">Chức vụ</label>-->
<!--                <select class="form-control" id="role1">-->
<!--                    <option value="1">Admin</option>-->
<!--                    <option value="0">User</option>-->
<!--                </select>-->
<!--            </div>-->
<!--            <div class="form-group col-md-6">-->
<!--                <label for="control-label" class="control-label">VIP</label>-->
<!--                <select class="form-control" id="vip1">-->
<!--                    <option value="1">VIP Member</option>-->
<!--                    <option value="0">Member</option>-->
<!--                </select>-->
<!--            </div>-->
<!---->
<!--          </div>-->
<!--          <BR>-->
<!--          <BR>-->
<!--          <BR>-->
<!--          <button class="btn btn-add" id="addUser" type="submit">Lưu lại</button>-->
<!--          <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>-->
<!--          <BR>-->
<!--        </div>-->
<!--        <div class="modal-footer">-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->


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
  <script type="text/javascript">$('#userTable').DataTable();</script>
  <script>

      $(document).on('click', '.edit-user', function() {
          var id = $(this).data('id');
          var row = $(this).closest('tr');
          var image = row.find('td:eq(2) img').attr('src');
          var name = row.find('td:eq(3)').text();
          var email = row.find('td:eq(4)').text();
          var vip = row.find('td:eq(5)').text();
          var role = row.find('td:eq(6)').text();



          if (vip === "Member") {
              $('#vip option[value="0"]').prop('selected', true);
          } else {
              $('#vip option[value="1"]').prop('selected', true);
          }

          if (role === "Admin") {
              $('#role option[value="1"]').prop('selected', true);
          } else {
              $('#role option[value="0"]').prop('selected', true);
          }

          $('#user_id').val(id);
          $('#user_name').val(name);
          $('#email').val(email);
          $('#image').attr('src',preview);

          $('#ModalUP').modal('show');
      });



    //Modal
    $("#show-emp").on("click", function () {
      $("#ModalUP").modal({ backdrop: false, keyboard: false })
    });
  </script>




  <script>$(document).on('click', '.btn-save', function() {
          var id = $('#user_id').val();
          var name = $('#user_name').val();
          var role = $('#role').val();
          var vip = $('#vip').val();

          $.ajax({
              url: 'update_user.php',
              method: 'POST',
              data: {id:id, name:name, role:role, vip:vip},
              success: function(response) {
                  swal("Thành công!", "Thông tin tài khoản đã được cập nhật.", "success");
                  setTimeout(function() {
                      location.reload();
                  }, 1000);
              }
          });
      });
  </script>




</body>

</html>