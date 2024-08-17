const themebtn = $('.header__theme');
const themeModal = $('.theme-modal');
const themeClosebtn = $('.theme-modal__close-btn');
const themeOverlay = $('.theme-modal__overlay');
const themeBody = $('.theme-modal__body');
const themeItems = $$('.js-theme-item');
themebtn.onclick = function() {
    themeModal.classList.toggle('theme-modal--avtive'); 
}
themeBody.onclick = function(e) {
    e.stopPropagation();
}
themeClosebtn.onclick = function() {
    themeModal.classList.remove('theme-modal--avtive'); 
}
themeOverlay.onclick = function() {
    themeModal.classList.remove('theme-modal--avtive'); 
}
themeItems.forEach((themeItem, index) => {
    themeItem.onclick = function() {
        if (index == 0) {
            $('.mains').style.background = 'rgb(52,52,52)';
        }
        else if(index==1){
            $('.mains').style.background = 'radial-gradient(50% 50% at 50% 50%, #F7CBFD 0%, #7758D1 100%)';
        }
        else if(index==2){
            $('.mains').style.background = 'rgb(78,91,115)';
        }
        else if(index==3){
            $('.mains').style.background='rgb(43,100,85)'
        }
    }
})