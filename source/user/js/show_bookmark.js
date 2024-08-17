const tym1=document.querySelector('.music-control__left-action-tym');
var xmlhttp11 = new XMLHttpRequest();
xmlhttp11.open("GET", "load_bookmark.php", true);
xmlhttp11.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
    var bookmarks = JSON.parse(this.responseText);
    var id_song = document.querySelector(".id_songs").innerHTML;
    var id_user = document.querySelector(".id_user").innerHTML;
    for (let i = 0; i < bookmarks.length; i++){
        if(id_song==bookmarks[i].song_id && id_user==bookmarks[i].user_id){
           tym1.style.color="#ED2B91";
           return;
        }
    }
    tym1.style.color="white";
}
}
    xmlhttp11.send();
const audio= document.getElementById("audio");
audio.addEventListener('loadedmetadata', (event)=>{
var xmlhttp11 = new XMLHttpRequest();
xmlhttp11.open("GET", "load_bookmark.php", true);
xmlhttp11.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) {
    var id_song = document.querySelector(".id_songs").innerHTML;
    var id_user = document.querySelector(".id_user").innerHTML;
    var bookmarks = JSON.parse(this.responseText);
    for (let i = 0; i < bookmarks.length; i++){
        if(id_song==bookmarks[i].song_id && id_user==bookmarks[i].user_id){
           tym1.style.color="#ED2B91";
           return;
        }
    }
    tym1.style.color="white";
}
}
xmlhttp11.send();
})