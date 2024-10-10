<?php

namespace application\common\components;

use application\common\enums\QueueChannel;
use yii\queue\JobInterface;

final class QueueComponent
{
    public function push(
        JobInterface $job,
        QueueChannel $channel = QueueChannel::CHANNEL_MAIN,
        int $delay = 0
    ): ?string {
        $queue = new \yii\queue\redis\Queue();
        $queue->channel = $channel->value;
        $queue->ttr = 60 * 60;

        if ($delay) {
            $queue->delay($delay);
        }

        return $queue->push($job);
    }
}
