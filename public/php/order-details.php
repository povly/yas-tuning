<?php
// Получаем ID заказа из запроса
$orderId = isset($_GET['id']) ? $_GET['id'] : '';

// В реальном приложении здесь будет запрос к базе данных
// Для демо просто используем фиктивные данные
$orderData = [
  'id' => $orderId,
  'worker' => 'Aliaksandr Yanukovich',
  'user_data' => '31/05/2025',
  'car_info' => 'Bus BMC Midilux 4.5 TD Motorola CM850 20hp 2019 Manual',
  'description' => 'Bus BMC Midilux 4.5 TD Motorola CM850 20hp 2019 Manual',
  'options' => 'DPF/FAP Delete',
  'priority' => '1-2 hours',
  'is_original' => 'File is original',
  'amount' => '140',
  'status' => 'Completed',
  'start_date' => '30.12.2023 23:17:51',
  'end_date' => '31.12.2023 00:01:18'
];

// Возвращаем HTML модального окна
?>

<div class="modal order-detail-modal active" id="order-modal-<?php echo $orderId; ?>" onclick="document.getElementById('order-modal-<?php echo $orderId; ?>').remove();document.body.style.overflow='';">
  <div class="modal__table" onclick="document.getElementById('order-modal-<?php echo $orderId; ?>').remove();document.body.style.overflow='';">
    <div class="modal__ceil">
      <div class="modal__content order-detail-modal__content" onclick="event.stopPropagation()">
        <button class="order-detail-modal__close modal__close" onclick="document.getElementById('order-modal-<?php echo $orderId; ?>').remove();document.body.style.overflow='';">
          <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2.38562 0.392716L8 6.0071L13.5853 0.421806C13.7087 0.290489 13.8573 0.185441 14.0222 0.11296C14.1872 0.0404785 14.3651 0.00205717 14.5453 0C14.931 0 15.301 0.153242 15.5737 0.426014C15.8465 0.698786 15.9998 1.06874 15.9998 1.4545C16.0032 1.63283 15.9701 1.80996 15.9025 1.97504C15.835 2.14012 15.7345 2.28966 15.607 2.41447L9.94903 7.99976L15.607 13.6578C15.8468 13.8923 15.9873 14.2099 15.9998 14.545C15.9998 14.9308 15.8465 15.3007 15.5737 15.5735C15.301 15.8463 14.931 15.9995 14.5453 15.9995C14.3599 16.0072 14.1749 15.9763 14.0022 15.9087C13.8294 15.8411 13.6726 15.7383 13.5417 15.6068L8 9.99243L2.40017 15.5923C2.27727 15.7192 2.13045 15.8205 1.96818 15.8904C1.80591 15.9603 1.63141 15.9974 1.45474 15.9995C1.06898 15.9995 0.699023 15.8463 0.42625 15.5735C0.153478 15.3007 0.000236657 14.9308 0.000236657 14.545C-0.00315451 14.3667 0.0299309 14.1896 0.0974628 14.0245C0.164995 13.8594 0.265548 13.7099 0.392952 13.5851L6.05097 7.99976L0.392952 2.34175C0.153228 2.10722 0.0126576 1.78964 0.000236657 1.4545C0.000236657 1.06874 0.153478 0.698786 0.42625 0.426014C0.699023 0.153242 1.06898 0 1.45474 0C1.80382 0.00436351 2.13836 0.14545 2.38562 0.392716Z" fill="#999999" />
          </svg>
        </button>

        <div class="order-detail-modal__table">
          <!-- Таблица заказа -->
          <div class="order-detail-modal__content-table">
            <div class="order-detail-modal__row">
              <div class="order-detail-modal__label">Start</div>
              <div class="order-detail-modal__value"><?php echo $orderData['start_date']; ?></div>
            </div>

            <div class="order-detail-modal__row">
              <div class="order-detail-modal__label">End</div>
              <div class="order-detail-modal__value"><?php echo $orderData['end_date']; ?></div>
            </div>

            <div class="order-detail-modal__row">
              <div class="order-detail-modal__label">Worker Name</div>
              <div class="order-detail-modal__value"><?php echo $orderData['worker']; ?></div>
            </div>

            <div class="order-detail-modal__row">
              <div class="order-detail-modal__label">User data</div>
              <div class="order-detail-modal__value"><?php echo $orderData['user_data']; ?></div>
            </div>

            <div class="order-detail-modal__row">
              <div class="order-detail-modal__label">Information</div>
              <div class="order-detail-modal__value"><?php echo $orderData['car_info']; ?></div>
            </div>

            <div class="order-detail-modal__row">
              <div class="order-detail-modal__label">Options</div>
              <div class="order-detail-modal__value"><?php echo $orderData['options']; ?></div>
            </div>

            <div class="order-detail-modal__row">
              <div class="order-detail-modal__label">Description</div>
              <div class="order-detail-modal__value"><?php echo $orderData['description']; ?></div>
            </div>

            <div class="order-detail-modal__row">
              <div class="order-detail-modal__label">Priority</div>
              <div class="order-detail-modal__value">
                <span class="order-detail-modal__priority color_red"><?php echo $orderData['priority']; ?></span>
              </div>
            </div>

            <div class="order-detail-modal__row">
              <div class="order-detail-modal__label">Is File Origin</div>
              <div class="order-detail-modal__value"><?php echo $orderData['is_original']; ?></div>
            </div>

            <div class="order-detail-modal__row">
              <div class="order-detail-modal__label">Original file</div>
              <div class="order-detail-modal__value">
                <?php if ($orderData['status'] == 'Completed'): ?>
                  <a class="user__download user__download--active" href="#!">Download</a>
                <?php else: ?>
                  <button class="user__download user__download--disabled">Download</button>
                <?php endif; ?>
              </div>
            </div>

            <div class="order-detail-modal__row">
              <div class="order-detail-modal__label">Ini file</div>
              <div class="order-detail-modal__value">
                <a class="user__download user__download--active" href="#!">Download</a>
              </div>
            </div>

            <div class="order-detail-modal__row">
              <div class="order-detail-modal__label">Amount, YT</div>
              <div class="order-detail-modal__value"><?php echo $orderData['amount']; ?></div>
            </div>

            <div class="order-detail-modal__row">
              <div class="order-detail-modal__label">Modified file</div>
              <div class="order-detail-modal__value">
                <?php if ($orderData['status'] == 'Completed'): ?>
                  <a class="user__download user__download--active" href="#!">Download</a>
                <?php else: ?>
                  <button class="user__download user__download--disabled">Download</button>
                <?php endif; ?>
              </div>
            </div>

            <div class="order-detail-modal__row">
              <div class="order-detail-modal__label">Order status</div>
              <div class="order-detail-modal__value">
                <div class="user__status user__status--completed">Сompleted</div>
              </div>
            </div>
          </div>

          <!-- Предупреждения -->
          <div class="order-detail-modal__warnings">
            <div class="order-detail-modal__warning">
              <div class="order-detail-modal__warning-icon">
                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="19.5" cy="19.5" r="19.5" fill="#FF2F00" />
                  <path d="M19.5 8V22M19.5 30V26" stroke="white" stroke-width="2" stroke-linecap="round" />
                </svg>
              </div>
              <div class="order-detail-modal__warning-text">
                Please select this option only if you really need to recovery all changes to original. In case if your attached file after our checking content original changes, order will be completed and the
              </div>
            </div>

            <div class="order-detail-modal__warning">
              <div class="order-detail-modal__warning-icon">
                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="19.5" cy="19.5" r="19.5" fill="#FF2F00" />
                  <path d="M19.5 8V22M19.5 30V26" stroke="white" stroke-width="2" stroke-linecap="round" />
                </svg>
              </div>
              <div class="order-detail-modal__warning-text">
                Please select this option only if you really need to recovery all changes to original. In case if your attached file after our checking content original changes, order will be completed and the
              </div>
            </div>

            <div class="order-detail-modal__warning">
              <div class="order-detail-modal__warning-icon">
                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="19.5" cy="19.5" r="19.5" fill="#FF2F00" />
                  <path d="M19.5 8V22M19.5 30V26" stroke="white" stroke-width="2" stroke-linecap="round" />
                </svg>
              </div>
              <div class="order-detail-modal__warning-text">
                Please select this option only if you really need to recovery all changes to original. In case if your attached file after our checking content original changes, order will be completed and the
              </div>
            </div>

            <div class="order-detail-modal__warning">
              <div class="order-detail-modal__warning-icon">
                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="19.5" cy="19.5" r="19.5" fill="#FF2F00" />
                  <path d="M19.5 8V22M19.5 30V26" stroke="white" stroke-width="2" stroke-linecap="round" />
                </svg>
              </div>
              <div class="order-detail-modal__warning-text">
                Please select this option only if you really need to recovery all changes to original. In case if your attached file after our checking content original changes, order will be completed and the
              </div>
            </div>

            <div class="order-detail-modal__warning">
              <div class="order-detail-modal__warning-icon">
                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="19.5" cy="19.5" r="19.5" fill="#FF2F00" />
                  <path d="M19.5 8V22M19.5 30V26" stroke="white" stroke-width="2" stroke-linecap="round" />
                </svg>
              </div>
              <div class="order-detail-modal__warning-text">
                Please select this option only if you really need to recovery all changes to original. In case if your attached file after our checking content original changes, order will be completed and the
              </div>
            </div>

            <div class="order-detail-modal__warning">
              <div class="order-detail-modal__warning-icon">
                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="19.5" cy="19.5" r="19.5" fill="#FF2F00" />
                  <path d="M19.5 8V22M19.5 30V26" stroke="white" stroke-width="2" stroke-linecap="round" />
                </svg>
              </div>
              <div class="order-detail-modal__warning-text">
                Please select this option only if you really need to recovery all changes to original. In case if your attached file after our checking content original changes, order will be completed and the
              </div>
            </div>

            <div class="order-detail-modal__warning">
              <div class="order-detail-modal__warning-icon">
                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="19.5" cy="19.5" r="19.5" fill="#FF2F00" />
                  <path d="M19.5 8V22M19.5 30V26" stroke="white" stroke-width="2" stroke-linecap="round" />
                </svg>
              </div>
              <div class="order-detail-modal__warning-text">
                Please select this option only if you really need to recovery all changes to original. In case if your attached file after our checking content original changes, order will be completed and the
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
