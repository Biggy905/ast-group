<?php

declare(strict_types=1);

namespace application\common\components;

use application\common\helpers\DateTimeHelper;
use yii\base\InvalidCallException;
use Yii;
use yii\queue\JobInterface;

abstract class AbstractJob implements JobInterface
{
    public function execute($queue): void
    {
        if (method_exists($this, 'exec')) {
            Yii::$container->invoke([$this, 'exec']);
        } else {
            throw new InvalidCallException('Method "exec" does not exist');
        }
    }

    protected function log(string $message): void
    {
        $date = (DateTimeHelper::getDateTime())->format('Y-m-d H:i:s.u');
        echo "[$date] $message" . PHP_EOL;
    }
}
