var xmlhttp15 = new XMLHttpRequest();
xmlhttp15.open("GET", "load_bxh.php", true);
xmlhttp15.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    var bxhs = JSON.parse(this.responseText);
    const bxh= document.querySelector('.list_bxh');
    for (let i = 0; i < bxhs.length; i++) {
            bxh.innerHTML += `<li class="songs-item js__song-item5">
            <div class="songs-item-left">
            <span class="number-top-1 top_${i+1}">${i+1}</span>
                <div style="background-image: url(../${bxhs[i].background});" class="songs-item-left-img js__songs-item-left-img-0">
                    <div class="songs-item-left-img-playing-box">
                    
                    </div>
                </div>

                <div class="songs-item-left-body">
                    <h3 class="songs-item-left-body-name js__main-color">${bxhs[i].name}</h3>
                    <span class="songs-item-left-body-singer js__sub-color">${bxhs[i].singer}</span>
                </div>
            </div>
            <div class="songs-item-center tablet-hiden mobile-hiden  js__sub-color">
                <span>${bxhs[i].name} (Remix)</span>
            </div>
            <div class="luotnghe">Lượt nghe:${bxhs[i].luotnghe}</div>
            <div class="id_song_bxh" style="display:none">${bxhs[i].id}</div>
        </li>`
        }
      const songItems5 = document.querySelectorAll('.js__song-item5');
      const idSongssss = document.querySelectorAll('.id_song_bxh');
      songItems5.forEach((songItem5,index) => {
          songItem5.ondblclick = function() {
           const index5 = bxhs.findIndex(song => song.id == idSongssss[index].innerHTML);
           nameSong.textContent = bxhs[index5].name;
           nameSinger.textContent = bxhs[index5].singer;
           $('.music-control__left-img').style.backgroundImage = `url(../${bxhs[index5].background})`;
           $('.modal_lyric_img').style.backgroundImage = `url(../${bxhs[index5].background})`;
           audio.src =`../${bxhs[index5].pathSong}`;
           lyric_content.innerHTML =bxhs[index5].lyric;
           id_song_control.innerHTML =bxhs[index5].id;
           audio.play();
       }
    })
   }
}
xmlhttp15.send();
