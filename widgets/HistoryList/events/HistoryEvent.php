<?php

namespace app\widgets\HistoryList\events;

use app\widgets\HistoryList\helpers\HistoryListHelper;
use app\models\History;
use yii\web\View;

/**
 * Класс HistoryEvent
 * Обработчик события по умолчанию
 * @property History $model Модель записи истории
 */
class HistoryEvent implements HistoryEventInterface
{
    public $model;

    /**
     * @inheritDoc
     */
    public function handleEvent(View $view)
    {
        return $view->render('_item_common', [
            'user' => $this->model->user,
            'body' => HistoryListHelper::getBodyByModel($this->model),
            'bodyDatetime' => $this->model->ins_ts,
            'iconClass' => 'fa-gear bg-purple-light'
        ]);
    }
}