// Инициализация компонента выбора автомобиля при загрузке DOM
document.addEventListener('DOMContentLoaded', function () {
  // Находим все секции с автомобилями на странице
  const carSections = document.querySelectorAll('.h-car');
  if (!carSections.length) return;

  // Инициализируем каждую секцию отдельно
  carSections.forEach((carSection) => {
    initCarSection(carSection);
    initShowMoreButton(carSection);
  });

  /**
   * Инициализация кнопки "Показать больше" для списка брендов
   * @param {HTMLElement} carSection - DOM элемент секции автомобилей
   */
  function initShowMoreButton(carSection) {
    const btn = carSection.querySelector('.h-car__btn');
    const items = carSection.querySelectorAll('.h-car__item');
    if (btn && items.length) {
      btn.addEventListener('click', function () {
        // Показываем все скрытые элементы брендов
        items.forEach((item) => {
          item.classList.add('active');
        });
        // Удаляем кнопку после показа всех элементов
        btn.remove();
      });
    }
  }

  /**
   * Основная функция инициализации логики выбора автомобиля
   * @param {HTMLElement} carSection - DOM элемент секции автомобилей
   */
  function initCarSection(carSection) {
    // Конфигурация шагов выбора автомобиля (модель -> год -> двигатель)
    const STEPS_CONFIG = {
      model: {
        next: 'year', // Следующий шаг после выбора модели
        selector: '.h-car__step_model', // CSS селектор для шага модели
        ajaxKey: 'models', // Ключ для AJAX запроса
        updateFn: updateModelStep, // Функция обновления шага
        clearAfter: true, // Очищать ли последующие шаги
      },
      year: {
        next: 'motor',
        selector: '.h-car__step_year',
        ajaxKey: 'years',
        updateFn: updateYearStep,
        clearAfter: true,
      },
      motor: {
        next: null, // Последний шаг
        selector: '.h-car__step_motor',
        ajaxKey: 'engines',
        updateFn: updateEngineStep,
        clearAfter: false, // Не очищаем, т.к. последний шаг
      },
    };

    // Порядок элементов в хлебных крошках
    const BREADCRUMB_ORDER = ['wagens', 'brand', 'model', 'year', 'motor'];

    // Состояние текущего выбора пользователя
    const state = {
      currentBrand: null, // Выбранный бренд {id, name, img}
      currentModel: null, // Выбранная модель (строка)
      currentYear: null, // Выбранный год (строка)
      currentCarId: null, // ID выбранного автомобиля
    };

    /**
     * Универсальная функция для AJAX запросов к серверу
     * @param {string} endpoint - Конечная точка API (models, years, engines, info)
     * @param {Object} data - Данные для отправки на сервер
     * @returns {Promise} Promise с JSON ответом от сервера
     */
    function makeAjaxRequest(endpoint, data) {
      const loading = document.getElementById('loading');

      // Показываем индикатор загрузки
      if (loading) loading.classList.add('active');

      // Подготавливаем данные формы для отправки
      const formData = new FormData();
      Object.entries(data).forEach(([key, value]) => {
        formData.append(key, value);
      });

      return fetch(carAjax[endpoint], {
        method: 'POST',
        body: formData,
      })
        .then((response) => response.json())
        .catch((error) => {
          console.error(`Error loading ${endpoint}:`, error);
          throw error;
        })
        .finally(() => {
          // Скрываем индикатор загрузки независимо от результата
          if (loading) loading.classList.remove('active');
        });
    }

    /**
     * Универсальная функция для обновления шагов выбора
     * @param {string} stepType - Тип шага (model, year, motor)
     * @param {Array} data - Массив данных для отображения
     * @param {string} title - Заголовок шага
     * @param {string|null} img - URL изображения логотипа
     */
    function updateStep(stepType, data, title, img = null) {
      const config = STEPS_CONFIG[stepType];
      if (!config) return;

      const step = carSection.querySelector(config.selector);
      if (!step) return;

      // Обновляем заголовок и логотип бренда
      const logoTitle = step.querySelector('.h-car__logo-title');
      const logoImgContainer = step.querySelector('.h-car__logo-img');

      if (logoTitle) logoTitle.textContent = title;
      if (logoImgContainer && img) {
        // Создаем изображение из шаблона
        const template = document.getElementById('h-car__logo-img');
        const clone = template.content.cloneNode(true);
        const imgElement = clone.querySelector('img');
        imgElement.src = img;
        imgElement.alt = title;
        logoImgContainer.innerHTML = '';
        logoImgContainer.appendChild(clone);
      }

      // Обновляем список опций для выбора
      const list = step.querySelector('.h-car__list');
      if (list) {
        list.innerHTML = '';
        data.forEach((item) => {
          const listItem = createListItem(stepType, item);
          list.appendChild(listItem);
        });
      }
    }

    /**
     * Создание DOM элементов списка для каждого шага
     * @param {string} stepType - Тип шага (model, year, motor)
     * @param {Object} item - Объект с данными элемента
     * @returns {DocumentFragment} Клонированный шаблон элемента списка
     */
    function createListItem(stepType, item) {
      const template = document.getElementById('h-car__list-li');
      const clone = template.content.cloneNode(true);
      const link = clone.querySelector('.h-car__list-link');

      // Заполняем элемент в зависимости от типа шага
      switch (stepType) {
        case 'model':
          link.textContent = item.model;
          break;
        case 'year':
          link.textContent = item.year;
          break;
        case 'motor':
          // Для двигателя сохраняем ID и показываем мотор + мощность
          link.dataset.carId = item.id;
          link.innerHTML = `<span>${item.motor}</span><span>${item.hp}</span>`;
          break;
      }

      return clone;
    }

    // Маппинг селекторов на обработчики кликов
    const clickHandlers = {
      '.h-car__item': handleBrandClick, // Клик по бренду
      '.h-car__step_model .h-car__list-link': handleModelClick, // Клик по модели
      '.h-car__step_year .h-car__list-link': handleYearClick, // Клик по году
      '.h-car__step_motor .h-car__list-link': handleEngineClick, // Клик по двигателю
      '.h-car__data-link': handleDataFilterClick, // Клик по фильтру данных
      '.h-car__breadcrumb-link': handleBreadcrumbClick, // Клик по хлебным крошкам
    };

    /**
     * Делегированный обработчик событий для всех кликов в секции
     * Использует паттерн "Event Delegation" для оптимизации
     */
    carSection.addEventListener('click', function (e) {
      // Проверяем каждый зарегистрированный селектор
      for (const [selector, handler] of Object.entries(clickHandlers)) {
        const target = e.target.closest(selector);
        if (target) {
          e.preventDefault();
          e.stopPropagation();
          handler(target);
          break; // Прерываем после первого совпадения
        }
      }
    });

    /**
     * Обработчик клика по бренду автомобиля
     * @param {HTMLElement} carItem - DOM элемент бренда
     */
    function handleBrandClick(carItem) {
      // Извлекаем данные бренда из data-атрибутов
      const brandId = carItem.dataset.carBrandId;
      const brandName = carItem.dataset.carBrandName;
      const brandImg = carItem.querySelector('img').src;

      // Сохраняем выбранный бренд в состоянии
      state.currentBrand = { id: brandId, name: brandName, img: brandImg };

      // Переходим к следующему этапу выбора
      hideElement('.h-car__items'); // Скрываем список брендов
      hideElement('.h-car__btn'); // Скрываем кнопку "Показать больше"
      showElement('.h-car__breadcrumbs'); // Показываем навигацию
      updateBreadcrumb('brand', brandName); // Обновляем хлебные крошки
      showElement('.h-car__steps'); // Показываем шаги выбора
      showStep('model'); // Активируем шаг выбора модели

      // Загружаем модели для выбранного бренда
      loadData('models', { type: 'models', brand_id: brandId }).then((data) =>
        updateModelStep(data, brandName, brandImg)
      );
    }

    /**
     * Обработчик клика по модели автомобиля
     * @param {HTMLElement} modelLink - DOM элемент модели
     */
    function handleModelClick(modelLink) {
      const model = modelLink.textContent.trim();
      state.currentModel = model; // Сохраняем выбранную модель
      updateBreadcrumb('model', model); // Обновляем навигацию

      // Загружаем годы выпуска для выбранной модели
      loadData('years', {
        type: 'years',
        brand_id: state.currentBrand.id,
        model: model,
      }).then((data) => updateYearStep(data, model));
    }

    /**
     * Обработчик клика по году выпуска
     * @param {HTMLElement} yearLink - DOM элемент года
     */
    function handleYearClick(yearLink) {
      const year = yearLink.textContent.trim();
      state.currentYear = year; // Сохраняем выбранный год
      updateBreadcrumb('year', year); // Обновляем навигацию

      // Загружаем типы двигателей для выбранного года
      loadData('engines', {
        type: 'engines',
        brand_id: state.currentBrand.id,
        model: state.currentModel,
        year: year,
      }).then((data) => updateEngineStep(data, year));
    }

    /**
     * Обработчик клика по типу двигателя (финальный выбор)
     * @param {HTMLElement} engineLink - DOM элемент двигателя
     */
    function handleEngineClick(engineLink) {
      const carId = engineLink.dataset.carId;
      const motor = engineLink.querySelector('span:first-child').textContent.trim();
      const hp = engineLink.querySelector('span:last-child').textContent.trim();

      // Сохраняем ID выбранного автомобиля
      state.currentCarId = carId;
      updateBreadcrumb('motor', `${motor} ${hp}`); // Обновляем навигацию
      hideElement('.h-car__steps'); // Скрываем шаги выбора

      // Загружаем подробную информацию о выбранном автомобиле
      loadData('info', { type: 'info', car_id: carId }).then((data) =>
        updateDataSection(data)
      );
    }

    /**
     * Обработчик клика по фильтрам данных (вкладки с результатами)
     * @param {HTMLElement} dataLink - DOM элемент фильтра
     */
    function handleDataFilterClick(dataLink) {
      // Убираем активный класс со всех фильтров
      carSection.querySelectorAll('.h-car__data-link').forEach((link) => {
        link.classList.remove('active');
      });
      // Устанавливаем активный класс на выбранный фильтр
      dataLink.classList.add('active');

      const filterType = dataLink.textContent.trim().toLowerCase();
      filterCarData(filterType); // Переключаем отображение данных
    }

    /**
     * Обработчик клика по элементам навигации (хлебные крошки)
     * @param {HTMLElement} breadcrumbLink - DOM элемент навигации
     */
    function handleBreadcrumbClick(breadcrumbLink) {
      const breadcrumb = breadcrumbLink.closest('.h-car__breadcrumb');
      if (!breadcrumb) return;

      // Маппинг классов навигации на действия
      const breadcrumbActions = {
        'h-car__breadcrumb_wagens': () => resetToInitialState(), // Возврат к началу
        'h-car__breadcrumb_brand': () => navigateToStep('model'), // К выбору модели
        'h-car__breadcrumb_model': () => navigateToStep('year'), // К выбору года
        'h-car__breadcrumb_year': () => navigateToStep('motor'), // К выбору двигателя
        'h-car__breadcrumb_motor': () => navigateToStep('motor'), // Остаемся на двигателе
      };

      // Выполняем соответствующее действие
      for (const [className, action] of Object.entries(breadcrumbActions)) {
        if (breadcrumb.classList.contains(className)) {
          action();
          break;
        }
      }
    }

    /**
     * Навигация к определенному шагу выбора
     * @param {string} stepType - Тип шага (model, year, motor)
     */
    function navigateToStep(stepType) {
      // Проверяем наличие необходимых данных для каждого шага
      const requiredStates = {
        model: () => state.currentBrand, // Для модели нужен только бренд
        year: () => state.currentBrand && state.currentModel, // Для года нужен бренд и модель
        motor: () =>
          state.currentBrand && state.currentModel && state.currentYear, // Для двигателя нужно все
      };

      // Если не хватает данных - прерываем
      if (!requiredStates[stepType]()) return;

      // Показываем интерфейс выбора и активируем нужный шаг
      showElement('.h-car__steps');
      showStep(stepType);
      clearStepsAfter(stepType); // Очищаем последующие шаги
      clearDataSection(); // Очищаем данные результата
      clearBreadcrumbsAfter(stepType); // Очищаем навигацию после текущего шага
    }

    /**
     * Загрузка данных с автоматической очисткой
     * @param {string} endpoint - Конечная точка API
     * @param {Object} params - Параметры запроса
     * @returns {Promise} Promise с данными
     */
    function loadData(endpoint, params) {
      return makeAjaxRequest(endpoint, params).then((data) => {
        // Для всех запросов кроме 'info' очищаем последующие шаги
        if (endpoint !== 'info') {
          clearStepsAfter(
            endpoint === 'models'
              ? 'model'
              : endpoint === 'years'
                ? 'year'
                : 'motor'
          );
          clearDataSection();
        }
        return data;
      });
    }

    /**
     * Специфичные функции обновления шагов (обёртки над updateStep)
     */

    /**
     * Обновление шага выбора модели
     * @param {Array} models - Список моделей
     * @param {string} brandName - Название бренда
     * @param {string} brandImg - URL изображения бренда
     */
    function updateModelStep(models, brandName, brandImg) {
      updateStep('model', models, brandName, brandImg);
    }

    /**
     * Обновление шага выбора года
     * @param {Array} years - Список годов
     * @param {string} model - Название модели
     */
    function updateYearStep(years, model) {
      updateStep('year', years, model, state.currentBrand?.img);
      showStep('year'); // Показываем шаг года
    }

    /**
     * Обновление шага выбора двигателя
     * @param {Array} engines - Список двигателей
     * @param {string} year - Год выпуска
     */
    function updateEngineStep(engines, year) {
      updateStep('motor', engines, year, state.currentBrand?.img);
      showStep('motor'); // Показываем шаг двигателя
    }

    function updateDataSection(data) {
      const dataSection = carSection.querySelector('.h-car__data');
      const dataContents = carSection.querySelector('.h-car__data-contents');
      if (!dataContents) return;

      showElement('.h-car__data');

      // Группируем данные по типу
      const groupedData = data.reduce((acc, item) => {
        if (!acc[item.type]) acc[item.type] = [];
        acc[item.type].push(item);
        return acc;
      }, {});

      // Создаем контент
      dataContents.innerHTML = '';
      Object.entries(groupedData).forEach(([type, items], index) => {
        const content = createDataContent(type, items, index === 0);
        dataContents.appendChild(content);
      });

      updateDataFilters(Object.keys(groupedData));
    }

    function createDataContent(type, items, isActive) {
      const template = document.getElementById('h-car__data-content');
      const clone = template.content.cloneNode(true);
      const content = clone.querySelector('.h-car__data-content');
      const tbody = clone.querySelector('tbody');

      if (isActive) {
        content.classList.add('active');
      }

      tbody.innerHTML = items
        .map(
          (item) => `
        <tr>
          <td>${item.meer_info}</td>
          <td>${item.original}</td>
          <td>${item.after_tuning}</td>
          <td>${item.verschil}</td>
        </tr>
      `
        )
        .join('');

      return clone;
    }

    function updateDataFilters(types) {
      const dataList = carSection.querySelector('.h-car__data-list');
      if (!dataList) return;

      dataList.innerHTML = '';
      types.forEach((type, index) => {
        const li = document.createElement('li');
        li.className = 'h-car__data-item';
        li.innerHTML = `<a href="#choose-your-car" class="h-car__data-link${index === 0 ? ' active' : ''}">${type}</a>`;
        dataList.appendChild(li);
      });
    }

    function filterCarData(filterType) {
      const contents = carSection.querySelectorAll('.h-car__data-content');
      const filters = carSection.querySelectorAll('.h-car__data-link');

      contents.forEach((content) => content.classList.remove('active'));

      const activeIndex = Array.from(filters).findIndex((filter) =>
        filter.classList.contains('active')
      );

      if (contents[activeIndex]) {
        contents[activeIndex].classList.add('active');
      }
    }

    /**
     * Вспомогательные функции (утилиты)
     */

    /**
     * Показать элемент (добавить класс active)
     * @param {string} selector - CSS селектор элемента
     */
    function showElement(selector) {
      const element = carSection.querySelector(selector);
      if (element) element.classList.add('active');
    }

    /**
     * Скрыть элемент (убрать класс active)
     * @param {string} selector - CSS селектор элемента
     */
    function hideElement(selector) {
      const element = carSection.querySelector(selector);
      if (element) element.classList.remove('active');
    }

    function clearStep(stepType) {
      const config = STEPS_CONFIG[stepType];
      if (!config) return;

      const step = carSection.querySelector(config.selector);
      if (!step) return;

      step.classList.remove('active');
      const list = step.querySelector('.h-car__list');
      if (list) list.innerHTML = '';
    }

    function clearStepsAfter(stepType) {
      const stepTypes = Object.keys(STEPS_CONFIG);
      const currentIndex = stepTypes.indexOf(stepType);

      for (let i = currentIndex + 1; i < stepTypes.length; i++) {
        clearStep(stepTypes[i]);
      }
    }

    function clearDataSection() {
      hideElement('.h-car__data');
      const dataContents = carSection.querySelector('.h-car__data-contents');
      const dataList = carSection.querySelector('.h-car__data-list');
      if (dataContents) dataContents.innerHTML = '';
      if (dataList) dataList.innerHTML = '';
    }

    function updateBreadcrumb(type, value) {
      const breadcrumb = carSection.querySelector(
        `.h-car__breadcrumb_${type} .h-car__breadcrumb-link`
      );
      if (breadcrumb) breadcrumb.textContent = value;

      clearBreadcrumbsAfter(type);
    }

    function clearBreadcrumbsAfter(type) {
      const currentIndex = BREADCRUMB_ORDER.indexOf(type);
      for (let i = currentIndex + 1; i < BREADCRUMB_ORDER.length; i++) {
        const breadcrumb = carSection.querySelector(
          `.h-car__breadcrumb_${BREADCRUMB_ORDER[i]} .h-car__breadcrumb-link`
        );
        if (breadcrumb) breadcrumb.textContent = '';
      }
    }

    function showStep(stepType) {
      const stepTypes = Object.keys(STEPS_CONFIG);
      const currentIndex = stepTypes.indexOf(stepType);

      stepTypes.forEach((step, index) => {
        const stepElement = carSection.querySelector(
          STEPS_CONFIG[step].selector
        );
        if (stepElement) {
          stepElement.classList.toggle('active', index <= currentIndex);
        }
      });
    }

    /**
     * Полный сброс к начальному состоянию (возврат к списку брендов)
     */
    function resetToInitialState() {
      // Сбрасываем все сохранённые данные выбора
      Object.keys(state).forEach((key) => (state[key] = null));

      // Убираем выделение с элементов брендов
      carSection.querySelectorAll('.h-car__item').forEach((item) => {
        item.classList.remove('selected');
      });

      // Возвращаем интерфейс в начальное состояние
      showElement('.h-car__items'); // Показываем список брендов
      showElement('.h-car__btn'); // Показываем кнопку "Показать больше"
      hideElement('.h-car__breadcrumbs'); // Скрываем навигацию
      hideElement('.h-car__steps'); // Скрываем шаги выбора

      // Полная очистка всех данных
      Object.keys(STEPS_CONFIG).forEach(clearStep); // Очищаем все шаги
      clearDataSection(); // Очищаем результаты

      // Очищаем текст в навигации (кроме первого элемента "wagens")
      BREADCRUMB_ORDER.slice(1).forEach((type) => updateBreadcrumb(type, ''));
    }
  }
});
