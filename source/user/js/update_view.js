function updateListenCount() {
  const time=document.querySelector('.music-control__progress-time-start');
  if (time.innerText == '00:15') {
    var xhr14 = new XMLHttpRequest();
    var id_song = document.querySelector(".id_songs").innerHTML;
    var data = 'id_song=' + id_song;
    xhr14.open('POST',"update_view.php" , true);
    xhr14.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr14.send(data);
  }
}
// Sử dụng setInterval để gọi hàm updateListenCount sau mỗi 1 giây
setInterval(function() {
  updateListenCount();
}, 1000); // Khoảng thời gian giữa các lần kiểm tra là 1 giây (1000ms)