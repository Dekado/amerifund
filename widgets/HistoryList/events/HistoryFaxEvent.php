<?php

namespace app\widgets\HistoryList\events;

use app\widgets\HistoryList\helpers\HistoryListHelper;
use app\models\History;
use yii\web\View;
use Yii;
use yii\helpers\Html;

/**
 * Класс HistoryFaxEvent
 * Обработчик события History::EVENT_OUTGOING_FAX History::EVENT_INCOMING_FAX
 * @property History $model Модель записи истории
 */
class HistoryFaxEvent implements HistoryEventInterface
{
    public $model;

    /**
     * @inheritDoc
     */
    public function handleEvent(View $view)
    {
        $fax = $this->model->fax;

        return $view->render('_item_common', [
            'user' => $this->model->user,
            'body' => HistoryListHelper::getBodyByModel($this->model) .
                ' - ' .
                (isset($fax->document) ? Html::a(
                    Yii::t('app', 'view document'),
                    $fax->document->getViewUrl(),
                    [
                        'target' => '_blank',
                        'data-pjax' => 0
                    ]
                ) : ''),
            'footer' => Yii::t('app', '{type} was sent to {group}', [
                'type' => $fax ? $fax->getTypeText() : 'Fax',
                'group' => isset($fax->creditorGroup) ? Html::a($fax->creditorGroup->name, ['creditors/groups'], ['data-pjax' => 0]) : ''
            ]),
            'footerDatetime' => $this->model->ins_ts,
            'iconClass' => 'fa-fax bg-green'
        ]);
    }
}