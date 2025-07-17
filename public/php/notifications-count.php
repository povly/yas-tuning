<?php
// Возвращаем HTML для бейджа
echo '<div class="user__icon-btn-badge" id="notifications-badge"
        hx-get="/php/notifications-count.php"
        hx-trigger="notifications-updated from:body"
        hx-swap="outerHTML">1</div>';
?>
