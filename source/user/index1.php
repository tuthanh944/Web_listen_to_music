<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/bxh.css">
    <link rel="stylesheet" href="css/canhan.css">
    <link rel="stylesheet" href="css/casi.css">
    <link rel="stylesheet" href="css/theloai.css">
    <link rel="stylesheet" href="css/timkiem.css">
    <link rel="stylesheet" href="css/background.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <!-- reset css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

    <!-- css để responsive trên các thiết bị -->
    <link rel="stylesheet" href="css/responsive.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous" />
</head>
<body>
    <div class="mains" style="background:radial-gradient(50% 50% at 50% 50%, #F7CBFD 0%, #7758D1 100%);">
       <div class="row no-gutters">
        <div class="sidebar">
            <div class="sidebar__logo">
              <!-- <a href="./index.html"></a> -->
              <img src="../uploads/logo/anh-removebg.png" alt="">
            </div>
            <div class="sidebar__persional">
              <ul class="sidebar__nav">
                  <li class="canhan">
                        <i class="far fa-play-circle"></i>
                        <span>Playlist</span>
                  </li>
                  <li class="active"> 
                    <i class="fas fa-compact-disc"></i>
                    <span>Khám phá</span>
                  </li>
                  <li class="bxh">
                    <i class="fas fa-chart-line"></i>
                    <span>BXH</span>
                  </li>
                  <li class="casi">
                    <i class="far fa-list-alt"></i>
                    <span>Ca sĩ</span>     
                  </li>
                  <li class="underline"></li>
                  <li class="theloai">
                    <i class="fab fa-buromobelexperte"></i>
                    <span> Thể Loại</span>
                  </li>
                </ul>
          </div>
      </div>
    <!-- Music-control -->
      <div class="main-music-control">
        <div class="row">
            <div class="col l-3 m-3 s-8">
                <div class="music-control__left">
                    <div class="music-control__left-img-box">
                        <div class="music-control__left-img" style="background-image: url(../uploads/user-images/0.jpg);"></div>
                    </div>
                    
                    <div class="music-control__left-content">
                        <span class="music-control__left-content-song js__main-color">Cưới luôn được không</span>
                        <br>
                        <span class="music-control__left-content-singer js__sub-color">Út nhị Cover</span>
                    </div>
                    <div class="music-control__left-action tablet-hiden mobile-hiden">
                        <!-- music-control__left-action-tym-box-active -->
                        <div class="music-control__left-action-tym-box">
                            <i class="fas fa-heart music-control__left-action-tym"></i>
                            <i class="far fa-heart music-control__left-action-tym-non"></i>
                        </div>
                        <i class="fas fa-ellipsis-h music-control__left-action-option js__main-color js__toast"></i>
                    </div>
                </div>
            </div>
            <div class="col l-6 m-7 s-4 rs__main-music-control-flex-1">
                <div class="music-control__center">
                    <div class="music-control__center-action music-control__icon">
                        <!-- music-control__icon-random--active -->
                        <i class="fas fa-random music-control__icon1 js__music-control__icon1 js__main-color mobile-hiden"></i>
                        <i class="fas fa-caret-left music-control__icon2 js__music-control__icon2 js__main-color"></i>
                        <!-- music-control__icon-play--active -->
                        <div class="music-control__icon-play js__music-control__icon-play">
                            <i class="fas fa-play music-control__icon3 js__main-color js__border"></i>
                            <i class="fas fa-pause music-control__icon33 js__main-color js__border"></i>
                        </div>
                        <i class="fas fa-caret-right music-control__icon4 js__music-control__icon4 js__main-color"></i>
                        <!-- music-control__icon-repeat--active -->
                        <i class="fas fa-redo music-control__icon5 js__music-control__icon5 mobile-hiden js__main-color"></i>
                    </div>
                    <div class="music-control__progress mobile-hiden">
                        <span class="music-control__progress-time-start js__music-control__progress-time-start js__main-color">00:00</span>
                        <input id="progress" class="music-control__progress-input" type="range" value="0" step="1" min="0" max="100">
                        <!-- <div class="music-control__progress-update">
                            <div class="music-control__progress-update-timeline"></div>
                        </div> -->
                        <span class="music-control__progress-time-duration js__music-control__progress-time-duration js__main-color">00:00</span>
                    </div>
                    <audio id="audio" src="../uploads/data_song/0.mp3"></audio>
                    <div class="id_songs" style="display: none;">2</div>
                </div>
            </div>
            <div class="col l-3 m-2 s-0">
                <div class="music-control__right mobile-hiden">
                    <i class="music-control__right-icon1 fas fa-photo-video"></i>
                    <i class="music-control__right-icon2 fas fa-plus"></i>
                    <a class="music-control__right-icon3" id="download" style="color: white;" href="../uploads/data_song/0.mp3" download><i class=" fas fa-download"></i></a>
                    <!-- music-control__right--active -->
                    <div class="music-control__right-volume-icon mobile-hiden">
                        <i class="music-control__right-icon4 js__main-color fas fa-volume-down"></i>
                        <i class="music-control__right-icon5 js__main-color fas fa-volume-mute"></i>
                    </div>
                    <div class="music-control__volume-progress mobile-hiden">
                        <input id="progress1" class="music-control__volume-input" type="range" value="100" step="1" min="0" max="100">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header">
      <div class="container justify-content-between justify-content-end">
        <div class="header__search d-md-flex">
          <div class="header__search-control">
            <i class="fa-solid fa-arrow-left " id="undo"></i>
            <i class="fa-solid fa-arrow-right " id="redo"></i>
          </div>
          <div class="header__search-box d-md-flex">
            <form method="get" id="seach_music">
            <div class="header__input">
              <label for="header-search"><i class="fa-solid fa-magnifying-glass"></i></label>
              <input id="tenbaihat" name="tenbaihat" type="text" placeholder="Tìm kiếm bài hát." />
            </div>
             <input type="submit" value="Tìm Kiếm" id="timkiem">
            </form>
          </div>
        </div>
        <!-- Đăng nhập -->
        <div class="header__user">
          <div class= "avatar_user" onclick="window.location.href='../login.php'"> <img src="<?=  '../uploads/user-images/' .  $_SESSION['avatar']; ?>" alt=""></div>
          <div class="name_user"><?=$_SESSION['username']?></div>
          <div class="id_user" style="display: none;"><?=$_SESSION['user_id']?></div>
          <div class="header__theme js__sub-color js__backgroundColor">
            <i class="fas fa-tshirt"></i>
        </div>
        </div>
      </div>
    </div>
    <!-- END MUSIC CONTROL -->
       <!-- main -->
       <div class="main">
            <!-- header -->
        <!--Begin Carosel-->
        <div class="container-discover__slider">
          <div class="container-discover__slider-item container-discover__slider-item-first">
              <img src="../uploads/slider/1.jpg" alt="anh" class="container-discover__slider-item-img">
          </div>
          <div class="container-discover__slider-item container-discover__slider-item-second">
              <img src="../uploads/slider/2.jpg" alt="anh" class="container-discover__slider-item-img">
          </div>
          <div class="container-discover__slider-item container-discover__slider-item-third">
              <img src="../uploads/slider/3.jpg" alt="anh" class="container-discover__slider-item-img">
          </div>
          <div class="container-discover__slider-item container-discover__slider-item-four">
              <img src="../uploads/slider/4.jpg" alt="anh" class="container-discover__slider-item-img">
          </div>
          <div class="container-discover__slider-left mobile-hiden js__container-discover__slider-left">
              <i class="fas fa-chevron-left js__main-color"></i>
          </div>
          <div class="container-discover__slider-right mobile-hiden js__container-discover__slider-right">
              <i class="fas fa-chevron-right js__main-color"></i>
          </div>
       </div>
       <div id="sos">
       </div>
       <div class="baihat"><h2>Bài Hát Hay Nhất</h2></div>
       <!--End Carosel-->
       <div class="gridandlist">
       <!-- BEGIN LIst song -->
                       <!-- song -->
                       <div class="option-all__song option-all__margin_bot">
                            <div class="col l-9 m-12 s-12">
                                <div class="option-all__songs">
                                    <ul class="option-all__songs-list songs-list">
                                    </ul>
                                </div>
                            </div>
                        </div>
          </div>
    </div>
    <!-- Cá nhân -->
    <div class="main_canhan">
      <h2 style="color: white;">Your Playlist</h2>
      <ul class="playlist"></ul>
      <h2 style="color: white;">Your bookmark</h2>
      <ul class="show_bookmark"></ul>
    </div>
    <!-- Bảng xếp hạng -->
    <div class="main_bxh">
      <h2 style="color: white;">Bảng Xếp Hạng</h2>
      <ul class="list_bxh"></ul>
    </div>
    <!-- Ca sĩ -->
    <div class="main_casi" id="main_casi"></div>
    <!-- Thể loại -->
    <div class="main_theloai" id="main_theloai"></div>
    <!-- Tìm Kiếm -->
    <div class="timkiem">
      <ul id="seach_music_1"></ul>
    </div>
   </div>
  </div>
  <div id="modal" class="modal">
    <div class="modal-contentx">
      <span class="close">&times;</span>
      <div class="content">
        <div class="modal_lyric_img" style="background-image: url(../uploads/song-images/0.jpg);"></div>
      <div id="lyric">
      </div>
      <div class="cmt">
        <form action="" id="xembinhluan">
          <input type="submit" value="Xem bình luận">
        </form>
        <ul class="khung_cmt" type="none">
        </ul>
         <form action="./assets/php/update_cmt.php" method="get" id="input_cmt" class="input_cmt">
          <div class="input_text">
            <input id="nd_cmt" name="nd_cmt" type="text" placeholder="Viết bình luận....." />
          </div>
          <div class="submit">
            <input type="submit" id="btn" name="btn">
          </div>
         </form>
        </div>
      </div>
    </div>
    </div>
                    <!-- theme modal -->
            <!-- theme-modal--avtive -->
            <div class="theme-modal">
              <div class="theme-modal__overlay"></div>
              <div class="theme-modal__body">
                  <div class="theme-modal__close-btn">
                      <i class="fas fa-times"></i>
                  </div>
                  <h3 class="theme-modal__body-headding js__main-color">Giao diện</h3>
                  <div class="theme-modal__body-group-wrapper">
                      <div class="theme-modal__body-group">
                          <span class="theme-modal__body-group-headding js__main-color">Màu tối</span>
                          <ul class="theme-modal__body-group-list">
                              <li class="theme-modal__body-group-item js-theme-item">
                                  <div class="theme-modal__body-group-item-img-wrapper">
                                      <div class="theme-modal__body-group-item-img" style="background-image: url(../uploads/background/theme1.jpg);"></div>
                                  </div>
                                  <span class="theme-modal__body-group-item-name js__main-color">Tối</span>
                              </li>
                              <li class="theme-modal__body-group-item js-theme-item">
                                  <div class="theme-modal__body-group-item-img-wrapper">
                                      <div class="theme-modal__body-group-item-img" style="background-image: url(../uploads/background/theme2.jpg);"></div>
                                  </div>
                                  <span class="theme-modal__body-group-item-name js__main-color">Tím</span>
                              </li>
                              <li class="theme-modal__body-group-item js-theme-item">
                                  <div class="theme-modal__body-group-item-img-wrapper">
                                      <div class="theme-modal__body-group-item-img" style="background-image: url(../uploads/background/theme3.jpg);"></div>
                                  </div>
                                  <span class="theme-modal__body-group-item-name js__main-color">Xanh đậm</span>
                              </li>
                              <li class="theme-modal__body-group-item js-theme-item">
                                <div class="theme-modal__body-group-item-img-wrapper">
                                    <div class="theme-modal__body-group-item-img" style="background-image: url(../uploads/background/theme4.jpg);"></div>
                                </div>
                                <span class="theme-modal__body-group-item-name js__main-color">Xanh lá</span>
                            </li>
                          </ul>
                        </div>
                  </div>
                  
              </div>
          </div>
    <script src="../user/js/index.js"></script>
    <script src="../user/js/singer.js"></script>
    <script src="../user/js/type_music.js"></script>
    <script src="../user/js/load_cmt.js"></script>
    <script src="../user/js/hien_cmt.js"></script>
    <script src="../user/js/playlist.js"></script>
    <script src="../user/js/show_playlist.js"></script>
    <script src="../user/js/bookmark.js"></script>
    <script src="../user/js/show_bookmark.js"></script>
    <script src="../user/js/update_view.js"></script>
    <script src="../user/js/show_bxh.js"></script>
    <script src="../user/js/doi_nen.js"></script>
    <script src="../user/js/load_bookmark.js"></script>
</body>
</html>