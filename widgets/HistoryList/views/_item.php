<?php
use app\models\search\HistorySearch;
use app\widgets\HistoryList\events\HistoryEventFactory;

/** @var $model HistorySearch */

echo HistoryEventFactory::createEvent($model)->handleEvent($this);