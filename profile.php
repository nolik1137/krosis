<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location:index.php');
    exit;
}

require_once 'reg/connect.php';
$uid = mysqli_real_escape_string($connect, $_SESSION['user']['id']);
$res = mysqli_query($connect, "SELECT * FROM `users` WHERE `id`='$uid'");
$userData = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GameStore — профиль</title>
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;800&display=swap" rel="stylesheet">
  <style>

    #editProfileOverlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 9999;
      align-items: center;
      justify-content: center;
    }
    #editProfileForm {
      position: relative;
      top: auto;
      left: auto;
      transform: none;
      background-color: #fff;
      padding: 1.5rem;
      width: 360px;
      max-width: 90vw;
      max-height: 90vh;
      overflow-y: auto;
      border-radius: 8px;
      box-sizing: border-box;
    }
    #editProfileForm .form-input input {
      font-size: 15px;
      padding: 8px 10px;
    }
    header {
      flex-wrap: wrap;
      gap: 12px;
    }
    .header-center {
      display: flex;
      align-items: center;
      gap: 14px;
    }
  </style>
</head>
<body>
  <header>
    <div class="site-icon">
      <a href="index.php"><img src="Сайт значки/Гл.png" alt=""></a>
    </div>
    <div class="header-center">
      <div class="search-container">
        <input type="text" id="searchInput" placeholder="Я ищу..." />
        <button id="searchBtn" class="search-icon-button" type="button" title="Поиск">
          <img src="Сайт значки/search.png" alt="Поиск">
        </button>
      </div>
      <div class="header-icons">
        <button id="favBtn" class="icon-button" type="button" title="Избранное">
          <img src="Сайт значки/heart.png" alt="Избранное">
          <span class="icon-badge">0</span>
        </button>
        <button id="cartBtn" class="icon-button" type="button" title="Корзина">
          <img src="Сайт значки/shopping-bag.png" alt="Корзина">
          <span class="icon-badge">0</span>
        </button>
      </div>
    </div>
    <div class="auth-container">
        <div class="profile_log">
            <a href="profile.php"><img src="<?= htmlspecialchars($_SESSION['user']['avatar']) ?>" width="45px" height="45" alt=""></a>
        </div>
        <div class="auth-links">
            <button id="editProfileLink" class="link-button" type="button">Редактировать профиль</button>
            <form action="logout.php" class="logout-form">
                <button style="height: 45px;" class="login-link" type="submit">Выход</button>
            </form>
        </div>
    </div>
  </header>

  <div id="editProfileOverlay" style="display:none;">
    <div id="editProfileForm">
        <img class="current-avatar" src="<?= htmlspecialchars($userData['avatar']) ?>" width="80" height="80" alt="Аватар">
        <h3>Редактирование профиля</h3>
        <form action="reg/edit.php" method="POST" enctype="multipart/form-data">
            <div class="form-input">
                <input title="Только кириллица." required pattern="^[А-Яа-яЁё\s]+$" type="text" name="full_name" placeholder="Имя" value="<?= htmlspecialchars($userData['full_name']) ?>">
            </div>
            <div class="form-input">
                <input type="text" name="login" placeholder="Логин" value="<?= htmlspecialchars($userData['login']) ?>">
            </div>
            <div class="form-input">
                <input required title="Ваш номер телефона" pattern="[0-9]{9,12}" type="text" name="phone" placeholder="Номер телефона" value="<?= htmlspecialchars($userData['phone']) ?>">
            </div>
            <div class="form-input">
                <input title="Только Латиница" pattern="([A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8})" placeholder="mail@example.com" name="email" type="text" value="<?= htmlspecialchars($userData['email']) ?>">
            </div>
            <div class="form-input">
                <input type="password" title="Не менее шести латинских букв и три цифры" name="password" placeholder="Новый пароль (необязательно)">
            </div>
            <div class="form-input">
                <input name="avatar" type="file">
            </div>
            <div class="form-buttons">
                <button type="button" id="editProfileClose" class="btn btn-default">Отмена</button>
                <button type="submit" name="submit" class="btn btn-default custom-button">Сохранить</button>
            </div>
            <?php if (isset($_SESSION['message'])): ?>
                <p class="msg"><?= htmlspecialchars($_SESSION['message']) ?></p>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
        </form>
    </div>
  </div>

  <nav>
    <ul class="menu">
      <li><a href="/index.php?C=6"><img src="Сайт значки/Меню.png" alt="Каталог" width="24" height="24"></a></li>
      <li><a href="/index.php?C=1">Новинки</a></li>
      <li><a href="/index.php?C=2">Хиты продаж</a></li>
      <li><a href="/index.php?C=3">PC</a></li>
      <li><a href="/index.php?C=4">PlayStation</a></li>
      <li><a href="/index.php?C=5">Xbox / Nintendo</a></li>
    </ul>
  </nav>

  <main>
    <div id="container">
        <div id="objects">
            <?php
              $C = isset($_GET["C"]) ? $_GET["C"] : "";
              switch ($C) {
                case "1": echo(file_get_contents("objects1.html")); break;
                case "2": echo(file_get_contents("objects2.html")); break;
                case "3": echo(file_get_contents("objects3.html")); break;
                case "4": echo(file_get_contents("objects4.html")); break;
                case "5": echo(file_get_contents("objects5.html")); break;
                case "6": echo(file_get_contents("objects6.html")); break;
              }
            ?>
        </div>
        <div id="content" class="content">
            <?php
              $O = isset($_GET["O"]) ? $_GET["O"] : "";
              switch ($O) {
                case "1-1": echo(file_get_contents("object1-1.html")); break;
                case "1-2": echo(file_get_contents('object1-2.html')); break;
                case "1-3": echo(file_get_contents('object1-3.html')); break;
              }
            ?>
        </div>
    </div>
  </main>

  <footer>
    <span>© GameStore 2026</span>
    <div class="social-links">
      Мы в социальных сетях:
      <a href="#">
        <img src="Сайт значки/youtube.png" alt="Social Icon">
        YouTube
      </a>
      <a href="#">
        <img src="Сайт значки/twitter.png" alt="Social Icon">
        Twitter
      </a>
      <a href="#">
        <img src="Сайт значки/facebook.png" alt="Social Icon">
        Facebook
      </a>
    </div>
  </footer>

  <script src="java/java.js"></script>
  <?php if (isset($_SESSION['_just_edited'])): unset($_SESSION['_just_edited']); ?>
  <script>
    document.getElementById('editProfileOverlay').style.display = 'flex';
  </script>
  <?php endif; ?>
</body>
</html>
