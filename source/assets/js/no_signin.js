$('.music-control__right-icon2').onclick = function(){
    alert('Bạn cần đăng nhập để thêm bài hát vào playlist của mình');
}
$('.music-control__left-action-tym-box').onclick = function(){
    alert('Bạn cần đăng nhập để bookmark bài hát yêu thích');
}
$('.canhan').onclick = function(){
    alert('Bạn cần đăng nhập để xem playlist của mình');
}
const form4 = document.getElementById('input_cmt');
form4.addEventListener('submit', function(event) {
    event.preventDefault(); // Ngăn chặn việc gửi form đi
    alert('Bạn cần đăng nhập để bình luận');
})