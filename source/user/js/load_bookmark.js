const bookmark_canhan=document.querySelector('.show_bookmark');
var xmlhttp18 = new XMLHttpRequest();
xmlhttp18.open("GET", "load_music_type.php", true);
xmlhttp18.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    var songs = JSON.parse(this.responseText);
    var xmlhttp19 = new XMLHttpRequest();
    xmlhttp19.open("GET", "load_bookmark.php", true);
    xmlhttp19.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var bookmarks = JSON.parse(this.responseText);
        // sử dụng hai mảng ở đây
        var id_user = document.querySelector(".id_user").innerHTML;
        for (let i = 0; i < bookmarks.length; i++) {
            if(bookmarks[i].user_id==id_user){
                for (let j = 0; j < songs.length; j++) {
                    if (songs[j].id == bookmarks[i].song_id) {
                        bookmark_canhan.innerHTML += `<li class="songs-item js__song-item6">
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
                      <div class="id_song_bookmark" style="display:none">${songs[j].id}</div>
                  </li>`
                    }
                    const songItems6 = document.querySelectorAll('.js__song-item6');
                    const idSongsss = document.querySelectorAll('.id_song_bookmark');
                    songItems6.forEach((songItem6,index) => {
                        songItem6.ondblclick = function() {
                        const index6 = songs.findIndex(song => song.id == idSongsss[index].innerHTML);
                        nameSong.textContent = songs[index6].name;
                        nameSinger.textContent = songs[index6].singer;
                        $('.music-control__left-img').style.backgroundImage = `url(../${songs[index6].background})`;
                        $('.modal_lyric_img').style.backgroundImage = `url(../${songs[index6].background})`;
                        audio.src =`../${songs[index6].pathSong}`;
                        lyric_content.innerHTML =songs[index6].lyric;
                        id_song_control.innerHTML =songs[index6].id;
                        audio.play();
                    }
                })
            }
          }
        }
      }
    };
    xmlhttp19.send();
  }
};
xmlhttp18.send();
