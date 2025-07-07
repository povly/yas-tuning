import htmx from 'htmx.org';
window.htmx = htmx;

// Конфигурация HTMX для внешних запросов
htmx.config.selfRequestsOnly = false;

// Инициализация HTMX после загрузки DOM
document.addEventListener('DOMContentLoaded', () => {
  htmx.process(document.body);
});
