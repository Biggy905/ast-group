<?php

namespace application\common\enums;

enum QueueChannel: string
{
    case CHANNEL_MAIN = 'main';
    case CHANNEL_MANAGER_STATUS = 'manager_status';
}