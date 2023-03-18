<?php

namespace app\widgets\HistoryList\events;

use app\widgets\HistoryList\helpers\HistoryListHelper;
use app\models\History;
use yii\web\View;

/**
 * Класс HistoryTaskEvent
 * Обработчик события History::EVENT_CREATED_TASK History::EVENT_COMPLETED_TASK History::EVENT_UPDATED_TASK
 * @property History $model Модель записи истории
 */
class HistoryTaskEvent implements HistoryEventInterface
{
    public $model;

    /**
     * @inheritDoc
     */
    public function handleEvent(View $view)
    {
        $task = $this->model->task;

        return $view->render('_item_common', [
            'user' => $this->model->user,
            'body' => HistoryListHelper::getBodyByModel($this->model),
            'iconClass' => 'fa-check-square bg-yellow',
            'footerDatetime' => $this->model->ins_ts,
            'footer' => isset($task->customerCreditor->name) ? "Creditor: " . $task->customerCreditor->name : ''
        ]);
    }
}