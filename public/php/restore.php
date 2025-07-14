<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'] ?? '';

  $general_error = '';
  $success = false;

  // Валидация email
  if (empty($email)) {
    $general_error = 'Email is required';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $general_error = 'Invalid email format';
  } else {
    // Проверка существования email (замените на вашу логику)
    $existing_emails = ['admin@example.com', 'user@example.com', 'test@test.com'];

    if (in_array($email, $existing_emails)) {
      $success = true;
      // Здесь должна быть логика отправки письма с восстановлением
    } else {
      $general_error = 'Email not found in our system';
    }
  }

  // Возвращаем форму
?>
  <?php if ($success): ?>
    <form class="auth__form">
      <div class="auth__title">Restore Reset</div>

      <div class="auth__restore">
        <div class="auth__restore-svg">
          <svg width="81" height="81" viewBox="0 0 81 81" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="0.5" y="0.5" width="80" height="80" rx="40" fill="#3BD503" />
            <path d="M57.2217 30L36.7836 50.4381C36.3696 50.852 35.8081 51.0845 35.2227 51.0845C34.6372 51.0845 34.0757 50.852 33.6617 50.4381L23 39.7764" stroke="#F5F5F5" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>
        <div class="auth__restore-text">Your password has been successfully reset</div>
      </div>

      <a href="/login.html" class="auth__btn p-btn p-btn_orange">Log in</a>
    </form>
  <?php else: ?>
    <form class="auth__form" hx-post="/build/php/restore.php" hx-swap="outerHTML">
      <div class="auth__title">Restore password</div>
      <div class="auth__subtitle">Enter your email to restore password</div>

      <div class="auth__inputs">
        <div class="auth__input <?= $general_error ? 'error' : '' ?>">
          <label for="email" class="auth__label">
            <span>Email*</span>
          </label>
          <input class="auth__input-field" type="email" id="email" name="email" required data-field="email" value="<?= htmlspecialchars($email) ?>">
          <?php if ($general_error): ?>
            <div class="auth__message error"><?= htmlspecialchars($general_error) ?></div>
          <?php endif; ?>
        </div>
      </div>

      <button class="auth__btn p-btn p-btn_orange" type="submit">Restore password</button>
    </form>
  <?php endif; ?>
<?php
} else {
  echo '<div class="auth__error">Invalid request method</div>';
}
?>
