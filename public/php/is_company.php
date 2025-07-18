<?php
$is_company = isset($_GET['is_company']) ? $_GET['is_company'] : '';
?>
<?php if ($is_company): ?>
  <div class="user__inputs">
    <div class="user__input">
      <div class="user__input-label">Company name</div>
      <div class="user__input-el">
        <input type="text" name="copmany_name" value="" required="">
      </div>
    </div>
    <div class="user__input">
      <div class="user__input-label">Company ID</div>
      <div class="user__input-el">
        <input type="tel" name="Company ID" value="" required="">
      </div>
    </div>
    <div class="user__input">
      <div class="user__input-label">Company address</div>
      <div class="user__input-el">
        <input type="text" name="company-address" value="" required="">
      </div>
    </div>
    <div class="user__input">
      <div class="user__input-label">Vat</div>
      <div class="user__input-el">
        <input type="text" name="vat" value="" required="">
      </div>
    </div>
  </div>
<?php endif; ?>
