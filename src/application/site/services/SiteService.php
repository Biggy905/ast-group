<?php

declare(strict_types=1);

namespace application\site\services;

use application\common\entities\Event;
use application\common\repositories\EventRepository;
use application\site\groups\SiteListGroup;
use yii\data\Pagination;

final class SiteService
{
    public function __construct(
        private readonly EventRepository $eventRepository,
        private readonly Event $event,
    ) {

    }

    public function list($page): array
    {
        $labelAttributes = $this->event->attributeLabels();
        $list = $this->eventRepository->findAll($page);

        return [
            'list' => SiteListGroup::toArray($list, $labelAttributes),
            'pagination' => new Pagination(
                [
                    'totalCount' => $this->eventRepository->findAllCount(),
                    'defaultPageSize' => 16,
                ]
            )
        ];
    }
}
