<?php

namespace app\widgets\HistoryList\events;

use app\models\Customer;
use app\models\History;
use yii\web\View;

/**
 * Класс HistoryCustomerChangeQualityEvent
 * Обработчик события History::EVENT_CUSTOMER_CHANGE_QUALITY
 * @property History $model Модель записи истории
 */
class HistoryCustomerChangeQualityEvent implements HistoryEventInterface
{
    public $model;

    /**
     * @inheritDoc
     */
    public function handleEvent(View $view)
    {
        return $view->render('_item_statuses_change', [
            'model' => $this->model,
            'oldValue' => Customer::getQualityTextByQuality($this->model->getDetailOldValue('quality')),
            'newValue' => Customer::getQualityTextByQuality($this->model->getDetailNewValue('quality')),
        ]);
    }
}