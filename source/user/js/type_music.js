const mydiv1 = document.getElementById("main_theloai");
var xmlhttp3 = new XMLHttpRequest();
xmlhttp3.open("GET", "load_music_type.php", true);
xmlhttp3.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    var songs = JSON.parse(this.responseText);
    var xmlhttp4 = new XMLHttpRequest();
    xmlhttp4.open("GET", "type_music.php", true);
    xmlhttp4.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var types = JSON.parse(this.responseText);
        // sử dụng hai mảng ở đây
        for (let i = 0; i < types.length; i++) {
          mydiv1.innerHTML +=`
          <div class="singer_choose">
            <div class="tencasi"><h2>${types[i].name_type}</h2></div>
            <div id="theloainhac${types[i].id_type}"></div>
         </div>`;
          for (let j = 0; j < songs.length; j++) {
            if (songs[j].song_type_id === types[i].id_type) {
                const theloainhac=document.getElementById("theloainhac"+types[i].id_type);
              theloainhac.innerHTML += `<li class="songs-item js__song-item3">
              <div class="songs-item-left">
                  <div style="background-image: url(../${songs[j].background});" class="songs-item-left-img js__songs-item-left-img-0">
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
              <div class="id_song_type" style="display:none">${songs[j].id}</div>
          </li>`
            }
          }
          const songItems3 = document.querySelectorAll('.js__song-item3');
          const idSongss = document.querySelectorAll('.id_song_type');
          songItems3.forEach((songItem3,index) => {
              songItem3.ondblclick = function() {
               const index3 = songs.findIndex(song => song.id == idSongss[index].innerHTML);
               nameSong.textContent = songs[index3].name;
               nameSinger.textContent = songs[index3].singer;
               $('.music-control__left-img').style.backgroundImage = `url(../${songs[index3].background})`;
               $('.modal_lyric_img').style.backgroundImage = `url(../${songs[index3].background})`;
               audio.src =`../${songs[index3].pathSong}`;
               lyric_content.innerHTML =songs[index3].lyric;
               id_song_control.innerHTML =songs[index3].id;
               audio.play();
           }
       })
        }
      }
    };
    xmlhttp4.send();
  }
};
xmlhttp3.send();
