<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-Type');

// Получаем параметры из POST запроса
$action = $_POST['action'] ?? $_GET['action'] ?? '';
$brand_id = intval($_POST['brand_id'] ?? $_GET['brand_id'] ?? 0);
$brand_name = $_POST['brand_name'] ?? $_GET['brand_name'] ?? '';
$brand_img = $_POST['brand_img'] ?? $_GET['brand_img'] ?? '';
$model = $_POST['model'] ?? $_GET['model'] ?? '';
$year = $_POST['year'] ?? $_GET['year'] ?? '';
$car_id = $_POST['car_id'] ?? $_GET['car_id'] ?? '';
$filter_type = $_POST['filter_type'] ?? $_GET['filter_type'] ?? '';
$motor = $_POST['motor'] ?? $_GET['motor'] ?? '';

// Сохраняем состояние в сессии
if ($action && $action !== 'reset') {
    $_SESSION['car_state'] = [
        'brand_id' => $brand_id,
        'brand_name' => $brand_name,
        'brand_img' => $brand_img,
        'model' => $model,
        'year' => $year,
        'car_id' => $car_id,
        'motor' => $motor,
        'filter_type' => $filter_type
    ];
} else if ($action === 'reset') {
    unset($_SESSION['car_state']);
}

// Восстанавливаем состояние из сессии если параметры не переданы
$saved_state = $_SESSION['car_state'] ?? [];
if (!$brand_id && isset($saved_state['brand_id'])) {
    $brand_id = $saved_state['brand_id'];
    $brand_name = $saved_state['brand_name'];
    $brand_img = $saved_state['brand_img'];
    $model = $saved_state['model'];
    $year = $saved_state['year'];
    $car_id = $saved_state['car_id'];
    $motor = $saved_state['motor'];
    $filter_type = $saved_state['filter_type'];
}

// Функция для загрузки данных
function loadCarData($type, $params) {
    // Здесь используем ту же логику, что и в get-data-from-price-model.php
    switch ($type) {
        case 'models':
            if ($params['brand_id'] === 1) {
                return [
                    ["model"=>"147"],["model"=>"156"],["model"=>"159"],
                    ["model"=>"166"],["model"=>"4C"],["model"=>"Brera"],
                    ["model"=>"CrossWagon"],["model"=>"Giulia"],["model"=>"Giulietta"],
                    ["model"=>"GT"],["model"=>"MiTo"],["model"=>"Spider"],["model"=>"Stelvio"]
                ];
            } else {
                // Для всех остальных брендов возвращаем тестовые модели
                return [
                    ["model"=>"Model 1"],["model"=>"Model 2"],["model"=>"Model 3"],
                    ["model"=>"Model 4"],["model"=>"Model 5"]
                ];
            }
            break;

        case 'years':
            if ($params['brand_id'] === 1 && $params['model'] === '147') {
                return [["year"=>"2001 -> 2005"],["year"=>"2005 -> ..."]];
            }
            break;

        case 'engines':
            if ($params['brand_id'] === 1 && $params['model'] === '147' && $params['year'] === '2001 -> 2005') {
                return [
                    ["id"=>"4932","motor"=>"1.9Jtd","hp"=>"100hp"],
                    ["id"=>"4933","motor"=>"1.9Jtd","hp"=>"115hp"],
                    ["id"=>"4934","motor"=>"1.9Jtd","hp"=>"136hp"],
                    ["id"=>"4935","motor"=>"1.9Jtd","hp"=>"140hp"],
                    ["id"=>"4930","motor"=>"2.0  TS","hp"=>"150hp"],
                    ["id"=>"4931","motor"=>"3.2  V6 GTA","hp"=>"250hp"]
                ];
            } else if ($params['brand_id'] > 1) {
                // Для остальных брендов возвращаем тестовые двигатели
                return [
                    ["id"=>"5001","motor"=>"1.6  Turbo","hp"=>"120hp"],
                    ["id"=>"5002","motor"=>"2.0  Turbo","hp"=>"180hp"],
                    ["id"=>"5003","motor"=>"2.5  V6","hp"=>"220hp"],
                    ["id"=>"5004","motor"=>"3.0  V8","hp"=>"300hp"]
                ];
            }
            break;

        case 'info':
            if ($params['car_id'] === '4932') {
                return [
                    ["type"=>"stage 1","meer_info"=>"Power","original"=>"100 hp","after_tuning"=>"135 hp","verschil"=>"+ 35 hp"],
                    ["type"=>"stage 1","meer_info"=>"Torque","original"=>"200 Nm","after_tuning"=>"265 Nm","verschil"=>"+ 65 Nm"],
                    ["type"=>"eco","meer_info"=>"Torque","original"=>"200 Nm","after_tuning"=>"265 Nm","verschil"=>"+ 65 Nm"],
                    ["type"=>"eco","meer_info"=>"\nEstimated fuel reduction\n","original"=>"","after_tuning"=>"","verschil"=>"\n+/- 17 %\n"]
                ];
            } else if ($params['car_id'] === '4933') {
                return [
                    ["type"=>"stage 1","meer_info"=>"Power","original"=>"115 hp","after_tuning"=>"145 hp","verschil"=>"+ 30 hp"],
                    ["type"=>"stage 1","meer_info"=>"Torque","original"=>"275 Nm","after_tuning"=>"330 Nm","verschil"=>"+ 55 Nm"],
                    ["type"=>"eco","meer_info"=>"Torque","original"=>"275 Nm","after_tuning"=>"330 Nm","verschil"=>"+ 55 Nm"],
                    ["type"=>"eco","meer_info"=>"\nEstimated fuel reduction\n","original"=>"","after_tuning"=>"","verschil"=>"\n+/- 10 %\n"]
                ];
            } else if (in_array($params['car_id'], ['5001', '5002', '5003', '5004'])) {
                // Для тестовых двигателей других брендов
                return [
                    ["type"=>"stage 1","meer_info"=>"Power","original"=>"150 hp","after_tuning"=>"200 hp","verschil"=>"+ 50 hp"],
                    ["type"=>"stage 1","meer_info"=>"Torque","original"=>"300 Nm","after_tuning"=>"380 Nm","verschil"=>"+ 80 Nm"],
                    ["type"=>"eco","meer_info"=>"Power","original"=>"150 hp","after_tuning"=>"170 hp","verschil"=>"+ 20 hp"],
                    ["type"=>"eco","meer_info"=>"\nEstimated fuel reduction\n","original"=>"","after_tuning"=>"","verschil"=>"\n+/- 15 %\n"]
                ];
            }
            break;
    }
    return [];
}

// Функция для рендера хлебных крошек
function renderBreadcrumbs($brand_name = '', $model = '', $year = '', $motor = '', $brand_id = 0, $brand_img = '') {
    echo '<ul class="h-car__breadcrumbs active">';
    echo '<li class="h-car__breadcrumb h-car__breadcrumb_wagens">';
    echo '<button type="button" class="h-car__breadcrumb-link" hx-post="/build/php/car-handler.php" hx-target="#car-section" hx-vals=\'{"action":"back_to_brands"}\'>Waganes</button>';
    echo '</li>';

    if ($brand_name) {
        echo '<li class="h-car__breadcrumb h-car__breadcrumb_brand">';
        echo '<button type="button" class="h-car__breadcrumb-link" hx-post="/build/php/car-handler.php" hx-target="#car-section" hx-vals=\'{"action":"to_brand","brand_id":"'.$brand_id.'","brand_name":"'.$brand_name.'","brand_img":"'.$brand_img.'"}\'>'.htmlspecialchars($brand_name).'</button>';
        echo '</li>';
    }

    if ($model) {
        echo '<li class="h-car__breadcrumb h-car__breadcrumb_model">';
        echo '<button type="button" class="h-car__breadcrumb-link" hx-post="/build/php/car-handler.php" hx-target="#car-section" hx-vals=\'{"action":"to_model","brand_id":"'.$brand_id.'","brand_name":"'.$brand_name.'","brand_img":"'.$brand_img.'","model":"'.$model.'"}\'>'.htmlspecialchars($model).'</button>';
        echo '</li>';
    }

    if ($year) {
        echo '<li class="h-car__breadcrumb h-car__breadcrumb_year">';
        echo '<button type="button" class="h-car__breadcrumb-link" hx-post="/build/php/car-handler.php" hx-target="#car-section" hx-vals=\'{"action":"to_year","brand_id":"'.$brand_id.'","brand_name":"'.$brand_name.'","brand_img":"'.$brand_img.'","model":"'.$model.'","year":"'.$year.'"}\'>'.htmlspecialchars($year).'</button>';
        echo '</li>';
    }

    if ($motor) {
        echo '<li class="h-car__breadcrumb h-car__breadcrumb_motor">';
        echo '<span class="h-car__breadcrumb-link">'.htmlspecialchars($motor).'</span>';
        echo '</li>';
    }

    echo '</ul>';
}

// Функция для рендера шагов выбора
function renderSteps($step, $data, $title, $img = '', $brand_id = 0, $brand_name = '', $model = '', $year = '') {
    echo '<div class="h-car__steps active">';

    // Всегда показываем шаг бренда
    echo '<div class="h-car__step h-car__step_model active">';
    echo '<div class="h-car__logo">';
    if ($img) {
        echo '<div class="h-car__logo-img"><img src="'.htmlspecialchars($img).'" width="58" height="58" loading="lazy"></div>';
    }
    echo '<div class="h-car__logo-title">'.htmlspecialchars($brand_name).'</div>';
    echo '</div>';

    // Показываем модели если это step=model или если мы на дальнейших шагах
    if ($step === 'model') {
        echo '<ul class="h-car__list">';
        foreach ($data as $item) {
            echo '<li class="h-car__list-li">';
            echo '<button type="button" class="h-car__list-link" hx-post="/build/php/car-handler.php" hx-target="#car-section" hx-vals=\'{"action":"select_model","brand_id":"'.$brand_id.'","brand_name":"'.$brand_name.'","brand_img":"'.$img.'","model":"'.htmlspecialchars($item['model']).'"}\'>'.htmlspecialchars($item['model']).'</button>';
            echo '</li>';
        }
        echo '</ul>';
    } elseif ($step === 'year' || $step === 'motor') {
        // Показываем все модели как кликабельные на последующих шагах
        $models_data = loadCarData('models', ['brand_id' => $brand_id]);
        if (!empty($models_data)) {
            echo '<ul class="h-car__list">';
            foreach ($models_data as $item) {
                $selected_class = ($item['model'] === $model) ? ' selected' : '';
                echo '<li class="h-car__list-li">';
                echo '<button type="button" class="h-car__list-link'.$selected_class.'" hx-post="/build/php/car-handler.php" hx-target="#car-section" hx-vals=\'{"action":"select_model","brand_id":"'.$brand_id.'","brand_name":"'.$brand_name.'","brand_img":"'.$img.'","model":"'.htmlspecialchars($item['model']).'"}\'>'.htmlspecialchars($item['model']).'</button>';
                echo '</li>';
            }
            echo '</ul>';
        }
    }
    echo '</div>';

    // Показываем шаг модели если есть модель
    if ($model && ($step === 'year' || $step === 'motor')) {
        echo '<div class="h-car__step h-car__step_year active">';
        echo '<div class="h-car__logo">';
        if ($img) {
            echo '<div class="h-car__logo-img"><img src="'.htmlspecialchars($img).'" width="58" height="58" loading="lazy"></div>';
        }
        echo '<div class="h-car__logo-title">'.htmlspecialchars($model).'</div>';
        echo '</div>';

        if ($step === 'year') {
            echo '<ul class="h-car__list">';
            foreach ($data as $item) {
                echo '<li class="h-car__list-li">';
                echo '<button type="button" class="h-car__list-link" hx-post="/build/php/car-handler.php" hx-target="#car-section" hx-vals=\'{"action":"select_year","brand_id":"'.$brand_id.'","brand_name":"'.$brand_name.'","brand_img":"'.$img.'","model":"'.$model.'","year":"'.htmlspecialchars($item['year']).'"}\'>'.htmlspecialchars($item['year']).'</button>';
                echo '</li>';
            }
            echo '</ul>';
        } elseif ($step === 'motor') {
            // Показываем все годы как кликабельные
            $years_data = loadCarData('years', ['brand_id' => $brand_id, 'model' => $model]);
            if (!empty($years_data)) {
                echo '<ul class="h-car__list">';
                foreach ($years_data as $item) {
                    $selected_class = ($item['year'] === $year) ? ' selected' : '';
                    echo '<li class="h-car__list-li">';
                    echo '<button type="button" class="h-car__list-link'.$selected_class.'" hx-post="/build/php/car-handler.php" hx-target="#car-section" hx-vals=\'{"action":"select_year","brand_id":"'.$brand_id.'","brand_name":"'.$brand_name.'","brand_img":"'.$img.'","model":"'.$model.'","year":"'.htmlspecialchars($item['year']).'"}\'>'.htmlspecialchars($item['year']).'</button>';
                    echo '</li>';
                }
                echo '</ul>';
            }
        }
        echo '</div>';
    }

    // Показываем шаг года если есть год
    if ($year && $step === 'motor') {
        echo '<div class="h-car__step h-car__step_motor active">';
        echo '<div class="h-car__logo">';
        if ($img) {
            echo '<div class="h-car__logo-img"><img src="'.htmlspecialchars($img).'" width="58" height="58" loading="lazy"></div>';
        }
        echo '<div class="h-car__logo-title">'.htmlspecialchars($year).'</div>';
        echo '</div>';

        echo '<ul class="h-car__list">';
        foreach ($data as $item) {
            echo '<li class="h-car__list-li">';
            echo '<button type="button" class="h-car__list-link" hx-post="/build/php/car-handler.php" hx-target="#car-section" hx-vals=\'{"action":"select_engine","brand_id":"'.$brand_id.'","brand_name":"'.$brand_name.'","brand_img":"'.$img.'","model":"'.$model.'","year":"'.$year.'","car_id":"'.htmlspecialchars($item['id']).'","motor":"'.htmlspecialchars($item['motor'].' '.$item['hp']).'"}\'>'.
                 '<span>'.htmlspecialchars($item['motor']).'</span><span>'.htmlspecialchars($item['hp']).'</span></button>';
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }

    echo '</div>';
}

// Функция для рендера данных автомобиля
function renderCarData($data, $active_filter = '') {
    // Группируем данные по типу
    $grouped = [];
    foreach ($data as $item) {
        $grouped[$item['type']][] = $item;
    }

    $types = array_keys($grouped);
    if (!$active_filter || !in_array($active_filter, $types)) {
        $active_filter = $types[0] ?? '';
    }

    echo '<div class="h-car__data active">';

    // Рендер фильтров (клиентская фильтрация через onclick)
    echo '<ul class="h-car__data-list">';
    foreach ($types as $index => $type) {
        $active_class = $type === $active_filter ? ' active' : '';
        echo '<li class="h-car__data-item">';
        echo '<button type="button" class="h-car__data-link'.$active_class.'" onclick="filterCarData(\''.$type.'\')">'.htmlspecialchars($type).'</button>';
        echo '</li>';
    }
    echo '</ul>';

    // Рендер содержимого (все типы сразу, переключение через JS)
    echo '<div class="h-car__data-contents">';
    foreach ($types as $type) {
        $active_class = $type === $active_filter ? ' active' : '';
        echo '<div class="h-car__data-content'.$active_class.'" data-filter="'.$type.'">';
        echo '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="h-car__table">';
        echo '<thead><tr><th></th><th>Original</th><th>After tuning</th><th>Difference</th></tr></thead>';
        echo '<tbody>';

        foreach ($grouped[$type] as $item) {
            echo '<tr>';
            echo '<td>'.htmlspecialchars($item['meer_info']).'</td>';
            echo '<td>'.htmlspecialchars($item['original']).'</td>';
            echo '<td>'.htmlspecialchars($item['after_tuning']).'</td>';
            echo '<td>'.htmlspecialchars($item['verschil']).'</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    }
    echo '</div>';

    // Добавляем JavaScript для клиентской фильтрации
    echo '<script>
    function filterCarData(filterType) {
        // Убираем active класс у всех кнопок
        document.querySelectorAll(".h-car__data-link").forEach(btn => btn.classList.remove("active"));

        // Добавляем active класс к нажатой кнопке
        event.target.classList.add("active");

        // Скрываем все содержимое
        document.querySelectorAll(".h-car__data-content").forEach(content => content.classList.remove("active"));

        // Показываем нужное содержимое
        const targetContent = document.querySelector(".h-car__data-content[data-filter=\"" + filterType + "\"]");
        if (targetContent) {
            targetContent.classList.add("active");
        }
    }
    </script>';

    echo '</div>';
}

// Функция для рендера всех брендов с контролем видимости
function renderAllBrands($showAll = false) {
    echo '<div class="h-car__title section__title section__title_center">choose your car</div>';
    echo '<div class="h-car__items active">';

    // Полный список всех брендов
    $brands = [
        ['id' => 1, 'name' => 'Alfa Romeo', 'img' => '/images/home/car/alfa.webp'],
        ['id' => 2, 'name' => 'Alpina', 'img' => '/images/home/car/alpina.webp'],
        ['id' => 3, 'name' => 'Alpine', 'img' => '/images/home/car/alpine.webp'],
        ['id' => 4, 'name' => 'Ariel Motors', 'img' => '/images/home/car/ariel.webp'],
        ['id' => 5, 'name' => 'Aston Martin', 'img' => '/images/home/car/aston.webp'],
        ['id' => 6, 'name' => 'Audi', 'img' => '/images/home/car/audi.webp'],
        ['id' => 7, 'name' => 'Bentley', 'img' => '/images/home/car/bentley.webp'],
        ['id' => 8, 'name' => 'BMW', 'img' => '/images/home/car/bmw.webp'],
        ['id' => 9, 'name' => 'Borgward', 'img' => '/images/home/car/borgward.webp'],
        ['id' => 10, 'name' => 'Bugatti', 'img' => '/images/home/car/bugatti.webp'],
        ['id' => 11, 'name' => 'Buick', 'img' => '/images/home/car/buick.webp'],
        ['id' => 12, 'name' => 'Cadillac', 'img' => '/images/home/car/cadillac.webp'],
        ['id' => 13, 'name' => 'Chevrolet', 'img' => '/images/home/car/chevrolet.webp'],
        ['id' => 14, 'name' => 'Chrysler', 'img' => '/images/home/car/chrysler.webp'],
        ['id' => 15, 'name' => 'Citroën', 'img' => '/images/home/car/citroen.webp'],
        ['id' => 16, 'name' => 'Cupra', 'img' => '/images/home/car/cupra.webp'],
        ['id' => 17, 'name' => 'Dacia', 'img' => '/images/home/car/dacia.webp'],
        ['id' => 18, 'name' => 'Daewoo', 'img' => '/images/home/car/daewoo.webp'],
        ['id' => 19, 'name' => 'Dodge', 'img' => '/images/home/car/dodge.webp'],
        ['id' => 20, 'name' => 'DS', 'img' => '/images/home/car/ds.webp'],
        ['id' => 21, 'name' => 'Ferrari', 'img' => '/images/home/car/ferrari.webp'],
        ['id' => 22, 'name' => 'Fiat', 'img' => '/images/home/car/fiat.webp'],
        ['id' => 23, 'name' => 'Ford', 'img' => '/images/home/car/ford.webp'],
        ['id' => 24, 'name' => 'GWM', 'img' => '/images/home/car/gwm.webp'],
        ['id' => 25, 'name' => 'Holden', 'img' => '/images/home/car/holden.webp'],
        ['id' => 26, 'name' => 'Honda', 'img' => '/images/home/car/honda.webp'],
        ['id' => 27, 'name' => 'Hyundai', 'img' => '/images/home/car/hyundai.webp'],
        ['id' => 28, 'name' => 'Infiniti', 'img' => '/images/home/car/infiniti.webp'],
        ['id' => 29, 'name' => 'Isuzu', 'img' => '/images/home/car/isuzu.webp'],
        ['id' => 30, 'name' => 'Iveco', 'img' => '/images/home/car/iveco.webp'],
        ['id' => 31, 'name' => 'Jaguar', 'img' => '/images/home/car/jaguar.webp'],
        ['id' => 32, 'name' => 'Jeep', 'img' => '/images/home/car/jeep.webp'],
        ['id' => 33, 'name' => 'Kia', 'img' => '/images/home/car/kia.webp'],
        ['id' => 34, 'name' => 'KTM', 'img' => '/images/home/car/ktm.webp'],
        ['id' => 35, 'name' => 'Lamborghini', 'img' => '/images/home/car/lamborghini.webp'],
        ['id' => 36, 'name' => 'Lancia', 'img' => '/images/home/car/lancia.webp'],
        ['id' => 37, 'name' => 'Landrover', 'img' => '/images/home/car/land.webp'],
        ['id' => 38, 'name' => 'Lexus', 'img' => '/images/home/car/lexus.webp'],
        ['id' => 39, 'name' => 'Lotus', 'img' => '/images/home/car/lotus.webp'],
        ['id' => 40, 'name' => 'Mahindra', 'img' => '/images/home/car/mahindra.webp'],
        ['id' => 41, 'name' => 'MAN', 'img' => '/images/home/car/man.webp'],
        ['id' => 42, 'name' => 'Maserati', 'img' => '/images/home/car/maserati.webp'],
        ['id' => 43, 'name' => 'Mazda', 'img' => '/images/home/car/mazda.webp'],
        ['id' => 44, 'name' => 'McLaren', 'img' => '/images/home/car/mclaren.webp'],
        ['id' => 45, 'name' => 'Mercedes', 'img' => '/images/home/car/mercedes.webp'],
        ['id' => 46, 'name' => 'MG', 'img' => '/images/home/car/mg.webp'],
        ['id' => 47, 'name' => 'Mini', 'img' => '/images/home/car/mini.webp'],
        ['id' => 48, 'name' => 'Mitsubishi', 'img' => '/images/home/car/mitsubishi.webp'],
        ['id' => 49, 'name' => 'Nissan', 'img' => '/images/home/car/nissan.webp'],
        ['id' => 50, 'name' => 'Opel', 'img' => '/images/home/car/opel.webp'],
        ['id' => 51, 'name' => 'Pagani', 'img' => '/images/home/car/pagani.webp'],
        ['id' => 52, 'name' => 'Peugeot', 'img' => '/images/home/car/peugeot.webp'],
        ['id' => 53, 'name' => 'PGO', 'img' => '/images/home/car/pgo.webp'],
        ['id' => 54, 'name' => 'Piaggio', 'img' => '/images/home/car/piaggio.webp'],
        ['id' => 55, 'name' => 'Porsche', 'img' => '/images/home/car/porshe.webp'],
        ['id' => 56, 'name' => 'Renault', 'img' => '/images/home/car/renault.webp'],
        ['id' => 57, 'name' => 'Rolls Royce', 'img' => '/images/home/car/rolls.webp'],
        ['id' => 58, 'name' => 'Saab', 'img' => '/images/home/car/saab.webp'],
        ['id' => 59, 'name' => 'Samsung', 'img' => '/images/home/car/samsung.webp'],
        ['id' => 60, 'name' => 'Scion', 'img' => '/images/home/car/scion.webp'],
        ['id' => 61, 'name' => 'Seat', 'img' => '/images/home/car/seat.webp'],
        ['id' => 62, 'name' => 'Skoda', 'img' => '/images/home/car/skoda.webp'],
        ['id' => 63, 'name' => 'Smart', 'img' => '/images/home/car/smart.webp'],
        ['id' => 64, 'name' => 'SsangYong', 'img' => '/images/home/car/ssang.webp'],
        ['id' => 65, 'name' => 'Subaru', 'img' => '/images/home/car/subaru.webp'],
        ['id' => 66, 'name' => 'Suzuki', 'img' => '/images/home/car/suzuki.webp'],
        ['id' => 67, 'name' => 'Tata', 'img' => '/images/home/car/tata.webp'],
        ['id' => 68, 'name' => 'Toyota', 'img' => '/images/home/car/toyota.webp'],
        ['id' => 69, 'name' => 'Volkswagen', 'img' => '/images/home/car/volk.webp'],
        ['id' => 70, 'name' => 'Volvo', 'img' => '/images/home/car/volvo.webp'],
        ['id' => 71, 'name' => 'Westfield', 'img' => '/images/home/car/west.webp'],
        ['id' => 72, 'name' => 'Wiesmann', 'img' => '/images/home/car/wiesm.webp']
    ];

    // Определяем количество изначально видимых элементов (с классом active в pug)
    $initialVisibleCount = 36; // До Lancia включительно (по pug файлу)

    foreach ($brands as $index => $brand) {
        // Если showAll=false, показываем только первые элементы как active
        $isActive = $showAll || $index < $initialVisibleCount;
        $activeClass = $isActive ? ' active' : '';

        echo '<div class="h-car__item'.$activeClass.'" data-car-brand-id="'.$brand['id'].'" data-car-brand-name="'.htmlspecialchars($brand['name']).'">';
        echo '<button type="button" class="h-car__item-link" hx-post="/build/php/car-handler.php" hx-target="#car-section" hx-vals=\'{"action":"select_brand","brand_id":"'.$brand['id'].'","brand_name":"'.htmlspecialchars($brand['name']).'","brand_img":"'.htmlspecialchars($brand['img']).'"}\' >';
        echo '<div class="h-car__item-img">';
        echo '<img src="'.htmlspecialchars($brand['img']).'" alt="'.htmlspecialchars($brand['name']).'" width="58" height="58" loading="lazy">';
        echo '</div>';
        echo '<div class="h-car__item-title">'.htmlspecialchars($brand['name']).'</div>';
        echo '</button>';
        echo '</div>';
    }

    echo '</div>';

    // Показываем кнопку "Show more" только если не все элементы активны
    if (!$showAll) {
        echo '<button type="button" class="h-car__btn p-btn p-btn_orange p-btn_center active" hx-post="/build/php/car-handler.php" hx-target="#car-section" hx-vals=\'{"action":"show_more_brands"}\'>Show more</button>';
    }
}

// Функция для рендера начального состояния
function renderInitialState() {
    // Проверяем сессию - если уже показывали все бренды, показываем все
    $showAll = isset($_SESSION['show_all_brands']) && $_SESSION['show_all_brands'];
    renderAllBrands($showAll);
}

// Основная логика обработки действий
switch ($action) {
    case 'reset':
        // Сбрасываем состояние "show more" при полном reset
        unset($_SESSION['show_all_brands']);
        renderInitialState();
        break;

    case 'show_more_brands':
        $_SESSION['show_all_brands'] = true; // Сохраняем в сессии
        renderAllBrands(true); // true = показать все
        break;

    case 'back_to_brands':
        // Возврат к списку брендов с сохранением состояния show_all_brands
        $showAll = isset($_SESSION['show_all_brands']) && $_SESSION['show_all_brands'];
        renderAllBrands($showAll);
        break;

    case 'select_brand':
        $models = loadCarData('models', ['brand_id' => $brand_id]);
        echo '<div class="h-car__title section__title section__title_center">choose your car</div>';
        renderBreadcrumbs($brand_name, '', '', '', $brand_id, $brand_img);
        renderSteps('model', $models, $brand_name, $brand_img, $brand_id, $brand_name);
        break;

    case 'to_brand':
        $models = loadCarData('models', ['brand_id' => $brand_id]);
        echo '<div class="h-car__title section__title section__title_center">choose your car</div>';
        renderBreadcrumbs($brand_name, '', '', '', $brand_id, $brand_img);
        renderSteps('model', $models, $brand_name, $brand_img, $brand_id, $brand_name);
        break;

    case 'select_model':
        $years = loadCarData('years', ['brand_id' => $brand_id, 'model' => $model]);
        echo '<div class="h-car__title section__title section__title_center">choose your car</div>';
        renderBreadcrumbs($brand_name, $model, '', '', $brand_id, $brand_img);
        renderSteps('year', $years, $model, $brand_img, $brand_id, $brand_name, $model);
        break;

    case 'to_model':
        $years = loadCarData('years', ['brand_id' => $brand_id, 'model' => $model]);
        echo '<div class="h-car__title section__title section__title_center">choose your car</div>';
        renderBreadcrumbs($brand_name, $model, '', '', $brand_id, $brand_img);
        renderSteps('year', $years, $model, $brand_img, $brand_id, $brand_name, $model);
        break;

    case 'select_year':
        $engines = loadCarData('engines', ['brand_id' => $brand_id, 'model' => $model, 'year' => $year]);
        echo '<div class="h-car__title section__title section__title_center">choose your car</div>';
        renderBreadcrumbs($brand_name, $model, $year, '', $brand_id, $brand_img);
        renderSteps('motor', $engines, $year, $brand_img, $brand_id, $brand_name, $model, $year);
        break;

    case 'to_year':
        $engines = loadCarData('engines', ['brand_id' => $brand_id, 'model' => $model, 'year' => $year]);
        echo '<div class="h-car__title section__title section__title_center">choose your car</div>';
        renderBreadcrumbs($brand_name, $model, $year, '', $brand_id, $brand_img);
        renderSteps('motor', $engines, $year, $brand_img, $brand_id, $brand_name, $model, $year);
        break;

    case 'select_engine':
        $motor = $_POST['motor'] ?? '';
        $car_data = loadCarData('info', ['car_id' => $car_id]);
        echo '<div class="h-car__title section__title section__title_center">choose your car</div>';
        renderBreadcrumbs($brand_name, $model, $year, $motor, $brand_id, $brand_img);
        renderCarData($car_data);
        break;



    default:
        renderInitialState();
        break;
}
?>
