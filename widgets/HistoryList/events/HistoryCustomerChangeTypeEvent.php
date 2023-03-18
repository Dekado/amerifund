<?php

namespace app\widgets\HistoryList\events;

use app\models\Customer;
use app\models\History;
use yii\web\View;

/**
 * Класс HistoryCustomerChangeTypeEvent
 * Обработчик события History::EVENT_CUSTOMER_CHANGE_TYPE
 * @property History $model Модель записи истории
 */
class HistoryCustomerChangeTypeEvent implements HistoryEventInterface
{
    public $model;

    /**
     * @inheritDoc
     */
    public function handleEvent(View $view)
    {
        return $view->render('_item_statuses_change', [
            'model' => $this->model,
            'oldValue' => Customer::getTypeTextByType($this->model->getDetailOldValue('type')),
            'newValue' => Customer::getTypeTextByType($this->model->getDetailNewValue('type'))
        ]);
    }
}