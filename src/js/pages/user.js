document.addEventListener('DOMContentLoaded', () => {
  const searchBtn = document.querySelector('.user__icon-btn--search');
  const searchContainer = document.querySelector('.user__search-container');
  const notificationsBtn = document.querySelector(
    '.user__icon-btn--notifications'
  );
  const notificationsPopup = document.querySelector(
    '.user__notifications-popup'
  );

  // Поиск
  searchBtn.addEventListener('click', () => {
    searchBtn.classList.toggle('active');
  });

  if (notificationsBtn){
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
    notificationsBtn && notificationsBtn.contains(e.target) ||
    notificationsPopup && notificationsPopup.contains(e.target);

    if (!isClickInsideSearch) {
      searchBtn.classList.remove('active');
    }

    if (!isClickInsideNotifications && notificationsBtn) {
      notificationsBtn.classList.remove('active');
    }
  });

  // Остановка всплытия событий внутри контейнеров
  searchContainer.addEventListener('click', (e) => {
    e.stopPropagation();
  });

  if (notificationsPopup){
    notificationsPopup.addEventListener('click', (e) => {
      e.stopPropagation();
    });
  }

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

  function initCalendar(dateElement) {
    if (dateElement.dataset.calendarInitialized) return;

    const input = dateElement.querySelector('.user__date-input');
    const title = dateElement.querySelector('.user__date-title');
    const _calendar = dateElement.querySelector('.user__date-calendar');

    const calendar = new Calendar(_calendar, {
      type: 'multiple',
      locale: {
        months: {
          short: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          long: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
        },
        weekdays: {
          short: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
          long: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
        }
      },
      displayMonthsCount: 2,
      monthsToSwitch: 2,
      displayDatesOutside: false,
      disableDatesPast: true,
      enableEdgeDatesOnly: true,
      selectionDatesMode: 'multiple-ranged',
      onClickDate(self, event) {
        const selectedDates = self.context.selectedDates;
        if (selectedDates.length !== 2) return;

        const formatOptions = { day: 'numeric', month: 'numeric', year: 'numeric' };
        const dateStr1 = new Date(selectedDates[0]).toLocaleDateString('ru-RU', formatOptions);
        const dateStr2 = new Date(selectedDates[1]).toLocaleDateString('ru-RU', formatOptions);

        title.textContent = `${dateStr1} - ${dateStr2}`;
        input.value = `${dateStr1} - ${dateStr2}`;

        dateElement.classList.remove('active');
        dateElement.dispatchEvent(new CustomEvent('userDateSelected', {
          detail: { value: input.value }
        }));
      }
    });

    calendar.init();
    dateElement.dataset.calendarInitialized = 'true';
  }

  const selects = document.querySelectorAll('.user-select');
  if (selects[0]){
    selects.forEach((select)=>{
      const current = select.querySelector('.user-select__current');
      const title = select.querySelector('.user-select__current-title');
      const input = select.querySelector('input');

      current.addEventListener('click', () => {
        select.classList.toggle('active');
      });

      const options = select.querySelectorAll('.user-select__option');
      options.forEach((option) => {
        option.addEventListener('click', () => {
          title.textContent = option.textContent;
          input.value = option.dataset.value;
          select.classList.remove('active');
        });
      });
    })
  }

  const tabs = document.querySelectorAll('.user__tabs');
  if (tabs[0]){
    tabs.forEach((tab)=>{
      const btns = tab.querySelectorAll('.user__tab');
      btns.forEach((btn) => {
        btn.addEventListener('click', () => {
          const activeBtn = tab.querySelector('.user__tab.active');
          if (activeBtn && activeBtn !== btn) {
            activeBtn.classList.remove('active');
          }
          btn.classList.add('active');

          btn.dispatchEvent(new CustomEvent('userTabSelected', {
            detail: {
              tab: btn
             }
          }));
        });
      });
    })
  }

  const menuBlock = document.querySelector('.user__menu-block');
  if (menuBlock){
    const button = menuBlock.querySelector('.user__menu-click');
    button.addEventListener('click', () => {
      menuBlock.classList.toggle('active');
    });
  }
});
