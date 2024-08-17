
const form3 = document.getElementById('xembinhluan');
form3.addEventListener('submit', function(event) {
    const cmt =document.querySelector('.khung_cmt');
    event.preventDefault(); // Ngăn chặn việc gửi form đi
    var xhr6 = new XMLHttpRequest();
    xhr6.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    var cmts = JSON.parse(this.responseText);
    var id_song = document.querySelector(".id_songs").innerHTML;
    for (let i = 0; i < cmts.length; i++) {
        if(id_song==cmts[i].id_song){
        cmt.innerHTML+=`<li class="name_cmt_avt">
        <div class="avtacc" style="background-image: url(../uploads/user-images/${cmts[i].avatar});"></div>
        <div class="name_cmt">
          <div class="name">${cmts[i].username}</div>
          <div id="cmt_db">${cmts[i].content}</div>
        </div>
      </li>`
        }
    }
}
}
  xhr6.open('POST',"load_arraycmt.php" , true);
  xhr6.send();
  const closeModalBtn2 = document.getElementsByClassName("close")[0];
  const modal = document.getElementById("modal");
  form3.style.display='none';
  closeModalBtn2.onclick=function(){
    form3.style.display='block';
    cmt.innerHTML=``;
    modal.style.display='none';
  }
})
