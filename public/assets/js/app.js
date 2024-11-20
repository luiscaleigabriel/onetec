/**
 * Efeito scroll menu
 */
const header = document.getElementById('header');
window.addEventListener('scroll', () => {
  if (window.scrollY >= 50) {
    header.classList.add('header-fixed');
  }else {
    header.classList.remove('header-fixed');
  }
});



/**
 * Menu mobile
 */
function navBar() {
  const navbar = document.getElementById('navbar');
  const header = document.getElementById('header');

  if (navbar.classList.contains('openbar')) {
    navbar.classList.remove('openbar');
    header.classList.remove('header-bar');
  }else {
    navbar.classList.add('openbar');
    header.classList.add('header-bar');
  }
}

/*=============== SHOW MENU DROP ===============*/

function showMenu() {
  const nav = document.getElementById('user-paine');

  if(!nav.classList.contains('show-menu')) {
    nav.classList.add('show-menu');
  }else {
    nav.classList.remove('show-menu');
  }
}
