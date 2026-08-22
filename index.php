<?php
session_start();
?>


<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GameStore — магазин видеоигр</title>
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;800&display=swap" rel="stylesheet">
  <style>
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
          <span class="icon-badge">11</span>
        </button>
        <button id="cartBtn" class="icon-button" type="button" title="Корзина">
          <img src="Сайт значки/shopping-bag.png" alt="Корзина">
          <span class="icon-badge">2</span>
        </button>
      </div>
    </div>
    <?php if (isset($_SESSION['user'])): ?>
    
    <div class="profile_log">
        <a href="profile.php">
            <img src="<?= htmlspecialchars($_SESSION['user']['avatar']) ?>" width="45" height="45" alt="Аватар">
        </a>
    </div>

<?php else: ?>
    
    <div class="auth-links">
        
        
        <button id="registerLink" class="link-button">Регистрация</button>
        <div id="registrationFormOverlay">
            <div id="registrationForm">
                <form action="reg/signup.php" name="main-form" id="main-form" method="POST" enctype="multipart/form-data">
                    <div class="form-input">
                        <input title="Только кириллица." required pattern="^[А-Яа-яЁё\s]+$" type="text" name="full_name" placeholder="Имя" id="name" class="form-control">
                    </div>
                    <div class="form-input">
                        <input type="password" title="Не менее шести латинских букв и три цифры" name="password" placeholder="Пароль" id="pass">
                    </div>
                    <div class="form-input">
                        <input name="login" type="text" value="" placeholder="Логин" id="login">
                    </div>
                    <div class="form-input">
                        <input required title="Ваш номер телефона" pattern="[0-9]{9,12}" type="text" name="phone" placeholder="Номер телефона" id="phone">
                    </div>
                    <div class="form-input">
                        <input title="Только Латиница" pattern="([A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8})" placeholder="mail@example.com" name="email" id="email" type="text">
                    </div>
                    <div class="form-input">
                        <input name="avatar" type="file" value="" id="avatar">
                    </div>
                    <div class="form-input" id="text-consent">
                        Согласие на обработку персональных данных:
                        <input type="checkbox" name="terms" checked>
                    </div>
                    
                    <div class="form-input">
                        <span id="error" style="color:red"></span>
                        <button type="submit" name="submit" class="btn btn-default custom-button">Зарегистрироваться</button>
                        
                        <?php if (isset($_SESSION['message'])): ?>
                            <p class="msg"><?= htmlspecialchars($_SESSION['message']) ?></p>
                            <?php unset($_SESSION['message']); ?>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        
        <button class="loginLink" id="loginLink" type="button">Вход</button>
        <div id="loginFormOverlay" class="loginFormOverlay">
            <div id="loginForm" class="loginForm">
                <form action="reg/signin.php" method="POST">
                    <h3 class="text-center">Вход</h3>  
                    <div class="form-group">
                        <input class="login-name" type="text" name="login" maxlength="15" minlength="4" pattern="^[a-zA-Z0-9_.-]*$" id="username" placeholder="Логин" required>
                    </div>
                    <div class="form-group">
                        <input class="login-password" type="password" name="password" minlength="6" id="password" placeholder="Пароль" required>
                    </div>
                    <div class="form-group">
                        <button class="button-login" type="submit">Вход в аккаунт</button>
                    </div>
                </form>
            </div>
        </div>

    </div> 
<?php endif; ?>

  </header>

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
    
    <div id="container" >
        <div id="objects">
           <?php
  $C = isset($_GET["C"]) ? $_GET["C"] : ""; 
  
  switch($C){
    case "1": echo(file_get_contents("objects1.html"));break;
    case "2": echo(file_get_contents("objects2.html"));break;
    case "3": echo(file_get_contents("objects3.html"));break;
    case "4": echo(file_get_contents("objects4.html"));break;
    case "5": echo(file_get_contents("objects5.html"));break;
    case "6": echo(file_get_contents("objects6.html"));break;
  }
?>

      </div>
      <div id="content" class="content">
            <?php
  $O = isset($_GET["O"]) ? $_GET["O"] : "";

  switch($O){
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
</body>
</html>
