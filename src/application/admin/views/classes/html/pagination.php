<?php

/** @var yii\data\Pagination $pagination */

use yii\bootstrap5\LinkPager;

$currentPage = Yii::$app->request->get('page');

$count = $pagination->totalCount;

$maxButtonCount = 3;
$intCurrentPage = (int) $currentPage;
$dirtyLastPage = intdiv($count + 16, 16);

$firstPageLabel = false;
$prevPageLabel = false;
$nextPageLabel = false;
$lastPageLabel = false;
if ($maxButtonCount < $dirtyLastPage) {
    // Если юзер находится на 1 и 2 странице
    if ($intCurrentPage === 1 || $intCurrentPage === 2) {
        $maxButtonCount = 4;
        $nextPageLabel = '...';
        $lastPageLabel = $dirtyLastPage;
        // Если юзер находится на позиции более 2 страниц
    } elseif ($intCurrentPage > 2) {
        $firstPageLabel = 1;
        $prevPageLabel = '...';

        if (
            $intCurrentPage === ($dirtyLastPage - 1)
            || $intCurrentPage === $dirtyLastPage
        ) {
            $nextPageLabel = false;
            $lastPageLabel = false;
        } elseif (
            $intCurrentPage < ($dirtyLastPage - 1)
            || $intCurrentPage <= $dirtyLastPage
        ) {
            $nextPageLabel = '...';
            $lastPageLabel = $dirtyLastPage;
        }
    }
}

echo LinkPager::widget([
    'pagination' => $pagination,
    'maxButtonCount' => $maxButtonCount,

    'pageCssClass' => 'paginate_button page-item',
    'firstPageCssClass' => 'paginate_button page-item',
    'lastPageCssClass' => 'paginate_button page-item',
    'activePageCssClass' => 'paginate_button page-item active',
    'disabledPageCssClass' => 'paginate_button page-item disabled',

    'firstPageLabel' => $firstPageLabel,
    'lastPageLabel' => $lastPageLabel,
    'nextPageLabel' => $nextPageLabel,
    'prevPageLabel' => $prevPageLabel,
    'hideOnSinglePage' => false,
    'options' => [
        'tag' => 'div',
        'id' => false,
        'class' => 'pagination justify-content-center',
    ],
    'linkOptions' => [
        'class' => 'page-link',
    ],
]);
