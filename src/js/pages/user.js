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

  // Уведомления
  notificationsBtn.addEventListener('click', () => {
    notificationsBtn.classList.toggle('active');
  });

  // Закрытие при клике вне блоков
  document.addEventListener('click', (e) => {
    const isClickInsideSearch =
      searchBtn.contains(e.target) || searchContainer.contains(e.target);
    const isClickInsideNotifications =
      notificationsBtn.contains(e.target) ||
      notificationsPopup.contains(e.target);

    if (!isClickInsideSearch) {
      searchBtn.classList.remove('active');
    }

    if (!isClickInsideNotifications) {
      notificationsBtn.classList.remove('active');
    }
  });

  // Остановка всплытия событий внутри контейнеров
  searchContainer.addEventListener('click', (e) => {
    e.stopPropagation();
  });

  notificationsPopup.addEventListener('click', (e) => {
    e.stopPropagation();
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

  const dates = document.querySelectorAll('.user__date');
  if (dates[0]) {
    dates.forEach((date) => {
      const input = date.querySelector('.user__date-input');
      const title = date.querySelector('.user__date-title');
      const item = date.querySelector('.user__date-item');
      const _calendar = date.querySelector('.user__date-calendar');

      const calendar = new Calendar(_calendar, {
        type: 'multiple',
        locale: {
          months: {
            short: [
              'Янв',
              'Фев',
              'Мар',
              'Апр',
              'Май',
              'Июн',
              'Июл',
              'Авг',
              'Сен',
              'Окт',
              'Ноя',
              'Дек',
            ],
            long: [
              'Январь',
              'Февраль',
              'Март',
              'Апрель',
              'Май',
              'Июнь',
              'Июль',
              'Август',
              'Сентябрь',
              'Октябрь',
              'Ноябрь',
              'Декабрь',
            ],
          },
          weekdays: {
            short: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
            long: [
              'Воскресенье',
              'Понедельник',
              'Вторник',
              'Среда',
              'Четверг',
              'Пятница',
              'Суббота',
            ],
          },
        },
        displayMonthsCount: 2,
        monthsToSwitch: 2,
        displayDatesOutside: false,
        disableDatesPast: true,
        enableEdgeDatesOnly: true,
        selectionDatesMode: 'multiple-ranged',
        onClickDate(self, event) {
          const selectedDates = self.context.selectedDates;

          if (selectedDates.length == 2) {
            title.textContent =
              new Date(selectedDates[0]).toLocaleDateString('ru-RU', {
                day: 'numeric',
                month: 'numeric',
                year: 'numeric',
              }) +
              ' - ' +
              new Date(selectedDates[0]).toLocaleDateString('ru-RU', {
                day: 'numeric',
                month: 'numeric',
                year: 'numeric',
              });
            input.value =
              new Date(selectedDates[0]).toLocaleDateString('ru-RU', {
                day: 'numeric',
                month: 'numeric',
                year: 'numeric',
              }) +
              ' - ' +
              new Date(selectedDates[0]).toLocaleDateString('ru-RU', {
                day: 'numeric',
                month: 'numeric',
                year: 'numeric',
              });

            date.classList.remove('active');

            date.dispatchEvent(
              new CustomEvent('userDateSelected', {
                detail: {
                  value: input.value,
                },
              })
            );
          }
        },
      });
      calendar.init();

      item.addEventListener('click', () => {
        date.classList.toggle('active');
      });
    });
  }
});
