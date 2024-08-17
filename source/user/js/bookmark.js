const tym=document.querySelector('.music-control__left-action-tym');
tym.addEventListener('click', function() {
    var id_song = document.querySelector(".id_songs").innerHTML;
    var id_user = document.querySelector(".id_user").innerHTML;
    var xmlhttp11 = new XMLHttpRequest();
    xmlhttp11.open("GET", "load_bookmark.php", true);
    xmlhttp11.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {

        var bookmarks = JSON.parse(this.responseText);
        for (let i = 0; i < bookmarks.length; i++){
            if(id_song==bookmarks[i].song_id && id_user==bookmarks[i].user_id){
                var xhr12 = new XMLHttpRequest();
                var data = 'id_user=' + id_user + '&id_song=' + id_song;
                xhr12.open('POST',"delete_bookmark.php" , true);
                xhr12.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr12.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        tym.style.color='white';
                    }
               }
               xhr12.send(data);
               return;
            }
        }
                var xhr13 = new XMLHttpRequest();
                var data = 'id_user=' + id_user + '&id_song=' + id_song;
                xhr13.open('POST',"update_bookmark.php" , true);
                xhr13.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr13.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        tym.style.color='#ED2B91';
                    }
               }
                xhr13.send(data);
            }
        }
        xmlhttp11.send();
})