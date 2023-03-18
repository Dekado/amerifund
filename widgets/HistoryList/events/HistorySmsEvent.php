<?php

namespace app\widgets\HistoryList\events;

use app\widgets\HistoryList\helpers\HistoryListHelper;
use app\models\History;
use yii\web\View;
use Yii;
use app\models\Sms;

/**
 * Класс HistorySmsEvent
 * Обработчик события History::EVENT_INCOMING_SMS History::EVENT_OUTGOING_SMS
 * @property History $model Модель записи истории
 */
class HistorySmsEvent implements HistoryEventInterface
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
            'footer' => $this->model->sms->direction == Sms::DIRECTION_INCOMING ?
                Yii::t('app', 'Incoming message from {number}', [
                    'number' => $this->model->sms->phone_from ?? ''
                ]) : Yii::t('app', 'Sent message to {number}', [
                    'number' => $this->model->sms->phone_to ?? ''
                ]),
            'iconIncome' => $this->model->sms->direction == Sms::DIRECTION_INCOMING,
            'footerDatetime' => $this->model->ins_ts,
            'iconClass' => 'icon-sms bg-dark-blue'
        ]);
    }
}