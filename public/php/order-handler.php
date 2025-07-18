<?php
header('Content-Type: text/html; charset=utf-8');
?>
<form class="user__order" hx-post="/php/order-handler-end.php" hx-trigger="submit" hx-target="#order-modal-container" hx-swap="innerHTML" hx-encoding='multipart/form-data' hx-validate="true">
  <div class="user__order-top">
    <div class="user__order-left">
      <div class="user__breadcrumbs"><a href="#!">Orders</a><span class="separator">/</span><span class="current">New order</span></div>
      <div class="user__title">New order</div>
    </div>
    <div class="user__order-right">
      <div class="user__stats">
        <div class="user__stat">Load: <span class="color_yellow">average</span></div>
        <div class="user__stat">Balance: 317 YT</div>
      </div>
    </div>
  </div>
  <div class="user__order-main">
    <div class="user__order-main-left">
      <div class="user__inputs">
        <div class="user__input">
          <div class="user__input-label">Vehicle Type</div>
          <div class="user__input-el">
            <input type="text" name="vehicle-type" value="" required="" hx-post="/build/php/order-handler.php" hx-trigger="input changed delay:500ms" hx-target="#user__order" hx-swap="outerHTML" hx-include="[name='vehicle-type'],[name='manufactured'],[name='vehicle-model'],[name='engine'],[name='ecu-type']">
          </div>
        </div>
        <div class="user__input">
          <div class="user__input-label">Manufactured</div>
          <div class="user__input-el">
            <input type="text" name="manufactured" value="" required="" hx-post="/build/php/order-handler.php" hx-trigger="input changed delay:500ms" hx-target="#user__order" hx-swap="outerHTML" hx-include="[name='vehicle-type'],[name='manufactured'],[name='vehicle-model'],[name='engine'],[name='ecu-type']">
          </div>
        </div>
        <div class="user__input">
          <div class="user__input-label">Model</div>
          <div class="user__input-el">
            <input type="text" name="vehicle-model" value="" required="" hx-post="/build/php/order-handler.php" hx-trigger="input changed delay:500ms" hx-target="#user__order" hx-swap="outerHTML" hx-include="[name='vehicle-type'],[name='manufactured'],[name='vehicle-model'],[name='engine'],[name='ecu-type']">
          </div>
        </div>
        <div class="user__input">
          <div class="user__input-label">Engine</div>
          <div class="user__input-el">
            <input type="text" name="engine" value="" required="" hx-post="/build/php/order-handler.php" hx-trigger="input changed delay:500ms" hx-target="#user__order" hx-swap="outerHTML" hx-include="[name='vehicle-type'],[name='manufactured'],[name='vehicle-model'],[name='engine'],[name='ecu-type']">
          </div>
        </div>
        <div class="user__input">
          <div class="user__input-label">Ecu Type</div>
          <div class="user__input-el">
            <input type="text" name="ecu-type" value="" required="" hx-post="/build/php/order-handler.php" hx-trigger="input changed delay:500ms" hx-target="#user__order" hx-swap="outerHTML" hx-include="[name='vehicle-type'],[name='manufactured'],[name='vehicle-model'],[name='engine'],[name='ecu-type']">
          </div>
        </div>
      </div>
    </div>
    <div class="user__order-main-right">
      <div class="user__checkboxes">
        <div class="user__checkbox">
          <input type="checkbox" name="dpf-fap" id="dpf-fap">
          <label class="user__checkbox-label" for="dpf-fap">
            <div class="user__checkbox-square"></div>
            <div class="user__checkbox-title">DPF/FAP Delete&nbsp;(150 YT)</div>
          </label>
        </div>
        <div class="user__checkbox">
          <input type="checkbox" name="scr-adblue" id="scr-adblue">
          <label class="user__checkbox-label" for="scr-adblue">
            <div class="user__checkbox-square"></div>
            <div class="user__checkbox-title">SCR/AdBlue OFF&nbsp;(240 YT)</div>
          </label>
        </div>
        <div class="user__checkbox">
          <input type="checkbox" name="dtc-selectivity" id="dtc-selectivity">
          <label class="user__checkbox-label" for="dtc-selectivity">
            <div class="user__checkbox-square"></div>
            <div class="user__checkbox-title">DTC's selectivity OFF&nbsp;(80 YT)</div>
          </label>
        </div>
        <div class="user__checkbox">
          <input type="checkbox" name="egr-agr" id="egr-agr">
          <label class="user__checkbox-label" for="egr-agr">
            <div class="user__checkbox-square"></div>
            <div class="user__checkbox-title">EGR/AGR Removal&nbsp;(105 YT)</div>
          </label>
        </div>
        <div class="user__checkbox">
          <input type="checkbox" name="checksumm-correction" id="checksumm-correction">
          <label class="user__checkbox-label" for="checksumm-correction">
            <div class="user__checkbox-square"></div>
            <div class="user__checkbox-title">Checksumm correction&nbsp;(80 YT)</div>
          </label>
        </div>
        <div class="user__checkbox">
          <input type="checkbox" name="stage-1-tuning" id="stage-1-tuning">
          <label class="user__checkbox-label" for="stage-1-tuning">
            <div class="user__checkbox-square"></div>
            <div class="user__checkbox-title">Stage 1 tuning file&nbsp;(160 YT)</div>
          </label>
        </div>
        <div class="user__checkbox">
          <input type="checkbox" name="dpf-fap" id="dpf-fap1">
          <label class="user__checkbox-label" for="dpf-fap1">
            <div class="user__checkbox-square"></div>
            <div class="user__checkbox-title">DPF/FAP Delete&nbsp;(150 YT)</div>
          </label>
        </div>
        <div class="user__checkbox">
          <input type="checkbox" name="scr-adblue" id="scr-adblue2">
          <label class="user__checkbox-label" for="scr-adblue2">
            <div class="user__checkbox-square"></div>
            <div class="user__checkbox-title">SCR/AdBlue OFF&nbsp;(240 YT)</div>
          </label>
        </div>
        <div class="user__checkbox">
          <input type="checkbox" name="dtc-selectivity" id="dtc-selectivity2">
          <label class="user__checkbox-label" for="dtc-selectivity2">
            <div class="user__checkbox-square"></div>
            <div class="user__checkbox-title">DTC's selectivity OFF&nbsp;(80 YT)</div>
          </label>
        </div>
        <div class="user__checkbox">
          <input type="checkbox" name="egr-agr" id="egr-agr2">
          <label class="user__checkbox-label" for="egr-agr2">
            <div class="user__checkbox-square"></div>
            <div class="user__checkbox-title">EGR/AGR Removal&nbsp;(105 YT)</div>
          </label>
        </div>
        <div class="user__checkbox">
          <input type="checkbox" name="checksumm-correction" id="checksumm-correction2">
          <label class="user__checkbox-label" for="checksumm-correction2">
            <div class="user__checkbox-square"></div>
            <div class="user__checkbox-title">Checksumm correction&nbsp;(80 YT)</div>
          </label>
        </div>
        <div class="user__checkbox">
          <input type="checkbox" name="stage-1-tuning" id="stage-1-tuning2">
          <label class="user__checkbox-label" for="stage-1-tuning2">
            <div class="user__checkbox-square"></div>
            <div class="user__checkbox-title">Stage 1 tuning file&nbsp;(160 YT)</div>
          </label>
        </div>
        <div class="user__checkbox">
          <input type="checkbox" name="checksumm-correction" id="checksumm-correction3">
          <label class="user__checkbox-label" for="checksumm-correction3">
            <div class="user__checkbox-square"></div>
            <div class="user__checkbox-title">Checksumm correction&nbsp;(80 YT)</div>
          </label>
        </div>
        <div class="user__checkbox">
          <input type="checkbox" name="stage-1-tuning" id="stage-1-tuning24">
          <label class="user__checkbox-label" for="stage-1-tuning24">
            <div class="user__checkbox-square"></div>
            <div class="user__checkbox-title">Stage 1 tuning file&nbsp;(160 YT)</div>
          </label>
        </div>
      </div>
      <div class="user__carefully">
        <div class=" user__carefully-title">Please read carefully before placing an order</div>
        <div class="user__carefully-btn p-btn p-btn_orange p-btn_orange-second p-btn_center" hx-get="/php/carefully.php" hx-target="#order-modal-container" hx-trigger="click" hx-swap="innerHTML">See more</div>
        <div class="user__carefully-icon"><svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 20C0 14.6957 2.10714 9.60859 5.85786 5.85786C9.60859 2.10714 14.6957 0 20 0C25.3043 0 30.3914 2.10714 34.1421 5.85786C37.8929 9.60859 40 14.6957 40 20C40 25.3043 37.8929 30.3914 34.1421 34.1421C30.3914 37.8929 25.3043 40 20 40C14.6957 40 9.60859 37.8929 5.85786 34.1421C2.10714 30.3914 0 25.3043 0 20ZM17.5 22.5H22.5V10H17.5V22.5ZM22.5 27.5C22.5 26.837 22.2366 26.2011 21.7678 25.7322C21.2989 25.2634 20.663 25 20 25C19.337 25 18.7011 25.2634 18.2322 25.7322C17.7634 26.2011 17.5 26.837 17.5 27.5C17.5 28.163 17.7634 28.7989 18.2322 29.2678C18.7011 29.7366 19.337 30 20 30C20.663 30 21.2989 29.7366 21.7678 29.2678C22.2366 28.7989 22.5 28.163 22.5 27.5Z" fill="#FF2F00"></path>
          </svg>
        </div>
      </div>
    </div>
  </div>
  <div class="user__order-fill">Please fill additional info bellow</div>
  <div class="user__order-info">
    <div class="user__input">
      <div class="user__input-label">Engine power</div>
      <div class="user__input-el">
        <input type="text" name="engine-power" value="">
      </div>
    </div>
    <div class="user__input">
      <div class="user__input-label">Original file</div>
      <div class="user__input-el">
        <div class="user__file">
          <input type="file" name="original-file" id="original-file">
          <label class="user__file-label" for="original-file">
            <div class="user__file-title">Input file</div>
            <div class="user__file-svg"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 15.575C11.8667 15.575 11.7417 15.5543 11.625 15.513C11.5083 15.4717 11.4 15.4007 11.3 15.3L7.7 11.7C7.5 11.5 7.404 11.2667 7.412 11C7.42 10.7333 7.516 10.5 7.7 10.3C7.9 10.1 8.13767 9.996 8.413 9.988C8.68833 9.98 8.92567 10.0757 9.125 10.275L11 12.15V5C11 4.71667 11.096 4.47934 11.288 4.288C11.48 4.09667 11.7173 4.00067 12 4C12.2827 3.99934 12.5203 4.09534 12.713 4.288C12.9057 4.48067 13.0013 4.718 13 5V12.15L14.875 10.275C15.075 10.075 15.3127 9.979 15.588 9.987C15.8633 9.995 16.1007 10.0993 16.3 10.3C16.4833 10.5 16.5793 10.7333 16.588 11C16.5967 11.2667 16.5007 11.5 16.3 11.7L12.7 15.3C12.6 15.4 12.4917 15.471 12.375 15.513C12.2583 15.555 12.1333 15.5757 12 15.575ZM6 20C5.45 20 4.97933 19.8043 4.588 19.413C4.19667 19.0217 4.00067 18.5507 4 18V16C4 15.7167 4.096 15.4793 4.288 15.288C4.48 15.0967 4.71733 15.0007 5 15C5.28267 14.9993 5.52033 15.0953 5.713 15.288C5.90567 15.4807 6.00133 15.718 6 16V18H18V16C18 15.7167 18.096 15.4793 18.288 15.288C18.48 15.0967 18.7173 15.0007 19 15C19.2827 14.9993 19.5203 15.0953 19.713 15.288C19.9057 15.4807 20.0013 15.718 20 16V18C20 18.55 19.8043 19.021 19.413 19.413C19.0217 19.805 18.5507 20.0007 18 20H6Z" fill="#F56E0F"></path>
              </svg></div>
          </label>
        </div>
      </div>
    </div>
    <div class="user__input">
      <div class="user__input-label">Car year</div>
      <div class="user__input-el">
        <input type="text" name="car-year" value="">
      </div>
    </div>
    <div class="user__input user__input_row-down-1">
      <div class="user__input-label">Description</div>
      <div class="user__input-el">
        <textarea type="text" name="description" value="Description"></textarea>
      </div>
    </div>
    <div class="user__input">
      <div class="user__input-label">Priority</div>
      <div class="user__input-el">
        <input type="text" name="priority" value="">
      </div>
    </div>
    <div class="user__input">
      <div class="user__input-el">
        <div class="user__checkbox">
          <input type="checkbox" name="agree" id="agree">
          <label class="user__checkbox-label" for="agree">
            <div class="user__checkbox-square"></div>
            <div class="user__checkbox-title">I agree with license</div>
          </label>
        </div>
      </div>
    </div>
  </div>
  <div class="user__payment">
    <div class="user__payment-price"><ins>700 YT in total</ins>
      <del>760 YT in total</del>
    </div>
    <div class="user__payment-items">
      <div class="user__payment-item">
        <input type="radio" name="payment" id="payment-1">
        <label class="user__payment-label" for="payment-1"><span class="user__payment-svg"><img class="lazy entered loaded" width="30" height="30" src="/images/user/payments/credits.png" data-src="/images/user/payments/credits.png" alt="Credits" loading="lazy" data-ll-status="loaded"></span><span class="user__payment-title">Credits</span></label>
      </div>
      <div class="user__payment-item">
        <input type="radio" name="payment" id="payment-2">
        <label class="user__payment-label" for="payment-2"><span class="user__payment-svg"><img class="lazy entered loaded" width="30" height="27" src="/images/user/payments/credit-card.png" data-src="/images/user/payments/credit-card.png" alt="Credit card" loading="lazy" data-ll-status="loaded"></span><span class="user__payment-title">Credit card</span></label>
      </div>
      <div class="user__payment-item">
        <input type="radio" name="payment" id="payment-3">
        <label class="user__payment-label" for="payment-3"><span class="user__payment-svg"><img class="lazy entered loaded" width="66" height="18" src="/images/user/payments/paypal.png" data-src="/images/user/payments/paypal.png" alt="PayPal" loading="lazy" data-ll-status="loaded"></span><span class="user__payment-title">PayPal</span></label>
      </div>
    </div>
  </div>
  <div class="user__order-btns">
    <button type="submit" name="submit_auto" class="user__order-btn p-btn p-btn_orange">Create order auto</button>
    <button type="submit" name="submit_manual" class="user__order-btn p-btn p-btn_white">Create order manual
    </button>
  </div>
</form>
