
const form1 = document.getElementById('input_cmt');
form1.addEventListener('submit', function(event) {
  event.preventDefault(); // Ngăn chặn việc gửi form đi
  const cmt= document.getElementById("nd_cmt").value;
  var id_song = document.querySelector(".id_songs").innerHTML;
  var id_user = document.querySelector(".id_user").innerHTML;
  var xhr5 = new XMLHttpRequest();
  var data = 'id_user=' + id_user + '&id_song=' + id_song+'&nd_cmt='+cmt;
  xhr5.open('POST',"update_cmt.php" , true);
  xhr5.onreadystatechange = function(){
    const khung_cmt =document.querySelector('.khung_cmt');
    khung_cmt.innerHTML=``;
    var xhr6 = new XMLHttpRequest();
    xhr6.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    var cmts = JSON.parse(this.responseText);
    var id_song = document.querySelector(".id_songs").innerHTML;
    khung_cmt.innerHTML=``;
    for (let i = 0; i < cmts.length; i++) {
        if(id_song==cmts[i].id_song){
        khung_cmt.innerHTML+=`<li class="name_cmt_avt">
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
    khung_cmt.innerHTML=``;
    modal.style.display='none';
  }
  }
  xhr5.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr5.send(data);
})