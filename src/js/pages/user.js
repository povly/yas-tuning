import SimpleBar from "simplebar";
window.SimpleBar = SimpleBar;
document.addEventListener('DOMContentLoaded', () => {
  const searchBtn = document.querySelector('.user__icon-btn--search');
  const searchContainer = document.querySelector('.user__search-container');
  const headerOverlay = document.querySelector('.user__header-overlay');
  const notificationsBtn = document.querySelector(
    '.user__icon-btn--notifications'
  );
  const notificationsPopup = document.querySelector(
    '.user__notifications-popup'
  );

  // Поиск
  searchBtn.addEventListener('click', () => {
    searchBtn.classList.toggle('active');

    headerOverlay.classList.toggle('active');

    const input = searchBtn.querySelector('input');
    input.focus();
  });

  if (notificationsBtn) {
    // Уведомления
    notificationsBtn.addEventListener('click', () => {
      notificationsBtn.classList.toggle('active');
    });
  }

  // Закрытие при клике вне блоков
  document.addEventListener('click', (e) => {
    const isClickInsideSearch =
      searchBtn.contains(e.target) || searchContainer.contains(e.target);
    const isClickInsideNotifications =
      (notificationsBtn && notificationsBtn.contains(e.target)) ||
      (notificationsPopup && notificationsPopup.contains(e.target));

    if (!isClickInsideSearch) {
      searchBtn.classList.remove('active');
      headerOverlay.classList.remove('active');
    }

    if (!isClickInsideNotifications && notificationsBtn) {
      notificationsBtn.classList.remove('active');
    }
  });

  function ticketsScrollBarInit(){
    const ticketsContainer = document.querySelector('.user__chat-tickets-items');
    if (ticketsContainer) {
      new SimpleBar(ticketsContainer, { autoHide: false });
    }
  }

  ticketsScrollBarInit();

  window.ticketsScrollBarInit = ticketsScrollBarInit;

  // Остановка всплытия событий внутри контейнеров
  searchContainer.addEventListener('click', (e) => {
    e.stopPropagation();
  });

  if (notificationsPopup) {
    notificationsPopup.addEventListener('click', (e) => {
      e.stopPropagation();
    });
  }

  document.body.addEventListener('htmx:confirm', function (evt) {
    evt.preventDefault();

    const target = evt.detail.target;
    const modalName = target.dataset.confirmName;
    if (target.dataset.confirmName) {
      const modal = document.querySelector(`.modal_${modalName}`);

      let isValid = true;

      // Проверка кастомных селектов
      const customSelects = evt.detail.target.querySelectorAll('.user-select');
      customSelects.forEach((select) => {
        const hiddenInput = select.querySelector('.user-select__input');

        if (!hiddenInput.value) {
          isValid = false;
          // Устанавливаем кастомное сообщение для скрытого поля
          const customMessage = select.dataset.error;
          hiddenInput.setCustomValidity(customMessage);
        } else {
          hiddenInput.setCustomValidity('');
        }

        hiddenInput.reportValidity();
      });

      // Если форма невалидна, показываем сообщения об ошибках
      if (isValid) {
        window.Modal.showModal(modal);

        const btnActionYes = modal.querySelector('[data-action="yes"]');
        btnActionYes.addEventListener('click', () => {
          evt.detail.issueRequest();
        });
      }
    } else {
      evt.detail.issueRequest();
    }
  });

  const files = document.querySelectorAll('.user__file');
  if (files[0]) {
    files.forEach((file) => {
      const fileInput = file.querySelector('input');
      const fileTitle = file.querySelector('.user__file-title');

      fileInput.addEventListener('change', () => {
        const fileName = fileInput.files[0].name;
        if (file) {
          fileTitle.textContent = fileName;
        }
      });
    });
  }

  document.addEventListener('click', function (event) {
    const item = event.target.closest('.user__date-item');
    if (!item) return;

    const dateElement = item.closest('.user__date');
    if (!dateElement) return;

    initCalendar(dateElement);
    dateElement.classList.toggle('active');
  });

  function checkAndApplyDatesFromAttributes(dateElement) {
    const startDate = dateElement.dataset.startDate;
    const endDate = dateElement.dataset.endDate;

    if (startDate && endDate) {
      // Преобразуем строки в объекты Date
      const date1 = new Date(startDate);
      const date2 = new Date(endDate);

      // Обновляем отображение
      const formatOptions = {
        day: 'numeric',
        month: 'numeric',
        year: 'numeric',
      };
      const dateStr1 = date1.toLocaleDateString('ru-RU', formatOptions);
      const dateStr2 = date2.toLocaleDateString('ru-RU', formatOptions);

      return {
        selectDates: [startDate, endDate],
        text: `${dateStr1} - ${dateStr2}`
      };
    }
  }

  function initCalendar(dateElement) {
    if (dateElement.dataset.calendarInitialized) return;

    const input = dateElement.querySelector('.user__date-input');
    const title = dateElement.querySelector('.user__date-title');
    const _calendar = dateElement.querySelector('.user__date-calendar');

    const selectedDates = checkAndApplyDatesFromAttributes(dateElement);

    const options = {
      layouts: {
        multiple: `
          <div class="vc-controls" data-vc="controls" role="toolbar">
            <#ArrowPrev [month] />
            <#ArrowNext [month] />
          </div>
          <div class="vc-grid" data-vc="grid">
            <#Multiple>
              <div class="vc-column" data-vc="column" role="region">
                <div class="vc-header" data-vc="header">
                  <div class="vc-header__content" data-vc-header="content">
                    <#Month />
                    <#Year />
                  </div>
                </div>
                <div class="vc-wrapper" data-vc="wrapper">
                  <#WeekNumbers />
                  <div class="vc-content" data-vc="content">
                    <#Week />
                    <#Dates />
                  </div>
                </div>
              </div>
            <#/Multiple>
            <#DateRangeTooltip />
          </div>
          <#ControlTime />
          <button type="button" class="vc-reset">Reset</button>
        `,
      },
      type: 'multiple',
      locale: {
        months: {
          short: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun',
            'Jul',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec',
          ],
          long: [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
          ],
        },
        weekdays: {
          short: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
          long: [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
          ],
        },
      },
      selectionDatesMode: 'multiple-ranged',
      onClickDate(self, event) {
        const selectedDates = self.context.selectedDates;
        if (selectedDates.length !== 2) return;

        const formatOptions = {
          day: 'numeric',
          month: 'numeric',
          year: 'numeric',
        };
        const dateStr1 = new Date(selectedDates[0]).toLocaleDateString(
          'ru-RU',
          formatOptions
        );
        const dateStr2 = new Date(selectedDates[1]).toLocaleDateString(
          'ru-RU',
          formatOptions
        );

        title.textContent = `${dateStr1} - ${dateStr2}`;
        input.value = `${dateStr1} - ${dateStr2}`;

        dateElement.classList.remove('active');
        dateElement.dispatchEvent(
          new CustomEvent('userDateSelected', {
            detail: { value: input.value },
          })
        );
      },
      selectedDates: selectedDates?.selectDates ? [`${selectedDates.selectDates[0]}-${selectedDates.selectDates[1]}`] : [],
    };


    const calendar = new Calendar(_calendar, options);

    calendar.init();

    dateElement.dataset.calendarInitialized = 'true';

    // Используем делегирование событий для кнопки reset
    _calendar.addEventListener('click', function (event) {
      if (event.target.classList.contains('vc-reset')) {
        calendar.context.selectedDates = [];
        calendar.update();
        title.textContent = 'Select dates';
        input.value = '';
      }
    });
  }

  const selects = document.querySelectorAll('.user-select');
  if (selects[0]) {
    selects.forEach((select) => {
      const current = select.querySelector('.user-select__current');
      const title = select.querySelector('.user-select__current-title');
      const input = select.querySelector('.user-select__input');

      current.addEventListener('click', () => {
        select.classList.toggle('active');
      });

      const options = select.querySelectorAll('.user-select__option');
      options.forEach((option) => {
        option.addEventListener('click', () => {
          title.textContent = option.textContent;
          input.value = option.dataset.value;
          input.setCustomValidity('');
          select.classList.remove('active');

          options.forEach((opt) => {
            opt.classList.remove('selected');
          });

          option.classList.add('selected');

          // Создаём и отправляем событие change
          const changeEvent = new Event('change', { bubbles: true });
          input.dispatchEvent(changeEvent);
        });
      });
    });
  }

  const tabs = document.querySelectorAll('.user__tabs');
  if (tabs[0]) {
    tabs.forEach((tab) => {
      const btns = tab.querySelectorAll('.user__tab');
      btns.forEach((btn) => {
        btn.addEventListener('click', () => {
          const activeBtn = tab.querySelector('.user__tab.active');
          if (activeBtn && activeBtn !== btn) {
            activeBtn.classList.remove('active');
          }
          btn.classList.add('active');

          btn.dispatchEvent(
            new CustomEvent('userTabSelected', {
              detail: {
                tab: btn,
              },
            })
          );
        });
      });
    });
  }

  function userUpdateMenu() {
    const menuBlock = document.querySelector('.user__menu-block');
    if (menuBlock) {
      const button = menuBlock.querySelector('.user__menu-click');
      button.addEventListener('click', () => {
        menuBlock.classList.toggle('active');
      });
    }
  }
  userUpdateMenu();
  window.userUpdateMenu = userUpdateMenu;
});
