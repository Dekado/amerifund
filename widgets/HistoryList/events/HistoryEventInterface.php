<?php

namespace app\widgets\HistoryList\events;

use app\models\History;
use yii\web\View;

/**
 * Интерфейс события истории
 */
interface HistoryEventInterface
{
    /**
     * Обработчик события
     * @param View $view
     * @return mixed
     */
    public function handleEvent(View $view);
}