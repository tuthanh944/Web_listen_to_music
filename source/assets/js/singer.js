// file.js
const mydiv = document.getElementById("main_casi");
const durationTime = $('.js__music-control__progress-time-duration');
const nameSong = $('.music-control__left-content-song');
const nameSinger = $('.music-control__left-content-singer');
const lyric_content=$('#lyric');
const id_song_control=$('.id_songs');
var xmlhttp1 = new XMLHttpRequest();
xmlhttp1.open("GET", "user/load_music.php", true);
xmlhttp1.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    var songs = JSON.parse(this.responseText);
    var xmlhttp2 = new XMLHttpRequest();
    xmlhttp2.open("GET", "user/singer.php", true);
    xmlhttp2.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var singers = JSON.parse(this.responseText);
        // sử dụng hai mảng ở đây
        for (let i = 0; i < singers.length-5; i++) {
          mydiv.innerHTML +=`
          <div class="singer_choose">
            <div class="tencasi"><h2>${singers[i].name_singer}</h2></div>
            <div id="cacbaihat${singers[i].id_singer}"></div>
         </div>`;
         const cacbaihat=document.getElementById("cacbaihat");
          for (let j = 0; j < songs.length; j++) {
            if (songs[j].singer === singers[i].name_singer) {
                const cacbaihat=document.getElementById("cacbaihat"+singers[i].id_singer);
              cacbaihat.innerHTML += `<li class="songs-item js__song-item2">
              <div class="songs-item-left">
                  <div style="background-image: url(${songs[j].background});" class="songs-item-left-img js__songs-item-left-img-0">
                      <div class="songs-item-left-img-playing-box">
                      
                      </div>
                  </div>

                  <div class="songs-item-left-body">
                      <h3 class="songs-item-left-body-name js__main-color">${songs[j].name}</h3>
                      <span class="songs-item-left-body-singer js__sub-color">${songs[j].singer}</span>
                  </div>
              </div>
              <div class="songs-item-center tablet-hiden mobile-hiden  js__sub-color">
                  <span>${songs[j].name} (Remix)</span>
              </div>
              <div class="songs-item-right mobile-hiden ">
                  <span class="songs-item-right-duration js__sub-color">${songs[j].duration}</span>
              </div>
              <div class="id_song_singer" style="display:none">${songs[j].id}</div>
          </li>`
            }
          }
          const songItems2 = document.querySelectorAll('.js__song-item2');
          const idSongs = document.querySelectorAll('.id_song_singer');
          songItems2.forEach((songItem2,index) => {
              songItem2.ondblclick = function() {
              const index2 = songs.findIndex(song => song.id == idSongs[index].innerHTML);
               id_song_control.innerHTML=songs[index2].id;
               nameSong.textContent = songs[index2].name;
               nameSinger.textContent = songs[index2].singer;
               $('.music-control__left-img').style.backgroundImage = `url('${songs[index2].background}')`;
               $('.modal_lyric_img').style.backgroundImage = `url('${songs[index2].background}')`;
               audio.src =songs[index2].pathSong;
               lyric_content.innerHTML =songs[index2].lyric;
               audio.play();
           }
       })
        }
      }
    };
    xmlhttp2.send();
  }
};
xmlhttp1.send();
