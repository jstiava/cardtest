let lastKnownScrollPosition = 0;
let ticking = true;

console.log('')

function triggerScrollMenu() {
     document.getElementById('scroll-menu').style.display = 'flex';
}
function hideScrollMenu() {
     document.getElementById('scroll-menu').style.display = 'none';
}

document.addEventListener('scroll', (e) => {
     scrollPosition = window.scrollY;

     if (ticking == true && scrollPosition > 300) {
          triggerScrollMenu();
          ticking = false;
     }
     else if (ticking == false && scrollPosition < 300) {
          hideScrollMenu();
          ticking = true;
     }
});
