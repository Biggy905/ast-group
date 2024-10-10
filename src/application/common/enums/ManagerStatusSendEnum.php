<?php

namespace application\common\enums;

enum ManagerStatusSendEnum: string
{
    case STATUS_PROCESSED = 'processed';
    case STATUS_NOT_PROCESSED = 'not_processed';
}
