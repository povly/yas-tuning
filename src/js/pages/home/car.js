document.addEventListener('DOMContentLoaded', () => {
  const cars = document.querySelectorAll('.h-car');
  if (cars[0]) {
    cars.forEach((car) => {
      const items = car.querySelectorAll('.h-car__item');
      const btn = car.querySelector('.h-car__btn');

      btn.addEventListener('click', () => {
        items.forEach((item) => item.classList.add('active'));
        btn.remove();
      });
    });
  }
});
