const hamMenuBtn = document.querySelector('.header__main-ham-menu-cont')
const smallMenu = document.querySelector('.header__sm-menu')
const headerHamMenuBtn = document.querySelector('.header__main-ham-menu')
const headerHamMenuCloseBtn = document.querySelector(
  '.header__main-ham-menu-close'
)
const headerSmallMenuLinks = document.querySelectorAll('.header__sm-menu-link')
 
hamMenuBtn.addEventListener('click', () => {
  if (smallMenu.classList.contains('header__sm-menu--active')) {
    smallMenu.classList.remove('header__sm-menu--active')
  } else {
    smallMenu.classList.add('header__sm-menu--active')
  }
  if (headerHamMenuBtn.classList.contains('d-none')) {
    headerHamMenuBtn.classList.remove('d-none')
    headerHamMenuCloseBtn.classList.add('d-none')
  } else {
    headerHamMenuBtn.classList.add('d-none')
    headerHamMenuCloseBtn.classList.remove('d-none')
  }
})
 
for (let i = 0; i < headerSmallMenuLinks.length; i++) {
  headerSmallMenuLinks[i].addEventListener('click', () => {
    smallMenu.classList.remove('header__sm-menu--active')
    headerHamMenuBtn.classList.remove('d-none')
    headerHamMenuCloseBtn.classList.add('d-none')
  })
}
 
//---
const headerLogoConatiner = document.querySelector('.header__logo-container')
 
headerLogoConatiner.addEventListener('click', () => {
  location.href = 'index.html'
})
 
/* TELA DE CARREGAMENTO */
// let elem_preloading = document.getElementById("preloading");
// let elem_loading = document.getElementById("loading");
// console.log(" Ok");
 
// setTimeout(function() {
//     elem_preloading.classList.remove("preloading");
//     elem_loading.classList.remove("loading");
//     }, 1280);
 
  /* ABA LATERAL */
  // Selecionar os elementos da aba lateral e o botão "Minha conta"
const minhaContaBtn = document.getElementById('minhaContaBtn');
const sidebar = document.getElementById('sidebar');
const closeSidebar = document.getElementById('closeSidebar');
const sairBtn = document.getElementById('sairBtn');
 
// Abrir a aba lateral ao clicar em "Minha conta"
minhaContaBtn.addEventListener('click', function(event) {
  event.preventDefault();
  sidebar.classList.add('open');
});
 
// Fechar a aba lateral ao clicar no botão de fechar
closeSidebar.addEventListener('click', function() {
  sidebar.classList.remove('open');
});
 
// Fechar a aba lateral ao clicar fora dela (opcional)
window.addEventListener('click', function(event) {
  if (event.target === sidebar) {
    sidebar.classList.remove('open');
  }
});
 
// Ação de logout (sair)
sairBtn.addEventListener('click', function(event) {
  event.preventDefault();
  // Aqui você pode adicionar a lógica para deslogar o usuário
  console.log('Usuário deslogado');
});