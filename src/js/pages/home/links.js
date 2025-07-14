document.addEventListener('DOMContentLoaded', () => {
  const links = document.querySelectorAll('.h-links');
  if (links[0]) {
    links.forEach((link) => {
      const items = link.querySelectorAll('.h-links__items .h-links__item');

      items.forEach((item) => {
        const btn = item.querySelector('.h-links__item-current');
        const content = item.querySelector('.h-links__item-content');

        btn.addEventListener('click', () => {
          const activeItem = link.querySelector('.h-links__items .h-links__item.active');

          if (activeItem && activeItem !== item) {
            activeItem.classList.remove('active');
            activeItem.querySelector('.h-links__item-content').style.height = '';
          }
          
          item.classList.toggle('active');

          if (item.classList.contains('active')) {
            content.style.height = content.scrollHeight + 'px';
          } else {
            content.style.height = '';
          }
        });
      });
    });
  }
});
