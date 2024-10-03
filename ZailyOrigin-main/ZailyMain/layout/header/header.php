<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header class="header">
  <div class="header__content">
    <div class="header__logo-container">
      <span class="header__logo-sub">CicloTrack</span>
    </div>
    <div class="header__main">
      <ul class="header__links">
        <li class="header__link-wrapper">
          <a href="index.php" class="header__link"> Inicio </a>
        </li>
        <li class="header__link-wrapper">
          <a href="rotasTeste.php" class="header__link"> Rotas </a>
        </li>
        <li class="header__link-wrapper">
          <a href="oficinas.php" class="header__link"> Oficinas </a>
        </li>
        <li class="header__link-wrapper">
          <?php
          // Verifica se o usuário está logado
          if (isset($_SESSION['nmUsuario'])) {
              // Se logado, mostra "Olá, nome"
              echo '<div class="dropdown">';
              echo '<a href="#" class="header__link dropdown-toggle" onclick="toggleDropdown()">Olá, ' . htmlspecialchars($_SESSION['nmUsuario']) . '</a>';
              echo '<div class="dropdown-menu" id="dropdownMenu">';
              echo '<a href="logout.php" class="dropdown-item">Sair</a>';
              echo '</div></div>';
          } else {
              // Se não logado, mostra "Minha conta"
              echo '<a href="./ZailyMain/cadastro.php" id="minhaContaBtn" class="header__link">Minha conta</a>';
          }
          ?>
        </li>
      </ul>
      <div class="header__main-ham-menu-cont">
        <img
          src="./assets/img/svg/ham-menu.svg"
          alt="hamburger menu"
          class="header__main-ham-menu" />
      </div>
    </div>
  </div>
  <div class="header__sm-menu">
    <div class="header__sm-menu-content">
      <ul class="header__sm-menu-links">
        <li class="header__sm-menu-link">
          <a href="index.php"> Inicio </a>
        </li>
        <li class="header__sm-menu-link">
          <a href="rotasTeste.php"> Rotas </a>
        </li>
        <li class="header__sm-menu-link">
          <a href="oficinas.php"> Oficinas </a>
        </li>
        <li class="header__sm-menu-link">
          <?php
          // Verifica se o usuário está logado
          if (isset($_SESSION['nmUsuario'])) {
              echo '<a href="#"> Olá, ' . htmlspecialchars($_SESSION['nmUsuario']) . '</a>';
          } else {
              echo '<a href="usuarioLog.php"> Olá, visitante </a>';
          }
          ?>
        </li>
      </ul>
    </div>
  </div>
  <div id="sidebar" class="sidebar">
    <a href="#" class="closebtn" id="closeSidebar">&times;</a>
    <a href="login.php">Fazer login</a>
    <a href="cadastro.php">Cadastre-se</a>
    <a href="#" id="sairBtn">Sair</a>
  </div>
</header>

<script src="../../assets/js/index.js"></script>

<script>
  function toggleDropdown() {
    const dropdownMenu = document.getElementById("dropdownMenu");
    dropdownMenu.style.display = dropdownMenu.style.display === "block" ? "none" : "block";
  }

  // Para fechar o menu ao clicar fora
  window.onclick = function(event) {
    if (!event.target.matches('.dropdown-toggle')) {
      const dropdowns = document.getElementsByClassName("dropdown-menu");
      for (let i = 0; i < dropdowns.length; i++) {
        const openDropdown = dropdowns[i];
        if (openDropdown.style.display === "block") {
          openDropdown.style.display = "none";
        }
      }
    }
  }
</script>

<style>
  .dropdown {
    position: relative;
    display: inline-block;
  }

  .dropdown-menu {
    display: none;
    position: absolute;
    background-color: white;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
  }

  .dropdown-item {
    padding: 10px 15px;
    text-decoration: none;
    display: block;
    color: black;
  }

  .dropdown-item:hover {
    background-color: #f1f1f1;
  }
</style>
