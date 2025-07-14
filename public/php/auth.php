<?php
// Включаем output buffering
ob_start();

if (!headers_sent()) {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';

  $errors = [];
  $field_errors = [];

  // Проверка учетных данных (замените на вашу логику)
  $valid_email = 'admin@example.com';
  $valid_password = 'password123';

  $general_error = '';

  if (empty($field_errors)) {
    if ($email === $valid_email && $password === $valid_password) {
      // Редирект через HTMX заголовок
      header('HX-Redirect: /');
      exit();
    } else {
      $general_error = 'Password or email is incorrect';
    }
  }

  // Возвращаем всю форму с ошибками
?>
  <form class="auth__form" hx-post="/php/auth.php" hx-swap="outerHTML">
    <div class="auth__title">Log in</div>
    <div class="auth__subtitle">Don't have an account? <a href="#!">Sign up</a></div>

    <div class="auth__inputs">
      <div class="auth__input <?= $general_error ? 'error' : '' ?>">
        <label for="email" class="auth__label">
          <span>Email*</span>
          <a href="#!">Forgot password?</a>
        </label>
        <input class="auth__input-field" type="email" id="email" name="email" required data-field="email" value="<?= htmlspecialchars($email) ?>">
      </div>
      <div class="auth__input <?= $general_error ? 'error' : '' ?>">
        <label for="password" class="auth__label">
          <span>Password*</span>
        </label>
        <input class="auth__input-field" type="password" id="password" name="password" required data-field="password">
        <?php if ($general_error): ?>
          <div class="auth__message error"><?php echo htmlspecialchars($general_error) ?></div>
        <?php endif; ?>
      </div>
    </div>
    <button class="auth__btn p-btn p-btn_orange" type="submit">Log in</button>
  </form>
<?php
// Отправляем буферизованный вывод
ob_end_flush();
} else {
  echo '<div class="auth__error">Invalid request method</div>';
}
?>
