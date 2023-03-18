<?php

namespace app\widgets\HistoryList\events;

use Yii;
use app\widgets\HistoryList\events\HistoryCustomerChangeQualityEvent;
use app\widgets\HistoryList\events\HistoryIncomingCallEvent;
use app\widgets\HistoryList\events\HistoryOutgoingCallEvent;
use app\models\History;

/**
 * Класс HistoryEventFactory
 * Предназначен для создания объектов событий
 */
class HistoryEventFactory
{
    /**
     * Создает объект события истории
     * @param History $model
     * @return object
     */
    public static function createEvent(History $model)
    {
        switch ($model->event) {
            case History::EVENT_CREATED_TASK:
            case History::EVENT_COMPLETED_TASK:
            case History::EVENT_UPDATED_TASK:
                return Yii::createObject([
                    'class' => HistoryTaskEvent::class,
                    'model' => $model,
                ]);
            case History::EVENT_INCOMING_SMS:
            case History::EVENT_OUTGOING_SMS:
                return Yii::createObject([
                    'class' => HistorySmsEvent::class,
                    'model' => $model,
                ]);
            case History::EVENT_INCOMING_FAX:
            case History::EVENT_OUTGOING_FAX:
                return Yii::createObject([
                    'class' => HistoryFaxEvent::class,
                    'model' => $model,
                ]);
            case History::EVENT_CUSTOMER_CHANGE_TYPE:
                return Yii::createObject([
                    'class' => HistoryCustomerChangeTypeEvent::class,
                    'model' => $model,
                ]);
            case History::EVENT_CUSTOMER_CHANGE_QUALITY:
                return Yii::createObject([
                    'class' => HistoryCustomerChangeQualityEvent::class,
                    'model' => $model,
                ]);
            case History::EVENT_INCOMING_CALL:
            case History::EVENT_OUTGOING_CALL:
                return Yii::createObject([
                    'class' => HistoryCallEvent::class,
                    'model' => $model,
                ]);
            default:
                return new HistoryEvent($model);
        }
    }
}