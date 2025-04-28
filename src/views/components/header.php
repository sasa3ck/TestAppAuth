<header>
  <div class="logo"><a href="/">Мой Сайт</a></div>
  <nav>
    <?php if ($isLoggedIn): ?>
      <span>Привет, <?= htmlspecialchars($_SESSION['user']['first_name']) ?>!</span>
      <a href="logout">Выход</a>
    <?php else: ?>
      <a href="register">Регистрация</a>
      <a href="login">Вход</a>
    <?php endif; ?>
  </nav>
</header>