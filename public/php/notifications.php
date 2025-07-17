<?php
header('Content-Type: text/html; charset=utf-8');

// Получаем ID уведомления
$id = $_POST['id'] ?? '';

// Поскольку HTMX вызывается только для непрочитанных уведомлений,
// всегда помечаем как прочитанное
$isRead = true;

// Здесь должно быть обновление в базе данных
// Пока что просто возвращаем обновленный HTML

// Функция для подсчета непрочитанных уведомлений
function getUnreadCount($notifications, $readNotifications = []) {
    $unreadCount = 0;
    foreach ($notifications as $notifId => $notification) {
        if (!in_array($notifId, $readNotifications)) {
            $unreadCount++;
        }
    }
    return $unreadCount;
}

// Список прочитанных уведомлений (в реальном проекте из БД/сессии)
// Для демонстрации: уведомления 3 и 4 уже прочитанные
$readNotifications = ['3', '4'];
if ($isRead && $id) {
    $readNotifications[] = $id; // Добавляем текущее уведомление в список прочитанных
}

// Данные уведомлений (в реальном проекте из БД)
$notifications = [
    '1' => [
        'title' => 'New ticket for order № 28012024-3',
        'time' => 'Friday, 16:35',
        'ago' => '2 hours ago',
        'desc' => 'инфо о машине, о пользователе, опции отключения инфо о машине, о пользователе, опции отключения инфо о машине инфо....'
    ],
    '2' => [
        'title' => 'Order № 28012024-3 has been accepted',
        'time' => 'Friday, 14:35',
        'ago' => '4 hours ago',
        'desc' => ''
    ],
    '3' => [
        'title' => 'Order № 28012024-3 completed',
        'time' => 'Friday, 14:35',
        'ago' => '4 hours ago',
        'desc' => ''
    ],
    '4' => [
        'title' => 'Order № 28012024-3 canceled',
        'time' => 'Friday, 12:35',
        'ago' => '6 hours ago',
        'desc' => ''
    ]
];

header('HX-Trigger: notifications-updated');

if (isset($notifications[$id])) {
    $notification = $notifications[$id];
    $dataRead = $isRead ? 'true' : 'false';

    // Только для непрочитанных добавляем HTMX атрибуты
    if (!$isRead) {
        echo '<div class="user__notification-item" data-id="' . $id . '" data-read="' . $dataRead . '" hx-post="/php/notifications.php" hx-trigger="click" hx-vals=\'{"id": "' . $id . '"}\' hx-target="this" hx-swap="outerHTML" hx-on--after-request="document.body.dispatchEvent(new CustomEvent(\'notifications-updated\'))">';
    } else {
        echo '<div class="user__notification-item" data-id="' . $id . '" data-read="' . $dataRead . '">';
    }

    echo '  <div class="user__notification-header">';

    if (!$isRead) {
        echo '    <div class="user__notification-status">';
        echo '      <div class="user__notification-dot"></div>';
        echo '    </div>';
    }

    echo '    <div class="user__notification-title">' . htmlspecialchars($notification['title']) . '</div>';
    echo '  </div>';
    echo '  <div class="user__notification-meta">';
    echo '    <div class="user__notification-time">' . htmlspecialchars($notification['time']) . '</div>';
    echo '    <div class="user__notification-ago">' . htmlspecialchars($notification['ago']) . '</div>';
    echo '  </div>';

    if (!empty($notification['desc'])) {
        echo '  <div class="user__notification-desc">' . htmlspecialchars($notification['desc']) . '</div>';
    }

    echo '</div>';
} else {
    echo '<div>Notification not found</div>';
}
?>
