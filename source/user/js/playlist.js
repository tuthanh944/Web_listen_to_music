const addplaylist= document.querySelector('.music-control__right-icon2');
addplaylist.addEventListener("click", function(){
    var id_song = document.querySelector(".id_songs").innerHTML;
    var id_user = document.querySelector(".id_user").innerHTML;
    var xmlhttp10 = new XMLHttpRequest();
    xmlhttp10.open("GET", "load_playlist.php", true);
    xmlhttp10.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var playlists1 = JSON.parse(this.responseText);
        for (let i = 0; i < playlists1.length; i++){
            if(id_song==playlists1[i].song_id && id_user==playlists1[i].user_id){
                alert("Bài hát đã có trong playlist của bạn");
                return;
             }
        }
                alert("Bài hát đã được thêm vào playlist của bạn");
                var xhr7 = new XMLHttpRequest();
                var data = 'id_user=' + id_user + '&id_song=' + id_song;
                xhr7.open('POST',"add_playlist.php" , true);
                xhr7.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr7.send(data);
                const playlist=document.querySelector('.playlist');
                playlist.innerHTML=``;
                var xmlhttp8 = new XMLHttpRequest();
                xmlhttp8.open("GET", "load_music_type.php", true);
                xmlhttp8.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var songs = JSON.parse(this.responseText);
                    var xmlhttp9 = new XMLHttpRequest();
                    xmlhttp9.open("GET", "load_playlist.php", true);
                    xmlhttp9.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var playlists = JSON.parse(this.responseText);
                        // sử dụng hai mảng ở đây
                        var id_user = document.querySelector(".id_user").innerHTML;
                        for (let i = 0; i < playlists.length; i++) {
                            if(playlists[i].user_id==id_user){
                                for (let j = 0; j < songs.length; j++) {
                                    if (songs[j].id === playlists[i].song_id) {
                                    playlist.innerHTML += `<li class="songs-item js__song-item4">
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
                                        <div class="delete_playlist" style="color: white; display: none"> <i class="fas fa-multiply"></i></div>
                                    </div>
                                    <div class="id_song_playlist" style="display:none">${songs[j].id}</div>
                                </li>`
                                    }
                            }
                        }
                        const songItems4 = document.querySelectorAll('.js__song-item4');
                        const idSongsss = document.querySelectorAll('.id_song_playlist');
                        songItems4.forEach((songItem4,index) => {
                            songItem4.ondblclick = function() {
                            const index4 = songs.findIndex(song => song.id == idSongsss[index].innerHTML);
                            nameSong.textContent = songs[index4].name;
                            nameSinger.textContent = songs[index4].singer;
                            $('.music-control__left-img').style.backgroundImage = `url(../${songs[index4].background})`;
                            $('.modal_lyric_img').style.backgroundImage = `url(../${songs[index4].background})`;
                            audio.src =`../${songs[index4].pathSong}`;
                            lyric_content.innerHTML =songs[index4].lyric;
                            id_song_control.innerHTML =songs[index4].id;
                            audio.play();
                        }
                    })
                    const delete_playlists =document.querySelectorAll('.delete_playlist');
                    delete_playlists.forEach((delete_playlist,i) => {
                    delete_playlist.onclick =function(){
                        var id_song = idSongsss[i].innerHTML;
                        var data = 'id_user=' + id_user + '&id_song=' + id_song;
                        var xmlhttp17 = new XMLHttpRequest();
                        xmlhttp17.open("POST", "delete_playlist.php", true);
                        xmlhttp17.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xmlhttp17.send(data);
                        songItems4[i].style.display='none';
                    }
                })
                        }
                    }
                    };
                    xmlhttp9.send();
                }
                }
                xmlhttp8.send();
                }
            }
            xmlhttp10.send()
    

})