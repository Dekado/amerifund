<?php

namespace app\widgets\HistoryList\events;

use app\widgets\HistoryList\helpers\HistoryListHelper;
use app\models\History;
use yii\web\View;
use app\models\Call;

/**
 * Класс HistoryCallEvent
 * Обработчик события History::EVENT_INCOMING_CALL History::EVENT_OUTGOING_CALL
 * @property History $model Модель записи истории
 */
class HistoryCallEvent implements HistoryEventInterface
{
    public $model;

    /**
     * @inheritDoc
     */
    public function handleEvent(View $view)
    {
        $call = $this->model->call;
        $answered = $call && $call->status == Call::STATUS_ANSWERED;

        return $view->render('_item_common', [
            'user' => $this->model->user,
            'content' => $call->comment ?? '',
            'body' => HistoryListHelper::getBodyByModel($this->model),
            'footerDatetime' => $this->model->ins_ts,
            'footer' => isset($call->applicant) ? "Called <span>{$call->applicant->name}</span>" : null,
            'iconClass' => $answered ? 'md-phone bg-green' : 'md-phone-missed bg-red',
            'iconIncome' => $answered && $call->direction == Call::DIRECTION_INCOMING
        ]);
    }
}