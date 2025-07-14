document.addEventListener('DOMContentLoaded', function () {
  const carSections = document.querySelectorAll('.h-car');
  if (!carSections.length) return;

  carSections.forEach((carSection) => {
    initCarSection(carSection);
    initShowMoreButton(carSection);
  });

  function initShowMoreButton(carSection) {
    const btn = carSection.querySelector('.h-car__btn');
    const items = carSection.querySelectorAll('.h-car__item');
    if (btn && items.length) {
      btn.addEventListener('click', function () {
        items.forEach((item) => {
          item.classList.add('active');
        });
        btn.remove();
      });
    }
  }

  function initCarSection(carSection) {
    // Конфигурация шагов
    const STEPS_CONFIG = {
      model: {
        next: 'year',
        selector: '.h-car__step_model',
        ajaxKey: 'models',
        updateFn: updateModelStep,
        clearAfter: true,
      },
      year: {
        next: 'motor',
        selector: '.h-car__step_year',
        ajaxKey: 'years',
        updateFn: updateYearStep,
        clearAfter: true,
      },
      motor: {
        next: null,
        selector: '.h-car__step_motor',
        ajaxKey: 'engines',
        updateFn: updateEngineStep,
        clearAfter: false,
      },
    };

    const BREADCRUMB_ORDER = ['wagens', 'brand', 'model', 'year', 'motor'];

    // Состояние
    const state = {
      currentBrand: null,
      currentModel: null,
      currentYear: null,
      currentCarId: null,
    };

    // Универсальная функция для AJAX запросов
    function makeAjaxRequest(endpoint, data) {
      const loading = document.getElementById('loading');

      // Показываем загрузку
      if (loading) loading.classList.add('active');

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
          // Скрываем загрузку
          if (loading) loading.classList.remove('active');
        });
    }

    // Универсальная функция для обновления шагов
    function updateStep(stepType, data, title, img = null) {
      const config = STEPS_CONFIG[stepType];
      if (!config) return;

      const step = carSection.querySelector(config.selector);
      if (!step) return;

      // Обновляем заголовок и изображение
      const logoTitle = step.querySelector('.h-car__logo-title');
      const logoImgContainer = step.querySelector('.h-car__logo-img');

      if (logoTitle) logoTitle.textContent = title;
      if (logoImgContainer && img) {
        const template = document.getElementById('h-car__logo-img');
        const clone = template.content.cloneNode(true);
        const imgElement = clone.querySelector('img');
        imgElement.src = img;
        imgElement.alt = title;
        logoImgContainer.innerHTML = '';
        logoImgContainer.appendChild(clone);
      }

      // Обновляем список
      const list = step.querySelector('.h-car__list');
      if (list) {
        list.innerHTML = '';
        data.forEach((item) => {
          const listItem = createListItem(stepType, item);
          list.appendChild(listItem);
        });
      }
    }

    // Создание элементов списка
    function createListItem(stepType, item) {
      const template = document.getElementById('h-car__list-li');
      const clone = template.content.cloneNode(true);
      const link = clone.querySelector('.h-car__list-link');

      switch (stepType) {
        case 'model':
          link.textContent = item.model;
          break;
        case 'year':
          link.textContent = item.year;
          break;
        case 'motor':
          link.dataset.carId = item.id;
          link.innerHTML = `<span>${item.motor}</span><span>${item.hp}</span>`;
          break;
      }

      return clone;
    }

    // Обработчики кликов
    const clickHandlers = {
      '.h-car__item': handleBrandClick,
      '.h-car__step_model .h-car__list-link': handleModelClick,
      '.h-car__step_year .h-car__list-link': handleYearClick,
      '.h-car__step_motor .h-car__list-link': handleEngineClick,
      '.h-car__data-link': handleDataFilterClick,
      '.h-car__breadcrumb-link': handleBreadcrumbClick,
    };

    // Главный обработчик событий
    carSection.addEventListener('click', function (e) {
      for (const [selector, handler] of Object.entries(clickHandlers)) {
        const target = e.target.closest(selector);
        if (target) {
          e.preventDefault();
          e.stopPropagation();
          handler(target);
          break;
        }
      }
    });

    function handleBrandClick(carItem) {
      const brandId = carItem.dataset.carBrandId;
      const brandName = carItem.dataset.carBrandName;
      const brandImg = carItem.querySelector('img').src;

      state.currentBrand = { id: brandId, name: brandName, img: brandImg };

      // Скрываем список брендов и кнопку
      hideElement('.h-car__items');
      hideElement('.h-car__btn');
      showElement('.h-car__breadcrumbs');
      updateBreadcrumb('brand', brandName);
      showElement('.h-car__steps');
      showStep('model');

      loadData('models', { type: 'models', brand_id: brandId }).then((data) =>
        updateModelStep(data, brandName, brandImg)
      );
    }

    function handleModelClick(modelLink) {
      const model = modelLink.textContent.trim();
      state.currentModel = model;
      updateBreadcrumb('model', model);

      loadData('years', {
        type: 'years',
        brand_id: state.currentBrand.id,
        model: model,
      }).then((data) => updateYearStep(data, model));
    }

    function handleYearClick(yearLink) {
      const year = yearLink.textContent.trim();
      state.currentYear = year;
      updateBreadcrumb('year', year);

      loadData('engines', {
        type: 'engines',
        brand_id: state.currentBrand.id,
        model: state.currentModel,
        year: year,
      }).then((data) => updateEngineStep(data, year));
    }

    function handleEngineClick(engineLink) {
      const carId = engineLink.dataset.carId;
      const motor = engineLink.querySelector('span:first-child').textContent.trim();
      const hp = engineLink.querySelector('span:last-child').textContent.trim();

      state.currentCarId = carId;
      updateBreadcrumb('motor', `${motor} ${hp}`);
      hideElement('.h-car__steps');

      loadData('info', { type: 'info', car_id: carId }).then((data) =>
        updateDataSection(data)
      );
    }

    function handleDataFilterClick(dataLink) {
      carSection.querySelectorAll('.h-car__data-link').forEach((link) => {
        link.classList.remove('active');
      });
      dataLink.classList.add('active');

      const filterType = dataLink.textContent.trim().toLowerCase();
      filterCarData(filterType);
    }

    function handleBreadcrumbClick(breadcrumbLink) {
      const breadcrumb = breadcrumbLink.closest('.h-car__breadcrumb');
      if (!breadcrumb) return;

      const breadcrumbActions = {
        'h-car__breadcrumb_wagens': () => resetToInitialState(),
        'h-car__breadcrumb_brand': () => navigateToStep('model'),
        'h-car__breadcrumb_model': () => navigateToStep('year'),
        'h-car__breadcrumb_year': () => navigateToStep('motor'),
        'h-car__breadcrumb_motor': () => navigateToStep('motor'),
      };

      for (const [className, action] of Object.entries(breadcrumbActions)) {
        if (breadcrumb.classList.contains(className)) {
          action();
          break;
        }
      }
    }

    // Навигация к шагу
    function navigateToStep(stepType) {
      const requiredStates = {
        model: () => state.currentBrand,
        year: () => state.currentBrand && state.currentModel,
        motor: () =>
          state.currentBrand && state.currentModel && state.currentYear,
      };

      if (!requiredStates[stepType]()) return;

      showElement('.h-car__steps');
      showStep(stepType);
      clearStepsAfter(stepType);
      clearDataSection();
      clearBreadcrumbsAfter(stepType);
    }

    // Загрузка данных с обработкой
    function loadData(endpoint, params) {
      return makeAjaxRequest(endpoint, params).then((data) => {
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

    // Специфичные функции обновления (упрощенные)
    function updateModelStep(models, brandName, brandImg) {
      updateStep('model', models, brandName, brandImg);
    }

    function updateYearStep(years, model) {
      updateStep('year', years, model, state.currentBrand?.img);
      showStep('year');
    }

    function updateEngineStep(engines, year) {
      updateStep('motor', engines, year, state.currentBrand?.img);
      showStep('motor');
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

    // Утилиты
    function showElement(selector) {
      const element = carSection.querySelector(selector);
      if (element) element.classList.add('active');
    }

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

    function resetToInitialState() {
      // Сбрасываем состояние
      Object.keys(state).forEach((key) => (state[key] = null));

      // Убираем выделение с брендов
      carSection.querySelectorAll('.h-car__item').forEach((item) => {
        item.classList.remove('selected');
      });

      // Показываем список брендов и кнопку обратно
      showElement('.h-car__items');
      showElement('.h-car__btn');
      // Скрываем блоки
      hideElement('.h-car__breadcrumbs');
      hideElement('.h-car__steps');

      // Очищаем все шаги и данные
      Object.keys(STEPS_CONFIG).forEach(clearStep);
      clearDataSection();

      // Очищаем breadcrumbs
      BREADCRUMB_ORDER.slice(1).forEach((type) => updateBreadcrumb(type, ''));
    }
  }
});
