<?php

namespace application\common\components\queue;

use application\common\enums\QueueChannel;
use yii\console\ExitCode;
use yii\queue\redis\Command;

final class QueueCommand extends Command
{
    public ?string $channel = 'main';

    public function options($actionID): array
    {
        $options = parent::options($actionID);
        $options[] = 'channel';

        return $options;
    }

    public function actionListen($timeout = 3): ?int
    {
        $channel = QueueChannel::tryFrom($this->channel);
        if (!$channel) {
            $this->stderr("Unknown queue channel \"$this->channel\"\n");

            return ExitCode::UNSPECIFIED_ERROR;
        }

        $this->queue->channel = $channel->value;

        return parent::actionListen($timeout);
    }
}
