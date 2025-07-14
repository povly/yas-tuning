<?php
// Включаем output buffering
ob_start();

if (!headers_sent()) {
    session_start();
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Получаем данные формы
  $step = (int)(isset($_POST['step']) ? $_POST['step'] : 1);
  $is_company = isset($_POST['is_company']) ? true : false;

  // Инициализируем сессию для регистрации если её нет
  if (!isset($_SESSION['registration_data'])) {
    $_SESSION['registration_data'] = [];
  }

  // Сохраняем новые данные в сессию
  foreach ($_POST as $key => $value) {
    if ($key !== 'step') {
      $_SESSION['registration_data'][$key] = $value;
    }
  }

  // Получаем все данные из сессии
  $form_data = array_merge([
    'email' => '',
    'password' => '',
    'password_repeat' => '',
    'first_name' => '',
    'last_name' => '',
    'is_company' => false,
    'company_name' => '',
    'vat_id' => '',
    'business_id' => '',
    'country' => '',
    'city' => '',
    'address' => '',
    'postal_code' => '',
  ], $_SESSION['registration_data']);

  $form_data['is_company'] = isset($form_data['is_company']);

  $errors = [];
  $field_errors = [];

  // Валидация по шагам
  if ($step == 1) {
    if (empty($form_data['email'])) {
      $field_errors['email'] = 'Email is required';
    } elseif (!filter_var($form_data['email'], FILTER_VALIDATE_EMAIL)) {
      $field_errors['email'] = 'Invalid email format';
    }

    if (empty($form_data['password'])) {
      $field_errors['password'] = 'Password is required';
    } elseif (strlen($form_data['password']) < 6) {
      $field_errors['password'] = 'Password must be at least 6 characters';
    }

    if (empty($form_data['password_repeat'])) {
      $field_errors['password_repeat'] = 'Please repeat password';
    } elseif ($form_data['password'] !== $form_data['password_repeat']) {
      $field_errors['password_repeat'] = 'Passwords do not match';
    }

    if (empty($field_errors)) {
      $step = 2; // Переходим к следующему шагу
    }
  } elseif ($step == 2) {
    if (empty($form_data['first_name'])) {
      $field_errors['first_name'] = 'First name is required';
    }

    if (empty($form_data['last_name'])) {
      $field_errors['last_name'] = 'Last name is required';
    }

    if (empty($field_errors)) {
      $step = 3; // Переходим к шагу 3
    }
  } elseif ($step == 3) {
    // Валидация финального шага
    if ($is_company) {
      if (empty($form_data['company_name'])) {
        $field_errors['company_name'] = 'Company name is required';
      }
      if (empty($form_data['vat_id'])) {
        $field_errors['vat_id'] = 'VAT ID is required';
      }
      if (empty($form_data['business_id'])) {
        $field_errors['business_id'] = 'Business ID is required';
      }
    }

    if (empty($form_data['country'])) {
      $field_errors['country'] = 'Country is required';
    }
    if (empty($form_data['city'])) {
      $field_errors['city'] = 'City is required';
    }
    if (empty($form_data['address'])) {
      $field_errors['address'] = 'Address is required';
    }
    if (empty($form_data['postal_code'])) {
      $field_errors['postal_code'] = 'Postal code is required';
    }

        if (empty($field_errors)) {
      // Финальная обработка регистрации
      // Здесь должна быть логика сохранения в БД

      // Очищаем данные регистрации из сессии после успешного завершения
      unset($_SESSION['registration_data']);

      // Успешная регистрация
      header('HX-Redirect: /');
      exit();
    }
  }

  // Определяем класс для auth__item
  $item_class = 'auth__item';
  if ($is_company && $step == 3) {
    $item_class .= ' auth__item_is-company';
  }

?>
  <div class="<?= $item_class ?>">
    <div class="auth__item-bg img_full" <?= ($is_company && $step == 3) ? 'style="display: none;"' : '' ?>>
      <picture>
        <source type="image/avif" srcset="/images/auth/form.avif">
        <source type="image/webp" srcset="/images/auth/form.webp">
        <img src="/images/auth/form.png" width="893" height="579" alt="">
      </picture>
    </div>

          <form class="auth__form" hx-post="/php/register.php" hx-swap="outerHTML" hx-target="closest .auth__item">
        <div class="auth__title">REGISTRATION</div>

        <!-- Поле для отслеживания шага -->
        <input type="hidden" name="step" value="<?= $step ?>">

      <div class="auth__steps">
        <?php if ($step == 1): ?>
          <div class="auth__step active">
            <div class="auth__inputs">
              <div class="auth__input <?= isset($field_errors['email']) ? 'error' : '' ?>">
                <label for="email" class="auth__label">
                  <span>Email*</span>
                </label>
                <input class="auth__input-field" type="email" id="email" name="email" required value="<?= htmlspecialchars($form_data['email']) ?>">
                <?php if (isset($field_errors['email'])): ?>
                  <div class="auth__message error"><?= htmlspecialchars($field_errors['email']) ?></div>
                <?php endif; ?>
              </div>
              <div class="auth__input <?= isset($field_errors['password']) ? 'error' : '' ?>">
                <label for="password" class="auth__label">
                  <span>Password*</span>
                </label>
                <input class="auth__input-field" type="password" id="password" name="password" required>
                <?php if (isset($field_errors['password'])): ?>
                  <div class="auth__message error"><?= htmlspecialchars($field_errors['password']) ?></div>
                <?php endif; ?>
              </div>
              <div class="auth__input <?= isset($field_errors['password_repeat']) ? 'error' : '' ?>">
                <label for="password-repeat" class="auth__label">
                  <span>Repeat password*</span>
                </label>
                <input class="auth__input-field" type="password" id="password-repeat" name="password_repeat" required>
                <?php if (isset($field_errors['password_repeat'])): ?>
                  <div class="auth__message error"><?= htmlspecialchars($field_errors['password_repeat']) ?></div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php elseif ($step == 2): ?>
          <div class="auth__step active">
            <div class="auth__inputs">
              <div class="auth__input <?= isset($field_errors['first_name']) ? 'error' : '' ?>">
                <label for="first-name" class="auth__label">
                  <span>First name*</span>
                </label>
                <input class="auth__input-field" type="text" id="first-name" name="first_name" required value="<?= htmlspecialchars($form_data['first_name']) ?>">
                <?php if (isset($field_errors['first_name'])): ?>
                  <div class="auth__message error"><?= htmlspecialchars($field_errors['first_name']) ?></div>
                <?php endif; ?>
              </div>
              <div class="auth__input <?= isset($field_errors['last_name']) ? 'error' : '' ?>">
                <label for="last-name" class="auth__label">
                  <span>Last name*</span>
                </label>
                <input class="auth__input-field" type="text" id="last-name" name="last_name" required value="<?= htmlspecialchars($form_data['last_name']) ?>">
                <?php if (isset($field_errors['last_name'])): ?>
                  <div class="auth__message error"><?= htmlspecialchars($field_errors['last_name']) ?></div>
                <?php endif; ?>
              </div>
              <div class="auth__input auth__input_checkbox">
                <input type="checkbox" id="is_company" name="is_company" class="auth__checkbox auth__checkbox_is-company" <?= $is_company ? 'checked' : '' ?>>
                <label for="is_company" class="auth__label auth__checkbox-label">
                  <span class="auth__checkbox-square"></span>
                  <span class="auth__checkbox-text">Is company?</span>
                </label>
              </div>
            </div>
          </div>
        <?php elseif ($step == 3): ?>
          <div class="auth__step active">
            <div class="auth__inputs">
              <?php if ($is_company): ?>
                <div class="auth__input <?= isset($field_errors['company_name']) ? 'error' : '' ?>">
                  <label for="company-name" class="auth__label">
                    <span>Company name*</span>
                  </label>
                  <input class="auth__input-field" type="text" id="company-name" name="company_name" required value="<?= htmlspecialchars($form_data['company_name']) ?>">
                  <?php if (isset($field_errors['company_name'])): ?>
                    <div class="auth__message error"><?= htmlspecialchars($field_errors['company_name']) ?></div>
                  <?php endif; ?>
                </div>
                <div class="auth__input auth__input_50 <?= isset($field_errors['vat_id']) ? 'error' : '' ?>">
                  <label for="vat-id" class="auth__label">
                    <span>VAT ID*</span>
                  </label>
                  <input class="auth__input-field" type="text" id="vat-id" name="vat_id" required value="<?= htmlspecialchars($form_data['vat_id']) ?>">
                  <?php if (isset($field_errors['vat_id'])): ?>
                    <div class="auth__message error"><?= htmlspecialchars($field_errors['vat_id']) ?></div>
                  <?php endif; ?>
                </div>
                <div class="auth__input auth__input_50 <?= isset($field_errors['business_id']) ? 'error' : '' ?>">
                  <label for="business-id" class="auth__label">
                    <span>Business ID*</span>
                  </label>
                  <input class="auth__input-field" type="text" id="business-id" name="business_id" required value="<?= htmlspecialchars($form_data['business_id']) ?>">
                  <?php if (isset($field_errors['business_id'])): ?>
                    <div class="auth__message error"><?= htmlspecialchars($field_errors['business_id']) ?></div>
                  <?php endif; ?>
                </div>
              <?php endif; ?>

              <div class="auth__input <?= isset($field_errors['country']) ? 'error' : '' ?>">
                <label for="country" class="auth__label">
                  <span>Country*</span>
                </label>
                <select class="auth__select" id="country" name="country" required>
                  <option value="">Select country</option>
                  <option value="US" <?= $form_data['country'] == 'US' ? 'selected' : '' ?>>United States</option>
                  <option value="CA" <?= $form_data['country'] == 'CA' ? 'selected' : '' ?>>Canada</option>
                  <option value="GB" <?= $form_data['country'] == 'GB' ? 'selected' : '' ?>>United Kingdom</option>
                  <option value="AU" <?= $form_data['country'] == 'AU' ? 'selected' : '' ?>>Australia</option>
                  <option value="NZ" <?= $form_data['country'] == 'NZ' ? 'selected' : '' ?>>New Zealand</option>
                </select>
                <?php if (isset($field_errors['country'])): ?>
                  <div class="auth__message error"><?= htmlspecialchars($field_errors['country']) ?></div>
                <?php endif; ?>
              </div>

              <div class="auth__input <?= isset($field_errors['city']) ? 'error' : '' ?>">
                <label for="city" class="auth__label">
                  <span>City*</span>
                </label>
                <input class="auth__input-field" type="text" id="city" name="city" required value="<?= htmlspecialchars($form_data['city']) ?>">
                <?php if (isset($field_errors['city'])): ?>
                  <div class="auth__message error"><?= htmlspecialchars($field_errors['city']) ?></div>
                <?php endif; ?>
              </div>

              <div class="auth__input <?= ($is_company ? 'auth__input_50 ' : '') . (isset($field_errors['address']) ? 'error' : '') ?>">
                <label for="address" class="auth__label">
                  <span>Address*</span>
                </label>
                <input class="auth__input-field" type="text" id="address" name="address" required value="<?= htmlspecialchars($form_data['address']) ?>">
                <?php if (isset($field_errors['address'])): ?>
                  <div class="auth__message error"><?= htmlspecialchars($field_errors['address']) ?></div>
                <?php endif; ?>
              </div>

              <div class="auth__input <?= ($is_company ? 'auth__input_50 ' : '') . (isset($field_errors['postal_code']) ? 'error' : '') ?>">
                <label for="postal-code" class="auth__label">
                  <span>Postal code*</span>
                </label>
                <input class="auth__input-field" type="text" id="postal-code" name="postal_code" required value="<?= htmlspecialchars($form_data['postal_code']) ?>">
                <?php if (isset($field_errors['postal_code'])): ?>
                  <div class="auth__message error"><?= htmlspecialchars($field_errors['postal_code']) ?></div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>

      <button class="auth__btn p-btn p-btn_orange" type="submit">
        <?= ($step == 3) ? 'Sign up' : 'Next' ?>
      </button>
    </form>
  </div>
<?php
// Отправляем буферизованный вывод
ob_end_flush();
} else {
  echo '<div class="auth__error">Invalid request method</div>';
}
?>
