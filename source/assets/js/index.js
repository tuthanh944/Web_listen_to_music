
const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);
let songsData=[];
const xhr = new XMLHttpRequest();
xhr.onreadystatechange = function() {
  if (xhr.readyState === 4 && xhr.status === 200) {
    const response = xhr.responseText;
    const obj =JSON.parse(response);
    songsData=obj;
    const optionAllSongList = $('.option-all__songs-list');
    const playBtn = $('.js__music-control__icon-play');
    const audio = $('#audio');
    const progress = $('#progress');
    const remainTime = $('.js__music-control__progress-time-start');
    const durationTime = $('.js__music-control__progress-time-duration');
    const nameSong = $('.music-control__left-content-song');
    const nameSinger = $('.music-control__left-content-singer');
    const prevBtn = $('.js__music-control__icon2');
    const nextBtn = $('.js__music-control__icon4');
    const download= $('.music-control__right-icon3');
    const lyric=$('.music-control__right-icon1');
    const volumeProgress = $('#progress1');
    const volumeIcon = $('.music-control__right-volume-icon');
    const cdThumb = $('.music-control__left-img');
    const cdThumb2=$('.modal_lyric_img');
    const lyric_content=$('#lyric');
    const search_music_main = $('#seach_music_1');
    const id_song =$('.id_songs');
    // sliderIndex: 0,
    const app = {
        currentIndex : 0,
        isPlaying: false,
        isRandom: false,
        isRepeat: false,
        isMute: false,
        volume: 100,
        defineProperties: function() {
            Object.defineProperty(this, 'currentSong', {
                get: function() {
                    return songsData[this.currentIndex];
                }
            })
        },
        loadCurrentSong: function () {
            nameSong.textContent = this.currentSong.name;
            nameSinger.textContent = this.currentSong.singer;
            $('.music-control__left-img').style.backgroundImage = `url('${this.currentSong.background}')`;
            $('.modal_lyric_img').style.backgroundImage = `url('${this.currentSong.background}')`;
            audio.src = this.currentSong.pathSong;
            lyric_content.innerHTML = this.currentSong.lyric;
            id_song.innerHTML = this.currentSong.id;
            this.displayDurationTime();
        },

        toastSlide: function() {
            const toatMain = $('#toast');
            if (toatMain) {
                const toast = document.createElement('div');
                toast.classList.add('toast');
                toast.innerHTML = `
                    <div class="toast__item">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>Chức năng này đang được phát triển, bạn vui lòng thử lại sau !</span>
                    </div>
                `;
                toatMain.appendChild(toast);
                setTimeout(function() {
                    toatMain.removeChild(toast);
                }, 3000)
            }
        },
        renderSearch: function(playListElement, songsData){
            const form = document.getElementById('seach_music');
            form.addEventListener('submit', function(event) {
              event.preventDefault(); // Ngăn chặn việc gửi form đi
              const tenbaihat= document.getElementById("tenbaihat").value;
              if(tenbaihat.trim()===''){
                return;
              }
              else{
                $('.main_canhan').style.display="none";
                $('.main_bxh').style.display="none";
                $('.main_casi').style.display="none";
                $('.main_theloai').style.display="none";
                $('.main').style.display="none";
                $('.timkiem').style.display="block";
                const filteredSongs = songsData.filter(function(song) {
                    const song_name= song.name.toLowerCase() // chuyển chuỗi sang chữ thường
                    .replace(/đ/g, 'd') // thay thế ký tự đ thành d
                    .normalize('NFD') // tách các ký tự có dấu thành từng ký tự riêng biệt
                    .replace(/[\u0300-\u036f]/g, ''); // loại bỏ các ký tự có dấu
                    const tenbaihat_replace=tenbaihat.toLowerCase() // chuyển chuỗi sang chữ thường
                    .replace(/đ/g, 'd') // thay thế ký tự đ thành d
                    .normalize('NFD') // tách các ký tự có dấu thành từng ký tự riêng biệt
                    .replace(/[\u0300-\u036f]/g, ''); // loại bỏ các ký tự có dấu
                  
                    return song_name.includes(tenbaihat_replace);
                  });
                const htmls = filteredSongs.map((song, index) => {
                    return `
                        <!-- songs-item-playing--active-onplay songs-item--active songs-item-playbtn--active -->
                        <li class="songs-item js__song-item1 ${index == this.currentIndex ? 'songs-item' : ''} " data-index="${index}">
                            <div class="songs-item-left">
                                <div style="background-image: url(${song.background});" class="songs-item-left-img js__songs-item-left-img-0">
                                    <div class="songs-item-left-img-playing-box">
                                    
                                    </div>
                                </div>
    
                                <div class="songs-item-left-body">
                                    <h3 class="songs-item-left-body-name js__main-color">${song.name}</h3>
                                    <span class="songs-item-left-body-singer js__sub-color">${song.singer}</span>
                                </div>
                            </div>
                            <div class="songs-item-center tablet-hiden mobile-hiden  js__sub-color">
                                <span>${song.name} (Remix)</span>
                            </div>
                            <div class="songs-item-right mobile-hiden ">
                                <span class="songs-item-right-duration js__sub-color">${song.duration}</span>
                            </div>
                            <div class="song_id_search" style="display:none">${song.id}</div>
                        </li>`
                })
                playListElement.innerHTML = htmls.join('');
                const songItems1 = $$('.js__song-item1');
                const song_id_search = document.querySelectorAll('.song_id_search');
                songItems1.forEach((songItem1,index) => {
                    songItem1.ondblclick = function() {
                     const song= songsData.find(data => data.id == song_id_search[index].innerHTML);
                     const index1 = songsData.findIndex(song => song.id == song_id_search[index].innerHTML);
                     this.currentIndex = index1;
                     nameSong.textContent = song.name;
                     nameSinger.textContent = song.singer;
                     $('.music-control__left-img').style.backgroundImage = `url('${song.background}')`;
                     $('.modal_lyric_img').style.backgroundImage = `url('${song.background}')`;
                     audio.src = song.pathSong;
                     lyric_content.innerHTML =song.lyric;
                     id_song.innerHTML =song.id;
                     audio.play();
                 }
             })
              }
              // Xử lý dữ liệu ở đây
              
            });
        },
        renderPlayList : function (playListElement, songsData) {
            const htmls = songsData.map((song, index) => {
                return `
                    <!-- songs-item-playing--active-onplay songs-item--active songs-item-playbtn--active -->
                    <li class="songs-item js__song-item0 ${index == this.currentIndex ? 'songs-item' : ''} " data-index="${index}">
                        <div class="songs-item-left">
                            <div style="background-image: url(${song.background});" class="songs-item-left-img js__songs-item-left-img-0">
                                <div class="songs-item-left-img-playing-box">
                                
                                </div>
                            </div>

                            <div class="songs-item-left-body">
                                <h3 class="songs-item-left-body-name js__main-color">${song.name}</h3>
                                <span class="songs-item-left-body-singer js__sub-color">${song.singer}</span>
                            </div>
                        </div>
                        <div class="songs-item-center tablet-hiden mobile-hiden  js__sub-color">
                            <span>${song.name} (Remix)</span>
                        </div>
                        <div class="songs-item-right mobile-hiden ">
                            <span class="songs-item-right-duration js__sub-color">${song.duration}</span>
                        </div>
                    </li>`
            })
            playListElement.innerHTML = htmls.join('');
        },
        
            // ĐỊNH DẠNG LẠI THỜI GIAN CHO ĐẸP
            formatTime : function(number) {
                const minutes = Math.floor(number / 60);
                const seconds = Math.floor(number - minutes * 60);
                return `${minutes < 10 ? "0" + minutes : minutes}:${seconds < 10 ? "0" + seconds : seconds}`;
            },
        
            // HIỂN THỊ REMAIN TIME TIME VÀO PLAYER
            displayRemainTime : function() {
                remainTime.textContent = this.formatTime(audio.currentTime);
            },
        
            // HIỂN THỊ VÀ DURATION TIME VÀO PLAYER
            displayDurationTime : function() {
                durationTime.textContent = this.currentSong.duration;
            },
            nextSong: function () {
                this.currentIndex++;
                if (this.currentIndex >= songsData.length) {
                this.currentIndex = 0;
                }
                this.loadCurrentSong();
            },
        
            prevSong: function () {
                this.currentIndex--;
                if (this.currentIndex < 0) {
                this.currentIndex = songsData.length - 1;
                }
                this.loadCurrentSong();
            },
            
        

            // SỰ KIỆN VÀ XỬ LÝ
        handleEvents: function () {
            const _this = this;
            const songTyms = $$('.songs-item-right-tym');
            const songItems = $$('.js__song-item0');
            const nextSongsItem = $$('.nextsong__item');
            const timkiem =$('#timkiem');
            const undo =$('#undo');

            var sliderIndex = 1;
            var sliderIndex1 = 1;
            var sliderLenght = songsData.length;
            // Tải nhạc
            download.onclick = function (){
               var downloadx= document.getElementById("download");
               downloadx.href= audio.src;
               downloadx.download= nameSong.innerText +".mp3";
            }
            // XỬ LÝ CD QUAY/DỪNG
            const cdThumbAnimate = cdThumb.animate([{ transform: "rotate(360deg)" }], {
                duration: 10000, // 10 seconds
                iterations: Infinity
            });
            cdThumbAnimate.pause();
            // XỬ LÝ CD QUAY/DỪNG
            const cdThumbAnimate2 = cdThumb2.animate([{ transform: "rotate(360deg)" }], {
                duration: 10000, // 10 seconds
                iterations: Infinity
            });
            cdThumbAnimate2.pause();
            //lyric
            lyric.onclick= function(){
                const modal = document.getElementById("modal");
                const closeModalBtn = document.getElementsByClassName("close")[0];
                modal.style.display = "block";
                closeModalBtn.onclick = function() {
                modal.style.display = "none";
                }

                window.onclick = function(event) {
                if (event.target == modal) {
                modal.style.display = "none";
                }
                }
                

            }
            // XỬ LÝ KHI CLICK VÀO NÚT PLAY
            playBtn.onclick = function () {
            if (_this.isPlaying) {
                audio.pause();
            } else {
                audio.play();
            }
            }
            // Khi song được play
            audio.onplay = function () {
                cdThumbAnimate.play();
                cdThumbAnimate2.play();
                const nextSongsItemHeadding = $$('.nextsong__fist-item');
                _this.isPlaying = true;
                // player.classList.add("playing");\
                playBtn.classList.add('music-control__icon-play--active');

            }
    
            // KHI SONG BỊ PAUSE
            audio.onpause = function () {
                cdThumbAnimate.pause();
                cdThumbAnimate2.pause();
                _this.isPlaying = false;
                playBtn.classList.remove('music-control__icon-play--active');
            }
            songItems[this.currentIndex].classList.add('songs-item-playbtn--active');
            // XỬ LÝ KHI AUDIO KẾT THÚC
            audio.onended = function () {
                if (_this.isRepeat) {
                    audio.play();
                } else {
                    nextBtn.click();
                }
            };

            // KHI PREV SONG
            prevBtn.onclick = function() {
                _this.prevSong();
                audio.play();
            }
            // KHI NEXT SONG
            nextBtn.onclick = function() {
            _this.nextSong();
                audio.play();
            }
            // KHI TIẾN ĐỘ BÀI HÁT THAY ĐỔI
            audio.ontimeupdate = function () {
            if (audio.duration) {
                const progressPercent = Math.floor((audio.currentTime / audio.duration) * 100);
                progress.value = progressPercent;
               }
            _this.displayRemainTime();
            }
        
            // KHI TUA SONG
            progress.onchange = function (e) {
                const seekTime = (audio.duration / 100) * e.target.value;
                audio.currentTime = seekTime;
            }
            // KHI CLICK DUP VÀO BÀI NHẠC THÌ PHÁT NHẠC
            songItems.forEach((songItem, index) => {
                songItem.ondblclick = function() {
                    _this.currentIndex = index;
                    _this.loadCurrentSong();
                    audio.play();
                }
            })
            
            // Khi click Dup vào bài hát ở search


        // BẬT TĂT MUTE Ở VOLUME
        volumeIcon.onclick = function() {
            _this.isMute = !_this.isMute;
            volumeIcon.classList.toggle('music-control__right--active', _this.isMute);
            if (_this.isMute) {
                audio.volume = 0;
                volumeProgress.value = 0;
            } else {
                audio.volume = _this.volume / 100;
                volumeProgress.value = _this.volume;
            }
        }

        // TĂNG GIẢM ÂM LƯỢNG
        volumeProgress.onchange = function(e) {
            _this.volume = e.target.value;
            audio.volume = e.target.value / 100;
            if (e.target.value == 0) {
                volumeIcon.classList.add('music-control__right--active')
                _this.isMute = true;
            } else {
                volumeIcon.classList.remove('music-control__right--active');
                _this.isMute = false;
            }
        }
        $('#undo').onclick = function(){
            $('.main_canhan').style.display="none";
            $('.main_bxh').style.display="none";
            $('.main_casi').style.display="none";
            $('.main_theloai').style.display="none";
            $('.main').style.display="block";
            $('.timkiem').style.display="none";
        }
        },
        
        
        start: function() {
            // render ra danh sách nhạc ở phần tổng quan
            this.renderPlayList(optionAllSongList,songsData);
            this.renderSearch(search_music_main,songsData);
            this.handleEvents(); 

            // Define các thuộc tính cho object
            this.defineProperties();
            // hiển thị thời gian chạy và thời lượng của audio hiện tại
            this.displayDurationTime();
            this.loadCurrentSong();

        }

    }


    app.start();

    }
    };
xhr.open('GET', 'user/load_music.php');
xhr.send();
// Carosel
      const slidersDiscover =$$(".container-discover__slider-item");
      var sliderIndex1 = 1;
      changeImage1Replate = function() {
            slidersDiscover.forEach((item,index) => {
                if (index == sliderIndex1) {
                    slidersDiscover[index].classList.replace('container-discover__slider-item-second','container-discover__slider-item-first');
                    slidersDiscover[index].classList.replace('container-discover__slider-item-third','container-discover__slider-item-first');
                    slidersDiscover[index].classList.replace('container-discover__slider-item-four','container-discover__slider-item-first');
                } else if (index == sliderIndex1 + 1) {
                    slidersDiscover[index].classList.replace('container-discover__slider-item-first','container-discover__slider-item-second');
                    slidersDiscover[index].classList.replace('container-discover__slider-item-third','container-discover__slider-item-second');
                    slidersDiscover[index].classList.replace('container-discover__slider-item-four','container-discover__slider-item-second');
                } else if (index == sliderIndex1 + 2) {
                    slidersDiscover[index].classList.replace('container-discover__slider-item-first','container-discover__slider-item-third');
                    slidersDiscover[index].classList.replace('container-discover__slider-item-second','container-discover__slider-item-third');
                    slidersDiscover[index].classList.replace('container-discover__slider-item-four','container-discover__slider-item-third');
                } else {
                    slidersDiscover[index].classList.replace('container-discover__slider-item-first','container-discover__slider-item-four');
                    slidersDiscover[index].classList.replace('container-discover__slider-item-second','container-discover__slider-item-four');
                    slidersDiscover[index].classList.replace('container-discover__slider-item-third','container-discover__slider-item-four');
                }
                if (sliderIndex1 == 2) {
                    slidersDiscover[0].classList.replace('container-discover__slider-item-first','container-discover__slider-item-third');
                    slidersDiscover[0].classList.replace('container-discover__slider-item-second','container-discover__slider-item-third');
                    slidersDiscover[0].classList.replace('container-discover__slider-item-four','container-discover__slider-item-third');
                } else if (sliderIndex1 == 3) {
                    slidersDiscover[0].classList.replace('container-discover__slider-item-first','container-discover__slider-item-second');
                    slidersDiscover[0].classList.replace('container-discover__slider-item-third','container-discover__slider-item-second');
                    slidersDiscover[0].classList.replace('container-discover__slider-item-four','container-discover__slider-item-second');
                    slidersDiscover[1].classList.replace('container-discover__slider-item-first','container-discover__slider-item-third');
                    slidersDiscover[1].classList.replace('container-discover__slider-item-second','container-discover__slider-item-third');
                    slidersDiscover[1].classList.replace('container-discover__slider-item-four','container-discover__slider-item-third');
                }
            })
        }
        changeImage1 = function() {
            changeImage1Replate();
            sliderIndex1++;
            if (sliderIndex1 >= 4) {
                sliderIndex1 = 0;
            }
        }
        setInterval(changeImage1,5000);
        // khi bấm vào nut right của slider
        $('.js__container-discover__slider-right').onclick = function() {
            changeImage1();
        }
        // khi bấm vào nut left của slider
        $('.js__container-discover__slider-left').onclick = function() {
            changeImage1Replate();
            sliderIndex1--;
            if (sliderIndex1 < 0) {
                sliderIndex1 = 3;
            }
        }
        $('.theloai').onclick = function(){
            $('.main_canhan').style.display="none";
            $('.main_bxh').style.display="none";
            $('.main_casi').style.display="none";
            $('.main_theloai').style.display="block";
            $('.main').style.display="none";
            $('.timkiem').style.display="none";
            $('.active').style.background="rgba(0, 0, 0, 0.5)";
            $('.canhan').style.background="rgba(0, 0, 0, 0.5)";
            $('.casi').style.background="rgba(0, 0, 0, 0.5)";
            $('.bxh').style.background="rgba(0, 0, 0, 0.5)";
            $('.theloai').style.background="purple";
        }
        $('.canhan').onclick = function(){
            $('.main_canhan').style.display="block";
            $('.main_bxh').style.display="none";
            $('.main_casi').style.display="none";
            $('.main_theloai').style.display="none";
            $('.main').style.display="none";
            $('.timkiem').style.display="none";
            $('.active').style.background="rgba(0, 0, 0, 0.5)";
            $('.canhan').style.background="purple";
            $('.casi').style.background="rgba(0, 0, 0, 0.5)";
            $('.bxh').style.background="rgba(0, 0, 0, 0.5)";
            $('.theloai').style.background="rgba(0, 0, 0, 0.5)";

        }
        $('.casi').onclick = function(){
            $('.main_canhan').style.display="none";
            $('.main_bxh').style.display="none";
            $('.main_casi').style.display="block";
            $('.main_theloai').style.display="none";
            $('.main').style.display="none";
            $('.timkiem').style.display="none";
            $('.active').style.background="rgba(0, 0, 0, 0.5)";
            $('.canhan').style.background="rgba(0, 0, 0, 0.5)";
            $('.bxh').style.background="rgba(0, 0, 0, 0.5)";
            $('.theloai').style.background="rgba(0, 0, 0, 0.5)";
            $('.casi').style.background="purple";

        }
        $('.bxh').onclick = function(){
            $('.main_canhan').style.display="none";
            $('.main_bxh').style.display="block";
            $('.main_casi').style.display="none";
            $('.main_theloai').style.display="none";
            $('.main').style.display="none";
            $('.timkiem').style.display="none";
            $('.active').style.background="rgba(0, 0, 0, 0.5)";
            $('.canhan').style.background="rgba(0, 0, 0, 0.5)";
            $('.theloai').style.background="rgba(0, 0, 0, 0.5)";
            $('.casi').style.background="rgba(0, 0, 0, 0.5)";
            $('.bxh').style.background="purple";

        }
        $('.active').onclick = function(){
            $('.main_canhan').style.display="none";
            $('.main_bxh').style.display="none";
            $('.main_casi').style.display="none";
            $('.main_theloai').style.display="none";
            $('.main').style.display="block";
            $('.timkiem').style.display="none";
            $('.active').style.background="purple";
            $('.canhan').style.background="rgba(0, 0, 0, 0.5)";
            $('.theloai').style.background="rgba(0, 0, 0, 0.5)";
            $('.casi').style.background="rgba(0, 0, 0, 0.5)";
            $('.bxh').style.background="rgba(0, 0, 0, 0.5)";
        }

//list song

