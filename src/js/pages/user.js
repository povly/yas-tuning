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
      searchBtn.contains(e.target) ||
      searchContainer.contains(e.target);
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
});
