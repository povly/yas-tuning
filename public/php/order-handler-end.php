<?php
header('Content-Type: text/html; charset=utf-8');
?>
<div class="modal order-wait-modal active" id="order-wait-modal">
  <div class="modal__table">
    <div class="modal__ceil">
      <div class="modal__content" onclick="event.stopPropagation()">
        <div class="modal__title order-wait-modal__title">please wait, looking for matches</div>
        <div class="modal__subtitle order-wait-modal__subtitle">It will take a few seconds</div>
        <div class="order-wait-modal__loading">
          <div class="order-wait-modal__loading-num"><span>100</span>%</div><svg style="transform: rotate(-90deg)" width="251" height="250" viewBox="0 0 251 250" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="125.5" cy="125" r="115.5" stroke="#999999" stroke-width="19"></circle>
            <circle class="modal_wait__loading-ninety" stroke="#f5f5f5" stroke-linecap="round" stroke-width="19" cx="125.5" cy="125" r="115.5" stroke-dasharray="100" stroke-dashoffset="100" pathLength="100"></circle>
          </svg>
        </div>
      </div>
    </div>
  </div>
  <script>
    (function() {
      const modal = document.querySelector('#order-wait-modal');
      if (!modal) return; // Добавляем проверку

      const loadingNum = modal.querySelector('.order-wait-modal__loading-num span');
      const circle = modal.querySelector('.modal_wait__loading-ninety');
      const target = 100;
      const duration = 3000;
      let counter = 0;
      let startTime = null;

      // Инициализация начальных значений
      circle.style.strokeDashoffset = '100'; // Начальное значение - полный круг скрыт
      circle.style.transition = 'none'; // Пока без перехода

      // Запуск анимации с небольшой задержкой
      requestAnimationFrame(() => {
        requestAnimationFrame(() => {
          circle.style.transition = 'stroke-dashoffset 3s linear';
          circle.style.strokeDashoffset = '0'; // Конечное значение - полный круг виден
        });
      });

      // Анимация числа
      function animate(timestamp) {
        if (!startTime) startTime = timestamp;
        const elapsed = timestamp - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const current = Math.floor(progress * target);

        if (current !== counter) {
          counter = current;
          if (loadingNum) loadingNum.textContent = counter;
        }

        if (progress < 1) {
          requestAnimationFrame(animate);
        } else {
          // Анимация завершена
          setTimeout(() => {
            if (modal) modal.remove();
            document.body.style.overflow = '';
          }, 1000);
        }
      }

      requestAnimationFrame(animate);
    })();
  </script>
</div>
